<?php

namespace App\Http\Controllers\Admin;

use App\Models\Archive;
use Auth;
use Illuminate\Http\JsonResponse;
use Input;
use Carbon\Carbon;
use Redirect;
use App\Cms;
use App\CmsContent;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Language;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;
use App\Http\Requests\CmsContentFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use ImgUploader;


class CmsContentController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCmsContent(Request $request)
    {
        if ($request->ajax()) {
            DB::statement(DB::raw('set @rownum=0'));
            $data = Cms::join('cms_content','cms.id','=','cms_content.page_id')->select([
                DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'cms.page_slug',
                'cms_content.page_title',
                'cms_content.page_sub_title',
                'cms.id',
                'cms.show_in_top_menu',
                'cms.show_in_footer_menu',
                'cms.is_active',
            ]);
            return \Yajra\DataTables\DataTables::of($data)
                ->filter(function ($query) use ($request) {
                    if ($request->has('page_title') && !empty($request->page_title)) {
                        $query->where(function ($q) use ($request) {
                            $q->where('cms_content.page_title', 'like', "%{$request->get('page_title')}%");
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
							<a href="' . route('edit.cmsContent', ['id' => $row->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>	
                        
                        <li>
                        <a class="' . $active_class . '" href="javascript:void(0);" onClick="' . $active_href . '" id="onclick_active_' . $row->id . '"><i class="fas fa-check-square"></i>' . $active_txt . '</a>
                        </li>		
                        
                        <li>
                            <a href="javascript:void(0);" onclick="delete_cmsContent(' . $row->id . ');" class=""><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                        </li>																																				
					</ul>
				</div>';
                })
                ->rawColumns(['action','status','pdf'])
                ->setRowId(function($data) {
                    return 'dt_row_' . $data->id;
                })
                ->make(true);
        }
        return view('admin.cms_content.index');
    }

    public function createCmsContent()
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        $cmsPages = cms::select('cms.id', 'cms.page_slug')->orderBy('cms.page_slug')->pluck('cms.page_slug', 'cms.id')->toArray();
        return view('admin.cms_content.add')
                        ->with('languages', $languages)
                        ->with('cmsPages', $cmsPages);
    }

    public function storeCmsContent(CmsContentFormRequest $request)
    {
        $slug = Str::slug($request->input('page_title'));
        $slugExists = Cms::where('page_slug',$slug)->exists();
        $input = $request->all();

        if (!$slugExists) {
            $input['page_slug'] = $slug;

            $cms = new Cms();
            $cms->page_slug = $slug;
            $cms->seo_title = $request->input('page_title');
            $cms->seo_description = $request->input('page_title');
            $cms->seo_keywords = $request->input('page_title');
            $cms->seo_other = $request->input('page_title');
            $cms->show_in_top_menu = $request->input('show_in_top_menu');
            $cms->show_in_footer_menu = $request->input('show_in_footer_menu');

            $cms->save();

            $cmsContent = new CmsContent();
            if ($request->hasFile('image')) {
                $image_name = $request->input('page_title');
                $fileName = ImgUploader::UploadImage('page_image', $request->file('image'), $image_name, 270, 270);
                $cmsContent->image = $fileName;
            }
            $cmsContent->page_id = $cms->id;
            $cmsContent->page_title = $request->input('page_title');
            $cmsContent->page_sub_title = $request->input('page_sub_title');
            $cmsContent->page_content = $request->input('page_content');
//            $cmsContent->lang = $request->input('lang');
            $cmsContent->save();

            $cms->sort_order = $cms->id;
            $cms->save();

            flash('Page has been added!')->success();
            return \Redirect::route('edit.cmsContent', array($cmsContent->page_id));
        }else{
            flash('Page slug already exists')->success();
            return redirect()->back()->withInput($input);
        }
    }

    public function editCmsContent($id)
    {
        $cms = Cms::findOrFail($id);
        $cmsContent = CmsContent::where('page_id',$id)->first();

        return view('admin.cms_content.edit', compact('cmsContent','cms'));
    }

    public function updateCmsContent($id, CmsContentFormRequest $request)
    {
        $cms = Cms::findorfail($id);
        $cms->show_in_top_menu = $request->input('show_in_top_menu');
        $cms->show_in_footer_menu = $request->input('show_in_footer_menu');
        $cms->seo_title = $request->input('page_title');
        $cms->seo_description = $request->input('page_title');
        $cms->seo_keywords = $request->input('page_title');
        $cms->update();

        $cmsContent = CmsContent::where('page_id',$id)->first();
        if ($request->hasFile('image')) {
            \Illuminate\Support\Facades\File::delete(public_path().'/page_image/'.$cmsContent->image);
            \Illuminate\Support\Facades\File::delete(public_path().'/page_image/thumb/'.$cmsContent->image);
            \Illuminate\Support\Facades\File::delete(public_path().'/page_image/mid/'.$cmsContent->image);
            $image_name = $request->input('page_title');
            $fileName = ImgUploader::UploadImage('page_image', $request->file('image'), $image_name, 270, 270);
            $cmsContent->image = $fileName;
        }
        $cmsContent->page_title = $request->input('page_title');
        $cmsContent->page_sub_title = $request->input('page_sub_title');
        $cmsContent->page_content = $request->input('page_content');
        $cmsContent->update();
        flash('Page has been updated')->success();
        return \Redirect::route('edit.cmsContent', array($id));
    }

    public function deleteCmsContent(Request $request)
    {
        $id = $request->input('id');
        try {
            $cms = Cms::findOrFail($id);
            $cmsContent = CmsContent::where('page_id',$cms->id);
            $cmsContent->delete();
            $cms->delete();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function fetchCmsContentData(Request $request)
    {
        $cmsContent = CmsContent::select(
                        [
                            'cms_content.id',
                            'cms_content.page_title',
                            'cms_content.page_id',
                            'cms_content.page_content',
                            'cms_content.lang',
                            'cms_content.created_at',
                            'cms_content.updated_at'
                        ]
        );
        return Datatables::of($cmsContent)
                        ->filter(function ($query) use ($request) {
                            if ($request->has('id') && !empty($request->id)) {
                                $query->where('cms_content.id', 'like', "{$request->get('id')}");
                            }
                            if ($request->has('page_title') && !empty($request->page_title)) {
                                $query->where('cms_content.page_title', 'like', "%{$request->get('page_title')}%");
                            }
                        })
                        ->addColumn('page_title', function ($cmsContent) {
                            $page_title = Str::limit($cmsContent->page_title, 100, '...');
                            $direction = MiscHelper::getLangDirection($cmsContent->lang);
                            return '<span dir="' . $direction . '">' . $page_title . '</span>';
                        })
                        ->addColumn('page_content', function ($cmsContent) {
                            $page_content = Str::limit($cmsContent->page_content, 100, '...');
                            $direction = MiscHelper::getLangDirection($cmsContent->lang);
                            return '<span dir="' . $direction . '">' . $page_content . '</span>';
                        })
                        ->addColumn('action', function ($cmsContent) {
                            /*                             * ************************* */
                            return '
				<div class="btn-group">
					<button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('edit.cmsContent', ['id' => $cmsContent->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>						
						<li>
							<a href="javascript:void(0);" onclick="delete_cmsContent(' . $cmsContent->id . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
						</li>																																							
					</ul>
				</div>';
                        })
                        ->rawColumns(['page_title', 'page_content', 'action'])
                        ->setRowId(function($cmsContent) {
                            return 'cmsContent_dt_row_' . $cmsContent->id;
                        })
                        ->make(true);
    }


    public function makeActiveCms(Request $request)
    {
        $id = $request->input('id');
        try {
            $archive = Cms::findOrFail($id);
            $archive->is_active = 1;
            $archive->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Active'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveCms(Request $request)
    {
        $id = $request->input('id');
        try {
            $archive = Cms::findOrFail($id);
            $archive->is_active = 0;
            $archive->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Inactive'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

}
