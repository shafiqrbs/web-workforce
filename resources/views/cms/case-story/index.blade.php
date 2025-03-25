@extends('layouts.app')
@section('content')

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
                                <li><a href="" >{{$pageTitle}}</a></li>
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
    @if($getAllEvent)

        <!-- events-list -->
        <section class="events-list sec-pad-2">
            <div class="auto-container">
                <div class="event-list-content">
                    <div class="schedule-inner">
                        @foreach($getAllEvent as $event)
                        <div class="schedule-block-three">
                            <div class="inner-box">
                                <div class="inner">
                                    <div class="schedule-date">

                                        <h2> {{$event->created_at->format('d')}} <span class="year">{{$event->created_at->format("M-Y")}}</span><span class="symple">th</span></h2>
                                        <ul class="list clearfix">
                                            <li><i class="flaticon-clock-circular-outline"></i>
                                                {{ \Carbon\Carbon::parse($event->start_date)->format('d M') }} -  {{ \Carbon\Carbon::parse($event->end_date)->format('d M') }}
                                            </li>
                                            <li><i class="flaticon-gps"></i>{{ $event->location }}</li>
                                        </ul>
                                    </div>
                                    <div class="text">
                                        <span class="category"><i class="flaticon-star"></i>{{$event->event_type}}</span>
                                        <h3><a href="{{route('event_details',$event->id)}}">{{$event->event_name}}</a></h3>
                                        <p>{{ substr($getTopEvent->event_message, 0,  150) }}</p>
                                        <div class="link"><a href="{{route('event_details',$event->id)}}l">Read More<i class="flaticon-right-arrow"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                {{--<div class="pagination-wrapper centred">
                    <ul class="pagination clearfix">
                        <li><a href="event.html"><i class="far fa-angle-double-left"></i></a></li>
                        <li><a href="event.html" class="current">1</a></li>
                        <li><a href="event.html">2</a></li>
                        <li><a href="event.html"><i class="far fa-angle-double-right"></i></a></li>
                    </ul>
                </div>--}}
            </div>
        </section>
        <!-- events-list end -->

    @endif



    {{--@include('includes.footer_social')--}}
@endsection

@push('styles')

@endpush
