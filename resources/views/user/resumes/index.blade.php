@extends('layouts.app')
@section('content')
    <!-- Header start -->
    @include('includes.header')
    <!-- Header end -->
    <!-- Inner Page Title start -->
    @include('includes.inner_page_title', ['page_title'=>__('Dashboard')])
    <!-- Inner Page Title end -->

    <section id="title">
        <div class="title-inner">
            <div class="container">
                <div class="imr">
                    <div class="im-12">
                        <div class="title">
                            <h2>Manage Resume</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="dashboard">
        <div class="container">
            <div class="imr">
                <div class="im-12">
                    <div class="dashboard-inner">
                        @include('flash::message')
                        @include('includes.user_dashboard_menu')

                        <div class="dashboard-tab-content">
                            <div class="profile-main">
                                <div class="profile-main-top-custom">
                                    <div class="jobseeker-inner">
                                        <h2>Add Your Resume</h2>
                                        <div class="jobseeker-form">
                                            <div class="form-items">
                                                <form enctype="multipart/form-data" method="POST" action="{{route('save.resume')}}">
                                                    {{ csrf_field() }}

                                                    <div class="single-input full-width">
                                                        <input type="file" name="resume" required="required">
                                                        @if ($errors->has('resume'))
                                                            <div style="margin-top: 15px">
                                                                <span class="help-block custom-help-block">
                                                                    <strong>{{ $errors->first('resume') }}</strong>
                                                                </span>
                                                            </div>
                                                        @else
                                                            <div style="padding-left: 13px;margin-top: 10px">
                                                                <span>You can add only one resume and it must be a file of type: docx or pdf.</span>
                                                            </div>
                                                        @endif
                                                    </div>


                                                    <div class="col-md-12 resume-table mt-4">
                                                        <h5 class="mb-3">Your Resume</h5>
                                                        @if(isset($userResume))
                                                            <table id="resume">
                                                                <thead>

                                                                <tr>
                                                                    <th>Resume File</th>
                                                                    <th>Created</th>
                                                                    <th>Delete</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                <tr>
                                                                    <td><a  href="{{route('show.resume',['id'=> $user->id]) }}">{{ str_replace($user->id.'-', "",$userResume->cv_file) }}</a></td>
                                                                    <td>{{ Carbon\Carbon::parse($userResume->created_at)->format('d M Y') }}</td>
                                                                    <td><a href="{{ route('delete.resume', ['id'=>$userResume->id]) }}"><i class="fa fa-trash"></i></a></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        @else
                                                            <p>You Haven't Uploaded Resume Yet !</p>
                                                        @endif
                                                    </div>

                                                    <div class="single-submit-button">
                                                        <input type="submit" value="Save">
                                                    </div>


                                                </form>
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


    @include('includes.footer_social')
@endsection
@push('scripts')
        @include('includes.immediate_available_btn')
    @endpush
