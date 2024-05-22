<?php

namespace App\Http\Controllers\Employer;

use App\Country;
use App\DegreeLevel;
use App\Gender;
use App\Industry;
use App\JobExperience;
use App\JobTitle;
use App\JobType;
use App\Language;
use App\Package;
use App\ProfileSummary;
use App\SalaryPeriod;
use App\SocailMedia;
use App\State;
use App\User;
use App\Http\Requests;
use App\UserJobTitle;
use App\UserJobType;
use App\UserLanguage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use App\Http\Requests\Front\UserFrontRegisterFormRequest;
use App\Http\Requests\Front\UserFrontRegisterEditFormRequest;
use Illuminate\Auth\Events\Registered;
use App\Events\UserRegistered;
use DB;


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
        $country = Country::where('country', 'Canada')->first();
        $states = State::where('is_active',1)->where('country_id', $country->id)->orderBy('state', 'ASC')->get();
        $jobTitles = JobTitle::where('is_active',1)->orderBy('job_title', 'ASC')->get();
        $jobTypes = JobType::where('is_active',1)->orderBy('sort_order', 'ASC')->get();
        $degreeLevels = DegreeLevel::where('is_active',1)->orderBy('sort_order', 'ASC')->get();
        $languages = Language::where('is_active',1)->get();
        $salaryPeriods = SalaryPeriod::where('is_active',1)->orderBy('sort_order', 'ASC')->get();
        $jobExperiences = JobExperience::where('is_active',1)->orderBy('sort_order', 'ASC')->get();
        $industry = Industry::where('is_active',1)->where('lang','en')->orderBy('sort_order', 'ASC')->get();
        $socialMedias = SocailMedia::where('is_active',1)->where('lang','en')->orderBy('sort_order', 'ASC')->get();

        return view('employer.backup-register')
            ->with('country', $country)
            ->with('states', $states)
            ->with('jobTitles', $jobTitles)
            ->with('jobTypes', $jobTypes)
            ->with('languages', $languages)
            ->with('salaryPeriods', $salaryPeriods)
            ->with('jobExperiences', $jobExperiences)
            ->with('degreeLevels', $degreeLevels)
            ->with('industry', $industry)
            ->with('socialMedias', $socialMedias);
    }

    public function register(Request $request)
    {
        $rules = [
            'first_name' => 'required|max:80',
            'last_name' => 'required|max:80',
            'phone' => 'max:20',
            'email' => 'required|unique:users,email|email|max:100',
            'password' => 'required|confirmed|min:8|max:50',
            'password_confirmation' => 'required|min:8|max:50',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'industry' => 'required',
            'business_years' => 'required',
            'company_name' => 'required',
            'postal_code' => 'required|max:100',
            'number_employees' => 'required',
            //'job_title' => 'required',
            //'language' => 'required',
            'is_third_party_hiring' => 'required',
            //'g-recaptcha-response' => 'required',
        ];

        $customMessages = [
            'first_name.required' => __('First Name is required.'),
            'last_name.required' => __('Last Name is required.'),
            'phone.max' => __('Telephone Number should be less than 20 characters long.'),
            'email.required' => __('Email is required.'),
            'email.email' => __('Email must be a valid email address.'),
            'email.unique' => __('This Email has already been taken.'),
            'password.required' => __('Password is required.'),
            'password_confirmation.required' => __('Password Confirmation is required.'),
            'password.min' => __('Password should be more than 8 characters long'),
            'country.required' => __('Country is required.'),
            'city.required' => __('City is required.'),
            'state.required' => __('Province is required.'),
            'industry.required' => __('Industry is required.'),
            'business_years.required' => __('Years in Business is required.'),
            'company_name.required' => __('Company is required.'),
            //'job_title.required' => __('Job Titles is required.'),
            //'language.required' => __('Language is required.'),
            'postal_code.required' => __('Postal Code is required.'),
            'is_third_party_hiring.required' => __('Third Party Hiring is required.'),
            //'g-recaptcha-response.required' => __('Recaptcha is required.'),
        ];

        $this->validate($request, $rules, $customMessages);
            $user = new User();
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->phone = $request->input('phone');
            $user->industry_id = $request->input('industry');
            $user->company_name = $request->input('company_name');
            $user->number_employees = $request->input('number_employees');
            $user->business_years = $request->input('business_years');
            $user->type_of_business = $request->input('type_of_business');
            $user->country_id = $request->input('country');
            $user->state_id = $request->input('state');
            $user->city_id = $request->input('city');
            $user->street_address = $request->input('street_address');
            $user->postal_code = $request->input('postal_code');
            $user->is_immediate_available = $request->input('is_immediate_available');
            $user->is_third_party_hiring = $request->input('is_third_party_hiring');
            $user->profile_visibility = $request->input('profile_visibility');
            $user->user_type = $request->input('candidate_or_employer');
            $user->social_id = $request->input('social_media');
            $user->social_name = $request->input('social_name');
            $user->is_active = 0;
            $user->verified = 0;
            $user->current_status = 'pending_for_user_confirmation';

        if(isset($request->other_languages) && $request->other_languages != ''){
            $user->other_languages = $request->other_languages;
        }

        if(isset($request->custom_job_title) && $request->custom_job_title != ''){
            $user->other_job_title = $request->custom_job_title;
        }

            $user->save();

            $user->name = $user->getName();
            $user->update();
            return redirect()->route('employer_registration_preview',  ['id' => $user->id]);
    }

    public function registrationPreview($id)
    {
        $user = User::where('id', $id)->first();
        $terms = DB::table('cms')
            ->join('cms_content', 'cms_content.page_id', '=', 'cms.id')
            ->where('cms.page_slug', 'terms-of-use')
            ->first();


        $terms = $terms ? $terms->page_content : '';
        return view('employer.register_preview')->with(['user' => $user, 'terms'=>$terms]);
    }

    public function registrationUpdate(Request $request, $id)
    {
        $user = User::find($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->phone = $request->input('phone');
        $user->industry_id = $request->input('industry');
        $user->country_id = $request->input('country');
        $user->company_name = $request->input('company_name');
        $user->number_employees = $request->input('number_employees');
        $user->business_years = $request->input('business_years');
        $user->type_of_business = $request->input('type_of_business');
        $user->state_id = $request->input('state');
        $user->city_id = $request->input('city');
        $user->street_address = $request->input('street_address');
        $user->postal_code = $request->input('postal_code');
        $user->social_id = $request->input('social_media');
        $user->is_immediate_available = $request->input('is_immediate_available');
        $user->is_third_party_hiring = $request->input('is_third_party_hiring');
        $user->user_type = $request->input('candidate_or_employer');
        $user->is_active = 0;
        $user->verified = 0;
        $user->current_status = 'pending_for_user_confirmation';
        $user->password = Hash::make($request->password);

        if(isset($request->other_languages) && $request->other_languages != ''){
            $user->other_languages = $request->other_languages;
        }

        if(isset($request->custom_job_title) && $request->custom_job_title != ''){
            $user->other_job_title = $request->custom_job_title;
        }

        /*$user->userJobTitles()->delete();
        foreach ($request->job_title as $job_title){
            $userJobTitle = new UserJobTitle();
            $userJobTitle->user_id = $user->id;
            $userJobTitle->job_title_id = $job_title;
            $userJobTitle->save();
        }

        $user->userLanguages()->delete();
        foreach ($request->language as $language) {
            $userLanguage= new UserLanguage();
            $userLanguage->user_id = $user->id;
            $userLanguage->language_id = $language;
            $userLanguage->save();
        }*/
        $user->name = $user->getName();
        $user->current_status = 'registration_confirmed';
        $user->update();

        return redirect()->route('employer_registration_preview', ['id'=>$user->id]);
    }

    public function registrationConfirm($id)
    {
        $user = User::find($id);
        $user->is_active = 1;
        $user->is_accept_terms = 1;
        $user->update();
        return redirect()->route('employer_packages_list', ['id'=>$user->id]);
    }

    public function employeePackages($id){
        $user = User::find($id);
        $packages = Package::where('package_for','employer')->where('package_price','>','0')->get();
        return view('employer.packages')
            ->with('packages', $packages)
            ->with('user', $user)
            ;
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
        $states = State::where('country_id', $countryId)->orderBy('state', 'ASC')->get();
        $jobTitles = JobTitle::where('is_active',1)->orderBy('job_title', 'ASC')->get();
        $jobTypes = JobType::where('is_active',1)->orderBy('sort_order', 'ASC')->get();
        $degreeLevels = DegreeLevel::where('is_active',1)->orderBy('sort_order', 'ASC')->get();
        $languages = Language::where('is_active',1)->get();
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

        $userLanguages= [];
        $items = DB::table('user_languages')
            ->join('languages','languages.id','=','user_languages.language_id')
            ->where('user_id', $user->id)->get();
        foreach ($items as $item){
            array_push($userLanguages, $item->id);
        }
        return view('employer.register_edit')
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
            ->with('userLanguages', $userLanguages)
            ->with('degreeLevels', $degreeLevels)
            ->with('industry', $industry)
            ->with('socialMedias', $socialMedias);
    }

    public function registrationCancel($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('home');
    }
}
