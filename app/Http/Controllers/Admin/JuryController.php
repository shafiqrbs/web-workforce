<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\DataArrayHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExecutiveCommitteeFormRequest;
use App\Http\Requests\JuryFormRequest;
use App\Http\Requests\MemberFormRequest;
use App\Models\CommitteeMember;
use App\Models\Event;
use App\Models\Jury;
use App\Models\JuryEvent;
use App\Models\Member;
use App\Models\MemberJoinDesignation;
use App\Models\FinancialPartner;
use App\Models\ShootingSportClub;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use ImgUploader;
use File;

class JuryController extends Controller
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
    public function indexJurys(Request $request)
    {

        if ($request->ajax()) {

            if (app()->getLocale() == 'bn'){
                DB::statement(DB::raw('set @rownum=0'));
                $jurys = Jury::select(
                    [
                        DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                        'judges_jury.name_bn as name',
                        'judges_jury.email',
                        'judges_jury.mobile_bn as mobile',
                        'judges_jury.is_active',
                        'judges_jury.id',
                        'judges_jury.license_valid_date',
                        'judges_jury.jury_class',
                        'judges_jury.issf_license_no_bn as issf_license_no',
                        'judges_jury.remark_bn as remark',
                    ]
                )->where('deleted_at',null);
            }else{
                DB::statement(DB::raw('set @rownum=0'));
                $jurys = Jury::select(
                    [
                        DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                        'judges_jury.name_en as name',
                        'judges_jury.email',
                        'judges_jury.mobile_en as mobile',
                        'judges_jury.is_active',
                        'judges_jury.id',
                        'judges_jury.license_valid_date',
                        'judges_jury.jury_class',
                        'judges_jury.issf_license_no_en as issf_license_no',
                        'judges_jury.remark_en as remark',
                    ]
                )->where('deleted_at',null);
            }
            return Datatables::of($jurys)
                ->filter(function ($query) use ($request) {
                    if ($request->has('name') && !empty($request->name)) {
                        if (app()->getLocale() == 'bn'){
                            $query->where('judges_jury.name_bn', 'like', "%{$request->get('name')}%");
                        }else{
                            $query->where('judges_jury.name_en', 'like', "%{$request->get('name')}%");
                        }
                    }
                    if ($request->has('email') && !empty($request->email)) {
                        $query->where('judges_jury.email', 'like', "%{$request->get('email')}%");
                    }

                    if ($request->has('mobile') && !empty($request->mobile)) {
                        if (app()->getLocale() == 'bn'){
                            $query->where('judges_jury.mobile_bn', 'like', "%{$request->get('mobile')}%");
                        }else{
                            $query->where('judges_jury.mobile_en', 'like', "%{$request->get('mobile')}%");
                        }
                    }
                })
                ->addColumn('status', function ($row) {
                    if ($row->is_active == 1) {
                        $status = 'Active';
                    } else {
                        $status = 'Inactive';
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
							<a href="' . route('edit_jury', ['id' => $jurys->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>'.$edit.'</a>
						</li>		
						<li>
                        <a class="' . $active_class . '" href="javascript:void(0);" onClick="' . $active_href . '" id="onclick_active_' . $jurys->id . '"><i class="fas fa-check-square"></i>' . $active_txt . '</a>
                        </li>				
						<li>
							<a href="javascript:void(0);" onclick="delete_judges_jury(' . $jurys->id . ');" class=""><i class="fa fa-trash" aria-hidden="true"></i>'.$delete.'</a>
						</li>																																							
					</ul>
				</div>';
                })
                ->rawColumns(['action', 'status','committee_type'])
                ->setRowId(function ($jurys) {
                    return 'dt_row_' . $jurys->id;
                })
                ->make(true);
        }
        return view('admin.jury.index');
    }



    public function createJury()
    {
        $events = Event::getEventDropdown();
        $events['others']='Others';

        $juryClass = [
            'A' => 'Class A',
            'B' => 'Class B',
        ];
        return view('admin.jury.add',['juryClass'=>$juryClass,'events'=>$events]);
    }

    public function storeJury(JuryFormRequest $request)
    {
        $jury = new Jury();
        if ($request->hasFile('profile_image')) {
            $image_name = 'jury-'.str_pad(mt_rand(1,99999999),10,'0',STR_PAD_LEFT);
            $fileName = ImgUploader::UploadImage('jury', $request->file('profile_image'), $image_name, 270, 270);
            $jury->profile_image = $fileName;
        }
        if ($request->hasFile('e_signature')) {
            $image_name = 'j-sign-'.str_pad(mt_rand(1,99999999),10,'0',STR_PAD_LEFT);
            $fileName = ImgUploader::UploadImage('jury', $request->file('e_signature'), $image_name, 270, 270);
            $jury->e_signature = $fileName;
        }
        if (app()->getLocale() == 'bn'){
            $jury->name_bn = $request->input('name');
            $jury->mobile_bn = $request->input('mobile');
            $jury->address_bn = $request->input('address');
            $jury->issf_license_no_bn = $request->input('issf_license_no');
            $jury->remark_bn = $request->input('remark');
        }else{
            $jury->name_en = $request->input('name');
            $jury->mobile_en = $request->input('mobile');
            $jury->address_en = $request->input('address');
            $jury->issf_license_no_en = $request->input('issf_license_no');
            $jury->remark_en = $request->input('remark');
        }

        $jury->email = $request->input('email');
        $jury->license_valid_date = $request->input('license_valid_date');
        $jury->date_of_birth = $request->input('date_of_birth');
        $jury->jury_class = $request->input('jury_class');

        if ($request->input('rifle')){
            $jury->is_rifle = true;
        }
        if ($request->input('short_gun')){
            $jury->is_short_gun = true;
        }
        if ($request->input('running_target')){
            $jury->is_running_target = true;
        }
        if ($request->input('electronic_target')){
            $jury->is_electronic_target = true;
        }
        if ($request->input('pistol')){
            $jury->is_pistol = true;
        }
        if ($request->input('target_control')){
            $jury->is_target_control = true;
        }

        $jury->save();
        $jury->sort_order = $jury->id;
        $jury->update();

        foreach ($request->input('events') as $key => $type){
            $juryEvent = new JuryEvent();
            $juryEvent->jury_id = $jury->id;
            if ($request->input('events')[$key] != 'others'){
                $juryEvent->event_id = $request->input('events')[$key];
            }
            if (app()->getLocale() == 'bn'){
                $juryEvent->event_name_bn = $request->input('event_name')[$key];
                $juryEvent->event_address_bn = $request->input('event_address')[$key];
            }else{
                $juryEvent->event_name_en = $request->input('event_name')[$key];
                $juryEvent->event_address_en = $request->input('event_address')[$key];
            }

            $juryEvent->save();
            $juryEvent->sort_order = $juryEvent->id;
            $juryEvent->update();
        }

        flash(__('messages.Insert_message_judges_jury'))->success();
        return \Redirect::route('edit_jury', array($jury->id));
    }

    public function editJury($id)
    {
        if (app()->getLocale() == 'bn') {
            $jury = Jury::select(
                [
                    'id','name_bn as name','mobile_bn as mobile','email','issf_license_no_bn as issf_license_no','license_valid_date','date_of_birth','jury_class','address_bn as address','remark_bn as remark','profile_image','e_signature','is_rifle','is_pistol','is_short_gun','is_running_target','is_electronic_target','is_target_control','is_default','is_active','sort_order'
                ]
            );
        }else{
            $jury = Jury::select(
                [
                    'id','name_en as name','mobile_en as mobile','email','issf_license_no_en as issf_license_no','license_valid_date','date_of_birth','jury_class','address_en as address','remark_en as remark','profile_image','e_signature','is_rifle','is_pistol','is_short_gun','is_running_target','is_electronic_target','is_target_control','is_default','is_active','sort_order'
                ]
            );
        }
        $jury = $jury->where('id',$id)->first();
        $events = Event::getEventDropdown();
        $events['others']='Others';

        $juryClass = [
            'A' => 'Class A',
            'B' => 'Class B',
        ];

        return view('admin.jury.edit',['jury'=>$jury,'events'=>$events,'juryClass'=>$juryClass]);
    }


    public function updateJury($id, JuryFormRequest $request)
    {
//        dd($request->all());
        $jury = Jury::find($id);

        if ($request->hasFile('profile_image')) {
            \Illuminate\Support\Facades\File::delete(public_path().'/jury/'.$jury->profile_image);
            \Illuminate\Support\Facades\File::delete(public_path().'/jury/thumb/'.$jury->profile_image);
            \Illuminate\Support\Facades\File::delete(public_path().'/jury/mid/'.$jury->profile_image);
            $image_name = 'jury-'.str_pad(mt_rand(1,99999999),10,'0',STR_PAD_LEFT);
            $fileName = ImgUploader::UploadImage('jury', $request->file('profile_image'), $image_name, 270, 270);
            $jury->profile_image = $fileName;
        }

        if ($request->hasFile('e_signature')) {
            \Illuminate\Support\Facades\File::delete(public_path().'/jury/'.$jury->e_signature);
            \Illuminate\Support\Facades\File::delete(public_path().'/jury/thumb/'.$jury->e_signature);
            \Illuminate\Support\Facades\File::delete(public_path().'/jury/mid/'.$jury->e_signature);
            $image_name = 'j-sign-'.str_pad(mt_rand(1,99999999),10,'0',STR_PAD_LEFT);
            $fileName = ImgUploader::UploadImage('jury', $request->file('e_signature'), $image_name, 270, 270);
            $jury->e_signature = $fileName;
        }

        if (app()->getLocale() == 'bn'){
            $jury->name_bn = $request->input('name');
            $jury->mobile_bn = $request->input('mobile');
            $jury->address_bn = $request->input('address');
            $jury->issf_license_no_bn = $request->input('issf_license_no');
            $jury->remark_bn = $request->input('remark');
        }else{
            $jury->name_en = $request->input('name');
            $jury->mobile_en = $request->input('mobile');
            $jury->address_en = $request->input('address');
            $jury->issf_license_no_en = $request->input('issf_license_no');
            $jury->remark_en = $request->input('remark');
        }

        $jury->email = $request->input('email');
        $jury->license_valid_date = $request->input('license_valid_date');
        $jury->date_of_birth = $request->input('date_of_birth');
        $jury->jury_class = $request->input('jury_class');

        if ($request->input('rifle')){
            $jury->is_rifle = true;
        }else{
            $jury->is_rifle = false;
        }
        if ($request->input('short_gun')){
            $jury->is_short_gun = true;
        }else{
            $jury->is_short_gun = false;
        }
        if ($request->input('running_target')){
            $jury->is_running_target = true;
        }else{
            $jury->is_running_target = false;
        }
        if ($request->input('electronic_target')){
            $jury->is_electronic_target = true;
        }else{
            $jury->is_electronic_target = false;
        }
        if ($request->input('pistol')){
            $jury->is_pistol = true;
        }else{
            $jury->is_pistol = false;
        }
        if ($request->input('target_control')){
            $jury->is_target_control = true;
        }else{
            $jury->is_target_control = false;
        }

        $jury->update();

        foreach ($request->input('exists_event_id') as $key => $type){
            $juryEvent = JuryEvent::find($type);

            if ($request->input('events')[$key] != 'others'){
                $juryEvent->event_id = $request->input('events')[$key];
            }
            if (app()->getLocale() == 'bn'){
                $juryEvent->event_name_bn = $request->input('event_name')[$key];
                $juryEvent->event_address_bn = $request->input('event_address')[$key];
            }else{
                $juryEvent->event_name_en = $request->input('event_name')[$key];
                $juryEvent->event_address_en = $request->input('event_address')[$key];
            }

            $juryEvent->save();
            $juryEvent->sort_order = $juryEvent->id;
            $juryEvent->update();
        }

        flash(__('messages.Edit_message_judges_jury'))->success();
        return \Redirect::route('edit_jury', array($jury->id));
    }


    public function deleteJury(Request $request)
    {
        $id = $request->input('id');
        try {
            $archive = Jury::findOrFail($id);
            $archive->deleted_at = now();
            $archive->update();
            /*$juryEvent = JuryEvent::where('jury_id',$id);
            $jury = Jury::findOrFail($id);
            \Illuminate\Support\Facades\File::delete(public_path().'/jury/'.$jury->profile_image);
            \Illuminate\Support\Facades\File::delete(public_path().'/jury/thumb/'.$jury->profile_image);
            \Illuminate\Support\Facades\File::delete(public_path().'/jury/mid/'.$jury->profile_image);
            \Illuminate\Support\Facades\File::delete(public_path().'/jury/'.$jury->e_signature);
            \Illuminate\Support\Facades\File::delete(public_path().'/jury/thumb/'.$jury->e_signature);
            \Illuminate\Support\Facades\File::delete(public_path().'/jury/mid/'.$jury->e_signature);
            $juryEvent->delete();
            $jury->delete();*/
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeActiveJury(Request $request)
    {
        $id = $request->input('id');
        try {
            $archive = Jury::findOrFail($id);
            $archive->is_active = 1;
            $archive->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Active'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveJury(Request $request)
    {
        $id = $request->input('id');
        try {
            $archive = Jury::findOrFail($id);
            $archive->is_active = 0;
            $archive->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Inactive'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }


//    SORT jury START
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
//    SORT Jury END
}
