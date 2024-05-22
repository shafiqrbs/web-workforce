<?php

namespace App\Http\Controllers\Admin;

use App\DeletedUser;
use App\PaymentTransactionHistory;
use File;
use Illuminate\Http\JsonResponse;
use ImgUploader;
use Auth;
use DB;
use Input;
use Carbon\Carbon;
use Redirect;
use App\User;
use App\Gender;
use App\MaritalStatus;
use App\Country;
use App\State;
use App\City;
use App\JobExperience;
use App\CareerLevel;
use App\Industry;
use App\FunctionalArea;
use App\ProfileSummary;
use App\ProfileProject;
use App\ProfileExperience;
use App\ProfileEducation;
use App\ProfileSkill;
use App\ProfileLanguage;
use App\Package;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\ProfileProjectFormRequest;
use App\Http\Requests\ProfileProjectImageFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Traits\CommonUserFunctions;
use App\Traits\ProfileSummaryTrait;
use App\Traits\ProfileCvsTrait;
use App\Traits\ProfileProjectsTrait;
use App\Traits\ProfileExperienceTrait;
use App\Traits\ProfileEducationTrait;
use App\Traits\ProfileSkillTrait;
use App\Traits\ProfileLanguageTrait;
use App\Traits\Skills;
use App\Traits\JobSeekerPackageTrait;
use App\Helpers\DataArrayHelper;

class EmployerController extends Controller
{

    use CommonUserFunctions;
    use ProfileSummaryTrait;
    use ProfileCvsTrait;
    use ProfileProjectsTrait;
    use ProfileExperienceTrait;
    use ProfileEducationTrait;
    use ProfileSkillTrait;
    use ProfileLanguageTrait;
    use Skills;
    use JobSeekerPackageTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUsers()
    {
        return view('admin.employer.index');
    }

    public function createUser()
    {
        $genders = DataArrayHelper::defaultGendersArray();
        $maritalStatuses = DataArrayHelper::defaultMaritalStatusesArray();
        $nationalities = DataArrayHelper::defaultNationalitiesArray();
        $countries = DataArrayHelper::defaultCountriesArray();
        $jobExperiences = DataArrayHelper::defaultJobExperiencesArray();
        $careerLevels = DataArrayHelper::defaultCareerLevelsArray();
        $industries = DataArrayHelper::defaultIndustriesArray();
        $functionalAreas = DataArrayHelper::defaultFunctionalAreasArray();
        $packages = Package::select('id', DB::raw("CONCAT(`package_title`, ', $', `package_price`, ', Days:', `package_num_days`, ', Listings:', `package_num_listings`) AS package_detail"))->where('package_for', 'like', 'job_seeker')->pluck('package_detail', 'id')->toArray();
        $upload_max_filesize = UploadedFile::getMaxFilesize() / (1048576);

        return view('admin.user.add')
                        ->with('genders', $genders)
                        ->with('maritalStatuses', $maritalStatuses)
                        ->with('nationalities', $nationalities)
                        ->with('countries', $countries)
                        ->with('jobExperiences', $jobExperiences)
                        ->with('careerLevels', $careerLevels)
                        ->with('industries', $industries)
                        ->with('functionalAreas', $functionalAreas)
                        ->with('upload_max_filesize', $upload_max_filesize)
                        ->with('packages', $packages);
    }

    public function storeUser(UserFormRequest $request)
    {
        $user = new User();
        /*         * **************************************** */
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = ImgUploader::UploadImage('user_images', $image, $request->input('name'), 300, 300, false);
            $user->image = $fileName;
        }
        /*         * ************************************** */
        $user->first_name = $request->input('first_name');
        $user->middle_name = $request->input('middle_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->father_name = $request->input('father_name');
        $user->date_of_birth = $request->input('date_of_birth');
        $user->gender_id = $request->input('gender_id');
        $user->marital_status_id = $request->input('marital_status_id');
        $user->nationality_id = $request->input('nationality_id');
        $user->national_id_card_number = $request->input('national_id_card_number');
        $user->country_id = $request->input('country_id');
        $user->state_id = $request->input('state_id');
        $user->city_id = $request->input('city_id');
        $user->phone = $request->input('phone');
        $user->mobile_num = $request->input('mobile_num');
        $user->job_experience_id = $request->input('job_experience_id');
        $user->career_level_id = $request->input('career_level_id');
        $user->industry_id = $request->input('industry_id');
        $user->functional_area_id = $request->input('functional_area_id');
        $user->current_salary = $request->input('current_salary');
        $user->expected_salary = $request->input('expected_salary');
        $user->salary_currency = $request->input('salary_currency');
        $user->street_address = $request->input('street_address');
        $user->is_immediate_available = $request->input('is_immediate_available');
        $user->is_active = $request->input('is_active');
        $user->verified = $request->input('verified');
        $user->save();

        /*         * *********************** */
        $user->name = $user->getName();
        $user->update();
        $this->updateUserFullTextSearch($user);
        /*         * *********************** */
        /*         * ************************************ */
        if ($request->has('job_seeker_package_id') && $request->input('job_seeker_package_id') > 0) {
            $package_id = $request->input('job_seeker_package_id');
            $package = Package::find($package_id);
            $this->addJobSeekerPackage($user, $package);
        }
        /*         * ************************************ */

        flash('User has been added!')->success();
        return \Redirect::route('edit.user', array($user->id));
    }

