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
                <li> <span>Sub Committee</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR --> 
        <!-- BEGIN PAGE TITLE-->
{{--        <h3 class="page-title">Manage Members <small>Members</small> </h3>--}}
        <!-- END PAGE TITLE--> 
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12"> 
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Manage Sub Committee</span> </div>
                        <div class="actions">
                            <a href="{{ route('create.sub.committee.member') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Sub Committee</a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <form method="post" role="form" id="faq-search-form">
                                <table class="table table-striped table-bordered table-hover"  id="executive_member_ajax">
                                    <thead>
                                        <tr role="row" class="filter">
                                            <td></td>
                                            <td><input type="text" class="form-control" name="name" id="name" autocomplete="off" placeholder="Enter Name"></td>
                                            <td><input type="text" class="form-control" name="email" id="email" autocomplete="off" placeholder="Enter email"></td>
                                            <td><input type="text" class="form-control" name="mobile" id="mobile" autocomplete="off" placeholder="Enter Mobile"></td>
                                            <td colspan="3"></td>
                                        </tr>
                                        <tr role="row" class="heading"> 
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile </th>
                                            <th>Designation</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table></form>
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
<script>
    $(function () {
        var oTable = $('#executive_member_ajax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: false,
            searching: false,
            pageLength: 25,

            ajax: {
                url: '{!! route('fetch.data.sub.committee.members') !!}',
                data: function (d) {
                    d.name = $('input[name=name]').val();
                    d.mobile = $('input[name=mobile]').val();
                    d.email = $('input[name=email]').val();
                }
            }, columns: [
                {data: 'rownum', name: 'rownum',orderable: false},
                {data: 'name', name: 'name',orderable: false},
                {data: 'email', name: 'email',orderable: false},
                {data: 'mobile', name: 'mobile',orderable: false},
                {data: 'career_level', name: 'career_level',orderable: false},
                {data: 'status', name: 'status',orderable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#faq-search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#name').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#mobile').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });

        $('#email').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });
    function delete_committee_member(id) {
        if (confirm('Are you sure! you want to delete?')) {
            $.post("{{ route('delete.sub.committee.member') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        if (response == 'ok')
                        {
                            var table = $('#executive_member_ajax').DataTable();
                            table.row('faq_dt_row_' + id).remove().draw(false);
                        } else
                        {
                            alert('Request Failed!');
                        }
                    });
        }
    }

    function make_not_active(id) {
        var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 5 )');
        $.post("{{ route('make.not.active.sub.committee') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
            .done(function (response) {
                if (response.status == 'ok')
                {
                    $('#onclick_active_' + id).attr("onclick", "make_active(" + id + ")");
                    $('#onclick_active_' + id).html("<i class=\"fas fa-check-square\"></i> Active");
                    isActiveColumn.text(response.value);
                } else
                {
                    alert('Request Failed!');
                }
            });
    }
    function make_active(id) {
        var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 5 )');

        $.post("{{ route('make.active.sub.committee') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
            .done(function (response) {
                if (response.status == 'ok')
                {
                    $('#onclick_active_' + id).attr("onclick", "make_not_active(" + id + ")");
                    $('#onclick_active_' + id).html("<i class=\"fas fa-check-square\"></i> Inactive");
                    isActiveColumn.text(response.value);
                } else
                {
                    alert('Request Failed!');
                }
            });
    }
</script> 
@endpush