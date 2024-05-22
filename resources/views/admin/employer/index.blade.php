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
                    <li> <span>Employer</span> </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">Manage Employer <small>Employer</small> </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Employer</span> </div>
                            <div class="actions">
                                {{--                            <a href="{{ route('create.user') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add New User</a>--}}
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="table-container">
                                    <form method="post" role="form" id="user-search-form">
                                        <table class="table table-striped table-bordered table-hover"  id="user_datatable_ajax">
                                            <thead>
                                            <tr role="row" class="filter">
                                                <td style="padding: 0" colspan="2"><input type="text" class="form-control" name="name" id="name" autocomplete="off" placeholder="Search by Name"></td>
                                                <td style="padding: 0" colspan="1"><input type="text" class="form-control" name="email" id="email" autocomplete="off" placeholder="Search by Email"></td>
                                                <td style="padding: 0" colspan="1"><input type="text" class="form-control" name="phone" id="phone" autocomplete="off" placeholder="Search by Phone"></td>
                                                <td style="padding: 0">
                                                    <select class="form-control accountStatus" name="accountStatus" id="accountStatus">
                                                        <option value="">Choose Status</option>
                                                        <option value="active">Active</option>
                                                        <option value="inactive">Inactive</option>
                                                        <option value="suspended">Suspended</option>
                                                    </select>
                                                </td>
                                                <td colspan="5"></td>
                                            </tr>
                                            <tr role="row" class="heading">
                                                <th>SN</th>
                                                {{--<th>User Type</th>--}}
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Account Status</th>
                                                <th>Sub Account</th>
                                                {{--<th style="line-height: normal!important;">Is Email <br> Preferences</th>--}}
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
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            var oTable = $('#user_datatable_ajax').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                "order": [[0, "desc"]],

                "stateLoadParams": function (settings, data) {
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone);
                },
                "stateSaveParams": function (settings, data) {
                    data.name = $('#name').val();
                    data.email = $('#email').val();
                    data.phone = $('#phone').val();
                },
                /*
                 paging: true,
                 info: true,
                 */
                ajax: {
                    url: '{!! route('employer.fetch.data.users') !!}',
                    data: function (d) {
                        d.id = $('input[name=id]').val();
                        d.user_type = $('input[name=user_type]').val();
                        d.name = $('input[name=name]').val();
                        d.email = $('input[name=email]').val();
                        d.phone = $('input[name=phone]').val();
                        d.is_active = $('input[name=is_active]').val();
                        d.verified = $('input[name=verified]').val();
                        d.accountStatus = $('.accountStatus').val();
                    }
                }, columns: [
                    /*{data: 'id_checkbox', name: 'id_checkbox', orderable: false, searchable: false},*/
                    {data: 'id', name: 'id'},
                    // {data: 'user_type', name: 'user_type'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'subAccount', name: 'subAccount'},
                    /*{data: 'is_email_preference', name: 'is_email_preference'},*/
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                    $("td:nth-child(1)", nRow).html(iDisplayIndex + 1);
                    return nRow;
                }
            });
            $('#user-search-form').on('submit', function (e) {
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
            $('#accountStatus').on('change', function (e) {
                oTable.draw();
                e.preventDefault();
            });
        });
        function delete_employee(id) {
            if (confirm('Are you sure! you want to delete?')) {
                $.post("{{ route('delete.employee') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        console.log(response);
                        if (response == 'ok')
                        {
                            var table = $('#user_datatable_ajax').DataTable();
                            table.row('user_dt_row_' + id).remove().draw(false);
                        } else
                        {
                            alert('Request Failed!');
                        }
                    });
            }
        }
        function make_active(id) {
            var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 4 )');

            $.post("{{ route('make.active.user') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response.status == 'ok')
                    {
                        $('#onclick_active_' + id).attr("onclick", "make_not_active(" + id + ")");
                        $('#onclick_active_' + id).html("<i class=\"fa fa-square-o\" aria-hidden=\"true\"></i>Suspend");
                        isActiveColumn.text(response.value);
                    } else
                    {
                        alert('Request Failed!');
                    }
                    // var table = $('#user_datatable_ajax').DataTable();
                    // table.draw();
                });
        }
        function make_not_active(id) {
            var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 4 )');
            $.post("{{ route('make.not.active.user') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response.status == 'ok')
                    {
                        $('#onclick_active_' + id).attr("onclick", "make_active(" + id + ")");
                        $('#onclick_active_' + id).html("<i class=\"fa fa-check-square-o\" aria-hidden=\"true\"></i>Active");
                        isActiveColumn.text(response.value);
                    } else
                    {
                        alert('Request Failed!');
                    }
                    // var table = $('#user_datatable_ajax').DataTable();
                    // table.draw();
                });
        }
        function make_verified(id) {
            var isVerifiedColumn = $('#onclick_verified_' + id).closest('tr').find('td:eq( 6 )');
            $.post("{{ route('make.verified.user') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response.status == 'ok')
                    {
                        $('#onclick_verified_' + id).attr("onclick", "make_not_verified(" + id + ")");
                        $('#onclick_verified_' + id).html("<i class=\"fa fa-square-o\" aria-hidden=\"true\"></i>Not Verified");
                        isVerifiedColumn.text(response.value);
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
        }
        function make_not_verified(id) {
            var isVerifiedColumn = $('#onclick_verified_' + id).closest('tr').find('td:eq( 6 )');
            $.post("{{ route('make.not.verified.user') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response.status == 'ok')
                    {
                        $('#onclick_verified_' + id).attr("onclick", "make_verified(" + id + ")");
                        $('#onclick_verified_' + id).html("<i class=\"fa fa-check-square-o\" aria-hidden=\"true\"></i>Verified");
                        isVerifiedColumn.text(response.value);
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
        }
    </script>
@endpush