    public function editUser($id)
    {
        $genders = Gender::get();
        $maritalStatuses = DataArrayHelper::defaultMaritalStatusesArray();
        $nationalities = DataArrayHelper::defaultNationalitiesArray();
        $countries = DataArrayHelper::defaultCountriesArray();
        $jobExperiences = DataArrayHelper::defaultJobExperiencesArray();
        $careerLevels = DataArrayHelper::defaultCareerLevelsArray();
        $industries = DataArrayHelper::defaultIndustriesArray();
        $functionalAreas = DataArrayHelper::defaultFunctionalAreasArray();

        $upload_max_filesize = UploadedFile::getMaxFilesize() / (1048576);
        $user = User::findOrFail($id);
        if ($user->package_id > 0) {
            $package = Package::find($user->package_id);
            $packages = Package::select('id', DB::raw("CONCAT(`package_title`, ', $', `package_price`, ', Days:', `package_num_days`, ', Listings:', `package_num_listings`) AS package_detail"))->where('package_for', 'like', 'job_seeker')->where('id', '<>', $user->package_id)->where('package_price', '>=', $package->package_price)->pluck('package_detail', 'id')->toArray();
        } else {
            $packages = Package::select('id', DB::raw("CONCAT(`package_title`, ', $', `package_price`, ', Days:', `package_num_days`, ', Listings:', `package_num_listings`) AS package_detail"))->where('package_for', 'like', 'job_seeker')->pluck('package_detail', 'id')->toArray();
        }

//        dd($genders);
        return view('admin.user.edit')
                        ->with('genders', $genders)
                        ->with('maritalStatuses', $maritalStatuses)
                        ->with('nationalities', $nationalities)
                        ->with('countries', $countries)
                        ->with('jobExperiences', $jobExperiences)
                        ->with('careerLevels', $careerLevels)
                        ->with('industries', $industries)
                        ->with('functionalAreas', $functionalAreas)
                        ->with('user', $user)
                        ->with('upload_max_filesize', $upload_max_filesize)
                        ->with('packages', $packages);
    }

