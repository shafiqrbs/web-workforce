@extends('layouts.app')
@section('content')
<!-- Header start -->
{{--@include('includes.header')--}}
<!-- Header end -->
@include('includes.employer_tab')


<section id="dashboard">
    <div class="">
        <div class="imr">
            <div class="im-12">
                <div class="dashboard-inner" style="background: #f1f1f1;">
                    @include('includes.employer_dashboard_menu')

                    <div class="dashboard-tab-content">
                        @include('flash::message')

                        <div class="profile-main-top">
                            <div class="edit-profile-btn">
                                <a href="{{ route('my.profile') }}">Edit Profile</a>
                            </div>
                            <div class="profile-image">
                                {{$athleteData->printAtheleteImage()}}
                            </div>
                            <div class="profile-details">

                                <h2 style="width: 425px; padding-top: 20px;">{{$athleteData->athlete_name ? $athleteData->athlete_name : ''}}</h2>
                                <ul>

                                    @if($athleteData->hometown)
                                        <li><i class="fa fa-map-marker"></i>&nbsp;&nbsp;{{$athleteData->hometown}}</li>
                                    @endif
                                    @if($athleteData->mobile)
                                        <li><i class="fa fa-phone"></i>&nbsp;&nbsp;{{$athleteData->mobile}}</li>
                                    @endif
                                    @if(auth()->user()->email)
                                        <li><i class="fa fa-envelope"></i>&nbsp;&nbsp;{{auth()->user()->email}}</li>
                                    @endif
                                </ul>
                            </div>
                            <div class="created-date">
                                <ul>
                                    <li>Created {{ $athleteData->created_at->format('j F, Y') }}</li>
                                    @if($athleteData->updated_at)
                                        <li>
                                            Updated {{ $athleteData->updated_at->format('j F, Y') }}
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endif
                                {{--                @include('flash::message')--}}
                                    {!! Form::model($athleteData, array('method' => 'put', 'route' => array('update.my.profile', $athleteData->id), 'class' => 'form', 'files'=>true,'autocomplete'=>'off','style'=>'padding-left: 20px;padding-top: 10px;','id'=>'athlete-form')) !!}

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
                                                        <label class="athlete-label-14">Athlete Name</label>
                                                        {!! Form::text('athlete_name',null, array('class'=>'form-control athlete-field-height','required'=>'true','placeholder'=>'Athlete Name')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Age</label>
                                                        {!! Form::number('age',null, array('class'=>'form-control athlete-field-height','required'=>'true','placeholder'=>'Age')) !!}
                                                    </div>


                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Mobile</label>
                                                        {!! Form::text('mobile',null, array('class'=>'form-control athlete-field-height', 'id'=>'mobile','required'=>'true','placeholder'=>'Mobile')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Profession</label>
                                                        {!! Form::select('profession_id',$professions,null, array('class'=>'form-control ignore athlete-field-height', 'id'=>'profession_id','placeholder'=>'Choose Profession')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Blood Group</label>
                                                        {!! Form::select('blood_group_id',$bloodGroups,null, array('class'=>'form-control ignore athlete-field-height', 'id'=>'blood_group_id','placeholder'=>'Choose Blood Group')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Height</label>
                                                        {!! Form::text('height',null, array('class'=>'form-control athlete-field-height', 'id'=>'height','required'=>'true','placeholder'=>'Height')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Marital Status</label>
                                                        {!! Form::select('marital_status',$maritalStatus,null, array('class'=>'form-control ignore athlete-field-height', 'id'=>'marital_status','placeholder'=>'Choose Marital Status')) !!}
                                                    </div>



                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Father Name</label>
                                                        {!! Form::text('father_name',null, array('class'=>'form-control athlete-field-height','required'=>'true','placeholder'=>'Father Name')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Home Town</label>
                                                        {!! Form::text('hometown','null', array('class'=>'ignore form-control  athlete-field-height', 'id'=>'hometown','required'=>'true','placeholder'=>'Hometown')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Higher Education</label>
                                                        {!! Form::text('higher_education',null, array('class'=>'form-control athlete-field-height', 'id'=>'higher_education','required'=>'true','placeholder'=>'Higher Education')) !!}
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 big-column " style="padding-left: 25px !important;">
                                                    <div class="form-group athelete-mg-0">
                                                        <label class="athlete-label-14">Profile Image</label>
                                                        {!! Form::file('profile_image', array('class'=>'form-control athlete-field-height', 'id'=>'profile_image','required'=>'true','accept'=>'image/*')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Gender</label>
                                                        {!! Form::select('gender_id',$genders,null, array('class'=>'form-control ignore athlete-field-height', 'id'=>'gender_id','placeholder'=>'Choose gender')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Email</label>
                                                        {!! Form::text('email',null, array('class'=>'form-control athlete-field-height','required'=>'true','placeholder'=>'Email')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Date of birth</label>
                                                        {!! Form::date('date_of_birth',null, array('class'=>'form-control form-control athlete-field-height', 'id'=>'date_of_birth','required'=>'true')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Place Of Birth</label>
                                                        {!! Form::text('place_of_birth',null, array('class'=>'form-control athlete-field-height', 'id'=>'place_of_birth','required'=>'true','placeholder'=>'Place of Birth')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Weight</label>
                                                        {!! Form::text('weight',null, array('class'=>'form-control athlete-field-height', 'id'=>'weight','required'=>'true','placeholder'=>'Weight')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Hobbies</label>
                                                        {!! Form::text('hobbies',null, array('class'=>'form-control athlete-field-height', 'id'=>'hobbies','placeholder'=>'Hobbies')) !!}
                                                    </div>


                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Mother Name</label>
                                                        {!! Form::text('mother_name',null, array('class'=>'form-control athlete-field-height', 'id'=>'mother_name','required'=>'true','placeholder'=>'Mother Name')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Event</label>
                                                        {!! Form::text('event',null, array('class'=>'form-control athlete-field-height', 'id'=>'event','required'=>'true','placeholder'=>'Event')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Address</label>
                                                        {!! Form::text('address',null, array('class'=>'form-control athlete-field-height', 'id'=>'address','required'=>'true','placeholder'=>'Address')) !!}
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
                                                        <label class="athlete-label-14">Athlete Type</label>
                                                        {!! Form::select('athlete_type',$athleteTypes,null, array('class'=>'form-control ignore athlete-field-height', 'id'=>'athlete_type','placeholder'=>'Choose Athlete Type')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Start Of Competition</label>
                                                        {!! Form::text('start_of_competition',null, array('class'=>'form-control athlete-field-height', 'id'=>'start_of_competition','required'=>'true','placeholder'=>'Start of Competition')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Practicing Shooter Sign</label>
                                                        {!! Form::text('practicing_shooter_sign',null, array('class'=>'form-control athlete-field-height', 'id'=>'practicing_shooter_sign','placeholder'=>'Practicing Shooter Sine')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">National Coach Name</label>
                                                        {!! Form::text('name_of_national_coach',null, array('class'=>'form-control athlete-field-height', 'id'=>'name_of_national_coach','required'=>'true','placeholder'=>'Name of National Coach')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Handedness</label>
                                                        {!! Form::text('handedness',null, array('class'=>'form-control athlete-field-height', 'id'=>'handedness','placeholder'=>'Handedness')) !!}
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 big-column " style="padding-left: 25px !important;">
                                                    <div class="form-group athelete-mg-0">
                                                        <label class="athlete-label-14">Parent Name</label>
                                                        {!! Form::text('parent_full_name',null, array('class'=>'form-control athlete-field-height', 'id'=>'parent_full_name','required'=>'true','placeholder'=>'Parent Name')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Parent Mobile</label>
                                                        {!! Form::text('parent_mobile',null, array('class'=>'form-control athlete-field-height', 'id'=>'parent_mobile','required'=>'true','placeholder'=>'Parent Phone Number')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Relationship</label>
                                                        {!! Form::text('relationship',null, array('class'=>'form-control athlete-field-height', 'id'=>'relationship','required'=>'true','placeholder'=>'Relationship')) !!}
                                                    </div>

                                                    <div class="form-group athelete-mg-0 athlete-mg-top">
                                                        <label class="athlete-label-14">Parent Address</label>
                                                        {!! Form::text('parent_address',null, array('class'=>'form-control athlete-field-height', 'id'=>'parent_address','placeholder'=>'Parent Address')) !!}
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
                                                    <th class="text-center table-label" width="10%">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary addMoreButton" id="createNewCompetition" sl-no="1">
                                                            <i class="fas fa-plus-circle"></i>
                                                        </button>
                                                    </th>
                                                </tr>
                                                @if($athleteCompetitionData)
                                                    @foreach($athleteCompetitionData as $competition)
                                                <tr class="addMoreTableRow" id="removeRow_{{$competition['id']}}">
                                                    <th>
                                                        {!! Form::date('competition_date[]',$competition['competition_date'],['id'=>'competition_date','class' => 'form-control athlete-field-height']) !!}
                                                    </th>
                                                    <th width="25%">
                                                        {!! Form::text('competition_name[]',$competition['competition_name'],['id'=>'competition_name','class' => 'form-control athlete-field-height','placeholder'=>'Competition Name']) !!}
                                                    </th>
                                                    <th>
                                                        {!! Form::text('competition_event[]',$competition['competition_event'],['id'=>'event','class' => 'form-control athlete-field-height','placeholder'=>'Event']) !!}
                                                    </th>
                                                    <th>
                                                        {!! Form::text('score[]',$competition['score'],['id'=>'score','class' => 'form-control athlete-field-height','placeholder'=>'Score']) !!}
                                                    </th>
                                                    <th>
                                                        {!! Form::text('position[]',$competition['position'],['id'=>'position','class' => 'form-control athlete-field-height','placeholder'=>'Position']) !!}
                                                    </th>
                                                    <th width="10%">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary addMoreButton" id="removeRow" rowID="{{$competition['id']}}"><i class="fa fa-times" aria-hidden="true"></i></button>
                                                    </th>
                                                </tr>
                                                @endforeach
                                                @endif
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

{{--                        @include('employer.custom-employer-profile')--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{--@include('includes.footer_social')--}}
@endsection
@push('styles')
    <link href="{{asset('/')}}css/custom-bootstrap.min.css" rel="stylesheet">
<style type="text/css">
    .addMoreButton{
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
        height: 38px;
    }
    .userccount p{ text-align:left !important;}
    .color-red{
        color: red;
    }
    .account-information{
        font-size: 22px;
        font-weight: bold;
        padding-bottom: 12px;
    }
    #name-error{
        color: red;
    }
    /*Dashboard Start*/
    #dashboard {
        border-top: 15px solid #13549F;
    }
    .dashboard-tab {
        background: #FFFAE8;
    }
    .dashboard-inner {
        display: flex;
        flex-wrap: wrap;
        -webkit-flex-wrap: wrap;
    }

    #dashboard {
        border-top: 15px solid #13549F;
        margin-bottom: 200px;
    }
    .dashboard-tab {
        background: #FFFAE8;
        min-width: 300px;
        border-radius: 0 0 140px 140px;
        padding-top: 30px;
    }
    .dashboard-inner {
        display: flex;
    }
    .dashboard-tab-content {
        width: calc(100% - 329px);
    }
    .edit-profile-btn {
        position: absolute;
        right: 0;
        top: 0;
    }
    .edit-profile-btn a {
        display: inline-block;
        color: #FFF;
        font-weight: bold;
        font-size: 20px;
        padding: 7px 30px;
        background: #FF2E17;
        border-radius: 50px 0 0 50px;
        padding-left: 60px;
        position: relative;
    }
    .edit-profile-btn a::before {
        content: "";
        width: 18px;
        height: 18px;
        background: #FFF;
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        border-radius: 50%;
    }
    .edit-profile-btn a::after {
        content: "";
        width: 12px;
        height: 12px;
        background: #000;
        position: absolute;
        left: 27px;
        top: 50%;
        transform: translateY(-50%);
        border-radius: 50%;
    }
    .profile-main-top {
        background: #FFFAE8;
        display: flex;
        position: relative;
        align-items: center;
        padding-left: 10px;
        margin-top: 25px;
    }
    .profile-image {
        width: 20%;
        padding: 25px;
    }
    .profile-details {
        width: 100%;
    }
    .created-date {
        position: absolute;
        right: 0;
        bottom: 30px;
    }
    .profile-details h2 {
        color: #13549F;
        text-transform: uppercase;
        font-weight: bold;
    }
    .profile-details li svg {
        color: #FF2E17;
        font-weight: 300;
        font-size: 14px;
        display: inline-block;
        position: absolute;
        left: 0;
        top: 4px;
    }
    .profile-details li {
        position: relative;
        padding-left: 26px;
        font-weight: bold;
        display: block;
    }
    .created-date li {
        font-weight: bold;
    }
    .profile-boxs {
        display: flex;
        flex-wrap: wrap;
        -webkit-flex-wrap: wrap;
        margin-top: 30px;
        margin-left: 20px;
    }
    .single-box {
        padding: 35px 15px;
        border: 6px solid #FFF;
        border-radius: 40px;
        box-shadow: 0 0 7px rgba(0,0,0,.3);
        text-align: center;
        font-weight: bold;
        margin: 14px;
        width: calc(100% / 3 - 30px);
    }
    .single-box.sky {
        background: rgb(255,255,255);
        background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgba(136,217,234,1) 92%);
    }
    .single-box h2 {
        font-weight: bold;
        color: #FF2E17;
        margin: 15px 0;
        font-size: 35px;
    }
    .single-box .active-btn {
        width: 90px;
        height: 40px;
        background: #00AB4F;
        margin: auto;
        border: 2px solid #00AB4F;
        border-radius: 3px;
        position: relative;
        transition: .3s;
        margin-bottom: 20px;
    }
    .single-box .active-btn::before {
        content: "";
        width: 48%;
        height: 100%;
        background: #FFF;
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
    }
    .single-box p {
        font-size: 19px;
        margin: 0;
    }
    .single-box.gray {
        background: rgb(255,255,255);
        background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgba(243,213,187,1) 92%);
    }
    .single-box img {
        max-height: 55px;
    }
    .activer {
    }
    .activer h4 {
        font-weight: bold;
        font-size: 20px;
        display: inline-block;
        background: #FFF;
        padding: 15px 30px;
        border-radius: 0 50px 50px 0;
    }
    .dashboard-tab li {
        position: relative;
        display: block;
        font-weight: bold;
        font-size: 18px;
    }
    .dashboard-tab li img {
        position: absolute;
        left: 30px;
        max-width: 25px;
        top: 50%;
        transform: translateY(-50%);
    }

    .dashboard-tab li a {
        display: block;
        padding: 11px;
        padding-left: 70px;
        color: #000;
        transition: .3s;
    }
    .dashboard-tab li a:hover {
        background: #FFF;
    }

    .single-box.yellow {
        background: rgb(255,255,255);
        background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgba(253,191,22,1) 92%);
    }
    .single-box.green {
        background: rgb(255,255,255);
        background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgba(128,199,78,1) 92%);
    }
    /*Dashboard end*/

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
    #athlete_name-error,#profile_image-error,#athlete_type-error,#age-error,#email-error,#father_name-error,#date_of_birth-error,#gender_id-error,#mobile-error,#mother_name-error,#address-error,#height-error,#blood_group_id-error,#start_of_competition-error,#weight-error,#profession_id-error,#practicing_shooter_sign-error,#name_of_national_coach-error,#hometown-error,#event-error,#place_of_birth-error,#marital_status-error,#hobbies-error,#higher_education-error,#parent_full_name-error,#parent_mobile-error,#relationship-error{
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
</style>
@endpush
@push('scripts')

    <script>
        var index=1;
        $(document).delegate('#createNewCompetition','click',function () {
            index++;
            {{--$('#competitionTable').append('<tr class="addMoreTableRow" id="removeRow_'+index+'"><th>{!! Form::date("competition_date[]",null,["id"=>"competition_date","class" =>  "form-control athlete-field-height"]) !!}</th><th width="25%">{!! Form::text("competition_name[]",null,["id"=>"competition_name","class" => "form-control athlete-field-height","placeholder"=>"Competition Name"]) !!}</th><th>{!! Form::text( "competition_event[]",null,[ "id"=> "competition_event", "class" =>  "form-control athlete-field-height", "placeholder "=> "Event "]) !!}</th><th>{!! Form::text( "score[]",null,[ "id "=> "score", "class" =>  "form-control athlete-field-height", "placeholder"=> "Score"]) !!}</th><th>{!! Form::text( "position[]",null,[ "id"=> "position", "class" =>  "form-control athlete-field-height", "placeholder"=> "Position"]) !!}</th><th width="10%"><button type="button" style="width:62px" class="btn btn-sm btn-outline-secondary athlete-field-height addMoreButton" id="removeRow" rowID="'+index+'"><i class="fa fa-times" aria-hidden="true"></i></button></th></tr>');--}}
            $('#competitionTable').append('<tr class="addMoreTableRow" id="removeRow_'+index+'"><th>{!! Form::date("competition_date[]",null,["id"=>"competition_date","class" =>  "form-control","required"=>"true"]) !!}</th><th width="25%">{!! Form::text("competition_name[]",null,["id"=>"competition_name","class" => "form-control","placeholder"=>"Competition Name","required"=>"true"]) !!}</th><th>{!! Form::text( "competition_event[]",null,[ "id"=> "competition_event", "class" =>  "form-control", "placeholder "=> "Event "]) !!}</th><th>{!! Form::text( "score[]",null,[ "id "=> "score", "class" =>  "form-control", "placeholder"=> "Score"]) !!}</th><th>{!! Form::text( "position[]",null,[ "id"=> "position", "class" =>  "form-control", "placeholder"=> "Position"]) !!}</th><th width="10%" style="text-align:center"><button type="button" class="btn btn-sm btn-outline-secondary addMoreButton" id="removeRow" rowID="'+index+'"><i class="fa fa-times" aria-hidden="true"></i></button></th></tr>');
        });

        $(document).on('click', '#removeRow', function(){
            var button_id = $(this).attr("rowID");
            $('#removeRow_'+button_id+'').remove();
        });
    </script>


    <script>
    $('.profile_image_remove').on('click', function () {
        var element = $(this);
        var url = $(this).attr('data-action');
        var blankImageUrl = $(this).attr('data-image-url');
        if(confirm('Are You Sure Delete Profile Image?')){
            $.get(url, function( data ) {
                if(data.status==200){
                    element.remove();
                    $('.addedImage').attr('src',blankImageUrl);
                    // $('.addedImage').remove();
                }
            });
        }

    })
    </script>

@include('includes.immediate_available_btn')
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
                    }
                }
            });
        }
    </script>
@endpush