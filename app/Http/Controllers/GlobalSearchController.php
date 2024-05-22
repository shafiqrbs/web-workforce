<?php

namespace App\Http\Controllers;

use App\Helpers\DataArrayHelper;
use App\Models\Archive;
use App\Models\Arms;
use App\Models\Athlete;
use App\Models\CommitteeMember;
use App\Models\Event;
use App\Models\Jury;
use App\Models\Member;
use App\Models\MemberJoinDesignation;
use App\Models\NewsAndNotice;
use App\Models\ShootingSportClub;
use Illuminate\Http\Request;

class GlobalSearchController extends Controller
{

    public function globalSearch(Request $request){
        $param = $request->get('search-input');
        $total = 0;
        $data = [];
        $data['keyword'] = $param;

        $archive = self::getDataForArchive($param);
        $data['archiveData'] = $archive['data'];
        $total+=$archive['count'];

        $jury = self::getDataForJury($param);
        $data['juryData'] = $jury['data'];
        $total+=$jury['count'];

        $arms = self::getDataForArms($param);
        $data['armsData'] = $arms['data'];
        $total+=$arms['count'];

        $club = self::getDataForClub($param);
        $data['clubData'] = $club['data'];
        $total+=$club['count'];

        $news = self::getDataForNews($param);
        $data['newsData'] = $news['data'];
        $total+=$news['count'];

        $notices = self::getDataForNotices($param);
        $data['noticeData'] = $notices['data'];
        $total+=$notices['count'];

        $athlete = self::getDataForAthlete($param);
        $data['athleteData'] = $athlete['data'];
        $total+=$athlete['count'];

        $events = self::getDataForEvent($param);
        $data['eventData'] = $events['data'];
        $total+=$events['count'];

       /* $members = self::getDataForMembers($param);
        $data['memberData'] = $members['data'];
        $total+=$members['count'];*/

        /*$committeeMember = self::getDataForCommitteeMember($param);
        $data['committeeMember'] = $committeeMember['data'];
        $total+=$committeeMember['count'];*/

        $data['total'] = $total;
        $data['param'] = $param;

        return view('global-search.index',compact(['data']));

    }


    public static function getDataForCommitteeMember($keyword){
        if (app()->getLocale() == 'bn'){
            $data = CommitteeMember::select('committee_members.id', 'committee_members.name','committee_members.created_at','career_levels.career_level')
                ->join('career_levels','career_levels.id','=','committee_members.designation_id');
        }else{
            $data = CommitteeMember::select('committee_members.id', 'committee_members.name','committee_members.created_at','career_levels.career_level')
                ->join('career_levels','career_levels.id','=','committee_members.designation_id');
        }
        $data = $data->where('committee_members.is_active',1)->orderBy('career_levels.sort_order')->orderBy('committee_members.sort_order');

        if (app()->getLocale() == 'bn'){
            if (!empty($keyword)){
                $data = $data->orWhere('career_levels.career_level','LIKE','%'.$keyword.'%')
                    ->orWhere('committee_members.name','LIKE','%'.$keyword.'%')
                    ->orWhere('committee_members.email','LIKE','%'.$keyword.'%');
//                    ->orWhere('committee_members.mobile','LIKE','%'.$keyword.'%')
//                    ->orWhere('committee_members.address','LIKE','%'.$keyword.'%')
//                    ->orWhere('committee_members.short_message','LIKE','%'.$keyword.'%');
            }
        }
        if (app()->getLocale() == 'en'){
            if (!empty($keyword)){
                $data = $data->orWhere('career_levels.career_level','LIKE','%'.$keyword.'%')
                    ->orWhere('committee_members.name','LIKE','%'.$keyword.'%')
                    ->orWhere('committee_members.email','LIKE','%'.$keyword.'%');
//                    ->orWhere('committee_members.mobile','LIKE','%'.$keyword.'%')
//                    ->orWhere('committee_members.address','LIKE','%'.$keyword.'%')
//                    ->orWhere('committee_members.short_message','LIKE','%'.$keyword.'%');
            }
        }

        $data = $data->limit(5)->get();

        return [
            'data' => $data,
            'count' => count($data)
        ];
    }