    public function updateUser(Request $request)
    {
        dd($request->all());
    }

//    public function updateUser($id, UserFormRequest $request)
//    {
//        return back()->withInput();
//        $user = User::findOrFail($id);
//        /*         * **************************************** */
//        if ($request->hasFile('image')) {
//            $is_deleted = $this->deleteUserImage($user->id);
//            $image = $request->file('image');
//            $fileName = ImgUploader::UploadImage('user_images', $image, $request->input('name'), 300, 300, false);
//            $user->image = $fileName;
//        }
//
//		if ($request->hasFile('cover_image')) {
//			$is_deleted = $this->deleteUserCoverImage($user->id);
//            $cover_image = $request->file('cover_image');
//            $fileName_cover_image = ImgUploader::UploadImage('user_images', $cover_image, $request->input('name'), 1140, 250, false);
//            $user->cover_image = $fileName_cover_image;
//        }
//
//        /*         * ************************************** */
//        $user->first_name = $request->input('first_name');
////        $user->middle_name = $request->input('middle_name');
//        $user->last_name = $request->input('last_name');
//        /*         * *********************** */
//        $user->name = $user->getName();
//        /*         * *********************** */
//        $user->email = $request->input('email');
////        if (!empty($request->input('password'))) {
////            $user->password = Hash::make($request->input('password'));
////        }
////        $user->father_name = $request->input('father_name');
////        $user->date_of_birth = $request->input('date_of_birth');
////        $user->gender_id = $request->input('gender_id');
////        $user->marital_status_id = $request->input('marital_status_id');
////        $user->nationality_id = $request->input('nationality_id');
////        $user->national_id_card_number = $request->input('national_id_card_number');
////        $user->country_id = $request->input('country_id');
////        $user->state_id = $request->input('state_id');
////        $user->city_id = $request->input('city_id');
////        $user->phone = $request->input('phone');
////        $user->mobile_num = $request->input('mobile_num');
////        $user->job_experience_id = $request->input('job_experience_id');
////        $user->career_level_id = $request->input('career_level_id');
////        $user->industry_id = $request->input('industry_id');
////        $user->functional_area_id = $request->input('functional_area_id');
////        $user->current_salary = $request->input('current_salary');
////        $user->expected_salary = $request->input('expected_salary');
////        $user->salary_currency = $request->input('salary_currency');
////        $user->street_address = $request->input('street_address');
////        $user->is_immediate_available = $request->input('is_immediate_available');
////        $user->is_active = $request->input('is_active');
////        $user->verified = $request->input('verified');
//        $user->update();
//
////        $this->updateUserFullTextSearch($user);
////        /*         * ************************************ */
////        if ($request->has('job_seeker_package_id') && $request->input('job_seeker_package_id') > 0) {
////            $package_id = $request->input('job_seeker_package_id');
////            $package = Package::find($package_id);
////            if ($user->package_id > 0) {
////                $this->updateJobSeekerPackage($user, $package);
////            } else {
////                $this->addJobSeekerPackage($user, $package);
////            }
////        }
//        /*         * ************************************ */
//
//        flash('User has been updated!')->success();
//        return \Redirect::route('edit.user', array($user->id));
//    }

