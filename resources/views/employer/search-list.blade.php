@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<!-- Inner Page Title start -->
@include('includes.employer_tab')
<!-- Inner Page Title end -->
<form class="searchform" action="{{route('job.seeker.search')}}" method="get">
<section id="employer-background">

    <div id="search">
        <div class="container">
            @include('flash::message')
            <div class="employer-search-tap" style="padding-top: 20px">
                <div class="text-right">
                    <div class="clear-filter" style="text-align: right">
                        <a style="color: #000; background: #fff; border: 2px solid #000; padding: 10px 56px; font-size: 18px;" href="{{route('job.seeker.search')}}" class="clear-btn">Clear Search</a>
                    </div>
                </div>
                <div class="text-left">
                    <div class="single-input full-width" style="text-align:left;">
                        <label for="search">What position are you looking for</label>
                        <input type="text" autocomplete="off" class="position_search" name="search" value="{{Request::get('search', '')}}">
                        <div style="position: relative" id="suggesstion-box"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="single-input full-width">
                                <label for="country">Country</label>
                                {!! Form::select('country_id[]', ['' => __('Select Country')]+$countries, Request::get('country_id', $siteSetting->default_country_id), array('class'=>'country_id', 'id'=>'country_id')) !!}
                            </div>


                        </div>
                        <div class="col-md-4">
                            <div class="single-input full-width">
                                <label for="province">Province</label>
                                <span id="state_dd">
                                   {!! Form::select('state_id[]', ['' => __('Select Province')], Request::get('state_id', null), array('class'=>'state_id', 'id'=>'state_id')) !!}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-input full-width">
                                <label for="city">City</label>
                                <span id="city_dd">
                                  {!! Form::select('city_id[]', ['' => __('Select City')], Request::get('city_id', null), array('class'=>'city_id', 'id'=>'city_id')) !!}
                                </span>
                                {{--<i class="fas fa-exclamation-circle"></i>--}}
                            </div>

                        </div>
                    </div>

                </div>
                <div class="advance-search">
                    <div class="single-input full-width" style="text-align:left;">
                        <label for="advance_search">Enter keywords separated by a space</label>
                        <input type="text" class="advance_search" name="advance_search" id="advance_search" value="{{Request::get('advance_search', '')}}">
                    </div>
                </div>

                <div class="advance-search" id="advance-search">
                    <div class="row">
                        <div class="col-md-6 m-auto text-left pl-5">

                            <div>
                                <input type="radio" id="leastOneWordsSpecified" class="search_criteria" name="search_criteria" value="leastOneWordsSpecified" {{Request::get('search_criteria')=='leastOneWordsSpecified' ?'checked' : ''}}>
                                <label for="leastOneWordsSpecified">With at least one of the words specified</label>
                            </div>
                            <div>
                                <input type="radio" id="allOfTheWord" class="search_criteria" name="search_criteria" value="allOfTheWord" {{Request::get('search_criteria')=='allOfTheWord' ?'checked' : ''}}>
                                <label for="allOfTheWord">With all of the words specified</label>
                            </div>

                            <div>
                                <input type="radio" id="exactPhrase" class="search_criteria" name="search_criteria" value="exactPhrase" {{Request::get('search_criteria')=='exactPhrase' ?'checked' : ''}}>
                                <label for="exactPhrase">With the exact phrase specified</label>
                            </div>
                        </div>

                                {{--<div class="col-md-6 text-left">
                                    <div>
                                        <input type="radio" id="oneWordsSpecified" name="search_criteria" value="oneWordsSpecified" {{Request::get('search_criteria')=='oneWordsSpecified' ?'checked' : ''}}>
                                        <label for="oneWordsSpecified">With one of the words specified</label>
                                    </div>

                                    <div>
                                        <input type="radio" id="lostVisit" name="search_criteria" value="lostVisit" {{Request::get('search_criteria')=='lostVisit' ?'checked' : ''}}>
                                        <label for="lostVisit">Since my lost visit</label>
                                    </div>
                                </div>--}}


                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-center sb py-3">
                        <button type="submit" id="search-profile" class="search-btn"><i class="fas fa-search"></i> Search</button>
                    </div>
                </div>
                <div class="normal-search">
                    <a class="normal-search-btn" id="hide"><u>Advanced Resume Search</u></a>
                </div>

                <div class="advance-search">
                <a class="advance-search-btn" id="show"><u>Hide Advanced Resume Search</u></a>
                </div>


            </div>
            @php
            use App\User;
            $parentUser=null;
            if(auth()->user()->parent_id && auth()->user()->user_type=='sub_account')
            $parentUser=User::find(auth()->user()->parent_id)
            @endphp

            @if (Auth::check() && (auth()->user()->package_end_date && auth()->user()->package_end_date>date('Y-m-d H:i:s') || ($parentUser && $parentUser->package_end_date && $parentUser->package_end_date>date('Y-m-d H:i:s'))))
                @if(isset($jobSeekers) && count($jobSeekers))
                <div id="search-show-profile">

                    <div class="row">
                        <div class="col-md-3 col-sm-3">

                            <div class="filter-results">
                                <h5 class="text-center" style="background:#F4961E; padding: 15px;">Filter Your Results</h5>

                                <div class="input-filter-results">
                                    <div class="single-input full-width">

                                        <select name="job_experience_id[]">
                                            <option value="">Years of Experience</option>
                                            @if(isset($jobExperienceIdsArray) && count($jobExperienceIdsArray))
                                                @php
                                                    $jobExperiences = App\JobExperience::whereIn('job_experience_id',$jobExperienceIdsArray)->where('is_active',1)->orderBy('sort_order', 'ASC')->get();
                                                @endphp
                                            @if($jobExperiences)
                                                @foreach($jobExperiences as $jobExperience)

                                                    @if(null !== $jobExperience)
                                                        @php
                                                            $selected = (in_array($jobExperience->job_experience_id, Request::get('job_experience_id', array())))? 'selected="selected"':'';
                                                        @endphp
                                                        <option value="{{$jobExperience->job_experience_id}}" {{$selected}}>{{$jobExperience->job_experience}} ({{$jobSeekersCountByFilter && isset($jobSeekersCountByFilter['job_experience'])?count($jobSeekersCountByFilter['job_experience'][$jobExperience->job_experience_id]): App\User::countNumJobSeekers('job_experience_id', $jobExperience->job_experience_id)}})</option>
                                                    @endif
                                                @endforeach
                                                @endif
                                            @endif
                                        </select>

                                    </div>

                                    <div class="single-input full-width">
                                        <select name="degree_level_id[]">
                                            <option value="">Level of Education</option>
                                            @if(isset($degreeLevelIdsArray) && count($degreeLevelIdsArray))
                                                @php
                                                    $degreeLevels = App\DegreeLevel::whereIn('degree_level_id',$degreeLevelIdsArray)->where('is_active',1)->orderBy('sort_order', 'ASC')->get();
                                                @endphp
                                                @foreach($degreeLevels as $degreeLevel)

                                                    @if(null !== $degreeLevel)
                                                        @php
                                                            $selected = (in_array($degreeLevel->degree_level_id, Request::get('degree_level_id', array())))? 'selected="selected"':'';
                                                        @endphp
                                                        <option value="{{$degreeLevel->degree_level_id}}" {{$selected}}>{{$degreeLevel->degree_level}} ({{$jobSeekersCountByFilter && isset($jobSeekersCountByFilter['degree_level']) && isset($jobSeekersCountByFilter['degree_level'][$degreeLevel->id])?count($jobSeekersCountByFilter['degree_level'][$degreeLevel->id]): App\User::countNumJobSeekers('degree_level_id', $degreeLevel->degree_level_id)}})</option>
                                                    @endif
                                                @endforeach
                                            @endif

                                        </select>

                                    </div>

                                    {{--<div class="single-input full-width">
                                        <select name="salary_period_id[]">
                                            <option value="">Salary Period</option>
                                            @if(isset($salaryPeriodIdsArray) && count($salaryPeriodIdsArray))
                                                @foreach($salaryPeriodIdsArray as $key=>$salary_period_id)
                                                    @php
                                                        $salaryPeriod = App\SalaryPeriod::where('salary_period_id','=',$salary_period_id)->lang()->active()->first();
                                                    @endphp
                                                    @if(null !== $salaryPeriod)
                                                        @php
                                                            $selected = (in_array($salaryPeriod->salary_period_id, Request::get('salary_period_id', array())))? 'selected="selected"':'';
                                                        @endphp
                                                        <option value="{{$salaryPeriod->salary_period_id}}" {{$selected}}>{{$salaryPeriod->salary_period}} ({{App\User::countNumJobSeekersCustom('salary_period_id', $salaryPeriod->salary_period_id)}})</option>
                                                    @endif
                                                @endforeach
                                            @endif

                                        </select>

                                    </div>--}}

                                    <div class="single-input full-width">
                                        <select name="gender_id[]">
                                            <option value="">Gender</option>
                                            @if(isset($genderIdsArray) && count($genderIdsArray))
                                                @php
                                                    $genders = App\Gender::whereIn('gender_id',$genderIdsArray)->where('is_active',1)->orderBy('sort_order', 'ASC')->get();
                                                @endphp
                                                @foreach($genders as $gender)
                                                    @if(null !== $gender)
                                                        @php
                                                            $selected = (in_array($gender->gender_id, Request::get('gender_id', array())))? 'selected="selected"':'';
                                                        @endphp
                                                        <option value="{{$gender->gender_id}}" {{$selected}}>{{$gender->gender}} ({{$jobSeekersCountByFilter && isset($jobSeekersCountByFilter['gender']) && isset($jobSeekersCountByFilter['gender'][$gender->id])?count($jobSeekersCountByFilter['gender'][$gender->id]): App\User::countNumJobSeekers('gender_id', $gender->gender_id)}})</option>
                                                    @endif
                                                @endforeach
                                            @endif

                                        </select>

                                    </div>

                                    <div class="single-input full-width">
                                        <select name="updated_date" id="updated_date">
                                            <option value="">Last Updated</option>
                                            <option value="last_day" {{Request::get('updated_date')=='last_day'?'selected="selected"':''}}>Within Last Day</option>
                                            <option value="last_week" {{Request::get('updated_date')=='last_week'?'selected="selected"':''}}>Within Last Week</option>
                                            <option value="last_month" {{Request::get('updated_date')=='last_month'?'selected="selected"':''}}>Within Last Month</option>
                                            <option value="last_3_months" {{Request::get('updated_date')=='last_3_months'?'selected="selected"':''}}>Within Last 3 Months</option>
                                            <option value="last_6_months" {{Request::get('updated_date')=='last_6_months'|| Request::get('updated_date') == "" ?'selected="selected"':''}}>Within Last 6 Months</option>
                                            <option value="show_all_profiles" {{Request::get('updated_date')=='show_all_profiles'?'selected="selected"':''}}>Show all profiles</option>
                                        </select>

                                    </div>

                                    {{--<div class="">
                                        <div class="sliderText">Expected Salary</div>

                                        <div id="slider-range" class="price-filter-range" name="rangeInput"></div>

                                        <div style="margin:15px auto">
                                            <input type="text" min=0 max="990" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field"/>
                                            <input type="text" style="margin-left: 81px;" min=0 max="1000" oninput="validity.valid||(value='10000');" id="max_price" class="price-range-field"/>
                                        </div>

                                    </div>--}}


                                    <div class="">
                                        <input id="willingradio" value="1" type="checkbox" name="willing_to_relocate" {{Request::get('willing_to_relocate')?'checked':''}}>
                                        <label for="willingradio"> Willing To Relocate</label><br>

                                        <input id="readytowork" value="1" type="checkbox" name="is_immediate_available" {{Request::get('is_immediate_available')?'checked':''}}>
                                        <label for="readytowork">Ready To Work Now</label><br>

                                        <input id="profilevideo" type="checkbox" value="1" name="profile_video" {{Request::get('profile_video')?'checked':''}}>
                                        <label for="profilevideo">With Profile Video</label><br>
                                        <input id="resumeattach" type="checkbox" value="1" name="resume_attach" {{Request::get('resume_attach')?'checked':''}}>
                                        <label for="resumeattach">Resume Attached</label><br><br>
                                    </div>

                                    <div class="apply-filter">
                                        <button type="submit" ><i class="fas fa-filter"></i> Apply Filters</button>
                                    </div>


                                    {{--<button style="width:100%; padding:10px 0px; background: #fff; font-size: 18px; margin-bottom: 10px;"><i class="far fa-save"></i> Save this search</button>--}}
                                    <div class="save-search">
                                        <button type="button" data-toggle="modal" data-target="#exampleModal">
                                            <i class="far fa-save"></i> Save this search
                                        </button>
                                    </div>
                                   {{-- <button style="width:100%; padding:10px 0px; background: #fff; font-size: 18px; margin-bottom: 10px;" type="button" data-toggle="modal" data-target="#exampleModal">
                                        <i class="far fa-save"></i> Save this search
                                    </button>--}}
                                    <div class="clear-filter">
                                        <button type="reset" class="clear-btn" onclick="clearBtn()">Clear Filters</button>
                                    </div>
                                    <div class="view-save-search">
                                        <a href="{{ route('saveSearch') }}">View Saved Search</a>
                                    </div>


                                </div>
                            </div>


                        </div>

                        <div class="col-md-9 col-sm-9">
                            <div class="search-results">

                                <!-- job start -->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>{{$jobSeekers->lastItem()>0?$jobSeekers->lastItem():0}} of {{ $jobSeekers->total()}} Candidates</p>
                                            <p>Click on the <i class="fa fa-heart"></i> to save profiles</p>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-input float-right">
                                                <div class="select2Dropdown">
                                                    <select name="sortBy" id="sortBy" class="select2">
                                                        <option value="">Date last updated</option>
                                                        <option value="ASC" {{Request::get('sortBy')=='ASC'?'selected="selected"':''}}>Ascending</option>
                                                        <option value="DESC" {{Request::get('sortBy')=='DESC'?'selected="selected"':''}}>Descending</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach($jobSeekers as $jobSeeker)
                                        <div class="show-profile">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="profile-img">
                                                        {{$jobSeeker->printUserImage(150,125)}}
                                                    </div>

                                                    @if(in_array($jobSeeker->id,$favouriteJobseekers))
                                                        <a href="javascript:void(0)" data-jobseeker-id="{{$jobSeeker->id}}" data-id="{{array_search($jobSeeker->id, $favouriteJobseekers)}}" class="remove_action favourite_jobseeker_remove"><i class="fa fa-heart top-right-love"></i></a>
                                                        @else
                                                        <a href="javascript:void(0)" data-jobseeker-id="{{$jobSeeker->id}}" data-id="{{$jobSeeker->id}}" class="add_action favourite_jobseeker_add"><i class="far fa-heart top-right-love"></i></a>
                                                    @endif

                                                </div>
                                                <div class="col-md-10">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="profile-info">
                                                                <h4>{{$jobSeeker->getName()}}</h4>
                                                                @php
                                                                    $userJobTitles = DB::table('user_job_titles')
                ->join('job_titles', 'job_titles.id', '=', 'user_job_titles.job_title_id')
                ->where('user_id',$jobSeeker->id)->get();
                                                                @endphp

                                                                @foreach($userJobTitles as $item)

                                                                    <p style="margin-bottom: 0px; display:inline-block;">{{ $item->job_title }}@if(!$loop->last),@endif</p>
                                                                @endforeach

                                                                @if($jobSeeker->other_job_title)
                                                                    <p style="margin-bottom: 0rem;"> {{$jobSeeker->other_job_title}}</p>
                                                                @endif

                                                               {{-- @if ($jobSeeker->other_job_title)
                                                                    @foreach(explode(',', $jobSeeker->other_job_title) as $item)
                                                                        <p style="margin-bottom: 0rem;"> {{$item}}</p>
                                                                    @endforeach
                                                                @endif--}}

                                                                @if($jobSeeker->getLocation())
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-map-marker"></i> {{$jobSeeker->getLocation()}}</p>
                                                                @endif

                                                                @if($jobSeeker->phone)
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-phone-alt"></i> {{$jobSeeker->phone}}</p>
                                                                @endif

                                                                @if($jobSeeker->email)
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-envelope"></i> {{$jobSeeker->email}}</p>
                                                                @endif

                                                            </div>

                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="profile-right">
                                                                <p style="margin-bottom: 0rem;">Created: {{ $jobSeeker->created_at->format('j F, Y') }}</p>
                                                                <p style="margin-bottom: 0rem;">Updated: {{ $jobSeeker->updated_at->format('j F, Y') }}</p>
                                                                <div class="video-resume-icon">
                                                                    @php

                                                                        $userProfileVideo = App\UserVideo::where('status','approved')->where('user_id', $jobSeeker->id)->first();
                                                                    @endphp
                                                                    @if(isset($userProfileVideo))
                                                                    <a href="#" data-toggle="modal" data-target="#videoModal_{{$jobSeeker->id}}">
                                                                        <i class="fas fa-video" style="font-size:25px; margin:2px 5px; color: #000;"></i>
                                                                    </a>

                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="videoModal_{{$jobSeeker->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">


                                                                                        <video video controls controlsList="nodownload" width="467" height="auto" src="{{ asset('/uploads/video/'.$userProfileVideo->video) }}"></video>

                                                                                    {{--{{dd($jobSeeker->id)}}--}}
                                                                                </div>
                                                                                {{-- <div class="modal-footer">
                                                                                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                     <button type="button" class="btn btn-primary">Save changes</button>
                                                                                 </div>--}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                    @php

                                                                        $resume = App\ProfileCv::whereNotNull('cv_file')->where('user_id', $jobSeeker->id)->first();
                                                                    @endphp
                                                                    @if(isset($resume))
                                                                    <a  href="{{route('show.resume', $jobSeeker->id)}}">
                                                                        <i class="fas fa-file-alt" style="font-size:25px; margin:2px 5px; color: #000;"></i>
                                                                    </a>
                                                                    @endif
                                                                </div>
                                                                <div class="view-details">
                                                                    <a href="{{route('public.profile.view', $jobSeeker->id)}}" class="view-details-btn">View Details</a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- job end -->
                                    @endforeach
                                        <div class="pagiWrap">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="showreslt">
                                                        {{__('Showing Pages')}} : {{ $jobSeekers->firstItem() }} - {{ $jobSeekers->lastItem() }} {{__('Total')}} {{ $jobSeekers->total() }}
                                                    </div>
                                                </div>
                                                <div class="col-md-7 text-right">
                                                    @if(isset($jobSeekers) && count($jobSeekers))
                                                        {{ $jobSeekers->appends(request()->query())->links() }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @if(Request::get('city_id') || Request::get('country_id') || Request::get('state_id') || Request::get('advance_search') || Request::get('search'))
                                            <h3 style="text-align:center; padding: 30px 0px;">No records found.</h3>
                                         @endif
                                @endif






                            </div>


                        </div>
                    </div>
                </div>
            @else
                <div class="main-body">
                    <h3>
                        We will prompt them that account had expired and they need to renew.
                    </h3>

                </div>

            @endif
        </div>

    </div>
</section>
</form>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route('jobseeker.search.save')}}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" name="requestSearchUrl" value="{{$requestUrl}}">
                    <div class="single-input full-width">
                        <label for="search">Search title</label>
                        <input type="text" name="search_title" placeholder="Enter Search Title">                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>




