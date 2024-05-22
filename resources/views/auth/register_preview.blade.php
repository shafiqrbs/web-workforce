@extends('layouts.app')
@section('content')
    @include('includes.header')
    @include('includes.inner_page_title')

    <section id="title">
        <div class="title-inner">
            <div class="container">
                <div class="imr">
                    <div class="im-12">
                        <div class="title">
                            <h2>Registration Preview</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="jobseeker" style="background-color: #FFFCE6; padding-top: 50px;">
        <div class="container">
            <div class="imr">
                <div class="im-12">
                    <div class="jobseeker-inner">
                        <div class="jobseeker-form">
                            <div class="usercoverName" style="padding: 20px; color: white">
                                <h3>{{ $user->getName() }}</h3>

                                <div class="row mt-2">

                                    <div class="col-md-6">
                                        <div class="desi">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            {{$user->getLocation()}}
                                        </div>
                                        {{$user->street_address? 'Street Address: '.$user->street_address :''}}
                                        <br>
                                        {{$user->postal_code ? 'Postal Code: '.$user->postal_code :''}}
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <h6>{{((bool)$user->is_immediate_available)? 'Available Now':'Unavailable Now'}}</h6>
                                        <h6> Profile {{((bool)$user->profile_visibility)? 'Public':'Private'}}</h6>
                                        <h6>   {{((bool)$user->willing_to_relocate)? 'Willing To Relocate':'Not Willing To Relocate'}}</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <h5 class="mb-4" style="font-weight:bold;">{{__('Registration Information')}}</h5>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('register_cancel', ['id'=> $user->id]) }}"><button class="btn btn-warning btn-sm"><b>Cancel</b></button></a>
                                    <a href="{{ route('register_edit', ['id'=> $user->id]) }}"><button class="btn btn-info  btn-sm"><b>Edit</b></button></a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">Email</div>
                                        <div class="col-md-8">{{ $user->email}}</div>
                                    </div>
                                    @if(isset($user->phone))
                                        <div class="row mt-3">
                                            <div class="col-md-4">Telephone Number</div>
                                            <div class="col-md-8">{{ $user->phone}}</div>
                                        </div>
                                    @endif
                                    <div class="row mt-3">
                                        <div class="col-md-4">Gender</div>
                                        <div class="col-md-8">{{ $user->gender->gender}}</div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">Level Of Education</div>
                                        <div class="col-md-8">{{ $user->degreeLevel->degree_level}}</div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">Experience</div>
                                        <div class="col-md-8">{{ $user->jobExperience->job_experience}}</div>
                                    </div>
                                    @if($user->expected_salary && $user->salaryPeriod)
                                        <div class="row mt-3">
                                            <div class="col-md-4">Expected Salary</div>
                                            <div class="col-md-8">{{ $user->expected_salary}}
                                                {{ $user->salaryPeriod->salary_period  }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">Job Title(s)</div>
                                        <div class="col-md-8">
                                            @foreach($user->userJobTitles as $item)
                                                <li style="list-style-type: none; padding-bottom: 8px">{{ $item->jobTitle->job_title }}</li>
                                            @endforeach
                                        </div>
                                    </div>

                                    @if($user->other_job_title)
                                        <div class="row mt-2">
                                            <div class="col-md-4">Other Job Titles</div>
                                            <div class="col-md-8">
                                                {{ $user->other_job_title }}
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row mt-3">
                                        <div class="col-md-4">Job Type(s)</div>
                                        <div class="col-md-8">
                                            @foreach($user->userJobTypes as $item)
                                                <li style="list-style-type: none; padding-bottom: 8px">{{ $item->jobType->job_type }}</li>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">Language(s)</div>
                                        <div class="col-md-8">
                                            @foreach($user->userLanguages as $item)
                                                <li style="list-style-type: none; padding-bottom: 8px">{{ $item->language->lang }}</li>
                                            @endforeach
                                        </div>
                                    </div>
                                    @if($user->other_languages)
                                        <div class="row mt-2">
                                            <div class="col-md-4">Other Languages</div>
                                            <div class="col-md-8">
                                                {{ $user->other_languages }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <form id="register_confirm" class="form-horizontal" method="POST" action="{{ route('register_confirm', $user->id) }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12 mt-4 text-center">
                                        <div style="font-size: 14px">
                                            {{--<input type="checkbox" value="1" id="checkboxTerms" required="required" onchange="modal()" name="terms_of_use" />--}}
                                            {{--<a class="link" href="javascript:">{{__('I have read and agree to the Terms of use')}}</a>--}}
                                        </div>
                                    </div>
                                    <div class="single-submit-button">
                                        <input type="button"  onclick="modalLink()" value="Confirm Registration">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container">
              <!-- The Modal -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">Terms of Use</h4>
                          <button type="button" class="close" data-dismiss="modal">X</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body termsModal about-wraper">
                          {!! $terms !!}
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer" style="justify-content: left">

                          {{--<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                          <button type="button" class="btn confirmButton" style="background:#ffcb32">OK</button>--}}
                            <input type="checkbox" value="1" id="checkboxTerms" required="required" onchange="modal()" name="terms_of_use" />
                            <a class="link" href="javascript:">{{__('I have read and agree to the Terms of use')}}</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>

    @include('includes.footer_social')
@endsection
@push('styles')

  {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}
  <link href="{{asset('/')}}css/custom-bootstrap.min.css" rel="stylesheet">

  <style type="text/css">
        .formrow iframe {
            height: 78px;
        }
        .default-btn{
            background: #ffcb32; font-weight: bold;
        }

        .modal{
            display: none;
        }
        .termsModal{
            text-align: justify;
            padding: 30px;
            line-height: 30px;
            font-size: 16px;
            height: 70vh;
            overflow-y: scroll;
        }
    </style>
@endpush


@push('scripts')
<!-- jQuery Modal -->


    <script type="text/javascript">
        function modal() {
            var check =  $('#checkboxTerms').is(':checked');
            if(check == true){
                $('#register_confirm').submit();
                $('#myModal').modal('hide');
            }
        }

        function modalLink() {
            $('#myModal').modal('show');
        }
        $(document).on('click','.confirmButton',function () {
            $('#register_confirm').submit();
            $('#myModal').modal('hide');
        })

    </script>
@endpush