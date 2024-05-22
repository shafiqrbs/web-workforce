@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
@include('includes.inner_page_title', ['page_title'=>__('Verify Email')])

<!-- Header end -->

<section id="title">
    <div class="title-inner">
        <div class="container">
            <div class="imr">
                <div class="im-12">
                    <div class="title">
                        <h2>Confirmation</h2>
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
                <div class="text-center">
                    <div class="main-body">
                        <h4>
                            Your Account has been deleted! <br>
                            Thank you for using our site and hopefully we helped with your HTT Career!
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('includes.footer_social')
@endsection