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
                    <li><a href="{{url('/')}}">{{__('messages.Home')}}</a></li>
                    <li>{{$pageTitle}}</li>
                    @if($pathPageTitle)
                        <li>{{$pathPageTitle}}</li>
                    @endif
                </ul>
            </div>
        </div>
    </section>

    <section class="contact-style-two sec-pad custom-section-pad">
        <div class="auto-container">
            <div class="form-inner custom-form-inner-padding">
                <div class="sec-title centred">
                    <h3 class="header-color"><i class="flaticon-star"></i><span>{{$pathPageTitle.' '.$pageTitle}}</span><i
                                class="flaticon-star"></i></h3>
                </div>
            </div>


                <div class="row">
                    @if($armsData)
                    @foreach($armsData as $value)
                        <div class="col-md-3">
                            <div class="explore-block-two margin-bottom-50">
                                <div class="inner-box text-center">
                                    <figure class="image-box">
                                        @if($img=$value['arms_image'])
                                            {{ ImgUploader::print_image("arms/mid/$img") }}
                                        @else
                                            <img src="{{asset('assets/no-image.jpeg')}}" alt="">
                                        @endif
                                    </figure>
                                    <div class="content-box">
                                        <h4 class="text-center">{{$value['name']?$value['name']:null}}</h4>
                                    </div>
                                    <a href="{{route('arms_details',$value['id'])}}">
                                        <div class="overlay-content">
                                            <div class="icon-box">{{ ImgUploader::print_image("arms/thumb/$img") }}</div>
                                            <div class="text">
                                                <h4 class="text-center">{{$value['name']}}<br>{{$value['mobile']}}
                                                </h4>
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
