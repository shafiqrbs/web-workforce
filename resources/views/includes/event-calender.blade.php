<section class="news-style-two  pb-100 sec-pad-news">
{{--    <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-12.png);"></div>--}}
    <div class="auto-container">
        <div class="sec-title centred">
            <h6><i class="flaticon-star"></i><span>Event Calender</span><i class="flaticon-star"></i></h6>
            <h2>Latest Event From Event Calender</h2>
            <div class="title-shape"></div>
        </div>
        <div id="calendar"></div>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                initialDate: '2023-11-08',
                navLinks: true, // can click day/week names to navigate views
                businessHours: true, // display business hours
                editable: true,
                selectable: true,
                events: [
                    {
                        title: 'Business Lunch',
                        start: '2023-11-03',
                        // constraint: 'businessHours'
                    },
                    {
                        title: 'Meeting',
                        start: '2023-11-13',
                        // constraint: 'availableForMeeting', // defined below
                        // color: '#257e4a'
                    },
                    {
                        title: 'Conference',
                        start: '2023-11-18',
                        end: '2023-11-22'
                    },
                    {
                        title: 'Party',
                        start: '2023-11-29'
                    },

                    // areas where "Meeting" must be dropped
                    /*{
                        groupId: 'availableForMeeting',
                        start: '2023-10-11',
                        end: '2023-10-11',
                        display: 'background'
                    },
                    {
                        groupId: 'availableForMeeting',
                        start: '2023-10-12',
                        end: '2023-10-12',
                        display: 'background'
                    },*/

                    // red areas where no events can be dropped
                    /*{
                        title: 'Meeting',
                        start: '2023-10-24',
                        end: '2023-10-28',
                        overlap: false,
                        display: 'background',
                        color: '#ff9f89'
                    }*/
                ]
            });

            calendar.render();
        });
    </script>
@endpush
