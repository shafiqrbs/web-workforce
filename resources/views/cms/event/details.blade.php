@extends('layouts.app')
@section('content')


    <!-- Page Title -->
    <section class="page-title style-two" style="background-image: url({{asset('event/large/'.$eventDetails->event_image)}});">
        <div class="auto-container">
            <div class="content-box">
                <div class="title centred">
                    @if($eventType->event_type)
                    <span class="category"><i class="flaticon-star"></i>
                        {{$eventType->event_type?$eventType->event_type:null}}
                    </span><br>
                    @endif
                    <h1>{{$eventDetails->event_name}}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->


    <!-- event-details -->
    <section class="event-details">
        <div class="auto-container">
            <div class="event-info">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                        <div class="single-item">
                            <div class="icon-box"><i class="flaticon-gps"></i></div>
                            <h4>Event Venue</h4>
                            <ul class="list clearfix">
                                <li><i class="flaticon-gps"></i>{{$eventDetails->location}}<br/>&nbsp;</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                        <div class="single-item">
                            <div class="icon-box"><i class="flaticon-calendar"></i></div>
                            <h4>Date & Time</h4>
                            <ul class="list clearfix">
                                <li><i class="flaticon-calendar"></i>{{ \Carbon\Carbon::parse($eventDetails->start_date)->format('d M F') }}</li>
                                <li><i class="flaticon-clock-circular-outline"></i>{{ \Carbon\Carbon::parse($eventDetails->start_date)->format('d M') }} -  {{ \Carbon\Carbon::parse($eventDetails->end_date)->format('d M') }}</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="overview-box" style="padding-bottom: 0px !important;">
                <div class="row clearfix">

                    <div class="col-lg-12 col-md-12 col-sm-12 text-column">
                        <div class="text">
                            <div class="group-title">
                                <h3>Event Overview</h3>
                                <div class="title-shape"></div>
                            </div>
                            <p style="text-align: justify"><b>Event Details :</b> {{$eventDetails->event_message}}</p>
                            <p style="text-align: justify"><b>Schedule :</b> {{$eventDetails->match_schedule_message}}</p>
                            <a href="{{ route('match_schedule_download_front',$eventDetails->id) }}" class="theme-btn">{{'Download General Information'}}
                                <span style="color: red">
                                    @if(session('fileNotFound'))
                                        <br>{{ session('fileNotFound') }}
                                    @endif
                                </span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- event-details end -->


    @if($relatedEvents)
    <!-- recent-events -->
    <section class="recent-events sec-pad" style="padding-top: 100px">
        <div class="auto-container">
            <div class="group-title">
                <h3>Recent Events</h3>
                <div class="title-shape"></div>
            </div>
            @foreach($relatedEvents as $relatedEvent)
            <div class="schedule-inner">
                <div class="schedule-block-three">
                    <div class="inner-box">
                        <div class="inner">
                            <div class="schedule-date">
                                <img src="{{asset('event/thumb/'.$relatedEvent->event_image)}}" alt="">
                            </div>
                            <div class="text">
                                @php
                                    if (isset($relatedEvent->event_type_id)){
                                        $relatedEventType = \App\Models\EventType::find($relatedEvent->event_type_id);
                                    }
                                @endphp
                                <span class="category"><i class="flaticon-star"></i>{{$relatedEventType->event_type}}</span>
                                <h3><a href="{{route('event_details',$relatedEvent->id)}}">{{$relatedEvent->event_name}}</a></h3>
                                <p>{{ substr($relatedEvent->event_message, 0,  150) }}</p>
                                <div class="link"><a href="{{route('event_details',$relatedEvent->id)}}">Read More<i class="flaticon-right-arrow"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!-- recent-events end -->
    @endif

@endsection

@push('styles')

@endpush
