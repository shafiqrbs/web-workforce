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
                <li> <a href="{{ route('admin.home') }}">{{__('messages.Home')}}</a> <i class="fa fa-circle"></i> </li>
                <li> <span>{{__('messages.Archives')}}</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">{{__('messages.Manage_Archives')}} <small></small> </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">{{__('messages.Archives')}}</span> </div>
                        <div class="actions">
                            <a href="{{ route('create.archive') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i>{{__('messages.Add_New_Archive')}} </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <form method="post" role="form" id="faq-search-form">
                                <table class="table table-striped table-bordered table-hover"  id="faq_datatable_ajax" >
                                    <thead>
                                        <tr role="row" class="filter">
                                            <td colspan="2"><input type="text" class="form-control" name="name" id="name" autocomplete="off" placeholder="{{__('messages.Enter_Archive_Name')}}"></td>
                                            <td colspan="2"><input type="text" class="form-control" name="sub_title" id="sub_title" autocomplete="off" placeholder="{{__('messages.Enter_Sub_Title')}}"></td>
                                            <td></td>
                                        </tr>
                                        <tr role="row" class="heading">
                                            <th>{{__('messages.SL')}}</th>
                                            <th>{{__('messages.Archive_Name')}}</th>
                                            <th>{{__('messages.Sub_Title')}}</th>
                                            <th>{{__('messages.PDF')}}</th>
                                            <th>{{__('messages.Status')}}</th>
                                            <th>{{__('messages.Actions')}}</th>
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
        var oTable = $('#faq_datatable_ajax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: false,
            searching: false,
            pageLength: 25,

            ajax: {
                url: '{!! route('list.archives') !!}',
                data: function (d) {
                    d.name = $('input[name=name]').val();
                    d.sub_title = $('input[name=sub_title]').val();
                }
            }, columns: [
                {data: 'rownum', name: 'rownum',orderable: false},
                {data: 'archive_name', name: 'archive_name',orderable: false},
                {data: 'sub_title', name: 'sub_title',orderable: false},
                {data: 'pdf', name: 'pdf',orderable: false},
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
        $('#sub_title').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });

    function delete_archive(id) {
        if (confirm('Are you sure! you want to delete?')) {
            $.post("{{ route('delete.archive') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        if (response == 'ok')
                        {
                            var table = $('#faq_datatable_ajax').DataTable();
                            table.row('faq_dt_row_' + id).remove().draw(false);
                        } else
                        {
                            alert('Request Failed!');
                        }
                    });
        }
    }

    function make_not_active(id) {
        var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 4 )');
        $.post("{{ route('make.not.active.archive') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
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
        var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 4 )');

        $.post("{{ route('make.active.archive') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
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