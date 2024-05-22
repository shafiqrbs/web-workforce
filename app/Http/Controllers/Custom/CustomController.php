<?php

namespace App\Http\Controllers\Custom;

use App\Country;
use App\User;
use App\Http\Controllers\Controller;
use App\Mail\EmailToFriend;
use App\State;
use Illuminate\Http\Request;
use App\Testimonial;
use DB;
use Illuminate\Support\Facades\Auth;
use Mail;

class CustomController extends Controller
{
    public function approveProfileVideo($id)
    {
        DB::table('user_videos')->where('id', $id)->update([
            'status'=>'approved'
        ]);
        return response()->json(['success'=> 'success']);
    }

    public function declineProfileVideo($id)
    {
        DB::table('user_videos')->where('id', $id)->update([
            'status'=>'notapproved'
        ]);
        return response()->json(['success'=> 'success']);
    }
    public function deleteProfileVideo($id)
    {
        DB::table('user_videos')->where('id', $id)->delete();
        return response()->json(['success'=>'success']);
    }

    public function privacy()
    {
         return view('custom.privacy');
    }

    public function terms()
    {
        return view('custom.terms');
    }

    public function faq()
    {
        return view('custom.faq');
    }

    public function review($status='candidate')
    {
        $testimonials = Testimonial::langTestimonials($status);
        $seo = (object) array(
            'seo_title' => 'Jobseeker Reviews - Hospitality, Travel &amp; Tourism Recruitment Post Covid',
            'seo_description' => 'From mom and pop to large corporate type businesses, we aim to make it extremely efficient to hire staff for all HTT type jobs by putting Employers directly in touch with Jobseekers. So simple & so unique!',
            'seo_keywords' => 'Hospitality Travel Tourism Staffing Recruitment Jobseekers Employers PostCovid Covid simple unique Efficient resume video job',
            'seo_other' => '<meta name="robots" content="ALL, FOLLOW,INDEX" />'
        );
        return view('custom.review')
            ->with('status', $status)
            ->with('testimonials', $testimonials)
            ->with('seo', $seo);
    }

