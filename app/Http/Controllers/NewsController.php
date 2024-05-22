<?php

namespace App\Http\Controllers;

use App\Helpers\DataArrayHelper;
use App\Models\Archive;
use App\Models\Banner;
use App\Models\CommitteeMember;
use App\Models\NewsAndNotice;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index(){
        $pageTitle = "News";
        $newsAndNotice = NewsAndNotice::getAllNewsByType('NEWS');
        $bannerData = Banner::getPageWiseBannerInfo('news');

        return view('news_notice.news.index')
            ->with('pageTitle', $pageTitle)
            ->with('bannerData', $bannerData)
            ->with('news', $newsAndNotice);
    }

    public function newsDetails($id){
        $news = NewsAndNotice::getDataBYId($id);
        $popularNews = NewsAndNotice::getPopularNews($id,'NEWS');
        $popularNotices = NewsAndNotice::getPopularNews($id,'NOTICE');
        $bannerData = Banner::getPageWiseBannerInfo('news');

        $archives = Archive::getRamdomArchive();
        return view('news_notice.news.details',
            [
                'news'=>$news,
                'popularNews'=>$popularNews,
                'archives'=>$archives,
                'popularNotices'=>$popularNotices,
                'bannerData'=>$bannerData,
            ]);
    }
}
