
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