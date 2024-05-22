@extends('layouts.app')
@section('content')

    <!-- banner-section -->
    @include('includes/slider')
    <!-- banner-section end -->

    <!-- Events start -->
    @include('includes/events')
    <!-- Events end -->

    <!-- news-style-two -->
{{--    @include('includes/event-calender')--}}
{{--    @include('includes/event-calender-list')--}}
    <!-- news-style-two end -->


    <!-- news-style-two -->
    @include('includes/news-notices')
    <!-- news-style-two end -->



    <!-- Present Athlete start -->
    @include('athlete/present-athlete')
    <!-- Present Athlete end -->


    <!-- Former Athlete start -->
    @include('athlete/former-athlete')
    <!-- Former Athlete end -->


    <!-- Financial Partner Section -->
    @include('includes/finacial-partner')
    <!-- team-section end -->


@endsection

@push('styles')
{{--    <link href="{{asset('/')}}design/assets/css/style_new.css" rel="stylesheet">--}}
@endpush

@push('scripts')

@endpush
