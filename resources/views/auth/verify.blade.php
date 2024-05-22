@extends('layouts.app')
@section('content')
@include('includes.header')
@include('includes.inner_page_title', ['page_title'=>__('Verify Email')])

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

                    <div class="text-center">
                        <div class="main-body">
                            <h3 class="card-header">{{ __('Verify Your Email Address') }}</h3>
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                        </div>
                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <div class="single-submit-button mt-5">
                                        <input type="submit" value="{{ __('click here to request another') }}">
                                    </div>
                                </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @include('includes.footer_social')
@endsection