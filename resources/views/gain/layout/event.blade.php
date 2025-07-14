<section id="events" class="events-section">
    <div class="container">
        <div class="events-header">
            <h2>Running & Upcoming Events</h2>
            <p>Join us for our latest workshops, seminars, and community nutrition programs</p>
        </div>
        <div class="row g-4">
            @foreach($events as $event)
                @php
                    $eventType = \App\Models\EventType::find($event->event_type_id);
                @endphp
                <div class="col-lg-6">
                    <div class="event-card">
                        <div class="event-image"
                            style="height: 250px;
                        background: url({{asset('event/'.$event->event_image)}});
                        background-size: cover;
                        background-position: center;
                        position: relative;"
                        ></div>
                        <div class="event-content">
                            <div class="event-date">{{date('j F Y, l', strtotime($event->created_at))}}</div>
                            <h5>{{$event->event_name}}</h5>
                            @php
                                $words = str_word_count(strip_tags($event->event_message), 1);
                                $shortMessage = implode(' ', array_slice($words, 0, 50));
                            @endphp

                            <p style="text-align: justify">
                                {{ $shortMessage }}{{ count($words) > 50 ? '...' : '' }}
                            </p>
                            <button class="btn btn-primary"><a href="{{route('event_details',$event->id)}}" style="color: #ffffff">Read Details</a></button>

                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
</section>


@push('styles')
    <style>
        /* Events Section */
        .events-section {
            background: white;
            padding: 100px 0;
        }

        .events-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .events-header h2 {
            font-size: 2.8rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .events-header p {
            font-size: 1.2rem;
            color: var(--text-muted);
        }

        .event-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 2rem;
        }

        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
        }

        /*.event-image {
            height: 250px;
            background: url('https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80');
            background-size: cover;
            background-position: center;
            position: relative;
        }*/

        .event-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            /*background: linear-gradient(45deg, rgba(196, 30, 58, 0.8), rgba(224, 46, 74, 0.8));*/
        }

        .event-content {
            padding: 2rem;
        }

        .event-date {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .event-content h5 {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .event-content p {
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }
    </style>
@endpush