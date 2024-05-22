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
                    <li><a href="{{route('club_find')}}" >{{$pageTitle}}</a></li>
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


    <section class="contact-style-two custom-section-pad">
        <div class="auto-container">
            {{--<div class="form-inner custom-form-inner-padding">
                <div class="sec-title centred">
                    <h3 class="header-color"><i class="flaticon-star"></i><span>{{$pageTitle}}</span><i
                                class="flaticon-star"></i></h3>
                </div>
            </div>--}}


            <div class="overview-box">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 big-column">
                        <div style="padding-bottom: 50px;">
                            <?php echo $clubDetails['about_club']?>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-12 image-column">
                                <figure class="image club-image-size">
                                    @if($img = $clubDetails['club_logo'])
                                        {{ ImgUploader::print_image("club/mid/$img") }}
                                    @else
                                        <img src="{{asset('assets/no-image.jpeg')}}" alt="">
                                    @endif
                                </figure>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12 sidebar-side ">
                                <div class="blog-sidebar">
                                    <div class="sidebar-widget category-widget">
                                        <div class="widget-title">
                                            <h3>{{__('messages.Club_Overview')}}</h3>
                                        </div>
                                        <div class="widget-content">
                                            <ul class="category-list clearfix">
                                                <li><a>{{__('messages.Name')}}<span>{{$clubDetails['name']}}</span></a></li>
                                                <li><a>{{__('messages.Short_Name')}}<span>{{$clubDetails['short_name']}}</span></a></li>
{{--                                                    <li><a>Registration No.<span>{{$clubDetails['registration_number']}}</span></a></li>--}}
                                                <li><a>{{__('messages.Mobile_Number')}}<span>{{$clubDetails['mobile']}}</span></a></li>
                                                <li><a>{{__('messages.Email')}}<span>{{$clubDetails['email']}}</span></a></li>
                                                <li><a>{{__('messages.Club_Type')}}<span>{{$clubDetails['club_type']}}</span></a></li>
                                                <li><a>{{__('messages.Address')}}<span>{{$clubDetails['address']}}</span></a></li>
                                                <li><a>{{__('messages.Division')}}<span>{{$division->division}}</span></a></li>

                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')

@endpush
