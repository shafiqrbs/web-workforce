<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsAndNoticeCategory;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Auth;
use Image;

class NewsAndNoticeCategoryController extends Controller
{

    public function index()
    {
        $categories = NewsAndNoticeCategory::get();
        return view('admin/news_notice_category/index', compact('categories'));
    }


    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ], [
            'title.required' => ' The title field is required.',
        ]);
        $blog_category = new NewsAndNoticeCategory();
        $page_slug = $request->slug;
        $blog_category->title = $request->title;
        $blog_category->save();
        if ($blog_category->save() == true) {
            $request->session()->flash('message.added', 'success');
            $request->session()->flash('message.content', 'Category added successfully !');
        } else {
            $request->session()->flash('message.added', 'danger');
            $request->session()->flash('message.content', 'Error!');
        }
        return \Redirect::route('list.news.notice.category');

    }
    public function get_news_notice_category_by_id($id = '')
    {
        if ($id != '') {
            $row = NewsAndNoticeCategory::findOrFail($id);
            $json_data = json_encode($row);
            echo $json_data;
            return;
        }
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'title_update' => 'required',
        ], [
            'title_update.required' => ' The title field is required.',
        ]);
        $blog_category = NewsAndNoticeCategory::findOrFail($request->id);
        $blog_category->title = $request->title_update;
        $blog_category->update();
        if ($blog_category->save() == true) {
            $request->session()->flash('message.updated', 'success');
            $request->session()->flash('message.content', 'Category updated successfully!');
        } else {
            $request->session()->flash('message.updated', 'danger');
            $request->session()->flash('message.content', 'Error!');
        }
        return \Redirect::route('list.news.notice.category');
    }

    public function destroy($id)
    {
        $blog_category = NewsAndNoticeCategory::findOrFail($id);
        $blog_category->delete();

        return response()->json($blog_category);
    }
}