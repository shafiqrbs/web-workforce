<?php

namespace App\Http\Controllers\Admin;

use App\SocailMedia;
use Auth;
use DB;
use Input;
use File;
use Carbon\Carbon;
use ImgUploader;
use Redirect;
use App\Gender;
use App\Language;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;
use App\Http\Requests\GenderFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class HearAboutUsController extends Controller
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

    public function indexHearAboutUs()
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        return view('admin.hear_about_us.index')->with('languages', $languages);
    }

    public function createHearAboutUs()
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        $genders = DataArrayHelper::defaultGendersArray();
        return view('admin.hear_about_us.add')
                        ->with('languages', $languages)
                        ->with('genders', $genders);
    }

    public function storeHearAboutUs(Request $request)
    {
        $socialMedia = new SocailMedia();
        $socialMedia->name = $request->input('name');
        $socialMedia->is_active = $request->input('is_active');
        $socialMedia->lang = $request->input('lang');
        $socialMedia->is_default = $request->input('is_default');
        $socialMedia->save();
        /*         * ************************************ */
        $socialMedia->sort_order = $socialMedia->id;
        if ((int) $request->input('is_default') == 1) {
            $socialMedia->social_id = $socialMedia->id;
        } else {
            $socialMedia->social_id = $request->input('social_id');
        }
        $socialMedia->update();
        flash('Hear About us has been added!')->success();
        return \Redirect::route('edit.hearUs', array($socialMedia->id));
    }

    public function editHearAboutUs($id)
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        $genders = DataArrayHelper::defaultGendersArray();
        $gender = SocailMedia::findOrFail($id);
        return view('admin.hear_about_us.edit')
                        ->with('languages', $languages)
                        ->with('gender', $gender)
                        ->with('genders', $genders);
    }

    public function updateHearAboutUs($id, Request $request)
    {
        $socialMedia = SocailMedia::findOrFail($id);
        $socialMedia->name = $request->input('name');
        $socialMedia->is_active = $request->input('is_active');
        $socialMedia->lang = $request->input('lang');
        $socialMedia->is_default = $request->input('is_default');
        if ((int) $request->input('is_default') == 1) {
            $socialMedia->social_id = $socialMedia->id;
        } else {
            $socialMedia->social_id = $request->input('social_id');
        }
        $socialMedia->update();
        flash('Hear About us has been updated!')->success();
        return \Redirect::route('edit.hearUs', array($socialMedia->id));
    }

    public function deleteHearAboutUs(Request $request)
    {
        $id = $request->input('id');
        try {
            $socialMedia = SocailMedia::findOrFail($id);
            if ((bool) $socialMedia->is_default) {
                SocailMedia::where('social_id', '=', $socialMedia->social_id)->delete();
            } else {
                $socialMedia->delete();
            }
            return 'ok';
        } catch (ModelNotFoundException $e) {
            return 'notok';
        }
    }

    public function fetchHearAboutUsData(Request $request)
    {
        $socialMedia = SocailMedia::select(['social_media.id', 'social_media.name', 'social_media.is_active', 'social_media.lang', 'social_media.is_default', 'social_media.created_at', 'social_media.updated_at'])->sorted();
        return Datatables::of($socialMedia)
                        ->filter(function ($query) use ($request) {
                            if ($request->has('name') && !empty($request->name)) {
                                $query->where('social_media.name', 'like', "%{$request->get('name')}%");
                            }
                            if ($request->has('lang') && !empty($request->get('lang'))) {
                                $query->where('social_media.lang', 'like', "%{$request->get('lang')}%");
                            }
                            if ($request->has('is_active') && $request->get('is_active') != -1) {
                                $query->where('social_media.is_active', '=', "{$request->get('is_active')}");
                            }
                        })
                        ->addColumn('name', function ($socialMedia) {
                            $name = Str::limit($socialMedia->name, 100, '...');
                            $direction = MiscHelper::getLangDirection($socialMedia->lang);
                            return '<span dir="' . $direction . '">' . $name . '</span>';
                        })
                        ->addColumn('action', function ($socialMedia) {
                            /*                             * ************************* */
                            $activeTxt = 'Make Active';
                            $activeHref = 'makeActive(' . $socialMedia->id . ');';
                            $activeIcon = 'square-o';
                            if ((int) $socialMedia->is_active == 1) {
                                $activeTxt = 'Make InActive';
                                $activeHref = 'makeNotActive(' . $socialMedia->id . ');';
                                $activeIcon = 'check-square-o';
                            }
                            return '
				<div class="btn-group">
					<button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
						<i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="' . route('edit.hearUs', ['id' => $socialMedia->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
						</li>						
						<li>
							<a href="javascript:void(0);" onclick="deleteHearUs(' . $socialMedia->id . ', ' . $socialMedia->is_default . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
						</li>
						<li>
						<a href="javascript:void(0);" onClick="' . $activeHref . '" id="onclickActive' . $socialMedia->id . '"><i class="fa fa-' . $activeIcon . '" aria-hidden="true"></i>' . $activeTxt . '</a>
						</li>																																		
					</ul>
				</div>';
                        })
                        ->rawColumns(['name', 'action'])
                        ->setRowId(function($socialMedia) {
                            return 'genderDtRow' . $socialMedia->id;
                        })
                        ->make(true);
        //$query = $dataTable->getQuery()->get();
        //return $query;
    }

    public function makeActiveHearAboutUs(Request $request)
    {
        $id = $request->input('id');
        try {
            $socailMedia = SocailMedia::findOrFail($id);
            $socailMedia->is_active = 1;
            $socailMedia->update();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveGender(Request $request)
    {
        $id = $request->input('id');
        try {
            $socailMedia = SocailMedia::findOrFail($id);
            $socailMedia->is_active = 0;
            $socailMedia->update();
            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function sortHearAboutUs()
    {
        $languages = DataArrayHelper::languagesNativeCodeArray();
        return view('admin.hear_about_us.sort')->with('languages', $languages);
    }

    public function hearAboutUsSortData(Request $request)
    {
        $lang = $request->input('lang');
        $socialMedia = SocailMedia::select('social_media.id', 'social_media.name', 'social_media.sort_order')
                ->where('social_media.lang', 'like', $lang)
                ->orderBy('social_media.sort_order')
                ->get();
        $str = '<ul id="sortable">';
        if ($socialMedia != null) {
            foreach ($socialMedia as $socialMedias) {
                $str .= '<li id="' . $socialMedias->id . '"><i class="fa fa-sort"></i>' . $socialMedias->name . '</li>';
            }
        }
        echo $str . '</ul>';
    }

    public function hearAboutUsSortUpdate(Request $request)
    {
        $genderOrder = $request->input('genderOrder');
        $genderOrderArray = explode(',', $genderOrder);
        $count = 1;
        foreach ($genderOrderArray as $genderId) {
            $gender = SocailMedia::find($genderId);
            $gender->sort_order = $count;
            $gender->update();
            $count++;
        }
    }

}
