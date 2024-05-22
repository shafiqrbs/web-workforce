


@if(Session::get('construction') === true)

   <html>
        <head>
            <style>
                /* Set height to 100% for body and html to enable the background image to cover the whole page: */
                body, html {
                    height: 100%
                }

                .bgimg {
                    /* Background image */
                    background-image: url('/construction.jpg');
                    /* Full-screen */
                    height: 100%;
                    /* Center the background image */
                    background-position: center;
                    /* Scale and zoom in the image */
                    background-size: cover;
                    /* Add position: relative to enable absolutely positioned elements inside the image (place text) */
                    position: relative;
                    /* Add a white text color to all elements inside the .bgimg container */
                    color: white;
                    /* Add a font */
                    font-family: "Courier New", Courier, monospace;
                    /* Set the font-size to 25 pixels */
                    font-size: 25px;
                }

                /* Position text in the top-left corner */
                .topleft {
                    position: absolute;
                    top: 0;
                    left: 16px;
                }

                /* Position text in the bottom-left corner */
                .bottomleft {
                    position: absolute;
                    bottom: 0;
                    left: 16px;
                }

                /* Position text in the middle */
                .middle {
                    position: absolute;
                    top: 14%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    text-align: center;
                    background: black;
                    opacity: .8;
                    padding-left: 10px;
                    padding-right: 10px;
                }

                /* Style the <hr> element */
                hr {
                    margin: auto;
                    width: 40%;
                }


                /*calender style*/
                /*calender style*/

            </style>



            <script>
                // Set the date we're counting down to
                /*var countDownDate = new Date("may 30, 2023 15:37:25").getTime();

                // Update the count down every 1 second
                var x = setInterval(function() {

                    // Get todays date and time
                    var now = new Date().getTime();

                    // Find the distance between now an the count down date
                    var distance = countDownDate - now;

                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Display the result in an element with id="demo"
                    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                        + minutes + "m " + seconds + "s ";

                    // If the count down is finished, write some text
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("demo").innerHTML = "EXPIRED";
                    }
                }, 1000);*/
            </script>
        </head>
        <body>
        <div class="bgimg">
            <div class="topleft middle">
                <h1>The website is under development.</h1>
                <hr>
                <p>
                    <a style="color: red;" href="{{route('construction_mode')}}">Anyway visit site</a>

                </p>
            </div>

            <div class="bottomleft">
                <p style="background: black;
    padding: 10px;font-size: 12px;
    opacity: .8;
    text-align: justify;">We apologize for the inconvenience. Our website is currently undergoing construction. During this construction period, some sections of our website may be temporarily unavailable.
                </p>
            </div>
        </div>
        </body>
   </html>
@else
<?php
if (!isset($seo)) {
    $seo = (object)array('seo_title' => $siteSetting->site_name, 'seo_description' => $siteSetting->site_name, 'seo_keywords' => $siteSetting->site_name, 'seo_other' => '');
}
?>
        <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="{{ (session('localeDir', 'ltr'))}}" dir="{{ (session('localeDir', 'ltr'))}}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <title>{{__($siteSetting->site_name) }}</title>
    <meta name="Description" content="{!! $seo->seo_description !!}">
    <meta name="Keywords" content="{!! $seo->seo_keywords !!}">

    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link href="{{asset('assets/css/font-awesome-all.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/flaticon.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/owl.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/jquery.fancybox.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/nice-select.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/color.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/jquery-ui.css')}}" rel="stylesheet">
    {{--    <link href="{{asset('assets/css/timePicker.css')}}" rel="stylesheet">--}}
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">

    <link href="{{asset('assets/css/responsive.css')}}" rel="stylesheet">


    @if((session('localeDir', 'ltr') == 'rtl'))
    <!-- Rtl Style -->
        {{--    <link href="{{asset('/')}}css/rtl-style.css" rel="stylesheet">--}}
    @endif

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
          <script src="{{asset('js/html5shiv.min.js')}}"></script>
          <script src="{{asset('js/respond.min.js')}}"></script>

        <![endif]-->

    {{--<style>
        #banner {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #logo {
            height: 125px;
        }

        .element {
            margin-right: 1em;
        }
    </style>--}}
    @stack('styles')

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

