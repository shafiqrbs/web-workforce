@extends('admin.layouts.admin_layout')
@section('content')
<div class="page-content-wrapper"> 
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content"> 
        <!-- BEGIN PAGE HEADER--> 
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>
                <li> <a href="{{ route('employer.list.users') }}">Employer</a> <i class="fa fa-circle"></i> </li>
                <li> <span>Employer Profile</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR --> 
        <!-- BEGIN PAGE TITLE-->
        <!--<h3 class="page-title">Edit User <small>Users</small> </h3>-->
        <!-- END PAGE TITLE--> 
        <!-- END PAGE HEADER-->
        <br />
        @include('flash::message')
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo"> <i class="icon-settings font-red-sunglo"></i> <span class="caption-subject bold uppercase">User Details</span></div>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('employer.list.users') }}"><i class="fa fa-arrow-left"></i> Back</a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="usercoverimg">
                            <div class="userMaininfo">
                                <div class="userPic">{{$user->printUserImage()}}</div>
                                <div class="title">
                                    <h3>
                                        {{$user->getName()}}
                                    </h3>
                                    @if($user->getLocation())
                                        <div class="desi">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i> {{$user->getLocation()}}
                                        </div>
                                    @endif
                                    <div class="membersinc"><i class="fa fa-history" aria-hidden="true"></i> {{__('Member Since')}}, {{$user->created_at->format('M d, Y')}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="userlinkstp"></div>
                        <!-- Job Detail start -->
                        <div class="row">
                            <div class="col-md-7">
                                <!-- About Employee start -->
                                <div class="job-header">
                                    <div class="contentbox">
                                        <h3>{{__('Profile Summary')}}</h3>
                                        @if(isset($userSummary))
                                            <p class="text-justify">{{ $userSummary }}</p>
                                        @endif
                                    </div>
                                    @if(isset($userProfileVideo))
                                        <div class="contentbox">
                                            @if($userProfileVideo->status != 'created')
                                                <div>
                                                    <video controls width="100%" height="300px" id="vid" src="{{ asset('/uploads/video/'.$userProfileVideo->video) }}"></video>
                                                </div>
                                            @endif

                                            @if($userProfileVideo->status == 'approved')
                                                <div class="">
                                                    <p style="color: red">Video Approved</p>
                                                </div>
                                            @elseif($userProfileVideo->status == 'notapproved')
                                                <div class="">
                                                    <p style="color: red">Video Not Approved</p>
                                                </div>
                                            @elseif($userProfileVideo->status == 'submitted_for_approval')
                                                <div class="">
                                                    <p style="color: red">Video Submitted for Approval</p>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    @if(isset($userResume))
                                        <div class="contentbox">
                                            <h3 style="color: black">{{__('Resume')}}</h3>
                                            <p>
                                                <a  href="{{ route('show.resume', ['id'=> $user->id]) }}">
                                                    {{ str_replace($user->id.'-', "",$userResume->cv_file) }}
                                                </a>
                                            </p>
                                        </div>
                                    @endif
                                    <div class="contentbox">
                                        <h3 style="color: black">{{__('Email')}}</h3>
                                        <p>{{ $user->email }}</p>
                                    </div>
                                    @if(isset($user->street_address) || isset($user->postal_code))
                                        <div class="contentbox">
                                            <h3 style="color: black">{{__('Address')}}</h3>

                                            @if($user->street_address)
                                                <div class="row">
                                                    <div class="col-md-3"><p><strong>Street Address </strong></p></div>
                                                    <div class="col-md-9"><p>{{ $user->street_address }}</p></div>
                                                </div>
                                            @endif
                                            @if($user->postal_code)
                                                <div class="row">
                                                    <div class="col-md-3"><p><strong>Postal Code</strong></p></div>
                                                    <div class="col-md-9"><p>{{ $user->postal_code }}</p></div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    @if(isset($user->degreeLevel->degree_level))
                                        <div class="contentbox">
                                            <h3 style="color: black">{{__('Education Level')}}</h3>
                                            <p>{{ $user->degreeLevel->degree_level }}</p>
                                        </div>
                                    @endif

                                    @if($user->other_job_title)
                                        <div class="contentbox">
                                            <h3 style="color: black">{{__(' Job Titles')}}</h3>
                                            <p>{{ $user->other_job_title }}</p>
                                        </div>
                                    @endif
                                    @if(isset($user->company_name))
                                        <div class="contentbox">
                                            <h3 style="color: black">{{__('Company or Business Name')}}</h3>
                                                <p>{{ $user->company_name }}</p>
                                        </div>
                                    @endif
                                    @if(isset($userIndustry))
                                        <div class="contentbox">
                                            <h3 style="color: black">{{__('Industry')}}</h3>
                                                <p>{{ $userIndustry ? $userIndustry : ''}}</p>
                                        </div>
                                    @endif
                                    @if(isset($user->type_of_business))
                                        <div class="contentbox">
                                            <h3 style="color: black">{{__('Type of Business')}}</h3>
                                                <p>{{ $user->type_of_business }}</p>
                                        </div>
                                    @endif

                                    @if(isset($userSocialMedia))
                                        <div class="contentbox">
                                            <h3 style="color: black">{{__('How did You Hear About us? ')}}</h3>
                                                <p>{{ $userSocialMedia ? $userSocialMedia: '' }}</p>
                                        </div>
                                    @endif
                                    @if(isset($user->social_name))
                                        <div class="contentbox">
                                            <h3 style="color: black">{{__('How did You Hear About us? ')}}</h3>
                                            <p>{{ $user->social_name }}</p>
                                        </div>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-5">
                                <!-- Candidate Detail start -->
                                <div class="job-header">
                                    <div class="jobdetail">
                                        <h3>{{__('Candidate Detail')}}</h3>
                                        <ul class="jbdetail">

                                            <li class="row mt-5">
                                                <div class="col-md-6 col-xs-6">{{__('Third Party Recruiter Hiring ? ')}}</div>
                                                <div class="col-md-6 col-xs-6"><span>{{((bool)$user->is_third_party_hiring)? 'Yes':'No'}}</span></div>
                                            </li>
                                            <li class="row mt-5 mb-5">
                                                <div class="col-md-6 col-xs-6">{{__('Telephone Number')}}</div>
                                                <div class="col-md-6 col-xs-6"><span>{{ $user->phone }}</span></div>
                                            </li>
                                            <li class="row mt-5 mb-5">
                                                <div class="col-md-6 col-xs-6">{{__('Years in Business')}}</div>
                                                <div class="col-md-6 col-xs-6"><span>{{ $user->business_years }}</span></div>
                                            </li>
                                            <li class="row mt-5 mb-5">
                                                <div class="col-md-6 col-xs-6">{{__('Number of Employees')}}</div>
                                                <div class="col-md-6 col-xs-6"><span>{{ $user->number_employees }}</span></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY --> 
    </div>
    @endsection