<?php

namespace Modules\PhotoGallery\Http\Controllers;

use App\Models\Archive;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\PhotoGallery\Entities\PhotoGallery;
use ImgUploader;
use File;
use Modules\PhotoGallery\Entities\PhotoGalleryImage;
use Yajra\DataTables\DataTables;
use App\Helpers\ImageUploadingHelper;
use Illuminate\Support\Facades\Auth;

class PhotoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('photogallery::index');
    }

    public function fetchGalleriesData(Request $request)
    {
        $photoGalleries = PhotoGallery::select([
            'photo_galleries.id',
            'photo_galleries.name',
            'photo_galleries.cover_image',
            'photo_galleries.is_active',
        ])->whereNotNull('photo_galleries.name');

        return Datatables::of($photoGalleries)
            ->addColumn('cover_image', function ($row) {
                if ($row->cover_image) {
                    return '<img src="' . asset("photo_gallery/thumb/{$row->cover_image}") . '" alt="" class="text-center">';
                }
                return '';
            })
            ->addColumn('no_of_image', function ($row) {
                return PhotoGalleryImage::where('photo_gallery_id', $row->id)->count();
            })
            ->addColumn('status', function ($row) {
                return $row->is_active == 1 ? __('messages.Approved') : __('messages.NotApproved');
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
//                if (auth()->user()->is_approval_user === 1) {
                    $approval_btn = '
                            <li>
                                <a class="' . $active_class . '" href="javascript:void(0);" onClick="' . $active_href . '" id="onclick_active_' . $row->id . '">
                                    <i class="fas fa-check-square"></i>' . $active_txt . '
                                </a>
                            </li>';
//                }
                return '
                <div class="btn-group">
                    <button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">' . $action . '
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="' . route('edit.gallery', ['id' => $row->id]) . '">
                                <i class="fa fa-pencil" aria-hidden="true"></i> ' . $edit . '
                            </a>
                        </li>
                        ' . $approval_btn . '
                        <li>
                            <a href="' . route('delete.gallery', ['id' => $row->id]) . '">
                                <i class="fa fa-trash" aria-hidden="true"></i> ' . $delete . '
                            </a>
                        </li>
                    </ul>
                </div>';
            })
            ->rawColumns(['cover_image', 'no_of_image', 'action'])
            ->setRowId(function ($row) {
                return 'faq_dt_row_' . $row->id;
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        PhotoGallery::where('is_active',0)->where('name',null)->where('cover_image',null)->delete();

        $photoGallery= new PhotoGallery();
        $photoGallery->is_active=0;
        $photoGallery->save();
        $photoGallery->sort_order = $photoGallery->id;
        $photoGallery->update();
        return \Redirect::route('edit.gallery', array($photoGallery->id));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('photogallery::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $photoGallery = PhotoGallery::findOrFail($id);

        $photoYear = [];
        for ($year=1985;$year<=3000;$year++){
            $photoYear[$year] = $year;
        }

        return view('photogallery::edit',['photoGallery'=>$photoGallery,'photoYear'=>$photoYear]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'year' => 'required',
        ]);

        $photoGallery = PhotoGallery::findOrFail($id);
        $name = $request->input('name');
        $year = $request->input('year');
        $description = $request->input('description');
        $photoGallery->name=$name;
        $photoGallery->year=$year;
        $photoGallery->description=$description;
//        $photoGallery->is_active=0;

        if ($request->hasFile('cover_image')) {
            File::delete(public_path().'/photo_gallery/'.$photoGallery->cover_image);
            File::delete(public_path().'/photo_gallery/mid/'.$photoGallery->cover_image);
            File::delete(public_path().'/photo_gallery/thumb/'.$photoGallery->cover_image);
            $fileName = ImgUploader::UploadImage('photo_gallery', $request->file('cover_image'), $name, 1920, 700);
            $photoGallery->cover_image = $fileName;
        }

        $photoGallery->save();
        flash('Gallery has been updated.')->success();
        return \Redirect::route('list.gallery');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function storePhotoGalleryImage(Request $request){
        $id=$request->input('id');
        $photoGallery = PhotoGallery::findOrFail($id);

        if($request->TotalFiles > 0) {
            for ($x = 0; $x < $request->TotalFiles; $x++) {
                if ($request->hasFile('files'.$x)) {
                    $file      = $request->file('files'.$x);
                    $photoGalleryImage= new PhotoGalleryImage();
                    $photoGalleryImage->caption=$request->input('caption');

                    if ($file) {
                        $fileName = ImageUploadingHelper::UploadImage('photo_gallery', $file, $request->input('caption').$x, 1280, 850);
                        $photoGalleryImage->gallery_image = $fileName;
                    }

                    $photoGalleryImageUpdate = $photoGallery->photoGalleryImages()->save($photoGalleryImage);
                    $photoGalleryImageUpdate->sort_order = $photoGalleryImageUpdate->id;
                    $photoGalleryImageUpdate->update();
                }
            }
        }
        $returnHTML = view('photogallery::partial/photo_gallery_images',['photoGallery'=>$photoGallery])->render();
        return response()->json( ['html'=>$returnHTML]);
    }

    public function deletePhotoGalleryImage($id){
        $photoGalleryImage = PhotoGalleryImage::find($id);
        File::delete(public_path().'/photo_gallery/'.$photoGalleryImage->gallery_image);
        File::delete(public_path().'/photo_gallery/mid/'.$photoGalleryImage->gallery_image);
        File::delete(public_path().'/photo_gallery/thumb/'.$photoGalleryImage->gallery_image);
        $photoGalleryImage->delete();
        return new JsonResponse(array('status'=>'200','message'=>'Record deleted successfully'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroy($id)
    {
        $photoGallery = PhotoGallery::find($id);
        $photoGallery->delete();
        flash('Gallery has been deleted.')->success();
        return \Redirect::route('list.gallery');
    }

    public function makeActiveGallery(Request $request)
    {
        $id = $request->input('id');
        try {
            $archive = PhotoGallery::findOrFail($id);
            $archive->is_active = 1;
            $archive->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Approved'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveGallery(Request $request)
    {
        $id = $request->input('id');
        try {
            $archive = PhotoGallery::findOrFail($id);
            $archive->is_active = 0;
            $archive->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Not Approved'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }


    public function sortGallery(Request $request){
        if ($request->ajax()){
            $gallerys = PhotoGallery::orderBy('sort_order')->where('is_active',1)->get();
            $str = '<ul id="sortable">';
            if ($gallerys != null) {
                foreach ($gallerys as $gallery) {
                    $str .= '<li id="' . $gallery->id . '"><i class="fa fa-sort"></i>' . $gallery->name . ' (<b><span><a href="'.route('sort_photo',$gallery->id).'">Sort Photo</a></span></b>) </li>';
                }
            }
            return $str . '</ul>';
        }
        return view('photogallery::sort-gallery');
    }

    public function gallerySortUpdate(Request $request){
        $galleryOrder = $request->input('faqOrder');
        $galleryOrderArray = explode(',', $galleryOrder);
        $count = 1;
        foreach ($galleryOrderArray as $galleryID) {
            $gallery = PhotoGallery::find($galleryID);
            $gallery->sort_order = $count;
            $gallery->update();
            $count++;
        }
    }


    public function sortPhoto(Request $request,$id){
        if ($request->ajax()){
            $photos = PhotoGalleryImage::orderBy('sort_order')->where('photo_gallery_id',$id)->where('is_active',1)->get();
            $str = '<ul id="sortable">';
            if ($photos != null) {
                foreach ($photos as $photo) {
                    $str .= '<li id="' . $photo->id . '"><i class="fa fa-sort"></i>' . $photo->caption .'</li>';
                }
            }
            return $str . '</ul>';
        }
        return view('photogallery::sort-photo');
    }

    public function photoSortUpdate(Request $request){
        $galleryOrder = $request->input('faqOrder');
        $galleryOrderArray = explode(',', $galleryOrder);
        $count = 1;
        foreach ($galleryOrderArray as $galleryID) {
            $gallery = PhotoGalleryImage::find($galleryID);
            $gallery->sort_order = $count;
            $gallery->update();
            $count++;
        }
    }
}
