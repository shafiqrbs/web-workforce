<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EventFormRequest;
use App\Models\Athlete;
use App\Models\Event;
use App\Models\EventType;
use App\Models\ShootingSportClub;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Input;
use Carbon\Carbon;
use Intervention\Image\Image;
use Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Language;
use App\Http\Requests\FaqFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use ImgUploader;
use File;

class EventController extends Controller
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
    public function indexEvents(Request $request)
    {
        DB::statement(DB::raw('SET @rownum = 0'));
        if ($request->ajax()) {
            $data = Event::select([
                DB::raw('@rownum := @rownum + 1 AS rownum'),
                'events.id','events.event_name','event_type.event_type','events.number_of_club','events.number_of_athlete','events.number_of_official','events.is_active','events.location','events.participant'
            ])->leftjoin('event_type','event_type.id','=','events.event_type_id')->orderby('events.sort_order','desc');
            return Datatables::of($data)
                ->filter(function ($query) use ($request) {
                    if ($request->has('name') && !empty($request->name)) {
                        $query->where(function ($q) use ($request) {
                            $q->where('events..event_name', 'like', "%{$request->get('name')}%");
                        });
                    }
                    if ($request->has('type') && !empty($request->type)) {
                        $query->where('event_type.event_type', 'like', "%{$request->get('type')}%");
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
							<a href="' . route('event.edit', ['id' => $row->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>		
						
		                   '.$approval_btn.'					
						
						<li>
                            <a href="javascript:void(0);" onclick="delete_event(' . $row->id . ');" class=""><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
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
        return view('admin.event.index');
    }

    public function createEvent()
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        $eventType = EventType::eventTypeDropDown();
        return view('admin.event.add',['languages'=>$languages,'eventType'=>$eventType]);
    }

    public function storeEvent(EventFormRequest $request)
    {
        $input = $request->all();

        if ($input['start_date']) {
            $input['month'] = date("F", strtotime($input['start_date']));
        }
        $input['is_active'] = false;


        if ($request->hasFile('event_image')) {
            $image_name = $request->input('event_name');
            $fileName = ImgUploader::UploadImage('event', $request->file('event_image'), $image_name, 1920, 0);
            $input['event_image'] = $fileName;
        }

        if ($request->file('match_schedule_pdf') != '') {
            $target_location = 'event/pdf/';
            $slug = str_replace(' ', '-', $input['event_name']);
            $slug = str_replace("/\s+/", "-", $slug);
            $slug = str_replace(".", "-", $slug);
            $slug = strtolower($slug);
            $avatar = $request->file('match_schedule_pdf');
            $file_title = $slug.'-'.time().'.'.$avatar->getClientOriginalExtension();
            $input['match_schedule_pdf'] = $file_title;
            if (!Storage::disk('public')->exists($target_location)) {
                $target_location = public_path($target_location);
                File::makeDirectory($target_location, 0777, true, true);
            }
            $path = $target_location;
            $target_file =  $path.basename($file_title);
            $file_path = $_FILES['match_schedule_pdf']['tmp_name'];
            move_uploaded_file($file_path,$target_file);
        }

        $event = Event::create($input);
        $updateEvent = Event::getIdWiseData($event->id);
        $updateEvent['sort_order'] = $event->id;
        $updateEvent->update();
        flash('Event has been added!')->success();
        return \Redirect::route('event.edit', array($event->id));

    }

    public function editEvent($id)
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        $event = Event::getIdWiseData($id);
        $eventType = EventType::eventTypeDropDown();

        return view('admin.event.edit')
                        ->with('languages', $languages)
                        ->with('eventType', $eventType)
                        ->with('event',$event);
    }

    public function downloadMatchSchedule($id){
        $event = Event::getIdWiseData($id);
        $filePath = public_path("event/pdf/".$event->match_schedule_pdf);
        $headers = ['Content-Type: application/pdf'];
        $fileName = $event->match_schedule_pdf;

        return response()->download($filePath, $fileName, $headers);
    }

    public function updateEvent($id, EventFormRequest $request)
    {
        $event = Event::getIdWiseData($id);
        $input = $request->all();
        if ($input['start_date']) {
            $input['month'] = date("F", strtotime($input['start_date']));
        }

        if ($request->hasFile('event_image')) {
            File::delete(public_path().'/event/'.$event->event_image);
            File::delete(public_path().'/event/mid/'.$event->event_image);
            File::delete(public_path().'/event/thumb/'.$event->event_image);
            $image_name = $request->input('event_name');
            $fileName = ImgUploader::UploadImage('event', $request->file('event_image'), $image_name, 0, 0);
            $input['event_image'] = $fileName;
        }

        if ($request->file('match_schedule_pdf') != '') {
            $target_location = 'event/pdf/';
            $slug = str_replace(' ', '-', $input['event_name']);
            $slug = str_replace("/\s+/", "-", $slug);
            $slug = str_replace(".", "-", $slug);
            $slug = strtolower($slug);
            \Illuminate\Support\Facades\File::delete(public_path().'/'.$target_location.$event->match_schedule_pdf);
            $avatar = $request->file('match_schedule_pdf');
            $file_title = $slug.'-'.time().'.'.$avatar->getClientOriginalExtension();
            $input['match_schedule_pdf'] = $file_title;
            if (!Storage::disk('public')->exists($target_location)) {
                $target_location = public_path($target_location);
                File::makeDirectory($target_location, 0777, true, true);
            }
            $path = $target_location;
            $target_file =  $path.basename($file_title);
            $file_path = $_FILES['match_schedule_pdf']['tmp_name'];
            move_uploaded_file($file_path,$target_file);
        }

        $event->update($input);
        flash('Event has been updated!')->success();
        return \Redirect::route('event.edit', array($event->id));
    }

    public function deleteEvent(Request $request)
    {
        $id = $request->input('id');
        try {
            $club = Event::findOrFail($id);
            $club->delete();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeActiveEvent(Request $request)
    {
        $id = $request->input('id');
        try {
            $event = Event::findOrFail($id);
            $event->is_active = 1;
            $event->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Approved'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveEvent(Request $request)
    {
        $id = $request->input('id');
        try {
            $event = Event::findOrFail($id);
            $event->is_active = 0;
            $event->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Not Approved'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function sortEvents()
    {
        return view('admin.event.sort');
    }

    public function eventSortData(Request $request)
    {
        $events = Event::orderBy('sort_order')->get();
        $str = '<ul id="sortable">';
        if ($events != null) {
            foreach ($events as $event) {
                $str .= '<li id="' . $event->id . '"><i class="fa fa-sort"></i>' . $event->event_name . '</li>';
            }
        }
        echo $str . '</ul>';
    }

    public function eventSortUpdate(Request $request)
    {
        $eventOrder = $request->input('eventOrder');
        $eventOrderArray = explode(',', $eventOrder);
        $count = 1;
        foreach ($eventOrderArray as $event_id) {
            $event = Event::find($event_id);
            $event->sort_order = $count;
            $event->update();
            $count++;
        }
    }

    public function getEventName(){
        $id = $_GET['eventId'];
        $event = Event::select('event_name')->find($id);
        return $event;
    }

}
