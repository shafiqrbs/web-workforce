@extends('layouts.app')
@section('content')


   {{-- @if(isset($bannerData) && !empty($bannerData))
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
                    <li><a href="{{url('/')}}">{{__('messages.Home')}}</a></li>
                    <li>
                        @if(isset($pathPageTitle) && !empty($pathPageTitle))
                            <a href=" {{route('archive_index')}}">
                        @endif

                        {{$pageTitle}}
                        @if(isset($pathPageTitle) && !empty($pathPageTitle))
                            </a>
                        @endif
                    </li>
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
--}}

    <!-- events-list -->
    <section class="events-list sec-pad-2">
        <div class="auto-container">
            <div class="event-list-content">
                {{--{!! Form::open(array('method' => 'get', 'route' => 'archive_search', 'files'=>true,'id'=>'contact-form','class'=>'default-form','novalidate'=>'novalidate','autocomplete'=>'off')) !!}
                <div class="filter-box clearfix">
                    <div class="form-group" style="width: 95%">
                        <div class="select-box">
                            <input type="text" name="keyword" value="{{$data['keyword']?$data['keyword']:''}}" placeholder="{{__('messages.Search_Keyword')}}" id="keyword" required>
                        </div>
                    </div>
                    <div class="search-btn">
                        <button type="submit">{{__('messages.Search')}}</button>
                    </div>
                </div>
                {!! Form::close() !!}--}}

