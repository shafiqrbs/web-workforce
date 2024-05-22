<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\DataArrayHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExecutiveCommitteeFormRequest;
use App\Http\Requests\MemberFormRequest;
use App\Models\CommitteeMember;
use App\Models\Member;
use App\Models\MemberJoinDesignation;
use App\Models\FinancialPartner;
use App\Models\ShootingSportClub;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use ImgUploader;
use File;

class MemberController extends Controller
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
    public function indexMembers(Request $request)
    {

        /*DB::statement(DB::raw('set @rownum=0'));
        $committeeMembers = Member::select(
            [
                DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'members.name',
                'members.email',
                'members.mobile',
                'members.is_active',
                'members.id',
            ]
        )->with(array(
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
            ->where('members.is_active',1);*/
//            ->get()->toArray();
//        dd($committeeMembers);

        if ($request->ajax()) {
            /*DB::statement(DB::raw('set @rownum=0'));
            $committeeMembers = MemberJoinDesignation::select(
                [
                    DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                    'members_join_designation.committee_type',
                    'members_join_designation.sub_committee_group',
                    'members_join_designation.designation_id',
                    'career_levels.career_level as designation',
                    'members.name',
                    'members.email',
                    'members.mobile',
                    'members.is_active',
                    'members.id',
                ]
            )
                ->join('career_levels', 'career_levels.id', '=', 'members_join_designation.designation_id')
                ->join('members', 'members.id', '=', 'members_join_designation.member_id');*/
//            ->where('members.is_active',1)
//            ->get()->toArray();

            DB::statement(DB::raw('set @rownum=0'));
            $committeeMembers = Member::select(
                [
                    DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                    'members.name',
                    'members.email',
                    'members.mobile',
                    'members.is_active',
                    'members.id',
                ]
            )->with(array(
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
            ));
                #->where('members.is_active',1);
            return Datatables::of($committeeMembers)
                ->filter(function ($query) use ($request) {
                    if ($request->has('name') && !empty($request->name)) {
                        $query->where('members.name', 'like', "%{$request->get('name')}%");
                    }
                    if ($request->has('email') && !empty($request->email)) {
                        $query->where('members.email', 'like', "%{$request->get('email')}%");
                    }

                    if ($request->has('mobile') && !empty($request->mobile)) {
                        $query->where('members.mobile', 'like', "%{$request->get('mobile')}%");
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

                ->addColumn('committee_type', function ($row) {
                    if ($row->memberDesignation){
                        $committeeType = '';
                        $index = 1;
                        foreach ($row->memberDesignation as $val){
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
                                    if ($val->sub_committee_group == 'PROMOTION_PUBLICATION'){
                                        $type = 'Promotion and Publication';
                                    }
                                    if ($val->sub_committee_group == 'HEALTH_TREATMENT'){
                                        $type = 'Health & Treatment';
                                    }
                                    if ($val->sub_committee_group == 'REGULATIONS_LAW'){
                                        $type = 'Regulations/law';
                                    }
                                }
                            }
                            $committeeType = $committeeType. $type . ' - (' . $val->designation.')'.', ';
                            $index++;
                        }
                        return $committeeType;
                    }
                })
                ->addColumn('action', function ($committeeMembers) {
                    $active_class = '';
                    if ((int)$committeeMembers->is_active == 1) {
                        $active_txt = 'Inactive';
                        $active_href = 'make_not_active(' . $committeeMembers->id . ');';
                        $active_icon = 'square-o';
                    } else {
                        $active_txt = 'Active';
                        $active_href = 'make_active(' . $committeeMembers->id . ');';
                        $active_icon = 'check-square';
                    }
                    return '
				<div class="btn-group">
					<button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('edit_member', ['id' => $committeeMembers->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>		
						<li>
                        <a class="' . $active_class . '" href="javascript:void(0);" onClick="' . $active_href . '" id="onclick_active_' . $committeeMembers->id . '"><i class="fas fa-check-square"></i>' . $active_txt . '</a>
                        </li>				
						<li>
							<a href="javascript:void(0);" onclick="delete_committee_member(' . $committeeMembers->id . ');" class=""><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
						</li>																																							
					</ul>
				</div>';
                })
                ->rawColumns(['action', 'status','committee_type'])
                ->setRowId(function ($committeeMembers) {
                    return 'dt_row_' . $committeeMembers->id;
                })
                ->make(true);
        }
        return view('admin.member.index');
    }



    public function createMember()
    {
        $designations = DataArrayHelper::langCareerLevelsArrayByCommitteeType('EXECUTIVE_COMMITTEE');
        $CommitteeGroups = [
            'EXECUTIVE_COMMITTEE' => 'Execuitive Committee',
            'CAMP_COMMANDANT_COACH' => 'Camp Commandant Coach',
            #'OFFICE_ADMINISTRATION' => 'Office Administration',
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
        return view('admin.member.add',['designations'=>$designations,'CommitteeGroups'=>$CommitteeGroups]);
    }

    public function designationDropdown(){
        $committeeType = $_GET['committeeType'];
        if ($committeeType != 'EXECUTIVE_COMMITTEE' && $committeeType != 'CAMP_COMMANDANT_COACH'){
            $committeeType = 'SUB_COMMITTEE';
        }

        $designations = DataArrayHelper::langCareerLevelsArrayByCommitteeType($committeeType);
        return $designations;
    }

    public function storeMember(MemberFormRequest $request)
    {
        $member = new Member();

        if ($request->hasFile('profile_image')) {
            $image_name = $request->input('name');
            $fileName = ImgUploader::UploadImage('committee_member', $request->file('profile_image'), $image_name, 270, 270);
            $member->profile_image = $fileName;
        }
        $member->name = $request->input('name');
        $member->mobile = $request->input('mobile');
        $member->email = $request->input('email');
        $member->address = $request->input('address');
        $member->short_message = $request->input('short_message');
        $member->facebook_link = $request->input('facebook_link');
        $member->save();
        $member->sort_order = $member->id;
        $member->update();

        foreach ($request->input('committee_type') as $key => $type){
            $memberDesignation = new MemberJoinDesignation();
            $committeeType = $type;
            if ($type != 'EXECUTIVE_COMMITTEE' && $type != 'CAMP_COMMANDANT_COACH'){
                $committeeType = 'SUB_COMMITTEE';
                $memberDesignation->sub_committee_group = $type;
            }
            $memberDesignation->member_id = $member->id;
            $memberDesignation->committee_type = $committeeType;
            $memberDesignation->designation_id = $request->input('designation_id')[$key];
            $memberDesignation->save();
            $memberDesignation->sort_order = $memberDesignation->id;
            $memberDesignation->update();
        }

        flash('Executive member has been added!')->success();
        return \Redirect::route('edit_member', array($member->id));
    }

    public function editMember($id)
    {
        $member = Member::findOrFail($id);
        $CommitteeGroups = [
            'EXECUTIVE_COMMITTEE' => 'Execuitive Committee',
            'CAMP_COMMANDANT_COACH' => 'Camp Commandant Coach',
            #'OFFICE_ADMINISTRATION' => 'Office Administration',
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

        return view('admin.member.edit',['member'=>$member,'CommitteeGroups'=>$CommitteeGroups]);

    }


    public function updateMember($id, MemberFormRequest $request)
    {
        $member = Member::find($id);

        if ($request->hasFile('profile_image')) {
            \Illuminate\Support\Facades\File::delete(public_path().'/committee_member/'.$member->profile_image);
            \Illuminate\Support\Facades\File::delete(public_path().'/committee_member/thumb/'.$member->profile_image);
            \Illuminate\Support\Facades\File::delete(public_path().'/committee_member/mid/'.$member->profile_image);
            $image_name = $request->input('name');
            $fileName = ImgUploader::UploadImage('committee_member', $request->file('profile_image'), $image_name, 270, 270);
            $member->profile_image = $fileName;
        }
        $member->name = $request->input('name');
        $member->mobile = $request->input('mobile');
        $member->email = $request->input('email');
        $member->address = $request->input('address');
        $member->short_message = $request->input('short_message');
        $member->facebook_link = $request->input('facebook_link');
        $member->update();

        MemberJoinDesignation::where('member_id',$id)->delete();

        foreach ($request->input('committee_type') as $key => $type){
            $memberDesignation = new MemberJoinDesignation();
            $committeeType = $type;
            if ($type != 'EXECUTIVE_COMMITTEE' && $type != 'CAMP_COMMANDANT_COACH'){
                $committeeType = 'SUB_COMMITTEE';
                $memberDesignation->sub_committee_group = $type;
            }
            $memberDesignation->member_id = $member->id;
            $memberDesignation->committee_type = $committeeType;
            $memberDesignation->designation_id = $request->input('designation_id')[$key];
            $memberDesignation->save();
            $memberDesignation->sort_order = $memberDesignation->id;
            $memberDesignation->update();
        }
        flash('Executive member has been updated!')->success();
        return \Redirect::route('edit_member', array($member->id));
    }


    public function deleteMember(Request $request)
    {
        $id = $request->input('id');
        try {
            $memberDesignation = MemberJoinDesignation::where('member_id',$id);
            $committeeMember = Member::findOrFail($id);
            \Illuminate\Support\Facades\File::delete(public_path().'/committee_member/'.$committeeMember->profile_image);
            \Illuminate\Support\Facades\File::delete(public_path().'/committee_member/thumb/'.$committeeMember->profile_image);
            \Illuminate\Support\Facades\File::delete(public_path().'/committee_member/mid/'.$committeeMember->profile_image);
            $memberDesignation->delete();
            $committeeMember->delete();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeActiveMember(Request $request)
    {
        $id = $request->input('id');
        try {
            $archive = Member::findOrFail($id);
            $archive->is_active = 1;
            $archive->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Active'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveMember(Request $request)
    {
        $id = $request->input('id');
        try {
            $archive = Member::findOrFail($id);
            $archive->is_active = 0;
            $archive->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Inactive'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }


//    SORT EXECUTIVE COMMITTEE START
    public function sortECMembers(Request $request)
        {
            if ($request->ajax()){
                DB::statement(DB::raw('set @rownum=0'));
                $committeeMembers = MemberJoinDesignation::select(
                    [DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'members_join_designation.committee_type', 'members_join_designation.designation_id', 'career_levels.career_level as designation', 'members.name', 'members.is_active', 'members_join_designation.id',
                    ]
                )->join('career_levels', 'career_levels.id', '=', 'members_join_designation.designation_id')->join('members', 'members.id', '=', 'members_join_designation.member_id')->where('members_join_designation.committee_type','EXECUTIVE_COMMITTEE')->where('members.is_active',1)->orderBy('members_join_designation.sort_order')->get();

                $str = '<ul id="sortable">';
                if ($committeeMembers != null) {
                    foreach ($committeeMembers as $committeeMember) {
                        $str .= '<li id="' . $committeeMember->id . '"><i class="fa fa-sort"></i>' . $committeeMember->name .' (<b>'.$committeeMember->designation. '</b>) </li>';
                    }
                }
                return $str . '</ul>';
            }
            return view('admin.member.sort-ec');
        }

        public function sortCCCMembers(Request $request)
        {
            if ($request->ajax()){
                DB::statement(DB::raw('set @rownum=0'));
                $committeeMembers = MemberJoinDesignation::select(
                    [DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'members_join_designation.committee_type', 'members_join_designation.designation_id', 'career_levels.career_level', 'members.name', 'members.is_active', 'members_join_designation.id',
                    ]
                )->join('career_levels', 'career_levels.id', '=', 'members_join_designation.designation_id')->join('members', 'members.id', '=', 'members_join_designation.member_id')->where('members_join_designation.committee_type','CAMP_COMMANDANT_COACH')->where('members.is_active',1)->orderBy('members_join_designation.sort_order')->get();

                $str = '<ul id="sortable">';
                if ($committeeMembers != null) {
                    foreach ($committeeMembers as $committeeMember) {
                        $str .= '<li id="' . $committeeMember->id . '"><i class="fa fa-sort"></i>' . $committeeMember->name .' (<b>'.$committeeMember->designation. '</b>) </li>';
                    }
                }
                return $str . '</ul>';
            }
            return view('admin.member.sort-ccc');
        }

        public function sortOAMembers(Request $request)
        {
            if ($request->ajax()){
                DB::statement(DB::raw('set @rownum=0'));
                $committeeMembers = MemberJoinDesignation::select(
                    [DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'members_join_designation.committee_type', 'members_join_designation.designation_id', 'career_levels.career_level as designation', 'members.name', 'members.is_active', 'members_join_designation.id',
                    ]
                )->join('career_levels', 'career_levels.id', '=', 'members_join_designation.designation_id')->join('members', 'members.id', '=', 'members_join_designation.member_id')->where('members_join_designation.committee_type','OFFICE_ADMINISTRATION')->where('members.is_active',1)->orderBy('members_join_designation.sort_order')->get();

                $str = '<ul id="sortable">';
                if ($committeeMembers != null) {
                    foreach ($committeeMembers as $committeeMember) {
                        $str .= '<li id="' . $committeeMember->id . '"><i class="fa fa-sort"></i>' . $committeeMember->name .' (<b>'.$committeeMember->designation. '</b>) </li>';
                    }
                }
                return $str . '</ul>';
            }
            return view('admin.member.sort-oa');
        }

        public function sortSCMembers(Request $request)
        {
            if ($request->ajax()){
                DB::statement(DB::raw('set @rownum=0'));
                $committeeMembers = MemberJoinDesignation::select(
                    [DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'members_join_designation.committee_type', 'members_join_designation.designation_id', 'career_levels.career_level as designation', 'members.name', 'members.is_active', 'members_join_designation.id',
                    ]
                )->join('career_levels', 'career_levels.id', '=', 'members_join_designation.designation_id')->join('members', 'members.id', '=', 'members_join_designation.member_id')->where('members_join_designation.committee_type','SUB_COMMITTEE')->where('members.is_active',1)->orderBy('members_join_designation.sort_order')->get();

                $str = '<ul id="sortable">';
                if ($committeeMembers != null) {
                    foreach ($committeeMembers as $committeeMember) {
                        $str .= '<li id="' . $committeeMember->id . '"><i class="fa fa-sort"></i>' . $committeeMember->name .' (<b>'.$committeeMember->designation. '</b>) </li>';
                    }
                }
                return $str . '</ul>';
            }
            return view('admin.member.sort-sc');
        }

        public function MemberSortUpdate(Request $request)
        {
            $committeeMemberOrder = $request->input('faqOrder');
            $committeeMemberOrderArray = explode(',', $committeeMemberOrder);
            $count = 1;
            foreach ($committeeMemberOrderArray as $committeeMember_id) {
                $committeeMember = MemberJoinDesignation::find($committeeMember_id);
                $committeeMember->sort_order = $count;
                $committeeMember->update();
                $count++;
            }
        }
//    SORT EXECUTIVE COMMITTEE END
}
