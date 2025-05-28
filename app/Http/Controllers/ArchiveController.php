<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\ArchiveAttachment;
use App\Models\Athlete;
use App\Models\Banner;
use App\Models\Event;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function ArchiveIndex(){
        $pageTitle = __('messages.Archives');
        $archives = Archive::getAllArchive();
        $keyword = '';
        $pathPageTitle = '';
        $bannerData = Banner::getPageWiseBannerInfo('archive');
        return view('archive.index', compact(['pageTitle','archives','keyword','pathPageTitle','bannerData']));
    }


    public function ProgramsIndex(){
        $pageTitle = __('messages.Archives');
        $archives = Archive::getLatestArchive('programs');
        $keyword = '';
        $pathPageTitle = '';
        $bannerData = Banner::getPageWiseBannerInfo('archive');
        return view('archive.index', compact(['pageTitle','archives','keyword','pathPageTitle','bannerData']));
    }

    public function ArchiveSearch(Request $request){
        $keyword = $request->query('keyword');
        $date = $request->query('date');
        $archives = Archive::getDataBySearch($keyword);
        $pageTitle = __('messages.Archives');
        $pathPageTitle = __('messages.Search');
        $bannerData = Banner::getPageWiseBannerInfo('archive');

        return view('archive.index', compact(['pageTitle','archives','keyword','pathPageTitle','bannerData']));
    }


    public function ArchiveDownloadUser($id){
        $archive = Archive::getIdWiseData($id);
        $filePath = public_path("archive/pdf/".$archive->archive_pdf);
        $headers = ['Content-Type: application/pdf'];
        $fileName = $archive->archive_pdf;

        return response()->download($filePath, $fileName, $headers);
    }

    public function ArchiveMultipleAttachment(){
        $archiveID = $_GET['archiveID'];
        $attachment = ArchiveAttachment::where('archive_id',$archiveID)->get();
        $response['status'] = 'error';
        if (count($attachment)>0){
            $response['status'] = 'ok';
            $view = \Illuminate\Support\Facades\View::make('archive.more_attachment',compact('attachment'));
            $contents = $view->render();
            $response['content'] = $contents;
        }
        return $response;
    }

    public function ArchiveMultipleAttachmentDownload($id){
        $archive = ArchiveAttachment::find($id);
        $filePath = public_path("archive/pdf/".$archive->attachment);
        $headers = ['Content-Type: application/pdf'];
        $fileName = $archive->archive_pdf;

        return response()->download($filePath, $fileName, $headers);
    }
}
