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
                <li> <span>Pages</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">Manage All Pages<small></small> </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Pages</span> </div>
                        <div class="actions">
                            <a href="{{ route('create.cmsContent') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Pages</a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <form method="post" role="form" id="cmsContent-search-form">
                                <table class="table table-striped table-bordered table-hover"  id="cmsContent_datatable_ajax">
                                    <thead>
                                        <tr role="row" class="filter">
                                            <td></td>
                                            <td colspan="2"><input type="text" class="form-control" name="page_title" id="page_title" autocomplete="off" placeholder="Enter page title"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr role="row" class="heading">
                                            <th>SL</th>
                                            <th>Page Title</th>
                                            <th>Page Slug</th>
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
        var oTable = $('#cmsContent_datatable_ajax').DataTable({
            procesing: true,
            serverSide: true,
            stateSave: false,
            searching: false,
            pageLength: 25,
            ajax: {
                url: '{!! route('list.cmsContent') !!}',
                data: function (d) {
                    d.page_title = $('input[name=page_title]').val();
                }
            }, columns: [
                {data: 'rownum', name: 'rownum', orderable: false},
                {data: 'page_title', name: 'page_title', orderable: false},
                {data: 'page_slug', name: 'page_slug', orderable: false},
                {data: 'status', name: 'status', orderable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#cmsContent-search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        /*$('#id').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });*/
        $('#page_title').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });
    function delete_cmsContent(id) {
        if (confirm('Are you sure! you want to delete?')) {
            $.post("{{ route('delete.cmsContent') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        if (response == 'ok')
                        {
                            var table = $('#cmsContent_datatable_ajax').DataTable();
                            table.row('cmsContent_dt_row_' + id).remove().draw(false);
                        } else
                        {
                            alert('Request Failed!');
                        }
                    });
        }
    }

    function make_not_active(id) {
        var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 3 )');
        $.post("{{ route('make.not.active.cms') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
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
        var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 3 )');

        $.post("{{ route('make.active.cms') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
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