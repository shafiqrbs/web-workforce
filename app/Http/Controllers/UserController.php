<?php

namespace App\Http\Controllers;

use App\DegreeLevel;
use App\DeletedUser;
use App\Http\Requests\Front\UserFrontRegisterEditFormRequest;
use App\JobTitle;
use App\JobTitleOther;
use App\JobType;
use App\Language;
use App\Models\Athlete;
use App\Models\AthleteCompetition;
use App\Models\BloodGroup;
use App\Models\Profession;
use App\ProfileSummary;
use App\SalaryPeriod;
use App\SocailMedia;
use App\UserJobTitle;
use App\UserJobType;
use App\UserLanguage;
use Auth;
use DB;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Input;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use ImgUploader;
use Carbon\Carbon;
use Redirect;
use Newsletter;
use App\User;
use App\Subscription;
use App\ApplicantMessage;
use App\Company;
use App\FavouriteCompany;
use App\Gender;
use App\MaritalStatus;
use App\Country;
use App\State;
use App\City;
use App\JobExperience;
use App\JobApply;
use App\CareerLevel;
use App\Industry;
use App\Alert;
use App\FunctionalArea;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Traits\CommonUserFunctions;
use App\Traits\ProfileSummaryTrait;
use App\Traits\ProfileCvsTrait;
use App\Traits\ProfileProjectsTrait;
use App\Traits\ProfileExperienceTrait;
use App\Traits\ProfileEducationTrait;
use App\Traits\ProfileSkillTrait;
use App\Traits\ProfileLanguageTrait;
use App\Traits\Skills;
use App\Http\Requests\Front\UserFrontFormRequest;
use App\Helpers\DataArrayHelper;
use Illuminate\Support\Facades\Storage;
use Youtube;
use Response;
use Mail;

