<?php

namespace App\Http\Controllers;

use App\Country;
use App\Models\Athlete;
use App\State;
use App\Traits\Cron;
use App\Job;
use App\FavouriteCompany;

use Illuminate\Http\Request;
use DB;
use Auth;

class HomeController extends Controller
{

    use Cron;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->runCheckPackageValidity();
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());

        } else {
            if($user->user_type == 'candidate'){
                $matchingJobs = Job::where('functional_area_id', auth()->user()->industry_id)->paginate(7);
                $followers = FavouriteCompany::where('user_id', auth()->user()->id)->get();
                $userProfileVideo = DB::table('user_videos')->where('user_id', auth()->user()->id)->first();
                $chart='';
                return view('home', compact('chart', 'matchingJobs', 'followers','userProfileVideo'));

            } elseif($user->user_type == 'sub_account'){
                $matchingJobs = Job::where('functional_area_id', auth()->user()->industry_id)->paginate(7);
                $country = Country::where('country', 'Canada')->first();
                $states = State::where('is_active',1)->where('country_id', $country->id)->orderBy('state', 'ASC')->get();
                $followers = FavouriteCompany::where('user_id', auth()->user()->id)->get();
                $userProfileVideo = DB::table('user_videos')->where('user_id', auth()->user()->id)->first();
                $chart='';
                $jobSeekerSearchSave = DB::table('jobseeker_search_save')->where('user_id',auth()->user()->id)->get();
                $saveSearchCount = $jobSeekerSearchSave->count();
                $saveprofileCount = DB::table('favourite_jobseeker')->where('user_id',auth()->user()->id)->get();
                $countSaveProfile = $saveprofileCount->count();
                return view('subAccount-home', compact('chart', 'matchingJobs', 'followers','userProfileVideo'))
                    ->with('country', $country)
                    ->with('saveSearchCount', $saveSearchCount)
                    ->with('countSaveProfile', $countSaveProfile)
                    ->with('states', $states);
            } else {
                $athleteData = Athlete::where('user_id',Auth()->user()->id)->first();
                return view('employer-home',['athleteData'=>$athleteData]);
//                dd($data);
                /*$matchingJobs = Job::where('functional_area_id', auth()->user()->industry_id)->paginate(7);
                $country = Country::where('country', 'Canada')->first();
                $states = State::where('is_active',1)->where('country_id', $country->id)->orderBy('state', 'ASC')->get();
                $followers = FavouriteCompany::where('user_id', auth()->user()->id)->get();
                $userProfileVideo = DB::table('user_videos')->where('user_id', auth()->user()->id)->first();
                $chart='';
                $jobSeekerSearchSave = DB::table('jobseeker_search_save')->where('user_id',auth()->user()->id)->get();
                $saveSearchCount = $jobSeekerSearchSave->count();
                $saveprofileCount = DB::table('favourite_jobseeker')->where('user_id',auth()->user()->id)->get();
                $countSaveProfile = $saveprofileCount->count();
                return view('employer-home', compact('chart', 'matchingJobs', 'followers','userProfileVideo'))
                    ->with('country', $country)
                    ->with('saveSearchCount', $saveSearchCount)
                    ->with('countSaveProfile', $countSaveProfile)
                    ->with('states', $states);*/
            }
        }

    }
}
