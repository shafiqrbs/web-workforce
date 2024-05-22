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
                <li> <span>{{__('messages.Clubs')}}</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR --> 
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">{{__('messages.Manage_Clubs')}}  <small></small> </h3>
        <!-- END PAGE TITLE--> 
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12"> 
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">{{__('messages.Clubs')}}</span> </div>
                        <div class="actions">
                            <a href="{{ route('create.club') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i>{{__('messages.Add_New_Club')}}</a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <form method="post" role="form" id="faq-search-form">
                                <table class="table table-striped table-bordered table-hover"  id="faq_datatable_ajax">
                                    <thead>
                                        <tr role="row" class="filter">
                                            <td></td>
                                            <td><input type="text" class="form-control" name="name" id="name" autocomplete="off" placeholder="{{__('messages.Please_enter_name')}}"></td>
                                            <td><input type="text" class="form-control" name="mobile" id="mobile" autocomplete="off" placeholder="{{__('messages.Please_enter_mobile')}}"></td>
                                            <td colspan="3"></td>
                                        </tr>
                                        <tr role="row" class="heading"> 
                                            <th>{{__('messages.SL')}}</th>
                                            <th>{{__('messages.Name')}}</th>
                                            <th>{{__('messages.Mobile_Number')}}</th>
                                            <th>{{__('messages.Reg_Number')}}</th>
                                            <th>{{__('messages.District')}}</th>
                                            <th>{{__('messages.Division')}}</th>
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
                url: '{!! route('fetch.data.clubs') !!}',
                data: function (d) {
                    d.name = $('input[name=name]').val();
                    d.mobile = $('input[name=mobile]').val();
                    // d.register_number = $('input[name=register_number]').val();
                }
            }, columns: [
                {data: 'rownum', name: 'rownum'},
                {data: 'name', name: 'name'},
                {data: 'mobile', name: 'mobile'},
                {data: 'registration_number', name: 'registration_number'},
                {data: 'city', name: 'city'},
                {data: 'division', name: 'division'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#faq-search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        /*$('#lang').on('change', function (e) {
            oTable.draw();
            e.preventDefault();
        });*/
        $('#name').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#mobile').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });
    function delete_faq(id) {
        if (confirm('Are you sure! you want to delete?')) {
            $.post("{{ route('delete.club') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
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
        $.post("{{ route('make.not.active.club') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
            .done(function (response) {
                if (response.status == 'ok')
                {
                    $('#onclick_active_' + id).attr("onclick", "make_active(" + id + ")");
                    $('#onclick_active_' + id).html("<i class=\"fas fa-check-square\"></i> {{__('messages.Active')}}");
                    isActiveColumn.text(response.value);
                } else
                {
                    alert('Request Failed!');
                }
            });
    }
    function make_active(id) {
        var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 6 )');

        $.post("{{ route('make.active.club') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
            .done(function (response) {
                if (response.status == 'ok')
                {
                    $('#onclick_active_' + id).attr("onclick", "make_not_active(" + id + ")");
                    $('#onclick_active_' + id).html("<i class=\"fas fa-check-square\"></i> {{__('messages.Inactive')}}");
                    isActiveColumn.text(response.value);
                } else
                {
                    alert('Request Failed!');
                }
            });
    }
</script> 
@endpush