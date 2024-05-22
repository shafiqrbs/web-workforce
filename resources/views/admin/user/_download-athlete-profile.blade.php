
<table style="width: 100%;text-align: center;position: relative;" >
    <tr>
        <th>
            <img src="{{ asset('assets/images/logo.png') }}" height="100px"  alt="{{ $siteSetting->site_name }}" />
        </th>
        <th  style="text-align: center;">
            <img src="{{ asset('athlete_profile/'.$user->profile_image) }}" height="100px"  alt="{{ $siteSetting->site_name }}" />
        </th>
    </tr>
    <tr><th>&nbsp;</th></tr>

</table>
<table style="width: 100%;text-align: center;position: absolute;top: 20;left: 0;" >
    <tr>
        <th>{{ $siteSetting->site_name }} <br> Athlete Profile</th>
    </tr>
</table>


<table style="width: 100%;margin-left: 140px" >
    <tr>
        <th style="text-align: justify;">Athlete Name : <span style="font-weight: lighter">{{$user['athlete_name']}}</span> </th>
        <th style="text-align: justify">Athlete Type : <span style="font-weight: lighter">{{$user['athlete_type']}}</span></th>
    </tr>

    <tr>
        <th style="text-align: justify">Date of Birth : <span style="font-weight: lighter">{{$user['date_of_birth']}}</span></th>
        <th style="text-align: justify">Age : <span style="font-weight: lighter">{{$user['age']}}</span></th>
    </tr>

    <tr>
        <th style="text-align: justify">Gender : <span style="font-weight: lighter">{{$gender->gender}}</span></th>
        <th style="text-align: justify">Join Date : <span style="font-weight: lighter">{{$user['created_at']->format('j F, Y')}}</span></th>
    </tr>

    <tr>
        <th style="text-align: justify">Father’s Name : <span style="font-weight: lighter">{{$user->father_name}}</span></th>
        <th style="text-align: justify">Mother’s Name : <span style="font-weight: lighter">{{$user->mother_name}}</span></th>
    </tr>

    <tr>
        <th colspan="2" style="text-align: justify">Address : <span style="font-weight: lighter">{{$user->address}}</span></th>
    </tr>

    <tr>
        <th style="text-align: justify">Height : <span style="font-weight: lighter">{{$user->height}}</span></th>
        <th style="text-align: justify">Weight : <span style="font-weight: lighter">{{$user->weight}}</span></th>
    </tr>

    <tr>
        <th style="text-align: justify">Blood Group : <span style="font-weight: lighter">{{$bloodGroup->blood_group}}</span></th>
        <th style="text-align: justify">Profession : <span style="font-weight: lighter">{{$profession->profession}}</span></th>
    </tr>

    <tr>
        <th style="text-align: justify">Start of Competition : <span style="font-weight: lighter">{{$user->start_of_competition}}</span></th>
        <th style="text-align: justify">Practicing Shooter Sine : <span style="font-weight: lighter">{{$user->practicing_shooter_sign}}</span></th>
    </tr>

    <tr>
        <th colspan="2" style="text-align: justify">Name of National Coach : <span style="font-weight: lighter">{{$user->name_of_national_coach}}</span></th>
    </tr>

    <tr>
        <th style="text-align: justify">Handedness : <span style="font-weight: lighter">{{$user->handedness}}</span></th>
        <th style="text-align: justify">Marital Status : <span style="font-weight: lighter">{{$user->marital_status}}</span></th>
    </tr>

    <tr>
        <th style="text-align: justify">Place of Birth : <span style="font-weight: lighter">{{$user->place_of_birth}}</span></th>
        <th style="text-align: justify">Hometown : <span style="font-weight: lighter">{{$user->hometown}}</span></th>
    </tr>

    <tr>
        <th style="text-align: justify">Height : <span style="font-weight: lighter">{{$user->height}}</span></th>
        <th style="text-align: justify">Weight : <span style="font-weight: lighter">{{$user->weight}}</span></th>
    </tr>

    <tr>
        <th style="text-align: justify">Event : <span style="font-weight: lighter">{{$user->event}}</span></th>
        <th style="text-align: justify">Hobbies : <span style="font-weight: lighter">{{$user->hobbies}}</span></th>
    </tr>

    <tr>
        <th colspan="2" style="text-align: justify">Higher Education : <span style="font-weight: lighter">{{$user->higher_education}}</span></th>
    </tr>

    <tr>
        <th style="text-align: justify">Mobile : <span style="font-weight: lighter">{{$user->mobile}}</span></th>
        <th style="text-align: justify">Email : <span style="font-weight: lighter">{{$user->email}}</span></th>
    </tr>

    <tr><th>&nbsp;</th><th>&nbsp;</th></tr>

    <tr>
        <th style="text-align: justify">Parent/Guardian & Emergency Information</th>
    </tr>

    <tr>
        <th style="text-align: justify">Parent Name : <span style="font-weight: lighter">{{$user->parent_full_name}}</span></th>
        <th style="text-align: justify">Relationship : <span style="font-weight: lighter">{{$user->relationship}}</span></th>
    </tr>

    <tr>
        <th style="text-align: justify">Parent Mobile : <span style="font-weight: lighter">{{$user->parent_mobile}}</span></th>
        <th style="text-align: justify">Email Address : <span style="font-weight: lighter">{{$user->parent_address}}</span></th>
    </tr>

    <tr><th>&nbsp;</th><th>&nbsp;</th></tr>
    <tr><th>&nbsp;</th><th>&nbsp;</th></tr>
    <tr><th>&nbsp;</th><th>&nbsp;</th></tr>
    <tr><th>&nbsp;</th><th>&nbsp;</th></tr>
    <tr><th>&nbsp;</th><th>&nbsp;</th></tr>
    <tr><th>&nbsp;</th><th>&nbsp;</th></tr>

    <tr>
        <th style="text-align: justify">Participation of Local Competition Achievements</th>
    </tr>

</table>

<table style="width: 80%;margin-left: 140px;border: 1px solid;">
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
        <tr style="text-align: center">
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

{{--{{\ImgUploader::print_image("athlete_profile/".$user['profile_image'], '', '', '/admin_assets/no-image.png', $user['athlete_name'])}}
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
                                            <div class="col-md-6 col-xs-6"><span>{{$user->athlete_type?$user->athlete_type:''}}</span></div>
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
                                            <div class="col-md-6 col-xs-6"><span>{{ $bloodGroup->blood_group}} </span></div>
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
                                            <div class="col-md-12 col-xs-12"><span>Parent/Guardian & Emergency Information</span></div>
--}}{{--                                            <div class="col-md-6 col-xs-6"><span> </span></div>--}}{{--
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
                                            <div class="col-md-6 col-xs-6"><span>{{ $gender->gender}} </span></div>
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
                                            <div class="col-md-6 col-xs-6"></div>
                                            <div class="col-md-6 col-xs-6"><span>&nbsp; </span></div>
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
                    </div>--}}
