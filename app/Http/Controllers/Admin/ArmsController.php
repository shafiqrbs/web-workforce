<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArmsFormRequest;
use App\Models\Arms;
use App\Models\Jury;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use ImgUploader;
use File;

class ArmsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     */
    public function indexArms(Request $request)
    {

        if ($request->ajax()) {

            if (app()->getLocale() == 'bn'){
                DB::statement(DB::raw('set @rownum=0'));
                $arms = Arms::select(
                    [
                        DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                        'id',
                        'name_bn as name',
                        'bullet_size_bn as bullet_size',
                        'quantity_bn as quantity',
                        'max_velocity_bn as max_velocity',
                        'overall_length_bn as overall_length',
                        'is_active'
                    ]
                )->where('deleted_at',null);
            }else{
                DB::statement(DB::raw('set @rownum=0'));
                $arms = Arms::select(
                    [
                        DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                        'id',
                        'name_en as name',
                        'bullet_size_en as bullet_size',
                        'quantity_en as quantity',
                        'max_velocity_en as max_velocity',
                        'overall_length_en as overall_length',
                        'is_active'
                    ]
                )->where('deleted_at',null);
            }
            return Datatables::of($arms)
                ->filter(function ($query) use ($request) {
                    if ($request->has('name') && !empty($request->name)) {
                        if (app()->getLocale() == 'bn'){
                            $query->where('name_bn', 'like', "%{$request->get('name')}%");
                        }else{
                            $query->where('name_en', 'like', "%{$request->get('name')}%");
                        }
                    }

                    if ($request->has('bullet_size') && !empty($request->bullet_size)) {
                        if (app()->getLocale() == 'bn'){
                            $query->where('bullet_size_bn', 'like', "%{$request->get('bullet_size')}%");
                        }else{
                            $query->where('bullet_size_en', 'like', "%{$request->get('bullet_size')}%");
                        }
                    }

                    if ($request->has('quantity') && !empty($request->quantity)) {
                        if (app()->getLocale() == 'bn'){
                            $query->where('quantity_bn', 'like', "%{$request->get('quantity')}%");
                        }else{
                            $query->where('quantity_en', 'like', "%{$request->get('quantity')}%");
                        }
                    }
                    if ($request->has('max_velocity') && !empty($request->max_velocity)) {
                        if (app()->getLocale() == 'bn'){
                            $query->where('max_velocity_bn', 'like', "%{$request->get('max_velocity')}%");
                        }else{
                            $query->where('max_velocity_en', 'like', "%{$request->get('max_velocity')}%");
                        }
                    }
                })
                ->addColumn('status', function ($row) {
                    if ($row->is_active == 1) {
                        $status = __('messages.Active');
                    } else {
                        $status = __('messages.Inactive');
                    }
                    return $status;
                })

                ->addColumn('action', function ($jurys) {
                    $active_class = '';
                    $action = __('messages.Actions');
                    $edit = __('messages.Edit');
                    $delete = __('messages.Delete');
                    if ((int)$jurys->is_active == 1) {
                        $active_txt = __('messages.Inactive');
                        $active_href = 'make_not_active(' . $jurys->id . ');';
                        $active_icon = 'square-o';
                    } else {
                        $active_txt = __('messages.Active');
                        $active_href = 'make_active(' . $jurys->id . ');';
                        $active_icon = 'check-square';
                    }
                    return '
				<div class="btn-group">
					<button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					    '.$action.'
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('edit_arms', ['id' => $jurys->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>'.$edit.'</a>
						</li>		
						<li>
                        <a class="' . $active_class . '" href="javascript:void(0);" onClick="' . $active_href . '" id="onclick_active_' . $jurys->id . '"><i class="fas fa-check-square"></i>' . $active_txt . '</a>
                        </li>				
						<li>
							<a href="javascript:void(0);" onclick="delete_arms(' . $jurys->id . ');" class=""><i class="fa fa-trash" aria-hidden="true"></i>'.$delete.'</a>
						</li>																																							
					</ul>
				</div>';
                })
                ->rawColumns(['action', 'status'])
                ->setRowId(function ($arms) {
                    return 'dt_row_' . $arms->id;
                })
                ->make(true);
        }
        return view('admin.arms.index');
    }



    public function createArms()
    {
        $shotCapacity = [];
        for ($i=1;$i<=100;$i++){
            $shotCapacity[$i] =  $i;
        }

        $scopeable = [
            __('messages.YES') => __('messages.YES'),
            __('messages.NO') => __('messages.NO'),
        ];

        $bodyType = [
            __('messages.Rifle') => __('messages.Rifle'),
            __('messages.Pistol') => __('messages.Pistol'),
            __('messages.Shortgun') => __('messages.Shortgun'),
        ];

        $bodyPower = [
            __('messages.Fixed') => __('messages.Fixed'),
            __('messages.Adjust') => __('messages.Adjust'),
        ];

        return view('admin.arms.add',['scopeable'=>$scopeable,'shotCapacity'=>$shotCapacity,'bodyType'=>$bodyType,'bodyPower'=>$bodyPower]);
    }

    public function storeArms(ArmsFormRequest $request)
    {
        $arms = new Arms();
        if ($request->hasFile('arms_image')) {
            $image_name = 'arms-'.str_pad(mt_rand(1,99999999),10,'0',STR_PAD_LEFT);
            $fileName = ImgUploader::UploadImage('arms', $request->file('arms_image'), $image_name, 270, 270);
            $arms->arms_image = $fileName;
        }

        if (app()->getLocale() == 'bn'){
            $arms->name_bn = $request->input('name');
            $arms->bullet_size_bn = $request->input('bullet_size');
            $arms->quantity_bn = $request->input('quantity');
            $arms->max_velocity_bn = $request->input('max_velocity');
            $arms->overall_length_bn = $request->input('overall_length');
            $arms->buttplate_bn = $request->input('buttplate');
            $arms->function_bn = $request->input('function');
            $arms->weight_bn = $request->input('weight');
            $arms->trigger_pull_bn = $request->input('trigger_pull');
            $arms->scopeable_bn = $request->input('scopeable');
            $arms->safety_bn = $request->input('safety');
            $arms->suggested_for_bn = $request->input('suggested_for');
            $arms->caliber_bn = $request->input('caliber');
            $arms->muzzle_energy_bn = $request->input('muzzle_energy');
            $arms->loudness_bn = $request->input('loudness');
            $arms->barrel_length_bn = $request->input('barrel_length');
            $arms->barrel_bn = $request->input('barrel');
            $arms->front_sight_bn = $request->input('front_sight');
            $arms->rear_sight_bn = $request->input('rear_sight');
            $arms->trigger_bn = $request->input('trigger');
            $arms->action_bn = $request->input('action');
            $arms->power_plant_bn = $request->input('power_plant');
            $arms->max_shots_per_fill_bn = $request->input('max_shots_per_fill');
            $arms->operating_pressuer_bn = $request->input('operating_pressuer');
            $arms->body_type_bn = $request->input('body_type');
            $arms->fixed_adj_power_bn = $request->input('fixed_adj_power');
            $arms->shot_capacity_bn = $request->input('shot_capacity');
        }else{
            $arms->name_en = $request->input('name');
            $arms->bullet_size_en = $request->input('bullet_size');
            $arms->quantity_en = $request->input('quantity');
            $arms->max_velocity_en = $request->input('max_velocity');
            $arms->overall_length_en = $request->input('overall_length');
            $arms->buttplate_en = $request->input('buttplate');
            $arms->function_en = $request->input('function');
            $arms->weight_en = $request->input('weight');
            $arms->trigger_pull_en = $request->input('trigger_pull');
            $arms->scopeable_en = $request->input('scopeable');
            $arms->safety_en = $request->input('safety');
            $arms->suggested_for_en = $request->input('suggested_for');
            $arms->caliber_en = $request->input('caliber');
            $arms->muzzle_energy_en = $request->input('muzzle_energy');
            $arms->loudness_en = $request->input('loudness');
            $arms->barrel_length_en = $request->input('barrel_length');
            $arms->barrel_en = $request->input('barrel');
            $arms->front_sight_en = $request->input('front_sight');
            $arms->rear_sight_en = $request->input('rear_sight');
            $arms->trigger_en = $request->input('trigger');
            $arms->action_en = $request->input('action');
            $arms->power_plant_en = $request->input('power_plant');
            $arms->max_shots_per_fill_en = $request->input('max_shots_per_fill');
            $arms->operating_pressuer_en = $request->input('operating_pressuer');
            $arms->body_type_en = $request->input('body_type');
            $arms->fixed_adj_power_en = $request->input('fixed_adj_power');
            $arms->shot_capacity_en = $request->input('shot_capacity');
        }

        $arms->save();
        $arms->sort_order = $arms->id;
        $arms->update();

        flash(__('messages.Insert_message_arms'))->success();
        return \Redirect::route('edit_arms', array($arms->id));
    }

    public function editArms($id)
    {
        if (app()->getLocale() == 'bn') {
            $arms = Arms::select(
                [
                    'id','name_bn as name',
                    'bullet_size_bn as bullet_size',
                    'quantity_bn as quantity',
                    'max_velocity_bn as max_velocity',
                    'overall_length_bn as overall_length',
                    'buttplate_bn as buttplate',
                    'function_bn as function',
                    'weight_bn as weight',
                    'trigger_pull_bn as trigger_pull',
                    'scopeable_bn as scopeable',
                    'safety_bn as safety',
                    'suggested_for_bn as suggested_for',
                    'caliber_bn as caliber',
                    'muzzle_energy_bn as muzzle_energy',
                    'loudness_bn as loudness',
                    'barrel_length_bn as barrel_length',
                    'barrel_bn as barrel',
                    'front_sight_bn as front_sight',
                    'rear_sight_bn as rear_sight',
                    'trigger_bn as trigger',
                    'action_bn as action',
                    'power_plant_bn as power_plant',
                    'max_shots_per_fill_bn as max_shots_per_fill',
                    'operating_pressuer_bn as operating_pressuer',
                    'body_type_bn as body_type',
                    'fixed_adj_power_bn as fixed_adj_power',
                    'shot_capacity_bn as shot_capacity',
                    'arms_image',
                ]
            );
        }else{
            $arms = Arms::select(
                [
                    'id','name_en as name',
                    'bullet_size_en as bullet_size',
                    'quantity_en as quantity',
                    'max_velocity_en as max_velocity',
                    'overall_length_en as overall_length',
                    'buttplate_en as buttplate',
                    'function_en as function',
                    'weight_en as weight',
                    'trigger_pull_en as trigger_pull',
                    'scopeable_en as scopeable',
                    'safety_en as safety',
                    'suggested_for_en as suggested_for',
                    'caliber_en as caliber',
                    'muzzle_energy_en as muzzle_energy',
                    'loudness_en as loudness',
                    'barrel_length_en as barrel_length',
                    'barrel_en as barrel',
                    'front_sight_en as front_sight',
                    'rear_sight_en as rear_sight',
                    'trigger_en as trigger',
                    'action_en as action',
                    'power_plant_en as power_plant',
                    'max_shots_per_fill_en as max_shots_per_fill',
                    'operating_pressuer_en as operating_pressuer',
                    'body_type_en as body_type',
                    'fixed_adj_power_en as fixed_adj_power',
                    'shot_capacity_en as shot_capacity',
                    'arms_image',
                ]
            );
        }
        $arms = $arms->where('id',$id)->first();

        $shotCapacity = [];
        for ($i=1;$i<=100;$i++){
            $shotCapacity[$i] =  $i;
        }

        $scopeable = [
            __('messages.YES') => __('messages.YES'),
            __('messages.NO') => __('messages.NO'),
        ];

        $bodyType = [
            __('messages.Rifle') => __('messages.Rifle'),
            __('messages.Pistol') => __('messages.Pistol'),
            __('messages.Shortgun') => __('messages.Shortgun'),
        ];

        $bodyPower = [
            __('messages.Fixed') => __('messages.Fixed'),
            __('messages.Adjust') => __('messages.Adjust'),
        ];

        return view('admin.arms.edit',['scopeable'=>$scopeable,'shotCapacity'=>$shotCapacity,'bodyType'=>$bodyType,'bodyPower'=>$bodyPower,'arms'=>$arms]);
    }


    public function updateArms($id, ArmsFormRequest $request)
    {
        $arms = Arms::find($id);

        if ($request->hasFile('arms_image')) {
            \Illuminate\Support\Facades\File::delete(public_path().'/arms/'.$arms->arms_image);
            \Illuminate\Support\Facades\File::delete(public_path().'/arms/thumb/'.$arms->arms_image);
            \Illuminate\Support\Facades\File::delete(public_path().'/arms/mid/'.$arms->arms_image);
            $image_name = 'arms-'.str_pad(mt_rand(1,99999999),10,'0',STR_PAD_LEFT);
            $fileName = ImgUploader::UploadImage('arms', $request->file('arms_image'), $image_name, 270, 270);
            $arms->arms_image = $fileName;
        }

        if (app()->getLocale() == 'bn'){
            $arms->name_bn = $request->input('name');
            $arms->bullet_size_bn = $request->input('bullet_size');
            $arms->quantity_bn = $request->input('quantity');
            $arms->max_velocity_bn = $request->input('max_velocity');
            $arms->overall_length_bn = $request->input('overall_length');
            $arms->buttplate_bn = $request->input('buttplate');
            $arms->function_bn = $request->input('function');
            $arms->weight_bn = $request->input('weight');
            $arms->trigger_pull_bn = $request->input('trigger_pull');
            $arms->scopeable_bn = $request->input('scopeable');
            $arms->safety_bn = $request->input('safety');
            $arms->suggested_for_bn = $request->input('suggested_for');
            $arms->caliber_bn = $request->input('caliber');
            $arms->muzzle_energy_bn = $request->input('muzzle_energy');
            $arms->loudness_bn = $request->input('loudness');
            $arms->barrel_length_bn = $request->input('barrel_length');
            $arms->barrel_bn = $request->input('barrel');
            $arms->front_sight_bn = $request->input('front_sight');
            $arms->rear_sight_bn = $request->input('rear_sight');
            $arms->trigger_bn = $request->input('trigger');
            $arms->action_bn = $request->input('action');
            $arms->power_plant_bn = $request->input('power_plant');
            $arms->max_shots_per_fill_bn = $request->input('max_shots_per_fill');
            $arms->operating_pressuer_bn = $request->input('operating_pressuer');
            $arms->body_type_bn = $request->input('body_type');
            $arms->fixed_adj_power_bn = $request->input('fixed_adj_power');
            $arms->shot_capacity_bn = $request->input('shot_capacity');
        }else{
            $arms->name_en = $request->input('name');
            $arms->bullet_size_en = $request->input('bullet_size');
            $arms->quantity_en = $request->input('quantity');
            $arms->max_velocity_en = $request->input('max_velocity');
            $arms->overall_length_en = $request->input('overall_length');
            $arms->buttplate_en = $request->input('buttplate');
            $arms->function_en = $request->input('function');
            $arms->weight_en = $request->input('weight');
            $arms->trigger_pull_en = $request->input('trigger_pull');
            $arms->scopeable_en = $request->input('scopeable');
            $arms->safety_en = $request->input('safety');
            $arms->suggested_for_en = $request->input('suggested_for');
            $arms->caliber_en = $request->input('caliber');
            $arms->muzzle_energy_en = $request->input('muzzle_energy');
            $arms->loudness_en = $request->input('loudness');
            $arms->barrel_length_en = $request->input('barrel_length');
            $arms->barrel_en = $request->input('barrel');
            $arms->front_sight_en = $request->input('front_sight');
            $arms->rear_sight_en = $request->input('rear_sight');
            $arms->trigger_en = $request->input('trigger');
            $arms->action_en = $request->input('action');
            $arms->power_plant_en = $request->input('power_plant');
            $arms->max_shots_per_fill_en = $request->input('max_shots_per_fill');
            $arms->operating_pressuer_en = $request->input('operating_pressuer');
            $arms->body_type_en = $request->input('body_type');
            $arms->fixed_adj_power_en = $request->input('fixed_adj_power');
            $arms->shot_capacity_en = $request->input('shot_capacity');
        }

        $arms->update();


        flash(__('messages.Edit_message_Arms'))->success();
        return \Redirect::route('edit_arms', array($arms->id));
    }


    public function deleteArms(Request $request)
    {
        $id = $request->input('id');
        try {
            $arms = Arms::findOrFail($id);
            $arms->deleted_at = now();
            $arms->update();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeActiveArms(Request $request)
    {
        $id = $request->input('id');
        try {
            $arms = Arms::findOrFail($id);
            $arms->is_active = 1;
            $arms->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Active'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveArms(Request $request)
    {
        $id = $request->input('id');
        try {
            $arms = Arms::findOrFail($id);
            $arms->is_active = 0;
            $arms->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Inactive'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }


    public function sortJury(Request $request)
        {
            if ($request->ajax()){
                if (app()->getLocale() == 'bn'){
                    $jurys = Jury::select(
                        [
                            'id','name_bn as name','mobile_bn as mobile'
                        ]
                    );
                }else{
                    $jurys = Jury::select(
                        [
                            'id','name_en as name','mobile_en as mobile'
                        ]
                    );
                }
                $jurys = $jurys->where('is_active',1)->where('deleted_at',null)->orderBy('sort_order')->get();

                $str = '<ul id="sortable">';
                if ($jurys != null) {
                    foreach ($jurys as $jury) {
                        $str .= '<li id="' . $jury->id . '"><i class="fa fa-sort"></i>' . $jury->name .' (<b>'.$jury->mobile. '</b>) </li>';
                    }
                }
                return $str . '</ul>';
            }
            return view('admin.jury.sort');
        }


        public function jurySortUpdate(Request $request)
        {
            $juryOrder = $request->input('juryOrder');
            $juryOrderArray = explode(',', $juryOrder);
            $count = 1;
            foreach ($juryOrderArray as $jury_id) {
                $juryUpdate = Jury::find($jury_id);
                $juryUpdate->sort_order = $count;
                $juryUpdate->update();
                $count++;
            }
        }

}
