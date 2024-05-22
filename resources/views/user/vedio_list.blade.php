@extends('layouts.app')
@section('content')
    <!-- Header start -->
    @include('includes.header')
    <!-- Header end -->
    <!-- Inner Page Title start -->
    @include('includes.inner_page_title', ['page_title'=>__('Dashboard')])
    <!-- Inner Page Title end -->
    <div class="listpgWraper">
        <div class="container">@include('flash::message')
            <div class="row mb-5">
                @include('includes.user_dashboard_menu')
                <div class="col-lg-9">
                    <div class="profileban">
                        <div class="abtuser">
                            <div class="row">
                                <div class="col-lg-2 col-md-2">
                                    <div class="uavatar">{{auth()->user()->printUserImage()}}</div>
                                </div>
                                <div class="col-lg-10 col-md-10">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <h4>{{auth()->user()->name}}</h4>
                                            <h6><i class="fa fa-map-marker" aria-hidden="true"></i> {{Auth::user()->getLocation()}}</h6>
                                        </div>
                                        <div class="col-lg-5"><div class="editbtbn"><a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('delete.vid') }}">
                                                    <i class="fas fa-pencil-alt" aria-hidden="true"></i>Delete Video</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pl-3">
                                            <ul class="userdata">
                                                <li><i class="fa fa-phone" aria-hidden="true"></i> {{auth()->user()->phone}}</li>
                                                <li class="mt-2"><i class="fa fa-envelope" aria-hidden="true"></i> {{auth()->user()->email}}</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 pl-3 mt-4" style="color: gray; text-align: right; font-size: 13px">
                                            <ul>
                                                <li>Created {{ auth()->user()->created_at->format('j F, Y') }}</li>
                                                <li class="mt-2">Updated {{ auth()->user()->updated_at->format('j F, Y') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @if(isset($video))
                                    <div class="col">
                                        <iframe width="100%" height="300px"  src="https://www.youtube.com/embed/{{ $video->video_id }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                @else
                                <p style="text-align: center">You have not uploaded profile video yet.</p>
                                @endif
                            </div>
                            <div class="col-md-12 mt-3" style="text-align: center;">
                                @if(isset($video) && $video->status == 'waiting_for_approval')
                                    <h4>Your Video Is Waiting For Approval.</h4>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if(auth()->user()->is_suspended == 1)
                        <div class="text-center mt-3 mb-5" style="color: red;">
                            <h3>Your profile is suspended. Please contact us as soon as possible !</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @include('includes.footer_social')
@endsection
@push('scripts')
    @include('includes.immediate_available_btn')
@endpush