<?php

namespace App\Http\Controllers;

use App\Helpers\PaypalOrder;
use App\PaymentTransactionHistory;
use Auth;
use App\Http\Requests;
use http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use Config;
use App\Package;
use App\User;
use Carbon\Carbon;
use Cake\Chronos\Chronos;
use App\Traits\CompanyPackageTrait;
use App\Traits\JobSeekerPackageTrait;
/** All Paypal Details class * */
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaypalOrderController extends Controller
{

    use CompanyPackageTrait;
    use JobSeekerPackageTrait;

    private $_api_context;
    private $redirectTo = 'home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /** setup PayPal api context * */
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);

        /*         * ****************************************** */
        $this->middleware(function ($request, $next) {
            if (Auth::guard('company')->check()) {
                $this->redirectTo = 'company.home';
            }
            return $next($request);
        });
        /*         * ****************************************** */
    }

    public function employeePackagesByNoOfUserAndFreeForMonth(Request $request){

        $noOfUsers = $request->get('noOfUsers');
        $freeForMonth = $request->get('freeForMonth');
        $paymentFor = $request->get('paymentFor');
        $now = Carbon::now();

        $packages = Package::where('package_for','employer')
            ->where('package_price','>','0')
            ->where('package_num_listings','=',$noOfUsers)
            ->where('package_num_days','=',$freeForMonth)->first();
//        dd($packages);
        $startDate=$now;
        if($paymentFor=='renew'){
            $authUser = auth()->user();
            $startDate=$authUser->package_end_date&&$authUser->package_end_date>$now?$authUser->package_end_date:$now;

        }

        $package_effective_date = $startDate->format('M d, Y');

        $package_expired_date= $startDate->addDays($packages->package_num_days)->format('M d, Y');
        if($packages){
            return new JsonResponse(array('status'=>200,'package_id'=>$packages->id,'package_title'=>$packages->package_title,'package_amount'=>$packages->package_price,'package_num_days'=>$packages->package_num_days,'package_effective_date'=>$package_effective_date,'package_expired_date'=>$package_expired_date));
        }
        return new JsonResponse(array('status'=>404));

    }

    public function employeePackages(){
        if (!Auth::check()) {
            return redirect('login');
        }
        $authUser = Auth::user();
        $userType=$authUser->user_type;

        if($userType!='employer'){
            flash(__('Permission Denied!'))->error();

            return redirect()->route('home');
        }
        $package=null;
        $user = auth()->user();
        if($user->package_id && $user->package_id>0){
            $package = Package::findOrFail($user->package_id);
        }
        $packages = Package::where('package_for','employer')->where('package_price','>','0')->get();
        $paymentHistory = PaymentTransactionHistory::join('packages', 'packages.id', '=', 'payment_transactions_history.package_id')
            ->where('user_id',$user->id)->orderBy('payment_transactions_history.created_at','desc')->get();

        $subUsers = DB::table('users')->where('parent_id', $user->id)->count('users.id');

        return view('order.pay_with_paypal')
            ->with('packages', $packages)
            ->with('package', $package)
            ->with('user', $user)
            ->with('paymentHistory', $paymentHistory)
            ->with('subUsers', $subUsers)
            ;
    }

    /**
     * Store a details of payment with paypal.
     *
     * @param IlluminateHttpRequest $request
     * @return IlluminateHttpResponse
     */
    public function orderPackage(Request $request, $userId)
    {
        $package_id= $request->package_id;

        if($package_id==''){
            flash(__('Please select one package'))->error();

            return redirect()->route('employer_packages_list', ['id'=>$userId]);
        }

        $package = Package::findOrFail($package_id);

        $order_amount = $package->package_price;

        /*         * ************************ */
        $buyer_id = '';
        $buyer_name = '';
        if (Auth::guard('company')->check()) {
            $buyer_id = Auth::guard('company')->user()->id;
            $buyer_name = Auth::guard('company')->user()->name . '(' . Auth::guard('company')->user()->email . ')';
        }
        if (Auth::check()) {
            $buyer_id = Auth::user()->id;
            $buyer_name = Auth::user()->getName() . '(' . Auth::user()->email . ')';
        }
        $package_for = ($package->package_for == 'employer') ? __('Employer') : __('Job Seeker');
        $description = $package_for . ' ' . $buyer_name . ' - ' . $buyer_id . ' ' . __('Package') . ':' . $package->package_title;
        /*         * ************************ */

        $payer = new Payer();
        /*         * ************************ */
        $payer->setPaymentMethod('paypal');
        /*         * ************************ */
        $item_1 = new Item();
        $item_1->setName($package_for . ' ' . __('Package') . ' : ' . $package->package_title) /** item name * */
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($order_amount);/** unit price * */
        /*         * ************************ */
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
                ->setTotal($order_amount);
        /*         * ************************ */
        $transaction = new Transaction();
        $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription($description);
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('paypal.payment.status', ['id'=>$package_id,'userId'=>$userId])) /** Specify return URL * */
                ->setCancelUrl(URL::route('paypal.payment.status', ['id'=>$package_id,'userId'=>$userId]));
        $payment = new Payment();
        $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; * */
        try {
            $payment->create($this->_api_context);
        } catch (PayPalExceptionPPConnectionException $ex) {
            if (Config::get('app.debug')) {
                flash('Connection timeout');
                return Redirect::route($this->redirectTo);
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; * */
                /** $err_data = json_decode($ex->getData(), true); * */
                /** exit; * */
            } else {
                flash(__('Some error occur, sorry for inconvenient'));
                return Redirect::route($this->redirectTo);
                /** die('Some error occur, sorry for inconvenient'); * */
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session * */
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal * */
            return Redirect::away($redirect_url);
        }
        flash(__('Unknown error occurred'));
        return Redirect::route($this->redirectTo);
    }

    public function getPaymentStatus(Request $request, $package_id, $userId )
    {
        $package = Package::findOrFail($package_id);
        /*         * ******************************************* */

        /** Get the payment ID before session clear * */
        $payment_id = $request->get('paymentId'); //Session::get('paypal_payment_id');
        /** clear the session payment ID * */
        Session::forget('paypal_payment_id');
        if (empty($request->get('PayerID')) || empty($request->get('token'))) {
            flash(__('Subscription failed'));
            return Redirect::route($this->redirectTo);
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary * */
        /** to execute a PayPal account payment. * */
        /** The payer_id is added to the request query parameters * */
        /** when the user is redirected from paypal back to your site * */
        $execution = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));
        /*         * Execute the payment * */
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later * */
        if ($result->getState() == 'approved') {
            /** it's all right * */
            /** Here Write your database logic like that insert record or value in database if you want * */
            if (Auth::guard('company')->check()) {
                $company = Auth::guard('company')->user();
                if($package->package_for=='cv_search'){
                    $this->addCompanySearchPackage($company, $package);
                }else{
                    $this->addCompanyPackage($company, $package);
                }

            }
            if (Auth::check()) {
                $user = Auth::user();
                $this->addJobSeekerPackage($user, $package);
            }else{
                if($userId){
                    $user = User::find($userId);
                    $this->addJobSeekerPackage($user, $package);
                    $user->sendEmailVerificationNotification();
                    $this->paymentHistorySave($result, $package, $user);
                    flash(__('You have successfully subscribed to selected package'))->success();
                    return redirect()->route('confirmation_page', ['id'=>$userId]);
                }
            }

            flash(__('You have successfully subscribed to selected package'))->success();
            return Redirect::route($this->redirectTo);
        }
        flash(__('Subscription failed'));
        return Redirect::route($this->redirectTo);
    }

    public function orderRenewPackage(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $package_id= $request->package_id;
        if($package_id==''){
            flash(__('Please select one package'))->error();

            return Redirect::route('employee.packages.list');
        }
        $package = Package::findOrFail($package_id);

        $order_amount = $package->package_price;

        /*         * ************************ */
        $buyer_id = '';
        $buyer_name = '';
        if (Auth::guard('company')->check()) {
            $buyer_id = Auth::guard('company')->user()->id;
            $buyer_name = Auth::guard('company')->user()->name . '(' . Auth::guard('company')->user()->email . ')';
        }
        if (Auth::check()) {
            $buyer_id = Auth::user()->id;
            $buyer_name = Auth::user()->getName() . '(' . Auth::user()->email . ')';
        }
        /*         * ************************* */

        $package_for = ($package->package_for == 'employer') ? __('Employer') : __('Job Seeker');
        $description = $package_for . ' ' . $buyer_name . ' - ' . $buyer_id . ' ' . __('Upgrade Package') . ':' . $package->package_title;
        /*         * ************************ */

        $payer = new Payer();
        /*         * ************************ */
        $payer->setPaymentMethod('paypal');
        /*         * ************************ */
        $item_1 = new Item();
        $item_1->setName($package_for . ' ' . __('Renew Package') . ' : ' . $package->package_title) /** item name * */
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($order_amount);/** unit price * */
        /*         * ************************ */
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
                ->setTotal($order_amount);
        /*         * ************************ */
        $transaction = new Transaction();
        $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription($description);
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('paypal.renew.payment.status', $package_id)) /** Specify return URL * */
                ->setCancelUrl(URL::route('paypal.renew.payment.status', $package_id));
        $payment = new Payment();
        $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; * */
        try {
            $payment->create($this->_api_context);
        } catch (PayPalExceptionPPConnectionException $ex) {
            if (Config::get('app.debug')) {
                flash('Connection timeout');
                return Redirect::route($this->redirectTo);
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; * */
                /** $err_data = json_decode($ex->getData(), true); * */
                /** exit; * */
            } else {
                flash(__('Some error occur, sorry for inconvenient'));
                return Redirect::route($this->redirectTo);
                /** die('Some error occur, sorry for inconvenient'); * */
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session * */
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal * */
            return Redirect::away($redirect_url);
        }
        flash(__('Unknown error occurred'));
        return Redirect::route($this->redirectTo);
    }

    public function getRenewPaymentStatus(Request $request, $package_id)
    {

        $package = Package::findOrFail($package_id);

        /** Get the payment ID before session clear * */
        $payment_id = $request->get('paymentId'); //Session::get('paypal_payment_id');
        /** clear the session payment ID * */
        Session::forget('paypal_payment_id');
        if (empty($request->get('PayerID')) || empty($request->get('token'))) {
            flash(__('Subscription failed'));
            return Redirect::route($this->redirectTo);
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary * */
        /** to execute a PayPal account payment. * */
        /** The payer_id is added to the request query parameters * */
        /** when the user is redirected from paypal back to your site * */
        $execution = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));
        /*         * Execute the payment * */
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later * */
        if ($result->getState() == 'approved') {
            /** it's all right * */
            /** Here Write your database logic like that insert record or value in database if you want * */
            if (Auth::guard('company')->check()) {
                $company = Auth::guard('company')->user();
                if($package->package_for=='cv_search'){
                    $this->updateCompanySearchPackage($company, $package);
                }else{
                    $this->updateCompanyPackage($company, $package);
                }
                
            }
            if (Auth::check()) {
                $user = Auth::user();
                $this->renewJobSeekerPackage($user, $package);
                $this->paymentHistorySave($result, $package, $user);
            }

            flash(__('You have successfully subscribed to selected package'))->success();
            return Redirect::route($this->redirectTo);
        }
        flash(__('Subscription failed'));
        return Redirect::route($this->redirectTo);
    }

    public function orderUpgradePackage(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }
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

        $package_id= $request->package_id;
        if($package_id==''){
            flash(__('Please select one package'))->error();

            return Redirect::route('employee.packages.list');
        }
        $package = Package::findOrFail($package_id);

        $order_amount = $package->package_price-$prorated_amount;

        /*         * ************************ */
        $buyer_id = '';
        $buyer_name = '';
        if (Auth::guard('company')->check()) {
            $buyer_id = Auth::guard('company')->user()->id;
            $buyer_name = Auth::guard('company')->user()->name . '(' . Auth::guard('company')->user()->email . ')';
        }
        if (Auth::check()) {
            $buyer_id = Auth::user()->id;
            $buyer_name = Auth::user()->getName() . '(' . Auth::user()->email . ')';
        }
        /*         * ************************* */

        $package_for = ($package->package_for == 'employer') ? __('Employer') : __('Job Seeker');
        $description = $package_for . ' ' . $buyer_name . ' - ' . $buyer_id . ' ' . __('Upgrade Package') . ':' . $package->package_title;
        /*         * ************************ */

        $payer = new Payer();
        /*         * ************************ */
        $payer->setPaymentMethod('paypal');
        /*         * ************************ */
        $item_1 = new Item();
        $item_1->setName($package_for . ' ' . __('Upgrade Package') . ' : ' . $package->package_title) /** item name * */
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($order_amount);/** unit price * */
        /*         * ************************ */
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
                ->setTotal($order_amount);
        /*         * ************************ */
        $transaction = new Transaction();
        $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription($description);
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('paypal.upgrade.payment.status', $package_id)) /** Specify return URL * */
                ->setCancelUrl(URL::route('paypal.upgrade.payment.status', $package_id));
        $payment = new Payment();
        $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; * */
        try {
            $payment->create($this->_api_context);
        } catch (PayPalExceptionPPConnectionException $ex) {
            if (Config::get('app.debug')) {
                flash('Connection timeout');
                return Redirect::route($this->redirectTo);
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; * */
                /** $err_data = json_decode($ex->getData(), true); * */
                /** exit; * */
            } else {
                flash(__('Some error occur, sorry for inconvenient'));
                return Redirect::route($this->redirectTo);
                /** die('Some error occur, sorry for inconvenient'); * */
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session * */
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal * */
            return Redirect::away($redirect_url);
        }
        flash(__('Unknown error occurred'));
        return Redirect::route($this->redirectTo);
    }

    public function getUpgradePaymentStatus(Request $request, $package_id)
    {

        $package = Package::findOrFail($package_id);

        /** Get the payment ID before session clear * */
        $payment_id = $request->get('paymentId'); //Session::get('paypal_payment_id');
        /** clear the session payment ID * */
        Session::forget('paypal_payment_id');
        if (empty($request->get('PayerID')) || empty($request->get('token'))) {
            flash(__('Subscription failed'));
            return Redirect::route($this->redirectTo);
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary * */
        /** to execute a PayPal account payment. * */
        /** The payer_id is added to the request query parameters * */
        /** when the user is redirected from paypal back to your site * */
        $execution = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));
        /*         * Execute the payment * */
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later * */
        if ($result->getState() == 'approved') {
            /** it's all right * */
            /** Here Write your database logic like that insert record or value in database if you want * */
            if (Auth::guard('company')->check()) {
                $company = Auth::guard('company')->user();
                if($package->package_for=='cv_search'){
                    $this->updateCompanySearchPackage($company, $package);
                }else{
                    $this->updateCompanyPackage($company, $package);
                }

            }
            if (Auth::check()) {
                $user = Auth::user();
                $this->updateJobSeekerPackage($user, $package);
                $this->paymentHistorySave($result, $package, $user);
            }

            flash(__('You have successfully subscribed to selected package'))->success();
            return Redirect::route($this->redirectTo);
        }
        flash(__('Subscription failed'));
        return Redirect::route($this->redirectTo);
    }


    
    public function orderFreePackage(Request $request, $package_id)
    {
        $package = Package::findOrFail($package_id);
        /*         * ******************************************* */
            /** it's all right * */
            /** Here Write your database logic like that insert record or value in database if you want * */
            if (Auth::guard('company')->check()) {
                $company = Auth::guard('company')->user();
                if($package->package_for=='cv_search'){
                    $this->addCompanySearchPackage($company, $package);
                }else{
                    $this->addCompanyPackage($company, $package);
                }
            }
            if (Auth::check()) {
                $user = Auth::user();
                $this->addJobSeekerPackage($user, $package);
            }

            flash(__('You have successfully subscribed to selected package'))->success();
            return Redirect::route($this->redirectTo);
    }


    private function paymentHistorySave(Payment $result, $package, $user)
    {
        $payerInfoEmail=$result->getPayer() && $result->getPayer()->getPayerInfo()?$result->getPayer()->getPayerInfo()->getEmail():null;
        $payerInfoFirstName = $result->getPayer() && $result->getPayer()->getPayerInfo()?$result->getPayer()->getPayerInfo()->getFirstName():null;
        $payerInfoLastName = $result->getPayer() && $result->getPayer()->getPayerInfo()?$result->getPayer()->getPayerInfo()->getLastName():null;
        $payerInfoCountryCode = $result->getPayer() && $result->getPayer()->getPayerInfo()?$result->getPayer()->getPayerInfo()->getCountryCode():null;
        $payerInfoId = $result->getPayer() && $result->getPayer()->getPayerInfo()?$result->getPayer()->getPayerInfo()->getPayerId():null;

        $paymentMethod = $result->getPayer()->getPaymentMethod();

        $paymentCurrency = $result->getTransactions()[0]->getAmount()->getCurrency();
        $paymentTotalAmount = $result->getTransactions()[0]->getAmount()->getTotal();
        $paymentDescription = $result->getTransactions()[0]->getDescription();

        $paymentId = $result->getId();
        $paymentDate = $result->getCreateTime();

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
        $paymentTransactionHistory->payment_description=$paymentDescription?$paymentDescription:"paypal";
        $paymentTransactionHistory->package_id=$package?$package->id:null;
        $paymentTransactionHistory->package_start_date=$user->package_start_date?$user->package_start_date:null;
        $paymentTransactionHistory->package_end_date=$user->package_end_date?$user->package_end_date:null;
        $paymentTransactionHistory->created_at=new \DateTime(date('Y-m-d H:i:s', strtotime($paymentDate)));
        $paymentTransactionHistory->save();
    }

}
