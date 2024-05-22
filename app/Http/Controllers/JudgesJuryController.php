<?php

namespace App\Http\Controllers;

use App\Helpers\DataArrayHelper;
use App\Models\Banner;
use App\Models\CommitteeMember;
use App\Models\Jury;
use App\Models\Member;
use Illuminate\Http\Request;

class JudgesJuryController extends Controller
{

    public function index(){

        $pageTitle = __('messages.Judges_Jury');
        $pathPageTitle = null;
        $pageSlug = 'judges-jury';

        $bannerData = Banner::getPageWiseBannerInfo($pageSlug);
        $juryData = Jury::getJury();

        return view('jury.index', compact(['pageTitle','juryData','pathPageTitle','bannerData']));
    }

    public function juryDetails($id){
        if (app()->getLocale() == 'bn'){
            $data = Jury::select([
                'id','name_bn as name', 'mobile_bn as mobile', 'email', 'issf_license_no_bn as issf_license_no', 'license_valid_date', 'date_of_birth', 'jury_class', 'address_bn as address', 'remark_bn as remark', 'profile_image', 'e_signature', 'is_rifle', 'is_pistol', 'is_short_gun', 'is_running_target', 'is_electronic_target','is_target_control', 'sort_order'
            ])
                ->with(array(
                'juryEvent' => function($query){
                    $query->select([
                        'judges_jury_event.jury_id',
                        'judges_jury_event.event_id',
                        'judges_jury_event.event_name_bn as event_name',
                        'judges_jury_event.event_address_bn as event_address',
                        'events.event_name as event_db_name',
                    ])
                        ->leftjoin('events', 'events.id', '=', 'judges_jury_event.event_id');
                }
            ))
            ;
        }else{
            $data = Jury::select([
                'id','name_en as name', 'mobile_en as mobile', 'email', 'issf_license_no_en as issf_license_no', 'license_valid_date', 'date_of_birth', 'jury_class', 'address_en as address', 'remark_en as remark', 'profile_image', 'e_signature', 'is_rifle', 'is_pistol', 'is_short_gun', 'is_running_target', 'is_electronic_target','is_target_control','sort_order'
            ])
                ->with(array(
                    'juryEvent' => function($query){
                        $query->select([
                            'judges_jury_event.jury_id',
                            'judges_jury_event.event_id',
                            'judges_jury_event.event_name_en as event_name',
                            'judges_jury_event.event_address_en as event_address',
                            'events.event_name as event_db_name',
                        ])
                            ->leftjoin('events', 'events.id', '=', 'judges_jury_event.event_id');
                    }
                ))
            ;
        }

        $juryData = $data->where('id',$id)->first();

        $pageTitle = __('messages.Judges_Jury_details');
        $pathPageTitle = null;
        $bannerData = Banner::getPageWiseBannerInfo('judges-jury-details');
        return view('jury.details',compact(['pageTitle','juryData','pathPageTitle','bannerData']));
    }

}