    /**
     * Testimonial
     */
    public function testimonialPage()
    {
        if (!Auth::check()){
            return redirect('login');
        }
        $user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        } else{
            if($user->user_type == 'candidate'){
                return view('user.testimonials.add');
            } else{
                $jobSeekerSearchSave = DB::table('jobseeker_search_save')->where('user_id',auth()->user()->id)->get();
                $saveSearchCount = $jobSeekerSearchSave->count();
                $saveprofileCount = DB::table('favourite_jobseeker')->where('user_id',auth()->user()->id)->get();
                $countSaveProfile = $saveprofileCount->count();
                return view('employer.testimonials.add')
                    ->with('saveSearchCount',$saveSearchCount)
                    ->with('countSaveProfile',$countSaveProfile);
            }
        }

    }

    public function testimonialSave(Request $request)
    {
        if (!Auth::check()){
            return redirect('login');
        }
        $user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        }
        $user = auth()->user();
        $userName = $user->getFirstName();
        DB::table('testimonials')->insert([
            'user_id'=>$user->id,
            'testimonial_by'=>$userName,
            'user_type'=> $user->user_type == 'candidate'?'candidate':'employee',
            'testimonial' => $request->testimonial,
            'rating' => $request->rating,
            'is_active'=>0
        ]);
        flash(__('Your review has been added successfully.'))->success();

        return redirect()->route('user.testimonials');
    }

    public function testimonials()
    {
        if (!Auth::check()){
            return redirect('login');
        }
        $user = auth()->user();
        if ($user && $user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        } else{
            if($user->user_type == 'candidate'){
                $testimonial = DB::table('testimonials')->where('user_id', auth()->user()->id)->first();
                return view('user.testimonials.index')->with('testimonial', $testimonial);
            } else{
                $testimonial = DB::table('testimonials')->where('user_id', auth()->user()->id)->first();
                $jobSeekerSearchSave = DB::table('jobseeker_search_save')->where('user_id',auth()->user()->id)->get();
                $saveSearchCount = $jobSeekerSearchSave->count();
                $saveprofileCount = DB::table('favourite_jobseeker')->where('user_id',auth()->user()->id)->get();
                $countSaveProfile = $saveprofileCount->count();
                return view('employer.testimonials.index')
                    ->with('testimonial', $testimonial)
                    ->with('saveSearchCount', $saveSearchCount)
                    ->with('countSaveProfile', $countSaveProfile);
            }
        }

    }

    public function deleteTestimonial()
    {
        if (!Auth::check()){
            return redirect('login');
        }
        $user = auth()->user();
        if ($user->is_active==0) {
            flash(__('Your account has been suspended, please contact us at <a href="mailto:customerservice@httconnect.ca">customerservice@httconnect.ca </a>  to resolve any issues.'))->error();
            return redirect('login')->with(auth()->logout());
        }

        DB::table('testimonials')->where('user_id', auth()->user()->id)->delete();
        flash(__('Your review has been deleted.'))->success();
        return response()->json(['success'=>'success']);
    }

    /**
     * Contact Us
     */
    public function contactUsProcess(Request $request)
    {
        $rules = [
            'first_name' => 'required|max:80',
            'last_name' => 'required|max:80',
            'email' => 'required|email|max:100',
            'subject' => 'required|max:200',
            'body' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ];

        $customMessages = [
            'first_name.required' => __('First Name is required.'),
            'last_name.required' => __('Last Name is required.'),
            'email.required' => __('Email is required.'),
            'email.email' => __('Email must be a valid email address.'),
            'subject.required' => __('Subject is required.'),
            'body.required' => __('Body is required.'),
            'g-recaptcha-response.required' => __('Recaptcha is required.'),

        ];

        $this->validate($request, $rules, $customMessages);

        $details = [
            'title'=>'Hello',
            'name'=>$request->first_name.' '.$request->last_name,
            'subject'=>$request->subject,
            'body'=>$request->body,
            'sender'=> $request->email,
        ];
        Mail::send(new EmailToFriend($details));

        flash(__('Your email has been sent.'))->success();
        return redirect()->back();
    }

    /**
     * Admin: Deleted User List
     */
    public function deletedUser()
    {
        $users = DB::table('deleted_users')
            ->join('user_account_close_reasons', 'user_account_close_reasons.id', '=', 'deleted_users.delete_reason_id')
            ->get();

        return view('admin.custom.deleted-users')->with('users', $users);
    }

    public function publicProfileView($id)
    {
        $user = auth()->user();
        if ($user && $user->user_type == 'employer' || $user && $user->user_type == 'sub_account') {
            $userJobTitles = DB::table('user_job_titles')
                ->join('job_titles', 'job_titles.id', '=', 'user_job_titles.job_title_id')
                ->where('user_id', $id)->get();

            $userJobTypes = DB::table('user_job_types')
                ->join('job_types', 'job_types.id', '=', 'user_job_types.job_type_id')
                ->where('user_id', $id)->get();

            $userLanguages = DB::table('user_languages')
                ->join('languages', 'languages.id', '=', 'user_languages.language_id')
                ->where('user_id', $id)->get();

            $userSummary = DB::table('profile_summaries')
                ->where('user_id', $id)->first();
            $userSummary = $userSummary ? $userSummary->summary : '';

            $userGender = DB::table('users')
                ->join('genders', 'genders.id', '=', 'users.gender_id')
                ->where('users.id', $id)->first();
            $userGender = $userGender ? $userGender->gender : '';

            $userExperience = DB::table('users')
                ->join('job_experiences', 'job_experiences.id', '=', 'users.job_experience_id')
                ->where('users.id', $id)->first();
            $userExperience = $userExperience ? $userExperience->job_experience : '';

            $userSalaryPeriod = DB::table('users')
                ->join('salary_periods', 'salary_periods.id', '=', 'users.salary_period_id')
                ->where('users.id', $id)->first();
            $userSalaryPeriod = $userSalaryPeriod ? $userSalaryPeriod->salary_period : '';

            $userProfileVideo = DB::table('user_videos')->where('user_id', $id)->first();
            $userResume = DB::table('profile_cvs')->where('user_id', $id)->first();
            $user = User::findOrFail($id);

            return view('user.public_profile_view')
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
                ->with('userSalaryPeriod', $userSalaryPeriod)
                ->with('userGender', $userGender);
        }
        return redirect('login')->with(auth()->logout());

    }
}