@include('includes.footer_social')
@endsection

@push('styles')

    <link href="{{asset('/')}}css/custom-bootstrap.min.css" rel="stylesheet">

    <style type="text/css">

        .status_box{
            display: flex!important;
        }
        .profilestat .inbox {
            text-align: center;
            background: #fff;
            padding: 15px 10px;
            margin-bottom: 30px;
            border-radius: 5px;
            flex: 1;
        }
        .profilestat .inbox i {
            font-size: 36px;
            color: #999;
            margin-bottom: 15px;
            display: block;
        }
        .profilestat .inbox h6 {
            font-size: 14px;
            font-weight: 600;
            color: #ffcb32;
            margin-bottom: 10px;
        }
        .testimonialReview{
            font-size: 25px;
            text-align: left;
        }
        .testimonialReview i{
            margin-right: 5px;
        }
        .grid-print {
            width: 100%;
            display: grid;
            grid-gap: 0;
        }
        .grid-print {
            grid-template-columns: repeat(5, calc(100%/5));
        }
        .job-titles-list {
            float: left;
            list-style: none;
            /* margin-top: -3px; */
            padding: 0;
            width: auto;
            position: absolute;
            z-index: 99999;
            background-color: #fff;
        }
        .job-titles-list li{
            padding: 5px 15px;
            border-bottom: solid lightgrey 1px;
            cursor: pointer;
        }


    </style>
    <link href="{{asset('/')}}css/jquery-ui.css" rel="stylesheet">

