<?php

namespace App\Http\Controllers;

use App\Helpers\DataArrayHelper;
use App\Http\Controllers\Controller;
use App\Models\Archive;
use App\Models\Banner;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Auth;
use Image;
use Modules\PhotoGallery\Entities\PhotoGallery;

class PhotoGalleryController extends Controller
{

    public function index()
    {
        $pageTitle = 'Gallery';
        $keyword = '';
        $pathPageTitle = '';
        $bannerData = Banner::getPageWiseBannerInfo('gallery');
        $photoYear = PhotoGallery::select('year')->groupBy('year')->orderBy('year','DESC')->paginate(9);
        $galleries = PhotoGallery::where('is_active',1)->orderBy('sort_order')->paginate(9);

//        dd($photoYear,$galleries);

        return view('gallery/photo/index',[
            'galleries'=>$galleries,
            'pageTitle'=>$pageTitle,
            'bannerData'=>$bannerData,
            'photoYear'=>$photoYear,
        ]);
    }

    public function indexYear($year){
        $pageTitle = 'Gallery';
        $keyword = '';
        $pathPageTitle = '';
        $bannerData = Banner::getPageWiseBannerInfo('gallery');
        $galleries = PhotoGallery::where('is_active',1)->where('year',$year)->orderBy('sort_order')->paginate(9);

        return view('gallery/photo/index-year',[
            'galleries'=>$galleries,
            'pageTitle'=>$pageTitle,
            'bannerData'=>$bannerData,
            'year'=>$year,
        ]);
    }

    public function galleryDetails($id){
        $pageTitle = 'Gallery';
        $keyword = '';
        $pathPageTitle = '';
        $gallery = PhotoGallery::with('photoGalleryImages')->find($id);

//        dd($gallery->photoGalleryImages);
        return view('gallery/photo/details',[
            'gallery'=>$gallery,
            'pageTitle'=>$pageTitle,
        ]);
    }

}