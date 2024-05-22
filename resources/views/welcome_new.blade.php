@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end -->

<!-- Slider start -->
@include('includes.slider_new')
<!-- Slider end -->

<!-- How it Works start -->
@include('includes.how_it_works')
<!-- How it Works Ends -->


@include('includes.footer')
@endsection

@push('styles')
    <link href="{{asset('/')}}design/assets/css/style_new.css" rel="stylesheet">
@endpush


@push('scripts')
    <script>
        $(document).ready(function ($) {
            $("form").submit(function () {
                $(this).find(":input").filter(function () {
                    return !this.value;
                }).attr("disabled", "disabled");
                return true;
            });
            $("form").find(":input").prop("disabled", false);
        });

    </script>
    @include('includes.country_state_city_js')
@endpush
