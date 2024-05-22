@extends('layouts.app')
@section('content')

                    @if(isset($bannerData) && !empty($bannerData))
                    <section class="page-title" style="background-image: url({{asset('banner/'.$bannerData->banner_image)}});">
                    @else
                    <section class="page-title" style="background-image: url({{asset('banner/no-image.jpg')}});">
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
                                <li><a href="" >{{$pageTitle}}</a></li>
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


    <section class="contact-style-two sec-pad custom-section-pad">
        <div class="auto-container">
            <div class="form-inner custom-form-inner-padding">
                <div class="sec-title centred">
                    <h3 class="header-color"><i class="flaticon-star"></i><span>{{$pageTitle}}</span><i
                                class="flaticon-star"></i></h3>
                </div>
            </div>
        </div>
    </section>


    @if($getTopEvent && $getAllEvent)
    <!-- EVENT START -->
    <section class="service-style-two bg-color-3">
        <div class="outer-container">
            <div class="bg-layer" style="background-image: url({{asset('event/thumb/'.$getTopEvent->event_image)}});"></div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12 col-sm-12 content-column">
                        <div class="content_block_2">
                            <div class="content-box">
                                <div class="sec-title light">
                                    <h6><i class="flaticon-star"></i><span>{{$getTopEvent->event_type}}</span></h6>
                                    <h2><a href="{{route('event_details',$getTopEvent->id)}}"  style="color: #fff;">{{$getTopEvent->event_name}}</a></h2>
                                    <div class="title-shape"></div>
                                </div>
                                <div class="text">
                                    <p>{{ substr($getTopEvent->event_message, 0,  150) }}</p>
                                    <a href="{{route('event_details',$getTopEvent->id)}}"  class="theme-btn style-two">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 inner-column">
                        <div class="inner-content centred">
                            <div class="four-item-carousel owl-carousel owl-theme owl-dots-none owl-nav-none">

                                @foreach($getAllEvent as $event)
                                <div class="service-block-two">
                                    <div class="inner-box">
                                        <div class="text">
                                            <h6>{{$event->event_type}}</h6>
                                            <h4><a  href="{{route('event_details',$event->id)}}">{{$event->event_name}}</a></h4>
                                            <div class="icon-box"><P style="font-size: 10px;font-weight: bold">UPCOMING</P></div>
                                        </div>
                                        <div class="link"><a  href="{{route('event_details',$event->id)}}">+</a></div>
                                        <figure class="image-box"><img src="{{asset('event/thumb/'.$event->event_image)}}" alt=""></figure>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- EVENT END -->

    @endif



    {{--@include('includes.footer_social')--}}
@endsection

@push('styles')

@endpush
