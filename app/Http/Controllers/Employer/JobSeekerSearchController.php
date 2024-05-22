<?php

namespace App\Http\Controllers\Employer;

use App\DegreeLevel;
use App\FavouriteJobSeeker;
use App\Gender;
use App\JobExperience;
use App\JobSeekerSearchSave;
use Auth;
use DB;
use Illuminate\Http\JsonResponse;
use Input;
use Redirect;
use Carbon\Carbon;
use App\User;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Traits\FetchJobSeekers;

class JobSeekerSearchController extends Controller
{

    //use Skills;
    use FetchJobSeekers;

    private $functionalAreas = '';
    private $countries = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['auth', 'verified']);
        $this->functionalAreas = DataArrayHelper::langFunctionalAreasArray();
        $this->countries = DataArrayHelper::langCountriesArray();
    }

    public function jobSeekersBySearch(Request $request)
    {
        $search = $request->query('search', '');
        $advanceSearch = $request->query('advance_search', '');
        $functional_area_ids = $request->query('functional_area_id', array());
        $country_ids = $request->query('country_id', array());
        $state_ids = $request->query('state_id', array());
        $city_ids = $request->query('city_id', array());
        $career_level_ids = $request->query('career_level_id', array());
        $degree_level_ids = $request->query('degree_level_id', array());
        $salary_period_ids = $request->query('salary_period_id', array());
        $gender_ids = $request->query('gender_id', array());
        $industry_ids = $request->query('industry_ids', array());
        $job_experience_ids = $request->query('job_experience_id', array());
        $current_salary = $request->query('current_salary', '');
        $expected_salary = $request->query('expected_salary', '');
        $salary_currency = $request->query('salary_currency', '');
        $willing_to_relocate = $request->query('willing_to_relocate', '');
        $ready_to_work = $request->query('is_immediate_available', '');
        $profile_video = $request->query('profile_video', '');
        $resume_attach = $request->query('resume_attach', '');
        $updated_date = $request->query('updated_date', '');
        $searchCriteria = $request->query('search_criteria', '');
        $order_by = $request->query('order_by', 'id');
        $sortBy = $request->query('sortBy', 'DESC');
        $limit = 10;
        $jobSeekers=array();
        $jobSeekersCountByFilter=array();
        if($country_ids || $search || $advanceSearch || $state_ids || $city_ids){
            $jobSeekers = $this->fetchJobSeekers($search, $advanceSearch, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $degree_level_ids, $salary_period_ids,  $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, $willing_to_relocate, $ready_to_work, $profile_video, $resume_attach, $updated_date, $searchCriteria, $order_by, $sortBy, $limit);
            $jobSeekersCountByFilter = $this->fetchJobSeekersCountByFilterWise($search, $advanceSearch, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $degree_level_ids, $salary_period_ids,  $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, $willing_to_relocate, $ready_to_work, $profile_video, $resume_attach, $updated_date,$searchCriteria);
        }
//dd($jobSeekersCountByFilter);
        /*         * ************************************************** */

        $jobSeekerIdsArray = $this->fetchIdsArray($search, $advanceSearch, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $degree_level_ids, $salary_period_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, $willing_to_relocate, $ready_to_work, $profile_video, $resume_attach, $updated_date, $searchCriteria,  'users.id');

        /*         * ************************************************** */

        $skillIdsArray = $this->fetchSkillIdsArray($jobSeekerIdsArray);

        /*         * ************************************************** */

        $countryIdsArray = $this->fetchIdsArray($search, $advanceSearch, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $degree_level_ids, $salary_period_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, $willing_to_relocate, $ready_to_work, $profile_video, $resume_attach, $updated_date, $searchCriteria,  'users.country_id');

        /*         * ************************************************** */

        $stateIdsArray = $this->fetchIdsArray($search, $advanceSearch, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $degree_level_ids, $salary_period_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, $willing_to_relocate, $ready_to_work, $profile_video, $resume_attach, $updated_date, $searchCriteria,  'users.state_id');

        /*         * ************************************************** */

        $cityIdsArray = $this->fetchIdsArray($search, $advanceSearch, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $degree_level_ids, $salary_period_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, $willing_to_relocate, $ready_to_work, $profile_video, $resume_attach, $updated_date, $searchCriteria,  'users.city_id');

        /*         * ************************************************** */

        $industryIdsArray = $this->fetchIdsArray($search, $advanceSearch, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $degree_level_ids, $salary_period_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, $willing_to_relocate, $ready_to_work, $profile_video, $resume_attach, $updated_date, $searchCriteria,  'users.industry_id');

        /*         * ************************************************** */


        /*         * ************************************************** */

        $functionalAreaIdsArray = $this->fetchIdsArray($search, $advanceSearch, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $degree_level_ids, $salary_period_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, $willing_to_relocate, $ready_to_work, $profile_video, $resume_attach, $updated_date, $searchCriteria,  'users.functional_area_id');

        /*         * ************************************************** */

        $careerLevelIdsArray = $this->fetchIdsArray($search, $advanceSearch, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $degree_level_ids, $salary_period_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, $willing_to_relocate, $ready_to_work, $profile_video, $resume_attach, $updated_date, $searchCriteria,  'users.career_level_id');

        /*         * ************************************************** */

        $degreeLevelIdsArray = $this->fetchIdsArray($search, $advanceSearch, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $degree_level_ids, $salary_period_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, $willing_to_relocate, $ready_to_work, $profile_video, $resume_attach, $updated_date, $searchCriteria,  'users.degree_level_id');

//        $degreeLevelIdsArray = DegreeLevel::where('is_active', 1)->get();

        /*         * ************************************************** */

        $salaryPeriodIdsArray = $this->fetchIdsArray($search, $advanceSearch, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $degree_level_ids, $salary_period_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, $willing_to_relocate, $ready_to_work, $profile_video, $resume_attach, $updated_date, $searchCriteria,  'users.salary_period_id');

        /*         * ************************************************** */

        $genderIdsArray = $this->fetchIdsArray($search, $advanceSearch, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $degree_level_ids, $salary_period_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, $willing_to_relocate, $ready_to_work, $profile_video, $resume_attach, $updated_date, $searchCriteria,  'users.gender_id');

//        $genderIdsArray= Gender::where('is_active',1)->get();

        /*         * ************************************************** */

        $jobExperienceIdsArray = $this->fetchIdsArray($search, $advanceSearch, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $degree_level_ids, $salary_period_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, $willing_to_relocate, $ready_to_work, $profile_video, $resume_attach, $updated_date, $searchCriteria,  'users.job_experience_id');

//        $jobExperienceIdsArray = JobExperience::where('is_active',1)->get();

        /*         * ************************************************** */

        $seoArray = $this->getSEO($functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $degree_level_ids, $salary_period_ids, $gender_ids, $job_experience_ids);

        /*         * ************************************************** */

        $currencies = DataArrayHelper::currenciesArray();

        /*         * ************************************************** */

        $seo = (object) array(
                    'seo_title' => 'Hospitality, Travel &amp; Tourism Recruitment Post Covid',
                    'seo_description' => $seoArray['description'],
                    'seo_keywords' => $seoArray['keywords'],
                    'seo_other' => ''
        );
        $favouriteJobseekers=[];
        $addedFavouriteJobseekers = FavouriteJobSeeker::where('user_id',auth()->id())->get();
        if($addedFavouriteJobseekers){
            foreach ($addedFavouriteJobseekers as $addedFavouriteJobseeker){
                $favouriteJobseekers[$addedFavouriteJobseeker->id]=$addedFavouriteJobseeker->jobseeker_id;
            }
        }

        $url = $request->fullUrl();
        return view('employer.search-list')
                        ->with('functionalAreas', $this->functionalAreas)
                        ->with('countries', $this->countries)
                        ->with('currencies', array_unique($currencies))
                        ->with('jobSeekers', $jobSeekers)
                        ->with('skillIdsArray', $skillIdsArray)
                        ->with('countryIdsArray', $countryIdsArray)
                        ->with('stateIdsArray', $stateIdsArray)
                        ->with('cityIdsArray', $cityIdsArray)
                        ->with('industryIdsArray', $industryIdsArray)
                        ->with('functionalAreaIdsArray', $functionalAreaIdsArray)
                        ->with('careerLevelIdsArray', $careerLevelIdsArray)
                        ->with('degreeLevelIdsArray', $degreeLevelIdsArray)
                        ->with('salaryPeriodIdsArray', $salaryPeriodIdsArray)
                        ->with('genderIdsArray', $genderIdsArray)
                        ->with('jobExperienceIdsArray', $jobExperienceIdsArray)
                        ->with('seo', $seo)
                        ->with('favouriteJobseekers', $favouriteJobseekers)
                        ->with('jobSeekersCountByFilter', $jobSeekersCountByFilter)
                        ->with('requestUrl', $url);
    }

    public function jobSeekersSearchSave(Request $request)
    {
        $search_title= $request->input('search_title');
        $requestSearchUrl= $request->input('requestSearchUrl');

        $jobSeekerSearchSave = new JobSeekerSearchSave();

        $jobSeekerSearchSave->user_id=auth()->id();
        $jobSeekerSearchSave->title=$search_title;
        $jobSeekerSearchSave->search_request_url=$requestSearchUrl;
        $jobSeekerSearchSave->save();
        flash(__('Search has been successfully saved.'))->success();
        return redirect(url()->previous());

    }

    public function favouriteJobSeekersSave(Request $request)
    {
        $favouriteJobSeeker = new FavouriteJobSeeker();

        $existJobSeeker= FavouriteJobSeeker::where('user_id',auth()->id())->where('jobseeker_id',$request->request->get('jobseeker_id'))->first();
        if(!$existJobSeeker){
            $favouriteJobSeeker->user_id=auth()->id();
            $favouriteJobSeeker->jobseeker_id=$request->request->get('jobseeker_id');
            $favouriteJobSeeker->save();
            flash(__('This Jobseeker has been successfully favourite listed.'))->success();
            return new JsonResponse(array('status'=>'success','id'=>$favouriteJobSeeker->id));
        }
        return new JsonResponse('error');

    }

    public function favouriteJobSeekersRemove(Request $request)
    {
        $id = $request->request->get('jobseeker_id');
        $favouriteJobSeeker=FavouriteJobSeeker::find($id);

        if($favouriteJobSeeker->user_id==auth()->id()){
            $favouriteJobSeeker->delete();

            return new JsonResponse('success');
        }
        return new JsonResponse('error');

    }

    public function showSaveSearch()
    {
        $userId = Auth::user()->id;
        $user = auth()->user();
        if($user->user_type == 'sub_account'){
            $jobSeekerSearchSave = DB::table('jobseeker_search_save')->where('user_id',$userId)->get();
            $saveSearchCount = $jobSeekerSearchSave->count();

            $saveprofileCount = DB::table('favourite_jobseeker')->where('user_id',$userId)->get();
            $countSaveProfile = $saveprofileCount->count();

            return view('user.subAccount_save_search')
                ->with('jobSeekerSearchSave', $jobSeekerSearchSave)
                ->with('countSaveProfile', $countSaveProfile)
                ->with('saveSearchCount', $saveSearchCount);
        } elseif($user->user_type == 'employer'){
            $jobSeekerSearchSave = DB::table('jobseeker_search_save')->where('user_id',$userId)->get();
            $saveSearchCount = $jobSeekerSearchSave->count();

            $saveprofileCount = DB::table('favourite_jobseeker')->where('user_id',$userId)->get();
            $countSaveProfile = $saveprofileCount->count();

            return view('user.employer_save_search')
                ->with('jobSeekerSearchSave', $jobSeekerSearchSave)
                ->with('countSaveProfile', $countSaveProfile)
                ->with('saveSearchCount', $saveSearchCount);
        } else{
            return redirect('/home');
        }
    }

    public function showSaveJobseekerProfile()
    {
        $userId = Auth::user()->id;
        $user = auth()->user();
        if($user->user_type == 'sub_account'){
            $savedJobseekerPofiles = DB::table('favourite_jobseeker')
                ->select('favourite_jobseeker.id','name', 'email', 'phone')
                ->addSelect('users.id as userId', 'users.country_id', 'users.state_id',  'users.image', 'users.other_job_title', 'users.city_id','users.created_at','users.updated_at')
                ->addSelect('countries.country', 'states.state', 'cities.city')
                ->leftJoin('users', 'users.id', '=', 'favourite_jobseeker.jobseeker_id')
                ->leftJoin('countries', 'countries.id', '=', 'users.country_id')
                ->leftJoin('states', 'states.id', '=', 'users.state_id')
                ->leftJoin('cities', 'cities.id', '=', 'users.city_id')
                ->where('user_id',$userId)->get();

            $saveprofileCount = DB::table('favourite_jobseeker')->where('user_id',$userId)->get();
            $countSaveProfile = $saveprofileCount->count();
            $jobSeekerSearchSave = DB::table('jobseeker_search_save')->where('user_id',$userId)->get();
            $saveSearchCount = $jobSeekerSearchSave->count();

            return view('employer.subAccount_saved_favourite_jobseeker_list')
                ->with('savedJobseekerPofiles', $savedJobseekerPofiles)
                ->with('saveSearchCount', $saveSearchCount)
                ->with('countSaveProfile', $countSaveProfile);
        } elseif($user->user_type == 'employer') {
        $savedJobseekerPofiles = DB::table('favourite_jobseeker')
            ->select('favourite_jobseeker.id','name', 'email', 'phone')
            ->addSelect('users.id as userId', 'users.country_id', 'users.state_id',  'users.image', 'users.other_job_title', 'users.city_id','users.created_at','users.updated_at')
            ->addSelect('countries.country', 'states.state', 'cities.city')
            ->addSelect('deleted_users.user_name', 'deleted_users.user_email')
            ->leftJoin('users', 'users.id', '=', 'favourite_jobseeker.jobseeker_id')
            ->leftJoin('countries', 'countries.id', '=', 'users.country_id')
            ->leftJoin('states', 'states.id', '=', 'users.state_id')
            ->leftJoin('cities', 'cities.id', '=', 'users.city_id')
            ->leftJoin('deleted_users', 'deleted_users.user_id', '=', 'favourite_jobseeker.jobseeker_id')
            ->where('favourite_jobseeker.user_id',$userId)->get();

        $saveprofileCount = DB::table('favourite_jobseeker')->where('user_id',$userId)->get();
        $countSaveProfile = $saveprofileCount->count();
        $jobSeekerSearchSave = DB::table('jobseeker_search_save')->where('user_id',$userId)->get();
        $saveSearchCount = $jobSeekerSearchSave->count();

        return view('employer.saved_favourite_jobseeker_list')
            ->with('savedJobseekerPofiles', $savedJobseekerPofiles)
            ->with('saveSearchCount', $saveSearchCount)
            ->with('countSaveProfile', $countSaveProfile);
        } else {
            return redirect('/home');
        }
    }

    public function deleteSaveSearch(Request $request){
        $id = $request->request->get('id');
        $jobSeekerSearchSave=JobSeekerSearchSave::find($id);

        if($jobSeekerSearchSave->user_id==auth()->id()){
            $jobSeekerSearchSave->delete();

            return new JsonResponse('success');
        }
        return new JsonResponse('error');
    }

}
