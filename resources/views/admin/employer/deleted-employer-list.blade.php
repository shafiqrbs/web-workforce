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
                    <li> <span>Deleted Employer</span> </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">Manage Deleted Employer <small>Deleted Employer</small> </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Deleted Employer</span> </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-container">

                                <table id="deletedUser" class="table table-bordered data-table">
                                    <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th>Account Deletion Reason</th>
                                        <th>Deleted</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $index => $item)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $item->user_name }}</td>
                                            <td>{{ $item->user_email }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ date('d M Y', strtotime($item->deleted_date)) }}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                                {{--<table class="table table-striped table-bordered table-hover"  id="cityDatatableAjax">
                                    <thead>
                                    <tr role="row" class="filter">
                                        <th>SL.</th>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th>Account Deletion Reason</th>
                                        <th>Deleted</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $index => $item)
                                            <tr>
                                                <td>{{ $index+1 }}</td>
                                                <td>{{ $item->user_name }}</td>
                                                <td>{{ $item->user_email }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ date('d M Y', strtotime($item->created_at)) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>--}}
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function approveVideo(id) {
            swal({
                title: "Approve Video ?",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        var  urL = 'profile-video/approve/'+id;
                        $.ajax({
                            url: urL,
                            success: function(data){
                                console.log(data);
                                swal("This Video Has Been Approved ! ")
                                    .then((value) => {
                                        location.reload();
                                    });
                            }
                        });
                    }
                });
        }

        function deleteVideo(id) {
            swal({
                title: "Delete Video ?",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        var  urL = 'profile-video/delete/'+id;
                        $.ajax({
                            url: urL,
                            success: function(data){
                                console.log(data);
                                swal("This Video Has Been Deleted ! ")
                                    .then((value) => {
                                        location.reload();
                                    });
                            }
                        });
                    }
                });
        }
    </script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>

        $(document).ready( function () {
            $('#deletedUser').DataTable({
                /*'filter' : false,
                'order' : [],
                "autoWidth": false,
                "columnDefs": [ {
                    "targets":  [0,2],
                    "orderable": false
                } ],
                'bInfo' : false*/
            });
        } );
    </script>
@endpush