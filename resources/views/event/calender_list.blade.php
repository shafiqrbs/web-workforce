@extends('layouts.app')
@section('content')

    <!-- recent-events -->
    <section class="recent-events sec-pad" style="padding-top: 100px">
        <div class="auto-container">


            <div class="group-title" style="margin-bottom: 0px">
                <h3>Event Calendar</h3>
                <div class="title-shape"></div>
                <h3 class="text-right year" style="color: red">{{$year}}</h3>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 big-column">
                    <div class="form-group">
                        <a data-href="{{route('event_calender_filter')}}" id="event_calender_filter"></a>
                        {!! Form::label('Choose Year','Choose Year', ['class' => 'bold']) !!}
                        {!! Form::select('year',$years,$year, array('class'=>'form-control ignore js-example-basic-single', 'id'=>'year','required'=>'true','placeholder'=>'Choose Year')) !!}
                    </div>
                </div>
            </div>

            @if(count($eventTypes)>0)
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 big-column">
                        <div class="form-group">
                            @php
                                $typeID = [];
                            @endphp
                            @foreach($eventTypes as $type)
                                @php
                                    $typeID[] = $type->id;
                                @endphp
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input event-type-check" type="checkbox" id="inlineCheckbox{{$type->id}}" value="{{$type->id}}" checked>
                                    <label class="form-check-label" for="inlineCheckbox{{$type->id}}">{{$type->event_type}}</label>
                                </div>
                            @endforeach
                            <input type="hidden" id="event_type" value="{{implode(',',$typeID)}}">
                        </div>
                    </div>
                </div>
            @endif

            <div class="schedule-inner">
                <div class="schedule-block-three" id="filterDataPlace">
                    @if(count($allMonths)>0)
                        @foreach($allMonths as $month)
                            <div class="accordion" id="accordionExample{{$month}}">
                                <div class="card">
                                    <div class="card-header" id="heading{{$month}}" style="padding: 0">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left font-weight-bold" type="button" data-toggle="collapse" data-target="#{{$month}}" aria-expanded="true" aria-controls="collapseOne" style="color: #000000">
                                                <span class="category">{{$month}}</span>
                                            </button>
                                        </h2>
                                    </div>

                                    @if(count($eventData)>0)
                                        @foreach($eventData as $key => $event)
                                            @if($key == $month)
                                                <div id="{{$month}}" class="{{count($event)>0?'collapse':''}} {{count($event)>0?'show':'hide'}}" aria-labelledby="heading{{$month}}" data-parent="#{{$month}}">
                                                    <div class="card-body" style="padding-top: 0;padding-bottom: 0">
                                                        <table class="table table-borderless table-condensed table-advance">
                                                            @foreach($event as $val)
                                                                <tr>
                                                                    <td width="20%">{{date('M d',strtotime($val['start_date']))}}{{$val['end_date']?' - '.date('M d',strtotime($val['end_date'])):''}}</td>

                                                                    {{--                                                                    <td width="20%">{{date('d,M',strtotime($val['start_date']))}}{{$val['end_date']?' To '.date('d,M',strtotime($val['end_date'])):''}}</td>--}}
                                                                    <td width="50%">
                                                                        <a href="{{route('event_details',$val['id'])}}" style="color: #0c0c0c">
                                                                            <u>{{$val['event_name']}}</u>
                                                                        </a>
                                                                    </td>
                                                                    <td width="20%">{{$val['event_type']}}</td>
                                                                    <td width="10%">{{$val['location']}}</td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <br>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
    </section>
    <!-- recent-events end -->

@endsection
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            font-size: 15px !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

        $(document).delegate('#year','change',function () {
            let year = $(this).val();
            let eventType = $('#event_type').val();
            let url = $('#event_calender_filter').attr('data-href')

            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                data: {year: year,eventType:eventType},
                beforeSend: function( xhr ) {

                }
            }).done(function( response ) {
                $('#filterDataPlace').html(response.content);
                $('.year').text(response.year);
            }).fail(function( jqXHR, textStatus ) {

            });
            return false;
        });

        $(document).delegate('.event-type-check','change',function () {
            let eventType = $('#event_type').val();
            let year = $('#year').val();
            let check = $(this).val()

            let eventTypeArray = JSON.parse("[" + eventType + "]")
            let newArray = [];

            let ischecked= $(this).is(':checked');
            if(ischecked){
                eventTypeArray.push(check)
                newArray=eventTypeArray
                $('#event_type').val(eventTypeArray.toString())
            }else{
                newArray = eventTypeArray.filter((value)=>value!=check);
                $('#event_type').val(newArray.toString())
            }
            let url = $('#event_calender_filter').attr('data-href')

            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                data: {year: year,eventType:newArray.toString()},
                beforeSend: function( xhr ) {

                }
            }).done(function( response ) {
                $('#filterDataPlace').html(response.content);
            }).fail(function( jqXHR, textStatus ) {

            });
            return false;
        });
    </script>
@endpush
