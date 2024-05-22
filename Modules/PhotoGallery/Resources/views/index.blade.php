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
                    <li> <span>Photo Gallery</span> </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
        @include('flash::message')
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">Manage Photo Gallery <small></small> </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Photo Gallery</span> </div>
                            <div class="actions">
                                <a href="{{ route('create.gallery') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add Photo Gallery</a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-container">
                                <form method="post" role="form" id="faq-search-form">
                                    <table class="table table-striped table-bordered table-hover"  id="gallery_datatable_ajax">
                                        <thead>
                                        <tr role="row" class="heading">
                                            <th>Name</th>
                                            <th>Cover Image</th>
                                            <th>No. of image</th>
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
            var oTable = $('#gallery_datatable_ajax').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                /*		"order": [[0, "desc"]],
                 paging: true,
                 info: true,
                 */
                ajax: {
                    url: '{!! route('fetch.data.gallery') !!}',
                    data: function (d) {
                        d.name = $('input[name=name]').val();
                    }
                }, columns: [
                    /*{data: 'id_checkbox', name: 'id_checkbox', orderable: false, searchable: false},*/
                    {data: 'name', name: 'name'},
                    {data: 'cover_image', name: 'cover_image'},
                    {data: 'no_of_image', name: 'no_of_image'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });

        function make_not_active(id) {
            var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 3 )');
            $.post("{{ route('make_not_active_gallery') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
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

            $.post("{{ route('make_active_gallery') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
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