class UserController extends Controller
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth', ['only' => ['myProfile', 'updateMyProfile', 'viewPublicProfile']]);
        $this->middleware('auth', ['except' => ['showApplicantProfileEducation', 'showApplicantProfileProjects', 'showApplicantProfileExperience', 'showApplicantProfileSkills', 'showApplicantProfileLanguages']]);
    }

    public function viewPublicProfile()
    {
        $user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        } else {
            if($user->user_type == 'candidate'){
                $id = Auth::user()->id;
                $userJobTitles = DB::table('user_job_titles')
                    ->join('job_titles','job_titles.id','=','user_job_titles.job_title_id')
                    ->where('user_id', $id)->get();

                $userJobTypes = DB::table('user_job_types')
                    ->join('job_types','job_types.id','=','user_job_types.job_type_id')
                    ->where('user_id', $id)->get();

                $userLanguages = DB::table('user_languages')
                    ->join('languages','languages.id','=','user_languages.language_id')
                    ->where('user_id', $id)->get();

                $userSummary = DB::table('profile_summaries')
                    ->where('user_id', $id)->first();
                $userSummary = $userSummary ? $userSummary->summary : '';

                $userGender = DB::table('users')
                    ->join('genders','genders.id','=','users.gender_id')
                    ->where('users.id', $id)->first();
                $userGender = $userGender ? $userGender->gender : '';

                $userExperience = DB::table('users')
                    ->join('job_experiences','job_experiences.id','=','users.job_experience_id')
                    ->where('users.id', $id)->first();
                $userExperience = $userExperience ? $userExperience->job_experience : '';

                $userSalaryPeriod = DB::table('users')
                    ->join('salary_periods', 'salary_periods.id', '=', 'users.salary_period_id')
                    ->where('users.id', $id)->first();
                $userSalaryPeriod = $userSalaryPeriod ? $userSalaryPeriod->salary_period : '';

                $userProfileVideo = DB::table('user_videos')->where('user_id', $id)->first();
                $userResume = DB::table('profile_cvs')->where('user_id', $id)->first();
                $user = User::findOrFail($id);

                return view('user.applicant_profile')
                    ->with('user', $user)
                    ->with('page_title', $user->getName())
                    ->with('form_title', 'Contact ' . $user->getName())
                    ->with('userJobTitles', $userJobTitles)
                    ->with('userJobTypes', $userJobTypes)
                    ->with('userLanguages', $userLanguages)
                    ->with('userSummary', $userSummary)
                    ->with('userProfileVideo', $userProfileVideo)
                    ->with('userExperience', $userExperience)
                    ->with('userResume', $userResume)
                    ->with('userSalaryPeriod', $userSalaryPeriod)
                    ->with('userGender', $userGender);
            } else {
                $id = Auth::user()->id;
                $userJobTitles = DB::table('user_job_titles')
                    ->join('job_titles','job_titles.id','=','user_job_titles.job_title_id')
                    ->where('user_id', $id)->get();

                $userJobTypes = DB::table('user_job_types')
                    ->join('job_types','job_types.id','=','user_job_types.job_type_id')
                    ->where('user_id', $id)->get();

                $userLanguages = DB::table('user_languages')
                    ->join('languages','languages.id','=','user_languages.language_id')
                    ->where('user_id', $id)->get();

                $userSummary = DB::table('profile_summaries')
                    ->where('user_id', $id)->first();
                $userSummary = $userSummary ? $userSummary->summary : '';

                $userGender = DB::table('users')
                    ->join('genders','genders.id','=','users.gender_id')
                    ->where('users.id', $id)->first();
                $userGender = $userGender ? $userGender->gender : '';

                $userExperience = DB::table('users')
                    ->join('job_experiences','job_experiences.id','=','users.job_experience_id')
                    ->where('users.id', $id)->first();
                $userExperience = $userExperience ? $userExperience->job_experience : '';

                $userProfileVideo = DB::table('user_videos')->where('user_id', $id)->first();
                $userResume = DB::table('profile_cvs')->where('user_id', $id)->first();
                $user = User::findOrFail($id);

                return view('employer.employer_profile')
                    ->with('user', $user)
                    ->with('page_title', $user->getName())
                    ->with('form_title', 'Contact ' . $user->getName())
                    ->with('userJobTitles', $userJobTitles)
                    ->with('userJobTypes', $userJobTypes)
                    ->with('userLanguages', $userLanguages)
                    ->with('userSummary', $userSummary)
                    ->with('userProfileVideo', $userProfileVideo)
                    ->with('userExperience', $userExperience)
                    ->with('userResume', $userResume)
                    ->with('userGender', $userGender);
            }
        }


    }


    public function userAccountDeleteReason()
    {
        $user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        } else{
            if($user->user_type == 'candidate'){
                $user = Auth::user();
                $userDeleteReason = DB::table('user_account_close_reasons')->where('is_active', 1)->orderBy('sort_order', 'ASC')->get();
                return view('user.user_account_delete_reason')
                    ->with('user', $user)
                    ->with('userDeleteReasons', $userDeleteReason);
            } else {
                $user = Auth::user();
                $userDeleteReason = DB::table('user_account_close_reasons')->where('is_active', 1)->orderBy('sort_order', 'ASC')->get();
                $jobSeekerSearchSave = DB::table('jobseeker_search_save')->where('user_id',auth()->user()->id)->get();
                $saveSearchCount = $jobSeekerSearchSave->count();
                $saveprofileCount = DB::table('favourite_jobseeker')->where('user_id',auth()->user()->id)->get();
                $countSaveProfile = $saveprofileCount->count();
                return view('user.employer_user_account_delete_reason')
                    ->with('user', $user)
                    ->with('saveSearchCount', $saveSearchCount)
                    ->with('countSaveProfile', $countSaveProfile)
                    ->with('userDeleteReasons', $userDeleteReason);
                }
        }

    }

    public function deleteAccount(Request $request)
    {
        $user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        } else {
            if($user->user_type == 'employer'){
                $user = Auth::user();
                $user->is_active = 0;
                $user->is_deleted = 1;
                $user->email= $user->email.'_deleted_'.$user->id;
                $subAccounts = DB::table('users')->where('parent_id', $user->id)->get();

                foreach($subAccounts as $subAccount){
                    $deletedUser = new DeletedUser();
                    $deletedUser->user_id = $subAccount->id;
                    $deletedUser->user_email = $subAccount->email;
                    $deletedUser->user_name = $subAccount->name;
                    $deletedUser->user_type = $subAccount->user_type;
                    $deletedUser->delete_reason_id = $request->input('id');
                    $deletedUser->save();
                }

                DB::table('users')->where('parent_id', $user->id)->delete();

                $deletedEmployer = new DeletedUser();
                $deletedEmployer->user_id = $user->id;
                $deletedEmployer->user_email = $user->email;
                $deletedEmployer->user_name = $user->name;
                $deletedEmployer->user_type = $user->user_type;
                $deletedEmployer->delete_reason_id = $request->input('id');
                $deletedEmployer->save();

                $user->update();
                auth()->logout();
            } else {
                $user = Auth::user();
                $deletedUser = new DeletedUser();
                $deletedUser->user_id = $user->id;
                $deletedUser->user_email = $user->email;
                $deletedUser->user_name = $user->name;
                $deletedUser->user_phone = $user->phone;
                $deletedUser->user_type = $user->user_type;
                $deletedUser->delete_reason_id = $request->input('id');
                $deletedUser->save();

                DB::table('testimonials')->where('user_id', $user->id)->delete();
                DB::table('user_videos')->where('user_id', $user->id)->delete();
                //DB::table('favourite_jobseeker')->where('jobseeker_id', $user->id)->delete();

                $user->delete();
            }
        }

        return response()->json('success');
    }
    public function deleteEmployer()
    {

    }


    public function changePasswordPage()
    {
        $user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        } else {
            if($user->user_type == 'candidate'){
                return view('user.change_pass');
            } else {
                $jobSeekerSearchSave = DB::table('jobseeker_search_save')->where('user_id',auth()->user()->id)->get();
                $saveSearchCount = $jobSeekerSearchSave->count();
                $saveprofileCount = DB::table('favourite_jobseeker')->where('user_id',auth()->user()->id)->get();
                $countSaveProfile = $saveprofileCount->count();
                return view('user.employer_change_pass')
                    ->with('saveSearchCount',$saveSearchCount)
                    ->with('countSaveProfile',$countSaveProfile);
            }
        }

    }

    public function changePassword(Request $request)
    {
        $user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        }

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);
        $user = auth()->user();
        $details = [
            'title'=>'Hello',
            'body'=>'You have changed your password.',
            'email'=>  $user->email,
            'updated'=>  date('M d, Y h:i A', strtotime($user->updated_at)),
            'status'=>'changePassword'
        ];
        Mail::to($user->email)->send(new \App\Mail\CustomMail($details));

        flash(__('Password Changed successfully'))->success();
        return redirect()->back();
    }

    public function deleteVideo()
    {
        $user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        }
        $userId = Auth::user()->id;
        $video = DB::table('user_videos')->where('user_id',$userId)->delete();
        return response()->json('success');
    }

