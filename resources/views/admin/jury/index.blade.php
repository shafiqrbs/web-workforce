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
                <li> <span>{{__('messages.Judges_Jury')}}</span> </li>
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
                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">{{__('messages.Manage_judges_jury')}}</span> </div>
                        <div class="actions">
                            <a href="{{ route('create_member') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i>{{__('messages.Judges_Jury_add')}}</a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <form method="post" role="form" id="faq-search-form">
                                <table class="table table-striped table-bordered table-hover"  id="judges_jury_table">
                                    <thead>
                                        <tr role="row" class="filter">
                                            <td></td>
                                            <td><input type="text" class="form-control" name="name" id="name" autocomplete="off" placeholder="{{__('messages.Name')}}"></td>
                                            <td><input type="text" class="form-control" name="email" id="email" autocomplete="off" placeholder="{{__('messages.Email')}}"></td>
                                            <td><input type="text" class="form-control" name="mobile" id="mobile" autocomplete="off" placeholder="{{__('messages.Mobile_Number')}}"></td>
                                            <td colspan="6"></td>
                                        </tr>
                                        <tr role="row" class="heading">
                                            <th>{{__('messages.SL')}}</th>
                                            <th width="15%">{{__('messages.Name')}}</th>
                                            <th>{{__('messages.Email')}}</th>
                                            <th width="17%">{{__('messages.Mobile_Number')}}</th>
                                            <th>{{__('messages.Jury_Class')}}</th>
                                            <th>{{__('messages.ISSF_License_No')}}</th>
                                            <th>{{__('messages.License_Valid_Date')}}</th>
                                            <th>{{__('messages.Remarks')}}</th>
                                            <th>{{__('messages.Status')}}</th>
                                            <th width="12%">{{__('messages.Actions')}}</th>
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
        var oTable = $('#judges_jury_table').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            searching: false,
            pageLength: 25,

            ajax: {
                url: '{!! route('list_jury') !!}',
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
                {data: 'jury_class', name: 'jury_class',orderable: false},
                {data: 'issf_license_no', name: 'issf_license_no',orderable: false},
                {data: 'license_valid_date', name: 'license_valid_date',orderable: false},
                {data: 'remark', name: 'remark',orderable: false},
                {data: 'status', name: 'status',orderable: false},
                {data: 'action', name: 'action',orderable: false, searchable: false}
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
    function delete_judges_jury(id) {
        if (confirm('Are you sure! you want to delete?')) {
            $.post("{{ route('delete_jury') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        if (response == 'ok')
                        {
                            var table = $('#judges_jury_table').DataTable();
                            table.row('faq_dt_row_' + id).remove().draw(false);
                        } else
                        {
                            alert('Request Failed!');
                        }
                    });
        }
    }

    function make_not_active(id) {
        var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 8 )');
        $.post("{{ route('make_inactive_jury') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
            .done(function (response) {
                if (response.status == 'ok')
                {
                    $('#onclick_active_' + id).attr("onclick", "make_active(" + id + ")");
                    $('#onclick_active_' + id).html("<i class=\"fas fa-check-square\"></i> <?php echo __('messages.Active') ?>");
                    isActiveColumn.text(response.value);
                } else
                {
                    alert('Request Failed!');
                }
            });
    }
    function make_active(id) {
        var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 8 )');

        $.post("{{ route('make_active_jury') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
            .done(function (response) {
                if (response.status == 'ok')
                {
                    $('#onclick_active_' + id).attr("onclick", "make_not_active(" + id + ")");
                    $('#onclick_active_' + id).html("<i class=\"fas fa-check-square\"></i> <?php echo __('messages.Inactive') ?>");
                    isActiveColumn.text(response.value);
                } else
                {
                    alert('Request Failed!');
                }
            });
    }
</script>
@endpush