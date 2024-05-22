<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Models\Athlete;
use App\Models\CommitteeMember;
use App\Models\Event;
use App\Models\FinancialPartner;
use App\Models\ShootingSportClub;
use App\User;
use App\Job;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now();
        $systemUser = Admin::count();
        $athleteUser = Athlete::where('is_active',1)->count();
        $totalClub = ShootingSportClub::where('is_active',1)->count();
        $totalPartner = FinancialPartner::where('is_active',1)->count();
        $totalEvent = Event::where('is_active',1)->count();
        $totalMember = CommitteeMember::where('is_active',1)->count();

        $recentAthletes = Athlete::orderBy('id', 'DESC')->where('is_active',1)->take(25)->get();
        $recentEvents = Event::orderBy('id', 'DESC')->where('is_active',1)->take(25)->get();

        return view('admin.home',compact('systemUser','athleteUser','totalClub','totalPartner','totalEvent','totalMember','recentAthletes','recentEvents'));
    }

}