{{--                    {{dd($data)}}--}}


                <div class="schedule-inner">
                    <h2 style="font-size: 15px;border-bottom: 1px solid;padding-bottom: 5px;font-weight: bold;">{{$data['total']}} {{__('messages.Results_Records_in_Global_Search').' "'.$data['param'].'"'}} </h2>
                    @if(count($data['archiveData'])>0)
                        @foreach($data['archiveData'] as $archive)
                            <div class="schedule-block-three">
                                <div class="inner-box" style="padding: 0px">
                                    <div class="inner">
                                        <div class="schedule-date" style="top: 15px;left: 15px;">
                                            <h2 style="font-size: 0px;padding: 0px;line-height: 0px;">
                                                <span class="year" style="padding: 8px 10px;display: block;">
                                                    {{__('messages.Archives')}}
                                                </span>
                                            </h2>
                                            <ul class="list clearfix" style="padding-bottom: 3px;">
                                                <li>
                                                    <i class="flaticon-clock-circular-outline"></i>
                                                    {{date_format($archive->created_at,'d-F-Y').' '.date('h:i A', strtotime($archive->created_at))}}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="text" style="padding-top: 15px;">
                                            <h3>{{$archive->archive_name}}</h3>
                                            <p>{{$archive->sub_title}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif


                    @if(count($data['juryData'])>0)
                        @foreach($data['juryData'] as $jury)
                            <div class="schedule-block-three">
                                <div class="inner-box" style="padding: 0px">
                                    <div class="inner">
                                        <div class="schedule-date" style="top: 15px;left: 15px;">
                                            <h2 style="font-size: 0px;padding: 0px;line-height: 0px;">
                                                <span class="year" style="padding: 8px 10px;display: block;">
                                                    {{__('messages.Judges_Jury')}}
                                                </span>
                                            </h2>
                                            <ul class="list clearfix" style="padding-bottom: 3px;">
                                                <li>
                                                    <i class="flaticon-clock-circular-outline"></i>
                                                    {{date_format($jury->created_at,'d-F-Y').' '.date('h:i A', strtotime($jury->created_at))}}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="text" style="padding-top: 15px;">
                                            <a href="{{route('jury_details',$jury->id)}}">
                                                <h3>{{$jury->name}}</h3>
                                                <p>{{$jury->mobile}}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif


                    @if(count($data['armsData'])>0)
                        @foreach($data['armsData'] as $arms)
                            <div class="schedule-block-three">
                                <div class="inner-box" style="padding: 0px">
                                    <div class="inner">
                                        <div class="schedule-date" style="top: 15px;left: 15px;">
                                            <h2 style="font-size: 0px;padding: 0px;line-height: 0px;">
                                                <span class="year" style="padding: 8px 10px;display: block;">
                                                    {{__('messages.Arms')}}
                                                </span>
                                            </h2>
                                            <ul class="list clearfix" style="padding-bottom: 3px;">
                                                <li>
                                                    <i class="flaticon-clock-circular-outline"></i>
                                                    {{date_format($arms->created_at,'d-F-Y').' '.date('h:i A', strtotime($arms->created_at))}}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="text" style="padding-top: 15px;">
                                            <a href="{{route('arms_details',$arms->id)}}">
                                                <h3>{{$arms->name}}</h3>
                                                <p>{{$arms->name}}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif


                    @if(count($data['clubData'])>0)
                        @foreach($data['clubData'] as $club)
                            <div class="schedule-block-three">
                                <div class="inner-box" style="padding: 0px">
                                    <div class="inner">
                                        <div class="schedule-date" style="top: 15px;left: 15px;">
                                            <h2 style="font-size: 0px;padding: 0px;line-height: 0px;">
                                                <span class="year" style="padding: 8px 10px;display: block;">
                                                    {{__('messages.Clubs')}}
                                                </span>
                                            </h2>
                                            <ul class="list clearfix" style="padding-bottom: 3px;">
                                                <li>
                                                    <i class="flaticon-clock-circular-outline"></i>
                                                    {{date_format($club->created_at,'d-F-Y').' '.date('h:i A', strtotime($club->created_at))}}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="text" style="padding-top: 15px;">
                                            <a href="{{route('club_details',$club->id)}}">
                                                <h3>{{$club->name}}</h3>
                                                <p>{{$club->name}}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif


                    @if(count($data['newsData'])>0)
                        @foreach($data['newsData'] as $news)
                            <div class="schedule-block-three">
                                <div class="inner-box" style="padding: 0px">
                                    <div class="inner">
                                        <div class="schedule-date" style="top: 15px;left: 15px;">
                                            <h2 style="font-size: 0px;padding: 0px;line-height: 0px;">
                                                <span class="year" style="padding: 8px 10px;display: block;">
                                                    {{__('messages.News')}}
                                                </span>
                                            </h2>
                                            <ul class="list clearfix" style="padding-bottom: 3px;">
                                                <li>
                                                    <i class="flaticon-clock-circular-outline"></i>
                                                    {{date_format($news->created_at,'d-F-Y').' '.date('h:i A', strtotime($news->created_at))}}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="text" style="padding-top: 15px;">
                                            <a href="{{route('news.details',$news->id)}}">
                                                <h3>{{$news->title}}</h3>
                                                <p>{{$news->post_type}}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @if(count($data['noticeData'])>0)
                        @foreach($data['noticeData'] as $notice)
                            <div class="schedule-block-three">
                                <div class="inner-box" style="padding: 0px">
                                    <div class="inner">
                                        <div class="schedule-date" style="top: 15px;left: 15px;">
                                            <h2 style="font-size: 0px;padding: 0px;line-height: 0px;">
                                                <span class="year" style="padding: 8px 10px;display: block;">
                                                    {{__('messages.Notice')}}
                                                </span>
                                            </h2>
                                            <ul class="list clearfix" style="padding-bottom: 3px;">
                                                <li>
                                                    <i class="flaticon-clock-circular-outline"></i>
                                                    {{date_format($notice->created_at,'d-F-Y').' '.date('h:i A', strtotime($notice->created_at))}}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="text" style="padding-top: 15px;">
                                            <a href="{{route('news.details',$notice->id)}}">
                                                <h3>{{$notice->title}}</h3>
                                                <p>{{$notice->post_type}}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @if(count($data['athleteData'])>0)
                        @foreach($data['athleteData'] as $athlete)
                            <div class="schedule-block-three">
                                <div class="inner-box" style="padding: 0px">
                                    <div class="inner">
                                        <div class="schedule-date" style="top: 15px;left: 15px;">
                                            <h2 style="font-size: 0px;padding: 0px;line-height: 0px;">
                                                <span class="year" style="padding: 8px 10px;display: block;">
                                                    {{__('messages.Athlete')}}
                                                </span>
                                            </h2>
                                            <ul class="list clearfix" style="padding-bottom: 3px;">
                                                <li>
                                                    <i class="flaticon-clock-circular-outline"></i>
                                                    {{date_format($athlete->created_at,'d-F-Y').' '.date('h:i A', strtotime($athlete->created_at))}}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="text" style="padding-top: 15px;">
                                            <a href="{{route('athlete_details',$athlete->id)}}">
                                                <h3>{{$athlete->athlete_name}}</h3>
                                                <p>{{$athlete->athlete_id}}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @if(count($data['eventData'])>0)
                        @foreach($data['eventData'] as $event)
                            <div class="schedule-block-three">
                                <div class="inner-box" style="padding: 0px">
                                    <div class="inner">
                                        <div class="schedule-date" style="top: 15px;left: 15px;">
                                            <h2 style="font-size: 0px;padding: 0px;line-height: 0px;">
                                                <span class="year" style="padding: 8px 10px;display: block;">
                                                    {{__('messages.Event')}}
                                                </span>
                                            </h2>
                                            <ul class="list clearfix" style="padding-bottom: 3px;">
                                                <li>
                                                    <i class="flaticon-clock-circular-outline"></i>
                                                    {{date_format($event->created_at,'d-F-Y').' '.date('h:i A', strtotime($event->created_at))}}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="text" style="padding-top: 15px;">
                                            <a href="{{route('event_details',$event->id)}}">
                                                <h3>{{$event->name}}</h3>
                                                <p>{{$event->event_type}}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    {{--@if(count($data['memberData'])>0)
                        @foreach($data['memberData'] as $member)
                            <div class="schedule-block-three">
                                <div class="inner-box" style="padding: 0px">
                                    <div class="inner">
                                        <div class="schedule-date" style="top: 15px;left: 15px;">
                                            <h2 style="font-size: 0px;padding: 0px;line-height: 0px;">
                                                <span class="year" style="padding: 8px 10px;display: block;">
                                                    {{__('messages.Member')}}
                                                </span>
                                            </h2>
                                            <ul class="list clearfix" style="padding-bottom: 3px;">
                                                <li>
                                                    <i class="flaticon-clock-circular-outline"></i>
                                                    {{date_format($member->created_at,'d-F-Y').' '.date('h:i A', strtotime($member->created_at))}}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="text" style="padding-top: 15px;">
                                            <a href="{{route('committee_members_detais',$member->id)}}">
                                                <h3>{{$member->name}}</h3>
                                                <p>{{$member->career_level}}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif--}}

                    {{--@if(count($data['committeeMember'])>0)
                        @foreach($data['committeeMember'] as $comMember)
                            <div class="schedule-block-three">
                                <div class="inner-box" style="padding: 0px">
                                    <div class="inner">
                                        <div class="schedule-date" style="top: 15px;left: 15px;">
                                            <h2 style="font-size: 0px;padding: 0px;line-height: 0px;">
                                                <span class="year" style="padding: 8px 10px;display: block;">
                                                    Committee Member
                                                </span>
                                            </h2>
                                            <ul class="list clearfix" style="padding-bottom: 3px;">
                                                <li>
                                                    <i class="flaticon-clock-circular-outline"></i>
                                                    {{date_format($comMember->created_at,'d-F-Y').' '.date('h:i A', strtotime($comMember->created_at))}}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="text" style="padding-top: 15px;">
                                            <a href="{{route('committee_members_detais_office',$comMember->id)}}">
                                                <h3>{{$comMember->name}}</h3>
                                                <p>{{$comMember->career_level}}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif--}}


                </div>
            </div>
            <div class="pagination-wrapper centred">
{{--                {{ $archives->links('includes.pagination-view') }}--}}
            </div>
        </div>
    </section>
    <!-- events-list end -->






    {{--@include('includes.footer_social')--}}
@endsection

@push('styles')
    <style>
        .pager{
            padding: 0px;
        }

        .pager li{
            display: inline;
        }
        .pagination_custom_style{
            border: 1px solid;
            padding: 5px 10px;
            font-size: 15px;
            font-weight: bold;
            background: #e41e2f;
            color: #fff;
        }
        .active{
            background: #fff;
            color: #e41e2f;
        }

        .schedule-block-three .inner-box:hover h3{
            color: #fff;
        }

    </style>
@endpush