    public function fetchUsersData(Request $request)
    {
        $users = User::select(
                        [
                            'users.id',
                            'users.first_name',
                            'users.middle_name',
                            'users.last_name',
                            'users.email',
                            'users.password',
                            'users.phone',
                            'users.country_id',
                            'users.state_id',
                            'users.city_id',
                            'users.is_immediate_available',
                            'users.num_profile_views',
                            'users.is_active',
                            'users.verified',
                            'users.email_verified_at',
                            'users.is_email_preference',
                            'users.created_at',
                            'users.updated_at'
        ])->where('user_type', 'employer')->where('is_accept_terms','1')->where('is_deleted','0');
        return Datatables::of($users)
                        ->filter(function ($query) use ($request) {
                            if ($request->has('id') && !empty($request->id)) {
                                $query->where('users.id', 'like', "{$request->get('id')}");
                            }
                            if ($request->has('name') && !empty($request->name)) {
                                $query->where(function($q) use ($request) {
                                    $q->where('users.first_name', 'like', "%{$request->get('name')}%")
                                    ->orWhere('users.middle_name', 'like', "%{$request->get('name')}%")
                                    ->orWhere('users.last_name', 'like', "%{$request->get('name')}%");
                                });
                            }
                            if ($request->has('email') && !empty($request->email)) {
                                $query->where('users.email', 'like', "%{$request->get('email')}%");
                            }
                            if ($request->has('phone') && !empty($request->phone)) {
                                $query->where('users.phone', 'like', "{$request->get('phone')}%");
                            }
                            if ($request->has('accountStatus') && !empty($request->accountStatus)) {
                                if($request->accountStatus=='active'){
                                    $query->where('users.is_active', '=', 1);
                                    $query->where('users.verified', '=', 1);
                                    $query->where('users.email_verified_at', '!=', null);
                                }elseif ($request->accountStatus=='inactive'){
                                    $query->where(function($q) use ($request) {
                                        $q->where('users.is_active', '=', 1)->orWhere('users.is_active', '=', 0);
                                    });
                                    $query->where('users.verified', '=', 0);
                                    $query->where('users.email_verified_at');
                                }elseif ($request->accountStatus=='suspended'){
                                    $query->where('users.is_active', '=', 0);
                                    $query->where('users.verified', '=', 1);
                                    $query->where('users.email_verified_at', '!=', null);
                                }
                                /*$query->where('users.phone', 'like', "{$request->get('phone')}%");*/
                            }
                        })
                        /*->addColumn('user_type', function ($users) {
                            return 'Job Seeker';
                        })*/
                        ->addColumn('name', function ($users) {
                            return $users->first_name . ' ' . $users->middle_name . ' ' . $users->last_name;
                        })
                        ->addColumn('is_active', function ($users) {
                            $status='';
                            if($users->is_active == 1 and $users->verified == 1 and $users->email_verified_at != null){
                                $status='Active';
                            }elseif ($users->is_active == 1 and $users->verified == 0 and $users->email_verified_at == null){
                                $status='Inactive';
                            }elseif ($users->is_active == 0 and $users->verified == 0 and $users->email_verified_at == null){
                                $status='Inactive';
                            }elseif ($users->is_active == 0 and $users->verified == 1 and $users->email_verified_at != ''){
                                $status='Suspended';
                            }
                            return $status;
                        })
                        ->addColumn('subAccount', function ($users) {
                            $subUsers = DB::table('users')->where('parent_id', $users->id)->get();
                            $ul='';
                            if($subUsers){
                                foreach ($subUsers as $subUser){
                                   $ul.=$subUser->first_name . ' ' . $subUser->middle_name . ' ' . $subUser->last_name.'<br>';
                                }
                            }
                            return $ul;
                         })
                        ->addColumn('is_email_preference', function ($users) {
                            return $users->is_email_preference == 1 ? 'Yes': 'No';

                         })
                        ->addColumn('action', function ($users) {
                            /*                             * ************************* */
                            $active_txt = '';
                            $active_href = '';
                            $active_icon = '';
                            $active_class = '';
                            if ((int) $users->is_active == 1 && (int) $users->verified == 1) {
//                                $active_txt = 'Make InActive';
                                $active_txt = 'Suspend';
                                $active_href = 'make_not_active(' . $users->id . ');';
                                $active_icon = 'square-o';
                            }elseif ((int) $users->is_active == 1 && (int) $users->verified == 0){
                               // $active_txt = 'Inactive';
                                $active_href = 'make_not_active(' . $users->id . ');';
                                $active_icon = '';
                                $active_class = 'hidden';
                            }elseif ((int) $users->is_active == 0 && (int) $users->verified == 0){
                                $active_class = 'hidden';
                            }elseif ($users->is_active == 0 and $users->verified == 1 and $users->email_verified_at != ''){
                                $active_txt = 'Active';
                                $active_href = 'make_active(' . $users->id . ');';
                                $active_icon = 'check-square-o';
                            }
                            /*                             * ************************* */
                            /*                             * ************************* */
                            $verified_txt = 'Verified';
                            $verified_href = 'make_verified(' . $users->id . ');';
                            $verified_icon = 'check-square-o';
                            if ((int) $users->verified == 1) {
                                $verified_txt = 'Not Verified';
                                $verified_href = 'make_not_verified(' . $users->id . ');';
                                $verified_icon = 'square-o';
                            }
                            /*                             * ************************* */
                            return '
                                <div class="btn-group">
                                    <button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                        <a href="' . route('employer.view.profile', ['id' => $users->id]) . '"><i class="fa fa-eye" aria-hidden="true"></i>View</a>
                                        </li>
                                        <li>
                                        <a href="javascript:void(0);" onclick="delete_employee(' . $users->id . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
                                        </li>
                                        <li>
                                        <a class="'.$active_class.'" href="javascript:void(0);" onClick="' . $active_href . '" id="onclick_active_' . $users->id . '"><i class="fa fa-' . $active_icon . '" aria-hidden="true"></i>' . $active_txt . '</a>
                                        </li>
                                        <li>
                                        <a href="' . route('employer.payment.history', ['id' => $users->id]) . '"><i class="fa fa-eye" aria-hidden="true"></i>Payment</a>
                                        </li>
                                     </ul>
                                </div>';
                        })

                        ->rawColumns(['action', 'name', 'subAccount'])
                        ->setRowId(function($users) {
                            return 'user_dt_row_' . $users->id;
                        })
                        ->make(true);
    }



