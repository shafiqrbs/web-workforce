@extends('layouts.app')
@section('content')

    <!-- Inner Page Title start -->
    @include('includes.inner_page_title', ['page_title'=>__('Login')])


    <section class="contact-style-two sec-pad custom-section-pad">
        <div class="auto-container">
            @include('flash::message')

            <div class="form-inner">
                <div class="sec-title centred">
                    <h6><i class="flaticon-star"></i><span>Drop a Line</span><i class="flaticon-star"></i></h6>
                    <h2>Login</h2>
                    <div class="title-shape"></div>
                    <p>Fill out this form to login your account on BSSF.</p>
                </div>
                {!! Form::open(array('method' => 'post', 'route' => 'login',"id"=>"login-form" ,'class' => 'default-form', 'files'=>true,'autocomplete'=>'off')) !!}
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-6 col-sm-12 offset-md-3 big-column">
                        <div class="form-group athelete-mg-0">
                            {!! Form::text('email','', array('class'=>'athlete-field-height-45','required'=>'true','placeholder'=>'Email address')) !!}
                            <label class="athlete-label-10">&nbsp;{!! APFrmErrHelp::showErrors($errors, 'email') !!}</label>
                        </div>

                        <div class="form-group athelete-mg-0">
                            {!!  Form::password('password', ['class' => 'athlete-field-height-45','placeholder'=>__('Password'),'style'=>'border:1px solid #e6e6ea;width: 100%;padding: 10px 20px;border-radius: 5px;']) !!}

{{--                            <input id="password" type="password" class="form-control athlete-field-height-45" name="password" value="" required placeholder="{{__('Password')}}">--}}
                            <label class="athlete-label-10">&nbsp;{!! APFrmErrHelp::showErrors($errors, 'password') !!}</label>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 offset-md-3 big-column text-center">
                        <div class="form-group athelete-mg-0">
                            <button class="theme-btn " type="submit" name="submit-form">Login</button>
                        </div>

                        <div style="margin-top: 15px;">
                            <i class="fa fa-user" aria-hidden="true"></i> {{__('New Athlete')}}? <a href="{{route('register')}}">{{__('Register Here')}}</a>
                        </div>

                    </div>

                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </section>

    {{--<section id="jobseeker">
        <div class="container">
            <div class="mb-5">
                @include('flash::message')
            </div>
            <div class="imr">
                <div class="im-12">
                    <div class="jobseeker-inner">
                        --}}{{--<h2>Jobseeker</h2>--}}{{--
                        <div class="jobseeker-form">
                            <div class="form-items">
                                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="candidate_or_employer" value="candidate"/>

                                    <div class="single-input full-width {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email">Email </label>
                                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="{{__('Email Address')}}">
                                        @if ($errors->has('email'))
                                            <span class="help-block custom-help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="single-input full-width {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="email">Password </label>
                                        <input id="password" type="password" class="form-control" name="password" value="" required placeholder="{{__('Password')}}">
                                        @if ($errors->has('password'))
                                            <span class="help-block custom-help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="single-submit-button">
                                        <input type="submit" value="Login">
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="im-12 mt-5">
                    <div class="text-center"><i class="fa fa-user" aria-hidden="true"></i> {{__('New User')}}? <a href="{{route('register')}}">{{__('Register Here')}}</a></div>
                    <div class="text-center"><i class="fa fa-user" aria-hidden="true"></i> {{__('Forgot Your Password')}}? <a href="{{ route('password.request') }}">{{__('Click here')}}</a></div>
                </div>
            </div>
        </div>--}}
    </section>

{{--    @include('includes.footer_social')--}}
@endsection

@push('styles')
    <style>
        .athelete-mg-0{
            margin-bottom: 0px !important;
        }
        .athlete-field-height-45{
            height: 45px !important;
        }
        #email-error,#password-error{
            color: red;
            font-size: 10px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        if($('#login-form').length){
            $('#login-form').validate({
                rules: {
                    email: {
                        required: true,
                        email : true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    email: {
                        required: " Email field is required.",
                        email: " Email must be valid.",
                    }
                }
            });
        }
    </script>
@endpush
