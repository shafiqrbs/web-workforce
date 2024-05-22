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
                    <li><a href="{{route('judges_jury')}}">{{$pageTitle}}</a></li>
                    @if($pathPageTitle)
                        <li><a href="{{route('judges_jury')}}">{{$pathPageTitle}}</a></li>
                    @endif
                    @if($juryData['name'])
                        <li>{{$juryData['name']}}</li>
                    @endif
                </ul>
            </div>
        </div>
    </section>

    <!-- Athelete details start -->
    <section class="solutions-section">
        <figure class="image-layer custom-image-layer">
            @if($img=$juryData['profile_image'])
                {{ ImgUploader::print_image("jury/mid/$img") }}
            @else
                <img src="{{asset('assets/no-image.jpeg')}}" alt="">
            @endif
        </figure>
        <div class="auto-container">
            <div class="sec-title centred">
                <h6><i class="flaticon-star"></i><span>{{$juryData['name']}}</span><i class="flaticon-star"></i></h6>
                <h2>{{$pageTitle}}</h2>
                <div class="title-shape"></div>
            </div>
            <div class="inner-container">
                <div class="upper-box clearfix">
                    {{--<div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.Mobile_Number')}}</h4>
                            <p>{{$juryData['mobile']}}</p>
                        </div>
                    </div>--}}
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.Email')}}</h4>
                            <p>{{$juryData['email']}}</p>
                        </div>
                    </div>
                   {{-- <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.ISSF_License_No')}}</h4>
                            <p>{{$juryData['issf_license_no']}}</p>
                        </div>
                    </div>--}}
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.License_Valid_Date')}}</h4>
                            <p>{{$juryData['license_valid_date']}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.Date_Of_Birth')}}</h4>
                            <p>{{$juryData['date_of_birth']}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.Jury_Class')}}</h4>
                            <p>{{$juryData['jury_class']}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.Address')}}</h4>
                            <p>{{$juryData['address']}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.Remarks')}}</h4>
                            <p>{{$juryData['remark']}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                        </div>
                    </div>
                </div>
<hr>
                <div class="upper-box clearfix">
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <h4>{{__('messages.Rifle')}} ? </h4>
                            <p>{{$juryData['is_rifle'] && $juryData['is_rifle']==1?__('messages.YES'):__('messages.NO')}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <h4>{{__('messages.Pistol')}} ? </h4>
                            <p>{{$juryData['is_pistol'] && $juryData['is_pistol']==1?__('messages.YES'):__('messages.NO')}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <h4>{{__('messages.Shortgun')}} ? </h4>
                            <p>{{$juryData['is_short_gun'] && $juryData['is_short_gun']==1?__('messages.YES'):__('messages.NO')}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <h4>{{__('messages.RunningTarget')}} ? </h4>
                            <p>{{$juryData['is_running_target'] && $juryData['is_running_target']==1?__('messages.YES'):__('messages.NO')}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <h4>{{__('messages.ElectronicTarget')}} ? </h4>
                            <p>{{$juryData['is_electronic_target'] && $juryData['is_electronic_target']==1?__('messages.YES'):__('messages.NO')}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <h4>{{__('messages.TargetControl')}} ? </h4>
                            <p>{{$juryData['is_target_control'] && $juryData['is_target_control']==1?__('messages.YES'):__('messages.NO')}}</p>
                        </div>
                    </div>
                </div>
                @foreach($juryData['juryEvent'] as $juryEvent)
                    @if($juryEvent->event_name || $juryEvent->event_address )
                <div class="lower-box clearfix">
                    <div class="bg-layer" style="background-image: url(assets/images/background/bg-1.jpg);"></div>
                    <div class="text pull-left">
                        <div class="icon-box"><i class="flaticon-idea"></i></div>
                        <h3>{{$juryEvent->event_name?$juryEvent->event_name:''}}</h3>
                        <p>{{$juryEvent->event_address?$juryEvent->event_address:''}}</p>
                    </div>
                </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- Athelete details end -->

    <!-- testimonial-section -->
{{--    <section class="testimonial-section centred" style="background-image: url(assets/images/background/testimonial-bg.jpg);">--}}
    <section class="testimonial-section centred">
{{--        <h2 class="related-Athletes-title">Related Athletes</h2>--}}

        <div class="auto-container">

            <div class="three-item-carousel owl-carousel owl-theme owl-dots-none owl-nav-none">
                {{--@foreach($relatedAthletes as $related)
                    <a href="{{route('athlete_details',$related['id'])}}">
                <div class="testimonial-block-one">
                    <div class="inner-box">
                        <figure class="image-box custom-image-box">
                            @if($img=$related['profile_image'])
                                {{ ImgUploader::print_image("athlete_profile/$img") }}
                            @else
                                <img src="{{asset('assets/no-image.jpeg')}}" alt="">
                            @endif
                        </figure>

                        <div class="author-box">
                            <h4>{{$related['athlete_name']}}</h4>
                            <span class="designation">{{$related['hometown']}}</span>
                        </div>
                    </div>
                </div>
                    </a>
                @endforeach--}}
            </div>
        </div>
    </section>
    <!-- testimonial-section end -->

    {{--@include('includes.footer_social')--}}
@endsection

@push('styles')

@endpush
