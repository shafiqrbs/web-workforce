@extends('layouts.app')

@section('content')
{{--    @include('includes.header')--}}
{{--    @include('includes.inner_page_title')--}}

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

        <div class="form-inner">
            <div class="sec-title centred">
                <h6><i class="flaticon-star"></i><span>{{$pageTitle}} Registration</span><i class="flaticon-star"></i></h6>
{{--                <h2>{{$pageTitle}}</h2>--}}
                <div class="title-shape"></div>
                <p>Fill up this registration form successfully to BSSF.</p>
            </div>

            @include('flash::message')

            {!! Form::open(array('method' => 'post', 'route' => 'register',"id"=>"athlete-form" ,'class' => 'default-form', 'files'=>true,'autocomplete'=>'off')) !!}
                <div class="row clearfix">

                    <div class="col-md-12 big-column athlete-section-shadow" style="margin-top: 20px;">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 big-column">
                                <h3 class="account-information">Personal Information </h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 big-column " style="padding-right: 25px !important;">
                                <div class="form-group athelete-mg-0">
                                    <label class="athlete-label-14">Athlete Name</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::text('athlete_name','', array('class'=>'athlete-field-height','required'=>'true','placeholder'=>'Athlete Name')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'athlete_name') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Age</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::number('age','', array('class'=>'form-control athlete-field-height','required'=>'true','placeholder'=>'Age')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'age') !!}
                                </div>


                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Mobile</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::text('mobile','', array('class'=>'athlete-field-height', 'id'=>'mobile','required'=>'true','placeholder'=>'Mobile')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'mobile') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Profession</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::select('profession_id',$professions,'', array('class'=>'form-control ignore athlete-field-height', 'id'=>'profession_id','placeholder'=>'Choose Profession')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'profession_id') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Blood Group</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::select('blood_group_id',$bloodGroups,'', array('class'=>'form-control ignore athlete-field-height', 'id'=>'blood_group_id','placeholder'=>'Choose Blood Group')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'blood_group_id') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Height</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::text('height','', array('class'=>'athlete-field-height', 'id'=>'height','required'=>'true','placeholder'=>'Height')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'height') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Marital Status</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::select('marital_status',$maritalStatus,'', array('class'=>'form-control ignore athlete-field-height', 'id'=>'marital_status','placeholder'=>'Choose Marital Status')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'marital_status') !!}
                                </div>



                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Father Name</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::text('father_name','', array('class'=>'athlete-field-height','required'=>'true','placeholder'=>'Father Name')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'father_name') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Home Town</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::text('hometown','', array('class'=>'ignore athlete-field-height', 'id'=>'hometown','required'=>'true','placeholder'=>'Hometown')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'hometown') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Higher Education</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::text('higher_education','', array('class'=>'athlete-field-height', 'id'=>'higher_education','required'=>'true','placeholder'=>'Higher Education')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'higher_education') !!}
                                </div>


                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">District</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::select('district_id',$cities,'', array('class'=>'form-control ignore athlete-field-height js-example-basic-single', 'id'=>'district_id','placeholder'=>'Choose District')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'district_id') !!}
                                </div>


                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 big-column " style="padding-left: 25px !important;">
                                <div class="form-group athelete-mg-0">
                                    <label class="athlete-label-14">Profile Image</label> <span class="color-red font-size-12">*</span> <span style="font-size: 10px">( Greater than or equal to width 270px & height 270px. )</span>
                                    {!! Form::file('profile_image', array('class'=>'form-control athlete-field-height', 'id'=>'profile_image','required'=>'true','accept'=>'image/*')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'profile_image') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Gender</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::select('gender_id',$genders,'', array('class'=>'form-control ignore athlete-field-height', 'id'=>'gender_id','placeholder'=>'Choose gender')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'gender_id') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Email</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::text('email','', array('class'=>'athlete-field-height','required'=>'true','placeholder'=>'Email')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'email') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Date of birth</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::date('date_of_birth','', array('class'=>'form-control athlete-field-height', 'id'=>'date_of_birth','required'=>'true')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'date_of_birth') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Place Of Birth</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::text('place_of_birth','', array('class'=>'athlete-field-height', 'id'=>'place_of_birth','required'=>'true','placeholder'=>'Place of Birth')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'place_of_birth') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Weight</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::text('weight','', array('class'=>'athlete-field-height', 'id'=>'weight','required'=>'true','placeholder'=>'Weight')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'weight') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Hobbies</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::text('hobbies','', array('class'=>'athlete-field-height', 'id'=>'hobbies','placeholder'=>'Hobbies')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'hobbies') !!}
                                </div>


                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Mother Name</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::text('mother_name','', array('class'=>'athlete-field-height', 'id'=>'mother_name','required'=>'true','placeholder'=>'Mother Name')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'mother_name') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Event</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::text('event','', array('class'=>'athlete-field-height', 'id'=>'event','required'=>'true','placeholder'=>'Event')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'event') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Address</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::text('address','', array('class'=>'athlete-field-height', 'id'=>'address','required'=>'true','placeholder'=>'Address')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'address') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Club</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::select('club_id',$clubs,'', array('class'=>'form-control ignore athlete-field-height js-example-basic-single', 'id'=>'club_id','placeholder'=>'Choose Club')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'club_id') !!}
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 big-column athlete-section-shadow" style="margin-top: 30px;">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 big-column" style="margin-top: 5px !important;padding-right: 25px !important;">
                                <h3 class="account-information">Sports Associated Information</h3>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 big-column" style="margin-top: 5px !important;padding-left: 25px !important;">
                                <h3 class="account-information">Parent/Guardian & Emergency Information </h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 big-column " style="padding-right: 25px !important;">
                                <div class="form-group athelete-mg-0">
                                    <label class="athlete-label-14">Athlete Type</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::select('athlete_type',$athleteTypes,'', array('class'=>'form-control ignore athlete-field-height', 'id'=>'athlete_type','placeholder'=>'Choose Athlete Type')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'athlete_type') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Start Of Competition</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::text('start_of_competition','', array('class'=>'athlete-field-height', 'id'=>'start_of_competition','required'=>'true','placeholder'=>'Start of Competition')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'start_of_competition') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Practicing Shooter Sign</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::text('practicing_shooter_sign','', array('class'=>'athlete-field-height', 'id'=>'practicing_shooter_sign','placeholder'=>'Practicing Shooter Sine')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'practicing_shooter_sign') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">National Coach Name</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::text('name_of_national_coach','', array('class'=>'athlete-field-height', 'id'=>'name_of_national_coach','required'=>'true','placeholder'=>'Name of National Coach')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'name_of_national_coach') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Handedness</label>
                                    {!! Form::text('handedness','', array('class'=>'athlete-field-height', 'id'=>'handedness','placeholder'=>'Handedness')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'handedness') !!}
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 big-column " style="padding-left: 25px !important;">
                                <div class="form-group athelete-mg-0">
                                    <label class="athlete-label-14">Parent Name</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::text('parent_full_name','', array('class'=>'athlete-field-height', 'id'=>'parent_full_name','required'=>'true','placeholder'=>'Parent Name')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'parent_full_name') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Parent Mobile</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::text('parent_mobile','', array('class'=>'athlete-field-height', 'id'=>'parent_mobile','required'=>'true','placeholder'=>'Parent Phone Number')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'parent_mobile') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Relationship</label> <span class="color-red font-size-12">*</span>
                                    {!! Form::text('relationship','', array('class'=>'athlete-field-height', 'id'=>'relationship','required'=>'true','placeholder'=>'Relationship')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'relationship') !!}
                                </div>

                                <div class="form-group athelete-mg-0 athlete-mg-top">
                                    <label class="athlete-label-14">Parent Address</label>
                                    {!! Form::text('parent_address','', array('class'=>'athlete-field-height', 'id'=>'parent_address','placeholder'=>'Parent Address')) !!}
                                    {!! APFrmErrHelp::showErrors($errors, 'parent_address') !!}
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12 col-md-12 col-sm-12 big-column athlete-section-shadow" style="margin-top: 30px !important;">
                        <h3 class="account-information">Participation of Local Competition Achievements</h3>
                        <table class="table table-responsive" id="competitionTable">
                            <thead>
                            <tr class="tableHeaderBG">
                                <th class="table-label">Date / Year</th>
                                <th class="table-label" width="25%">Name of Competition</th>
                                <th class="table-label">Event</th>
                                <th class="table-label">Score</th>
                                <th class="table-label">Position</th>
                                <th class="text-center table-label" width="10%"><i class="fa fa-cog" aria-hidden="true"></i></th>
                            </tr>
                            <tr class="addMoreTableRow">
                                <th>
                                    {!! Form::date('competition_date[]','',['id'=>'competition_date','class' => 'form-control athlete-field-height']) !!}
                                </th>
                                <th width="25%">
                                    {!! Form::text('competition_name[]','',['id'=>'competition_name','class' => 'form-control athlete-field-height','placeholder'=>'Competition Name']) !!}
                                </th>
                                <th>
                                    {!! Form::text('competition_event[]','',['id'=>'event','class' => 'form-control athlete-field-height','placeholder'=>'Event']) !!}
                                </th>
                                <th>
                                    {!! Form::text('score[]','',['id'=>'score','class' => 'form-control athlete-field-height','placeholder'=>'Score']) !!}
                                </th>
                                <th>
                                    {!! Form::text('position[]','',['id'=>'position','class' => 'form-control athlete-field-height','placeholder'=>'Position']) !!}
                                </th>
                                <th width="10%">
                                    <button type="button" class="btn btn-sm btn-outline-secondary addMoreButton athlete-field-height" id="createNewCompetition" sl-no="1">
                                        <i class="fas fa-plus-circle"></i> More
                                    </button>
                                </th>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 big-column" style="margin-top: 20px;">
                        <div class="message-btn">
                            <button class="theme-btn" type="submit" name="submit-form">Submit</button>
                        </div>
                    </div>

                </div>
            {!! Form::close() !!}

        </div>
    </div>
