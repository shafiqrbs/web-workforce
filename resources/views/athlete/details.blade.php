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
                    @if($pathPageTitle)
                        <li><a href="{{route('athlete',$pathPageTitle)}}">{{$pathPageTitle}}</a></li>
                    @endif
                    @if($athleteData['athlete_name'])
                        <li>{{$athleteData['athlete_name']}}</li>
                    @endif
                </ul>
            </div>
        </div>
    </section>

    <!-- Athelete details start -->
    <section class="solutions-section">
        <figure class="image-layer custom-image-layer">
            @if($img=$athleteData['profile_image'])
                {{ ImgUploader::print_image("athlete_profile/mid/$img") }}
            @else
                <img src="{{asset('assets/no-image.jpeg')}}" alt="">
            @endif
        </figure>
        <div class="auto-container">
            <div class="sec-title centred">
                <h6><i class="flaticon-star"></i><span>{{$athleteData['athlete_type'].' Athlete'}}</span><i class="flaticon-star"></i></h6>
                <h2>{{$pageTitle}} Details</h2>
                <div class="title-shape"></div>
            </div>
            <div class="inner-container">
                <div class="upper-box clearfix">
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>Mobile</h4>
                            <p>{{$athleteData['mobile']}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>Email</h4>
                            <p>{{$athleteData['email']}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>Date of Birth</h4>
                            <p>{{$athleteData['date_of_birth']}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>Age</h4>
                            <p>{{$athleteData['age']}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>Gender</h4>
                            <p>{{$gender['gender']}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>Address</h4>
                            <p>{{$athleteData['address']}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>Blood Group</h4>
                            <p>{{(isset($bloodGroup['blood_group']) && !empty($bloodGroup['blood_group']))?$bloodGroup['blood_group']:''}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>Profession</h4>
                            <p>{{$profession->profession}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>Home Town</h4>
                            <p>{{$athleteData['hometown']}}</p>
                        </div>
                    </div>
                </div>
                @foreach($athleteData['athleteCompetition'] as $competition)
                <div class="lower-box clearfix">
{{--                    <div class="bg-layer" style="background-image: url(assets/images/background/bg-1.jpg);"></div>--}}
                    <div class="text pull-left">
                        <div class="icon-box"><i class="flaticon-idea"></i></div>
                        <h3>{{$competition->competition_name.' in event '.$competition->competition_event.' & get score '.$competition->score}}</h3>
                        <p>{{$competition->competition_date}}</p>
                    </div>
                    <div class="btn-box pull-right">
                        <a href="#" class="theme-btn">Position {{$competition->position}}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Athelete details end -->

    <!-- testimonial-section -->
{{--    <section class="testimonial-section centred" style="background-image: url(assets/images/background/testimonial-bg.jpg);">--}}
    <section class="testimonial-section centred">
        <h2 class="related-Athletes-title">Related Athletes</h2>

        <div class="auto-container">

            <div class="three-item-carousel owl-carousel owl-theme owl-dots-none owl-nav-none">
                @foreach($relatedAthletes as $related)
                    <a href="{{route('athlete_details',$related['id'])}}">
                <div class="testimonial-block-one">
                    <div class="inner-box">
                        <figure class="image-box custom-image-box">
                            @if($img=$related['profile_image'])
                                {{ ImgUploader::print_image("athlete_profile/thumb/$img") }}
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
                @endforeach
            </div>
        </div>
    </section>
    <!-- testimonial-section end -->

    {{--@include('includes.footer_social')--}}
@endsection

@push('styles')

@endpush
