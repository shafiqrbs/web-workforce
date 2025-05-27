<?php

namespace App\Http\Controllers;

use App;
use App\Cms;
use App\CmsContent;
use App\Models\Event;
use App\Models\FinancialPartner;
use App\Models\NewsAndNotice;
use App\Models\Athlete;
use App\Models\AthleteCompetition;
use App\Seo;
use App\Job;
use App\Company;
use App\FunctionalArea;
use App\Country;
use App\Video;
use App\Testimonial;
use App\Slider;
use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Redirect;
use App\Traits\CompanyTrait;
use App\Models\VisitorCount;
use App\Traits\FunctionalAreaTrait;
use App\Traits\CityTrait;
use App\Traits\JobTrait;
use App\Traits\Active;
use App\Helpers\DataArrayHelper;
use DB;

class IndexController extends Controller
{

    use CompanyTrait;
    use FunctionalAreaTrait;
    use CityTrait;
    use JobTrait;
    use Active;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function constructionMode(){
        Session::put('construction', false);
        return redirect()->route('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('construction', false);

		$sliders = Slider::langSliders();
		$stickyNewsAndNotice= NewsAndNotice::orderBy('sort_order', 'asc')->where('is_active',1)->where('is_sticky',1)->get();
        $seo = SEO::where('seo.page_title', 'like', 'front_index_page')->first();
        $financialPartner = App\Models\FinancialPartner::getFinancialPartner();

        $newsAndNotices = NewsAndNotice::getLatestNews(3);
        $abouts = NewsAndNotice::getPostByType('NEWS',3);
        $events = Event::getLatestEvent(3);

//        dd($events);
        $aboutContent = CmsContent::where('page_id',14)->first();

        $achievements = FinancialPartner::getAchievement();

        return view('welcome',[
            'sliders'=> $sliders,
            'aboutContent'=> $aboutContent,
            'abouts'=> $abouts,
            'stickyNewsAndNotice'=> $stickyNewsAndNotice,
            'seo'=>$seo,
            'financialPartner'=>$financialPartner,
            'newsAndNotices'=>$newsAndNotices,
            'achievements'=>$achievements,
            'events'=>$events
        ]);
    }

    public function newIndex()
    {

        $topCompanyIds = $this->getCompanyIdsAndNumJobs(16);
        $topFunctionalAreaIds = $this->getFunctionalAreaIdsAndNumJobs(32);
        $topIndustryIds = $this->getIndustryIdsFromCompanies(32);
        $topCityIds = $this->getCityIdsAndNumJobs(32);
        $featuredJobs = Job::active()->featured()->notExpire()->limit(12)->orderBy('id', 'desc')->get();
        $latestJobs = Job::active()->notExpire()->orderBy('id', 'desc')->limit(18)->get();
        $blogs = Blog::orderBy('id', 'desc')->where('lang', 'like', \App::getLocale())->limit(3)->get();
        $video = Video::getVideo();

        $functionalAreas = DataArrayHelper::langFunctionalAreasArray();
        $countries = DataArrayHelper::langCountriesArray();
		$sliders = Slider::langSliders();

        $seo = SEO::where('seo.page_title', 'like', 'front_index_page')->first();
        return view('welcome_new')
                        ->with('topCompanyIds', $topCompanyIds)
                        ->with('topFunctionalAreaIds', $topFunctionalAreaIds)
                        ->with('topCityIds', $topCityIds)
                        ->with('topIndustryIds', $topIndustryIds)
                        ->with('featuredJobs', $featuredJobs)
                        ->with('latestJobs', $latestJobs)
                        ->with('blogs', $blogs)
                        ->with('functionalAreas', $functionalAreas)
                        ->with('countries', $countries)
						->with('sliders', $sliders)
                        ->with('video', $video)
                        ->with('seo', $seo);
    }

    public function setLocale(Request $request)
    {
        $locale = $request->input('locale');
        $return_url = $request->input('return_url');
        $is_rtl = $request->input('is_rtl');
        $localeDir = ((bool) $is_rtl) ? 'rtl' : 'ltr';

        session(['locale' => $locale]);
        session(['localeDir' => $localeDir]);

        return Redirect::to($return_url);
    }

    public function deleteConfirmationMessage(){
        return view('delete_confirmation_message');
    }

}
