<?php

namespace App\Http\Controllers;

use App\Helpers\DataArrayHelper;
use App\Models\Banner;
use App\Models\CommitteeMember;
use App\Models\Member;
use Illuminate\Http\Request;

class CommitteeMemberController extends Controller
{

    public function index($committeeType){

        $committeeMembers=null;
        $pageTitle=null;
        $committeeMembersArray=null;
        $subCommitteeGroups=[];

        if($committeeType!=''&&$committeeType=="executive-committee"){
            $pageTitle='Executive Committee';
            $committeeMembersArray = DataArrayHelper::committeeMembersArray('EXECUTIVE_COMMITTEE');
            $bannerData = Banner::getPageWiseBannerInfo('executive-committee');

        }elseif ($committeeType!=''&&$committeeType=="camp-commandant-coach"){
            $pageTitle='Camp Commandant & Coach';
            $committeeMembersArray = DataArrayHelper::committeeMembersArray('CAMP_COMMANDANT_COACH');
            $bannerData = Banner::getPageWiseBannerInfo('camp-commandant-coach');

        }elseif ($committeeType!=''&&$committeeType=="office-administration"){
            $pageTitle='Office Administration';
            $committeeMembersArray = DataArrayHelper::committeeMembersArray('OFFICE_ADMINISTRATION');
            $bannerData = Banner::getPageWiseBannerInfo('office-administration');

        }elseif ($committeeType!=''&&$committeeType=="sub-committee"){
            $pageTitle='Sub Committee';
            $committeeMembersArray = DataArrayHelper::committeeMembersArray('SUB_COMMITTEE');
            $bannerData = Banner::getPageWiseBannerInfo('sub-committee');

        }
        if($committeeType=="sub-committee"){
            $subCommitteeGroups = [
                'TRAINING_AND_COMPETITION' => 'Training and Competition',
                'FINANCE' => 'Finance',
                'IMPORT_AND_ALLOCATION' => 'Import and Allocation',
                'ADMINISTRATION_AND_DISCIPLINE' => 'Administration and Discipline',
                'SERVICES_AND_SUPPLIES' => 'Services and Supplies',
                'AUDITORIUM_FOOD_AND_ACCOMMODATION' => 'Auditorium, Food and Accommodation',
                'JUDGES_AND_TECHNICAL' => 'Judges and Technical',
                'CLUB_GRADATION_RANGE_DEVELOPMENT_AND_PUBLICATION' => 'Club Gradation, Range Development and Publication',
                'PROMOTION_PUBLICATION' => 'Promotion and Publication',
                'HEALTH_TREATMENT' => 'Health & Treatment',
                'REGULATIONS_LAW' => 'Regulations/law',
            ];

            if($committeeMembersArray){
                foreach ($committeeMembersArray as $value){
                    $committeeMembers[$value['sub_committee_group']][$value['career_level']][]=$value;
                }
            }
        }else{
            if($committeeMembersArray){
                foreach ($committeeMembersArray as $value){
                    $committeeMembers[$value['career_level']][]=$value;
                }
            }
        }
        return view('committee_member.index')
            ->with('pageTitle', $pageTitle)
            ->with('subCommitteeGroups', $subCommitteeGroups)
            ->with('committeeType', $committeeType)
            ->with('type', $committeeType)
            ->with('bannerData', $bannerData)
            ->with('committeeMembers', $committeeMembers);
    }

    public function memberDetails($id){
        $member = Member::with(array(
            'memberDesignation' => function($query){
                $query->select([
                    'members_join_designation.member_id',
                    'members_join_designation.committee_type',
                    'members_join_designation.sub_committee_group',
                    'members_join_designation.designation_id',
                    'career_levels.career_level as designation',
                ])
                    ->join('career_levels', 'career_levels.id', '=', 'members_join_designation.designation_id');
            }
        ))
            ->where('members.id',$id)
            ->where('members.is_active',1)
            ->first();


            if ($member->memberDesignation){
                $committeeType = '';
                $index = 1;
                foreach ($member->memberDesignation as $val){
                    $type = $val->committee_type;
                    if ($val->committee_type == 'EXECUTIVE_COMMITTEE'){
                        $type = 'Execuitive Committee';
                    }elseif ($val->committee_type == 'CAMP_COMMANDANT_COACH'){
                        $type = 'Camp Commandant Coach';
                    }elseif ($val->committee_type == 'OFFICE_ADMINISTRATION'){
                        $type = 'Office Administration';
                    }else {
                        if ($val->committee_type == 'SUB_COMMITTEE') {
                            if ($val->sub_committee_group == 'TRAINING_AND_COMPETITION'){
                                $type = 'Training and Competition';
                            }
                            if ($val->sub_committee_group == 'FINANCE'){
                                $type = 'Finance';
                            }
                            if ($val->sub_committee_group == 'IMPORT_AND_ALLOCATION'){
                                $type = 'Import and Allocation';
                            }
                            if ($val->sub_committee_group == 'ADMINISTRATION_AND_DISCIPLINE'){
                                $type = 'Administration and Discipline';
                            }
                            if ($val->sub_committee_group == 'SERVICES_AND_SUPPLIES'){
                                $type = 'Services and Supplies';
                            }
                            if ($val->sub_committee_group == 'AUDITORIUM_FOOD_AND_ACCOMMODATION'){
                                $type = 'Auditorium, Food and Accommodation';
                            }
                            if ($val->sub_committee_group == 'JUDGES_AND_TECHNICAL'){
                                $type = 'Judges and Technical';
                            }
                            if ($val->sub_committee_group == 'CLUB_GRADATION_RANGE_DEVELOPMENT_AND_PUBLICATION'){
                                $type = 'Club Gradation, Range Development and Publication';
                            }
                        }
                    }
                    $committeeType = $committeeType. $type . ' - (' . $val->designation.')'.', ';
                    $index++;
                }
                $committeeType = substr(trim($committeeType), 0, -1);
            }



        $pageTitle = 'Details';
        $careerLavel = null;

        $pathPageTitle = null;
        $bannerData = Banner::getPageWiseBannerInfo('Member-details');
        return view('committee_member.details',compact(['pageTitle','member','pathPageTitle','committeeType','bannerData']));
    }

    public function memberDetailsOffice($id){
        $member = CommitteeMember::select('committee_members.id', 'committee_members.name', 'committee_members.profile_image', 'committee_members.facebook_link', 'committee_members.mobile', 'committee_members.email', 'committee_members.address', 'committee_members.short_message', 'committee_members.sub_committee_group','committee_members.committee_type','career_levels.career_level')
            ->where('committee_members.id',$id)
            ->where('committee_members.is_active',1)
            ->join('career_levels','career_levels.id','=','committee_members.designation_id')
            ->first()->toArray();

        $committeeType = $member['career_level'];

        $pageTitle = 'DetailsOffice';

        $pathPageTitle = null;
        $bannerData = Banner::getPageWiseBannerInfo('Member-details');
        return view('committee_member.details',compact(['pageTitle','member','pathPageTitle','committeeType','bannerData']));
    }
}
