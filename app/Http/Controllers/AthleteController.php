<?php

namespace App\Http\Controllers;

use App\Gender;
use App\Helpers\DataArrayHelper;
use App\Models\Athlete;
use App\Models\Banner;
use App\Models\BloodGroup;
use App\Models\FinancialPartner;
use App\Models\ShootingSportClub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AthleteController extends Controller
{
    public function athleteIndex($type){
        $pageTitle = 'Athletes';
        $pathPageTitle = $type;
        if ($type == 'Pistol'){
            $pageSlug = 'pistol-athlete';
            $pathPageTitle = 'Pistol';
        }elseif ($type == 'Rifle'){
            $pageSlug = 'rifle-athlete';
            $pathPageTitle = 'Rifle';
        }elseif ($type == 'Short'){
            $pageSlug = 'short-athlete';
            $pathPageTitle = 'Short Gun';
        }else{
            $pageSlug = 'handicapped-athlete';
            $pathPageTitle = 'Handicapped';
        }
        $bannerData = Banner::getPageWiseBannerInfo($pageSlug);
        $athleteData = Athlete::getTypeWiseAthlete($type);

        return view('athlete.index', compact(['pageTitle','athleteData','pathPageTitle','bannerData']));
    }

    public function athleteDetails($id){
        $athleteData = Athlete::getIdWiseAthlete($id);
        $gender = Gender::find($athleteData['gender_id']);
        $bloodGroup = BloodGroup::find($athleteData['blood_group_id']);
        $profession = DB::table('professions')->find($athleteData['profession_id']);
        $relatedAthletes = Athlete::getRelatedAthlets($id,$athleteData['athlete_type'],$athleteData['is_present']);

        $pageTitle = 'Athletes';
        $pathPageTitle = $athleteData->athlete_type;

        if ($pathPageTitle == 'Pistol'){
            $pageSlug = 'pistol-athlete';
        }else{
            $pageSlug = 'rifle-athlete';
        }
        $bannerData = Banner::getPageWiseBannerInfo($pageSlug);

        return view('athlete.details',compact(['pageTitle','athleteData','gender','bloodGroup','profession','relatedAthletes','pathPageTitle','bannerData']));
    }

}
