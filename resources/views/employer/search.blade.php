@extends('layouts.app')
@section('content')
    <!-- Header start -->
    @include('includes.header')
    <!-- Header end -->

    @include('includes.employer_tab')

    <section id="employer-background">

        <div class="tab-content" id="employerTabContent">
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div id="dashboard">
                    <div class="container">
                        <div class="imr">
                            <div class="im-12">
                                <div class="dashboard-inner">
                                    @include('flash::message')
                                    @include('includes.employer_dashboard_menu')

                                    <div class="dashboard-tab-content">
                                        <div class="profile-main">
                                            <div class="profile-main-top">
                                                <div class="edit-profile-btn">
                                                    <a href="{{ route('my.profile') }}">Edit Profile</a>
                                                </div>
                                                <div class="profile-image">
                                                    {{auth()->user()->printUserImage()}}
                                                </div>
                                                <div class="profile-details">
                                                    <h2 style="width: 425px; padding-top: 20px;">{{auth()->user()->name ? auth()->user()->name : ''}}</h2>
                                                    <ul>

                                                        @if(Auth::user()->getLocation())
                                                            <li><i class="fa fa-map-marker"></i>{{ Auth::user()->getLocation() }}</li>
                                                        @endif
                                                        @if(auth()->user()->phone)
                                                            <li><i class="fa fa-phone-alt"></i>{{auth()->user()->phone}}</li>
                                                        @endif
                                                        @if(auth()->user()->email)
                                                            <li><i class="fa fa-envelope"></i>{{auth()->user()->email}}</li>
                                                        @endif
                                                    </ul>
                                                </div>
                                                <div class="created-date">
                                                    <ul>
                                                        <li>Created {{ auth()->user()->created_at->format('j F, Y') }}</li>
                                                        @if(auth()->user()->updated_at)
                                                            <li>
                                                                Updated {{ auth()->user()->updated_at->format('j F, Y') }}
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>

                                            @include('includes.user_dashboard_stats')

                                            @if(auth()->user()->is_suspended == 1)
                                                <div class="text-center mt-3 mb-5" style="color: red;">
                                                    <h3>Your profile is suspended. Please contact us as soon as possible !</h3>
                                                </div>
                                            @endif
                                            @if(!auth()->user()->name)
                                                <div class="text-center mt-3 mb-5">
                                                    <h3 style="color: red;">Incomplete Profile!</h3>
                                                    <p>Your profile is incomplete, please complete your profile <a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('my.profile') }}">click here</a></p>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade show active" id="search" role="tabpanel" aria-labelledby="search-tab">
                <div id="search">
                    <div class="container">
                        <div class="employer-search-tap">
                            <div id="normal-search">
                                <div class="single-input full-width">
                                    <label for="search">What position are you looking for</label>
                                    <input type="text" name="search" value="{{ old('search') }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="single-input full-width">
                                            <label for="country">Country</label>
                                            <select name="country">
                                                <option value="{{ $country->id }}">{{ $country->country }}</option>
                                            </select>
                                        </div>


                                    </div>
                                    <div class="col-md-4">
                                        <div class="single-input full-width">
                                            <label for="province">Province</label>
                                            <div id="render_state_data">
                                                <select name="state" onchange="stateSelected()"  id="stateValue">
                                                    <option value="">Choose A Province</option>
                                                    @foreach($states as $state)
                                                        <option value="{{ $state->id }}" {{ old('state') == $state->id ? 'selected' : '' }}>{{ $state->state }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="single-input full-width">
                                            <label for="city">City</label>
                                            <input type="hidden" class="added_city_id" value="{{old('city')}}">
                                            <div id="render_city_data">
                                                <select name="city" id="" required="required">
                                                    <option value="">Choose A City</option>
                                                </select>
                                            </div>
                                            {{--<i class="fas fa-exclamation-circle"></i>--}}
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 text-center sb py-3">
                                        <button href="#" id="search-profile" class="search-btn"><i class="fas fa-search"></i> Search</button>
                                    </div>
                                </div>
                                <p href="#" class="text-center" id="hide"><u>Advance Search</u></p>
                            </div>


                            <div id="advance-search">
                                <div class="single-input full-width">
                                    <label for="search">Search entire profile</label>
                                    <input type="text" name="search" value="{{ old('search') }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="single-input full-width">
                                            <label for="country">Country</label>
                                            <select name="country">
                                                <option value="{{ $country->id }}">{{ $country->country }}</option>
                                            </select>
                                        </div>


                                    </div>
                                    <div class="col-md-4">
                                        <div class="single-input full-width">
                                            <label for="province">Province</label>
                                            <div id="render_state_data">
                                                <select name="state" onchange="stateSelected()"  id="stateValue">
                                                    <option value="">Choose A Province</option>
                                                    @foreach($states as $state)
                                                        <option value="{{ $state->id }}" {{ old('state') == $state->id ? 'selected' : '' }}>{{ $state->state }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="single-input full-width">
                                            <label for="city">City</label>
                                            <input type="hidden" class="added_city_id" value="{{old('city')}}">
                                            <div id="render_city_data">
                                                <select name="city" id="" required="required">
                                                    <option value="">Choose A City</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 px-5 mx-5">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul>
                                                    <li>
                                                        <input type="radio">With all of the words specified
                                                    </li>
                                                    <li>
                                                        <input type="radio">With the exact phrase specified
                                                    </li>
                                                    <li>
                                                        <input type="radio">With the least one of the words specified
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="col-md-6">
                                                <ul>
                                                    <li>
                                                        <input type="radio">With one of the words specified
                                                    </li>
                                                    <li>
                                                        <input type="radio">Since my lost visit
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-12 text-center sb py-3">
                                        <button href="#" id="search-profile" class="search-btn"><i class="fas fa-search"></i> Search</button>
                                    </div>
                                </div>
                                <p href="#" class="text-center" id="show"><u> Hide Advance Search</u></p>

                            </div>


                        </div>

                        @if (Auth::check() && auth()->user()->package_end_date && auth()->user()->package_end_date>date('Y-m-d H:i:s'))

                            <div id="search-show-profile">

                                <div class="row">
                                    <div class="col-md-3">

                                        <div class="filter-results">
                                            <h5 class="text-center" style="background:#F4961E; padding: 15px;">Filter Your Results</h5>

                                            <div class="input-filter-results">
                                                <div class="single-input full-width{{ $errors->has('experience') ? ' has-error' : '' }}">
                                                    <select name="experience" required="required">
                                                        <option value="">Years of Experience</option>
                                                        @foreach($jobExperiences as $jobExperience)
                                                            <option value="{{ $jobExperience->id }}" {{ old('experience') ==  $jobExperience->id ? 'selected' : ''}}>{{ $jobExperience->job_experience }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('experience'))
                                                        <span class="help-block custom-help-block"> <strong>{{ $errors->first('experience') }}</strong> </span>
                                                    @endif
                                                </div>

                                                <div class="single-input full-width{{ $errors->has('education') ? ' has-error' : '' }}">
                                                    <select name="education" required="required">
                                                        <option value=""> Education</option>
                                                        @foreach($degreeLevels as $degreeLevel)
                                                            <option value="{{ $degreeLevel->id }}"  {{ old('education') ==  $degreeLevel->id ? 'selected' : ''}} >{{ $degreeLevel->degree_level }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('education'))
                                                        <span class="help-block custom-help-block"> <strong>{{ $errors->first('education') }}</strong> </span>
                                                    @endif
                                                </div>

                                                <div class="single-input full-width{{ $errors->has('salary_period') ? ' has-error' : '' }}">
                                                    <select name="salary_period" class="select-2">
                                                        <option value="">Salary Period</option>
                                                        @foreach($salaryPeriods as $salaryPeriod)
                                                            <option value="{{$salaryPeriod->id}}" {{ old('salary_period') ==  $salaryPeriod->id ? 'selected' : ''}}>{{ $salaryPeriod->salary_period }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="single-input full-width{{ $errors->has('expected_salary') ? ' has-error' : '' }}">
                                                    <input type="number" name="expected_salary"  min="1" placeholder="{{__('Expected Salary')}}" value="{{old('expected_salary')}}">
                                                </div>

                                                <div class="single-input full-width{{ $errors->has('job_type') ? ' has-error' : '' }}">
                                                    <div class="select2Dropdown">
                                                        <select name="job_type[]" id="job_type" class="select2" required="required">
                                                            <option value="">Job Types</option>
                                                            @foreach($jobTypes as $jobType)
                                                                <option value="{{ $jobType->id }}"  {{in_array($jobType->id, old("job_type") ?: []) ? "selected": ""}}>{{ $jobType->job_type }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('job_type'))
                                                            <span class="help-block custom-help-block"> <strong>{{ $errors->first('job_type') }}</strong> </span>
                                                        @endif
                                                        <div class="errorMessage" style="display: none"></div>
                                                    </div>
                                                </div>

                                                <div class="single-input full-width{{ $errors->has('language') ? ' has-error' : '' }}">
                                                    <div class="select2Dropdown">
                                                        <select name="language[]" id="language" class="select2" required="required">
                                                            <option value="">Language</option>
                                                            @foreach($languages as $language)
                                                                <option value="{{ $language->id }}" {{in_array($language->id, old("language") ?: []) ? "selected": ""}}>{{ $language->lang }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('language'))
                                                            <span class="help-block custom-help-block"> <strong>{{ $errors->first('language') }}</strong> </span>
                                                        @endif
                                                        <div class="errorMessage" style="display: none"></div>
                                                    </div>
                                                </div>

                                                <div class="">
                                                    <input type="checkbox" name="willingradio">
                                                    <label for="willingradio"> Willing To Relocate</label><br>
                                                    <input type="checkbox" name="profilevideo">
                                                    <label for="profilevideo">With Profile Video</label><br>
                                                    <input type="checkbox" name="resumeattach">
                                                    <label for="resumeattach">Resume Attache</label><br><br>
                                                </div>

                                                <button style="width:100%; padding:10px 0px; background: #fff; font-size: 18px; margin-bottom: 10px;"><i class="fas fa-filter"></i> Apply Filters</button>

                                                <button style="width:100%; padding:10px 0px; background: #fff; font-size: 18px; margin-bottom: 10px;"><i class="far fa-save"></i> Save this search</button>
                                                <a href="#" style="color: #000;padding: 15px 30px">View Saved Search</a>

                                            </div>
                                        </div>


                                    </div>

                                    <div class="col-md-9">
                                        <div class="search-results">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p>20 of 1500 Candidates</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-input float-right">
                                                        <div class="select2Dropdown">
                                                            <select name="sortBy" id="sortBy" class="select2" required="required">
                                                                <option value="">Sort by</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="show-profile">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('/') }}assets/images/man.png" alt="">
                                                        </div>

                                                        <i class="far fa-heart top-right-love"></i>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="profile-info">
                                                                    <h4>Md Rakibul Hasan</h4>
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-map-marker"></i> Banasree,Rampura,Dhaka.</p>
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-phone-alt"></i> 01917000804</p>
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-envelope"></i> rakib@rightbrainsolution.com</p>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="profile-right">
                                                                    <p style="margin-bottom: 0rem;">Created: 3, May, 2021</p>
                                                                    <p style="margin-bottom: 0rem;">Update: 3, May, 2021</p>
                                                                    <div class="text-right pr-4">
                                                                        <i class="fas fa-video" style="font-size:25px; margin:2px 5px;"></i>
                                                                        <i class="far fa-save" style="font-size:25px;  margin:2px 5px";></i>
                                                                    </div>

                                                                    <a href="#" class="view-details">View Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="show-profile">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('/') }}assets/images/man.png" alt="">
                                                        </div>

                                                        <i class="far fa-heart top-right-love"></i>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="profile-info">
                                                                    <h4>Md Rakibul Hasan</h4>
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-map-marker"></i> Banasree,Rampura,Dhaka.</p>
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-phone-alt"></i> 01917000804</p>
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-envelope"></i> rakib@rightbrainsolution.com</p>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="profile-right">
                                                                    <p style="margin-bottom: 0rem;">Created: 3, May, 2021</p>
                                                                    <p style="margin-bottom: 0rem;">Update: 3, May, 2021</p>
                                                                    <div class="text-right pr-4">
                                                                        <i class="fas fa-video" style="font-size:25px; margin:2px 5px;"></i>
                                                                        <i class="far fa-save" style="font-size:25px;  margin:2px 5px";></i>
                                                                    </div>

                                                                    <a href="#" class="view-details">View Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="show-profile">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('/') }}assets/images/man.png" alt="">
                                                        </div>

                                                        <i class="far fa-heart top-right-love"></i>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="profile-info">
                                                                    <h4>Md Rakibul Hasan</h4>
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-map-marker"></i> Banasree,Rampura,Dhaka.</p>
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-phone-alt"></i> 01917000804</p>
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-envelope"></i> rakib@rightbrainsolution.com</p>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="profile-right">
                                                                    <p style="margin-bottom: 0rem;">Created: 3, May, 2021</p>
                                                                    <p style="margin-bottom: 0rem;">Update: 3, May, 2021</p>
                                                                    <div class="text-right pr-4">
                                                                        <i class="fas fa-video" style="font-size:25px; margin:2px 5px;"></i>
                                                                        <i class="far fa-save" style="font-size:25px;  margin:2px 5px";></i>
                                                                    </div>

                                                                    <a href="#" class="view-details">View Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="show-profile">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('/') }}assets/images/man.png" alt="">
                                                        </div>

                                                        <i class="far fa-heart top-right-love"></i>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="profile-info">
                                                                    <h4>Md Rakibul Hasan</h4>
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-map-marker"></i> Banasree,Rampura,Dhaka.</p>
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-phone-alt"></i> 01917000804</p>
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-envelope"></i> rakib@rightbrainsolution.com</p>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="profile-right">
                                                                    <p style="margin-bottom: 0rem;">Created: 3, May, 2021</p>
                                                                    <p style="margin-bottom: 0rem;">Update: 3, May, 2021</p>
                                                                    <div class="text-right pr-4">
                                                                        <i class="fas fa-video" style="font-size:25px; margin:2px 5px;"></i>
                                                                        <i class="far fa-save" style="font-size:25px;  margin:2px 5px";></i>
                                                                    </div>

                                                                    <a href="#" class="view-details">View Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="show-profile">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="profile-img">
                                                            <img src="{{ asset('/') }}assets/images/man.png" alt="">
                                                        </div>

                                                        <i class="far fa-heart top-right-love"></i>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="profile-info">
                                                                    <h4>Md Rakibul Hasan</h4>
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-map-marker"></i> Banasree,Rampura,Dhaka.</p>
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-phone-alt"></i> 01917000804</p>
                                                                    <p style="margin-bottom: 0rem;"><i class="fa fa-envelope"></i> rakib@rightbrainsolution.com</p>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="profile-right">
                                                                    <p style="margin-bottom: 0rem;">Created: 3, May, 2021</p>
                                                                    <p style="margin-bottom: 0rem;">Update: 3, May, 2021</p>
                                                                    <div class="text-right pr-4">
                                                                        <i class="fas fa-video" style="font-size:25px; margin:2px 5px;"></i>
                                                                        <i class="far fa-save" style="font-size:25px;  margin:2px 5px";></i>
                                                                    </div>

                                                                    <a href="#" class="view-details">View Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">Next</a>
                                                    </li>
                                                </ul>
                                            </nav>


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
            </div>
        </div>
    </section>









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
    </style>

@endpush
@push('scripts')
    <script>
        function stateSelected() {
            var id = $('#stateValue').val();
            $.ajax({
                type: 'POST',
                url: '{{ route('render_cities') }}',
                data: {id, _token: '{{csrf_token()}}'},
                success: function (data) {
                    $('#render_city_data').html(data['html']);
                }
            });
        }


        /*$(document).ready(function(){
            $("#click").click(function(){
                $("#advance-search").toggle();
            });
        });*/

        $(document).ready(function(){
            $("#hide").click(function(){
                $("#normal-search").hide();
                $("#advance-search").show();
            });
            $("#show").click(function(){
                $("#advance-search").hide();
                $("#normal-search").show();
            });
            $("#search-profile").click(function () {
                $("#search-show-profile").show();
            });
        });



    </script>

    @include('includes.immediate_available_btn')
@endpush