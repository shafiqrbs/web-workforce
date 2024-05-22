@extends('admin.layouts.admin_layout')
@section('content')
<style type="text/css">
    .table td, .table th {
        font-size: 12px;
        line-height: 2.42857 !important;
    }	
</style>
<div class="page-content-wrapper"> 
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content"> 
        <!-- BEGIN PAGE HEADER--> 
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>
                <li> <span>Payment History</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR --> 
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">Manage Payment History <small>Payment History</small> </h3>
        <!-- END PAGE TITLE--> 
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12"> 
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Payment History</span> </div>
                    </div>
                    <div class="portlet-body">
                        <table id="payment-history" class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>No of Users</th>
                                <th>No of Months</th>
                                <th>From Access Date</th>
                                <th>To Access Date</th>
                                <th>Amount</th>
                                <th>Payment For</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $index => $item)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{$item->package_num_listings}}</td>
                                    <td>{{number_format(($item->package_num_days / 30),0)}}</td>
                                    <td>{{date('M d, Y', strtotime($item->package_start_date)) }}</td>
                                    <td>{{date('M d, Y', strtotime($item->package_end_date)) }}</td>
                                    <td>{{ $item->total_amount }}</td>
                                    <td>{{ $item->payment_for }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY --> 
</div>
@endsection
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>

        $(document).ready( function () {
            $('#payment-history').DataTable({

            });
        } );
    </script>
@endpush