@endpush
@push('scripts')
   {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>--}}
    <script src="{{asset('/')}}js/jquery-ui.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function ($) {
        var advanceSearch= "{{Request::get('advance_search')}}";
            console.log(advanceSearch);
        if(advanceSearch){
            $(".normal-search").hide();
            $(".advance-search").addClass('active').show();
        }else{
            $(".advance-search").removeClass('active').hide();
            $(".normal-search").show();
        }
        $("#hide").click(function(){
            $(".normal-search").hide();
            $(".advance-search").addClass('active').show();
        });
        $("#show").click(function(){
            $(".advance-search").removeClass('active').hide();
            $(".normal-search").show();
        });
        $("form").submit(function () {
            $(this).find(":input").filter(function () {
                return !this.value;
            }).attr("disabled", "disabled");
            return true;
        });
        $("form").find(":input").prop("disabled", false);

        $(".view_more_ul").each(function () {
            if ($(this).height() > 100)
            {
                $(this).addClass('hide_vm_ul');
                $(this).next().removeClass('hide_vm');
            }
        });
        $('.view_more').on('click', function (e) {
            e.preventDefault();
            $(this).prev().removeClass('hide_vm_ul');
            $(this).addClass('hide_vm');
        });

        $(".position_search").keyup(function(){
            var job_title = $(this).val();
            $.ajax({
                type: "GET",
                url: '{{ route('render_job_titles_ajax') }}',
                data: {job_title:job_title, _token: '{{csrf_token()}}'},
                success: function(data){
                    $("#suggesstion-box").show();
                    $("#suggesstion-box").html(data['html']);
                }
            });
        });

        $(document).on('click', '.favourite_jobseeker_add', function(){
            var element = $(this);
            // $(this).hasClass('favourite_jobseeker_add');
            var jobseeker_id = $(this).attr('data-id');
            if(jobseeker_id!= ''){
                $.post("{{ route('favourite.jobseeker.save') }}", {jobseeker_id: jobseeker_id,_method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('.alert').remove();
                        if(response.status=='success'){
                            $(element).html();
                            $('#search-show-profile').before('<div class="alert alert-success" role="alert">This jobseeker\'s profile has been successfully saved.</div>');
                            $(element).html('<i class="fa fa-heart top-right-love"></i>');
                            $(element).attr('data-id',response.id);
                            setTimeout(function () {
                                $(element).removeClass('favourite_jobseeker_add').addClass('favourite_jobseeker_remove');
                            });
                        }
                        if(response=='error'){
                            $('#search-show-profile').before('<div class="alert alert-danger" role="alert">This jobseeker already favourite listed.</div>')
                        }
                    });
            }
        });

        $(document).on('click', '.favourite_jobseeker_remove', function(){
            var element = $(this);
            var jobseeker_id = $(this).attr('data-id');
            var jobseeker_profile_id = $(this).attr('data-jobseeker-id');
            if(jobseeker_id!= ''){
                $.post("{{ route('delete.favourite.jobseeker') }}", {jobseeker_id: jobseeker_id,_method: 'POST', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        $('.alert').remove();
                        if(response=='success'){
                            $(element).html();
                            $('#search-show-profile').before('<div class="alert alert-success" role="alert">This Jobseeker has been removed from favourite list.</div>');
                            $(element).html('<i class="far fa-heart top-right-love"></i>');
                            $(element).attr('data-id',jobseeker_profile_id);
                            setTimeout(function () {
                                $(element).removeClass('favourite_jobseeker_remove').addClass('favourite_jobseeker_add');
                            });
                        }
                        if(response=='error'){
                            $('.dashboard-inner').before('<div class="alert alert-danger" role="alert">This jobseeker already favourite listed.</div>')
                        }
                    });
            }
        });
    });
    //To select country name
    function selectCountry(val) {
        $(".position_search").val(val);
        $("#suggesstion-box").hide();
    }

    $(document).ready(function(){

        //$('#price-range-submit').hide();

        $("#min_price,#max_price").on('change', function () {

            //$('#price-range-submit').show();

            var min_price_range = parseInt($("#min_price").val());

            var max_price_range = parseInt($("#max_price").val());

            if (min_price_range > max_price_range) {
                $('#max_price').val(min_price_range);

            }

            $("#slider-range").slider({
                values: [min_price_range, max_price_range]
            });

        });


        $("#min_price,#max_price").on("paste keyup", function () {

            //$('#price-range-submit').show();

            var min_price_range = parseInt($("#min_price").val());

            var max_price_range = parseInt($("#max_price").val());

            if(min_price_range == max_price_range){

                max_price_range = min_price_range + 100;

                $("#min_price").val(min_price_range);
                $("#max_price").val(max_price_range);
            }

            $("#slider-range").slider({
                values: [min_price_range, max_price_range]
            });

        });


        $(function () {
            $("#slider-range").slider({
                range: true,
                orientation: "horizontal",
                min: 0,
                max: 10000,
                values: [0, 10000],
                step: 100,

                slide: function (event, ui) {
                    if (ui.values[0] == ui.values[1]) {
                        return false;
                    }

                    $("#min_price").val(ui.values[0]);
                    $("#max_price").val(ui.values[1]);
                }
            });

            $("#min_price").val($("#slider-range").slider("values", 0));
            $("#max_price").val($("#slider-range").slider("values", 1));

        });

       /* $("#slider-range,#price-range-submit").click(function () {

            var min_price = $('#min_price').val();
            var max_price = $('#max_price').val();

            $("#searchResults").text("Here List of products will be shown which are cost between " + min_price  +" "+ "and" + " "+ max_price + ".");
        });*/

    });
    $('#sortBy').on('change', function(){
        $('.searchform').submit();
    });

    function clearBtn() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        urlParams.delete('job_experience_id[]');
        urlParams.delete('degree_level_id[]');
        urlParams.delete('gender_id[]');
        urlParams.delete('gender_id[]');
        urlParams.delete('willing_to_relocate');
        urlParams.delete('is_immediate_available');
        urlParams.delete('profile_video');
        urlParams.delete('resume_attach');
        urlParams.delete('updated_date');

        window.location.href = window.location.pathname+'?'+urlParams;
    }

    jQuery(function(){
        $("#search-profile").click(function(){
            $(".custom-help-block").hide();
            $(".choose-ones-sms").remove();
            var hasError = false;
            var searchVal = $('#search').find('.active').find("#advance_search").val();
            if ($('.advance-search').hasClass("active")) {
                // alert('ok');
            }
            var search_criteria = $("input[name='search_criteria']:checked").val();
            if(searchVal == '' && $(this).closest('#search').find('.active').find('.search_criteria').not(':checked').length>2) {
                hasError = false;
            } else if(searchVal == '' && $(this).closest('#search').find('.active').find('.search_criteria').not(':checked').length>1){
                $("#advance_search").after('<span class="custom-help-block">You must enter search criteria.</span>');
                hasError = true;
            } else if(searchVal != '' && $(this).closest('#search').find('.active').find('.search_criteria').not(':checked').length>2){
                    $("#advance-search").before('<span class="choose-ones-sms">Please choose one of the following options</span>');
                hasError = true;
            }

            if(hasError == true) {return false;}
        });
    });

</script>
@include('includes.country_state_city_js')
@endpush