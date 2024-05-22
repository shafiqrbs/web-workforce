
@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Inner Page Title start -->
@include('includes.inner_page_title')
<!-- Inner Page Title end -->

<section id="title">
    <div class="title-inner">
        <div class="container">
            <div class="imr">
                <div class="im-12">
                    <div class="title">
                        <h2>{{ __('Verify Email') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="jobseeker">
    <div class="container">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A new verification link has been sent to your email address.') }}

            </div>
        @endif
        <div class="imr">
            <div class="im-12">
                <p></p>
                <div class="text-center">
                    <div class="main-body">
                        {{__('The Link You Followed Has Expired. To verify your email, ')}}
                    </div>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <div class="single-submit-button mt-5">
                            <input type="submit" value="{{ __('Please click here.') }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@include('includes.footer_social')
@endsection