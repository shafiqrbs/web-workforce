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
                                <li><a href="
                                    @if(isset($pageTitle))
                                        @if($pageTitle == 'Executive Committee')
                                            {{ route('committee.members', 'executive-committee') }}
                                        @elseif($pageTitle == 'Sub Committee')
                                            {{ route('committee.members', 'sub-committee') }}
                                        @elseif($pageTitle == 'Camp Commandant & Coach')
                                            {{ route('committee.members', 'camp-commandant-coach') }}
                                        @elseif($pageTitle == 'Office Administration')
                                            {{ route('committee.members', 'office-administration') }}
                                        @endif
                                    @endif
                                            ">{{'Details'}}</a></li>
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
                    <h3 class="header-color"><i class="flaticon-star"></i><span>{{'Details'}}</span><i
                                class="flaticon-star"></i></h3>
                </div>
            </div>


            <div class="overview-box">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 big-column">
                        <div class="image-box">
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-12 image-column">
                                    <figure class="image club-image-size">
                                        @if($img = $member['profile_image'])
                                            {{ ImgUploader::print_image("committee_member/mid/$img") }}
                                        @else
                                            <img src="{{asset('assets/no-image.jpeg')}}" alt="">
                                        @endif
                                    </figure>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 sidebar-side ">
                                    <div class="blog-sidebar">
                                        <div class="sidebar-widget category-widget">
                                            <div class="widget-title">
                                                <h3>Member Overview</h3>
                                            </div>
                                            <div class="widget-content">
                                                <ul class="category-list clearfix">
                                                    <li><a>Name.<span>{{$member['name']}}</span></a></li>
                                                    @if($pageTitle == 'DetailsOffice')
                                                        <li><a>Career Level<span>{{$committeeType}}</span></a></li>
                                                    @else
                                                        <li><a>Career Level</a><span>{{$committeeType}}</span></li>
                                                    @endif

                                                    <li><a>Mobile<span>{{$member['mobile']}}</span></a></li>
                                                    <li><a>Email<span>{{$member['email']}}</span></a></li>
                                                    <li><a>Address<span>{{$member['address']}}</span></a></li>
                                                    @if($member['facebook_link'])
                                                    <li><a href="{{$member['facebook_link']}}" ><u>Goto Facebook</u></a></li>
                                                    @endif
                                                    <li><a>Message<span>{{$member['short_message']}}</span></a></li>
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
        </div>
    </section>
@endsection

@push('styles')

@endpush
