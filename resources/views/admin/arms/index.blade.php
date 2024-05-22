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
                <li> <span>{{__('messages.Arms')}}</span> </li>
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
                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">{{__('messages.Manage_arms')}}</span> </div>
                        <div class="actions">
                            <a href="{{ route('create_arms') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i>{{__('messages.Arms_add')}}</a>
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
                                            <td><input type="text" class="form-control" name="bullet_size" id="bullet_size" autocomplete="off" placeholder="{{__('messages.bullet_size')}}"></td>
                                            <td><input type="text" class="form-control" name="quantity" id="quantity" autocomplete="off" placeholder="{{__('messages.quantity')}}"></td>
                                            <td><input type="text" class="form-control" name="max_velocity" id="max_velocity" autocomplete="off" placeholder="{{__('messages.max_velocity')}}"></td>
                                            <td colspan="3"></td>
                                        </tr>
                                        <tr role="row" class="heading">
                                            <th>{{__('messages.SL')}}</th>
                                            <th width="15%">{{__('messages.Name')}}</th>
                                            <th>{{__('messages.bullet_size')}}</th>
                                            <th width="17%">{{__('messages.quantity')}}</th>
                                            <th>{{__('messages.max_velocity')}}</th>
                                            <th>{{__('messages.overall_length')}}</th>
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
                url: '{!! route('list_arms') !!}',
                data: function (d) {
                    d.name = $('input[name=name]').val();
                    d.bullet_size = $('input[name=bullet_size]').val();
                    d.quantity = $('input[name=quantity]').val();
                    d.max_velocity = $('input[name=max_velocity]').val();
                }
            }, columns: [
                {data: 'rownum', name: 'rownum',orderable: false},
                {data: 'name', name: 'name',orderable: false},
                {data: 'bullet_size', name: 'bullet_size',orderable: false},
                {data: 'quantity', name: 'quantity',orderable: false},
                {data: 'max_velocity', name: 'max_velocity',orderable: false},
                {data: 'overall_length', name: 'overall_length',orderable: false},
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
        $('#bullet_size').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#quantity').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#max_velocity').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });
    function delete_arms(id) {
        if (confirm('Are you sure! you want to delete?')) {
            $.post("{{ route('delete_arms') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
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
        var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 6 )');
        $.post("{{ route('make_inactive_arms') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
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
        var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 6 )');

        $.post("{{ route('make_active_arms') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
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