<div class="boxed_wrapper">
    <!-- search-popup -->
    <div id="search-popup" class="search-popup">
        <div class="close-search"><span>Close</span></div>
        <div class="popup-inner">
            <div class="overlay-layer"></div>
            <div class="search-form">
                <form method="get" action="{{route('global_search')}}">
                    <div class="form-group">
                        <fieldset>
                            <input type="search" class="form-control" name="search-input" value="" placeholder="Search Here" required autocomplete="off" >
                            <input type="submit" value="Search Now!" class="theme-btn style-four">
                        </fieldset>
                    </div>
                </form>
                {{--<h3>Recent Search Keywords</h3>
                <ul class="recent-searches">
                    <li><a href="">Finance</a></li>
                    <li><a href="">Idea</a></li>
                    <li><a href="">Service</a></li>
                    <li><a href="">Growth</a></li>
                    <li><a href="">Plan</a></li>
                </ul>--}}
            </div>
        </div>
    </div>
    <!-- search-popup end -->


    <!-- sidebar cart item -->
    <div class="xs-sidebar-group info-group info-sidebar">
        <div class="xs-overlay xs-bg-black"></div>
        <div class="xs-sidebar-widget">
            <div class="sidebar-widget-container">
                <div class="widget-heading">
                    <a href="#" class="close-side-widget"><i class="fal fa-times"></i></a>
                </div>
                <div class="sidebar-textwidget">
                    <div class="sidebar-info-contents">
                        <div class="content-inner">
                            <div class="logo">
                                <a href="{{ url('/') }}"><img src="{{asset('sitesetting_images/thumb/'.$siteSetting->site_logo)}}" alt="" /></a>
                            </div>
                            <div class="content-box">
                                <h4>Book Now</h4>
                                <form action="" method="post" class="booking-form">
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="Name" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Email" required="">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" placeholder="Text"></textarea>
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit">Send Now</button>
                                    </div>
                                </form>
                            </div>
                            <div class="contact-info">
                                <h4>Contact Info</h4>
                                <ul>
                                    <li>{{$siteSetting->site_name}}</li>
                                    <li>{{$siteSetting->site_street_address}}</li>
                                </ul>
                            </div>
                            <ul class="social-box">
                                @if($siteSetting->facebook_address)
                                    <li class="facebook"><a  href="{{$siteSetting->facebook_address}}" class="fab fa-facebook-f"></a></li>
                                @endif
                                <li class="twitter"><a href="#" class="fab fa-twitter"></a></li>
                                <li class="linkedin"><a href="#" class="fab fa-linkedin-in"></a></li>
                                <li class="instagram"><a href="#" class="fab fa-instagram"></a></li>
                                @if($siteSetting->youtube_address)
                                    <li class="instagram"><a  href="{{$siteSetting->youtube_address}}" class="fab fa-youtube"></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END sidebar widget item -->


    <!-- main header -->
    <header class="main-header {{(Request::is('/'))?'style-two':'style-one'}}">
        <!-- header-top -->
        <div class="header-top">
            <div class="auto-container">
                <div class="top-inner clearfix">
                    <div class="left-column pull-left clearfix">
                        <ul class="info-list clearfix">
                            <li><i class="flaticon-phone-with-wire"></i>
                                {{$siteSetting->site_phone_primary}}
                            </li>
                            {{--                            <li><i class="flaticon-fast"></i> {{ date('D. M dS, Y')}} <span style="background-color: black; padding: 5px 10px;" id="time" class="time"></span> </li>--}}
                            <li><i class="flaticon-fast"></i> {{ date('D. M dS, Y')}} <span id="time" class="time"></span> </li>
                        </ul>
                    </div>
                    <div class="right-column pull-right clearfix">
                        <ul class="links-box clearfix">

                            {{--<li>
                                <a href="{{route('login')}}"><i class="fas fa-user-circle"></i> Athlete Login</a>
                            </li>--}}
                            <li>
                                <a href="{{route('financial_partner')}}"><i class="fas fa-user-circle"></i> Partner</a>
                            </li>
                            {{--                            <li><a href="{{route('faq')}}" >Faq’s</a></li>--}}
                            <li>
                                {{--                                <a href="{{route('club_find')}}" target="{{Request::is('club/find') ? '':'_blank'}}">Find A Club</a>--}}
                                <a href="{{route('club_find')}}">{{__('messages.Find_A_Club')}}</a>
                            </li>
                            <li>
                                <a href="{{route('event_calender')}}">Event Calendar</a>
                            </li>
                        </ul>
                        <ul class="social-links clearfix">

                            @if($siteSetting->facebook_address)
                                <li><a  target="_blank" href="{{$siteSetting->facebook_address}}"><i class="fab fa-facebook-f"></i></a></li>
                            @endif
                            @if($siteSetting->twitter_address)
                                <li><a  target="_blank" href="{{$siteSetting->twitter_address}}"><i class="fab fa-twitter"></i></a></li>
                            @endif
                            @if($siteSetting->google_plus_address)
                                <li><a  target="_blank" href="{{$siteSetting->google_plus_address}}"><i class="fab fa-google-plus-g"></i></a></li>
                            @endif
                            @if($siteSetting->instagram_address)
                                <li><a  target="_blank" href="{{$siteSetting->instagram_address}}"><i class="fab fa-instagram"></i></a></li>
                            @endif
                            @if($siteSetting->linkedin_address)
                                <li><a  target="_blank" href="{{$siteSetting->linkedin_address}}"><i class="fab fa-linkedin"></i></a></li>
                            @endif
                            @if($siteSetting->youtube_address)
                                <li><a  target="_blank" href="{{$siteSetting->youtube_address}}"><i class="fab fa-youtube"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    {{--        CUSTOM MENU START   --}}

    {{--<div id="banner">
        <a class="element" href="/">Home</a>
        <a class="element" href="/shop/">Shop</a>
        <a class="element" href="/our-story/">Our Story</a>
        <figure class="logo"><a href="{{ url('/') }}"><img src="{{asset('sitesetting_images/thumb/'.$siteSetting->site_logo)}}" alt=""></a></figure>

        <a class="element" href="/products/">Products</a>
        <a class="element" href="/contact-us/">Contact Us</a>
        <a class="element" href="/foundation/">Foundation</a>
    </div>--}}
    {{--        CUSTOM MENU END    --}}



    <!-- header-lower -->
        <div class="header-lower">
            <div class="auto-container">
                <div class="outer-box clearfix">
                    <div class="logo-box pull-left">
                        <figure class="logo"><a href="{{ url('/') }}"><img src="{{asset('sitesetting_images/thumb/'.$siteSetting->site_logo)}}" alt=""></a></figure>
                    </div>
                    <div class="menu-area clearfix pull-right">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler">
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                        </div>

                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    {{--<li class="{{Request::is('/')?'current':''}}">
                                        <a style="font-size: 20px" href="{{ url('/') }}"><i class="fas fa-home"></i></a>
                                    </li>--}}

                                    {{--@if($top_menu->page_slug=='about-us')--}}
                                    @if(count($show_in_top_menu)>0)
                                        <li class="dropdown {{Request::is('cms/about-us')?'current':''}} {{Route::is('committee.members')?'current':''}} {{Route::is('members.club')?'current':''}} {{Request::is('news-and-notice/notice')?'current':''}}">
                                            <a href="javascript:void(0)">The BSSF</a>
                                            <ul>
                                                <li><a href="{{route('arms')}}">{{__('messages.Arms')}}</a></li>
                                                @foreach($show_in_top_menu as $top_menu)

                                                    @php $cmsContent = App\CmsContent::getContentBySlug($top_menu->page_slug); @endphp

                                                    @if($top_menu->page_slug != 'contact-us')
                                                        <li class="{{Request::is('cms/'.$top_menu->page_slug)?'current':''}}">
                                                            <a href="{{ route('cms', $top_menu->page_slug) }}">
                                                                {{ isset($cmsContent)?$cmsContent->page_title:''}}
                                                            </a>
                                                        </li>
                                                    @endif

                                                @endforeach
                                                <li><a href="{{route('faq')}}">FAQ’s</a></li>
                                            </ul>
                                        </li>
                                    @endif

                                    <li class="dropdown">
                                        <a href="javascript:void(0)">Members</a>
                                        <ul>
                                            <li class="{{Request::is('committee/executive-committee')?'current':''}}">
                                                <a href="{{ route('committee.members', 'executive-committee') }}">Executive Committee</a>
                                            </li>
                                            <li class="{{Request::is('committee/sub-committee')?'current':''}}">
                                                <a href="{{ route('committee.members', 'sub-committee') }}">Sub Committees</a>
                                            </li>
                                            <li class="{{Request::is('committee/camp-commandant-coach')?'current':''}}">
                                                <a href="{{ route('committee.members', 'camp-commandant-coach') }}">Camp Commandant & Coach</a>
                                            </li>
                                            <li class="{{Request::is('committee/office-administration')?'current':''}}">
                                                <a href="{{ route('committee.members', 'office-administration') }}">Office Administration</a>
                                            </li>
                                            <li class="{{Request::is('judges-jury')?'current':''}}">
                                                <a href="{{ route('judges_jury') }}">{{__('messages.Judges_Jury')}}</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <a href="javascript:void(0)">{{ __('messages.Athlete') }}</a>
                                        <ul>
                                            <li>
                                                <a href="{{ route('athlete','Pistol') }}">Pistol Athletes</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('athlete','Rifle') }}">Rifle Athletes</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('athlete','Short') }}">Short Gun Athletes</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('athlete','Disabled') }}">Handicapped Athletes</a>
                                            </li>
                                            {{--<li>
                                                <a href="{{ url('register') }}">Register</a>
                                            </li>--}}
                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <a href="javascript:void(0)">News & Press</a>
                                        <ul>
                                            <li class="{{Request::is('news-and-notice/news')?'current':''}}">
                                                <a href="{{ route('news.list') }}">News</a>
                                                {{--                                                    <a href="{{ route('news.list') }}" target="{{Request::is('news-and-notice/news') ? '':'_blank'}}">News</a>--}}
                                            </li>

                                            <li class="{{Request::is('news-and-notice/notice')?'current':''}}">
                                                {{--                                                    <a href="{{ route('notice.list') }}" target="{{Request::is('news-and-notice/notice') ? '':'_blank'}}">Notice</a>--}}
                                                <a href="{{ route('notice.list') }}">Notice</a>
                                            </li>
                                        </ul>
                                    </li>
                                    @php
                                        $getTopEvent = \App\Models\Event::getTopEvent();
                                    @endphp
                                    @if(!is_null($getTopEvent))
                                    <li>

                                        <a href="{{route('event_details',$getTopEvent->id)}}"> Events</a>
                                    </li>
                                    @endif

                                    <li>
                                        {{--                                            <a href="{{route('archive_index')}}" target="{{Request::is('archives') ? '':'_blank'}}">Archives</a>--}}
                                        <a href="{{route('archive_index')}}">{{__('messages.Archives')}}</a>
                                    </li>

                                    <li>
                                        {{--                                        <a href="{{route('photo_gallery')}}" target="{{Request::is('/gallery') ? '':'_blank'}}">Gallery</a>--}}
                                        <a href="{{route('photo_gallery')}}">Gallery</a>
                                    </li>

                                    @foreach($show_in_top_menu as $top_menu)
                                        @php $cmsContent = App\CmsContent::getContentBySlug($top_menu->page_slug); @endphp
                                        @if($top_menu->page_slug =='contact-us')
                                            <li>
                                                {{--                                            <a href="{{ route('cms','contact-us') }}" target="{{Request::is('cms/contact-us') ? '':'_blank'}}">{{ isset($cmsContent)?$cmsContent->page_title:'' }}</a>--}}
                                                <a href="{{ route('cms','contact-us') }}">{{ isset($cmsContent)?$cmsContent->page_title:'' }}</a>
                                            </li>
                                        @endif

                                    @endforeach

                                </ul>
                            </div>
                        </nav>
                        <div class="menu-right-content clearfix">
                            <div class="language-box">
                                <?php
                                $current_locale = app()->getLocale();
                                $available_locales = config('app.available_locales');
                                $key = array_search ($current_locale, $available_locales);
                                ?>
                                <span class="text"><i class="flaticon-world"></i>{{ $key == 'English'?'Eng':'Bng' }}</span>
                                <ul class="language-list clearfix">
                                    @foreach($available_locales as $locale_name => $available_locale)
                                        <li><a href="{{route('language_switcher',$available_locale)}}">{{ $locale_name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>

                            <ul class="other-option clearfix">
                                <li class="search-btn">
                                    <button type="button" class="search-toggler"><i class="far fa-search"></i></button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- header-down -->

        @if(Request::is('/'))
            @if(isset($stickyNewsAndNotice))
                <div class="header-down">
                    <div class="auto-container">
                        <div class="inner-box clearfix">
                            <div class="update-box"><h6><i class="flaticon-newspaper"></i>Latest News</h6></div>
                            <div class="live-news">
                                <div class="news-carousel owl-carousel owl-theme owl-dots-none">

                                    @foreach($stickyNewsAndNotice as $notice)
                                        @php
                                            if ($notice->post_type == 'NEWS'){
                                                $stickyUrl = 'news.details';
                                            }else{
                                                $stickyUrl = 'notice.details';
                                            }
                                        @endphp
                                        <div class="text">
                                            <a  href="{{route($stickyUrl,$notice->id)}}"><p>{!!\Illuminate\Support\Str::words($notice->title, 12,'..') !!}</p></a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{--                            <div class="weathre-box"><i class="flaticon-sunny-day-or-sun-weather"></i><a href="">Today: 32 0C / 65 0F</a></div>--}}
                        </div>
                    </div>
                </div>
        @endif

    @endif


    <!--sticky Header-->
        <div class="sticky-header">
            <div class="auto-container">
                <div class="outer-box clearfix">
                    <div class="logo-box pull-left">
                        <figure class="logo">
                            <a href="{{ url('/') }}"><img src="{{asset('sitesetting_images/thumb/'.$siteSetting->site_logo)}}" alt=""></a>
                        </figure>
                    </div>
                    <div class="menu-area clearfix pull-right">
                        <nav class="main-menu clearfix">
                            <!--Keep This Empty / Menu will come through Javascript-->
                        </nav>
                        <div class="menu-right-content clearfix">
                            <div class="language-box">
                                <?php
                                $current_locale = app()->getLocale();
                                $available_locales = config('app.available_locales');
                                $key = array_search ($current_locale, $available_locales);
                                ?>
                                <span class="text"><i class="flaticon-world"></i>{{ $key == 'English'?'Eng':'Bng' }}</span>
                                <ul class="language-list clearfix">
                                    @foreach($available_locales as $locale_name => $available_locale)
                                        <li><a href="{{route('language_switcher',$available_locale)}}">{{ $locale_name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- main-header end -->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><i class="fas fa-times"></i></div>

        <nav class="menu-box">
            <div class="nav-logo"><a href=""><img src="{{asset('sitesetting_images/thumb/'.$siteSetting->site_logo)}}" alt="" title=""></a></div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            <div class="contact-info">
                <h4>Contact Info</h4>
                <ul>
                    <li>{{$siteSetting->site_name}}</li>
                    <li>{{$siteSetting->site_street_address}}</li>
                </ul>
            </div>
            <div class="social-links">
                <ul class="clearfix">
                    <li><a href=""><span class="fab fa-twitter"></span></a></li>
                    @if($siteSetting->facebook_address)
                        <li><a  href="{{$siteSetting->facebook_address}}"><span class="fab fa-facebook-square"></span></a></li>
                    @endif
                    <li><a href=""><span class="fab fa-pinterest-p"></span></a></li>
                    <li><a href=""><span class="fab fa-instagram"></span></a></li>
                    @if($siteSetting->youtube_address)
                        <li><a  href="{{$siteSetting->youtube_address}}"><span class="fab fa-youtube"></span></a></li>
                    @endif
                </ul>
            </div>
        </nav>
    </div><!-- End Mobile Menu -->



@yield('content')


<!-- main-footer -->
    <footer class="main-footer">
        <div class="footer-top-two footer-custom-padding">
            <div class="auto-container">
                <div class="row footer-custom-border" >
                    <div class=" col-md-4 footer-column" style="text-align: center">
                        <div class="footer-widget logo-widget">
                            <figure class="footer-logo"><a href="{{url('/')}}"><img class="footer-logo-image" src="{{asset('sitesetting_images/thumb/'.$siteSetting->site_logo)}}" alt=""></a></figure>
                            <div class="text">
                                <p class="footer-site-name">{{$siteSetting->site_name}}</p>
                                <p>{{$siteSetting->site_street_address}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 footer-column">
                        <div class="footer-widget links-widget">
                            <div class="widget-title">
                                <h4>Useful links</h4>
                            </div>
                            <div class="widget-content">
                                <ul class="links-list clearfix" style="border-bottom: 0px">
                                    <li><a href="{{route('athlete','Pistol')}}">Athletes Pistol</a></li>
                                    <li><a href="{{route('athlete','Rifle')}}">Athletes Rifle</a></li>
                                    @if(!is_null($getTopEvent))<li><a href="{{route('event_details',$getTopEvent->id)}}"> Events</a></li>@endif
                                    <li><a href="{{route('archive_index')}}">{{__('messages.Archives')}}</a></li>
                                    <li><a href="{{route('club_find')}}">Clubs</a></li>
                                    <li><a href="{{route('faq')}}">FAQ</a></li>
                                    @if(count($show_in_footer_menu)>0)
                                        @foreach($show_in_footer_menu as $footerMenu)
                                            @php $cmsContent = App\CmsContent::getContentBySlug($footerMenu->page_slug); @endphp
                                            <li>
                                                <a href="{{route('cms', $footerMenu->page_slug)}}">
                                                    {{ isset($cmsContent)?$cmsContent->page_title:'' }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 footer-column">
                        <div class="footer-widget post-widget">
                            <div class="widget-title">
                                <h4>Recent News & Notices</h4>
                            </div>
                            <div class="widget-content">
                                <div class="post-inner footer-border-inner">
                                    @php
                                        $recentNews = App\Models\NewsAndNotice::getLatestNews(2);
                                    @endphp
                                    @if($recentNews && count($recentNews)>0)
                                        @foreach($recentNews as $recentnew)
                                            <div class="post">
                                                <div class="post-date"><h3>{{$recentnew->created_at->format('d')}}<span>{{$recentnew->created_at->format("M'Y")}}</span></h3></div>
                                                <h5>
                                                    {{--                                                    <a style="font-size: 15px" href="{{route('news.details',$recentnew->id)}}" target="{{Request::is('/') ? '_blank':''}}">{!!\Illuminate\Support\Str::words($recentnew->title, 10,'..') !!}</a>--}}
                                                    <a style="font-size: 15px" href="{{route('news.details',$recentnew->id)}}">{!!\Illuminate\Support\Str::words($recentnew->title, 10,'..') !!}</a>
                                                </h5>
                                                <p><i class="far fa-user"></i>{{$recentnew->createdBy->name}}</p>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix" style="padding-top: 15px;">
                    <div class="col-md-12 col-sm-12 footer-column">
                        <div class="footer-widget links-widget">
                            <div class="widget-content">
                                <ul class="social-box clearfix">
                                    <div class="row mb-5">
                                        @if($siteSetting->facebook_address)
                                            <div class="col-md-3 mb-2">
                                                <li>
                                                    <a  href="{{$siteSetting->facebook_address}}" style="background: #1877F2" target="_blank">
                                                        <i class="fab fa-facebook-f"></i><span>Visit</span>Facebook
                                                    </a>
                                                </li>
                                            </div>
                                        @endif

                                        @if($siteSetting->youtube_address)
                                            <div class="col-md-3 mb-2">
                                                <li>
                                                    <a  href="{{$siteSetting->youtube_address}}"  target="_blank"
                                                        style="background: #c13232"><i class="fab fa-youtube"></i><span>Visit</span>Youtube</a>
                                                </li>
                                            </div>
                                        @endif

                                        @if($siteSetting->linkedin_address)
                                            <div class="col-md-3 mb-2">
                                                <li>
                                                    <a  href="{{$siteSetting->linkedin_address}}"  target="_blank"
                                                        style="background: #0B66C2">
                                                        <i class="fab fa-linkedin"></i><span>Visit</span>Linkedin</a>
                                                </li>
                                            </div>
                                        @endif

                                        <div class="col-md-3">
                                            <li>
                                                <a  href="#" style="background: #c13232"><i class="fas fa-restroom" ></i><span>
                                                        {{ \App\Models\VisitorCount::visitorDataInsert()  }}</span>Visitors</a>
                                            </li>
                                        </div>

                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="footer-bottom alternat-2">
            <div class="auto-container">
                <div class="bottom-inner clearfix">
                    {{--                    <div class="copyright pull-left">--}}
                    <div class="copyright text-center">
                        <p>&copy; {{ date('Y')}} By {{ $siteSetting->site_name }}.  All Rights Reserved. </p>
                    </div>
                    {{--<ul class="footer-nav clearfix pull-right">
                        <li><a href="{{route('faq')}}">FAQ’s</a></li>
                        <li><a href="">Covid’19 Updates </a></li>
                        <li><a href="">Government</a></li>
                    </ul>--}}
                </div>
            </div>
        </div>
    </footer>
    <!-- main-footer end -->



    <!--Scroll to top-->
    <button class="scroll-top scroll-to-target" data-target="html">
        <span class="fas fa-angle-up"></span>
    </button>
</div>


<!-- jequery plugins -->
<script src="{{asset('assets/js/jquery.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/owl.js')}}"></script>
<script src="{{asset('assets/js/wow.js')}}"></script>
<script src="{{asset('assets/js/validation.js')}}"></script>
<script src="{{asset('assets/js/jquery.fancybox.js')}}"></script>
<script src="{{asset('assets/js/appear.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.js')}}"></script>
{{--<script src="{{asset('assets/js/timePicker.js')}}"></script>--}}
<script src="{{asset('assets/js/scrollbar.js')}}"></script>
<script src="{{asset('assets/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('assets/js/nav-tool.js')}}"></script>
<script src="{{asset('assets/js/bxslider.js')}}"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>

<!-- main-js -->
<script src="{{asset('assets/js/script.js')}}"></script>


@stack('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        setInterval(runningTime, 1000);
    });
    function runningTime() {
        $.ajax({
            url: "{{route('digital_clock')}}",
            success: function(data) {
                $('#time').html(data);
            },
        });
    }
</script>
</body>

</html>
@endif