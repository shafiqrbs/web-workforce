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

    public function details($slug){
        $pageTitle = "Details";
        $bannerData = Banner::getPageWiseBannerInfo('financial-partner');

        if ($slug==='male' || $slug==='female') {
            $partnerDetails = FinancialPartner::where('is_active',1)->whereNotNull($slug)->where($slug,'>',0)->orderBy('sort_order');
        }else{
            $partnerDetails = FinancialPartner::where('is_active',1)->where('partner_group',$slug)->orderBy('sort_order');
        }
        $partnerDetails = $partnerDetails->paginate(10);

        return view('financial-partner.achievement',compact(['pageTitle','partnerDetails','bannerData']));
    }

}
