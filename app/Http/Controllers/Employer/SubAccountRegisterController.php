<?php

namespace App\Http\Controllers\Employer;

use App\Country;
use App\Http\Controllers\Controller;
use App\State;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Jrean\UserVerification\Traits\VerifiesUsers;

class SubAccountRegisterController extends Controller
{
    use RegistersUsers;
    use VerifiesUsers;

    public function manageAccess()
    {
        $user = Auth::user();
        $userId=$user->id;
        $userType=$user->user_type;

        if($userType!='employer'){
            flash(__('Permission Denied!'))->error();

            return redirect()->route('home');
        }


        $subUsers = DB::table('users')->where('parent_id', $userId)->get();
        $country = Country::where('country', 'Canada')->first();
        $states = State::where('is_active',1)->where('country_id', $country->id)->orderBy('state', 'ASC')->get();
        $jobSeekerSearchSave = DB::table('jobseeker_search_save')->where('user_id',auth()->user()->id)->get();
        $saveSearchCount = $jobSeekerSearchSave->count();
        $saveprofileCount = DB::table('favourite_jobseeker')->where('user_id',auth()->user()->id)->get();
        $countSaveProfile = $saveprofileCount->count();
        return view('user.manage-access.index')
            ->with('subUsers', $subUsers)
            ->with('country', $country)
            ->with('saveSearchCount', $saveSearchCount)
            ->with('countSaveProfile', $countSaveProfile)
            ->with('states', $states);
    }

    public function addAccount(Request $request)
    {
        $rules = [
            'first_name' => 'required|max:80',
            'last_name' => 'required|max:80',
            'email' => 'required|unique:users,email|email|max:100',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'postal_code' => 'required|max:100',
            //'g-recaptcha-response' => 'required',
        ];

        $customMessages = [
            'first_name.required' => __('First Name is required.'),
            'last_name.required' => __('Last Name is required.'),
            'email.required' => __('Email is required.'),
            'email.email' => __('Email must be a valid email address.'),
            'email.unique' => __('This Email has already been taken.'),
            'country.required' => __('Country is required.'),
            'city.required' => __('City is required.'),
            'state.required' => __('Province is required.'),
            'postal_code.required' => __('Postal Code is required.'),
            //'g-recaptcha-response.required' => __('Recaptcha is required.'),
        ];

        $this->validate($request, $rules, $customMessages);

        $authUser = Auth::user();
        $userId=$authUser->id;
        $userType=$authUser->user_type;

        if($userType!='employer'){
            flash(__('Permission Denied!'))->error();

            return redirect()->route('home');
        }


        $subUsers = DB::table('users')->where('parent_id', $userId)->count('users.id');


        if (Auth::check() && $subUsers<3 && ( $authUser->package_end_date && date("Y-m-d H:i:s", strtotime($authUser->package_end_date))>date("Y-m-d H:i:s"))) {
            $user = new User();
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->country_id = $request->input('country');
            $user->state_id = $request->input('state');
            $user->city_id = $request->input('city');
            $user->postal_code = $request->input('postal_code');
            $user->user_type = $request->input('candidate_or_employer');
            $user->email_verified_at = new \DateTime('now');
            $user->is_active = $subUsers<(int)$authUser->jobs_quota-1?1:0;
            $user->verified=1;
            $user->is_accept_terms=1;
            $user->current_status = 'pending_for_user_confirmation';

            $user->parent_id = auth()->id();
            $user->save();
            $user->name = $user->getName();
            $user->update();

            $token = Password::getRepository()->create($user);
            $user->sendPasswordResetNotification($token);
            return redirect()->route('manageAccess');
        }

    }

    public function checkEmail(Request $request){
        $email = $request->input('email');
        $isExists = User::where('email',$email)->first();
        if($isExists){
            return response()->json(array("exists" => true));
        }else{
            return response()->json(array("exists" => false));
        }
    }
    public function activeUser(Request $request)
    {
        $authUser = Auth::user();
        $userId = $authUser->id;
        $subUsers = DB::table('users')->where('is_active', 1)->where('parent_id', $userId)->count('users.id');
        $status = $request->request->get('status');
        $id = $request->request->get('id');
        $user = User::find($id);
        $returnArray=[];
        if (Auth::check() && $subUsers < (int)$authUser->jobs_quota - 1 && $status=='inactive') {
            $user->is_active = 1;
            $returnArray = ['status'=>200,'account_status'=>'active','message'=>'This user has been successfully activated'];
        }elseif (Auth::check() && $subUsers >= (int)$authUser->jobs_quota - 1 && $status=='inactive') {
            $returnArray = ['status'=>503,'message'=>'You are trying to activated more users than your current package allows.'];
        }else{
            $user->is_active = 0;
            $returnArray = ['status'=>200,'account_status'=>'inactive','message'=>'This user has been successfully inactivated'];
        }
            $user->update();
            return new JsonResponse($returnArray);

    }


    public function deleteSubAccount($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('manageAccess');
    }
}
