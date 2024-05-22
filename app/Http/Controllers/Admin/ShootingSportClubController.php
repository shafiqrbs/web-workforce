<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ClubFormRequest;
use App\Models\Archive;
use App\Models\Athlete;
use App\Models\ShootingSportClub;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Input;
use Carbon\Carbon;
use Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Language;
use App\Http\Requests\FaqFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use ImgUploader;
use File;

class ShootingSportClubController extends Controller
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
    public function indexClubs()
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        return view('admin.club.index')->with('languages', $languages);
    }

    public function createClub()
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        $cities = [];
        $divisions=DataArrayHelper::langDivisionsArray();
        $cities = DB::table('cities')
            ->where('is_active',1)
            ->orderby('sort_order','asc')
            #->where('division_id',$club->division_id)
            ->pluck('city','id')
            ->all();

        $clubTypes=['GENERAL'=>'General','SERVICE'=>'Service'];
        $status=[1=>'Active',0=>'Inactive'];

        return view('admin.club.add')
            ->with('languages', $languages)
            ->with('clubTypes', $clubTypes)
            ->with('divisions', $divisions)
            ->with('status', $status)
            ->with('cities',$cities);
    }

    public function findDistrict(){
        $divisionID = $_GET['divisionID'];
        $response = [];
        $response['district'] = DB::table('cities')
                            ->where('is_active',1)
                            ->orderby('sort_order','asc')
                            ->where('division_id',$divisionID)
                            ->pluck('city','id')
                            ->all();
        if ($response['district']){
            $response['status'] = 200;
        }else{
            $response['status'] = 401;
        }
        return $response;
    }

    public function storeClub(ClubFormRequest $request)
    {
        $club = new ShootingSportClub();

        if ($request->hasFile('club_logo')) {
            $destinationPath = public_path('/club/thumb');
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $destinationPath = public_path('/club/mid');
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $image_name = $request->input('name');
            $fileName = ImgUploader::UploadImage('club', $request->file('club_logo'), $image_name, 270, 270);
            $club->club_logo = $fileName;
        }
        if (app()->getLocale() == 'bn'){
            $club->name_bn = $request->input('name');
            $club->registration_number_bn = $request->input('registration_number');
            $club->mobile_bn = $request->input('mobile');
            $club->address_bn = $request->input('address');
            $club->short_name_bn = $request->input('short_name');
            $club->about_club_bn = $request->input('about_club');
        }else{
            $club->name_en = $request->input('name');
            $club->registration_number_en = $request->input('registration_number');
            $club->mobile_en = $request->input('mobile');
            $club->address_en = $request->input('address');
            $club->short_name_en = $request->input('short_name');
            $club->about_club_en = $request->input('about_club');
        }
        $club->email = $request->input('email');
        $club->club_type = $request->input('club_type');
        $club->district_id = $request->input('district_id');
        $club->division_id = $request->input('division_id');
        $club->is_active = 1;
        $club->save();
        /*         * ************************************ */
        $club->sort_order = $club->id;
        $club->update();
        flash(__('messages.Club_has_been_added'))->success();
        return \Redirect::route('edit.club', array($club->id));
    }

    public function editClub($id)
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();

        $club = ShootingSportClub::getClubDataByID($id);

        $cities = DB::table('cities')
            ->where('is_active',1)
            ->orderby('sort_order','asc')
            #->where('division_id',$club->division_id)
            ->pluck('city','id')
            ->all();


        $clubTypes=['GENERAL'=>'General','SERVICE'=>'Service'];

        $divisions=DataArrayHelper::langDivisionsArray();
        $status=[1=>'Active',0=>'Inactive'];

        return view('admin.club.edit')
                        ->with('languages', $languages)
                        ->with('cities',$cities)
                        ->with('divisions',$divisions)
                        ->with('status',$status)
                        ->with('clubTypes',$clubTypes)
                        ->with('club', $club);
    }

    public function updateClub($id, ClubFormRequest $request)
    {
        $club = ShootingSportClub::findOrFail($id);
        if ($request->hasFile('club_logo')) {
            $destinationPath = public_path('/club/thumb');
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $destinationPath = public_path('/club/mid');
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            \Illuminate\Support\Facades\File::delete(public_path().'/club/'.$club->image);
            \Illuminate\Support\Facades\File::delete(public_path().'/club/mid/'.$club->image);
            \Illuminate\Support\Facades\File::delete(public_path().'/club/thumb/'.$club->image);

            $image_name = $request->input('name');
            $fileName = ImgUploader::UploadImage('club', $request->file('club_logo'), $image_name, 270, 270);
            $club->club_logo = $fileName;
        }
        if (app()->getLocale() == 'bn'){
            $club->name_bn = $request->input('name');
            $club->registration_number_bn = $request->input('registration_number');
            $club->mobile_bn = $request->input('mobile');
            $club->address_bn = $request->input('address');
            $club->short_name_bn = $request->input('short_name');
            $club->about_club_bn = $request->input('about_club');
        }else{
            $club->name_en = $request->input('name');
            $club->registration_number_en = $request->input('registration_number');
            $club->mobile_en = $request->input('mobile');
            $club->address_en = $request->input('address');
            $club->short_name_en = $request->input('short_name');
            $club->about_club_en = $request->input('about_club');
        }

        $club->email = $request->input('email');
        $club->club_type = $request->input('club_type');
        $club->district_id = $request->input('district_id');
        $club->division_id = $request->input('division_id');
        $club->update();
        flash(__('messages.Club_has_been_updated'))->success();
        return \Redirect::route('edit.club', array($club->id));
    }

    public function deleteClub(Request $request)
    {
        $id = $request->input('id');
        try {
            $club = ShootingSportClub::findOrFail($id);
            \Illuminate\Support\Facades\File::delete(public_path().'/club/'.$club->image);
            \Illuminate\Support\Facades\File::delete(public_path().'/club/mid/'.$club->image);
            \Illuminate\Support\Facades\File::delete(public_path().'/club/thumb/'.$club->image);
            $club->delete();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function fetchClubsData(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        if (app()->getLocale() == 'bn'){
            $clubs = ShootingSportClub::select(
                [
                    DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                    'shooting_sport_clubs.id',
                    'shooting_sport_clubs.name_bn as name',
                    'shooting_sport_clubs.registration_number_bn as registration_number',
                    'shooting_sport_clubs.mobile_bn as mobile',
                    'shooting_sport_clubs.lang',
                    'shooting_sport_clubs.created_at',
                    'shooting_sport_clubs.updated_at',
                    'shooting_sport_clubs.is_active',
                    'cities.city',
                    'division.division',
                ]
            );
        }else{
            $clubs = ShootingSportClub::select(
                [
                    DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                    'shooting_sport_clubs.id',
                    'shooting_sport_clubs.name_en as name',
                    'shooting_sport_clubs.registration_number_en as registration_number',
                    'shooting_sport_clubs.mobile_en as mobile',
                    'shooting_sport_clubs.lang',
                    'shooting_sport_clubs.created_at',
                    'shooting_sport_clubs.updated_at',
                    'shooting_sport_clubs.is_active',
                    'cities.city',
                    'division.division',
                ]
            );
        }

        $clubs->join('cities','cities.id','=','shooting_sport_clubs.district_id')
            ->join('division','division.id','=','shooting_sport_clubs.division_id');

        return Datatables::of($clubs)
                        ->filter(function ($query) use ($request) {
                            if ($request->has('name') && !empty($request->name)) {
                                if (app()->getLocale() == 'bn'){
                                    $query->where('shooting_sport_clubs.name_bn', 'like', "%{$request->get('name')}%");
                                }else{
                                    $query->where('shooting_sport_clubs.name_en', 'like', "%{$request->get('name')}%");
                                }
                            }

                            if ($request->has('mobile') && !empty($request->mobile)) {
                                if (app()->getLocale() == 'bn'){
                                    $query->where('shooting_sport_clubs.mobile_bn', 'like', "%{$request->get('mobile')}%");
                                }else{
                                    $query->where('shooting_sport_clubs.mobile_en', 'like', "%{$request->get('mobile')}%");
                                }
                            }

                        })
                        ->addColumn('status', function ($clubs){
                            if ($clubs->is_active == 1){
                                $status = __('messages.Active');
                            }else{
                                $status = __('messages.Inactive');
                            }
                            return $status;
                        })
                        ->addColumn('action', function ($clubs) {
                            $active_class = '';
                            $action = __('messages.Actions');
                            $edit = __('messages.Edit');
                            $delete = __('messages.Delete');
                            if ((int)$clubs->is_active == 1) {
                                $active_txt = __('messages.Inactive');
                                $active_href = 'make_not_active(' . $clubs->id . ');';
                                $active_icon = 'square-o';
                            } else {
                                $active_txt = __('messages.Active');
                                $active_href = 'make_active(' . $clubs->id . ');';
                                $active_icon = 'check-square';
                            }
                            return '
				<div class="btn-group">
					<button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">'.$action.'
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('edit.club', ['id' => $clubs->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>'.$edit.'</a>
						</li>	
						
						<li>
                        <a class="' . $active_class . '" href="javascript:void(0);" onClick="' . $active_href . '" id="onclick_active_' . $clubs->id . '"><i class="fas fa-check-square"></i>' . $active_txt . '</a>
                        </li>	
                        					
						<li>
							<a href="javascript:void(0);" onclick="delete_faq(' . $clubs->id . ');" class=""><i class="fa fa-trash" aria-hidden="true"></i>'.$delete.'</a>
						</li>																																							
					</ul>
				</div>';
                        })
                        ->rawColumns(['action','status'])
                        ->setRowId(function($clubs) {
                            return 'faq_dt_row_' . $clubs->id;
                        })
                        ->make(true);
    }

    public function sortClubs()
    {
        return view('admin.club.sort');
    }

    public function clubSortData(Request $request)
    {
        $clubs = ShootingSportClub::where('is_active',1)->orderBy('sort_order');
        if (app()->getLocale() == 'bn'){
            $clubs->select([
                'id',
                'name_bn as name',
                'sort_order',
            ]);
        }else{
            $clubs->select([
                'id',
                'name_en as name',
                'sort_order',
            ]);
        }
        $clubs = $clubs->get();

        $str = '<ul id="sortable">';
        if ($clubs != null) {
            foreach ($clubs as $club) {
                $str .= '<li id="' . $club->id . '"><i class="fa fa-sort"></i>' . $club->name . '</li>';
            }
        }
        echo $str . '</ul>';
    }

    public function clubSortUpdate(Request $request)
    {
        $clubOrder = $request->input('faqOrder');
        $clubOrderArray = explode(',', $clubOrder);
        $count = 1;
        foreach ($clubOrderArray as $club_id) {
            $club = ShootingSportClub::find($club_id);
            $club->sort_order = $count;
            $club->update();
            $count++;
        }
    }

    public function makeActiveClub(Request $request)
    {
        $id = $request->input('id');
        try {
            $archive = ShootingSportClub::findOrFail($id);
            $archive->is_active = 1;
            $archive->update();
            return new JsonResponse(array('status'=>'ok','value'=>__('messages.Active')));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveClub(Request $request)
    {
        $id = $request->input('id');
        try {
            $archive = ShootingSportClub::findOrFail($id);
            $archive->is_active = 0;
            $archive->update();
            return new JsonResponse(array('status'=>'ok','value'=>__('messages.Inactive')));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

}
