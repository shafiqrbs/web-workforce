


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

    <link rel="shortcut icon" href="{{asset('assets/images/logo.png')}}">

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
   {{-- <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">--}}

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
    @include('layouts.header')
    @yield('content')
<!-- main-footer -->
@include('layouts.footer')
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
<!-- map script -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-CE0deH3Jhj6GN4YvdCFZS7DpbXexzGU"></script>
<script src="{{asset('assets/js/gmaps.js')}}"></script>
<script src="{{asset('assets/js/map-helper.js')}}"></script>
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