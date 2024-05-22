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
                        <h2>Reset Password</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="jobseeker">
    <div class="container">
        @if (session('status'))
            <div style="margin-left: 0px" class="mb-5 alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="imr">
            <div class="im-12">
                <div class="jobseeker-inner">
                    <h2>Reset Password</h2>
                    <div class="jobseeker-form">
                        <div class="form-items">

                            <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="candidate_or_employer" value="candidate" />
                                <div class="single-input full-width {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email">Email </label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="{{__('Email Address')}}">
                                    @if ($errors->has('email'))
                                        <span class="help-block custom-help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="single-submit-button">
                                    <input type="submit" value="{{__('Send Password Reset Link')}}">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="mt-5 im-12 text-center">
                <i class="fa fa-user" aria-hidden="true"></i> {{__('Have an Account')}}? <a href="{{route('login')}}">{{__('Sign in')}}</a>
            </div>
        </div>
    </div>
</section>

@include('includes.footer_social')
@endsection
