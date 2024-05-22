@extends('admin.layouts.admin_layout')
@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>
                    <li> <a href="{{ route('employer.list.users') }}">Payment History</a> <i class="fa fa-circle"></i> </li>
                    <li> <span>Payment History</span> </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <!--<h3 class="page-title">Edit User <small>Users</small> </h3>-->
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <br />
            @include('flash::message')
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-red-sunglo"> <i class="icon-settings font-red-sunglo"></i> <span class="caption-subject bold uppercase">Payment History</span></div>
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{{ route('employer.list.users') }}"><i class="fa fa-arrow-left"></i> Back</a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="usercoverimg">
                                <div class="userMaininfo">
                                    <div class="userPic">{{$user->printUserImage()}}</div>
                                    <div class="title">
                                        <h3>
                                            {{$user->getName()}}
                                        </h3>
                                        @if($user->getLocation())
                                            <div class="desi">
                                                <i class="fa fa-map-marker" aria-hidden="true"></i> {{$user->getLocation()}}
                                            </div>
                                        @endif
                                        <div class="membersinc"><i class="fa fa-history" aria-hidden="true"></i> {{__('Member Since')}}, {{$user->created_at->format('M d, Y')}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="userlinkstp"></div>
                            <!-- Job Detail start -->
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="background: #E0E4E5;">No of Users</th>
                                    <th style="background: #E0E4E5;">No of Months</th>
                                    <th style="background: #E0E4E5;">Payment Amount</th>
                                    <th style="background: #E0E4E5;">From Access Date</th>
                                    <th style="background: #E0E4E5;">To Access Date</th>
                                    <th style="background: #E0E4E5;">Payment For</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($paymentHistory as $item)
                                    <tr>
                                        <td>{{$item->package_num_listings}}</td>
                                        <td>{{number_format(($item->package_num_days / 30),0)}}</td>
                                        <td>${{$item->total_amount}}</td>
                                        <td>{{date('M d, Y', strtotime($item->package_start_date)) }}</td>
                                        <td>{{date('M d, Y', strtotime($item->package_end_date)) }}</td>
                                        <td>{{$item->payment_for}}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CONTENT BODY -->
        </div>
@endsection