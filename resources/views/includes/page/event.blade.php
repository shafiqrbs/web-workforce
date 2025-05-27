{{--    <section class="schedules-style-two" style="background-image: url(assets/images/background/schedule-bg-2.jpg);">--}}
@if(isset($events) && count($events)>0)
    <section class="team-section alternat-2 sec-pad pb-140 team-section-padding" id="event">
        <div class="auto-container">
            <div class="sec-title centred">
                <h6><i class="flaticon-star"></i><span>Events</span><i class="flaticon-star"></i></h6>
                <h2>Running & Upcoming Events</h2>
                <div class="title-shape"></div>
            </div>
        </div>

        <section class="schedules-style-two ">
            <div class="layer-bg" style="background-color: #002856"></div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content_block_3">
                            <div class="content-box">
                                @php
                                    $getTopEvent = \App\Models\Event::getTopEvent();
                                    $getEventType = \App\Models\EventType::find($getTopEvent->event_type_id);
                                @endphp
                                <h4><i class="flaticon-romantic-date"></i>{{$getTopEvent->event_name}} <br />{{$getEventType->event_type}}</h4>
                                <h2>{{$siteSetting->site_name}}</h2>
                                <div class="btn-box"><a href="{{route('event_details',$getTopEvent->id)}}"  class="theme-btn style-two">Event Details</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="inner-content">
                            <div class="schedule-carousel">
                                @foreach($events as $event)
                                    @php
                                        $eventType = \App\Models\EventType::find($event->event_type_id);
                                    @endphp
                                    <div class="schedule-block-two">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image home-page-event">
                                                    <img src="{{asset('event/mid/'.$event->event_image)}}" alt="">
                                                </figure>
                                                <div class="text">
                                                    <div class="category"><p><i class="flaticon-star"></i>{{$eventType->event_type}}</p></div>
                                                    <h3><a href="{{route('event_details',$event->id)}}" >{{$event->event_name}}</a></h3>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="date" style="top:10px;"><h3>{{$event->created_at->format('d-M-Y')}}</h3></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endif