<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Banner;
use App\Models\Event;
use App\Models\EventType;
use App\Models\NewsAndNotice;
use App\Seo;
use App\Cms;
use App\CmsContent;
use Illuminate\Http\Request;

class CmsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPage($slug)
    {
        $cms = Cms::where('page_slug', 'like', $slug)->first();
        if (null === $cmsContent = CmsContent::getContentByPageId($cms->id)) {
            echo 'No Content';
            exit;
        }

        $seo = (object) array(
                    'seo_title' => $cms->seo_title,
                    'seo_description' => $cms->seo_description,
                    'seo_keywords' => $cms->seo_keywords,
                    'seo_other' => $cms->seo_other
        );

        $bannerData = Banner::getPageWiseBannerInfo($slug);

        return view('cms.cms_page')
                        ->with('cmsContent', $cmsContent)
                        ->with('cms', $cms)
                        ->with('bannerData', $bannerData)
                        ->with('seo', $seo);
    }

    public function cmsEvent(){
        $pageTitle = ' Events';
        $getTopEvent = Event::getTopEvent();
        $getAllEvent = Event::getAllEventExceptTop('');
        //$getAllEvent = Event::getAllEventExceptTop($getTopEvent->id);
        $bannerData = Banner::getPageWiseBannerInfo('event');
//        dump($getAllEvent->toArray());
        return view('cms.event.index', compact(['pageTitle','getTopEvent','getAllEvent','bannerData']));
    }

    public function cmsEventDetails($id){
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

        return view('cms.event.details', compact(['pageTitle','eventDetails','relatedEvents','popularNews','archives','popularNotices','eventType']));
    }

}
