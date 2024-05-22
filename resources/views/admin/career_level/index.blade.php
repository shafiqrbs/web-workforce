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
                <li> <span>Career Levels</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR --> 
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">Manage Career Levels <small></small> </h3>
        <!-- END PAGE TITLE--> 
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12"> 
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Career Levels</span> </div>
                        <div class="actions"> <a href="{{ route('create.career.level') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Career Level</a> </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <form method="post" role="form" id="careerLevel-search-form">
                                <table class="table table-striped table-bordered table-hover"  id="careerLevelDatatableAjax">
                                    <thead>
                                        <tr role="row" class="filter">
                                            <td></td>
                                            <td><input type="text" class="form-control" name="career_level" id="career_level" autocomplete="off" placeholder="Career Level"></td>
                                            <td>
                                                <select name="committee_type" id="committee_type"  class="form-control">
                                                    <option value="" selected="selected">All</option>
                                                    <option value="EXECUTIVE_COMMITTEE">Executive Committee</option>
                                                    <option value="CAMP_COMMANDANT_COACH">Camp Commandant & Coach</option>
                                                    <option value="OFFICE_ADMINISTRATION">Office Administration</option>
                                                    <option value="SUB_COMMITTEE">Sub Committees</option>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            {{--<td>
                                                <select name="is_active" id="is_active"  class="form-control">
                                                    <option value="1" selected="selected">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </td>--}}
                                        </tr>
                                        <tr role="row" class="heading">                                            
                                            <th>SL</th>
                                            <th>Career Level</th>
                                            <th>Committee Type</th>
                                            <th>Status</th>
                                            <th>Actions</th>
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
<script>
    $(function () {
        var oTable = $('#careerLevelDatatableAjax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: false,
            searching: false,
            pageLength: 25,
            ajax: {
                url: '{!! route('fetch.data.career.levels') !!}',
                data: function (d) {
                    d.career_level = $('input[name=career_level]').val();
                    d.committee_type = $('#committee_type').val();
                    // d.is_active = $('#is_active').val();
                }
            }, columns: [
                {data: 'rownum', name: 'rownum',orderable: false},
                {data: 'career_level', name: 'career_level',orderable: false},
                {data: 'committee_type', name: 'committee_type',orderable: false},
                {data: 'status', name: 'status',orderable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        $('#committee_type').on('change', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#career_level').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        /*$('#is_active').on('change', function (e) {
            oTable.draw();
            e.preventDefault();
        });*/
    });
    function deleteCareerLevel(id, is_default) {
        var msg = 'Are you sure?';
        if (is_default == 1) {
            msg = 'Are you sure? You are going to delete default Career Level, all other non default Career Levels will be deleted too!';
        }
        if (confirm(msg)) {
            $.post("{{ route('delete.career.level') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        if (response == 'ok')
                        {
                            var table = $('#careerLevelDatatableAjax').DataTable();
                            table.row('careerLevelDtRow' + id).remove().draw(false);
                        } else
                        {
                            alert('Request Failed!');
                        }
                    });
        }
    }
    function makeActive(id) {
        var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 4 )');
        $.post("{{ route('make.active.career.level') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        var table = $('#careerLevelDatatableAjax').DataTable();
                        table.row('careerLevelDtRow' + id).remove().draw(false);
                        isActiveColumn.text(response.value);
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
    }
    function makeNotActive(id) {
        $.post("{{ route('make.not.active.career.level') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        var table = $('#careerLevelDatatableAjax').DataTable();
                        table.row('careerLevelDtRow' + id).remove().draw(false);
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
    }
</script> 
@endpush