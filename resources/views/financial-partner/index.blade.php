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
                                <li>{{$pageTitle}}</li>
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


                <div class="row">
                    {{--<div class="col-md-12">
                        <h5 class="club-found-message">{{$message}}</h5>
                    </div>--}}
                    @if($partnerData)
                    @foreach($partnerData as $value)

                        <div class="col-md-3">
                            <div class="explore-block-two margin-bottom-50">
                                <div class="inner-box fartner-index">
{{--                                    <figure class="image-box">--}}
                                        @if($img=$value['profile_image'])
                                            {{ ImgUploader::print_image("financial_partner/mid/$img") }}
                                        @else
                                            <img src="{{asset('assets/no-image.jpeg')}}" alt="">
                                        @endif
{{--                                    </figure>--}}
                                    <div class="content-box">
{{--                                        <div class="icon-box"><i class="flaticon-police"></i></div>--}}
                                        <h4 class="text-center">{{$value['name']}}</h4>
                                    </div>
                                    <a href="{{$value['facebook_link']}}" >
                                        <div class="overlay-content">
                                            <p class="text-center">{{$value['name']}}</p>
                                            <div class="text">
                                                <h4 class="text-center">{{$value['address']}}</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endif
                </div>
        </div>
    </section>



    {{--@include('includes.footer_social')--}}
@endsection

@push('styles')

@endpush
