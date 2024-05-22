<?php

namespace App\Http\Controllers;

use App\Helpers\DataArrayHelper;
use Illuminate\Http\Request;

class ShootingClubController extends Controller
{

    public function index(){

        $pageTitle='Member Clubs';
        $returnArray=[];
        $membersClubArray = DataArrayHelper::membersClubArray();
        if($membersClubArray){
            foreach ($membersClubArray as $value){
                $returnArray[$value['club_type']][]= $value;
            }
        }

//dd($returnArray);
        return view('shooting_club.index')
            ->with('pageTitle', $pageTitle)
            ->with('membersClub', $returnArray);
    }
}
