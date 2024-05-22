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
                <li> <a href="{{ route('list.users') }}">Athlete</a> <i class="fa fa-circle"></i> </li>
                <li> <span> Profile</span> </li>
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
                        <div class="caption font-red-sunglo"> <i class="icon-settings font-red-sunglo"></i> <span class="caption-subject bold uppercase">Athlete Details</span></div>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('list.users') }}"><i class="fa fa-arrow-left"></i> Back</a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="usercoverimg">
                            <div class="userMaininfo">
                                <div class="userPic">{{\ImgUploader::print_image("athlete_profile/".$user['profile_image'], '', '', '/admin_assets/no-image.png', $user['athlete_name'])}}</div>
                                <div class="title">
                                    <h3>
                                        {{$user['athlete_name']}}
                                    </h3>
                                    @if($user['hometown'])
                                        <div class="desi">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i> {{$user['hometown']}}
                                        </div>
                                    @endif
                                    <div class="membersinc"><i class="fa fa-history" aria-hidden="true"></i> {{__('Member Since')}}, {{ $user['created_at']->format('j F, Y') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="userlinkstp"></div>
                        <!-- Job Detail start -->

                        <div class="row">
                            <div class="col-md-6">
                                <!-- About Employee start -->
                                <div class="job-header">
                                    <div class="contentbox">
                                        <h3>{{__('Profile Summary')}}</h3>
                                    </div>

                                    <ul class="jbdetail contentbox">
                                        <li class="row mt-5">
                                            <div class="col-md-6 col-xs-6">{{__('Athlete Type ')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>
                                                    @php
                                                        if ($user->athlete_type == 'Pistol') {
                                                            $athleteType = 'Pistol ';
                                                        }elseif ($user->athlete_type == 'Rifle'){
                                                            $athleteType = 'Rifle ';
                                                        }elseif ($user->athlete_type == 'Short'){
                                                            $athleteType = 'Short Gun';
                                                        }else{
                                                            $athleteType = 'Disabled';
                                                        }
                                                    @endphp
                                                    {{$user->athlete_type?$athleteType:''}}
                                                </span></div>
                                        </li>
                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Email')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->email }}</span></div>
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Age')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->age }}</span></div>
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Father Name')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->father_name}} </span></div>
                                        </li>


                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Address')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->address}} </span></div>
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Height')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->height}} </span></div>
                                        </li>



                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Blood Group')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{(isset($bloodGroup->blood_group) && !empty($bloodGroup->blood_group))?$bloodGroup->blood_group:''}} </span></div>
                                        </li>



                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Start Of Competition')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->start_of_competition}} </span></div>
                                        </li>


                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Handedness')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->handedness}} </span></div>
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Home Town')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->hometown}} </span></div>
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Event')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->event}} </span></div>
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Higher Education')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->higher_education}} </span></div>
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('District')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->districtName}} </span></div>
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-12 col-xs-12"><span>Parent/Guardian & Emergency Information</span></div>
{{--                                            <div class="col-md-6 col-xs-6"><span> </span></div>--}}
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Parent Name')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->parent_full_name}} </span></div>
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Parent Mobile')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->parent_mobile}} </span></div>
                                        </li>

                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- About Employee start -->
                                <div class="job-header">
                                    <div class="contentbox">

                                        <h3>&nbsp;</h3>
                                    </div>

                                    <ul class="jbdetail contentbox">
                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Date Of Birth')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>
                                                    {{ $user->date_of_birth }}
                                                </span>
                                            </div>
                                        </li>

                                        <li class="row mt-5">
                                            <div class="col-md-6 col-xs-6">{{__('Mobile')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{$user->mobile?$user->mobile:''}}</span></div>
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Gender')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->gender}} </span></div>
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Mother Name')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->mother_name}} </span></div>
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('National Coach')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->name_of_national_coach}} </span></div>
                                        </li>


                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Weight')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->weight}} </span></div>
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Profession')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $profession->profession}} </span></div>
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Practicing Shooter Sine')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->practicing_shooter_sign}} </span></div>
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Place Of Birth')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->place_of_birth}} </span></div>
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Marital Status')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->marital_status}} </span></div>
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Hobbies')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->hobbies}} </span></div>
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">Club</div>
                                            <div class="col-md-6 col-xs-6"><span> {{$user->clubName.' ('.$user->clubShortName.')'}} </span></div>
                                        </li>


                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6"></div>
                                            <div class="col-md-6 col-xs-6"><span>&nbsp; </span></div>
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Relationship')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->relationship}} </span></div>
                                        </li>

                                        <li class="row mt-5 mb-5">
                                            <div class="col-md-6 col-xs-6">{{__('Email Address')}}</div>
                                            <div class="col-md-6 col-xs-6"><span>{{ $user->parent_address}} </span></div>
                                        </li>


                                    </ul>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <div class="job-header jbdetail contentbox">
                                    <div class="">
                                        <h3 style="display: block;color: #000;font-weight: 600;font-size: 15px;">{{__('Participation of Local Competition Achievements')}}</h3>
                                    </div>

                                    <table class="table table-responsive table-bordered">
                                        <tr>
                                            <th>SL</th>
                                            <th>Competition Name</th>
                                            <th>Date</th>
                                            <th>Event</th>
                                            <th>Score</th>
                                            <th>Position</th>
                                        </tr>
                                        @php $index = 1; @endphp
                                        @foreach($user['athleteCompetition'] as $competition)
                                            <tr>
                                                <td>{{$index}}</td>
                                                <td>{{$competition->competition_name}}</td>
                                                <td>{{$competition->competition_date}}</td>
                                                <td>{{$competition->competition_event}}</td>
                                                <td>{{$competition->score}}</td>
                                                <td>{{$competition->position}}</td>
                                            </tr>
                                            @php $index++; @endphp
                                        @endforeach
                                    </table>

                                    <a href="{{route('admin.athlete.profile.download',$user['id'])}}">
                                    <button class="btn btn-primary">Download</button>
                                    </a>

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

@push('css')
        <style>
            .contentbox{
                padding: 0px 35px !important;
            }
        </style>
@endpush