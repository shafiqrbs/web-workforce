<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\UserVideo;
use Auth;
use DB;
use Input;
use Redirect;
use App\Language;
use App\Testimonial;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;
use App\Http\Requests\TestimonialFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class UserVideoController extends Controller
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

    public function profileVideos()
    {
        return view('admin.user_video.index');
    }
    public function fetchUserVideosData(Request $request)
    {
        $userVideos = UserVideo::select(
            [
                'user_videos.id',
                'user_videos.user_id',
                'user_videos.title',
                'user_videos.description',
                'user_videos.video',
                'user_videos.status',

                'user_videos.created_at',
            ]);
        return Datatables::of($userVideos)
            ->filter(function ($query) use ($request) {
                if ($request->has('id') && !empty($request->id)) {
                    $query->where('user_videos.id', 'like', "{$request->get('id')}");
                }

                if ($request->has('videoStatus') && !empty($request->videoStatus)) {

                    $query->where('user_videos.status', '=', "{$request->get('videoStatus')}");
                }

            })
            ->addColumn('created_at', function ($userVideos) {
                return $userVideos->created_at->format('d M Y');
            })
            ->addColumn('user_id', function ($userVideos) {
                $userId= $userVideos->user_id;
                if($userId){
                    $user = User::find($userId);
                    return $user?$user->email:'';
                }
                return '';
            })
            ->addColumn('video', function ($userVideos) {
                return '<video controls controlsList="nodownload" width="300" height="150px" id="vid" src="/uploads/video/'.$userVideos->video.'"></video>';
            })
            ->addColumn('status', function ($userVideos) {
                if ($userVideos->status == 'notapproved') {
                    return 'Not Approved';
                }elseif ($userVideos->status == 'created') {
                    return 'Uploaded';
                } else {
                    return ucfirst(str_replace('_', ' ', $userVideos->status));
                }
            })
            ->addColumn('action', function ($userVideos) {
                return '
                                <div class="btn-group">
                                    <button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                        <button onclick="approveVideo(' . $userVideos->id . ');" class="btn btn-success btn-sm"><i class="fa check-square-o" aria-hidden="true"></i>Approve</button>
                                        </li>
                                        <li>
                                        <button onclick="declineVideo(' . $userVideos->id . ');" class="btn btn-primary btn-sm"><i class="fa square-o" aria-hidden="true"></i>Not Approve</button>
                                        </li>
                                        <li>
                                        <button onclick="deleteVideo(' . $userVideos->id . ');" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</button>
                                        </li>
                                     </ul>
                                </div>';
            })

            ->rawColumns(['action', 'video'])
            ->setRowId(function($userVideos) {
                return 'user_dt_row_' . $userVideos->id;
            })
            ->make(true);
    }

}
