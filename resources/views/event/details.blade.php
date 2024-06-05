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

            <div class="overview-box" style="padding-bottom: 0px !important;">
                <div class="row clearfix">

                    <div class="col-lg-8 col-md-12 col-sm-12 text-column">
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

                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                        <div class="blog-sidebar">
                            @if(isset($popularNews))
                                <div class="sidebar-widget post-widget">
                                    <div class="widget-title">
                                        <h3>Latest News</h3>
                                    </div>
                                    <div class="widget-content">
                                        @foreach($popularNews as $popular)
                                            <div class="post">
                                                <figure class="post-thumb">
                                                    <a href="{{route('news.details',$popular->id)}}">
                                                        @if($popular->image)
                                                            <img src="{{asset('/news_notice/mid/'.$popular->image)}}" alt="{{$popular->title}}" style="height: 70px">
                                                        @else
                                                            <img class="" src="{{asset('assets/news-default.png')}}" alt="News Image" style="height: 70px">
                                                        @endif
                                                    </a>
                                                </figure>
                                                <h6><a href="{{route('news.details',$popular->id)}}">{{$popular->title}}</a></h6>
                                                <p><i class="far fa-calendar"></i>{{$popular->created_at->format('d')}}&nbsp;{{$popular->created_at->format("M-Y")}}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

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
