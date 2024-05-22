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
                            <h2>My Video</h2>
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
                                <h2>My Video</h2>
                                <div class="profile-main-top">
                                    <div class="edit-profile-btn">
                                        <a onclick="deleteVideo()">Delete Video</a>
                                    </div>
                                    <div class="profile-image" style="padding-left: 0">
                                        {{auth()->user()->printUserImage()}}
                                    </div>
                                    <div class="profile-details">
                                        <h3>{{auth()->user()->name ? auth()->user()->name : ''}}</h3>
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
                                <div class="jobseeker-form">
                                    <div class="form-items">

                                            <div class="form-step step-one">
                                                <div class="single-input full-width">
                                                    <label for="title">Title </label>
                                                    <p>{{ $video->title }}</p>
                                                </div>
                                                <div class="single-input full-width">
                                                    <label for="description">Video Description </label>
                                                    <p>{{ $video->description }}</p>
                                                </div>
                                                @if(isset($video))
                                                    <div class="col mt-3 mb-3">
                                                        <video controls controlsList="nodownload" width="100%" height="400px" id="vid" src="{{ asset('/uploads/video/'.$video->video) }}"></video>
                                                    </div>
                                                @endif
                                                @if(isset($video))
                                                    <div class="single-submit-button">
                                                        <input type="button" class="btn btn-block" onclick="window.location='{{ route("video.submit.approval") }}'" value="Submit Video for Approval">
                                                    </div>
                                                @endif

                                            </div>


                                    </div>

                                </div>
                            </div>
                                </div>

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
    </section>

    @include('includes.footer_social')
@endsection
@push('scripts')
    @include('includes.immediate_available_btn')
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function deleteVideo() {
            swal({
                title: "Are you sure you want to cancel submission ?",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '{{ route('delete.vid') }}',
                        success: function(data){
                            window.location = '{{ route('list.video') }}';
                        }
                    });
                }
            });
        }
    </script>
@endpush