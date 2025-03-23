<?php

namespace App\Http\Controllers\Admin;

use App\Blog_category;
use App\Helpers\DataArrayHelper;
use App\Http\Controllers\Controller;
use App\Models\Archive;
use App\Models\CommitteeMember;
use App\Models\NewsAndNotice;
use App\Models\NewsAndNoticeCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use Image;
use Yajra\DataTables\DataTables;
use ImgUploader;


class NewsAndNoticeController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            DB::statement(DB::raw('set @rownum=0'));
            $data = NewsAndNotice::
                orderBy('updated_at','desc')->select([
                    DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                    'title','content','post_type','id','is_active','updated_at'
                ]);
            return Datatables::of($data)
                ->filter(function ($query) use ($request) {
                    if ($request->has('title') && !empty($request->title)) {
                        $query->where(function ($q) use ($request) {
                            $q->where('title', 'like', "%{$request->get('title')}%");
                        });
                    }
                    if ($request->has('content') ) {
                        $query->where('content', 'like', "%{$request->get('content')}%");
                    }
                    if ($request->has('type') && !empty($request->type)) {
                        $query->where('post_type', $request->get('type'));
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

                ->addColumn('title', function($row){
                    if ($row->title){
                        $title = Str::words($row->title,5,'..');
                        return $title;
                    }
                })

                ->addColumn('content', function($row){
                    if ($row->content){
                        $content = Str::words($row->content,5,'..');
                        return $content;
                    }
                })

                ->addColumn('last_update', function($row){
                    if ($row->updated_at){
                        $lastTime =  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->updated_at)->diffForHumans();
                        return $lastTime;
                    }
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
							<a href="' . route('edit.news.notice', ['id' => $row->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>						
                        
                        <li>
                        <a class="' . $active_class . '" href="javascript:void(0);" onClick="' . $active_href . '" id="onclick_active_' . $row->id . '"><i class="fas fa-check-square"></i>' . $active_txt . '</a>
                        </li>
                        
                        <li>
                            <a href="javascript:void(0);" onclick="delete_news_notice(' . $row->id . ');" class=""><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                        </li>																																						
					</ul>
				</div>';
                })
                ->rawColumns(['content','action','status','pdf'])
                ->setRowId(function($data) {
                    return 'dt_row_' . $data->id;
                })
                ->make(true);
        }

        return view('admin/news_notice/index');
    }
    public function create()
    {
        $categories = NewsAndNoticeCategory::get();
      //  $executiveCommittee = CommitteeMember::getExecutiveCommitteeDropdown();
        return view('admin/news_notice/post_form',[
            'categories'=>$categories
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'title.required' => ' The title field is required.',
            'slug.required' => ' The slug field is required.',
            'content.required' => ' The content field is required.',
        ]);

        $image = $request->file('image');

        if ($request->hasFile('image')) {
            $destinationPath = public_path('/news_notice/thumb');
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $destinationPath = public_path('/news_notice/mid');
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $image_name = $request->input('title');
            $fileName = ImgUploader::UploadImage('news_notice', $request->file('image'), $image_name,  1920, 730);
            $input['imagename'] = $fileName;
        }


        $newsAndNotice = new NewsAndNotice();
        $newsAndNotice->title = $request->title;
        $newsAndNotice->content = $request->input('content');
        $newsAndNotice->member_id = $request->input('member_id');
        $newsAndNotice->post_type = $request->input('post_type');
        $newsAndNotice->is_sticky = $request->input('is_sticky')?$request->input('is_sticky'):0;
        $newsAndNotice->created_by= auth()->id();
        if ($image != '') {
            $newsAndNotice->image = $input['imagename'];
        } else {
            $newsAndNotice->image = '';
        }
        $newsAndNotice->save();

        if ($request->cate_id != '') {
            $newsAndNotice->categories()->attach($request->cate_id);
        }
        if ($newsAndNotice->save() == true) {
            $request->session()->flash('message.added', 'success');
            $request->session()->flash('message.content', 'News & Notice was successfully added!');
        } else {
            $request->session()->flash('message.added', 'danger');
            $request->session()->flash('message.content', 'Error!');
        }
        return redirect()->route('list.news.notice');
    }

    public function get_news_notice_by_id($id = '')
    {
        if ($id != '') {
            $row = NewsAndNotice::findOrFail($id);
            $json_data = json_encode($row);
            echo $json_data;
            return;
        }
    }
    public function edit($id = '')
    {
        if ($id != '') {
            $newsAndNotice = NewsAndNotice::findOrFail($id);
            $categories = NewsAndNoticeCategory::get();
            $executiveCommittee = CommitteeMember::getExecutiveCommitteeDropdown();
            return view('admin/news_notice/update_form', [
                'categories'=> $categories,
                'newsAndNotice'=> $newsAndNotice,
                'executiveCommittee'=>$executiveCommittee
                ]);
        }
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'title_update' => 'required',
            'content_update' => 'required',
            'imageupdate' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'title_update.required' => ' The title field is required.',
            'content_update.required' => ' The content field is required.',
        ]);

        if ($request->cate_id_update != '') {
            $category_Ids = implode(",", $request->cate_id_update);
        } else {
            $category_Ids = '';
        }

        $newsAndNotice = NewsAndNotice::findOrFail($request->id);
        $newsAndNotice->title = $request->title_update;
        $newsAndNotice->content = $request->content_update;
        $newsAndNotice->member_id = $request->member_id;
        $newsAndNotice->post_type = $request->post_type;
        $newsAndNotice->is_sticky = $request->input('is_sticky')?$request->input('is_sticky'):0;
        $newsAndNotice->update();
        $this->validate($request, [
            'imageupdate' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->file('imageupdate');

        if ($request->hasFile('imageupdate')) {
            \Illuminate\Support\Facades\File::delete(public_path().'/news_notice/'.$newsAndNotice->image);
            \Illuminate\Support\Facades\File::delete(public_path().'/news_notice/mid/'.$newsAndNotice->image);
            \Illuminate\Support\Facades\File::delete(public_path().'/news_notice/thumb/'.$newsAndNotice->image);

            $destinationPath = public_path('/news_notice/thumb');
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $destinationPath = public_path('/news_notice/mid');
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $image_name = $request->input('title_update');
            $fileName = ImgUploader::UploadImage('news_notice', $request->file('imageupdate'), $image_name,  1920, 730);
            $input['imageupdate'] = $fileName;
        }

        if ($image) {
            $newsAndNotice->image = $input['imageupdate'];
        }
        $newsAndNotice->update();

        if ($request->cate_id_update != '') {
            $newsAndNotice->categories()->sync($request->cate_id_update);
        }


        if ($newsAndNotice->save() == true) {
            $request->session()->flash('message.updated', 'success');
            $request->session()->flash('message.content', 'News & Notice was successfully updated!');
        } else {
            $request->session()->flash('message.updated', 'danger');
            $request->session()->flash('message.content', 'Error!');
        }

        return redirect()->route('list.news.notice');
    }


    public function destroy(Request $request)
    {
        $id = $request->input('id');
        try {
            $newsAndNotice = NewsAndNotice::findOrFail($id);
            $newsAndNotice->delete();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function remove_feature_image($id)
    {
        $image = NewsAndNotice::findOrFail($id);
        $file = $image->image;
        $sts = 'done';
        $imagename = '';
        $filenamethumb = public_path() . '/uploads/news_notice/thumbnail/' . $file;
        $filename = public_path() . '/uploads/news_notice/' . $file;
        \File::delete([
            $filename,
            $filenamethumb
        ]);
        $image->image = $imagename;
        $image->update();
        return response()->json($sts);
    }



    public function makeActiveNews(Request $request)
    {
        $id = $request->input('id');
        try {
            $archive = NewsAndNotice::findOrFail($id);
            $archive->is_active = 1;
            $archive->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Active'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveNews(Request $request)
    {
        $id = $request->input('id');
        try {
            $archive = NewsAndNotice::findOrFail($id);
            $archive->is_active = 0;
            $archive->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Inactive'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function sortNews()
    {
        return view('admin.news_notice.sort');
    }

    public function newsSortData(Request $request)
    {
        $news = NewsAndNotice::orderBy('sort_order')->get();
        $str = '<ul id="sortable">';
        if ($news != null) {
            foreach ($news as $value) {
                $str .= '<li id="' . $value->id . '"><i class="fa fa-sort"></i>' . $value->title . '</li>';
            }
        }
        echo $str . '</ul>';
    }

    public function newsSortUpdate(Request $request)
    {
        $archiveOrder = $request->input('archiveOrder');
        $archiveOrderArray = explode(',', $archiveOrder);
        $count = 1;
        foreach ($archiveOrderArray as $archiveID) {
            $archive = NewsAndNotice::find($archiveID);
            $archive->sort_order = $count;
            $archive->update();
            $count++;
        }
    }
}