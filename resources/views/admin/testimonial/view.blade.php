@extends('admin.layouts.admin_layout')
@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>
                    <li> <a href="{{ route('list.testimonials') }}">Testimonial</a> <i class="fa fa-circle"></i> </li>
                    <li> <span>View Testimonial</span> </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- END PAGE HEADER-->
            <br />
            @include('flash::message')
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-red-sunglo"> <i class="icon-settings font-red-sunglo"></i> <span class="caption-subject bold uppercase">Testimonial View</span> </div>
                        </div>
                        <div class="portlet-body form">
                            <ul class="nav nav-tabs">
                                <li class="active"> <a href="#Details" data-toggle="tab" aria-expanded="false"> Details </a> </li>
                            </ul>

                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="dataReadonlyReview" data-rating="{{$testimonial->rating}}">
                                    </div>
                                    <div class="pt-2">
                                        <h4 class="text-left">{{$testimonial->user?$testimonial->user->first_name:''}}</h4>
                                    </div>
                                    <div>
                                        <p class="text-left">{{$testimonial->testimonial}}</p>
                                    </div>

                                    <div class="pt-2">
                                        <p class="text-left font-weight-bold">Date of Review: <span style="font-weight:400;">{{$testimonial->created_at->format('F Y')}}</span></p>
                                    </div>

                                </li>

                            </ul>


                            {{--{!! Form::model($testimonial, array('method' => 'put', 'route' => array('update.testimonial', $testimonial->id), 'class' => 'form', 'files'=>true)) !!}
                            {!! Form::hidden('id', $testimonial->id) !!}
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="Details"> @include('admin.testimonial.forms.form') </div>
                            </div>
                            {!! Form::close() !!}--}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CONTENT BODY -->
        </div>
@endsection

@push('css')
    <link href="{{asset('/')}}css/star-rating-svg.css" rel="stylesheet">
@endpush
@push('scripts')
            <script type="text/javascript" src="{{ asset('/') }}js/jquery.star-rating-svg.js"></script>

            <script type="text/javascript">
        $(".dataReadonlyReview").starRating({
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
