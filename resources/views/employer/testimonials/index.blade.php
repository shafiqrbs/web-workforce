@extends('layouts.app')
@section('content')
    <!-- Header start -->
    @include('includes.header')
    <!-- Header end -->
    @include('includes.employer_tab')


    <section id="dashboard">
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
                                        @if($testimonial)
                                            <a onclick="deleteTestimonial()">Delete Review</a>
                                        @else
                                            <a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('user.testimonial.page') }}">
                                                Add a Review
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

                                        </ul>
                                    </div>
                                </div>
                                <div class="jobseeker-form">
                                    <div class="form-items">

                                        <div class="main-body">
                                            @if(isset($testimonial))
                                                <div class="col">
                                                    <h5 class="mb-5">Your Review</h5>
                                                    <small>Created at {{ date('d M Y', strtotime($testimonial->created_at)) }}</small><br><br>
                                                    <div class="mb-3">
                                                        <div class="testimonialReview" id="dataReadonlyReview"
                                                             data-rating-stars="5"
                                                             data-rating-readonly="true"
                                                             data-rating="{{$testimonial->rating}}"
                                                             data-rating-input="#dataReadonlyInput">
                                                        </div>
                                                        {{--@for ($i = 0; $i < $testimonial->rating; $i++)
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        @endfor--}}
                                                    </div>
                                                    <p class="text-justify">{{ $testimonial->testimonial }}</p>

                                                </div>
                                            @else
                                                <p class="red-text text-center">You have not added a review yet.</p>
                                            @endif
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
    </section>


    @include('includes.footer_social')
@endsection

@push('styles')
    <link href="{{asset('/')}}css/custom-bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        .testimonialReview{
            font-size: 25px;
            text-align: left;
        }
    </style>

@endpush
@push('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        function deleteTestimonial() {
            swal({
                title: "Are you sure you want to delete this review ?",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '{{ route('user.testimonial.delete') }}',
                            success: function(data){
                                location.reload();
                            }
                        });
                    }
                });
        }

        $("#dataReadonlyReview").starRating({
            totalStars: 5,
            emptyColor: 'white',
            hoverColor: '#ff8000',
            activeColor: '#ff8000',
            strokeColor: '#ff8000',
            strokeWidth: 9,
            useGradient: true,
            readOnly: true,
            starGradient: {
                start: '#ff8000',
                end: '#ff8000'
            },
        });
    </script>
@endpush