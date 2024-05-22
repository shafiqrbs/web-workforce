@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end -->
<!-- Inner Page Title start -->
@include('includes.inner_page_title', ['page_title'=>__('Reset Password')])
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

                            <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="token" value="{{ $token }}">

                                <input id="email" type="hidden" class="form-control" name="email" value="{{ app('request')->input('email') }}" placeholder="Email Address" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block custom-help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                @endif
                                <div class="single-input full-width {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password">Password *</label>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block custom-help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="single-input full-width {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <label for="password-confirm">Confirm Password *</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block custom-help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="single-submit-button">
                                    <input type="submit" value="{{__('Reset Password')}}">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="mt-5">
                    <div style="float: left" class="im-md-6 text-right">
                        <i class="fa fa-user" aria-hidden="true"></i> {{__('Login')}}? <a href="{{route('login')}}">{{__('Click Here')}}</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@include('includes.footer_social')
@endsection