</section>
@push('styles')
                <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .account-information{
            padding-bottom: 15px !important;
            font-weight: bold;
            font-size: 22px;
            color: #429f73;
        }
        .color-red{
            color: red;
        }

        .addMoreButton{
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
            height: 38px;
        }

        .athelete-mg-0{
            margin-bottom: 0px !important;
        }
        .athlete-field-height{
            height: 35px !important;
            font-size: 12px !important;
        }
        .athlete-label-10{
            font-size: 10px;
        }
        .athlete-label-14{
            font-size: 14px;
            color: #201f1f;
        }
        .table-label{
            color: #201f1f;
            line-height: 26px;
            font-weight: 400;
            font-size: 14px;
        }
        #athlete_name-error,#profile_image-error,#athlete_type-error,#age-error,#email-error,#father_name-error,#date_of_birth-error,#gender_id-error,#mobile-error,#mother_name-error,#address-error,#height-error,#blood_group_id-error,#start_of_competition-error,#weight-error,#profession_id-error,#practicing_shooter_sign-error,#name_of_national_coach-error,#hometown-error,#event-error,#place_of_birth-error,#marital_status-error,#hobbies-error,#higher_education-error,#parent_full_name-error,#parent_mobile-error,#relationship-error,#district_id-error{
            color: red;
            font-size: 10px;
            margin-bottom: 0px;
        }
        .athlete-mg-top{
            margin-top: 5px;
        }

        .athlete-section-shadow{
            border: 1px solid;
            border-style: dotted;
            padding: 15px 20px;
            box-shadow: 0px 0px 15px #bdb6b6;
        }
        .font-size-12{
            font-size: 12px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            font-size: 12px !important;
        }
    </style>
