@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end --> 
<!-- Inner Page Title start -->
@include('includes.inner_page_title', ['page_title'=>__('Page Expired')])
<!-- Inner Page Title end -->
<section id="title">
    <div class="title-inner">
        <div class="container">
            <div class="imr">
                <div class="im-12">
                    <div class="title">
                        <h2>Page Expired</h2>
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
                <p>{{__('The page has expired due to inactivity. Please refresh and try again.')}}</p>
            </div>
        </div>
    </div>
</section>

@include('includes.footer_social')
@endsection
