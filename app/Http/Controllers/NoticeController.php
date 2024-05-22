<?php

namespace App\Http\Controllers;

use App\Helpers\DataArrayHelper;
use App\Models\Archive;
use App\Models\Banner;
use App\Models\CommitteeMember;
use App\Models\NewsAndNotice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{

    public function index(){
        $pageTitle = "Notices";
        $newsAndNotice= NewsAndNotice::getAllNewsByType('NOTICE');
        $bannerData = Banner::getPageWiseBannerInfo('notices');
        return view('news_notice.notice.index')
            ->with('pageTitle', $pageTitle)
            ->with('bannerData', $bannerData)
            ->with('notices', $newsAndNotice);
    }


    public function noticeDetails($id){
        $news = NewsAndNotice::getDataBYId($id);
        $popularNews = NewsAndNotice::getPopularNews($id,'NEWS');
        $popularNotices = NewsAndNotice::getPopularNews($id,'NOTICE');
        $archives = Archive::getRamdomArchive();
        return view('news_notice.notice.details',
            [
                'news'=>$news,
                'popularNews'=>$popularNews,
                'archives'=>$archives,
                'popularNotices'=>$popularNotices
            ]);
    }
}
