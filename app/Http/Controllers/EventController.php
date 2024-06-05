<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Athlete;
use App\Models\Banner;
use App\Models\Event;
use App\Models\EventType;
use App\Models\NewsAndNotice;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function eventIndex(){
        $pageTitle = ' Events';
        $getTopEvent = Event::getTopEvent();
        $getAllEvent = Event::getAllEventExceptTop($getTopEvent->id);
        $bannerData = Banner::getPageWiseBannerInfo('event');

        return view('event.index', compact(['pageTitle','getTopEvent','getAllEvent','bannerData']));
    }

    public function eventDetails($id){
        $pageTitle = ' Events';
        $eventDetails = Event::find($id);
        if (isset($eventDetails->event_type_id)){
            $eventType = EventType::find($eventDetails->event_type_id);
        }
        $relatedEvents = Event::getRelatedEventExceptTop($id);
        $popularNews = NewsAndNotice::getPopularNews($id,'NEWS');
        $popularNotices = NewsAndNotice::getPopularNews($id,'NOTICE');
        $archives = Archive::getRamdomArchive();

//        dd($popularNews,$popularNotices,$archives);

        return view('event.details', compact(['pageTitle','eventDetails','relatedEvents','popularNews','archives','popularNotices','eventType']));
    }

    public function eventCalender(){
        $pageTitle = ' Events';
        $years = [];
        for ($i=2023;$i<=2030;$i++){
            $years[$i] = $i;
        }
        $year = date('Y');
        $eventTypes = EventType::where('is_active',1)->select('id','event_type')->get();
        $eventType = [];
        foreach ($eventTypes as $type){
            $eventType[]=$type->id;
        }

        $eventData = Event::getCalanderEvent($year,$eventType);
        $allMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July','August', 'September', 'October', 'November','December'];
        return view('event.calender_list', compact(['pageTitle','allMonths','eventData','years','year','eventTypes']));
    }

    public function eventCalenderFilter(){
        $year = $_GET['year'];
        $eventType = explode(',',$_GET['eventType']);
        $eventData = Event::getCalanderEvent($year,$eventType);
        $allMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July','August', 'September', 'October', 'November','December'];
        /*if (count($eventData)>0){
            $response['status'] = 'ok';
            $view = \Illuminate\Support\Facades\View::make('event.calender_filter',compact('eventData','allMonths'));
            $contents = $view->render();
            $response['content'] = $contents;
        }else{
            $response['status'] = 'ok';
        }*/

        $response['status'] = 'ok';
        $view = \Illuminate\Support\Facades\View::make('event.calender_filter',compact('eventData','allMonths'));
        $contents = $view->render();
        $response['content'] = $contents;
        $response['year'] = $year;

        return $response;
    }

    public function downloadMatchScheduleFront($id){
        $event = Event::getIdWiseData($id);
        if ($event->match_schedule_pdf){
            if (file_exists(public_path("event/pdf/".$event->match_schedule_pdf))) {
                $filePath = public_path("event/pdf/".$event->match_schedule_pdf);
                $headers = ['Content-Type: application/pdf'];
                $fileName = $event->match_schedule_pdf;

                return response()->download($filePath, $fileName, $headers);
            }else{
                return redirect()->back()->with('fileNotFound','File missing');
            }
        }else{
            return redirect()->back()->with('fileNotFound','File missing');
        }
    }
}
