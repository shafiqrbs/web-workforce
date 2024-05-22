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
                            <h2>Upload Profile Video</h2>
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
                                        <h2>Profile Video</h2>
                                        <div class="jobseeker-form">
                                            <div class="form-items">
                                                <form id="videoForm" class="form-horizontal" method="POST" action="{{ route('save.video') }}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="form-step step-one">
                                                        <div class="single-input{{ $errors->has('title') ? ' has-error' : '' }}">
                                                            <label for="title">Title *</label>
                                                            <textarea id="title" name="title" rows="1" required="required" placeholder="{{__('Video Title')}}">{{ old('title') }}</textarea>
                                                            @if ($errors->has('title'))
                                                                <span class="help-block custom-help-block">
                                                                <strong>{{ $errors->first('title') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="single-input{{ $errors->has('description') ? ' has-error' : '' }}">
                                                            <label for="description">Video Description *</label>
                                                            <textarea id="description" rows="1" type="text" name="description" required="required" placeholder="{{__('Video Description')}}">{{ old('description') }}</textarea>
                                                            @if ($errors->has('description'))
                                                                <span class="help-block custom-help-block">
                                                                <strong>{{ $errors->first('description') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="single-input full-width {{ $errors->has('video') ? ' has-error' : '' }}">
                                                            <label for="video">Video *</label><br>
                                                            <input style="padding-left: 0;width: auto" type="file" id="video"  class="form-control" name="video" required="required">
                                                            <br>
                                                            <span>Video duration must be less than 45 seconds</span>
                                                            <video controls width="300px" height="250px" id="vid" style="display:none"></video>
                                                            @if ($errors->has('video'))
                                                                <div style="margin-top: 5px">
                                                        <span class="help-block custom-help-block">
                                                            <strong>{{ $errors->first('video') }}</strong>
                                                        </span>
                                                                </div>
                                                            @endif
                                                            <span class="help-block custom-help-block"></span>
                                                        </div>
                                                        <br>
                                                        <div class="uploadStatus"></div>
                                                        <div class="single-submit-button">
                                                            <input type="submit" value="Upload">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

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
        </div>
    </section>


    @include('includes.footer_social')
@endsection
@push('scripts')
    <script type="text/javascript">
        var objectUrl;
        $("#video").change(function(e) {
            var file = e.currentTarget.files[0];
            objectUrl = URL.createObjectURL(file);
            $("#vid").prop("src", objectUrl);
        });

        $("#videoForm").submit(function(e) {
            e.preventDefault();
            var seconds = $("#vid")[0].duration;
            if (seconds > 45){
                $('.custom-help-block').html('Video duration should not be more than 45 seconds');
                return false;
            }
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            $(".progress-bar").width(percentComplete + '%');
                            $(".progress-bar").html(percentComplete+'%');
                        }
                    }, false);
                    return xhr;
                },
                url         : $('form#videoForm').attr( 'action' ),
                type        : $('form#videoForm').attr( 'method' ),
                data        : new FormData($('form#videoForm')[0]),
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $(".progress-bar").width('0%');
                },
                error:function(){
                    $('.uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
                },
                success: function(data){
                    if(data === 'success'){
                        $('.uploadStatus').html('<p style="color:green;">Video has been successfully uploaded.</p>');

                        window.location = '/approval/video';
                    }
                }
            });
        });
    </script>
@endpush