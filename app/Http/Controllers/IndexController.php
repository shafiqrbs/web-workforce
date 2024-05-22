<?php

namespace App\Http\Controllers;

use App;
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
       /* if (Session::get('construction') === false){
            Session::put('construction', false);
        }
        else{
            Session::put('construction', true);
        }*/

        Session::put('construction', false);

		$sliders = Slider::langSliders();
		$stickyNewsAndNotice= NewsAndNotice::orderBy('sort_order', 'asc')->where('is_active',1)->where('is_sticky',1)->get();
        $seo = SEO::where('seo.page_title', 'like', 'front_index_page')->first();
        $financialPartner = App\Models\FinancialPartner::getFinancialPartner();

        $presentAthletesData = Athlete::getAllPresentAthlets();
        $formerAthletesData = Athlete::getAllFormerAthlets();
        $newsAndNotices = NewsAndNotice::getLatestNews(3);
        $events = App\Models\Event::getLatestEvent(3);

        return view('welcome',[
            'sliders'=>$sliders,'stickyNewsAndNotice'=>$stickyNewsAndNotice,'seo'=>$seo,'financialPartner'=>$financialPartner,'presentAthletesData'=>$presentAthletesData,'formerAthletesData'=>$formerAthletesData,'newsAndNotices'=>$newsAndNotices,'events'=>$events
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