    public static function getDataForMembers($keyword){
        if (app()->getLocale() == 'bn'){
            $data = MemberJoinDesignation::select([
                'members_join_designation.committee_type',
                'members_join_designation.sub_committee_group',
                'career_levels.career_level',
                'members.name',
                'members.email',
                'members.mobile',
                'members.created_at',
                'members.id',
            ])
                ->join('career_levels', 'career_levels.id', '=', 'members_join_designation.designation_id')
                ->join('members', 'members.id', '=', 'members_join_designation.member_id');
        }else{
            $data = MemberJoinDesignation::select([
                'members_join_designation.committee_type',
                'members_join_designation.sub_committee_group',
                'career_levels.career_level',
                'members.name',
                'members.email',
                'members.created_at',
                'members.mobile',
                'members.id',
            ])
                ->join('career_levels', 'career_levels.id', '=', 'members_join_designation.designation_id')
                ->join('members', 'members.id', '=', 'members_join_designation.member_id');
        }
        $data = $data->where('members.is_active',1)->orderBy('career_levels.sort_order')->orderBy('members_join_designation.sort_order');

        if (app()->getLocale() == 'bn'){
            if (!empty($keyword)){
                $data = $data->orWhere('members_join_designation.committee_type','LIKE','%'.$keyword.'%')
                    ->orWhere('members_join_designation.sub_committee_group','LIKE','%'.$keyword.'%')
                    ->orWhere('career_levels.career_level','LIKE','%'.$keyword.'%')
                    ->orWhere('members.name','LIKE','%'.$keyword.'%');
//                    ->orWhere('members.email','LIKE','%'.$keyword.'%')
//                    ->orWhere('members.mobile','LIKE','%'.$keyword.'%')
//                    ->orWhere('members.address','LIKE','%'.$keyword.'%')
//                    ->orWhere('members.short_message','LIKE','%'.$keyword.'%');
            }
        }
        if (app()->getLocale() == 'en'){
            if (!empty($keyword)){
                $data = $data->orWhere('members_join_designation.committee_type','LIKE','%'.$keyword.'%')
                    ->orWhere('members_join_designation.sub_committee_group','LIKE','%'.$keyword.'%')
                    ->orWhere('career_levels.career_level','LIKE','%'.$keyword.'%')
                    ->orWhere('members.name','LIKE','%'.$keyword.'%');
//                    ->orWhere('members.email','LIKE','%'.$keyword.'%')
//                    ->orWhere('members.mobile','LIKE','%'.$keyword.'%')
//                    ->orWhere('members.address','LIKE','%'.$keyword.'%')
//                    ->orWhere('members.short_message','LIKE','%'.$keyword.'%');
            }
        }

        $data = $data->limit(5)->get();

        return [
            'data' => $data,
            'count' => count($data)
        ];
    }


    public static function getDataForEvent($keyword){
        if (app()->getLocale() == 'bn'){
            $data = Event::select([
                'events.id', 'events.event_name as name', 'event_type.event_type','events.created_at'
            ])->leftjoin('event_type','event_type.id','=','events.event_type_id');
        }else{
            $data = Event::select([
                'events.id', 'events.event_name as name', 'event_type.event_type','events.created_at'
            ])->leftjoin('event_type','event_type.id','=','events.event_type_id');
        }
        $data = $data->where('events.is_active', 1)->orderby('events.sort_order','asc');

        if (app()->getLocale() == 'bn'){
            if (!empty($keyword)){
                $data = $data->where('events.event_name','LIKE','%'.$keyword.'%')
                    ->orWhere('events.event_type','LIKE','%'.$keyword.'%')
                    ->orWhere('events.number_of_club','LIKE','%'.$keyword.'%')
                    ->orWhere('events.number_of_athlete','LIKE','%'.$keyword.'%')
                    ->orWhere('events.number_of_official','LIKE','%'.$keyword.'%')
                    ->orWhere('events.event_message','LIKE','%'.$keyword.'%')
                    ->orWhere('events.match_schedule_message','LIKE','%'.$keyword.'%')
                    ->orWhere('events.location','LIKE','%'.$keyword.'%')
                    ->orWhere('events.participant','LIKE','%'.$keyword.'%')
                    ->orWhere('events.start_date','LIKE','%'.$keyword.'%')
                    ->orWhere('event_type.event_type','LIKE','%'.$keyword.'%')
                    ->orWhere('events.month','LIKE','%'.$keyword.'%');
            }
        }
        if (app()->getLocale() == 'en'){
            if (!empty($keyword)){
                $data = $data->where('events.event_name','LIKE','%'.$keyword.'%')
                    ->orWhere('events.event_type','LIKE','%'.$keyword.'%')
                    ->orWhere('events.number_of_club','LIKE','%'.$keyword.'%')
                    ->orWhere('events.number_of_athlete','LIKE','%'.$keyword.'%')
                    ->orWhere('events.number_of_official','LIKE','%'.$keyword.'%')
                    ->orWhere('events.event_message','LIKE','%'.$keyword.'%')
                    ->orWhere('events.match_schedule_message','LIKE','%'.$keyword.'%')
                    ->orWhere('events.location','LIKE','%'.$keyword.'%')
                    ->orWhere('events.participant','LIKE','%'.$keyword.'%')
                    ->orWhere('events.start_date','LIKE','%'.$keyword.'%')
                    ->orWhere('event_type.event_type','LIKE','%'.$keyword.'%')
                    ->orWhere('events.month','LIKE','%'.$keyword.'%');
            }
        }

        $data = $data->limit(5)->get();

        return [
            'data' => $data,
            'count' => count($data)
        ];
    }


