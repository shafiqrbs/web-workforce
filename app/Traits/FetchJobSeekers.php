<?php

namespace App\Traits;

use App\DegreeLevel;
use DB;
use App\User;
use App\Country;
use App\State;
use App\City;
use App\CareerLevel;
use App\FunctionalArea;
use App\Gender;
use App\ProfileSkill;
use App\JobExperience;

trait FetchJobSeekers
{

    public function fetchJobSeekers($search = '', $advanceSearch='', $industry_ids = array(), $functional_area_ids = array(), $country_ids = array(), $state_ids = array(), $city_ids = array(), $career_level_ids = array(), $degree_level_ids = array(), $salary_period_ids = array(), $gender_ids = array(), $job_experience_ids = array(), $current_salary = 0, $expected_salary = 0, $salary_currency = '', $willing_to_relocate='',$ready_to_work='', $profile_video='', $resume_attach='', $updated_date='',$searchCriteria='', $order_by = 'id', $sortBy='DESC', $limit = 10)
    {
        $asc_desc = 'DESC';
        $query = User::select($this->fields);
        $query = $this->createQuery($query, $search, $advanceSearch, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $degree_level_ids, $salary_period_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, $willing_to_relocate, $ready_to_work,$profile_video, $resume_attach, $updated_date,$searchCriteria);
        $query->groupBy('users.id');
        $query->orderBy('users.updated_at', $sortBy);
        //echo $query->toSql();exit;
        return $query->paginate($limit);
    }

    public function fetchJobSeekersCountByFilterWise($search = '', $advanceSearch='', $industry_ids = array(), $functional_area_ids = array(), $country_ids = array(), $state_ids = array(), $city_ids = array(), $career_level_ids = array(), $degree_level_ids = array(), $salary_period_ids = array(), $gender_ids = array(), $job_experience_ids = array(), $current_salary = 0, $expected_salary = 0, $salary_currency = '', $willing_to_relocate='',$ready_to_work='', $profile_video='', $resume_attach='',$updated_date='',$searchCriteria='')
    {
        $asc_desc = 'DESC';
        $query = User::select($this->fields);
        $query = $this->createQuery($query, $search, $advanceSearch, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $degree_level_ids, $salary_period_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, $willing_to_relocate, $ready_to_work,$profile_video, $resume_attach, $updated_date,$searchCriteria);
        $query->groupBy('users.id');
//        $query->orderBy('users.id', 'DESC');
        //echo $query->toSql();exit;
        $results = $query->get();
        $returnArray = array();
        foreach ($results as $result){
            $returnArray['job_experience'][$result->job_experience_id][]=$result->id;
            $returnArray['degree_level'][$result->degree_level_id][]=$result->id;
            $returnArray['gender'][$result->gender_id][]=$result->id;
        }
        return $returnArray;
    }

    private $fields = array(
        'users.id',
        'users.first_name',
        'users.middle_name',
        'users.last_name',
        'users.name',
        'users.email',
        'users.father_name',
        'users.date_of_birth',
        'users.gender_id',
        'users.marital_status_id',
        'users.nationality_id',
        'users.national_id_card_number',
        'users.country_id',
        'users.state_id',
        'users.city_id',
        'users.phone',
        'users.mobile_num',
        'users.job_experience_id',
        'users.career_level_id',
        'users.degree_level_id',
        'users.industry_id',
        'users.functional_area_id',
        'users.current_salary',
        'users.expected_salary',
        'users.salary_currency',
        'users.street_address',
        'users.is_active',
        'users.verified',
        'users.verification_token',
        'users.provider',
        'users.provider_id',
        'users.password',
        'users.remember_token',
        'users.image',
        'users.lang',
        'users.created_at',
        'users.updated_at',
        'users.is_immediate_available',
        'users.num_profile_views',
        'users.package_id',
        'users.package_start_date',
        'users.package_end_date',
        'users.jobs_quota',
        'users.availed_jobs_quota',
        'users.user_type',
        'users.willing_to_relocate',
        'users.other_job_title',
        'users.search'
    );

