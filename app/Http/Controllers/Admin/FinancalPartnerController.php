<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\DataArrayHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FinancialPartnerFormRequest;
use App\Models\CommitteeMember;
use App\Models\FinancialPartner;
use App\Models\ShootingSportClub;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

use ImgUploader;
use File;

class FinancalPartnerController extends Controller
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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            DB::statement(DB::raw('set @rownum=0'));
            $financialPartners = FinancialPartner::select(
                [
                    DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                    'financial_partners.id',
                    'financial_partners.name',
                    'financial_partners.email',
                    'financial_partners.mobile',
                    'financial_partners.address',
                    'financial_partners.short_message',
                    'financial_partners.facebook_link',
                    'financial_partners.profile_image',
                    'financial_partners.created_at',
                    'financial_partners.is_active',
                ]
            )->orderBy('financial_partners.sort_order','desc');
            return Datatables::of($financialPartners)
                ->filter(function ($query) use ($request) {
                    if ($request->has('name') && !empty($request->name)) {
                        $query->where('name', 'like', "%{$request->get('name')}%");
                    }

                    if ($request->has('mobile') && !empty($request->mobile)) {
                        $query->where('mobile', 'like', "%{$request->get('mobile')}%");
                    }
                    if ($request->has('email') && !empty($request->email)) {
                        $query->where('email', 'like', "%{$request->get('email')}%");
                    }
                })
                ->addColumn('status', function($row){
                    if ($row->is_active == 1){
                        $status = __('messages.Approved');
                    }else{
                        $status = __('messages.NotApproved');
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $active_class = '';
                    $action = __('messages.Actions');
                    $edit = __('messages.Edit');
                    $delete = __('messages.Delete');

                    if ((int)$row->is_active == 1) {
                        $active_txt = __('messages.NotApproved');
                        $active_href = 'make_not_active(' . $row->id . ');';
                        $active_icon = 'square-o';
                    } else {
                        $active_txt = __('messages.Approved');
                        $active_href = 'make_active(' . $row->id . ');';
                        $active_icon = 'check-square';
                    }
                    // Build the approval button only if the user has permission
                    $approval_btn = '';
                    if (auth()->user()->is_approval_user === 1) {
                        $approval_btn = '
                            <li>
                                <a class="' . $active_class . '" href="javascript:void(0);" onClick="' . $active_href . '" id="onclick_active_' . $row->id . '">
                                    <i class="fas fa-check-square"></i>' . $active_txt . '
                                </a>
                            </li>';
                    }
                    return '
				<div class="btn-group">
					<button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('financial_partner_edit', ['id' => $row->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>		
						' . $approval_btn . '				
						<li>
							<a href="javascript:void(0);" onclick="delete_financial_partner(' . $row->id . ');" class=""><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
						</li>																																							
					</ul>
				</div>';
                })
                ->rawColumns(['action','status'])
                ->setRowId(function($financialPartners) {
                    return 'dt_row_' . $financialPartners->id;
                })
                ->make(true);
        }

        return view('admin.financial_partner.index');
    }


    public function create()
    {
        $status=[1=>'Active',0=>'Inactive'];
        return view('admin.financial_partner.add',['status'=>$status]);
    }

    public function store(FinancialPartnerFormRequest $request)
    {
        $input = $request->all();
        if ($request->hasFile('profile_image')) {
            $image_name = $request->input('name');
            $fileName = ImgUploader::UploadImage('financial_partner', $request->file('profile_image'), $image_name, 200, 150);
            $input['profile_image'] = $fileName;
        }
        $financialMember = FinancialPartner::create($input);
        $financialMember['sort_order'] = $financialMember->id;
        $financialMember['is_active'] = false;
        $financialMember->update();
        flash('Financial partner has been added!')->success();
        return \Redirect::route('financial_partner_edit', array($financialMember->id));
    }

    public function edit($id)
    {
        $financialPartner = FinancialPartner::findOrFail($id);
        $status=[1=>'Active',0=>'Inactive'];
        return view('admin.financial_partner.edit',['status'=>$status,'financialPartner'=>$financialPartner]);
    }


    public function update($id, FinancialPartnerFormRequest $request)
    {
        $financialPartner = FinancialPartner::find($id);
        $input = $request->all();

        if ($request->hasFile('profile_image')) {
            File::delete(public_path().'/financial_partner/'.$financialPartner->profile_image);
            File::delete(public_path().'/financial_partner/mid/'.$financialPartner->profile_image);
            File::delete(public_path().'/financial_partner/thumb/'.$financialPartner->profile_image);
            $image_name = $request->input('name');
            $fileName = ImgUploader::UploadImage('financial_partner', $request->file('profile_image'), $image_name, 200, 150);
            $input['profile_image'] = $fileName;
        }

        $financialPartner->update($input);
        flash('Financial partner has been updated!')->success();
        return \Redirect::route('financial_partner_edit', array($financialPartner->id));
    }


    public function destroy(Request $request)
    {
        $id = $request->input('id');
        try {
            $financialPartner = FinancialPartner::findOrFail($id);
            File::delete(public_path().'/financial_partner/'.$financialPartner->profile_image);
            File::delete(public_path().'/financial_partner/mid/'.$financialPartner->profile_image);
            File::delete(public_path().'/financial_partner/thumb/'.$financialPartner->profile_image);
            $financialPartner->delete();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function sortFinancialPartner()
    {
        return view('admin.financial_partner.sort');
    }

    public function financialPartnerSortData(Request $request)
    {
        $lang = $request->input('lang');
        $financialPartner = FinancialPartner::select('financial_partners.id', 'financial_partners.name', 'financial_partners.sort_order')
            ->orderBy('financial_partners.sort_order')->get();
        $str = '<ul id="sortable">';
        if ($financialPartner != null) {
            foreach ($financialPartner as $partner) {
                $str .= '<li id="' . $partner->id . '"><i class="fa fa-sort"></i>' . $partner->name . '</li>';
            }
        }
        echo $str . '</ul>';
    }

    public function financialPartnerSortDataUpdate(Request $request)
    {
        $financialPartner = $request->input('faqOrder');
        $financialPartnerOrderArray = explode(',', $financialPartner);
        $count = 1;
        foreach ($financialPartnerOrderArray as $partnerID) {
            $updateModel = FinancialPartner::find($partnerID);
            $updateModel->sort_order = $count;
            $updateModel->update();
            $count++;
        }
    }


    public function makeActivePartner(Request $request)
    {
        $id = $request->input('id');
        try {
            $archive = FinancialPartner::findOrFail($id);
            $archive->is_active = 1;
            $archive->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Approved'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActivePartner(Request $request)
    {
        $id = $request->input('id');
        try {
            $archive = FinancialPartner::findOrFail($id);
            $archive->is_active = 0;
            $archive->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Not Approved'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }
}
