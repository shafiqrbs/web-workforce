@extends('layouts.app')
@section('content')
<!-- Header start -->
{{--@include('includes.header')--}}
<!-- Header end --> 
<!-- Inner Page Title start -->
{{--@include('includes.inner_page_title', ['page_title'=>__('Frequently asked questions')])--}}
<!-- Inner Page Title end -->
<!-- Page Title End -->

@if(isset($bannerData) && !empty($bannerData))
    <section class="page-title" style="background-image: url({{asset('banner/'.$bannerData->banner_image)}});">
        @else
            <section class="page-title" style="background-image: url({{asset('banner/no-image.jpg')}});">
                @endif
                <div class="auto-container">
                    <div class="content-box">
                        <div class="title centred">
                            @if(isset($bannerData) && !empty($bannerData))
                                <h1>{{$bannerData->banner_title}}</h1>
                            @else
                                <h1>No Banner title</h1>
                            @endif
                        </div>
                        <ul class="bread-crumb clearfix">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li>{{'FAQ'}}</li>
                            @if(isset($pathPageTitle) && !empty($pathPageTitle))
                                <li>{{$pathPageTitle}}</li>
                            @endif
                            @if(isset($subPathPageTitle) && !empty($subPathPageTitle))
                                <li>{{$subPathPageTitle}}</li>
                            @endif

                        </ul>
                    </div>
                </div>
            </section>

<section class="faq-page-section faq-section sec-pad sec-pad-news">
    <div class="auto-container">
        <div class="sec-title centred">
            <h6><i class="flaticon-star"></i><span>Get Answers</span><i class="flaticon-star"></i></h6>
            <h2>Find the Answer You Need</h2>
            <div class="title-shape"></div>
        </div>
        <div class="row clearfix">

            <div class="col-lg-12 col-md-12 col-sm-12">
                <ul class="accordion-box">

                    @if(isset($faqs) && count($faqs))
                        @foreach($faqs as $faq)

                            <li class="accordion block {{ $loop->index==0?'active-block':'' }}">
                                <div class="acc-btn {{ $loop->index==0?'active':'' }}">
                                    <div class="icon-outer"></div>
                                    <h5><span>{{ $loop->index+1 }} </span>{!! $faq->faq_question !!}</h5>
                                </div>
                                <div class="acc-content" style="{{ $loop->index==0?'display:block':'' }}">
                                    <div class="text">
                                        <p>{!! $faq->faq_answer !!}</p>
                                    </div>
                                </div>
                            </li>


                        @endforeach
                    @endif


                </ul>

            </div>
        </div>
    </div>
</section>

{{--@include('includes.footer_social')--}}
@endsection

@push('styles')

    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}
{{--    <link href="{{asset('/')}}css/custom-bootstrap.min.css" rel="stylesheet">--}}

    <style type="text/css">
        .accordion_one .panel-group {
            border: 1px solid #f1f1f1;
            margin-top: 100px
        }

        a:link {
            text-decoration: none
        }

        .accordion_one .panel {
            background-color: transparent;
            box-shadow: none;
            border-bottom: 0px solid transparent;
            border-radius: 0;
            margin: 0
        }

        .accordion_one .panel-default {
            border: 0
        }

        .accordion-wrap .panel-heading {
            padding: 0px;
            border-radius: 0px
        }

        h4 {
            font-size: 18px;
            line-height: 24px
        }

        .accordion_one .panel .panel-heading a.collapsed {
            display: block;
            padding: 12px 30px;
            border-top: 0px
        }

        .accordion_one .panel .panel-heading a {
            display: block;
            padding: 12px 30px;
            background: #fff;
            border-bottom: 1px solid #f1f1f1
        }

        .accordion-wrap .panel .panel-heading a {
            font-size: 14px
        }

        .accordion_one .panel-group .panel-heading+.panel-collapse>.panel-body {
            border-top: 0;
            padding-top: 0;
            padding: 25px 30px 30px 35px;
            background: #fff;
            color: #000
        }

        .img-accordion {
            width: 81px;
            float: left;
            margin-right: 15px;
            display: block
        }

        .accordion_one .panel .panel-heading a.collapsed:after {
            content: "\2b";
            color: #999999;
            background: #f1f1f1
        }

        .accordion_one .panel .panel-heading a:after,
        .accordion_one .panel .panel-heading a.collapsed:after {
            font-family: 'FontAwesome';
            font-size: 15px;
            width: 36px;
            line-height: 48px;
            text-align: center;
            background: #F1F1F1;
            float: left;
            margin-left: -31px;
            margin-top: -12px;
            margin-right: 15px
        }

        .accordion_one .panel .panel-heading a:after {
            content: "\2212"
        }

        .accordion_one .panel .panel-heading a:after,
        .accordion_one .panel .panel-heading a.collapsed:after {
            font-family: 'FontAwesome';
            font-size: 15px;
            width: 36px;
            height: 48px;
            line-height: 48px;
            text-align: center;
            background: #F1F1F1;
            float: left;
            margin-left: -31px;
            margin-top: -12px;
            margin-right: 15px
        }
    </style>
@endpush
