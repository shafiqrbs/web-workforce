<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\DataArrayHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CampCommandantFormRequest;
use App\Models\CommitteeMember;
use App\Models\ShootingSportClub;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use ImgUploader;
use File;

class CommitteeCampCommandantController extends Controller
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
    public function indexCampCommandantMembers()
    {
        return view('admin.committee_member.camp_commandant.index');
    }


    public function fetchCampCommandantMembersData(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $committeeMembers = CommitteeMember::select(
            [
                DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'committee_members.id',
                'committee_members.name',
                'committee_members.email',
                'committee_members.mobile',
                'committee_members.created_at',
                'committee_members.updated_at',
                'committee_members.is_active',
                'career_levels.career_level',
            ]
        )
            ->join('career_levels','career_levels.id','=','committee_members.designation_id')
            ->where('committee_members.committee_type','=','CAMP_COMMANDANT_COACH');
        return Datatables::of($committeeMembers)
            ->filter(function ($query) use ($request) {
                if ($request->has('name') && !empty($request->name)) {
                    $query->where('committee_members.name', 'like', "%{$request->get('name')}%");
                }
                if ($request->has('email') && !empty($request->email)) {
                    $query->where('committee_members.email', 'like', "%{$request->get('email')}%");
                }

                if ($request->has('mobile') && !empty($request->mobile)) {
                    $query->where('committee_members.mobile', 'like', "%{$request->get('mobile')}%");
                }
            })
            ->addColumn('status', function($row){
                if ($row->is_active == 1){
                    $status = 'Active';
                }else{
                    $status = 'Inactive';
                }
                return $status;
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
							<a href="' . route('edit.camp.commandant.member', ['id' => $committeeMembers->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
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
            ->rawColumns(['action'])
            ->setRowId(function($committeeMembers) {
                return 'dt_row_' . $committeeMembers->id;
            })
            ->make(true);
    }



    public function createCampCommandantMember()
    {
        $designations = DataArrayHelper::langCareerLevelsArrayByCommitteeType('CAMP_COMMANDANT_COACH');

        return view('admin.committee_member.camp_commandant.add')
            ->with('designations',$designations);
    }

    public function storeCampCommandantMember(CampCommandantFormRequest $request)
    {
        $executiveMember = new CommitteeMember();

        if ($request->hasFile('profile_image')) {
            $image_name = $request->input('name');
            $fileName = ImgUploader::UploadImage('committee_member', $request->file('profile_image'), $image_name, 150, 150);
            $executiveMember->profile_image = $fileName;
        }
        $executiveMember->name = $request->input('name');
        $executiveMember->mobile = $request->input('mobile');
        $executiveMember->email = $request->input('email');
        $executiveMember->designation_id = $request->input('designation_id');
        $executiveMember->address = $request->input('address');
        $executiveMember->short_message = $request->input('short_message');
        $executiveMember->facebook_link = $request->input('facebook_link');
        $executiveMember->committee_type = 'CAMP_COMMANDANT_COACH';
        $executiveMember->save();
        /*         * ************************************ */
        $executiveMember->sort_order = $executiveMember->id;
        $executiveMember->update();
        flash('Camp Commandant member has been added!')->success();
        return \Redirect::route('edit.camp.commandant.member', array($executiveMember->id));
    }

    public function editCampCommandantMember($id)
    {

        $executiveMember = CommitteeMember::findOrFail($id);
        $designations = DataArrayHelper::langCareerLevelsArrayByCommitteeType('CAMP_COMMANDANT_COACH');

        return view('admin.committee_member.camp_commandant.edit')
            ->with('designations',$designations)
            ->with('executiveMember',$executiveMember);
    }


    public function updateCampCommandantMember($id, CampCommandantFormRequest $request)
    {
        $executiveMember = CommitteeMember::find($id);

        if ($request->hasFile('profile_image')) {
            $image_name = $request->input('name');
            $fileName = ImgUploader::UploadImage('committee_member', $request->file('profile_image'), $image_name, 150, 150);
            $executiveMember->profile_image = $fileName;
        }
        $executiveMember->name = $request->input('name');
        $executiveMember->mobile = $request->input('mobile');
        $executiveMember->email = $request->input('email');
        $executiveMember->designation_id = $request->input('designation_id');
        $executiveMember->address = $request->input('address');
        $executiveMember->short_message = $request->input('short_message');
        $executiveMember->facebook_link = $request->input('facebook_link');
        $executiveMember->committee_type = 'CAMP_COMMANDANT_COACH';
        $executiveMember->update();
        flash('Camp Commandant member has been updated!')->success();
        return \Redirect::route('edit.camp.commandant.member', array($executiveMember->id));
    }


    public function deleteCampCommandantMember(Request $request)
    {
        $id = $request->input('id');
        try {
            $committeeMember = CommitteeMember::findOrFail($id);
            $committeeMember->delete();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }


    public function sortCampCommandantMembers()
    {
        return view('admin.committee_member.camp_commandant.sort');
    }

    public function campCommandantMemberSortData(Request $request)
    {
        $lang = $request->input('lang');
        $committeeMembers = CommitteeMember::select('committee_members.id', 'committee_members.name', 'committee_members.sort_order','career_levels.career_level')
            ->where('committee_members.committee_type','=','CAMP_COMMANDANT_COACH')->orderBy('committee_members.designation_id')
            ->orderBy('committee_members.sort_order')->join('career_levels','career_levels.id','=','committee_members.designation_id')->get();
        $str = '<ul id="sortable">';
        if ($committeeMembers != null) {
            foreach ($committeeMembers as $committeeMember) {
                $str .= '<li id="' . $committeeMember->id . '"><i class="fa fa-sort"></i>' . $committeeMember->name .' (<b>'.$committeeMember->career_level. '</b>) </li>';
            }
        }
        echo $str . '</ul>';
    }

    public function campCommandantMemberSortUpdate(Request $request)
    {
        $committeeMemberOrder = $request->input('faqOrder');
        $committeeMemberOrderArray = explode(',', $committeeMemberOrder);
        $count = 1;
        foreach ($committeeMemberOrderArray as $committeeMember_id) {
            $committeeMember = CommitteeMember::find($committeeMember_id);
            $committeeMember->sort_order = $count;
            $committeeMember->update();
            $count++;
        }
    }


    public function makeActiveCampCommandant(Request $request)
    {
        $id = $request->input('id');
        try {
            $archive = CommitteeMember::findOrFail($id);
            $archive->is_active = 1;
            $archive->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Active'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveCampCommandant(Request $request)
    {
        $id = $request->input('id');
        try {
            $archive = CommitteeMember::findOrFail($id);
            $archive->is_active = 0;
            $archive->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Inactive'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }
}
