<?php

namespace App\Providers;

use DB;
use View;
use App\Language;
use App\SiteSetting;
use App\Cms;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $siteLanguages = Language::where('is_active', '=', 1)->get();
        $siteSetting = SiteSetting::findOrFail(1272);
        $show_in_top_menu = Cms::where('show_in_top_menu', 1)->where('is_active', 1)->orderBy('page_slug', 'ASC')->get();
        $show_in_footer_menu = Cms::where('show_in_footer_menu', 1)->where('is_active', 1)->orderBy('page_slug', 'ASC')->get();

        
        $provinceWiseUsers = DB::table('states')->get();
        foreach ($provinceWiseUsers as $item){
            $total = DB::table('users')->where('is_active', 1)->where('verified', 1)->whereNotNull('email_verified_at')->where('state_id', $item->id)->get();
            $item->totalUser = count($total) + $item->default_cv_count;
        }


        View::share(
                [
                    'siteLanguages' => $siteLanguages,
                    'provinceWiseUsers' => $provinceWiseUsers,
                    'siteSetting' => $siteSetting,
                    'show_in_top_menu' => $show_in_top_menu,
                    'show_in_footer_menu' => $show_in_footer_menu
                ]
        );
    }

    public function register()
    {
        //
    }

}
