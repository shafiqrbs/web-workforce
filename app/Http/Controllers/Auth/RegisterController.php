<?php

namespace App\Http\Controllers\Auth;

use App\Country;
use App\DegreeLevel;
use App\Gender;
use App\Helpers\DataArrayHelper;
use App\JobExperience;
use App\JobTitle;
use App\JobTitleOther;
use App\JobType;
use App\Language;
use App\Models\Athlete;
use App\Models\AthleteCompetition;
use App\Models\Banner;
use App\Models\BloodGroup;
use App\Models\Profession;
use App\Models\ShootingSportClub;
use App\ProfileSummary;
use App\SalaryPeriod;
use App\State;
use App\User;
use App\Http\Requests;
use App\UserJobTitle;
use App\UserJobType;
use App\UserLanguage;
use Http\Client\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use App\Http\Requests\Front\UserFrontRegisterFormRequest;
use App\Http\Requests\Front\UserFrontRegisterEditFormRequest;
use Illuminate\Auth\Events\Registered;
use App\Events\UserRegistered;
use DB;
use PHPMailer\PHPMailer\PHPMailer;
use ImgUploader;
use File;


class RegisterController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;
    use VerifiesUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['getVerification', 'getVerificationError']]);
    }
    public function showRegistrationForm()
    {
        $pageTitle = 'Athlete';
        $pathPageTitle = 'Registration';
        $athleteTypes = ['Pistol'=>'Pistol','Rifle'=>'Rifle','Short'=>'Short Gun','Disabled'=>'Disabled Athlete'];
        $maritalStatus = ['Single'=>'Single','Married'=>'Married','Widowed'=>'Widowed','Divorced'=>'Divorced','Separated'=>'Separated'];
        $genders = Gender::where('is_active',1)->orderBy('sort_order', 'ASC')->pluck('gender','id')->all();
        $bloodGroups = BloodGroup::bloodGroupDropDown();
        $professions = Profession::professionDropDown();
        $bannerData = Banner::getPageWiseBannerInfo('registration');
        $clubs = ShootingSportClub::clubDropdown();

        $cities = \Illuminate\Support\Facades\DB::table('cities')
            ->where('is_active',1)
            #->orderby('sort_order','asc')
            ->orderby('city','asc')
            ->pluck('city','id')
            ->all();

        return view('auth.register',['pageTitle'=>$pageTitle,'athleteTypes'=>$athleteTypes,'genders'=>$genders,'bloodGroups'=>$bloodGroups,'professions'=>$professions,'maritalStatus'=>$maritalStatus,'bannerData'=>$bannerData,'pathPageTitle'=>$pathPageTitle,'cities'=>$cities,'clubs'=>$clubs]);
    }

    public function register(Request $request)
    {
        $rules = [
            'athlete_name' => 'required',
            'athlete_type' => 'required',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:12',
            'email' => 'required|unique:users,email|email|max:100',
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
            'profile_image' =>'required',
            'district_id' =>'required',
            'club_id' =>'required',
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
            'profile_image.required' =>'Choose profile image',
            'district_id.required' =>'Choose District',
            'club_id.required' =>'Choose Club',
        ];

        $this->validate($request, $rules, $customMessages);
        $input = $request->all();



        $randomPassword = random_int(100000, 999999);
        $userInput['password'] = bcrypt($randomPassword);;
        $userInput['email'] = $request->get('email');
        $userInput['email_verified_at'] = now();
        $userInput['is_active'] = 1;
        $userInput['verified'] = 1;

        $user = User::create($userInput);
        if ($user){
            $input['user_id'] = $user->id;
            $input['sort_order'] = $user->id;
            $input['updated_at'] = null;
            if ($request->hasFile('profile_image')) {
                $image_name = $request->input('athlete_name');
                $fileName = ImgUploader::UploadImage('athlete_profile', $request->file('profile_image'), $image_name, 270,270);
                $input['profile_image'] = $fileName;
            }
            $athlete = Athlete::create($input);

            if ($athlete){
                if ($input['competition_name']){
                    $index = 1;
                    foreach ($input['competition_name'] as $key => $competition) {
                        $athleteCompetition = new AthleteCompetition();
                        $athleteCompetition->athlete_id = $athlete->id;
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
            }

            $details = [
                'mailpage' => 'AthleteRegister',
                'title' => 'BSSF Athlete Registration',
//                'welcome' => 'Hi ' . $input['email'] . ' ' . $randomPassword,
                'password' => $randomPassword,
                'userData'=>$user,
                'name'=>$input['athlete_name'],
            ];

//            \Mail::to($userInput['email'])->send(new \App\Mail\MailSend($details));

            flash('Athlete has been registered successfully.')->success();
            return \Redirect::route('register');
        }
    }


    public function registrationPreview($id)
    {
        $user = User::where('id', $id)->first();

        $terms = DB::table('cms')
            ->join('cms_content', 'cms_content.page_id', '=', 'cms.id')
            ->where('cms.page_slug', 'terms-of-use')
            ->first();


        $terms = $terms ? $terms->page_content : '';
        return view('auth.register_preview')->with(['user' => $user, 'terms'=>$terms]);
    }

    public function registrationUpdate(UserFrontRegisterEditFormRequest $request, $id)
    {
        $user = User::find($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->phone = $request->input('phone');
        $user->gender_id = $request->input('gender');
        $user->degree_level_id = $request->input('education');
        $user->country_id = $request->input('country');
        $user->state_id = $request->input('state');
        $user->city_id = $request->input('city');
        $user->street_address = $request->input('street_address');
        $user->postal_code = $request->input('postal_code');
        $user->is_immediate_available = $request->input('is_immediate_available');
        $user->willing_to_relocate = $request->input('willing_to_relocate');
        $user->expected_salary = $request->input('expected_salary');
        $user->salary_period_id = $request->input('salary_period');
        $user->job_experience_id = $request->input('experience');
        $user->profile_visibility = $request->input('profile_visibility');
        $user->user_type = $request->input('candidate_or_employer');
        $user->is_active = 0;
        $user->verified = 0;
        $user->current_status = 'pending_for_user_confirmation';
        $user->password = Hash::make($request->password);

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

        $user->userJobTitles()->delete();
        foreach ($request->job_title as $job_title){
            $userJobTitle = new UserJobTitle();
            $userJobTitle->user_id = $user->id;
            $userJobTitle->job_title_id = $job_title;
            $userJobTitle->save();
        }

        $user->userJobTypes()->delete();
        foreach ($request->job_type as $job_type) {
            $userJobType = new UserJobType();
            $userJobType->user_id = $user->id;
            $userJobType->job_type_id = $job_type;
            $userJobType->save();
        }

        $user->userLanguages()->delete();
        foreach ($request->language as $language) {
            $userLanguage= new UserLanguage();
            $userLanguage->user_id = $user->id;
            $userLanguage->language_id = $language;
            $userLanguage->save();
        }
        $user->name = $user->getName();
        $user->current_status = 'registration_confirmed';
        $user->update();

        return redirect()->route('registration_preview', ['id'=>$user->id]);
    }

    public function registrationConfirm($id)
    {
        $user = User::find($id);
        $user->is_active = 1;
        $user->is_accept_terms = 1;
        $user->update();
        $user->sendEmailVerificationNotification();
        return redirect()->route('confirmation_page', ['id'=>$id]);
    }

    public function confirmationPage($id)
    {
        $user = User::find($id);
        return view('auth.confirmation')
            ->with('user', $user);
    }

    public function registrationEdit($id)
    {
        $user = User::where('id', $id)->first();
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
        return view('auth.register_edit')
            ->with('user', $user)
            ->with('genders', $genders)
            ->with('countries', $countries)
            ->with('states', $states)
            ->with('jobTitles', $jobTitles)
            ->with('jobTypes', $jobTypes)
            ->with('languages', $languages)
            ->with('salaryPeriods', $salaryPeriods)
            ->with('jobExperiences', $jobExperiences)
            ->with('userJobTitles', $userJobTitles)
            ->with('userJobTypes', $userJobTypes)
            ->with('userLanguages', $userLanguages)
            ->with('degreeLevels', $degreeLevels);
    }

    public function registrationCancel($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('home');
    }
}
