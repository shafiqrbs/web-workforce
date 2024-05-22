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
                            <h2>Add a Review</h2>
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
                                        <h2>Add a Review</h2>
                                        <div class="jobseeker-form">
                                            <div class="form-items">
                                                <form id="videoForm" class="form-horizontal" method="POST" action="{{ route('save.user.review') }}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}

                                                    <div class="single-input full-width">
                                                        <textarea type="text" name="testimonial" rows="4" class="form-control" placeholder="Comments *" required="required">{{ old('testimonial') }}</textarea>
                                                    </div>

                                                    <div class="single-input full-width">
                                                        <label>Please select number of stars</label>
                                                        <div class="testimonialReview" id="review"></div>
                                                        <input type="hidden" name="rating" class="ratingValue" value="">
                                                    </div>

                                                    <div class="single-submit-button">
                                                        <input type="submit" value="Save Review">
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

@push('styles')
    <style type="text/css">
        .testimonialReview{
            font-size: 25px;
            text-align: left;
        }
        .testimonialReview i{
            margin-right: 5px;
        }
    </style>
@endpush

@push('scripts')
    <script type="text/javascript">
        $("#review").starRating({
            totalStars: 5,
            emptyColor: 'white',
            hoverColor: '#ff8000',
            activeColor: '#ff8000',
            strokeColor: '#ff8000',
            strokeWidth: 9,
            initialRating: 0,
            useGradient: true,
            useFullStars: true,
            starGradient: {
                start: '#ff8000',
                end: '#ff8000'
            },
            callback: function(currentRating){
                $('.ratingValue').val(currentRating);
            }
        });
    </script>

@endpush