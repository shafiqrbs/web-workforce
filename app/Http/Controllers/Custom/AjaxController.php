<?php

namespace App\Http\Controllers\Custom;

use App\City;
use App\Country;
use App\Http\Controllers\Controller;
use App\JobTitle;
use App\JobTitleOther;
use App\State;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    /** Job Seeker Registration
     * Render Cities
     */
    public function renderCities(Request $request)
    {
        $added_city_id = isset($request->added_city_id)?$request->added_city_id:'';
        $cities = City::select('id', 'city')->where('is_active', 1)->where('state_id', $request->id)->orderBy('city', 'ASC')->get();
        $html = view('auth.cities_ajax', compact(['cities','added_city_id']))->render();
        return response()->json(['id'=>$request->id,'html'=>$html]);
    }


    public function renderJobTitles(Request $request)
    {
        $job_title = isset($request->job_title)?$request->job_title:'';
        $jobTitles=[];
        $jobTitleOthers=[];
        if($job_title){
            $jobTitles = JobTitle::select('id','job_title')->where('is_active', 1)->where('job_title', 'LIKE', "%{$job_title}%")->orderBy('job_title','ASC')->get();
        }
        if($job_title){
            $jobTitleOthers = JobTitleOther::select('id','job_title')->where('is_active', 1)->where('job_title', 'LIKE', "%{$job_title}%")->orderBy('job_title','ASC')->get();
        }

        $html = view('ajax.job_titles_ajax', compact(['jobTitles','jobTitleOthers']))->render();
        return response()->json(['html'=>$html]);
    }
}