    public function fetchIdsArray($search = '', $advanceSearch='', $industry_ids = array(), $functional_area_ids = array(), $country_ids = array(), $state_ids = array(), $city_ids = array(), $career_level_ids = array(), $degree_level_ids = array(), $salary_period_ids = array(),  $gender_ids = array(), $job_experience_ids = array(), $current_salary = 0, $expected_salary = 0, $salary_currency = '', $willing_to_relocate='',$ready_to_work='', $profile_video='', $resume_attach='', $updated_date='',$searchCriteria='', $field = 'users.id')
    {
        $query = User::select($field);
        $query = $this->createQuery($query, $search, $advanceSearch, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $degree_level_ids, $salary_period_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, $willing_to_relocate, $ready_to_work, $profile_video, $resume_attach, $updated_date,$searchCriteria);

        $array = $query->pluck($field)->toArray();
        return array_unique($array);
    }

    public function createQuery($query, $search = '', $advanceSearch='', $industry_ids = array(), $functional_area_ids = array(), $country_ids = array(), $state_ids = array(), $city_ids = array(), $career_level_ids = array(), $degree_level_ids = array(), $salary_period_ids = array(), $gender_ids = array(), $job_experience_ids = array(), $current_salary = 0, $expected_salary = 0, $salary_currency = '', $willing_to_relocate='', $ready_to_work='', $profile_video='', $resume_attach='', $updated_date='',$searchCriteria='')
    {
        $query->join('user_job_titles', 'user_job_titles.user_id', '=', 'users.id');
        $query->join('job_titles', 'job_titles.id', '=', 'user_job_titles.job_title_id');

//        $query->leftJoin('profile_summaries', 'profile_summaries.user_id', '=', 'users.id');

        $query->where('users.user_type', 'candidate');
        $query->where('users.is_active', 1);
        $query->where('users.verified', 1);
        $query->where('users.profile_visibility', 1);
        if ($search != '') {
            $query->where(function($q)use ($search) {
                $q->where('job_titles.job_title','like',$search)
                    ->orWhere('users.other_job_title', 'LIKE', '%'.$search.'%');
            });
        }
        if ($advanceSearch != '') {

            if($searchCriteria != ''){
                if($searchCriteria == 'allOfTheWord'){
                    $wordsAry = explode(' ',$advanceSearch);
                    $wordsCount = count($wordsAry);
                    if($wordsCount>0){
                        $query->where(function ($q) use ($wordsAry) {
                            foreach( $wordsAry as $word) {
                                $q->where('users.resume_content', 'LIKE', '%' . $word . '%')
                                    /*->orWhere('users.other_languages', 'LIKE', '%' . $word . '%')
                                    ->orWhere('users.street_address', 'LIKE', '%' . $word . '%')
                                    ->orWhere('users.other_job_title', 'LIKE', '%' . $word . '%')
                                    ->orWhere('users.resume_content', 'LIKE', '%' . $word . '%')
                                    ->orWhere('profile_summaries.summary', 'like', $word)*/;
                            }
                        });

                    }
                }elseif($searchCriteria =='exactPhrase'){
                    $query->where(function ($q) use ($advanceSearch) {
                        $q->where('users.resume_content', 'LIKE', '%' . $advanceSearch . '%')
                            /*->orWhere('users.other_languages', 'LIKE', '%' . $advanceSearch . '%')
                            ->orWhere('users.street_address', 'LIKE', '%' . $advanceSearch . '%')
                            ->orWhere('users.other_job_title', 'LIKE', '%' . $advanceSearch . '%')
                            ->orWhere('users.resume_content', 'LIKE', '%' . $advanceSearch . '%')
                            ->orWhere('profile_summaries.summary', 'like', $advanceSearch)*/;
                    });
                }elseif($searchCriteria =='leastOneWordsSpecified'){
                    $wordsAry = explode(' ',$advanceSearch);
                    $wordsCount = count($wordsAry);
                    if($wordsCount>0){
                            $query->where(function ($q) use ($wordsAry) {
                                foreach( $wordsAry as $word) {
                                $q->orWhere('users.resume_content', 'LIKE', '%' . $word . '%')
                                    /*->orWhere('users.other_languages', 'LIKE', '%' . $word . '%')
                                    ->orWhere('users.street_address', 'LIKE', '%' . $word . '%')
                                    ->orWhere('users.other_job_title', 'LIKE', '%' . $word . '%')
                                    ->orWhere('users.resume_content', 'LIKE', '%' . $word . '%')
                                    ->orWhere('profile_summaries.summary', 'like', $word)*/;
                                }
                            });

                    }
                }/*elseif($searchCriteria =='oneWordsSpecified'){
                    $wordsAry = explode(' ',$advanceSearch);
                    $wordsCount = count($wordsAry);
                    if($wordsCount>0){
                        foreach( $wordsAry as $word) {
                            $query->where(function ($q) use ($word) {
                                $q->where('users.other_job_title', 'LIKE', '%' . $word . '%')
                                    ->orWhere('users.other_languages', 'LIKE', '%' . $word . '%')
                                    ->orWhere('users.street_address', 'LIKE', '%' . $word . '%')
                                    ->orWhere('users.other_job_title', 'LIKE', '%' . $word . '%')
                                    ->orWhere('users.resume_content', 'LIKE', '%' . $word . '%')
                                    ->orWhere('profile_summaries.summary', 'like', $word);
                            });
                        }
                    }
                }*//*elseif($searchCriteria =='lostVisit'){
                    $query->where(function ($q) use ($advanceSearch) {
                        $q->where('users.other_job_title', 'NOT LIKE', '%' . $advanceSearch . '%')
                            ->orWhere('users.other_languages', 'NOT LIKE', '%' . $advanceSearch . '%')
                            ->orWhere('users.street_address', 'NOT LIKE', '%' . $advanceSearch . '%')
                            ->orWhere('users.other_job_title', 'NOT LIKE', '%' . $advanceSearch . '%')
                            ->orWhere('users.resume_content', 'NOT LIKE', '%' . $advanceSearch . '%')
                            ->orWhere('profile_summaries.summary', 'NOT like', $advanceSearch);
                    });
                }*/
            }else{
                $query->where(function($q)use ($advanceSearch) {

                    $q->where('users.resume_content', 'LIKE', '%'.$advanceSearch.'%')
                        /*->orWhere('users.other_languages', 'LIKE', '%'.$advanceSearch.'%')
                        ->orWhere('users.street_address', 'LIKE', '%'.$advanceSearch.'%')
                        ->orWhere('users.other_job_title', 'LIKE', '%'.$advanceSearch.'%')
                        ->orWhere('users.resume_content', 'LIKE', '%'.$advanceSearch.'%')
                        ->orWhere('profile_summaries.summary','like',$advanceSearch)*/;
                });
            }


        }
        /*if ($advanceSearch != '') {
            $query->join('profile_summaries', 'profile_summaries.user_id', '=', 'users.id');
            $query->orWhere('profile_summaries.summary','like',$advanceSearch);
        }*/
        if (isset($industry_ids[0])) {
            $query->whereIn('users.industry_id', $industry_ids);
        }
        if (isset($functional_area_ids[0])) {
            $query->whereIn('users.functional_area_id', $functional_area_ids);
        }
        if (isset($country_ids[0])) {
            $query->whereIn('users.country_id', $country_ids);
        }
        if (isset($state_ids[0])) {
            $query->whereIn('users.state_id', $state_ids);
        }
        if (isset($city_ids[0])) {
            $query->whereIn('users.city_id', $city_ids);
        }
        if (isset($career_level_ids[0])) {
            $query->whereIn('users.career_level_id', $career_level_ids);
        }
        if (isset($degree_level_ids[0])) {
            $query->whereIn('users.degree_level_id', $degree_level_ids);
        }
        if (isset($salary_period_ids[0])) {
            $query->whereIn('users.salary_period_id', $salary_period_ids);
        }
        if (isset($gender_ids[0])) {
            $query->whereIn('users.gender_id', $gender_ids);
        }
        if (isset($job_experience_ids[0])) {
            $query->whereIn('users.job_experience_id', $job_experience_ids);
        }
        if ((int) $current_salary > 0) {
            $query->where('users.current_salary', '>=', $current_salary);
        }
        if ((int) $expected_salary > 0) {
            $query = $query->whereRaw("(`users`.`expected_salary` - $expected_salary) >= 0");
            //$query->where('jobs.salary_to', '<=', $salary_to);
        }
        if (!empty(trim($salary_currency))) {
            $query->where('users.salary_currency', 'like', $salary_currency);
        }
        if ($updated_date != '') {
            $endDate = date("Y-m-d");
            if($updated_date=='last_day'){
                $startDate= date("Y-m-d", strtotime("-1 days"));
            }elseif($updated_date=='last_week'){
                $startDate= date("Y-m-d", strtotime("-7 days"));
            }elseif($updated_date=='last_month'){
                $startDate= date("Y-m-d", strtotime("-1 month"));
            }elseif($updated_date=='last_3_months'){
                $startDate= date("Y-m-d", strtotime("-3 month"));
            }elseif($updated_date=='last_6_months'){
                $startDate= date("Y-m-d", strtotime("-6 month"));
            }elseif($updated_date=='show_all_profiles'){
                $startDate= "2019-01-01";
            }
            $query->where('users.updated_at', '>=', $startDate.' 00:00:00')
                ->where('users.updated_at', '<=', $endDate.' 23:59:59');
        } else{
            $endDate = date("Y-m-d");
            $startDate= date("Y-m-d", strtotime("-6 month"));
            $query->where('users.updated_at', '>=', $startDate.' 00:00:00')
                ->where('users.updated_at', '<=', $endDate.' 23:59:59');
        }
        if ($willing_to_relocate != '') {
            $query->where('users.willing_to_relocate', $willing_to_relocate);
        }
        if ($ready_to_work != '') {
            $query->where('users.is_immediate_available', $ready_to_work);
        }
        if ($profile_video != '') {
            $query->join('user_videos', 'users.id', '=', 'user_videos.user_id');
            $query->where('user_videos.status', 'approved');
        }
        if ($resume_attach != '') {
            $query->join('profile_cvs', 'users.id', '=', 'profile_cvs.user_id');
        }
        return $query;
    }

