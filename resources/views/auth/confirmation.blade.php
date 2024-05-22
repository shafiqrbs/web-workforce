@extends('layouts.app')
@section('content')
    @include('includes.header')
    @include('includes.inner_page_title')
    <section id="title">
        <div class="title-inner">
            <div class="container">
                <div class="imr">
                    <div class="im-12">
                        <div class="title">
                            <h2>Registration Confirmation</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="jobseeker">
        <div class="container">
            <div class="imr">
                <div class="im-12">
                    <div class="usercoverName text-center" style="padding: 20px; color: white">
                        <h3>Congratulations {{$user->getName() }} !</h3>
                    </div>
                    <div class="text-left mt-5 mb-6">
                        <p>You have successfully registered. A verification email has been sent to you. Please follow the instructions in order to activate your account.</p>
                        {{--<button type="submit" class="btn btn-sm mt-3" style=" background: #ffcb32; font-weight: bold;"><b>Login</b></button>--}}
                    </div>
                    {{--<div class="single-submit-button">
                        <a href="{{ route('login')}}"><input type="submit" value="Login"></a>
                    </div>--}}
                </div>
            </div>
        </div>
    </section>

    @include('includes.footer')
@endsection