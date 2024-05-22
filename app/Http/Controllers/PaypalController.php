<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Auth;
use App\Package;
use App\PaymentTransactionHistory;
use App\User;
use Http\Client\Exception\HttpException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Payment;
use Validator;
use URL;
use Redirect;
use Input;
use App\Traits\JobSeekerPackageTrait;
/** All Paypal Details class **/
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
class PaypalController extends Controller
{
    use JobSeekerPackageTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $clientId = $paypal_conf['client_id'];
        $clientSecret = $paypal_conf['secret'];
    }
    /**
     * This is the page where you have to display your payment page
     *
     * @return \Illuminate\Http\Response
     */
    public function payWithPaypal()
    {
        return view('order.pay_with_credit_card');
        // Paste smart button code in this view
    }
    /**
     * Your business logic will come here
     * Order will be created in this function and then paypal window will open for authentication
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPaymentWithpaypal($userId, $packageId, $paymentFor)
    {
        $package_id= $packageId;

        if($package_id==''){
            flash(__('Please select one package'))->error();

            return redirect()->route('employer_packages_list', ['id'=>$userId]);
        }
        $package = Package::findOrFail($package_id);


        $order_amount = $package->package_price;

        if($paymentFor=='upgrade'){
            $exitingPackage=null;
            $user = auth()->user();
            $prorated_amount=0;
            if($user->package_id){
                $exitingPackage = Package::findOrFail($user->package_id);

                $now = time();
                $startDate = strtotime($user->package_start_date);
                $endDate = strtotime($user->package_end_date);
                $datediff = 0;
                if ($endDate>$now){
                    $datediff = $now - $startDate;
                }
                $diffDay = round($datediff / (60 * 60 * 24));
                $usedAmount =$diffDay>0?number_format(($exitingPackage->package_price/$exitingPackage->package_num_days)*$diffDay,'2','.',''):0;
                $prorated_amount = $endDate>$now?$exitingPackage->package_price-$usedAmount:0;
            }

            $package_id= $packageId;
            if($package_id==''){
                flash(__('Please select one package'))->error();

                return Redirect::route('employee.packages.list');
            }
            $package = Package::findOrFail($package_id);

            $order_amount = $package->package_price-$prorated_amount;
        }

        if($order_amount>0){

//        $paypal_conf = \Config::get('paypal');
            $clientId = env('PAYPAL_CLIENT_ID');
            $clientSecret = env('PAYPAL_SECRET');
            $environment = new SandboxEnvironment($clientId, $clientSecret);
            $client = new PayPalHttpClient($environment);
            $request = new OrdersCreateRequest();
            $request->prefer('return=representation');
            $request->body = [
                "intent" => "CAPTURE",
                "purchase_units" => [[
                    "reference_id" => time().'_'.$package->id.'_'.$paymentFor.'_'.$userId,
                    "amount" => [
                        "value" => number_format($order_amount,2,'.',''),
                        "currency_code" => "USD"
                        //put other details here as well related to your order
                    ]
                ]],
                "application_context" => [
                    "cancel_url" => "http://yourproject.com/paypalreturn",
                    "return_url" => "http://yourproject.com/paypalcancel"
                ]
            ];
            try {
                // Call API with your client and get a response for your call

//            Session::put('package_id', $package->id);
                $response = $client->execute($request);
                // If call returns body in response, you can get the deserialized version from the result attribute of the response
                echo json_encode($response); die;
            }catch (HttpException $ex) {
                echo $ex->statusCode;
                //echo json_encode($ex->getMessage());
            }
        }

        echo json_encode(array('status'=>'503','message'=>'This amount is not sufficient')); die;
    }
    /**
     * After successful paypal authentication from paypal window, paypal will call this function to capture the order
     *
     * @param   $orderID
     * @return \Illuminate\Http\Response
     */
    public function capturePaymentWithpaypal(Request $request, $orderID)
    {

        $clientId = env('PAYPAL_CLIENT_ID');
        $clientSecret = env('PAYPAL_SECRET');
        $environment = new SandboxEnvironment($clientId, $clientSecret);
        $client = new PayPalHttpClient($environment);
        // Here, OrdersCaptureRequest() creates a POST request to /v2/checkout/orders
        // $response->result->id gives the orderId of the order created above
        $request = new OrdersCaptureRequest($orderID);
        $request->prefer('return=representation');
        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($request);

            if($response->result->status=='COMPLETED'){

               $this->paymentHistorySave($response->result);

            }

            // If call returns body in response, you can get the deserialized version from the result attribute of the response
//            $response['package_id']=$package_id;
            echo json_encode($response); die;
        }catch (HttpException $ex) {
            echo $ex->statusCode; die;
            //print_r($ex->getMessage());
        }
    }

    private function paymentHistorySave($result)
    {
        $referenceId = isset($result->purchase_units) && isset($result->purchase_units[0]->reference_id)? $result->purchase_units[0]->reference_id:"";
        $referenceIdExplode = explode('_', $referenceId);
        $package_id= $referenceIdExplode[1];
        $paymentFor= $referenceIdExplode[2];
        $userId= $referenceIdExplode[3];

        if (Auth::check()) {
            $user = Auth::user();
        }else{
            if($userId){
                $user = User::find($userId);
            }
        }

        $package=null;
        if($package_id){
            $package = Package::findOrFail($package_id);
        }

        if($paymentFor=='new'){
            $this->addJobSeekerPackage($user, $package);
            $user->sendEmailVerificationNotification();
        }elseif ($paymentFor=='renew'){
            $this->renewJobSeekerPackage($user, $package);
        }elseif ($paymentFor=='upgrade'){
            $subUsers = DB::table('users')->where('user_type', 'sub_account')->where('parent_id', auth()->user()->id)->get();

            if($subUsers && $package->package_num_listings<count($subUsers)+1){
                foreach ($subUsers as $value){
                    $subUser = User::find($value->id);
                    $subUser->is_active=0;
                    $subUser->update();
                }
                flash(__('Your sub accounts has been inactive.'))->success();
            }


            $this->updateJobSeekerPackage($user, $package);
        }


        $payerInfoEmail=isset($result->payer) && isset($result->payer->email_address)?$result->payer->email_address:null;
        $payerInfoFirstName=isset($result->payer) && isset($result->payer->name) && isset($result->payer->name->given_name)?$result->payer->name->given_name:null;
        $payerInfoLastName=isset($result->payer) && isset($result->payer->name) && isset($result->payer->name->surname)?$result->payer->name->surname:null;
        $payerInfoCountryCode = isset($result->payer) && isset($result->payer->address) && isset($result->payer->address->country_code)?$result->payer->address->country_code:null;
        $payerInfoId = isset($result->payer) && isset($result->payer->payer_id)?$result->payer->payer_id:null;

        $paymentMethod = isset($result->intent)?$result->intent:null;

        $paymentCurrency = isset($result->purchase_units) && isset($result->purchase_units[0]->amount->currency_code)? $result->purchase_units[0]->amount->currency_code:"USD";
        $paymentTotalAmount = isset($result->purchase_units) && isset($result->purchase_units[0]->amount->value)? $result->purchase_units[0]->amount->value:0;

        $paymentId = isset($result->id)?$result->id:null;
        $paymentDate = isset($result->create_time)?$result->create_time:null;

        $paymentTransactionHistory = new PaymentTransactionHistory();

        $paymentTransactionHistory->user_id=$user->id;
        $paymentTransactionHistory->payment_id=$paymentId;
        $paymentTransactionHistory->payer_id=$payerInfoId?$payerInfoId:null;
        $paymentTransactionHistory->payer_email=$payerInfoEmail?$payerInfoEmail:null;
        $paymentTransactionHistory->payer_first_name=$payerInfoFirstName?$payerInfoFirstName:null;
        $paymentTransactionHistory->payer_last_name=$payerInfoLastName?$payerInfoLastName:null;
        $paymentTransactionHistory->payer_country_code=$payerInfoCountryCode?$payerInfoCountryCode:null;
        $paymentTransactionHistory->total_amount=$paymentTotalAmount?$paymentTotalAmount:0;
        $paymentTransactionHistory->currency=$paymentCurrency?$paymentCurrency:"USD";
        $paymentTransactionHistory->payment_method=$paymentMethod?$paymentMethod:"paypal";
        $paymentTransactionHistory->payment_description=$referenceId?$referenceId:null;
        $paymentTransactionHistory->payment_for=$paymentFor?$paymentFor:null;
        $paymentTransactionHistory->package_id=$package?$package->id:null;
        $paymentTransactionHistory->package_start_date=$user->package_start_date?$user->package_start_date:null;
        $paymentTransactionHistory->package_end_date=$user->package_end_date?$user->package_end_date:null;
        $paymentTransactionHistory->created_at=new \DateTime(date('Y-m-d H:i:s', strtotime($paymentDate)));
        $paymentTransactionHistory->save();


    }
}