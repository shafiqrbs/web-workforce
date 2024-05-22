<?php

namespace App\Http\Controllers\Admin;

use App\DeletedUser;
use App\Models\Archive;
use App\Models\Athlete;
use App\Models\AthleteCompetition;
use App\Models\Banner;
use App\Models\BloodGroup;
use App\Models\Profession;
use App\Models\ShootingSportClub;
use Dompdf\Dompdf;
use Dompdf\Options;
use File;
use Illuminate\Http\JsonResponse;
use ImgUploader;
use Auth;
use Input;
use Carbon\Carbon;
use Redirect;
use App\User;
use App\Gender;
use App\MaritalStatus;
use App\Country;
use App\State;
use App\City;
use App\JobExperience;
use App\CareerLevel;
use App\Industry;
use App\FunctionalArea;
use App\ProfileSummary;
use App\ProfileProject;
use App\ProfileExperience;
use App\ProfileEducation;
use App\ProfileSkill;
use App\ProfileLanguage;
use App\Package;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\ProfileProjectFormRequest;
use App\Http\Requests\ProfileProjectImageFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Traits\CommonUserFunctions;
use App\Traits\ProfileSummaryTrait;
use App\Traits\ProfileCvsTrait;
use App\Traits\ProfileProjectsTrait;
use App\Traits\ProfileExperienceTrait;
use App\Traits\ProfileEducationTrait;
use App\Traits\ProfileSkillTrait;
use App\Traits\ProfileLanguageTrait;
use App\Traits\Skills;
use App\Traits\JobSeekerPackageTrait;
use App\Helpers\DataArrayHelper;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    use CommonUserFunctions;
    use ProfileSummaryTrait;
    use ProfileCvsTrait;
    use ProfileProjectsTrait;
    use ProfileExperienceTrait;
    use ProfileEducationTrait;
    use ProfileSkillTrait;
    use ProfileLanguageTrait;
    use Skills;
    use JobSeekerPackageTrait;

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
    public function indexUsers(Request $request)
    {

        if ($request->ajax()){
            DB::statement(DB::raw('set @rownum=0'));
            $athleteUser = Athlete::select([
                DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'id',
                'athlete_name',
                'athlete_type',
                'mobile',
                'email',
                'is_active',
                'is_approved',
                'is_present',
            ])->orderBy('sort_order', 'ASC');

            return Datatables::of($athleteUser)
                ->filter(function ($query) use ($request) {
                    if ($request->has('name') && !empty($request->name)) {
                        $query->where(function ($q) use ($request) {
                            $q->where('athlete_name', 'like', "%{$request->get('name')}%");
                        });
                    }
                    if ($request->has('email') && !empty($request->email)) {
                        $query->where('email', 'like', "%{$request->get('email')}%");
                    }
                    if ($request->has('mobile') && !empty($request->mobile)) {
                        $query->where('mobile', 'like', "{$request->get('mobile')}%");
                    }
                    if ($request->has('athleteType') && !empty($request->athleteType)) {
                        $query->where('athlete_type', '=', $request->get('athleteType'));
                    }
                    if ($request->has('presentAthlete') && $request->presentAthlete !='') {
                        $query->where('is_present', '=', $request->get('presentAthlete'));
                    }
                })

                ->addColumn('athlete_type', function ($athleteUser) {
                    $status = '';
                    if ($athleteUser->athlete_type == 'Pistol') {
                        $status = 'Pistol';
                    }elseif ($athleteUser->athlete_type == 'Rifle'){
                        $status = 'Rifle';
                    }elseif ($athleteUser->athlete_type == 'Short'){
                        $status = 'Short Gun';
                    }else{
                        $status = 'Handicapped';
                    }
                    return $status;
                })

                ->addColumn('is_active', function ($athleteUser) {
                    $status = '';
                    if ($athleteUser->is_active == 1) {
                        $status = 'Active';
                    } else {
                        $status = 'Inactive';
                    }
                    return $status;
                })
                ->addColumn('is_approved', function ($athleteUser) {
                    $status = '';
                    if ($athleteUser->is_approved == 1) {
                        $status = 'Yes';
                    } else {
                        $status = 'No';
                    }
                    return $status;
                })
                ->addColumn('is_present', function ($athleteUser) {
                    $status = '';
                    if ($athleteUser->is_present == 1) {
                        $status = 'Yes, Present Athlete';
                    } else {
                        $status = 'No, Former Athlete';
                    }
                    return $status;
                })
                ->addColumn('action', function ($athleteUser) {
                    $active_txt = '';
                    $active_href = '';
                    $active_icon = '';
                    $active_class = '';
                    if ((int)$athleteUser->is_active == 1) {
                        $active_txt = 'Inactive';
                        $active_href = 'make_not_active(' . $athleteUser->id . ');';
                        $active_icon = 'square-o';
                    } else {
                        $active_txt = 'Active';
                        $active_href = 'make_active(' . $athleteUser->id . ');';
                        $active_icon = 'check-square';
                    }


                    if ((int)$athleteUser->is_approved == 1) {
                        $approve_txt = 'Hold';
                        $approve_href = 'make_not_approve(' . $athleteUser->id . ');';
                    } else {
                        $approve_txt = 'Approved';
                        $approve_href = 'make_approve(' . $athleteUser->id . ');';
                    }

                    if ((int)$athleteUser->is_present == 1) {
                        $former_txt = 'Make Former';
                        $former_href = 'make_former(' . $athleteUser->id . ');';
                    } else {
                        $former_txt = 'Make Present';
                        $former_href = 'make_present(' . $athleteUser->id . ');';
                    }


                    return '
                    <div class="btn-group">
                        <button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu" style="left: -8px !important;margin-top: 6px !important;">
                        
                            <li>
                            <a href="' . route('edit_athlete_user', ['id' => $athleteUser->id]) . '"><i class="fa fa-edit" aria-hidden="true"></i>Edit</a>
                            </li>
                        
                            <li>
                            <a href="' . route('admin.view.athlete.profile', ['id' => $athleteUser->id]) . '"><i class="fa fa-eye" aria-hidden="true"></i>View</a>
                            </li>
                            
                            <li>
                            <a class="' . $active_class . '" href="javascript:void(0);" onClick="' . $former_href . '" id="onclick_former_' . $athleteUser->id . '"><i class="fas fa-check-square"></i>' . $former_txt . '</a>
                            </li>
                            
                            <li>
                            <a class="' . $active_class . '" href="javascript:void(0);" onClick="' . $active_href . '" id="onclick_active_' . $athleteUser->id . '"><i class="fas fa-check-square"></i>' . $active_txt . '</a>
                            </li>
                            
                            
                            <li>
                            <a class="' . $active_class . '" href="javascript:void(0);" onClick="' . $approve_href . '" id="onclick_approve_' . $athleteUser->id . '"><i class="fas fa-check-square"></i>' . $approve_txt . '</a>
                            </li>
                            
                            
                            <li>
                            <a href="javascript:void(0);" onclick="delete_user(' . $athleteUser->id . ');" class=""><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                            </li>
                            
                         </ul>
                    </div>';
                })
                ->rawColumns(['action'])
                ->setRowId(function ($athleteUser) {
                    return 'user_dt_row_' . $athleteUser->id;
                })
                ->make(true);
        }

        return view('admin.user.index');
    }

    public function viewAthleteProfile($id){
//        dd($id);
        $athleteUser = Athlete::with('athleteCompetition')
                                ->leftJoin('shooting_sport_clubs','shooting_sport_clubs.id','=','athlete_users.club_id')
                                ->leftJoin('genders','genders.id','=','athlete_users.gender_id')
                                ->leftJoin('cities','cities.id','=','athlete_users.district_id');
        if (app()->getLocale() == 'bn'){
            $athleteUser = $athleteUser->select([
                'athlete_users.*',
                'shooting_sport_clubs.name_bn as clubName',
                'shooting_sport_clubs.short_name_bn as clubShortName',
                'cities.city as districtName',
                'genders.gender',
            ]);
        }else{
            $athleteUser = $athleteUser->select([
                'athlete_users.*',
                'shooting_sport_clubs.name_en as clubName',
                'shooting_sport_clubs.short_name_en as clubShortName',
                'cities.city as districtName',
                'genders.gender',
            ]);
        }


        $athleteUser=$athleteUser ->find($id);
//        dd($athleteUser);
        $gender = Gender::find($athleteUser->gender_id);
        $bloodGroup = [];
        if (isset($athleteUser->blood_group_id) && !empty($athleteUser->blood_group_id)){
            $bloodGroup = BloodGroup::find($athleteUser->blood_group_id);
        }
        $profession = DB::table('professions')->find($athleteUser->profession_id);
//        dd($athleteUser);
        return view('admin.user.athlete-profile',['user'=>$athleteUser,'gender'=>$gender,'bloodGroup'=>$bloodGroup,'profession'=>$profession]);
    }

    public function athleteProfileDownload($id){
        $athleteUser = Athlete::with('athleteCompetition')->find($id);
        $gender = Gender::find($athleteUser->gender_id);
        $bloodGroup = BloodGroup::find($athleteUser->blood_group_id);
        $profession = DB::table('professions')->find($athleteUser->profession_id);

        $html = \Illuminate\Support\Facades\View::make('admin.user._download-athlete-profile',['user'=>$athleteUser,'gender'=>$gender,'bloodGroup'=>$bloodGroup,'profession'=>$profession]);
        $contents = $html->render();
//        dd($contents);

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->set('isRemoteEnabled', true);

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Load HTML to Dompdf
        $dompdf->loadHtml($contents);

        // (Optional) Setup the paper size and orientation 'portrait' or 'landscape'
        $dompdf->setPaper('a4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();
        $fileName = 'Athlete_Profile'.'_'.time().".pdf";

        // Output the generated PDF to Browser (force download)
        $dompdf->stream($fileName, [
            "Attachment" => true
        ]);

        die();

    }


    public function sortAthletes()
    {
        return view('admin.user.sort');
    }

    public function athletesSortData(Request $request)
    {
        $archives = Athlete::orderBy('sort_order')->get();
        $str = '<ul id="sortable">';
        if ($archives != null) {
            foreach ($archives as $archive) {
                $str .= '<li id="' . $archive->id . '"><i class="fa fa-sort"></i>' . $archive->athlete_name . '</li>';
            }
        }
        echo $str . '</ul>';
    }

    public function athletesSortUpdate(Request $request)
    {
        $archiveOrder = $request->input('archiveOrder');
        $archiveOrderArray = explode(',', $archiveOrder);
        $count = 1;
        foreach ($archiveOrderArray as $archiveID) {
            $archive = Athlete::find($archiveID);
            $archive->sort_order = $count;
            $archive->update();
            $count++;
        }
    }

    public function createAthletUser(){
        $athleteTypes = ['Pistol'=>'Pistol','Rifle'=>'Rifle','Short'=>'Short Gun','Disabled'=>'Handicapped Athlete'];
        $maritalStatus = ['Single'=>'Single','Married'=>'Married','Widowed'=>'Widowed','Divorced'=>'Divorced','Separated'=>'Separated'];
        $genders = Gender::where('is_active',1)->orderBy('sort_order', 'ASC')->pluck('gender','id')->all();
        $bloodGroups = BloodGroup::bloodGroupDropDown();
        $professions = Profession::professionDropDown();
        $clubs = ShootingSportClub::clubDropdown();

        $bannerData = Banner::getPageWiseBannerInfo('registration');
        $cities = \Illuminate\Support\Facades\DB::table('cities')
            ->where('is_active',1)
            #->orderby('sort_order','asc')
            ->orderby('city','asc')
            ->pluck('city','id')
            ->all();

        return view('admin.user.add-athlete',['athleteTypes'=>$athleteTypes,'genders'=>$genders,'bloodGroups'=>$bloodGroups,'professions'=>$professions,'maritalStatus'=>$maritalStatus,'bannerData'=>$bannerData,'cities'=>$cities,'clubs'=>$clubs]);
    }

    public function storeAthleteUser(Request $request){
        $rules = [
            'athlete_name' => 'required',
            'athlete_type' => 'required',
//            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:12',
            'email' => 'required|unique:users,email|email|max:100',
            'date_of_birth' =>'required',
//            'age' =>'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'gender_id' =>'required',
//            'father_name' =>'required',
//            'mother_name' =>'required',
//            'address' =>'required',
//            'height' =>'required',
//            'weight' =>'required',
//            'blood_group_id' =>'required',
            'profession_id' =>'required',
            'start_of_competition' =>'required',
//            'name_of_national_coach' =>'required',
//            'place_of_birth' =>'required',
//            'hometown' =>'required',
//            'marital_status' =>'required',
            'event' =>'required',
//            'higher_education' =>'required',
//            'parent_full_name' =>'required',
//            'relationship' =>'required',
//            'parent_mobile' =>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:12',
//            'parent_address' =>'required',
            'profile_image' =>'required',
//            'district_id' =>'required',
            'club_id' =>'required',
        ];
        $customMessages = [
            'athlete_name.required' => 'Enter Athlete Name',
            'athlete_type.required' => 'Choose Athlete Type',
//            'mobile.required' => 'Enter Mobile Number',
//            'mobile.min:8' => 'Mobile minimum 8 digit.',
//            'mobile.max:12' => 'Mobile maximum 12 digit.',
            'email.required' => 'Enter Email Address',
            'email.unique' => 'Email must be unique',
            'email.email' => 'Email must be valid',
            'date_of_birth.required' =>'Enter date of birth',
//            'age.required' =>'Enter age',
            'gender_id.required' =>'Choose gender',
//            'father_name.required' =>'Enter father name',
//            'mother_name.required' =>'Enter mother name',
//            'address.required' =>'Enter address',
//            'height.required' =>'Enter Height',
//            'weight.required' =>'Enter Weight',
//            'blood_group_id.required' =>'Choose blood group',
            'profession_id.required' =>'Choose profession',
            'start_of_competition.required' =>'Enter start of competition',
//            'name_of_national_coach.required' =>'Enter name of national coach',
//            'place_of_birth.required' =>'Enter place of birth',
//            'hometown.required' =>'Enter hometown',
//            'marital_status.required' =>'Choose marital status',
            'event.required' =>'Enter event',
//            'higher_education.required' =>'Enter higher education',
//            'parent_full_name.required' =>'Enter parent full name',
//            'relationship.required' =>'Enter relationship',
//            'parent_mobile.required' =>'Enter parent mobile',
//            'parent_mobile.min:8' => 'Parent Mobile minimum 8 digit.',
//            'parent_mobile.max:12' => 'Parent Mobile maximum 12 digit.',
//            'parent_address.required' =>'Enter parent address',
            'profile_image.required' =>'Choose profile image',
//            'district_id.required' =>'Choose District',
            'club_id.required' =>'Choose Club',
        ];

        $this->validate($request, $rules, $customMessages);
        $input = $request->all();

        $randomPassword = random_int(100000, 999999);
        $userInput['password'] = bcrypt($randomPassword);;
        $userInput['email'] = $request->get('email');
        $userInput['email_verified_at'] = now();
        $userInput['is_active'] = 1;
        $userInput['verified'] = 1;

        $latestUser = Athlete::latest()->first();

        if ($latestUser){
//            $code = substr($latestUser->athlete_id, strrpos($latestUser->athlete_id, "-") + 1);
            $code = substr($latestUser->athlete_id, -5);
            $num = $code+1;
        }else{
            $num = 1;
        }

        if ($input['gender_id'] == 1){
            $gender = 'F';
        }elseif ($input['gender_id'] == 2){
            $gender = 'M';
        }else{
            $gender = 'O';
        }

//        $clubShortName = ShootingSportClub::select('short_name')->where('id',$input['club_id'])->first();
        if (app()->getLocale() == 'bn'){
            $clubShortName = ShootingSportClub::select('short_name_bn')->where('id',$input['club_id'])->first();
        }else{
            $clubShortName = ShootingSportClub::select('short_name_en')->where('id',$input['club_id'])->first();
        }

//            $athleteId = 'BSSF-'.$input['district_id'].'-'.date("y").'-'.$this->getSequence($num);
        $athleteId = 'BSSF'.$clubShortName->short_name.$gender.$this->getSequence($num);
        $input['athlete_id'] = $athleteId;

        $user = User::create($userInput);
        if ($user){
            $input['user_id'] = $user->id;
            $input['sort_order'] = $user->id;
            $input['updated_at'] = null;
            $input['is_approved'] = 1;

            if ($request->hasFile('profile_image')) {
                $image_name = $request->input('athlete_name');
                $fileName = ImgUploader::UploadImage('athlete_profile', $request->file('profile_image'), $image_name, 270,270);
                $input['profile_image'] = $fileName;
            }

            $athlete = Athlete::create($input);

            if ($athlete){
                if ($input['competition_name']){
                    $index = 1;
                    foreach ($input['competition_name'] as $key => $competition) {
                        $athleteCompetition = new AthleteCompetition();
                        $athleteCompetition->athlete_id = $athlete->id;
                        $athleteCompetition->competition_name = $competition;
                        $athleteCompetition->competition_date = $input['competition_date'][$key];
                        $athleteCompetition->competition_event = $input['competition_event'][$key];
                        $athleteCompetition->score = $input['score'][$key];
                        $athleteCompetition->position = $input['position'][$key];
                        $athleteCompetition->sort_order = $index;
                        $athleteCompetition->save();
                        $index++;
                    }
                }
            }

            $details = [
                'mailpage' => 'AthleteRegisterByAdmin',
                'title' => 'BSSF Athlete Registration',
                'password' => $randomPassword,
                'userData'=>$user,
                'athleteId'=>$athleteId,
                'name'=>$input['athlete_name'],
            ];

//            \Mail::to($userInput['email'])->send(new \App\Mail\MailSend($details));

            flash('Athlete has been registered successfully.')->success();
            return \Redirect::route('list.users');
        }
    }

    public function editAthleteUser($id){
        $athleteData = Athlete::where('id',$id)->first();
        $athleteCompetitionData = AthleteCompetition::where('athlete_id',$athleteData->id)->orderBy('sort_order', 'asc')->get()->toArray();

        $clubs = ShootingSportClub::clubDropdown();
        $athleteTypes = ['Pistol'=>'Pistol','Rifle'=>'Rifle','Short'=>'Short Gun','Disabled'=>'Handicapped Athlete'];
        $maritalStatus = ['Single'=>'Single','Married'=>'Married','Widowed'=>'Widowed','Divorced'=>'Divorced','Separated'=>'Separated'];
        $genders = Gender::where('is_active',1)->orderBy('sort_order', 'ASC')->pluck('gender','id')->all();
        $bloodGroups = BloodGroup::bloodGroupDropDown();
        $professions = Profession::professionDropDown();
        $cities = \Illuminate\Support\Facades\DB::table('cities')
            ->where('is_active',1)
            ->orderby('city','asc')
            ->pluck('city','id')
            ->all();

        return view('admin.user.edit-athlete',['athleteCompetitionData'=>$athleteCompetitionData,'user'=>$athleteData,'athleteTypes'=>$athleteTypes,'genders'=>$genders,'bloodGroups'=>$bloodGroups,'professions'=>$professions,'maritalStatus'=>$maritalStatus,'cities'=>$cities,'clubs'=>$clubs]);
    }

    public function updateAthleteUser(Request $request,$id)
    {
        $updateModel = Athlete::find($id);
        $rules = [
            'athlete_name' => 'required',
            'athlete_type' => 'required',
//            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:12',
            'email' => 'required|email|max:255|unique:users,email,' . $updateModel->user_id,
            'date_of_birth' => 'required',
//            'age' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'gender_id' => 'required',
//            'father_name' => 'required',
//            'mother_name' => 'required',
//            'address' => 'required',
//            'height' => 'required',
//            'weight' => 'required',
//            'blood_group_id' => 'required',
            'profession_id' => 'required',
            'start_of_competition' => 'required',
//            'name_of_national_coach' => 'required',
//            'place_of_birth' => 'required',
//            'hometown' => 'required',
//            'marital_status' => 'required',
            'event' => 'required',
//            'higher_education' => 'required',
//            'parent_full_name' => 'required',
//            'relationship' => 'required',
//            'parent_mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:12',
//            'parent_address' => 'required',
//            'district_id' => 'required',
            'club_id' => 'required',
        ];
        $customMessages = [
            'athlete_name.required' => 'Enter Athlete Name',
            'athlete_type.required' => 'Choose Athlete Type',
//            'mobile.required' => 'Enter Mobile Number',
//            'mobile.min:8' => 'Mobile minimum 8 digit.',
//            'mobile.max:12' => 'Mobile maximum 12 digit.',
            'email.required' => 'Enter Email Address',
            'email.unique' => 'Email must be unique',
            'email.email' => 'Email must be valid',
            'date_of_birth.required' => 'Enter date of birth',
//            'age.required' => 'Enter age',
            'gender_id.required' => 'Choose gender',
//            'father_name.required' => 'Enter father name',
//            'mother_name.required' => 'Enter mother name',
//            'address.required' => 'Enter address',
//            'height.required' => 'Enter Height',
//            'weight.required' => 'Enter Weight',
//            'blood_group_id.required' => 'Choose blood group',
            'profession_id.required' => 'Choose profession',
            'start_of_competition.required' => 'Enter start of competition',
//            'name_of_national_coach.required' => 'Enter name of national coach',
//            'place_of_birth.required' => 'Enter place of birth',
//            'hometown.required' => 'Enter hometown',
//            'marital_status.required' => 'Choose marital status',
            'event.required' => 'Enter event',
//            'higher_education.required' => 'Enter higher education',
//            'parent_full_name.required' => 'Enter parent full name',
//            'relationship.required' => 'Enter relationship',
//            'parent_mobile.required' => 'Enter parent mobile',
//            'parent_mobile.min:8' => 'Parent Mobile minimum 8 digit.',
//            'parent_mobile.max:12' => 'Parent Mobile maximum 12 digit.',
//            'parent_address.required' => 'Enter parent address',
//            'district_id.required' => 'Choose District',
            'club_id.required' => 'Choose Club',
        ];

        $this->validate($request, $rules, $customMessages);
        $input = $request->all();

        if ($updateModel) {
            if ($request->hasFile('profile_image')) {
                File::delete(public_path() . '/athlete_profile/' . $updateModel->profile_image);
                File::delete(public_path() . '/athlete_profile/mid/' . $updateModel->profile_image);
                File::delete(public_path() . '/athlete_profile/thumb/' . $updateModel->profile_image);
                $image_name = $request->input('athlete_name');
                $fileName = ImgUploader::UploadImage('athlete_profile', $request->file('profile_image'), $image_name, 150, 150);
                $input['profile_image'] = $fileName;
            } else {
                $input['profile_image'] = $updateModel->profile_image;
            }
            if ($input['email']) {
                $userModel = User::find($updateModel->user_id);
                $userModel->update([
                    'email' => $input['email']
                ]);
            }

            $updateModel->update($input);
            if ($updateModel) {
                if (array_key_exists("competition_name", $request->all())) {
                    if ($input['competition_name'] && $input['competition_date']) {
                        $index = 1;
                        AthleteCompetition::where('athlete_id', $id)->delete();
                        foreach ($input['competition_name'] as $key => $competition) {
                            $athleteCompetition = new AthleteCompetition();
                            $athleteCompetition->athlete_id = $id;
                            $athleteCompetition->competition_name = $competition;
                            $athleteCompetition->competition_date = $input['competition_date'][$key];
                            $athleteCompetition->competition_event = $input['competition_event'][$key];
                            $athleteCompetition->score = $input['score'][$key];
                            $athleteCompetition->position = $input['position'][$key];
                            $athleteCompetition->sort_order = $index;
                            $athleteCompetition->save();
                            $index++;
                        }
                    }
                } else {
                    AthleteCompetition::where('athlete_id', $id)->delete();
                }
            }
            flash(__('You have updated your profile successfully'))->success();
            return \Redirect::route('list.users');
        }
    }



    public function createUser()
    {
        $genders = DataArrayHelper::defaultGendersArray();
        $maritalStatuses = DataArrayHelper::defaultMaritalStatusesArray();
        $nationalities = DataArrayHelper::defaultNationalitiesArray();
        $countries = DataArrayHelper::defaultCountriesArray();
        $jobExperiences = DataArrayHelper::defaultJobExperiencesArray();
        $careerLevels = DataArrayHelper::defaultCareerLevelsArray();
        $industries = DataArrayHelper::defaultIndustriesArray();
        $functionalAreas = DataArrayHelper::defaultFunctionalAreasArray();
        $packages = Package::select('id', DB::raw("CONCAT(`package_title`, ', $', `package_price`, ', Days:', `package_num_days`, ', Listings:', `package_num_listings`) AS package_detail"))->where('package_for', 'like', 'job_seeker')->pluck('package_detail', 'id')->toArray();
        $upload_max_filesize = UploadedFile::getMaxFilesize() / (1048576);

        return view('admin.user.add')
                        ->with('genders', $genders)
                        ->with('maritalStatuses', $maritalStatuses)
                        ->with('nationalities', $nationalities)
                        ->with('countries', $countries)
                        ->with('jobExperiences', $jobExperiences)
                        ->with('careerLevels', $careerLevels)
                        ->with('industries', $industries)
                        ->with('functionalAreas', $functionalAreas)
                        ->with('upload_max_filesize', $upload_max_filesize)
                        ->with('packages', $packages);
    }

    public function storeUser(UserFormRequest $request)
    {
        $user = new User();
        /*         * **************************************** */
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = ImgUploader::UploadImage('user_images', $image, $request->input('name'), 300, 300, false);
            $user->image = $fileName;
        }
        /*         * ************************************** */
        $user->first_name = $request->input('first_name');
        $user->middle_name = $request->input('middle_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->father_name = $request->input('father_name');
        $user->date_of_birth = $request->input('date_of_birth');
        $user->gender_id = $request->input('gender_id');
        $user->marital_status_id = $request->input('marital_status_id');
        $user->nationality_id = $request->input('nationality_id');
        $user->national_id_card_number = $request->input('national_id_card_number');
        $user->country_id = $request->input('country_id');
        $user->state_id = $request->input('state_id');
        $user->city_id = $request->input('city_id');
        $user->phone = $request->input('phone');
        $user->mobile_num = $request->input('mobile_num');
        $user->job_experience_id = $request->input('job_experience_id');
        $user->career_level_id = $request->input('career_level_id');
        $user->industry_id = $request->input('industry_id');
        $user->functional_area_id = $request->input('functional_area_id');
        $user->current_salary = $request->input('current_salary');
        $user->expected_salary = $request->input('expected_salary');
        $user->salary_currency = $request->input('salary_currency');
        $user->street_address = $request->input('street_address');
        $user->is_immediate_available = $request->input('is_immediate_available');
        $user->is_active = $request->input('is_active');
        $user->verified = $request->input('verified');
        $user->save();

        /*         * *********************** */
        $user->name = $user->getName();
        $user->update();
        $this->updateUserFullTextSearch($user);
        /*         * *********************** */
        /*         * ************************************ */
        if ($request->has('job_seeker_package_id') && $request->input('job_seeker_package_id') > 0) {
            $package_id = $request->input('job_seeker_package_id');
            $package = Package::find($package_id);
            $this->addJobSeekerPackage($user, $package);
        }
        /*         * ************************************ */

        flash('User has been added!')->success();
        return \Redirect::route('edit.user', array($user->id));
    }

    public function editUser($id)
    {
        $genders = Gender::get();
        $maritalStatuses = DataArrayHelper::defaultMaritalStatusesArray();
        $nationalities = DataArrayHelper::defaultNationalitiesArray();
        $countries = DataArrayHelper::defaultCountriesArray();
        $jobExperiences = DataArrayHelper::defaultJobExperiencesArray();
        $careerLevels = DataArrayHelper::defaultCareerLevelsArray();
        $industries = DataArrayHelper::defaultIndustriesArray();
        $functionalAreas = DataArrayHelper::defaultFunctionalAreasArray();

        $upload_max_filesize = UploadedFile::getMaxFilesize() / (1048576);
        $user = User::findOrFail($id);
        if ($user->package_id > 0) {
            $package = Package::find($user->package_id);
            $packages = Package::select('id', DB::raw("CONCAT(`package_title`, ', $', `package_price`, ', Days:', `package_num_days`, ', Listings:', `package_num_listings`) AS package_detail"))->where('package_for', 'like', 'job_seeker')->where('id', '<>', $user->package_id)->where('package_price', '>=', $package->package_price)->pluck('package_detail', 'id')->toArray();
        } else {
            $packages = Package::select('id', DB::raw("CONCAT(`package_title`, ', $', `package_price`, ', Days:', `package_num_days`, ', Listings:', `package_num_listings`) AS package_detail"))->where('package_for', 'like', 'job_seeker')->pluck('package_detail', 'id')->toArray();
        }

//        dd($genders);
        return view('admin.user.edit')
                        ->with('genders', $genders)
                        ->with('maritalStatuses', $maritalStatuses)
                        ->with('nationalities', $nationalities)
                        ->with('countries', $countries)
                        ->with('jobExperiences', $jobExperiences)
                        ->with('careerLevels', $careerLevels)
                        ->with('industries', $industries)
                        ->with('functionalAreas', $functionalAreas)
                        ->with('user', $user)
                        ->with('upload_max_filesize', $upload_max_filesize)
                        ->with('packages', $packages);
    }

    public function updateUser(Request $request)
    {
        dd($request->all());
    }

//    public function updateUser($id, UserFormRequest $request)
//    {
//        return back()->withInput();
//        $user = User::findOrFail($id);
//        /*         * **************************************** */
//        if ($request->hasFile('image')) {
//            $is_deleted = $this->deleteUserImage($user->id);
//            $image = $request->file('image');
//            $fileName = ImgUploader::UploadImage('user_images', $image, $request->input('name'), 300, 300, false);
//            $user->image = $fileName;
//        }
//
//		if ($request->hasFile('cover_image')) {
//			$is_deleted = $this->deleteUserCoverImage($user->id);
//            $cover_image = $request->file('cover_image');
//            $fileName_cover_image = ImgUploader::UploadImage('user_images', $cover_image, $request->input('name'), 1140, 250, false);
//            $user->cover_image = $fileName_cover_image;
//        }
//
//        /*         * ************************************** */
//        $user->first_name = $request->input('first_name');
////        $user->middle_name = $request->input('middle_name');
//        $user->last_name = $request->input('last_name');
//        /*         * *********************** */
//        $user->name = $user->getName();
//        /*         * *********************** */
//        $user->email = $request->input('email');
////        if (!empty($request->input('password'))) {
////            $user->password = Hash::make($request->input('password'));
////        }
////        $user->father_name = $request->input('father_name');
////        $user->date_of_birth = $request->input('date_of_birth');
////        $user->gender_id = $request->input('gender_id');
////        $user->marital_status_id = $request->input('marital_status_id');
////        $user->nationality_id = $request->input('nationality_id');
////        $user->national_id_card_number = $request->input('national_id_card_number');
////        $user->country_id = $request->input('country_id');
////        $user->state_id = $request->input('state_id');
////        $user->city_id = $request->input('city_id');
////        $user->phone = $request->input('phone');
////        $user->mobile_num = $request->input('mobile_num');
////        $user->job_experience_id = $request->input('job_experience_id');
////        $user->career_level_id = $request->input('career_level_id');
////        $user->industry_id = $request->input('industry_id');
////        $user->functional_area_id = $request->input('functional_area_id');
////        $user->current_salary = $request->input('current_salary');
////        $user->expected_salary = $request->input('expected_salary');
////        $user->salary_currency = $request->input('salary_currency');
////        $user->street_address = $request->input('street_address');
////        $user->is_immediate_available = $request->input('is_immediate_available');
////        $user->is_active = $request->input('is_active');
////        $user->verified = $request->input('verified');
//        $user->update();
//
////        $this->updateUserFullTextSearch($user);
////        /*         * ************************************ */
////        if ($request->has('job_seeker_package_id') && $request->input('job_seeker_package_id') > 0) {
////            $package_id = $request->input('job_seeker_package_id');
////            $package = Package::find($package_id);
////            if ($user->package_id > 0) {
////                $this->updateJobSeekerPackage($user, $package);
////            } else {
////                $this->addJobSeekerPackage($user, $package);
////            }
////        }
//        /*         * ************************************ */
//
//        flash('User has been updated!')->success();
//        return \Redirect::route('edit.user', array($user->id));
//    }

    public function fetchUsersData(Request $request)
    {
        $users = User::select(
                        [
                            'users.id',
                            'users.first_name',
                            'users.middle_name',
                            'users.last_name',
                            'users.email',
                            'users.password',
                            'users.phone',
                            'users.country_id',
                            'users.state_id',
                            'users.city_id',
                            'users.is_immediate_available',
                            'users.num_profile_views',
                            'users.is_active',
                            'users.verified',
                            'users.email_verified_at',
                            'users.is_email_preference',
                            'users.created_at',
                            'users.updated_at'
        ])->where('user_type', 'candidate')->where('is_accept_terms','1');
        return Datatables::of($users)
                        ->filter(function ($query) use ($request) {
                            if ($request->has('id') && !empty($request->id)) {
                                $query->where('users.id', 'like', "{$request->get('id')}");
                            }
                            if ($request->has('name') && !empty($request->name)) {
                                $query->where(function($q) use ($request) {
                                    $q->where('users.first_name', 'like', "%{$request->get('name')}%")
                                    ->orWhere('users.middle_name', 'like', "%{$request->get('name')}%")
                                    ->orWhere('users.last_name', 'like', "%{$request->get('name')}%");
                                });
                            }
                            if ($request->has('email') && !empty($request->email)) {
                                $query->where('users.email', 'like', "%{$request->get('email')}%");
                            }
                            if ($request->has('phone') && !empty($request->phone)) {
                                $query->where('users.phone', 'like', "{$request->get('phone')}%");
                            }
                            if ($request->has('accountStatus') && !empty($request->accountStatus)) {
                                if($request->accountStatus=='active'){
                                    $query->where('users.is_active', '=', 1);
                                    $query->where('users.verified', '=', 1);
                                    $query->where('users.email_verified_at', '!=', null);
                                }elseif ($request->accountStatus=='inactive'){
                                    $query->where(function($q) use ($request) {
                                        $q->where('users.is_active', '=', 1)->orWhere('users.is_active', '=', 0);
                                    });
                                    $query->where('users.verified', '=', 0);
                                    $query->where('users.email_verified_at');
                                }elseif ($request->accountStatus=='suspended'){
                                    $query->where('users.is_active', '=', 0);
                                    $query->where('users.verified', '=', 1);
                                    $query->where('users.email_verified_at', '!=', null);
                                }
                                /*$query->where('users.phone', 'like', "{$request->get('phone')}%");*/
                            }
                        })
                        /*->addColumn('user_type', function ($users) {
                            return 'Job Seeker';
                        })*/
                        ->addColumn('name', function ($users) {
                            return $users->first_name . ' ' . $users->middle_name . ' ' . $users->last_name;
                        })
                        ->addColumn('is_active', function ($users) {
                            $status='';
                            if($users->is_active == 1 and $users->verified == 1 and $users->email_verified_at != null){
                                $status='Active';
                            }elseif ($users->is_active == 1 and $users->verified == 0 and $users->email_verified_at == null){
                                $status='Inactive';
                            }elseif ($users->is_active == 0 and $users->verified == 0 and $users->email_verified_at == null){
                                $status='Inactive';
                            }elseif ($users->is_active == 0 and $users->verified == 1 and $users->email_verified_at != ''){
                                $status='Suspended';
                            }
                            return $status;
                        })
                        /*->addColumn('verified', function ($users) {
                            return $users->verified == 1 ? 'Verified': 'Not Verified';

                         })*/
                        ->addColumn('is_email_preference', function ($users) {
                            return $users->is_email_preference == 1 ? 'Yes': 'No';

                         })
                        ->addColumn('action', function ($users) {
                            /*                             * ************************* */
                            $active_txt = '';
                            $active_href = '';
                            $active_icon = '';
                            $active_class = '';
                            if ((int) $users->is_active == 1 && (int) $users->verified == 1) {
//                                $active_txt = 'Make InActive';
                                $active_txt = 'Suspend';
                                $active_href = 'make_not_active(' . $users->id . ');';
                                $active_icon = 'square-o';
                            }elseif ((int) $users->is_active == 1 && (int) $users->verified == 0){
                               // $active_txt = 'Inactive';
                                $active_href = 'make_not_active(' . $users->id . ');';
                                $active_icon = '';
                                $active_class = 'hidden';
                            }elseif ((int) $users->is_active == 0 && (int) $users->verified == 0){
                                $active_class = 'hidden';
                            }elseif ($users->is_active == 0 and $users->verified == 1 and $users->email_verified_at != ''){
                                $active_txt = 'Active';
                                $active_href = 'make_active(' . $users->id . ');';
                                $active_icon = 'check-square-o';
                            }
                            /*                             * ************************* */
                            /*                             * ************************* */
                            $verified_txt = 'Verified';
                            $verified_href = 'make_verified(' . $users->id . ');';
                            $verified_icon = 'check-square-o';
                            if ((int) $users->verified == 1) {
                                $verified_txt = 'Not Verified';
                                $verified_href = 'make_not_verified(' . $users->id . ');';
                                $verified_icon = 'square-o';
                            }
                            /*                             * ************************* */
                            return '
                                <div class="btn-group">
                                    <button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                        <a href="' . route('admin.view.profile', ['id' => $users->id]) . '"><i class="fa fa-eye" aria-hidden="true"></i>View</a>
                                        </li>
                                        <li>
                                        <a href="javascript:void(0);" onclick="delete_user(' . $users->id . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
                                        </li>
                                        <li>
                                        <a class="'.$active_class.'" href="javascript:void(0);" onClick="' . $active_href . '" id="onclick_active_' . $users->id . '"><i class="fa fa-' . $active_icon . '" aria-hidden="true"></i>' . $active_txt . '</a>
                                        </li>
                                     </ul>
                                </div>';
                        })

                        ->rawColumns(['action', 'name'])
                        ->setRowId(function($users) {
                            return 'user_dt_row_' . $users->id;
                        })
                        ->make(true);
    }



    public function makeActiveUser(Request $request)
    {
        $id = $request->input('id');
        try {
            $user = Athlete::findOrFail($id);
            $user->is_active = 1;
            $user->update();
           return new JsonResponse(array('status'=>'ok','value'=>'Active'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotActiveUser(Request $request)
    {
        $id = $request->input('id');
        try {
            $user = Athlete::findOrFail($id);
            $user->is_active = 0;
            $user->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Inactive'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    function getSequence($num) {
        return sprintf("%'.05d", $num);
    }


    public function makeApproveUser(Request $request)
    {
        $id = $request->input('id');
        $user = Athlete::findOrFail($id);
        if (!$user->athlete_id) {
            $latestUser = Athlete::where('id', '!=', $id)->latest()->first();

            if ($latestUser) {
//            $code = substr($latestUser->athlete_id, strrpos($latestUser->athlete_id, "-") + 1);
                $code = substr($latestUser->athlete_id, -5);
                $num = $code + 1;
            } else {
                $num = 1;
            }
//        $athleteId = 'BSSF-'.$user->district_id.'-'.date("y").'-'.$this->getSequence($num);
            if ($user->gender_id == 1) {
                $gender = 'F';
            } elseif ($user->gender_id == 2) {
                $gender = 'M';
            } else {
                $gender = 'O';
            }
            $clubShortName = ShootingSportClub::select('short_name')->where('id', $user->club_id)->first();
//            $athleteId = 'BSSF-'.$input['district_id'].'-'.date("y").'-'.$this->getSequence($num);
            $athleteId = 'BSSF' . $clubShortName->short_name . $gender . $this->getSequence($num);
        }else{
            $athleteId = $user->athlete_id;
        }

        try {
            $user->is_approved = 1;
            $user->athlete_id = $athleteId;
            $user->update();

            $details = [
                'mailpage' => 'AthleteRegisterApproval',
                'title' => 'BSSF Athlete Registration Approval',
                'userData'=>$user,
            ];

//            \Mail::to($user->email)->send(new \App\Mail\MailSend($details));
            return new JsonResponse(array('status'=>'ok','value'=>'Yes'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotApproveUser(Request $request)
    {
        $id = $request->input('id');
        try {
            $user = Athlete::findOrFail($id);
            $user->is_approved = 0;
            $user->update();
            return new JsonResponse(array('status'=>'ok','value'=>'No'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeVerifiedUser(Request $request)
    {
        $id = $request->input('id');
        try {
            $user = User::findOrFail($id);
            $user->verified = 1;
            $user->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Verified'));

        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makeNotVerifiedUser(Request $request)
    {
        $id = $request->input('id');
        try {
            $user = User::findOrFail($id);
            $user->verified = 0;
            $user->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Not Verified'));

        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function deleteUser(Request $request)
    {
        $id = $request->input('id');
        /*$athlete = Athlete::find($id);
        \Illuminate\Support\Facades\File::delete(public_path().'/athlete_profile/'.$athlete->profile_image);
        \Illuminate\Support\Facades\File::delete(public_path().'/athlete_profile/mid/'.$athlete->profile_image);
        \Illuminate\Support\Facades\File::delete(public_path().'/athlete_profile/thumb/'.$athlete->profile_image);*/
        Athlete::find($id)->delete();
        echo 'ok';
    }

    public function viewPublicProfile($id)
    {
        $userJobTitles = DB::table('user_job_titles')
            ->join('job_titles','job_titles.id','=','user_job_titles.job_title_id')
            ->where('user_id', $id)->get();

        $userJobTypes = DB::table('user_job_types')
            ->join('job_types','job_types.id','=','user_job_types.job_type_id')
            ->where('user_id', $id)->get();

        $userLanguages = DB::table('user_languages')
            ->join('languages','languages.id','=','user_languages.language_id')
            ->where('user_id', $id)->get();

        $userSummary = DB::table('profile_summaries')
            ->where('user_id', $id)->first();
        $userSummary = $userSummary ? $userSummary->summary : '';

        $userGender = DB::table('users')
            ->join('genders','genders.id','=','users.gender_id')
            ->where('users.id', $id)->first();
        $userGender = $userGender ? $userGender->gender : '';

        $userExperience = DB::table('users')
            ->join('job_experiences','job_experiences.id','=','users.job_experience_id')
            ->where('users.id', $id)->first();
        $userExperience = $userExperience ? $userExperience->job_experience : '';

        $userProfileVideo = DB::table('user_videos')->where('user_id', $id)->first();
        $userResume = DB::table('profile_cvs')->where('user_id', $id)->first();
        $user = User::findOrFail($id);

        return view('admin.user.profile')
            ->with('user', $user)
            ->with('page_title', $user->getName())
            ->with('form_title', 'Contact ' . $user->getName())
            ->with('userJobTitles', $userJobTitles)
            ->with('userJobTypes', $userJobTypes)
            ->with('userLanguages', $userLanguages)
            ->with('userSummary', $userSummary)
            ->with('userProfileVideo', $userProfileVideo)
            ->with('userExperience', $userExperience)
            ->with('userResume', $userResume)
            ->with('userGender', $userGender);
    }

    /**
     * Admin: Deleted User List
     */
    public function deletedUser()
    {
        /*$users = DB::table('deleted_users')
            ->select('deleted_users.created_at as deleted_date', 'deleted_users.user_name', 'deleted_users.user_email','user_account_close_reasons.title')
            ->join('user_account_close_reasons', 'user_account_close_reasons.id', '=', 'deleted_users.delete_reason_id')
            ->where('deleted_users.user_type', 'candidate')
            ->get();*/

        $users = Athlete::onlyTrashed()->get();

        return view('admin.custom.deleted-users')->with('users', $users);
    }





    public function makeFormerAthlete(Request $request)
    {
        $id = $request->input('id');
        $user = Athlete::findOrFail($id);

        try {
            $user->is_present = 0;
            $user->update();
            return new JsonResponse(array('status'=>'ok','value'=>'No, Former Athlete'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    public function makePresentAthlete(Request $request)
    {
        $id = $request->input('id');
        try {
            $user = Athlete::findOrFail($id);
            $user->is_present = 1;
            $user->update();
            return new JsonResponse(array('status'=>'ok','value'=>'Yes, Present Athlete'));
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }

    /*     * ******************************************** */
}