//    public function deleteVideo()
//    {
//        $userId = Auth::user()->id;
//        $video = DB::table('profile_videos')->where('user_id',$userId)->delete();
//        return redirect()->back();
//    }

    /**
     * UPLOAD VIDEO
     */
    public function videos()
    {
        $user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        }
        $userId = Auth::user()->id;
        $video = DB::table('user_videos')->where('user_id',$userId)->first();
        if($video && $video->status == 'created'){
            return redirect()->route('approval.video');
        }
        return view('user.vedio_list_local')->with('video', $video);
    }

//    public function videos()
//    {
//        $userId = Auth::user()->id;
//        $video = DB::table('profile_videos')->where('user_id',$userId)->first();
//        return view('user.vedio_list')->with('video', $video);
//    }

    public function uploadVideo()
    {
        $user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        }
        return view('user.vedio_upload');
    }

    public function saveVideo(Request $request)
    {
        $user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        }

        $file = $request->file('video');
        $fileName = $request->file('video')->getClientOriginalName();
        $filepath = realpath($_FILES['video']['tmp_name']);
        $target_file = public_path()."/uploads/video/{$fileName}";
        move_uploaded_file($filepath, $target_file);
        DB::table('user_videos')->where('user_id', auth()->user()->id)->delete();
        DB::table('user_videos')->insert([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'video' => $fileName
        ]);
        flash(__('Your video has been uploaded successfully.'))->success();
        return response()->json('success');
    }

    public function approvalVideo()
    {
        $user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        }

        $userId = Auth::user()->id;
        $video = DB::table('user_videos')->where('status', 'created')->where('user_id',$userId)->first();
        return view('user.vedio_approval')->with('video', $video);
    }

    public function submitApprovalVideo()
    {
        $user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        }
        $userId = Auth::user()->id;
        $video = DB::table('user_videos')->where('status', 'created')->where('user_id',$userId)->update([
            'status'=>'submitted_for_approval'
        ]);
        flash(__('Your video has been submitted for approval.'))->success();
        return redirect()->route('list.video');
    }

    public function myProfile()
    {
        $user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        } else{
            if($user->user_type == 'candidate'){
                $user = User::findOrFail(Auth::user()->id);
                $genders = Gender::where('is_active',1)->orderBy('sort_order', 'ASC')->get();
                $countries = Country::where('country', 'Canada')->orderBy('id', 'ASC')->get();
                $countryId = Country::where('country', 'Canada')->first()->id;
                $states = State::where('is_active',1)->where('country_id', $countryId)->orderBy('state', 'ASC')->get();
                $jobTitles = JobTitle::where('is_active',1)->orderBy('job_title', 'ASC')->get();
                $jobTypes = JobType::where('is_active',1)->orderBy('sort_order', 'ASC')->get();
                $degreeLevels = DegreeLevel::where('is_active',1)->orderBy('sort_order', 'ASC')->get();
                $languages = Language::where('is_active',1)->orderBy('sort_order', 'ASC')->get();
                $salaryPeriods = SalaryPeriod::where('is_active',1)->orderBy('sort_order', 'ASC')->get();
                $jobExperiences = JobExperience::where('is_active',1)->orderBy('sort_order', 'ASC')->get();

                $userJobTitles = [];
                $items = DB::table('user_job_titles')
                    ->join('job_titles','job_titles.id','=','user_job_titles.job_title_id')
                    ->where('user_id', $user->id)->get();
                foreach ($items as $item){
                    array_push($userJobTitles, $item->id);
                }

                $userJobTypes= [];
                $items = DB::table('user_job_types')
                    ->join('job_types','job_types.id','=','user_job_types.job_type_id')
                    ->where('user_id', $user->id)->get();
                foreach ($items as $item){
                    array_push($userJobTypes, $item->id);
                }

                $userLanguages= [];
                $items = DB::table('user_languages')
                    ->join('languages','languages.id','=','user_languages.language_id')
                    ->where('user_id', $user->id)->get();
                foreach ($items as $item){
                    array_push($userLanguages, $item->id);
                }

                $userSummary = ProfileSummary::where('user_id', $user->id)->first();
                $userSummary = $userSummary ? $userSummary->summary : '';

                return view('user.edit_profile')
                    ->with('user', $user)
                    ->with('genders', $genders)
                    ->with('countries', $countries)
                    ->with('jobTitles', $jobTitles)
                    ->with('states', $states)
                    ->with('jobTypes', $jobTypes)
                    ->with('languages', $languages)
                    ->with('salaryPeriods', $salaryPeriods)
                    ->with('jobExperiences', $jobExperiences)
                    ->with('degreeLevels', $degreeLevels)
                    ->with('userJobTitles', $userJobTitles)
                    ->with('userJobTypes', $userJobTypes)
                    ->with('userLanguages', $userLanguages)
                    ->with('userSummary', $userSummary);
            } else {
                $athleteData = Athlete::where('user_id',Auth()->user()->id)->first();
                $athleteCompetitionData = AthleteCompetition::where('athlete_id',$athleteData->id)->orderBy('sort_order', 'asc')->get()->toArray();
                $pageTitle = 'Athlete Register';
                $athleteTypes = ['Pistol'=>'Pistol','Rifle'=>'Rifle'];
                $maritalStatus = ['Single'=>'Single','Married'=>'Married','Widowed'=>'Widowed','Divorced'=>'Divorced','Separated'=>'Separated'];
                $genders = Gender::where('is_active',1)->orderBy('sort_order', 'ASC')->pluck('gender','id')->all();
                $bloodGroups = BloodGroup::bloodGroupDropDown();
                $professions = Profession::professionDropDown();
                $cities = \Illuminate\Support\Facades\DB::table('cities')
                    ->where('is_active',1)
                    #->orderby('sort_order','asc')
                    ->orderby('city','asc')
                    ->pluck('city','id')
                    ->all();

                return view('employer.edit_employer_profile',['athleteData'=>$athleteData,'pageTitle'=>$pageTitle,'athleteTypes'=>$athleteTypes,'genders'=>$genders,'bloodGroups'=>$bloodGroups,'professions'=>$professions,'maritalStatus'=>$maritalStatus,'athleteCompetitionData'=>$athleteCompetitionData,'cities'=>$cities]);
                /*$user = User::findOrFail(Auth::user()->id);
                $genders = Gender::where('is_active',1)->orderBy('sort_order', 'ASC')->get();
                $countries = Country::where('country', 'Canada')->orderBy('id', 'ASC')->get();
                $countryId = Country::where('country', 'Canada')->first()->id;
                $states = State::where('is_active',1)->where('country_id', $countryId)->orderBy('state', 'ASC')->get();
                $jobTitles = JobTitle::where('is_active',1)->orderBy('job_title', 'ASC')->get();
                $jobTypes = JobType::where('is_active',1)->orderBy('sort_order', 'ASC')->get();
                $degreeLevels = DegreeLevel::where('is_active',1)->orderBy('sort_order', 'ASC')->get();
                $languages = Language::where('is_active',1)->orderBy('sort_order', 'ASC')->get();
                $salaryPeriods = SalaryPeriod::where('is_active',1)->orderBy('sort_order', 'ASC')->get();
                $jobExperiences = JobExperience::where('is_active',1)->orderBy('sort_order', 'ASC')->get();
                $industry = Industry::where('is_active',1)->where('lang','en')->orderBy('sort_order', 'ASC')->get();
                $socialMedias = SocailMedia::where('is_active',1)->where('lang','en')->orderBy('sort_order', 'ASC')->get();

                $userJobTitles = [];
                $items = DB::table('user_job_titles')
                    ->join('job_titles','job_titles.id','=','user_job_titles.job_title_id')
                    ->where('user_id', $user->id)->get();
                foreach ($items as $item){
                    array_push($userJobTitles, $item->id);
                }

                $userJobTypes= [];
                $items = DB::table('user_job_types')
                    ->join('job_types','job_types.id','=','user_job_types.job_type_id')
                    ->where('user_id', $user->id)->get();
                foreach ($items as $item){
                    array_push($userJobTypes, $item->id);
                }

                $userLanguages= [];
                $items = DB::table('user_languages')
                    ->join('languages','languages.id','=','user_languages.language_id')
                    ->where('user_id', $user->id)->get();
                foreach ($items as $item){
                    array_push($userLanguages, $item->id);
                }

                $userSummary = ProfileSummary::where('user_id', $user->id)->first();
                $userSummary = $userSummary ? $userSummary->summary : '';

                $jobSeekerSearchSave = DB::table('jobseeker_search_save')->where('user_id',auth()->user()->id)->get();
                $saveSearchCount = $jobSeekerSearchSave->count();
                $saveprofileCount = DB::table('favourite_jobseeker')->where('user_id',auth()->user()->id)->get();
                $countSaveProfile = $saveprofileCount->count();

                return view('employer.edit_employer_profile')
                    ->with('user', $user)
                    ->with('genders', $genders)
                    ->with('countries', $countries)
                    ->with('jobTitles', $jobTitles)
                    ->with('states', $states)
                    ->with('jobTypes', $jobTypes)
                    ->with('languages', $languages)
                    ->with('salaryPeriods', $salaryPeriods)
                    ->with('jobExperiences', $jobExperiences)
                    ->with('degreeLevels', $degreeLevels)
                    ->with('userJobTitles', $userJobTitles)
                    ->with('userJobTypes', $userJobTypes)
                    ->with('userLanguages', $userLanguages)
                    ->with('userSummary', $userSummary)
                    ->with('industry', $industry)
                    ->with('saveSearchCount', $saveSearchCount)
                    ->with('countSaveProfile', $countSaveProfile)
                    ->with('socialMedias', $socialMedias);*/
            }
        }


    }

    public function updateMyProfile(Request $request,$id)
    {
        $updateModel =Athlete::find($id);
        $rules = [
            'athlete_name' => 'required',
            'athlete_type' => 'required',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:12',
            'email' => 'required|email|max:255|unique:users,email,' .$updateModel->user_id,
            'date_of_birth' =>'required',
            'age' =>'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'gender_id' =>'required',
            'father_name' =>'required',
            'mother_name' =>'required',
            'address' =>'required',
            'height' =>'required',
            'weight' =>'required',
            'blood_group_id' =>'required',
            'profession_id' =>'required',
            'start_of_competition' =>'required',
            'name_of_national_coach' =>'required',
            'place_of_birth' =>'required',
            'hometown' =>'required',
            'marital_status' =>'required',
            'event' =>'required',
            'higher_education' =>'required',
            'parent_full_name' =>'required',
            'relationship' =>'required',
            'parent_mobile' =>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:12',
            'parent_address' =>'required',
            'district_id' =>'required',

        ];
        $customMessages = [
            'athlete_name.required' => 'Enter Athlete Name',
            'athlete_type.required' => 'Choose Athlete Type',
            'mobile.required' => 'Enter Mobile Number',
            'mobile.min:8' => 'Mobile minimum 8 digit.',
            'mobile.max:12' => 'Mobile maximum 12 digit.',
            'email.required' => 'Enter Email Address',
            'email.unique' => 'Email must be unique',
            'email.email' => 'Email must be valid',
            'date_of_birth.required' =>'Enter date of birth',
            'age.required' =>'Enter age',
            'gender_id.required' =>'Choose gender',
            'father_name.required' =>'Enter father name',
            'mother_name.required' =>'Enter mother name',
            'address.required' =>'Enter address',
            'height.required' =>'Enter Height',
            'weight.required' =>'Enter Weight',
            'blood_group_id.required' =>'Choose blood group',
            'profession_id.required' =>'Choose profession',
            'start_of_competition.required' =>'Enter start of competition',
            'name_of_national_coach.required' =>'Enter name of national coach',
            'place_of_birth.required' =>'Enter place of birth',
            'hometown.required' =>'Enter hometown',
            'marital_status.required' =>'Choose marital status',
            'event.required' =>'Enter event',
            'higher_education.required' =>'Enter higher education',
            'parent_full_name.required' =>'Enter parent full name',
            'relationship.required' =>'Enter relationship',
            'parent_mobile.required' =>'Enter parent mobile',
            'parent_mobile.min:8' => 'Parent Mobile minimum 8 digit.',
            'parent_mobile.max:12' => 'Parent Mobile maximum 12 digit.',
            'parent_address.required' =>'Enter parent address',
            'district_id.required' =>'Choose District',

        ];

        $this->validate($request, $rules, $customMessages);
        $input = $request->all();

        if ($updateModel){
            if ($request->hasFile('profile_image')) {
                File::delete(public_path().'/athlete_profile/'.$updateModel->profile_image);
                File::delete(public_path().'/athlete_profile/mid/'.$updateModel->profile_image);
                File::delete(public_path().'/athlete_profile/thumb/'.$updateModel->profile_image);
                $image_name = $request->input('athlete_name');
                $fileName = ImgUploader::UploadImage('athlete_profile', $request->file('profile_image'), $image_name, 150, 150);
                $input['profile_image'] = $fileName;
            }else{
                $input['profile_image'] = $updateModel->profile_image;
            }
            if ($input['email']){
                $userModel = User::find($updateModel->user_id);
                $userModel->update([
                    'email' =>$input['email']
                ]);
            }

            $updateModel->update($input);
            if ($updateModel){
                if (array_key_exists("competition_name",$request->all())) {
                    if ($input['competition_name'] && $input['competition_date']) {
                        $index = 1;
                        AthleteCompetition::where('athlete_id', $id)->delete();
                        foreach ($input['competition_name'] as $key => $competition) {
                            $athleteCompetition = new AthleteCompetition();
                            $athleteCompetition->athlete_id = $id;
                            $athleteCompetition->competition_name = $competition;
                            $athleteCompetition->competition_date = $input['competition_date'][$key];
                            $athleteCompetition->competition_event = $input['competition_event'][$key];
                            $athleteCompetition->score = $input['score'][$key];
                            $athleteCompetition->position = $input['position'][$key];
                            $athleteCompetition->sort_order = $index;
                            $athleteCompetition->save();
                            $index++;
                        }
                    }
                }else{
                    AthleteCompetition::where('athlete_id', $id)->delete();
                }
            }
            flash(__('You have updated your profile successfully'))->success();
            return \Redirect::route('my.profile');
        }

        /*$user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        }
        $rules = [
            'first_name' => 'required|max:80',
            'last_name' => 'required|max:80',
            'email' => 'required|unique:users,email|email|max:100',
            'gender' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
            'education' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'experience' => 'required',
            'postal_code' => 'required|max:100',
            'job_title' => 'required',
            'job_type' => 'required',
            'language' => 'required',
            'is_immediate_available' => 'required',
            'willing_to_relocate' => 'required',
            'profile_visibility' => 'required',
            'g-recaptcha-response' => 'required',
        ];

        $customMessages = [
            'first_name.required' => __('First Name is required.'),
            'last_name.required' => __('Last Name is required.'),
            'email.required' => __('Email is required.'),
            'email.email' => __('Email must be a valid email address.'),
            'email.unique' => __('This Email has already been taken.'),
            'image.image' => __('You\'ve chosen a wrong image format. Please choose the correct format.
'),
            'gender.required' => __('Gender is required.'),
            'country.required' => __('Country is required.'),
            'city.required' => __('City is required.'),
            'state.required' => __('Province is required.'),
            'job_title.required' => __('Job Titles is required.'),
            'job_type.required' => __('Job Types is required.'),
            'language.required' => __('Language is required.'),
            'education.required' => __('Level of Education is required.'),
            'experience.required' => __('Years of Experience is required.'),
            'postal_code.required' => __('Postal Code is required.'),
            'is_immediate_available.required' => __('Ready To Work is required.'),
            'willing_to_relocate.required' => __('Willing To Relocate is required.'),
            'profile_visibility.required' => __('Profile Visibility is required.'),
            'g-recaptcha-response.required' => __('Recaptcha is required.'),
        ];

        $this->validate($request, $rules, $customMessages);

        $user = User::findOrFail(Auth::user()->id);

        if ($request->hasFile('image')) {
            $is_deleted = $this->deleteUserImage($user->id);
            $image = $request->file('image');
            $fileName = ImgUploader::UploadImage('user_images', $image, $request->input('name'), 300, 300, false);
            $user->image = $fileName;
        }

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->phone = $request->input('phone');
        $user->gender_id = $request->input('gender');
        $user->degree_level_id = $request->input('education');
        $user->country_id = $request->input('country');
        $user->state_id = $request->input('state');
        $user->city_id = $request->input('city');
        $user->is_immediate_available = $request->input('is_immediate_available');
        $user->willing_to_relocate = $request->input('willing_to_relocate');
        $user->expected_salary = $request->input('expected_salary');
        $user->salary_period_id = $request->input('salary_period');
        $user->job_experience_id = $request->input('experience');
        $user->profile_visibility = $request->input('profile_visibility');
        $user->street_address = $request->input('street_address');
        $user->postal_code = $request->input('postal_code');
        $user->name = $user->getName();

        $user->other_languages = $request->other_languages;
        $user->other_job_title = $request->custom_job_title;

        if(isset($request->custom_job_title) && $request->custom_job_title != ''){
            $otherJobTitles = explode( ',', $request->custom_job_title );
            foreach ($otherJobTitles as $otherJobTitle){
                $exitOtherJobTitle = JobTitleOther::where('job_title',trim($otherJobTitle))->first();
                if(!$exitOtherJobTitle){
                    $otherJobTitleObj= new JobTitleOther();
                    $otherJobTitleObj->job_title=trim($otherJobTitle);
                    $otherJobTitleObj->is_active=1;
                    $otherJobTitleObj->save();
                }
            }
        }

        $user->update();

        DB::table('user_job_titles')->where('user_id', $user->id)->delete();
        foreach ($request->job_title as $job_title){
            if($job_title != 'custom'){
                $userJobTitle = new UserJobTitle();
                $userJobTitle->user_id = $user->id;
                $userJobTitle->job_title_id = $job_title;
                $userJobTitle->save();
            }
        }

        DB::table('user_job_types')->where('user_id', $user->id)->delete();
        foreach ($request->job_type as $job_type) {
            $userJobType = new UserJobType();
            $userJobType->user_id = $user->id;
            $userJobType->job_type_id = $job_type;
            $userJobType->save();
        }

        DB::table('user_languages')->where('user_id', $user->id)->delete();
        foreach ($request->language as $language) {
            $userLanguage= new UserLanguage();
            $userLanguage->user_id = $user->id;
            $userLanguage->language_id = $language;
            $userLanguage->save();
        }

        $user_summary = DB::table('profile_summaries')->where('user_id', $user->id)->first();
        if($user_summary){
            DB::table('profile_summaries')->where('user_id', $user->id)->update(['summary' => $request->summary]);
        }else{
            DB::table('profile_summaries')->insert([['summary' => $request->summary, 'user_id' => $user->id]]);
        }

        flash(__('You have updated your profile successfully'))->success();
        return \Redirect::route('my.profile');*/
    }


    public function updateEmployerProfile(Request $request)
    {
        $user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        }
        $rules = [
            'first_name' => 'required|max:80',
            'image' => 'image|mimes:jpeg,png,jpg',
            'last_name' => 'required|max:80',
            /*'email' => 'required|unique:users,email|email|max:100',*/
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'postal_code' => 'required|max:100',
           // 'job_title' => 'required',
           // 'language' => 'required',
//            'g-recaptcha-response' => 'required',
        ];

        $customMessages = [
            'first_name.required' => __('First Name is required.'),
            'last_name.required' => __('Last Name is required.'),
            /*'email.required' => __('Email is required.'),*/
            'email.email' => __('Email must be a valid email address.'),
            'email.unique' => __('This Email has already been taken.'),
            'country.required' => __('Country is required.'),
            'image.image' => __('You\'ve chosen a wrong image format. Please choose the correct format.
'),
            'city.required' => __('City is required.'),
            'state.required' => __('Province is required.'),
            //'job_title.required' => __('Job Titles is required.'),
           // 'language.required' => __('Language is required.'),
            'postal_code.required' => __('Postal Code is required.'),
//            'g-recaptcha-response.required' => __('Recaptcha is required.'),
        ];

        $this->validate($request, $rules, $customMessages);

        $user = User::findOrFail(Auth::user()->id);

        if ($request->hasFile('image')) {
            $is_deleted = $this->deleteUserImage($user->id);
            $image = $request->file('image');
            $fileName = ImgUploader::UploadImage('user_images', $image, $request->input('name'), 300, 300, false);
            $user->image = $fileName;
        }

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->phone = $request->input('phone');
        $user->industry_id = $request->input('industry');
        $user->country_id = $request->input('country');
        $user->state_id = $request->input('state');
        $user->city_id = $request->input('city');
        $user->salary_period_id = $request->input('salary_period');
        $user->social_id = $request->input('social_media');
        $user->company_name = $request->input('company_name');
        $user->number_employees = $request->input('number_employees');
        $user->business_years = $request->input('business_years');
        $user->type_of_business = $request->input('type_of_business');
        $user->street_address = $request->input('street_address');
        $user->postal_code = $request->input('postal_code');
        $user->is_third_party_hiring = $request->input('is_third_party_hiring');
        $user->name = $user->getName();

        $user->other_languages = $request->other_languages;
        $user->other_job_title = $request->custom_job_title;

        if(isset($request->custom_job_title) && $request->custom_job_title != ''){
            $otherJobTitles = explode( ',', $request->custom_job_title );
            foreach ($otherJobTitles as $otherJobTitle){
                $exitOtherJobTitle = JobTitleOther::where('job_title',trim($otherJobTitle))->first();
                if(!$exitOtherJobTitle){
                    $otherJobTitleObj= new JobTitleOther();
                    $otherJobTitleObj->job_title=trim($otherJobTitle);
                    $otherJobTitleObj->is_active=1;
                    $otherJobTitleObj->save();
                }
            }
        }

        $user->update();

        /*DB::table('user_job_titles')->where('user_id', $user->id)->delete();
        foreach ($request->job_title as $job_title){
            if($job_title != 'custom'){
                $userJobTitle = new UserJobTitle();
                $userJobTitle->user_id = $user->id;
                $userJobTitle->job_title_id = $job_title;
                $userJobTitle->save();
            }
        }


        DB::table('user_languages')->where('user_id', $user->id)->delete();
        foreach ($request->language as $language) {
            $userLanguage= new UserLanguage();
            $userLanguage->user_id = $user->id;
            $userLanguage->language_id = $language;
            $userLanguage->save();
        }*/

        $user_summary = DB::table('profile_summaries')->where('user_id', $user->id)->first();
        if($user_summary){
            DB::table('profile_summaries')->where('user_id', $user->id)->update(['summary' => $request->summary]);
        }else{
            DB::table('profile_summaries')->insert([['summary' => $request->summary, 'user_id' => $user->id]]);
        }

        flash(__('You have updated your profile successfully'))->success();
        return \Redirect::route('my.profile');
    }




    public function addToFavouriteCompany(Request $request, $company_slug)
    {
        $data['company_slug'] = $company_slug;
        $data['user_id'] = Auth::user()->id;
        $data_save = FavouriteCompany::create($data);
        flash(__('Company has been added in favorites list'))->success();
        return \Redirect::route('company.detail', $company_slug);
    }

    public function removeFromFavouriteCompany(Request $request, $company_slug)
    {
        $user_id = Auth::user()->id;
        FavouriteCompany::where('company_slug', 'like', $company_slug)->where('user_id', $user_id)->delete();

        flash(__('Company has been removed from favorites list'))->success();
        return \Redirect::route('company.detail', $company_slug);
    }

    public function myFollowings()
    {
        $user = User::findOrFail(Auth::user()->id);
        $companiesSlugArray = $user->getFollowingCompaniesSlugArray();
        $companies = Company::whereIn('slug', $companiesSlugArray)->get();

        return view('user.following_companies')
            ->with('user', $user)
            ->with('companies', $companies);
    }

    public function myMessages()
    {
        $user = User::findOrFail(Auth::user()->id);
        $messages = ApplicantMessage::where('user_id', '=', $user->id)
            ->orderBy('is_read', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.applicant_messages')
            ->with('user', $user)
            ->with('messages', $messages);
    }

    public function applicantMessageDetail($message_id)
    {
        $user = User::findOrFail(Auth::user()->id);
        $message = ApplicantMessage::findOrFail($message_id);
        $message->update(['is_read' => 1]);

        return view('user.applicant_message_detail')
            ->with('user', $user)
            ->with('message', $message);
    }

    public function myAlerts()
    {
        $alerts = Alert::where('email', Auth::user()->email)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('user.applicant_alerts')
            ->with('alerts', $alerts);
    }
    public function delete_alert($id)
    {
        $alert = Alert::findOrFail($id);
        $alert->delete();
        $arr = array('msg' => 'A Alert has been successfully deleted. ', 'status' => true);
        return Response()->json($arr);
    }


    public function deleteProfileImage($id)
    {
        $user = User::find($id);
        $user->image = '';
        $user->update();
        return new JsonResponse(['status'=>'200']);
    }

    public function emailPreferences()
    {
        $user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        } else {
            if($user->user_type == 'candidate'){
                $user = Auth::user();
                return view('user.email_preference')->with('user', $user);
            } else {
                $user = Auth::user();
                $jobSeekerSearchSave = DB::table('jobseeker_search_save')->where('user_id',auth()->user()->id)->get();
                $saveSearchCount = $jobSeekerSearchSave->count();
                $saveprofileCount = DB::table('favourite_jobseeker')->where('user_id',auth()->user()->id)->get();
                $countSaveProfile = $saveprofileCount->count();
                return view('user.employer_email_preference')
                    ->with('user', $user)
                    ->with('saveSearchCount', $saveSearchCount)
                    ->with('countSaveProfile', $countSaveProfile);
            }
        }

    }

    public function emailPreferencesSave(Request $request)
    {
        $user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        }
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user->is_email_preference = (int)$request->email_preference;
        $user->update();
        return new JsonResponse(['status'=>$request->email_preference]);
    }

}
