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
                            <form method="post" role="form" id="user-video-search-form">
                                <table class="table table-striped table-bordered table-hover"  id="user_video_datatable_ajax">
                                    <thead>
                                    <tr role="row" class="filter">
                                        <td colspan="4" style="padding: 0 5px 0 0" align="right">Search By Status</td>
                                        <td colspan="2" style="padding: 0">
                                            <select class="form-control videoStatus" name="videoStatus" id="videoStatus">
                                                <option value="">Choose Status</option>
                                                <option value="created">Uploaded</option>
                                                <option value="approved">Approved</option>
                                                <option value="notapproved">Not Approved</option>
                                                <option value="submitted_for_approval">Submitted for Approval</option>
                                            </select>
                                        </td>
                                        <td colspan="3"></td>
                                    </tr>
                                <tr role="row" class="filter">
                                    <th>SL.</th>
                                    <th>Email</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Video</th>
                                    <th>Created</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            </form>
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
    $(function () {
        var oTable = $('#user_video_datatable_ajax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            searching: false,
            "order": [[0, "desc"]],
            /*		
             paging: true,
             info: true,
             */
            ajax: {
                url: '{!! route('fetch.user.videos') !!}',
                data: function (d) {
                    d.videoStatus = $('.videoStatus').val();
                }
            }, columns: [
                /*{data: 'id_checkbox', name: 'id_checkbox', orderable: false, searchable: false},*/
                {data: 'id', name: 'id'},
                {data: 'user_id', name: 'user_id'},
                {data: 'title', name: 'title'},
                {data: 'description', name: 'description'},
                {data: 'video', name: 'video'},
                {data: 'created_at', name: 'created_at'},
                // {data: 'user_type', name: 'user_type'},
                {data: 'status', name: 'status'},

                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                $("td:nth-child(1)", nRow).html(iDisplayIndex + 1);
                return nRow;
            }
        });
        $('#user-video-search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#id').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#name').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#email').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#phone').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#videoStatus').on('change', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });
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
                            var oTable =$('#user_video_datatable_ajax').DataTable();
                            oTable.draw();
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
                            var oTable =$('#user_video_datatable_ajax').DataTable();
                            oTable.draw();
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
                            swal("This Video Has Been Deleted ! ")
                                .then((value) => {
                                    var oTable =$('#user_video_datatable_ajax').DataTable();
                                    oTable.draw();
                                });
                        }
                    });
                }
            });
    }
</script> 
@endpush