    public static function getDataForAthlete($keyword){
        if (app()->getLocale() == 'bn'){
            $data = Athlete::select([
                'id', 'athlete_id', 'athlete_name','created_at','athlete_type'
            ]);
        }else{
            $data = Athlete::select([
                'id', 'athlete_id', 'athlete_name','created_at','athlete_type'
            ]);
        }
        $data = $data->where('is_active', 1)->where('is_approved', 1)->where('is_present', 1)->where('deleted_at',null)->orderby('sort_order','asc');

        if (app()->getLocale() == 'bn'){
            if (!empty($keyword)){
                $data = $data->where('athlete_id','LIKE','%'.$keyword.'%')
                    ->orWhere('athlete_name','LIKE','%'.$keyword.'%')
                    ->orWhere('athlete_type','LIKE','%'.$keyword.'%')
                    ->orWhere('email','LIKE','%'.$keyword.'%')
                    ->orWhere('father_name','LIKE','%'.$keyword.'%')
                    ->orWhere('mother_name','LIKE','%'.$keyword.'%')
                    ->orWhere('address','LIKE','%'.$keyword.'%')
                    ->orWhere('mobile','LIKE','%'.$keyword.'%');
            }
        }
        if (app()->getLocale() == 'en'){
            if (!empty($keyword)){
                $data = $data->where('athlete_id','LIKE','%'.$keyword.'%')
                    ->orWhere('athlete_name','LIKE','%'.$keyword.'%')
                    ->orWhere('athlete_type','LIKE','%'.$keyword.'%')
                    ->orWhere('email','LIKE','%'.$keyword.'%')
                    ->orWhere('father_name','LIKE','%'.$keyword.'%')
                    ->orWhere('mother_name','LIKE','%'.$keyword.'%')
                    ->orWhere('address','LIKE','%'.$keyword.'%')
                    ->orWhere('mobile','LIKE','%'.$keyword.'%');
            }
        }

        $data = $data->limit(5)->get();
        $count = $data->count();
        return [
            'data' => $data,
            'count' => $count
        ];
    }


    public static function getDataForNotices($keyword){
        if (app()->getLocale() == 'bn'){
            $data = NewsAndNotice::select([
                'id', 'title as title', 'slug','created_at','post_type'
            ]);
        }else{
            $data = NewsAndNotice::select([
                'id', 'title as title', 'slug','created_at','post_type'
            ]);
        }
        $data = $data->where('is_active', 1)->where('deleted_at',null)->where('post_type','NOTICE')->orderby('sort_order','asc');

        if (app()->getLocale() == 'bn'){
            if (!empty($keyword)){
                $data = $data->where('title','LIKE','%'.$keyword.'%')
                    ->orWhere('slug','LIKE','%'.$keyword.'%')
                    ->orWhere('post_type','LIKE','%'.$keyword.'%');
            }
        }
        if (app()->getLocale() == 'en'){
            if (!empty($keyword)){
                $data = $data->where('title','LIKE','%'.$keyword.'%')
                    ->orWhere('slug','LIKE','%'.$keyword.'%')
                    ->orWhere('post_type','LIKE','%'.$keyword.'%');
            }
        }

        $data = $data->limit(5)->get();
        $count = $data->count();
        return [
            'data' => $data,
            'count' => $count
        ];
    }


