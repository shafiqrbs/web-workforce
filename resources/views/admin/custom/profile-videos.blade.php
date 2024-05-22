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
                    <li> <span>Profile Videos</span> </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">Manage Profile Videos <small>Profile Videos</small> </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Profile Videos</span> </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-container">
                                <table class="table table-striped table-bordered table-hover"  id="cityDatatableAjax">
                                    <thead>
                                    <tr role="row" class="filter">
                                        <th>SL.</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Video</th>
                                        <th>Created</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($videos as $index => $item)
                                            <tr>
                                                <td>{{ $index+1 }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td><video controls width="300" height="150px" id="vid" src="{{ asset('/uploads/video/'.$item->video) }}"></video></td>
                                                <td>{{ date('d M Y', strtotime($item->created_at)) }}</td>
                                                <td style="text-transform: capitalize"> 
                                                    @if($item->status == 'notapproved')
                                                    Not Approved
                                                    @else
                                                    {{ str_replace('_', ' ', $item->status)  }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <button onclick="approveVideo({{$item->id}})" class="btn btn-success btn-sm" style="background-color: #ffcb32; border: 0px; color: black">Approve</button>
                                                    <button onclick="declineVideo({{$item->id}})" class="btn btn-success btn-sm" style="background-color: #ffcb32; border: 0px; color: black">Not Approve</button>
                                                    <button onclick="deleteVideo({{$item->id}})" class="btn btn-danger btn-sm">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                title: "Are you sure you want to approve this video ?",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        var  urL = 'profile-video/approve/'+id;
                        $.ajax({
                            url: urL,
                            success: function(data){
                                location.reload();
                            }
                        });
                    }
                });
        }

        function declineVideo(id) {
            swal({
                title: "Are you sure you don't want to approve this video ?",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        var  urL = 'profile-video/decline/'+id;
                        $.ajax({
                            url: urL,
                            success: function(data){
                                location.reload();
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
@endpush