<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Support\Facades\DB;
use Input;
use File;
use Carbon\Carbon;
use ImgUploader;
use Redirect;
use App\CareerLevel;
use App\Language;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;
use App\Http\Requests\CareerLevelFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CareerLevelController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function indexCareerLevels()
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        return view('admin.career_level.index')->with('languages', $languages);
    }

    public function createCareerLevel()
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        $careerLevels = DataArrayHelper::defaultCareerLevelsArray();
        $committeeTypes = ['EXECUTIVE_COMMITTEE' => 'Executive Committee','SUB_COMMITTEE' => 'Sub Committees','CAMP_COMMANDANT_COACH' => 'Camp Commandant & Coach','OFFICE_ADMINISTRATION' => 'Office Administration'];

        return view('admin.career_level.add')
                        ->with('languages', $languages)
                        ->with('committeeTypes', $committeeTypes)
                        ->with('careerLevels', $careerLevels);
    }

    public function storeCareerLevel(CareerLevelFormRequest $request)
    {
        $careerLevel = new CareerLevel();
        $careerLevel->career_level = $request->input('career_level');
        $careerLevel->is_active = $request->input('is_active');
        $careerLevel->committee_type = $request->input('committee_type');
        $careerLevel->lang = $request->input('lang');
        $careerLevel->is_default = $request->input('is_default');
        $careerLevel->lang = 'en';
        $careerLevel->save();
        /*         * ************************************ */
        $careerLevel->sort_order = $careerLevel->id;
        if ((int) $request->input('is_default') == 1) {
            $careerLevel->career_level_id = $careerLevel->id;
        } else {
            $careerLevel->career_level_id = $request->input('career_level_id');
        }
        $careerLevel->update();
        flash('Career Level has been added!')->success();
        return \Redirect::route('edit.career.level', array($careerLevel->id));
    }

    public function editCareerLevel($id)
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        $careerLevels = DataArrayHelper::defaultCareerLevelsArray();
        $committeeTypes = ['EXECUTIVE_COMMITTEE' => 'Executive Committee','SUB_COMMITTEE' => 'Sub Committees','CAMP_COMMANDANT_COACH' => 'Camp Commandant & Coach','OFFICE_ADMINISTRATION' => 'Office Administration'];

        $careerLevel = CareerLevel::findOrFail($id);
        return view('admin.career_level.edit')
            ->with('languages', $languages)
            ->with('careerLevel', $careerLevel)
            ->with('committeeTypes', $committeeTypes)
            ->with('careerLevels', $careerLevels);
    }

    public function updateCareerLevel($id, CareerLevelFormRequest $request)
    {
        $careerLevel = CareerLevel::findOrFail($id);
        $careerLevel->career_level = $request->input('career_level');
        $careerLevel->is_active = $request->input('is_active');
        $careerLevel->lang = $request->input('lang');
        $careerLevel->committee_type = $request->input('committee_type');
        $careerLevel->is_default = $request->input('is_default');
        $careerLevel->lang = 'en';
        if ((int) $request->input('is_default') == 1) {
            $careerLevel->career_level_id = $careerLevel->id;
        } else {
            $careerLevel->career_level_id = $request->input('career_level_id');
        }
        $careerLevel->update();
        flash('Career Level has been updated!')->success();
        return \Redirect::route('edit.career.level', array($careerLevel->id));
    }

    public function deleteCareerLevel(Request $request)
    {
        $id = $request->input('id');
        try {
            $careerLevel = CareerLevel::findOrFail($id);
            if ((bool) $careerLevel->is_default) {
                CareerLevel::where('career_level_id', '=', $careerLevel->career_level_id)->delete();
            } else {
                $careerLevel->delete();
            }
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function fetchCareerLevelsData(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $careerLevels = CareerLevel::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'career_levels.id', 'career_levels.career_level', 'career_levels.is_active', 'career_levels.lang', 'career_levels.is_default', 'career_levels.created_at', 'career_levels.updated_at','career_levels.committee_type'
        ]);
        return Datatables::of($careerLevels)
                        ->filter(function ($query) use ($request) {
                            if ($request->has('career_level') && !empty($request->career_level)) {
                                $query->where('career_levels.career_level', 'like', "%{$request->get('career_level')}%");
                            }
                            if ($request->has('committee_type') && !empty($request->get('committee_type'))) {
                                $query->where('career_levels.committee_type', 'like', "%{$request->get('committee_type')}%");
                            }
                            /*if ($request->has('is_active') && $request->get('is_active') != -1) {
                                $query->where('career_levels.is_active', '=', "{$request->get('is_active')}");
                            }*/
                        })
                        ->addColumn('career_level', function ($careerLevels) {
                            $careerLevel = Str::limit($careerLevels->career_level, 100, '...');
                            $direction = MiscHelper::getLangDirection($careerLevels->lang);
                            return '<span dir="' . $direction . '">' . $careerLevel . '</span>';
                        })

                        ->addColumn('status', function($row){
                            if ($row->is_active == 1){
                                $status = 'Active';
                            }else{
                                $status = 'Inactive';
                            }
                            return $status;
                        })

                        ->addColumn('committee_type', function ($careerLevels) {
                            if ($careerLevels->committee_type == 'EXECUTIVE_COMMITTEE'){
                                $designation = 'Executive Committee';
                            }

                            if ($careerLevels->committee_type == 'SUB_COMMITTEE'){
                                $designation = 'Sub Committees';
                            }

                            if ($careerLevels->committee_type == 'CAMP_COMMANDANT_COACH'){
                                $designation = 'Camp Commandant & Coach';
                            }

                            if ($careerLevels->committee_type == 'OFFICE_ADMINISTRATION'){
                                $designation = 'Office Administration';
                            }
                            return $designation;
                        })

                        ->addColumn('action', function ($careerLevels) {
                            $activeTxt = 'Active';
                            $activeHref = 'makeActive(' . $careerLevels->id . ');';
                            $activeIcon = 'square-o';
                            if ((int) $careerLevels->is_active == 1) {
                                $activeTxt = 'InActive';
                                $activeHref = 'makeNotActive(' . $careerLevels->id . ');';
                                $activeIcon = 'check-square-o';
                            }
                            return '
				<div class="btn-group">
					<button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('edit.career.level', ['id' => $careerLevels->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>
						
						<li>
						<a href="javascript:void(0);" onClick="' . $activeHref . '" id="onclickActive' . $careerLevels->id . '"><i class="fa fa-check-square" aria-hidden="true"></i>' . $activeTxt . '</a>
						</li>	
												
						<li>
							<a href="javascript:void(0);" onclick="deleteCareerLevel(' . $careerLevels->id . ', ' . $careerLevels->is_default . ');" class=""><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
						</li>
																																							
					</ul>
				</div>';
                        })
                        ->rawColumns(['career_level', 'action'])
                        ->setRowId(function($careerLevels) {
                            return 'careerLevelDtRow' . $careerLevels->id;
                        })
                        ->make(true);
    }

    public function makeActiveCareerLevel(Request $request)
    {
        $id = $request->input('id');
        try {
            $careerLevel = CareerLevel::findOrFail($id);
            $careerLevel->is_active = 1;
            $careerLevel->update();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveCareerLevel(Request $request)
    {
        $id = $request->input('id');
        try {
            $careerLevel = CareerLevel::findOrFail($id);
            $careerLevel->is_active = 0;
            $careerLevel->update();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function sortCareerLevels()
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        return view('admin.career_level.sort')->with('languages', $languages);
    }

    public function careerLevelSortData(Request $request)
    {
        $lang = $request->input('lang');
        $careerLevels = CareerLevel::select('career_levels.id', 'career_levels.career_level', 'career_levels.sort_order')
                ->where('career_levels.lang', 'like', $lang)
                ->orderBy('career_levels.sort_order')
                ->get();
        $str = '<ul id="sortable">';
        if ($careerLevels != null) {
            foreach ($careerLevels as $careerLevel) {
                $str .= '<li id="' . $careerLevel->id . '"><i class="fa fa-sort"></i>' . $careerLevel->career_level . '</li>';
            }
        }
        echo $str . '</ul>';
    }

    public function careerLevelSortUpdate(Request $request)
    {
        $careerLevelOrder = $request->input('careerLevelOrder');
        $careerLevelOrderArray = explode(',', $careerLevelOrder);
        $count = 1;
        foreach ($careerLevelOrderArray as $careerLevelId) {
            $careerLevel = CareerLevel::find($careerLevelId);
            $careerLevel->sort_order = $count;
            $careerLevel->update();
            $count++;
        }
    }

}
