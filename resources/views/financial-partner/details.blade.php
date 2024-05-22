@extends('layouts.app')
@section('content')

    <section class="contact-style-two sec-pad custom-section-pad">
        <div class="auto-container">
            <div class="form-inner custom-form-inner-padding">
                <div class="sec-title centred">
                    <h3 class="header-color"><i class="flaticon-star"></i><span>{{$pageTitle}}</span><i
                                class="flaticon-star"></i></h3>
                </div>
            </div>


            <div class="overview-box">
                <div class="row clearfix">
                    <div class="col-lg-8 col-md-12 col-sm-12 big-column">
                        <div class="image-box">
                            <div class="row clearfix">

                                <div class="col-lg-6 col-md-6 col-sm-12 image-column">
                                    <figure class="image club-image-size">
                                        @if($img = $clubDetails['club_logo'])
                                            {{ ImgUploader::print_image("slider_images/thumb/$img") }}
                                        @else
                                            <img src="{{asset('assets/no-image.jpeg')}}" alt="">
                                        @endif
                                    </figure>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 sidebar-side ">
                                    <div class="blog-sidebar">
                                        <div class="sidebar-widget category-widget">
                                            <div class="widget-title">
                                                <h3>Club Overview</h3>
                                            </div>
                                            <div class="widget-content">
                                                <ul class="category-list clearfix">
                                                    <li><a>Name.<span>{{$clubDetails['name']}}</span></a></li>
{{--                                                    <li><a>Registration No.<span>{{$clubDetails['registration_number']}}</span></a></li>--}}
                                                    <li><a>Mobile<span>{{$clubDetails['mobile']}}</span></a></li>
                                                    <li><a>Email<span>{{$clubDetails['email']}}</span></a></li>
                                                    <li><a>Type<span>{{$clubDetails['club_type']}}</span></a></li>
                                                    <li><a>Address<span>{{$clubDetails['address']}}</span></a></li>
                                                    <li><a>Division<span>{{$division->division}}</span></a></li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side ">
                        <div class="blog-sidebar">
                            <div class="sidebar-widget category-widget">
                                <div class="widget-title">
                                    <h3>Categories</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="category-list clearfix">
                                        <li><a href="blog-details.html">Announcement<span>(10)</span></a></li>
                                        <li><a href="blog-details.html">Education<span>(06)</span></a></li>
                                        <li><a href="blog-details.html">Opportunities<span>(12)</span></a></li>
                                        <li><a href="blog-details.html">Public Information<span>(14)</span></a></li>
                                        <li><a href="blog-details.html">Regeneration<span>(05)</span></a></li>
                                        <li><a href="blog-details.html">Tourist Guide<span>(09)</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>



    {{--@include('includes.footer_social')--}}
@endsection

@push('styles')

@endpush
