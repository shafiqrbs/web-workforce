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
                <li> <span>Sliders</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR --> 
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">Manage Sliders <small></small> </h3>
        <!-- END PAGE TITLE--> 
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12"> 
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Sliders</span> </div>
                        <div class="actions"> <a href="{{ route('create.slider') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Slider</a> </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <form method="post" role="form" id="slider-search-form">
                                <table class="table table-striped table-bordered table-hover"  id="sliderDatatableAjax">
                                    <thead>                                        
                                        <tr role="row" class="filter">
                                            <td></td>
                                            <td><input type="text" class="form-control" name="slider_heading" id="slider_heading" autocomplete="off" placeholder="Slider"></td>
                                            <td colspan="4"></td>
                                        </tr>
                                        <tr role="row" class="heading">
                                            <th>SL</th>
                                            <th>Slider</th>
                                            <th>Slider Link</th>
                                            <th>Slider Image</th>
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
        var oTable = $('#sliderDatatableAjax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: false,
            searching: false,
            pageLength: 25,

            ajax: {
                url: '{!! route('fetch.data.sliders') !!}',
                data: function (d) {
                    d.slider_heading = $('#slider_heading').val();
                }
            }, columns: [
                {data: 'rownum', name: 'rownum',orderable: false},
                {data: 'slider_heading', name: 'slider_heading',orderable: false},
                {data: 'slider_link', name: 'slider_link',orderable: false},
                {data: 'slider_image', name: 'slider_image',orderable: false},
                {data: 'status', name: 'status',orderable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });


        $('#slider_heading').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });

    });
    function deleteSlider(id, is_default) {
        var msg = 'Are you sure?';
        if (is_default == 1) {
            msg = 'Are you sure? You are going to delete default Slider, all other non default Sliders will be deleted too!';
        }
        if (confirm(msg)) {
            $.post("{{ route('delete.slider') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'}, null, 'text')
                    .done(function (response) {
                        if (response == 'ok')
                        {
                            var table = $('#sliderDatatableAjax').DataTable();
                            table.row('sliderDtRow' + id).remove().draw(false);
                        } else
                        {
                            alert('Request Failed!');
                        }
                    });
        }
    }
    function makeActive(id) {
        $.post("{{ route('make.active.slider') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        var table = $('#sliderDatatableAjax').DataTable();
                        table.row('sliderDtRow' + id).remove().draw(false);
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
    }
    function makeNotActive(id) {
        $.post("{{ route('make.not.active.slider') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        var table = $('#sliderDatatableAjax').DataTable();
                        table.row('sliderDtRow' + id).remove().draw(false);
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
    }
</script> 
@endpush