    public static function getDataForNews($keyword){
        if (app()->getLocale() == 'bn'){
            $data = NewsAndNotice::select([
                'id', 'title as title', 'slug','created_at','post_type'
            ]);
        }else{
            $data = NewsAndNotice::select([
                'id', 'title as title', 'slug','created_at','post_type'
            ]);
        }
        $data = $data->where('is_active', 1)->where('deleted_at',null)->where('post_type','NEWS')->orderby('sort_order','asc');

        if (app()->getLocale() == 'bn'){
            if (!empty($keyword)){
                $data = $data->where('title','LIKE','%'.$keyword.'%')
                    ->orWhere('slug','LIKE','%'.$keyword.'%')
                    ->orWhere('post_type','LIKE','%'.$keyword.'%');
            }
        }
        if (app()->getLocale() == 'en'){
            if (!empty($keyword)){
                $data = $data->where('title','LIKE','%'.$keyword.'%')
                    ->orWhere('slug','LIKE','%'.$keyword.'%')
                    ->orWhere('post_type','LIKE','%'.$keyword.'%');
            }
        }

        $data = $data->limit(5)->get();
        $count = $data->count();
        return [
            'data' => $data,
            'count' => $count
        ];
    }



    public static function getDataForArchive($keyword){
        if (app()->getLocale() == 'bn'){
            $data = Archive::select([
                'id', 'archive_name_bn as archive_name', 'sub_title_bn as sub_title','created_at'
            ]);
        }else{
            $data = Archive::select([
                'id', 'archive_name_en as archive_name', 'sub_title_en as sub_title','created_at'
            ]);
        }
        $data = $data->where('is_active', 1)->where('deleted_at',null)->orderby('sort_order','asc');

        if (app()->getLocale() == 'bn'){
            if (!empty($keyword)){
                $data = $data->where('archive_name_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('sub_title_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('archive_pdf','LIKE','%'.$keyword.'%');
            }
        }
        if (app()->getLocale() == 'en'){
            if (!empty($keyword)){
                $data = $data->where('archive_name_en','LIKE','%'.$keyword.'%')
                    ->orWhere('sub_title_en','LIKE','%'.$keyword.'%')
                    ->orWhere('archive_pdf','LIKE','%'.$keyword.'%');
            }
        }

        $data = $data->limit(5)->get();
        $count = $data->count();
        return [
            'data' => $data,
            'count' => $count
        ];
    }


    public static function getDataForJury($keyword){
        if (app()->getLocale() == 'bn'){
            $data = Jury::select([
                'id', 'name_bn as name', 'mobile_bn as mobile','email','created_at'
            ]);
        }else{
            $data = Jury::select([
                'id', 'name_en as name', 'mobile_en as mobile','email','created_at'
            ]);
        }
        $data = $data->where('is_active', 1)->where('deleted_at',null)->orderby('sort_order','asc');

        if (app()->getLocale() == 'bn'){
            if (!empty($keyword)){
                $data = $data->where('name_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('mobile_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('issf_license_no_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('address_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('remark_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('email','LIKE','%'.$keyword.'%');
            }
        }
        if (app()->getLocale() == 'en'){
            if (!empty($keyword)){
                $data = $data->where('name_en','LIKE','%'.$keyword.'%')
                    ->orWhere('mobile_en','LIKE','%'.$keyword.'%')
                    ->orWhere('issf_license_no_en','LIKE','%'.$keyword.'%')
                    ->orWhere('address_en','LIKE','%'.$keyword.'%')
                    ->orWhere('remark_en','LIKE','%'.$keyword.'%')
                    ->orWhere('email','LIKE','%'.$keyword.'%');
            }
        }

        $data = $data->limit(5)->get();
        return [
            'data' => $data,
            'count' => count($data)
        ];
    }

    public static function getDataForArms($keyword){
        if (app()->getLocale() == 'bn'){
            $data = Arms::select([
                'id', 'name_bn as name','created_at'
            ]);
        }else{
            $data = Arms::select([
                'id', 'name_en as name','created_at'
            ]);
        }
        $data = $data->where('is_active', 1)->where('deleted_at',null)->orderby('sort_order','asc');

        if (app()->getLocale() == 'bn'){
            if (!empty($keyword)){
                $data = $data->where('name_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('bullet_size_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('quantity_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('max_velocity_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('overall_length_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('buttplate_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('function_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('trigger_pull_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('caliber_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('muzzle_energy_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('barrel_length_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('barrel_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('front_sight_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('rear_sight_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('trigger_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('action_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('power_plant_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('max_shots_per_fill_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('body_type_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('weight_bn','LIKE','%'.$keyword.'%');
            }
        }
        if (app()->getLocale() == 'en'){
            if (!empty($keyword)){
                $data = $data->where('name_en','LIKE','%'.$keyword.'%')
                    ->orWhere('bullet_size_en','LIKE','%'.$keyword.'%')
                    ->orWhere('quantity_en','LIKE','%'.$keyword.'%')
                    ->orWhere('max_velocity_en','LIKE','%'.$keyword.'%')
                    ->orWhere('overall_length_en','LIKE','%'.$keyword.'%')
                    ->orWhere('buttplate_en','LIKE','%'.$keyword.'%')
                    ->orWhere('function_en','LIKE','%'.$keyword.'%')
                    ->orWhere('trigger_pull_en','LIKE','%'.$keyword.'%')
                    ->orWhere('caliber_en','LIKE','%'.$keyword.'%')
                    ->orWhere('muzzle_energy_en','LIKE','%'.$keyword.'%')
                    ->orWhere('barrel_length_en','LIKE','%'.$keyword.'%')
                    ->orWhere('barrel_en','LIKE','%'.$keyword.'%')
                    ->orWhere('front_sight_en','LIKE','%'.$keyword.'%')
                    ->orWhere('rear_sight_en','LIKE','%'.$keyword.'%')
                    ->orWhere('trigger_en','LIKE','%'.$keyword.'%')
                    ->orWhere('action_en','LIKE','%'.$keyword.'%')
                    ->orWhere('power_plant_en','LIKE','%'.$keyword.'%')
                    ->orWhere('max_shots_per_fill_en','LIKE','%'.$keyword.'%')
                    ->orWhere('body_type_en','LIKE','%'.$keyword.'%')
                    ->orWhere('weight_en','LIKE','%'.$keyword.'%');
            }
        }

        $data = $data->limit(5)->get();
        return [
            'data' => $data,
            'count' => count($data)
        ];
    }

    public static function getDataForClub($keyword){
        if (app()->getLocale() == 'bn'){
            $data = ShootingSportClub::select([
                'id', 'name_bn as name','created_at'
            ]);
        }else{
            $data = ShootingSportClub::select([
                'id', 'name_en as name','created_at'
            ]);
        }
        $data = $data->where('is_active', 1)->orderby('sort_order','asc');

        if (app()->getLocale() == 'bn'){
            if (!empty($keyword)){
                $data = $data->where('name_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('mobile_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('email','LIKE','%'.$keyword.'%')
                    ->orWhere('club_type','LIKE','%'.$keyword.'%')
                    ->orWhere('address_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('short_name_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('about_club_bn','LIKE','%'.$keyword.'%')
                    ->orWhere('registration_number_bn','LIKE','%'.$keyword.'%');
            }
        }
        if (app()->getLocale() == 'en'){
            if (!empty($keyword)){
                $data = $data->where('name_en','LIKE','%'.$keyword.'%')
                    ->orWhere('mobile_en','LIKE','%'.$keyword.'%')
                    ->orWhere('email','LIKE','%'.$keyword.'%')
                    ->orWhere('club_type','LIKE','%'.$keyword.'%')
                    ->orWhere('address_en','LIKE','%'.$keyword.'%')
                    ->orWhere('short_name_en','LIKE','%'.$keyword.'%')
                    ->orWhere('about_club_en','LIKE','%'.$keyword.'%')
                    ->orWhere('registration_number_en','LIKE','%'.$keyword.'%');
            }
        }

        $data = $data->limit(5)->get();
        return [
            'data' => $data,
            'count' => count($data)
        ];
    }





}
