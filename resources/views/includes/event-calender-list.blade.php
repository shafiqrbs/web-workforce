<section class="news-style-two  pb-100 sec-pad-news">
{{--    <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-12.png);"></div>--}}
    <div class="auto-container">
        <div class="sec-title centred">
            <h6><i class="flaticon-star"></i><span>Event Calender</span><i class="flaticon-star"></i></h6>
            <h2>Latest Event From Event Calender</h2>
            <div class="title-shape"></div>
        </div>

        <div class="row" style="display: initial !important;">
            <div class="schedule-inner">
                <div class="schedule-block-three">
                    <div class="inner-box">
                        <div class="">
                            @php
                              $allMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July','August', 'September', 'October', 'November','December'];
                            @endphp

                            @if(count($allMonths)>0)
                                @foreach($allMonths as $month)
                                    <div class="accordion" id="accordionExample{{$month}}">
                                        <div class="card">
                                            <div class="card-header" id="heading{{$month}}">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#{{$month}}" aria-expanded="true" aria-controls="collapseOne">
                                                        {{$month}}
                                                    </button>
                                                </h2>
                                            </div>

                                            <div id="{{$month}}" class="collapse show" aria-labelledby="heading{{$month}}" data-parent="#{{$month}}">
                                                <div class="card-body">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">An item</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                @endforeach
                            @endif



                            {{--<div class="accordion" id="accordionExampleFebruary">
                                <div class="card">
                                    <div class="card-header" id="headingFebruary">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#February" aria-expanded="true" aria-controls="collapseOne">
                                                February
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="February" class="collapse show" aria-labelledby="headingFebruary" data-parent="#February">
                                        <div class="card-body">
                                            <ul class="list-group">
                                                <li class="list-group-item">An item</li>
                                                <li class="list-group-item">A second item</li>
                                                <li class="list-group-item">A third item</li>
                                                <li class="list-group-item">A fourth item</li>
                                                <li class="list-group-item">And a fifth one</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</section>

@push('scripts')
    <script>

    </script>
@endpush