    public function fetchSkillIdsArray($jobSeekerIdsArray = array())
    {
        $query = ProfileSkill::select('job_skill_id');
        $query->whereIn('user_id', $jobSeekerIdsArray);

        $array = $query->pluck('job_skill_id')->toArray();
        return array_unique($array);
    }

    private function getSEO($functional_area_ids = array(), $country_ids = array(), $state_ids = array(), $city_ids = array(), $career_level_ids = array(), $degree_level_ids = array(), $salary_period_ids = array(), $gender_ids = array(), $job_experience_ids = array())
    {
        $description = 'Users ';
        $keywords = '';
        if (isset($functional_area_ids[0])) {
            foreach ($functional_area_ids as $functional_area_id) {
                $functional_area = FunctionalArea::where('functional_area_id', $functional_area_id)->lang()->first();
                if (null !== $functional_area) {
                    $description .= ' ' . $functional_area->functional_area;
                    $keywords .= $functional_area->functional_area . ',';
                }
            }
        }
        if (isset($country_ids[0])) {
            foreach ($country_ids as $country_id) {
                $country = Country::where('country_id', $country_id)->lang()->first();
                if (null !== $country) {
                    $description .= ' ' . $country->country;
                    $keywords .= $country->country . ',';
                }
            }
        }
        if (isset($state_ids[0])) {
            foreach ($state_ids as $state_id) {
                $state = State::where('state_id', $state_id)->lang()->first();
                if (null !== $state) {
                    $description .= ' ' . $state->state;
                    $keywords .= $state->state . ',';
                }
            }
        }
        if (isset($city_ids[0])) {
            foreach ($city_ids as $city_id) {
                $city = City::where('city_id', $city_id)->lang()->first();
                if (null !== $city) {
                    $description .= ' ' . $city->city;
                    $keywords .= $city->city . ',';
                }
            }
        }
        if (isset($career_level_ids[0])) {
            foreach ($career_level_ids as $career_level_id) {
                $career_level = CareerLevel::where('career_level_id', $career_level_id)->lang()->first();
                if (null !== $career_level) {
                    $description .= ' ' . $career_level->career_level;
                    $keywords .= $career_level->career_level . ',';
                }
            }
        }
        if (isset($degree_level_ids[0])) {
            foreach ($degree_level_ids as $degree_level_id) {
                $degree_level = DegreeLevel::where('degree_level_id', $degree_level_id)->lang()->first();
                if (null !== $degree_level) {
                    $description .= ' ' . $degree_level->degree_level;
                    $keywords .= $degree_level->degree_level . ',';
                }
            }
        }
        if (isset($gender_ids[0])) {
            foreach ($gender_ids as $gender_id) {
                $gender = Gender::where('gender_id', $gender_id)->lang()->first();
                if (null !== $gender) {
                    $description .= ' ' . $gender->gender;
                    $keywords .= $gender->gender . ',';
                }
            }
        }
        if (isset($job_experience_ids[0])) {
            foreach ($job_experience_ids as $job_experience_id) {
                $job_experience = JobExperience::where('job_experience_id', $job_experience_id)->lang()->first();
                if (null !== $job_experience) {
                    $description .= ' ' . $job_experience->job_experience;
                    $keywords .= $job_experience->job_experience . ',';
                }
            }
        }
        return ['keywords' => $keywords, 'description' => $description];
    }

}
