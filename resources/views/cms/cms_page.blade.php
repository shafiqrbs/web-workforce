@extends('layouts.app')
@section('content')

@if(isset($bannerData) && !empty($bannerData))
    <section class="page-title" style="background-size: cover;background-image: url({{asset('banner/'.$bannerData->banner_image)}});">
        @else
            <section class="page-title" style="background-size: cover;background-image: url({{asset('banner/no-image.jpg')}});">
                @endif
                <div class="auto-container">
                    <div class="content-box">
                        <div class="title centred">
                            @if(isset($bannerData) && !empty($bannerData))
                                <h1>{{$bannerData->banner_title}}</h1>
                            @else
                                <h1>No Banner title</h1>
                            @endif
                        </div>
                        <ul class="bread-crumb clearfix">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li>{{$cmsContent->page_title}}</li>
                            @if(isset($pathPageTitle) && !empty($pathPageTitle))
                                <li>{{$pathPageTitle}}</li>
                            @endif
                            @if(isset($subPathPageTitle) && !empty($subPathPageTitle))
                                <li>{{$subPathPageTitle}}</li>
                            @endif

                        </ul>
                    </div>
                </div>
            </section>

<div class="page-contents">
    @if($cms->page_slug != 'how-it-works' and $cms->page_slug != 'contact-us')
        <section class="about-style-three sec-pad">
            <div class="auto-container">
                <div class="row clearfix align-items-center">
                    <div class="content_block_5">
                        <div class="content-box">
                            {!! $cmsContent->page_content !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">{!! $siteSetting->cms_page_ad !!}</div>
        <div class="col-md-3"></div>
    </div>

    @if($cms->page_slug == 'contact-us')
            <section class="faq-page-section sec-pad-contact">

                <div class="container">
                    @include('flash::message')
                    <div class="imr">
                        <div class="im-12">
                            <div class="main-body mt-0 pt-0">
                                {!! $cmsContent->page_content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </section>


                <!-- contact-style-two -->
            <section class="contact-style-two ">
                <div class="auto-container">
                    <div class="form-inner">
                        <div class="sec-title centred">
                            <h6><i class="flaticon-star"></i><span>Drop a Line</span><i class="flaticon-star"></i></h6>
                            <h2>We’re Here to Help You</h2>
                            <div class="title-shape"></div>
                            <p>Fill out this form to send your inquires or complaints to BSSF.</p>
                        </div>
                        <form method="POST" action="{{route('contact_form')}}" id="contact-form" class="default-form" autocomplete="off">
                            {{ csrf_field() }}
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 big-column">
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="Your Name" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Email Address" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="subject" required="" placeholder="Subject">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 big-column">
                                    <div class="form-group">
                                        <textarea name="message" placeholder="Write Your Message ..."></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 big-column">
                                    <div class="message-btn centred">
                                        <button class="theme-btn" type="submit" name="submit-form">Send Message</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="sec-title centred">
                        <h2>Site Map</h2>
                    </div>
                    <div class="map-inner" style="padding-bottom: 100px;">
                        <?php
                            echo  $siteSetting->site_google_map;
                        ?>
                        </div>
                </div>
            </section>

            @push('scripts')
                <script>



                </script>
            @endpush


    @endif

    @if($cms->page_slug == 'how-it-works')
        <div class="section white">
            <div class="container">
                <div class="imr">
                    <div class="im-12">
                        <div class="section-contents">
                            <video controls width="100%" height="500px" id="vid" src="{{ asset('/videos/videojp.mp4') }}"></video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>

    </section>

@endsection

@push('scripts')
    <!-- map script -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-CE0deH3Jhj6GN4YvdCFZS7DpbXexzGU"></script>
    <script src="{{asset('/')}}assets/js/gmaps.js"></script>
    <script src="{{asset('/')}}assets/js/map-helper.js"></script>
@endpush