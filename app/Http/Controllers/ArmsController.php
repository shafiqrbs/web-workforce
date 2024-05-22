<?php

namespace App\Http\Controllers;

use App\Helpers\DataArrayHelper;
use App\Models\Arms;
use App\Models\Banner;
use App\Models\Event;
use App\Models\Jury;
use Illuminate\Http\Request;

class ArmsController extends Controller
{

    public function index(){
        $pageTitle = __('messages.Arms');
        $pathPageTitle = null;
        $bannerData = Banner::getPageWiseBannerInfo('arms');
        $armsData = Arms::getArms();

        return view('arms.index', compact(['pageTitle','armsData','pathPageTitle','bannerData']));
    }

    public function ArmsDetails($id){
        if (app()->getLocale() == 'bn'){
            $data = Arms::select([
                'id', 'name_bn as name', 'arms_image', 'bullet_size_bn as bullet_size', 'quantity_bn as quantity', 'max_velocity_bn as max_velocity', 'overall_length_bn as overall_length', 'buttplate_bn as buttplate', 'function_bn as function', 'weight_bn as weight', 'trigger_pull_bn as trigger_pull', 'scopeable_bn as scopeable', 'safety_bn as safety', 'suggested_for_bn as suggested_for', 'caliber_bn as caliber', 'muzzle_energy_bn as muzzle_energy', 'loudness_bn as loudness', 'barrel_length_bn as barrel_length', 'barrel_bn as barrel', 'front_sight_bn as front_sight', 'rear_sight_bn as rear_sight', 'trigger_bn as trigger', 'action_bn as action', 'power_plant_bn as power_plant', 'max_shots_per_fill_bn as max_shots_per_fill', 'operating_pressuer_bn as operating_pressuer', 'body_type_bn as body_type', 'fixed_adj_power_bn as fixed_adj_power', 'shot_capacity_bn as shot_capacity'
            ])
            ;
        }else{
            $data = Arms::select([
                'id', 'name_en as name', 'arms_image', 'bullet_size_en as bullet_size', 'quantity_en as quantity', 'max_velocity_en as max_velocity', 'overall_length_en as overall_length', 'buttplate_en as buttplate', 'function_en as function', 'weight_en as weight', 'trigger_pull_en as trigger_pull', 'scopeable_en as scopeable', 'safety_en as safety', 'suggested_for_en as suggested_for', 'caliber_en as caliber', 'muzzle_energy_en as muzzle_energy', 'loudness_en as loudness', 'barrel_length_en as barrel_length', 'barrel_en as barrel', 'front_sight_en as front_sight', 'rear_sight_en as rear_sight', 'trigger_en as trigger', 'action_en as action', 'power_plant_en as power_plant', 'max_shots_per_fill_en as max_shots_per_fill', 'operating_pressuer_en as operating_pressuer', 'body_type_en as body_type', 'fixed_adj_power_en as fixed_adj_power', 'shot_capacity_en as shot_capacity'
            ])
            ;
        }

        $armsData = $data->where('id',$id)->first();

        $pageTitle = __('messages.Arms');
        $pathPageTitle = __('Details');
        $bannerData = Banner::getPageWiseBannerInfo('arms');
        $relatedArms = Arms::getRelatedArmsExceptTop($id);

        return view('arms.details',compact(['pageTitle','armsData','pathPageTitle','bannerData','relatedArms']));
    }

}