    public function makeActiveUser(Request $request)
    {
        $id = $request->input('id');
        try {
            $user = User::findOrFail($id);
            $user->is_active = 1;
            $user->update();
           return new JsonResponse(array('status'=>'ok','value'=>'Active'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveUser(Request $request)
    {
        $id = $request->input('id');
        try {
            $user = User::findOrFail($id);
            $user->is_active = 0;
            $user->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Suspended'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeVerifiedUser(Request $request)
    {
        $id = $request->input('id');
        try {
            $user = User::findOrFail($id);
            $user->verified = 1;
            $user->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Verified'));

        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotVerifiedUser(Request $request)
    {
        $id = $request->input('id');
        try {
            $user = User::findOrFail($id);
            $user->verified = 0;
            $user->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Not Verified'));

        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function deleteUser(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);

        DB::table('testimonials')->where('user_id', $user->id)->delete();
        DB::table('user_videos')->where('user_id', $user->id)->delete();

        $user->delete();

        echo 'ok';
    }

    public function deleteEmployeeByAdmin(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);
        $userDeleteReason = DB::table('user_account_close_reasons')->where('is_active', 1)->where('user_type', 'admin')->orderBy('sort_order', 'DESC')->first();

        $user->is_active = 0;
        $user->is_deleted = 1;
        $user->email= $user->email.'_deleted_'.$user->id;
        $subAccounts = DB::table('users')->where('parent_id', $user->id)->get();

        if($subAccounts){
            foreach($subAccounts as $subAccount){
                $deletedUser = new DeletedUser();
                $deletedUser->user_id = $subAccount->id;
                $deletedUser->user_email = $subAccount->email;
                $deletedUser->user_name = $subAccount->name;
                $deletedUser->user_type = $subAccount->user_type;
                $deletedUser->user_type = 'sub_account';
                $deletedUser->delete_reason_id = $userDeleteReason?$userDeleteReason->id:null;
                $deletedUser->save();
            }
        }
        $deletedEmployer = new DeletedUser();
        $deletedEmployer->user_id = $user->id;
        $deletedEmployer->user_email = $user->email;
        $deletedEmployer->user_name = $user->name;
        $deletedEmployer->user_type = $user->user_type;
        $deletedEmployer->delete_reason_id = $userDeleteReason?$userDeleteReason->id:null;
        $deletedEmployer->save();

        DB::table('users')->where('parent_id', $user->id)->delete();
        $user->update();
        echo 'ok';
    }

    public function viewPublicProfile($id)
    {
        $userJobTitles = DB::table('user_job_titles')
            ->join('job_titles','job_titles.id','=','user_job_titles.job_title_id')
            ->where('user_id', $id)->get();

        $userSummary = DB::table('profile_summaries')
            ->where('user_id', $id)->first();
        $userSummary = $userSummary ? $userSummary->summary : '';

        $userIndustry = DB::table('users')
            ->join('industries','industries.id','=','users.industry_id')
            ->where('users.id', $id)->first();
        $userIndustry = $userIndustry ? $userIndustry->industry : '';

        $userSocialMedia = DB::table('users')
            ->join('social_media','social_media.id','=','users.social_id')
            ->where('users.id', $id)->first();
        $userSocialMedia = $userSocialMedia ? $userSocialMedia->name : '';
        $user = User::findOrFail($id);

        return view('admin.employer.profile')
            ->with('user', $user)
            ->with('page_title', $user->getName())
            ->with('form_title', 'Contact ' . $user->getName())
            ->with('userJobTitles', $userJobTitles)
            ->with('userSummary', $userSummary)
            ->with('userSocialMedia', $userSocialMedia)
            ->with('userIndustry', $userIndustry);
    }

    public function paymentHistory($id)
    {
        $user = User::findOrFail($id);
        $paymentHistory = PaymentTransactionHistory::join('packages', 'packages.id', '=', 'payment_transactions_history.package_id')
            ->where('user_id',$user->id)->orderBy('payment_transactions_history.created_at','desc')->get();
        return view('admin.employer.payment_history')
            ->with('user', $user)
            ->with('page_title', $user->getName())
            ->with('form_title', 'Contact ' . $user->getName())
            ->with('paymentHistory',$paymentHistory);
    }

    public function deletedEmployer()
    {
        $users = DB::table('deleted_users')
            ->select('deleted_users.created_at as deleted_date', 'deleted_users.user_name', 'deleted_users.user_email','user_account_close_reasons.title')
            ->join('user_account_close_reasons', 'user_account_close_reasons.id', '=', 'deleted_users.delete_reason_id')
            ->where('deleted_users.user_type', '!=','candidate')
            ->get();

        return view('admin.employer.deleted-employer-list')->with('users', $users);
    }

    /*     * ******************************************** */
}
