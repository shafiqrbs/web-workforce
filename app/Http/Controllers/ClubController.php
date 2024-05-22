<?php

namespace App\Http\Controllers;

use App\Helpers\DataArrayHelper;
use App\Models\Banner;
use App\Models\ShootingSportClub;
use App\Models\VisitorCount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClubController extends Controller
{
    public function index(Request $request){
        $pageTitle = __('messages.Clubs');
        $divisions = DataArrayHelper::langDivisionsArray();
        $clubData = '';
        $divisionID = '';
        $message = '';
        $pathPageTitle = '';
        $subPathPageTitle = '';
        $submitName = $request->get('submit-form');
        if (isset($request) && $submitName == 'club-search' ){
            $pathPageTitle = __('messages.Search');
            $divisionID = $request->get('division_id');
            $clubData = DataArrayHelper::divisionWiseClubArray($divisionID);
            $countClubData = count($clubData);
            if ($countClubData>0){
                $message = __('messages.Total').' '.$countClubData.' '.__('messages.clubs_found');
            }else{
                $message = __('messages.No_clubs_found');
            }
        }

        $bannerData = Banner::getPageWiseBannerInfo('club');
        return view('club.index', compact(['pageTitle','divisions','clubData','divisionID','message','bannerData','pathPageTitle']));
    }

    public function clubDetails($clubID){
        $pageTitle = __('messages.Clubs');

        if ($clubID){
            $clubDetails = ShootingSportClub::getClubDataByID($clubID);
            $division = DB::table('division')->find($clubDetails['division_id']);
        }
        $bannerData = Banner::getPageWiseBannerInfo('club');
        $pathPageTitle = $clubDetails->name;
        return view('club.details',compact(['pageTitle','clubDetails','division','bannerData','pathPageTitle']));
    }

}
