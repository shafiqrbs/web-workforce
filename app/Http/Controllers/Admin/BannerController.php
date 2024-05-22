<?php

namespace App\Http\Controllers\Admin;

use App\Cms;
use App\Models\Archive;
use App\Models\Athlete;
use App\Models\Banner;
use App\Models\Event;
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
use App\Http\Requests\BannerFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use ImgUploader;
use File;

class BannerController extends Controller
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
    public function indexBanner(Request $request)
    {
        if ($request->ajax()) {
            \Illuminate\Support\Facades\DB::statement(DB::raw('set @rownum=0'));
            $data = Banner::select([
                \Illuminate\Support\Facades\DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'id','banner_title','page_slug','banner_image','is_active'
            ]);
            return Datatables::of($data)
                ->filter(function ($query) use ($request) {
                    if ($request->has('banner_title') && !empty($request->banner_title)) {
                        $query->where(function ($q) use ($request) {
                            $q->where('banner_title', 'like', "%{$request->get('banner_title')}%");
                        });
                    }
                    if ($request->has('page_slug') && !empty($request->page_slug)) {
                        $query->where('page_slug', 'like', "%{$request->get('page_slug')}%");
                    }
                })

                ->addColumn('page_slug', function($row){
                    $result = preg_replace('/[-]+/', ' ', trim($row->page_slug));
//                    return $row->page_slug.' ('.ucwords($result).')';
                    return ucwords($result);
                })

                ->addColumn('status', function($row){
                    if ($row->is_active == 1){
                        $status = 'Active';
                    }else{
                        $status = 'Inactive';
                    }
                    return $status;
                })

                ->addColumn('banner_image', function($row){
                    $banner_image='';
                    if($row->banner_image){
                        $banner_image.='<img src="'.asset("banner/thumb/{$row->banner_image}").'" alt="" width="200px" height="100px">';
                    }
                    return $banner_image;
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
							<a href="' . route('banner.edit', ['id' => $row->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>
                        <li>
                        <a class="' . $active_class . '" href="javascript:void(0);" onClick="' . $active_href . '" id="onclick_active_' . $row->id . '"><i class="fas fa-check-square"></i>' . $active_txt . '</a>
                        </li>		
                        <li>
                            <a href="javascript:void(0);" onclick="delete_archive(' . $row->id . ');" class=""><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                        </li>																																				
					</ul>
				</div>';
                })
                ->rawColumns(['action','status','banner_image'])
                ->setRowId(function($data) {
                    return 'dt_row_' . $data->id;
                })
                ->make(true);
        }
        return view('admin.banner.index');
    }

    public function createBanner()
    {
        $slug = Banner::getBannerSlug();

        return view('admin.banner.add',['slug'=>$slug]);
    }

    public function storeBanner(BannerFormRequest $request)
    {
        $input = $request->all();

        if ($request->hasFile('banner_image')) {
            $image_name = $request->input('page_slug');
            $fileName = ImgUploader::UploadImage('banner', $request->file('banner_image'), $image_name,  1920, 730);
            $input['banner_image'] = $fileName;
        }

        $banner = Banner::create($input);
        $updateBanner = Banner::find($banner->id);
        $updateBanner['sort_order'] = $banner->id;
        $updateBanner->update();
        flash('Banner has been added')->success();
        return \Redirect::route('banner.edit', array($banner->id));
    }

    public function editBanner($id)
    {
        $slug = Banner::getBannerSlug();
        $banner = Banner::find($id);

        return view('admin.banner.edit',['banner'=>$banner,'slug'=>$slug]);
    }


    public function updateBanner($id, BannerFormRequest $request)
    {
        $banner = Banner::find($id);
        $input = $request->all();

        if ($request->hasFile('banner_image')) {
            \Illuminate\Support\Facades\File::delete(public_path().'/banner/'.$banner->banner_image);
            \Illuminate\Support\Facades\File::delete(public_path().'/banner/mid/'.$banner->banner_image);
            \Illuminate\Support\Facades\File::delete(public_path().'/banner/thumb/'.$banner->banner_image);
            $image_name = $request->input('page_slug');
            $fileName = ImgUploader::UploadImage('banner', $request->file('banner_image'), $image_name,1920,730);
            $input['banner_image'] = $fileName;
        }

        $banner->update($input);
        flash('Page banner has been updated')->success();
        return \Redirect::route('banner.edit', array($banner->id));
    }

    public function deleteBanner(Request $request)
    {
        $id = $request->input('id');
        try {
            $banner = Banner::findOrFail($id);
            \Illuminate\Support\Facades\File::delete(public_path().'/banner/'.$banner->banner_image);
            \Illuminate\Support\Facades\File::delete(public_path().'/banner/mid/'.$banner->banner_image);
            \Illuminate\Support\Facades\File::delete(public_path().'/banner/thumb/'.$banner->banner_image);
            $banner->delete();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeActiveBanner(Request $request)
    {
        $id = $request->input('id');
        try {
            $banner = Banner::findOrFail($id);
            $banner->is_active = 1;
            $banner->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Active'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveBanner(Request $request)
    {
        $id = $request->input('id');
        try {
            $banner = Banner::findOrFail($id);
            $banner->is_active = 0;
            $banner->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Inactive'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }


}
