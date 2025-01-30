@extends('admin.layouts.admin_layout')
@section('content')
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="background-color:#eef1f5;">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li> <a href="index.html">Home</a> <i class="fa fa-circle"></i> </li>
                <li> <span>{{ $siteSetting->site_name }} Admin Panel</span> </li>
            </ul>
        </div>




    <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> {{ $siteSetting->site_name }} {{ __('messages.Admin_Panel') }}  <small></small> </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 green" href="{{route('list.admin.users')}}">
                        <div class="visual"> <i class="fa fa-user"></i> </div>
                        <div class="details">
                            <div class="number"> <span data-counter="counterup" data-value="1349">{{ $systemUser }}</span> </div>
                            <div class="desc"> System Users </div>
                        </div>
                    </a> </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 red" href="{{route('list.users')}}">
                        <div class="visual"> <i class="fa fa-user"></i> </div>
                        <div class="details">
                            <div class="number"> <span data-counter="counterup" data-value="1349">0</span> </div>
                            <div class="desc">  Total Posts </div>
                        </div>
                    </a> </div>

            </div>
            <div class="col-md-6 col-sm-6">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 red" href="{{route('financial_partner_list')}}">
                        <div class="visual"> <i class="fa fa-list"></i> </div>
                        <div class="details">
                            <div class="number"> <span data-counter="counterup" data-value="1349">{{ $totalPartner }}</span> </div>
                            <div class="desc"> Total Partners </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 blue" href="{{route('list.events')}}">
                        <div class="visual"> <i class="fa fa-list"></i> </div>
                        <div class="details">
                            <div class="number"> <span data-counter="counterup" data-value="1349">{{ $totalEvent }}</span> </div>
                            <div class="desc"> Total Events </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-share font-dark hide"></i> <span class="caption-subject font-dark bold uppercase">Recent Posts</span> </div>
                    </div>
                    <div class="portlet-body">
                        <div class="slimScrol">
                            <ul class="feeds">

                            </ul>
                        </div>
                        <div class="scroller-footer">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-share font-dark hide"></i> <span class="caption-subject font-dark bold uppercase">Recent Events</span> </div>
                    </div>
                    <div class="portlet-body">
                        <div class="slimScrol">
                            <ul class="feeds">
                                @foreach($recentEvents as $event)
                                <li>
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-info"> <i class="fa fa-check"></i> </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc"><a href="{{ route('event.edit', $event->id) }}"> {{ \Illuminate\Support\Str::limit($event->event_name, 50) }} <br>( {{'Clubs: '.$event->number_of_club.' , Atheletes: '.$event->number_of_athlete.' , Official: '.$event->number_of_official }} ) </a>  </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="scroller-footer">
                            <div class="btn-arrow-link pull-right"> <a href="{{ route('list.events') }}">See All Events</a> <i class="icon-arrow-right"></i> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(function () {
        $('.slimScrol').slimScroll({
            height: '250px',
            railVisible: true,
            alwaysVisible: true
        });
    });
</script>
@endpush