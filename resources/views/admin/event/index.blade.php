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
                <li> <span>{{__('messages.Events')}}</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">{{__('messages.Manage_Events')}} <small></small> </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">{{__('messages.Events')}}</span> </div>
                        <div class="actions">
                            <a href="{{ route('create.event') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i>{{__('messages.Add_New_Event')}}</a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <form method="post" role="form" id="faq-search-form">
                                <table class="table table-striped table-bordered table-hover"  id="faq_datatable_ajax">
                                    <thead>
                                        <tr role="row" class="filter">
                                            <th></th>
                                            <td><input type="text" class="form-control" name="name" id="name" autocomplete="off" placeholder="{{__('messages.Enter_Event_Name')}}"></td>
                                            <td><input type="text" class="form-control" name="type" id="type" autocomplete="off" placeholder="{{__('messages.Enter_type')}}"></td>
                                            <td colspan="5"></td>
                                        </tr>
                                        <tr role="row" class="heading">
                                            <th>{{__('messages.SL')}}</th>
                                            <th>{{__('messages.Event_Name')}}</th>
                                            <th>{{__('messages.Event_Type')}}</th>
                                            <th>{{__('messages.Clubs')}}</th>
                                            <th>{{__('messages.Athletes')}}</th>
                                            <th>{{__('messages.Officials')}}</th>
                                            <th>Participant</th>
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

            /*		"order": [[0, "desc"]],
             paging: true,
             info: true,
             */
            ajax: {
                url: '{!! route('list.events') !!}',
                data: function (d) {
                    d.name = $('input[name=name]').val();
                    d.type = $('input[name=type]').val();
                }
            }, columns: [
                /*{data: 'id_checkbox', name: 'id_checkbox', orderable: false, searchable: false},*/
                {data: 'rownum', name: 'rownum'},
                {data: 'event_name', name: 'event_name'},
                {data: 'event_type', name: 'event_type'},
                {data: 'number_of_club', name: 'number_of_club'},
                {data: 'number_of_athlete', name: 'number_of_athlete'},
                {data: 'number_of_official', name: 'number_of_official'},
                {data: 'participant', name: 'participant'},
                {data: 'status', name: 'status'},
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
        $('#type').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });

    function delete_event(id) {
        if (confirm('Are you sure! you want to delete?')) {
            $.post("{{ route('delete.event') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
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
        var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 6 )');
        $.post("{{ route('make.not.active.event') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
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
        var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 6 )');

        $.post("{{ route('make.active.event') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
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