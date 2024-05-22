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
                                <li>Member</li>
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

    <!-- explore-style-two -->
    <section class="explore-style-two sec-pad-committee-section centred">
        <div class="auto-container">
            <div class="sec-title centred">
                <h3 class="header-color"><i class="flaticon-star"></i><span>{{$pageTitle}}</span><i class="flaticon-star"></i></h3>
            </div>
            @if($committeeType=='sub-committee')
                @if($committeeMembers)

                    @foreach($committeeMembers as $subCommitteeName=>$subCommittees)
                        <div class="centred margin-bottom-10">
                            <h4>{{$subCommitteeGroups[$subCommitteeName]}} Sub Committee</h4>
                        </div>
                        @foreach($subCommittees as $committeeType=>$members)
                            <div class="sec-title centred margin-bottom-20">
                                <h5 class="margin-bottom-10">{{$committeeType}}</h5>
                                <div class="title-shape"></div>
                            </div>
                            <div class="row">
                                @foreach($members as $member)
                                    <div class="col-md-3 auto-center">
                                        <div class="explore-block-two margin-bottom-50">
                                            <div class="inner-box">
                                                <figure class="image-box">
                                                    @if($member['profile_image'])
                                                        {{ ImgUploader::print_image("committee_member/mid/".$member['profile_image']) }}
                                                    @else
                                                        <img src="{{asset('assets/no-image.jpeg')}}" alt="">
                                                    @endif

                                                </figure>
                                                <div class="content-box">
                                                    <h4>{{$member['name']}}</h4>
                                                </div>
                                                    @if($type == 'office-administration')
                                                        <a href="{{route('committee_members_detais_office',$member['id'])}}">
                                                    @else
                                                        <a href="{{route('committee_members_detais',$member['member_id'])}}">
                                                    @endif
                                                <div class="overlay-content">
                                                    <div class="icon-box">{{ ImgUploader::print_image("committee_member/".$member['profile_image']) }}</div>
{{--                                                    <p>{{$member['short_message']}}</p>--}}
                                                    <div class="text">
                                                        <h4>{{$member['name']}}</h4>
                                                    </div>
                                                </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        @endforeach
                    @endforeach
                @endif
            @else
            @if($committeeMembers)
                @foreach($committeeMembers as $committeeType=>$members)
                    <div class="sec-title centred margin-bottom-20">
                        <h4 class="margin-bottom-10">{{$committeeType}}</h4>
                        <div class="title-shape"></div>
                    </div>
                    <div class="row">
                        @foreach($members as $member)
                            <div class="col-md-3 auto-center">
                                <div class="explore-block-two margin-bottom-50">
                                    <div class="inner-box">
                                        <figure class="image-box">
                                            @if($member['profile_image'])
                                            {{ ImgUploader::print_image("committee_member/mid/".$member['profile_image']) }}
                                            @else
                                                <img src="{{asset('assets/no-image.jpeg')}}" alt="">
                                            @endif

                                        </figure>
                                        <div class="content-box justify-content-center align-self-center">
                                            <h4>{{$member['name']}}</h4>
                                        </div>

                                        @if($type == 'office-administration')
                                            <a href="{{route('committee_members_detais_office',$member['id'])}}">
                                            @else
                                                <a href="{{route('committee_members_detais',$member['member_id'])}}">
                                        @endif
                                        <div class="overlay-content">
                                            <div class="icon-box">{{ ImgUploader::print_image("committee_member/thumb/".$member['profile_image']) }}</div>
{{--                                            <p>{{$member['short_message']}}</p>--}}
                                            <div class="text">
                                                <h4>{{$member['name']}}</h4>
                                            </div>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @endforeach

            @endif
            @endif
        </div>
    </section>
    <!-- explore-style-two end -->

    {{--@include('includes.footer_social')--}}
@endsection

@push('styles')
    <style>
        .auto-center{
            float: none;
            margin: 0 auto;
        }
    </style>
@endpush
