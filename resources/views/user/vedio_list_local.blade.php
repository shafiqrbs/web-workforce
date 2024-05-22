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
                                <div class="profile-main-top">
                                    <div class="edit-profile-btn">

                                        @if($video)
                                            <a onclick="deleteVideo()">Delete Video</a>
                                        @else
                                            <a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('upload.video') }}">
                                                Upload Video
                                            </a>
                                        @endif


                                    </div>
                                    <div class="profile-image">
                                        {{auth()->user()->printUserImage()}}
                                    </div>
                                    <div class="profile-details">
                                        <h2>{{auth()->user()->name ? auth()->user()->name : ''}}</h2>
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
                                        <ul style="text-align: right">
                                            <li>Created {{ auth()->user()->created_at->format('j F, Y') }}</li>
                                            @if(auth()->user()->updated_at)
                                                <li>
                                                    Updated {{ auth()->user()->updated_at->format('j F, Y') }}
                                                </li>
                                            @endif
                                            @if(isset($video) && $video->status == 'submitted_for_approval')
                                                <li class="mt-2 red-text">Video Submitted for Approval</li>
                                            @elseif(isset($video) && $video->status == 'approved')
                                                <li class="mt-2 red-text"> Video Approved</li>
                                            @elseif(isset($video) && $video->status == 'notapproved')
                                                <li class="mt-2 red-text"> Video Not Approved</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                @if(isset($video))
                                <div class="main-body">
                                    <div class="single-input full-width">
                                        <label for="title">Title </label>
                                        <p>{{ $video->title }}</p>
                                    </div>
                                    <div class="single-input full-width">
                                        <label for="description">Video Description </label>
                                        <p>{{ $video->description }}</p>
                                    </div>
                                </div>
                                @endif
                                <div class="main-body">
                                    <div class="form-items">

                                            @if(isset($video))
                                                <div class="col">
                                                    <video controls controlsList="nodownload" width="100%" height="400px" id="vid" src="{{ asset('/uploads/video/'.$video->video) }}"></video>
                                                </div>
                                            @else
                                                <p class="red-text text-center">You have not uploaded profile video yet.</p>
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
            </div>
        </div>
    </section>


    @include('includes.footer')
@endsection
@push('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function deleteVideo() {
            swal({
                title: "Are you sure you want to delete this video ?",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '{{ route('delete.vid') }}',
                        success: function(data){
                            location.reload();
                        }
                    });
                }
            });
        }
    </script>
@endpush