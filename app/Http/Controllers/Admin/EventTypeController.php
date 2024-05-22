<?php

namespace App\Http\Controllers\Admin;

use App\Models\Archive;
use App\Models\Athlete;
use App\Models\Event;
use App\Models\EventType;
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

class EventTypeController extends Controller
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
    public function indexEventType(Request $request)
    {
        if ($request->ajax()) {
            \Illuminate\Support\Facades\DB::statement(DB::raw('set @rownum=0'));
            $data = EventType::select([
                DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'event_type','id','is_active'
            ]);
            return Datatables::of($data)
                ->filter(function ($query) use ($request) {
                    if ($request->has('event_type') && !empty($request->profession)) {
                        $query->where(function ($q) use ($request) {
                            $q->where('event_type', 'like', "%{$request->get('event_type')}%");
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
							<a href="' . route('event_type_edit', ['id' => $row->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>						
                        
                        <li>
                        <a class="' . $active_class . '" href="javascript:void(0);" onClick="' . $active_href . '" id="onclick_active_' . $row->id . '"><i class="fas fa-check-square"></i>' . $active_txt . '</a>
                        </li>	
                        <li>
                            <a href="javascript:void(0);" onclick="delete_event_type(' . $row->id . ');" class=""><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
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
        return view('admin.event_type.index');
    }

    public function createEventType()
    {
        return view('admin.event_type.add');
    }

    public function storeEventType(Requests\EventTypeFormRequest $request)
    {
        $input = $request->all();
        $eventType = EventType::create($input);
        $updateEventType = EventType::getIdWiseData($eventType->id);
        $updateProfession['sort_order'] = $eventType->id;
        $updateEventType->update();
        flash('Event type has been added!')->success();
        return \Redirect::route('event_type_edit', array($eventType->id));
    }

    public function editEventType($id)
    {
        $eventType = EventType::getIdWiseData($id);
        return view('admin.event_type.edit')->with('eventType',$eventType);
    }

    public function updateEventType($id, Requests\EventTypeFormRequest $request)
    {
        $eventType = EventType::getIdWiseData($id);
        $input = $request->all();

        $eventType->update($input);
        flash('Event type has been updated!')->success();
        return \Redirect::route('event_type_edit', array($eventType->id));
    }

    public function deleteEventType(Request $request)
    {
        $id = $request->input('id');
        try {
            $profession = EventType::findOrFail($id);
            $profession->delete();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeActiveEventType(Request $request)
    {
        $id = $request->input('id');
        try {
            $eventType = EventType::findOrFail($id);
            $eventType->is_active = 1;
            $eventType->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Active'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveEventType(Request $request)
    {
        $id = $request->input('id');
        try {
            $eventType = EventType::findOrFail($id);
            $eventType->is_active = 0;
            $eventType->update();
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
