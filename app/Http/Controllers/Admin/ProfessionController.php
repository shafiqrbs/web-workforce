<?php

namespace App\Http\Controllers\Admin;

use App\Models\Archive;
use App\Models\Athlete;
use App\Models\Event;
use App\Models\Profession;
use Auth;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Input;
use Carbon\Carbon;
use Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Language;
use App\Http\Requests\ArchiveFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use ImgUploader;
use File;

class ProfessionController extends Controller
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
    public function indexProfession(Request $request)
    {
        if ($request->ajax()) {
            \Illuminate\Support\Facades\DB::statement(DB::raw('set @rownum=0'));
            $data = Profession::select([
                DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'profession','id','is_active'
            ]);
            return Datatables::of($data)
                ->filter(function ($query) use ($request) {
                    if ($request->has('profession') && !empty($request->profession)) {
                        $query->where(function ($q) use ($request) {
                            $q->where('profession', 'like', "%{$request->get('profession')}%");
                        });
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

                ->addColumn('action', function ($row) {
                    $active_class = '';
                    if ((int)$row->is_active == 1) {
                        $active_txt = 'Inactive';
                        $active_href = 'make_not_active(' . $row->id . ');';
                        $active_icon = 'square-o';
                    } else {
                        $active_txt = 'Active';
                        $active_href = 'make_active(' . $row->id . ');';
                        $active_icon = 'check-square';
                    }
                    return '
				<div class="btn-group">
					<button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('profession.edit', ['id' => $row->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>						
                        
                        <li>
                        <a class="' . $active_class . '" href="javascript:void(0);" onClick="' . $active_href . '" id="onclick_active_' . $row->id . '"><i class="fas fa-check-square"></i>' . $active_txt . '</a>
                        </li>	
                        <li>
                            <a href="javascript:void(0);" onclick="delete_profession(' . $row->id . ');" class=""><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                        </li>																																					
					</ul>
				</div>';
                })
                ->rawColumns(['action','status'])
                ->setRowId(function($data) {
                    return 'dt_row_' . $data->id;
                })
                ->make(true);
        }
        return view('admin.profession.index');
    }

    public function createProfession()
    {
        return view('admin.profession.add');
    }

    public function storeProfession(Requests\ProfessionFormRequest $request)
    {
        $input = $request->all();

        $profession = Profession::create($input);
        $updateProfession = Profession::getIdWiseData($profession->id);
        $updateProfession['sort_order'] = $profession->id;
        $updateProfession->update();
        flash('Profession has been added!')->success();
        return \Redirect::route('profession.edit', array($profession->id));
    }

    public function editProfession($id)
    {
        $profession = Profession::getIdWiseData($id);
        return view('admin.profession.edit')->with('profession',$profession);
    }

    public function updateProfession($id, Requests\ProfessionFormRequest $request)
    {
        $profession = Profession::getIdWiseData($id);
        $input = $request->all();

        $profession->update($input);
        flash('Profession has been updated!')->success();
        return \Redirect::route('profession.edit', array($profession->id));
    }

    public function deleteProfession(Request $request)
    {
        $id = $request->input('id');
        try {
            $profession = Profession::findOrFail($id);
            $profession->delete();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeActiveProfession(Request $request)
    {
        $id = $request->input('id');
        try {
            $profession = Profession::findOrFail($id);
            $profession->is_active = 1;
            $profession->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Active'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveProfession(Request $request)
    {
        $id = $request->input('id');
        try {
            $profession = Profession::findOrFail($id);
            $profession->is_active = 0;
            $profession->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Inactive'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function sortProfession()
    {
        return view('admin.profession.sort');
    }

    public function professionSortData(Request $request)
    {
        $professions = Profession::orderBy('sort_order')->get();
        $str = '<ul id="sortable">';
        if ($professions != null) {
            foreach ($professions as $profession) {
                $str .= '<li id="' . $profession->id . '"><i class="fa fa-sort"></i>' . $profession->profession . '</li>';
            }
        }
        echo $str . '</ul>';
    }

    public function professionSortUpdate(Request $request)
    {
        $professionOrder = $request->input('professionOrder');
        $professionOrderArray = explode(',', $professionOrder);
        $count = 1;
        foreach ($professionOrderArray as $professionID) {
            $profession = Profession::find($professionID);
            $profession->sort_order = $count;
            $profession->update();
            $count++;
        }
    }

}
