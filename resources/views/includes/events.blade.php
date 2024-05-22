{{--    <section class="schedules-style-two" style="background-image: url(assets/images/background/schedule-bg-2.jpg);">--}}
@if(isset($events) && count($events)>0)
    <section class="team-section alternat-2 sec-pad pb-140 team-section-padding">
        <div class="auto-container">
            <div class="sec-title centred">
                <h6><i class="flaticon-star"></i><span>Events</span><i class="flaticon-star"></i></h6>
                <h2>Running & Upcoming Events</h2>
                <div class="title-shape"></div>
            </div>
        </div>


    <section class="schedules-style-two ">
{{--        <div class="layer-bg" style="background-image: url(assets/images/background/layer-bg-3.jpg);"></div>--}}
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
                                            <div class="date"><h3>{{$event->created_at->format('d')}}<span>{{$event->created_at->format("M-y")}}</span></h3></div>
                                            <ul class="post-info clearfix">
                                                @if(isset($event->number_of_club) && $event->number_of_club>0)<li><i class="flaticon-gps"></i>Clubs {{$event->number_of_club}}</li>@endif
                                                    @if(isset($event->number_of_athlete) && $event->number_of_athlete>0)<li><i class="fas fa-user-hard-hat"></i>Athletes {{$event->number_of_athlete}}</li>@endif
                                                    @if(isset($event->participant) && $event->participant>0)<li><i class="fas fa-user-hard-hat"></i>Participants {{$event->participant}}</li><li></li>@endif
                                            </ul>
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