@endpush

@push('scripts')
                <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

                <script>
                    $(document).ready(function() {
                        $('.js-example-basic-single').select2();
                    });

        var index=1;
        $(document).delegate('#createNewCompetition','click',function () {
            index++;
                $('#competitionTable').append('<tr class="addMoreTableRow" id="removeRow_'+index+'"><th>{!! Form::date("competition_date[]",null,["id"=>"competition_date","class" =>  "form-control athlete-field-height"]) !!}</th><th width="25%">{!! Form::text("competition_name[]",null,["id"=>"competition_name","class" => "form-control athlete-field-height","placeholder"=>"Competition Name"]) !!}</th><th>{!! Form::text( "competition_event[]",null,[ "id"=> "competition_event", "class" =>  "form-control athlete-field-height", "placeholder "=> "Event "]) !!}</th><th>{!! Form::text( "score[]",null,[ "id "=> "score", "class" =>  "form-control athlete-field-height", "placeholder"=> "Score"]) !!}</th><th>{!! Form::text( "position[]",null,[ "id"=> "position", "class" =>  "form-control athlete-field-height", "placeholder"=> "Position"]) !!}</th><th width="10%"><button type="button" style="width:62px" class="btn btn-sm btn-outline-secondary athlete-field-height addMoreButton" id="removeRow" rowID="'+index+'"><i class="fa fa-times" aria-hidden="true"></i></button></th></tr>');
        });

        $(document).on('click', '#removeRow', function(){
            var button_id = $(this).attr("rowID");
            $('#removeRow_'+button_id+'').remove();
        });
    </script>
