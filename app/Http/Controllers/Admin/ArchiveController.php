<?php

namespace App\Http\Controllers\Admin;

use App\Models\Archive;
use App\Models\ArchiveAttachment;
use App\Models\Athlete;
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
use App\Http\Requests\ArchiveFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use ImgUploader;
use File;

class ArchiveController extends Controller
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
    public function indexArchive(Request $request)
    {
        if ($request->ajax()) {
            \Illuminate\Support\Facades\DB::statement(DB::raw('set @rownum=0'));
            if (app()->getLocale() == 'bn'){
                $data = Archive::select([
                    DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                    'archive_name_bn as archive_name','sub_title_bn as sub_title','archive_pdf','id','is_active'
                ])->orderby('sort_order','desc');
            }else{
                $data = Archive::select([
                    DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                    'archive_name_en as archive_name','sub_title_en as sub_title','archive_pdf','id','is_active'
                ])->orderby('sort_order','desc');
            }

            return Datatables::of($data)
                ->filter(function ($query) use ($request) {
                    if (app()->getLocale() == 'bn'){
                        if ($request->has('name') && !empty($request->name)) {
                            $query->where(function ($q) use ($request) {
                                $q->where('archive_name_bn', 'like', "%{$request->get('name')}%");
                            });
                        }
                        if ($request->has('sub_title') && !empty($request->sub_title)) {
                            $query->where('sub_title_bn', 'like', "%{$request->get('sub_title')}%");
                        }
                    }else{
                        if ($request->has('name') && !empty($request->name)) {
                            $query->where(function ($q) use ($request) {
                                $q->where('archive_name_en', 'like', "%{$request->get('name')}%");
                            });
                        }
                        if ($request->has('sub_title') && !empty($request->sub_title)) {
                            $query->where('sub_title_en', 'like', "%{$request->get('sub_title')}%");
                        }
                    }
                })
                ->addColumn('status', function($row){
                    if ($row->is_active == 1){
                        $status = __('messages.Active');
                    }else{
                        $status = __('messages.Inactive');
                    }
                    return $status;
                })

                ->addColumn('pdf', function($row){
                    if ($row->archive_pdf){
                        return '
                        <a href="' . route('archive.download', ['id' => $row->id]) . '">
                        <i class="fas fa-cloud-download"></i>&nbsp;'.$row->archive_pdf.'</a>
                        ';
                    }
                })

                ->addColumn('action', function ($row) {
                    $active_class = '';
                    $action = __('messages.Actions');
                    $edit = __('messages.Edit');
                    $delete = __('messages.Delete');

                    if ((int)$row->is_active == 1) {
                        $active_txt = __('messages.Inactive');
                        $active_href = 'make_not_active(' . $row->id . ');';
                        $active_icon = 'square-o';
                    } else {
                        $active_txt = __('messages.Active');
                        $active_href = 'make_active(' . $row->id . ');';
                        $active_icon = 'check-square';
                    }
                    return '
				<div class="btn-group">
					<button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">'.$action.'
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('archive.edit', ['id' => $row->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>'.$edit.'</a>
						</li>						
                        
                        <li>
                        <a class="' . $active_class . '" href="javascript:void(0);" onClick="' . $active_href . '" id="onclick_active_' . $row->id . '"><i class="fas fa-check-square"></i>' . $active_txt . '</a>
                        </li>	
                        <li>
                            <a href="javascript:void(0);" onclick="delete_archive(' . $row->id . ');" class=""><i class="fa fa-trash" aria-hidden="true"></i>'.$delete.'</a>
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
        return view('admin.archive.index');
    }

    public function createArchive()
    {
        return view('admin.archive.add');
    }

    public function storeArchive(ArchiveFormRequest $request)
    {
        $input = $request->all();
//        dd($input);
        if ($request->file('archive_pdf') != '') {
            $target_location = 'archive/pdf/';
            $slug = str_replace(' ', '-', $input['archive_name']);
            $slug = str_replace("/\s+/", "-", $slug);
            $slug = str_replace(".", "-", $slug);
            $slug = strtolower($slug);

            $avatar = $request->file('archive_pdf');
            $file_title = $slug.'-'.time().'.'.$avatar->getClientOriginalExtension();
            $input['archive_pdf'] = $file_title;
            if (!Storage::disk('public')->exists($target_location)) {
                $target_location = public_path($target_location);
                File::makeDirectory($target_location, 0777, true, true);
            }
            $path = $target_location;
            $target_file =  $path.basename($file_title);
            $file_path = $_FILES['archive_pdf']['tmp_name'];
            move_uploaded_file($file_path,$target_file);
        }
        if (app()->getLocale() == 'bn'){
            $input['archive_name_bn'] = $input['archive_name'];
            $input['sub_title_bn'] = $input['sub_title'];
        }else{
            $input['archive_name_en'] = $input['archive_name'];
            $input['sub_title_en'] = $input['sub_title'];
        }
        unset($input['archive_name'],$input['sub_title']);


        $archive = Archive::create($input);
        $updateArchive = Archive::getIdWiseData($archive->id);
        $updateArchive['sort_order'] = $archive->id;
        $updateArchive->update();

        if ($request->file('file') != '') {
            foreach($request->file('file') as $index => $value) {
                $slug = str_replace(' ', '-', $input['caption'][$index]);
                $slug = str_replace("/\s+/", "-", $slug);
                $slug = str_replace(".", "-", $slug);
                $slug = strtolower($slug);

                $avatar = $request->file('file')[$index];
                $file_title = $slug.'-'.time().'.'.$avatar->getClientOriginalExtension();
                $attachment['attachment'] = $file_title;
                $path = public_path("archive/pdf/");
                $target_file =  $path.basename($file_title);
                $file_path = $_FILES['file']['tmp_name'][$index];
                move_uploaded_file($file_path,$target_file);

                $attachment['archive_id'] = $archive->id;
                $attachment['caption'] = $input['caption'][$index];
                ArchiveAttachment::create($attachment);
            }
        }

        flash(__('messages.Archive_has_been_added'))->success();
        return \Redirect::route('archive.edit', array($archive->id));
    }

    public function editArchive($id)
    {
        $archive = Archive::getIdWiseData($id);
        $moreAttachment = ArchiveAttachment::where('archive_id',$id)->get()->toArray();
        return view('admin.archive.edit')->with('archive',$archive)->with('moreAttachment',$moreAttachment);
    }

    public function archiveMultipleAttachmentDelete($id){
        $attachment =ArchiveAttachment::find($id);
        $archiveID = $attachment->archive_id;
        $target_location = 'archive/pdf/';
        \Illuminate\Support\Facades\File::delete(public_path().'/'.$target_location.$attachment->attachment);
        $attachment->delete();
        return redirect()->route('archive.edit',$archiveID);
    }

    public function downloadArchive($id){
        $archive = Archive::getIdWiseData($id);
        $filePath = public_path("archive/pdf/".$archive->archive_pdf);
        $headers = ['Content-Type: application/pdf'];
        $fileName = $archive->archive_pdf;

        return response()->download($filePath, $fileName, $headers);
    }

    public function downloadArchiveMultiple($id){
        $archive = ArchiveAttachment::find($id);
        $filePath = public_path("archive/pdf/".$archive->attachment);
        $headers = ['Content-Type: application/pdf'];
        $fileName = $archive->caption;
        return response()->download($filePath, $fileName, $headers);
    }

    public function updateArchive($id, ArchiveFormRequest $request)
    {
        $archive = Archive::getIdWiseData($id);
        $input = $request->all();

        if ($request->file('archive_pdf') != '') {
            $target_location = 'archive/pdf/';
            $slug = str_replace(' ', '-', $input['archive_name']);
            $slug = str_replace("/\s+/", "-", $slug);
            $slug = str_replace(".", "-", $slug);
            $slug = strtolower($slug);
//            $slug = substr($slug, 0, 10);
            \Illuminate\Support\Facades\File::delete(public_path().'/'.$target_location.$archive->archive_pdf);
            $avatar = $request->file('archive_pdf');
            $file_title = $slug.'-'.time().'.'.$avatar->getClientOriginalExtension();
            $input['archive_pdf'] = $file_title;
            if (!Storage::disk('public')->exists($target_location)) {
                $target_location = public_path($target_location);
                File::makeDirectory($target_location, 0777, true, true);
            }
            $path = $target_location;
            $target_file =  $path.basename($file_title);
            $file_path = $_FILES['archive_pdf']['tmp_name'];
            move_uploaded_file($file_path,$target_file);
        }

        if (app()->getLocale() == 'bn'){
            $input['archive_name_bn'] = $input['archive_name'];
            $input['sub_title_bn'] = $input['sub_title'];
        }else{
            $input['archive_name_en'] = $input['archive_name'];
            $input['sub_title_en'] = $input['sub_title'];
        }
        unset($input['archive_name'],$input['sub_title']);

        $archive->update($input);

        if ($request->file('file') != '') {
            foreach($request->file('file') as $index => $value) {
                $slug = str_replace(' ', '-', $input['caption'][$index]);
                $slug = str_replace("/\s+/", "-", $slug);
                $slug = str_replace(".", "-", $slug);
                $slug = strtolower($slug);

                $avatar = $request->file('file')[$index];
                $file_title = $slug.'-'.time().'.'.$avatar->getClientOriginalExtension();

                $attachment['attachment'] = $file_title;
                $path = public_path("archive/pdf/");
                $target_file =  $path.basename($file_title);
                $file_path = $_FILES['file']['tmp_name'][$index];
                move_uploaded_file($file_path,$target_file);

                $attachment['archive_id'] = $archive->id;
                $attachment['caption'] = $input['caption'][$index];
                ArchiveAttachment::create($attachment);
            }
        }
        flash(__('messages.Archive_has_been_updated'))->success();
        return \Redirect::route('archive.edit', array($archive->id));
    }

    public function deleteArchive(Request $request)
    {
        $id = $request->input('id');
        try {
            $archive = Archive::findOrFail($id);
            $archive->delete();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeActiveArchive(Request $request)
    {
        $id = $request->input('id');
        try {
            $archive = Archive::findOrFail($id);
            $archive->is_active = 1;
            $archive->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Active'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveArchive(Request $request)
    {
        $id = $request->input('id');
        try {
            $archive = Archive::findOrFail($id);
            $archive->is_active = 0;
            $archive->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Inactive'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function sortArchive()
    {
        return view('admin.archive.sort');
    }

    public function archiveSortData(Request $request)
    {
        $archives = Archive::orderBy('sort_order')->get();
        $str = '<ul id="sortable">';
        if ($archives != null) {
            foreach ($archives as $archive) {
                $str .= '<li id="' . $archive->id . '"><i class="fa fa-sort"></i>' . $archive->archive_name_en . '</li>';
            }
        }
        echo $str . '</ul>';
    }

    public function archiveSortUpdate(Request $request)
    {
        $archiveOrder = $request->input('archiveOrder');
        $archiveOrderArray = explode(',', $archiveOrder);
        $count = 1;
        foreach ($archiveOrderArray as $archiveID) {
            $archive = Archive::find($archiveID);
            $archive->sort_order = $count;
            $archive->update();
            $count++;
        }
    }

    public function archiveMultipleAttachment(){
        $sl_no = $_GET['sl_no'];
        $view = \Illuminate\Support\Facades\View::make('admin.archive.more_attach',compact('sl_no'));
        $response['sl_no'] = $sl_no++;
        $contents = $view->render();
        $response['content'] = $contents;
        return $response;
    }

}
