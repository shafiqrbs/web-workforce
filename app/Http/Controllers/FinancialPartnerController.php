<?php

namespace App\Http\Controllers;

use App\Helpers\DataArrayHelper;
use App\Models\Banner;
use App\Models\FinancialPartner;
use App\Models\ShootingSportClub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinancialPartnerController extends Controller
{
    public function index(Request $request){
        $pageTitle = 'Financial Partner';
        $partnerData = FinancialPartner::where('is_active',1)->orderBy('sort_order')->get()->toArray();
        $bannerData = Banner::getPageWiseBannerInfo('financial-partner');
        return view('financial-partner.index', compact(['pageTitle','partnerData','bannerData']));
    }

    /*public function clubDetails($clubID){
        $pageTitle = "Club Details";
        if ($clubID){
            $clubDetails = ShootingSportClub::find($clubID);
            $division = DB::table('division')->find($clubDetails['division_id']);
        }
        return view('club.details',compact(['pageTitle','clubDetails','division']));
    }*/

}
