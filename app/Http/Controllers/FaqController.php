<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\ContactForm;
use DB;
use App\Faq;
use App\Seo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqController extends Controller
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
    public function index()
    {
        $faqs = Faq::select(
                        [
                            'faqs.id',
                            'faqs.faq_question',
                            'faqs.faq_answer',
                            'faqs.sort_order',
                            'faqs.created_at',
                            'faqs.updated_at'
                        ]
                )
                ->lang()
                ->orderBy('faqs.sort_order', 'ASC')
                ->orderBy('faqs.id', 'ASC')
                ->get();
        //print_r($seo);exit;
        $seo = (object) array(
            'seo_title' => 'JOBSEEKERS  FAQ’S - Hospitality, Travel &amp; Tourism Recruitment Post Covid',
            'seo_description' => 'From mom and pop to large corporate type businesses, we aim to make it extremely efficient to hire staff for all HTT type jobs by putting Employers directly in touch with Jobseekers. So simple & so unique!',
            'seo_keywords' => 'Hospitality Travel Tourism Staffing Recruitment Jobseekers Employers PostCovid Covid simple unique Efficient resume video job',
            'seo_other' => '<meta name="robots" content="ALL, FOLLOW,INDEX" />'
        );
        $bannerData = Banner::getPageWiseBannerInfo('faq');


        return view('faq.list_faq')
            ->with('faqs', $faqs)
            ->with('bannerData', $bannerData)
            ->with('seo', $seo);
    }

    public function contactForm(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ], [
            'name.required' => ' The name field is required.',
            'email.required' => ' The email field is required.',
            'email.email' => ' Email must be valid.',
            'subject.required' => ' The subject field is required.',
            'message.required' => ' The message field is required.',
        ]);
        $input['full_name'] = $request->input('name');
        $input['email'] = $request->input('email');
        $input['subject'] = $request->input('subject');
        $input['message_txt'] = $request->input('message');

//        dd($input);

        $data = ContactForm::create($input);

        $details = [
            'mailpage' => 'ContactForm',
            'title' => 'BSSF Query Form',
            'data' =>$data
        ];

//        \Mail::to('email_address')->send(new \App\Mail\MailSend($details));

        flash('Thanks for your query & get response ASAP')->success();
        return \Redirect::route('cms','contact-us');
    }

}
