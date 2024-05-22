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
                    <li><a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i></li>
                    <li><span>Athletes</span></li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">Manage Athletes <small></small></h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            @include('flash::message')

            <div class="row">
                <div class="col-md-12">
                    <!-- Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption"><i class="icon-settings font-dark"></i> <span
                                        class="caption-subject font-dark sbold uppercase">Athletes</span></div>
                            <div class="actions">
                                <a href="{{ route('create_athlete_user') }}" class="btn btn-xs btn-success"><i
                                            class="glyphicon glyphicon-plus"></i> Add New Athlete</a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="table-container">
                                    <form method="post" role="form" id="user-search-form">
                                        <table class="table table-striped table-bordered table-hover"
                                               id="user_datatable_ajax">
                                            <thead>
                                            <tr role="row" class="filter">
                                                <td></td>
                                                <td style="padding: 0" colspan="1"><input type="text"
                                                                                          class="form-control"
                                                                                          name="name" id="name"
                                                                                          autocomplete="off"
                                                                                          placeholder="Search by Name">
                                                </td>
                                                <td style="padding: 0" colspan="1"><input type="text"
                                                                                          class="form-control"
                                                                                          name="email" id="email"
                                                                                          autocomplete="off"
                                                                                          placeholder="Search by Email">
                                                </td>
                                                <td style="padding: 0" colspan="1"><input type="text"
                                                                                          class="form-control"
                                                                                          name="phone" id="phone"
                                                                                          autocomplete="off"
                                                                                          placeholder="Search by Phone">
                                                </td>
                                                <td style="padding: 0">
                                                    <select class="form-control" name="athleteType" id="athleteType">
                                                        <option value="">Choose Type</option>
                                                        <option value="Rifle">Rifle</option>
                                                        <option value="Pistol">Pistol</option>
                                                        <option value="Short">Short Gun</option>
                                                        <option value="Disabled">Handicapped</option>
                                                    </select>
                                                </td>
                                                <td style="padding: 0">
                                                    <select class="form-control" name="presentAthlete"
                                                            id="presentAthlete">
                                                        <option value="">All</option>
                                                        <option value="1">Present Athlete</option>
                                                        <option value="0">Former Athlete</option>
                                                    </select>
                                                </td>
                                                <td colspan="5"></td>
                                            </tr>
                                            <tr role="row" class="heading">
                                                <th>SL</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Athlete Type</th>
                                                <th>Is present</th>
                                                <th>Status</th>
                                                <th>Is Approved</th>
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
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection
@push('scripts')
    <script>

        var oTable = $('#user_datatable_ajax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: false,
            searching: false,
            pageLength: 25,

            /*"stateLoadParams": function (settings, data) {
                $('#name').val(data.athlete_name);
                $('#email').val(data.email);
                $('#phone').val(data.mobile);
                $('#athleteType').val(data.athlete_type);
            },
            "stateSaveParams": function (settings, data) {
                data.athlete_name = $('#name').val();
                data.email = $('#email').val();
                data.mobile = $('#phone').val();
                data.athlete_type = $('#athleteType').val();
            },*/
            ajax: {
                url: '{!! route('list.users') !!}',
                data: function (d) {
                    d.name = $('input[name=name]').val();
                    d.email = $('input[name=email]').val();
                    d.mobile = $('input[name=phone]').val();
                    d.athleteType = $('#athleteType').val();
                    d.presentAthlete = $('#presentAthlete').val();
                }
            }, columns: [
                {data: 'rownum', name: 'rownum', orderable: false},
                {data: 'athlete_name', name: 'athlete_name', orderable: false},
                {data: 'email', name: 'email', orderable: false},
                {data: 'mobile', name: 'mobile', orderable: false},
                {data: 'athlete_type', name: 'athlete_type', orderable: false},
                {data: 'is_present', name: 'is_present', orderable: false},
                {data: 'is_active', name: 'is_active', orderable: false},
                {data: 'is_approved', name: 'is_approved', orderable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            "rowCallback": function (nRow, aData, iDisplayIndex) {
                var oSettings = this.fnSettings();
                $("td:first", nRow).html(oSettings._iDisplayStart + iDisplayIndex + 1);
                return nRow;
            },
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
        $('#athleteType').on('change', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#presentAthlete').on('change', function (e) {
            oTable.draw();
            e.preventDefault();
        });

        function make_not_active(id) {
            var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 6 )');
            $.post("{{ route('make.not.active.user') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response.status == 'ok') {
                        $('#onclick_active_' + id).attr("onclick", "make_active(" + id + ")");
                        $('#onclick_active_' + id).html("<i class=\"fas fa-check-square\"></i> Active");
                        isActiveColumn.text(response.value);
                    } else {
                        alert('Request Failed!');
                    }
                });
        }

        function make_active(id) {
            var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 6 )');

            $.post("{{ route('make.active.user') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response.status == 'ok') {
                        $('#onclick_active_' + id).attr("onclick", "make_not_active(" + id + ")");
                        $('#onclick_active_' + id).html("<i class=\"fas fa-check-square\"></i> Inactive");
                        isActiveColumn.text(response.value);
                    } else {
                        alert('Request Failed!');
                    }
                });
        }

        function delete_user(id) {
            if (confirm('Are you sure! you want to delete?')) {
                $.post("{{ route('delete.user') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        if (response == 'ok') {
                            var table = $('#user_datatable_ajax').DataTable();
                            table.row('user_dt_row_' + id).remove().draw(false);
                        } else {
                            alert('Request Failed!');
                        }
                    });
            }
        }


        function make_not_approve(id) {
            var isApproveColumn = $('#onclick_approve_' + id).closest('tr').find('td:eq( 7 )');
            $.post("{{ route('make.not.approve.user') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response.status == 'ok') {
                        $('#onclick_approve_' + id).attr("onclick", "make_approve(" + id + ")");
                        $('#onclick_approve_' + id).html("<i class=\"fas fa-check-square\"></i> Approved");
                        isApproveColumn.text(response.value);
                    } else {
                        alert('Request Failed!');
                    }
                });
        }

        function make_approve(id) {
            var isApproveColumn = $('#onclick_approve_' + id).closest('tr').find('td:eq( 7 )');

            $.post("{{ route('make.approve.user') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response.status == 'ok') {
                        $('#onclick_approve_' + id).attr("onclick", "make_not_approve(" + id + ")");
                        $('#onclick_approve_' + id).html("<i class=\"fas fa-check-square\"></i> Hold");
                        isApproveColumn.text(response.value);
                    } else {
                        alert('Request Failed!');
                    }
                });
        }


        function make_former(id) {
            var isFormerColumn = $('#onclick_former_' + id).closest('tr').find('td:eq( 5 )');
            $.post("{{ route('make.former.athlete') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response.status == 'ok') {
                        $('#onclick_former_' + id).attr("onclick", "make_present(" + id + ")");
                        $('#onclick_former_' + id).html("<i class=\"fas fa-check-square\"></i> Make Present");
                        isFormerColumn.text(response.value);
                    } else {
                        alert('Request Failed!');
                    }
                });
        }

        function make_present(id) {
            var isFormerColumn = $('#onclick_former_' + id).closest('tr').find('td:eq( 5 )');

            $.post("{{ route('make.present.athlete') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response.status == 'ok') {
                        $('#onclick_former_' + id).attr("onclick", "make_former(" + id + ")");
                        $('#onclick_former_' + id).html("<i class=\"fas fa-check-square\"></i> Make Former");
                        isFormerColumn.text(response.value);
                    } else {
                        alert('Request Failed!');
                    }
                });
        }
    </script>
@endpush