@extends('layouts.app')
@section('content')
        <!-- banner-section -->
        @include('includes/slider')
        <!-- banner-section end -->
        <!-- banner-section -->

        <!-- banner-section end -->
        <!-- banner-section -->
        @include('includes.page.aboutus')
        <!-- banner-section end -->
        <!-- banner-section -->
        @include('includes.page.achivement')
        <!-- banner-section end -->
        <!-- event-section -->
        @include('includes.page.programs')
        <!-- event-section end -->
        <!-- event-section -->
        @include('includes.page.event')
        <!-- event-section end -->
        <!-- Financial Partner Section -->
        @include('includes/factory-partner')
        <!-- Financial Partner end -->
        <!-- banner-section -->
       {{-- @include('includes.page.target')--}}
        <!-- banner-section end -->

        <!-- news-section -->
        @include('includes.page.news')
        <!-- news-section end -->

        <!-- banner-section -->
      {{--  @include('includes.page.members')--}}
        <!-- banner-section end -->

        <!-- Financial Partner Section -->
        @include('includes/finacial-partner')
        <!-- Financial Partner end -->

        <!-- banner-section -->
        @include('includes.page.map')
        <!-- banner-section end -->
@endsection

@push('styles')
{{--    <link href="{{asset('/')}}design/assets/css/style_new.css" rel="stylesheet">--}}
@endpush

@push('scripts')

@endpush