@endpush


@push('scripts')
    <script>
        if($('#athlete-form').length){
            $('#athlete-form').validate({
                rules: {
                    athlete_name: {
                        required: true
                    },
                    profile_image: {
                        required: true
                    },
                    athlete_type: {
                        required: true
                    },
                    age: {
                        required: true
                    },
                    email: {
                        required: true,
                        email : true
                    },
                    date_of_birth: {
                        required: true
                    },
                    gender_id: {
                        required: true
                    },
                    mobile: {
                        required: true,
                        number:true
                    },
                    mother_name: {
                        required: true
                    },
                    address: {
                        required:true,
                    },
                    height: {
                        required:true,
                    },
                    blood_group_id: {
                        required:true,
                    },
                    start_of_competition: {
                        required:true,
                    },
                    weight: {
                        required:true,
                    },
                    profession_id: {
                        required:true,
                    },
                    practicing_shooter_sign: {
                        required:true,
                    },
                    name_of_national_coach: {
                        required:true,
                    },
                    hometown: {
                        required:true,
                    },
                    event: {
                        required:true,
                    },
                    place_of_birth: {
                        required:true,
                    },
                    marital_status: {
                        required:true,
                    },
                    hobbies: {
                        required:true,
                    },
                    higher_education: {
                        required:true,
                    },
                    parent_full_name: {
                        required:true,
                    },
                    parent_mobile: {
                        required:true,
                        number: true
                    },
                    relationship: {
                        required:true
                    },
                    district_id: {
                        required:true
                    }
                },
                messages: { // custom messages for radio buttons and checkboxes
                    athlete_name: {
                        required: "Athlete Name field is required."
                    },
                    profile_image: {
                        required: " Profile Image field is required."
                    },
                    athlete_type: {
                        required: "Athlete Type field is required."
                    },
                    age: {
                        required: " Age field is required."
                    },
                    email: {
                        required: " Email field is required.",
                        email: " Email must be valid.",
                    },
                    father_name: {
                        required: " Father name field is required.",
                    },
                    date_of_birth: {
                        required: " Date of birth field is required.",
                    },
                    gender_id: {
                        required: " Gender field is required.",
                    },
                    mobile: {
                        required: " Mobile field is required.",
                        number:'Mobile must be valid'
                    },
                    mother_name: {
                        required: " Mother name field is required.",
                    },
                    address: {
                        required: " Address field is required.",
                    },
                    height: {
                        required: " Height field is required.",
                    },
                    blood_group_id: {
                        required: " Blood group field is required.",
                    },
                    start_of_competition: {
                        required: " Start of competition field is required.",
                    },
                    weight: {
                        required: " Weight field is required.",
                    },
                    profession_id: {
                        required: " Profession field is required.",
                    },
                    practicing_shooter_sign: {
                        required: " Practicing shooter sign field is required.",
                    },
                    name_of_national_coach: {
                        required: " National coach field is required.",
                    },
                    hometown: {
                        required: " Hometown field is required.",
                    },
                    event: {
                        required: " Event field is required.",
                    },
                    place_of_birth: {
                        required: " Place of birth field is required.",
                    },
                    marital_status: {
                        required: " Marital status field is required.",
                    },
                    hobbies: {
                        required: " Hobbies field is required.",
                    },
                    higher_education: {
                        required: " Higher education field is required.",
                    },
                    parent_full_name: {
                        required: " Parent name field is required.",
                    },
                    parent_mobile: {
                        required: " Parent mobile field is required.",
                        number : "Parent mobile must be valid"
                    },
                    relationship: {
                        required: " Relationship field is required."
                    },
                    district_id: {
                        required: " District field is required."
                    }
                }
            });
        }
    </script>
@endpush

@endsection