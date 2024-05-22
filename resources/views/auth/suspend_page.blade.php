@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end -->
<!-- Inner Page Title start -->
@include('includes.inner_page_title', ['page_title'=>__('Confirm Verification')])
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mt-5">
                <h2 style="color:red;">Please verify your email !</h2>
                <a href="{{ route('login') }}">Login</a>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
