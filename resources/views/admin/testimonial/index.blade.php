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
                <li> <span>Testimonials</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR --> 
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">Manage Testimonials <small>Testimonials</small> </h3>
        <!-- END PAGE TITLE--> 
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12"> 
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Testimonials</span> </div>
                        {{--<div class="actions"> <a href="{{ route('create.testimonial') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Testimonial</a> </div>--}}
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <form method="post" role="form" id="testimonial-search-form">
                                <table class="table table-striped table-bordered table-hover"  id="testimonialDatatableAjax">
                                    <thead>
                                        <tr role="row" class="filter">
                                            <td>{!! Form::select('lang', ['' => 'Select Language']+$languages, config('default_lang'), array('id'=>'lang', 'class'=>'form-control')) !!}</td>
                                            <td><input type="text" class="form-control" name="testimonial_by" id="testimonial_by" autocomplete="off" placeholder="Testimonial by"></td>
                                            <td><input type="text" class="form-control" name="testimonial" id="testimonial" autocomplete="off" placeholder="Testimonial"></td>
                                            <td>
                                                <select name="is_active" id="is_active"  class="form-control">
                                                    <option value="-1">Is Active?</option>
                                                    <option value="1" selected="selected">Active</option>
                                                    <option value="0">In Active</option>
                                                </select>
                                            </td>
                                            <td colspan="2">
                                                <select name="user_type" id="user_type"  class="form-control">
                                                    <option value="">Choose User Type</option>
                                                    <option value="candidate" selected="selected">Candidate</option>
                                                    <option value="employee">Employee</option>
                                                </select>
                                            </td>
                                            <td colspan="3"></td>
                                        </tr>
                                        <tr role="row" class="heading">
                                            <th>Created</th>
                                            <th>Testimonial By</th>
                                            <th>Email</th>
                                            <th>Testimonial</th>
                                            <th>Rating</th>
                                            <th>User Type</th>
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


        var oTable = $('#testimonialDatatableAjax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            searching: false,
            /*		
             "order": [[1, "asc"]],            
             paging: true,
             info: true,
             */
            ajax: {
                url: '{!! route('fetch.data.testimonials') !!}',
                data: function (d) {
                    d.created_at = $('#created_at').val();
                    d.testimonial_by = $('#testimonial_by').val();
                    d.testimonial = $('#testimonial').val();
                    d.rating = $('#rating').val();
                    d.user_type = $('#user_type').val();
                    d.is_active = $('#is_active').val();
                }
            }, columns: [
                {data: 'created_at', name: 'created_at'},
                {data: 'testimonial_by', name: 'testimonial_by'},
                {data: 'user_id', name: 'user_id'},
                {data: 'testimonial', name: 'testimonial'},
                {data: 'rating', name: 'rating'},
                {data: 'user_type', name: 'user_type'},
                {data: 'is_active',
                    render: function ( data, type, row ) {

                    if ( type === 'display' ) {
                        var checked= data===1?'checked':'';
                        var title= data===1?'Active':'Inactive';
                        return '<input type="checkbox" data-id="'+row.id+'" '+checked+' title="'+title+'" value="'+data+'" class="testimonial_status">';
                    }
                    return data;
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#testimonial-search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#lang').on('change', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#testimonial_by').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#testimonial').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#is_active').on('change', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#user_type').on('change', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });
    function deleteTestimonial(id, is_default) {
        var msg = 'Are you sure?';
        if (is_default == 1) {
            msg = 'Are you sure? You are going to delete default Testimonial, all other non default Testimonials will be deleted too!';
        }
        if (confirm(msg)) {
            $.post("{{ route('delete.testimonial') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'}, null, 'text')
                    .done(function (response) {
                        if (response == 'ok')
                        {
                            var table = $('#testimonialDatatableAjax').DataTable();
                            table.row('testimonialDtRow' + id).remove().draw(false);
                        } else
                        {
                            alert('Request Failed!');
                        }
                    });
        }
    }
    function makeActive(id) {
        $.post("{{ route('make.active.testimonial') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        var table = $('#testimonialDatatableAjax').DataTable();
                        table.row('testimonialDtRow' + id).remove().draw(false);
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
    }
    function makeNotActive(id) {
        $.post("{{ route('make.not.active.testimonial') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok')
                    {
                        var table = $('#testimonialDatatableAjax').DataTable();
                        table.row('testimonialDtRow' + id).remove().draw(false);
                    } else
                    {
                        alert('Request Failed!');
                    }
                });
    }

    $(document).on('click', '.testimonial_status', function () {
        var element = $(this);
        var status = $(this).val();
        console.log(status)
        var id = $(this).attr('data-id');
        if(status==1){
            $.post("{{ route('make.not.active.testimonial') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok')
                    {

                    } else
                    {
                        alert('Request Failed!');
                    }
                });
        }else {
            $.post("{{ route('make.active.testimonial') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
                .done(function (response) {
                    if (response == 'ok')
                    {

                    } else
                    {
                        alert('Request Failed!');
                    }
                });
        }
        var table = $('#testimonialDatatableAjax').DataTable();
        table.draw();
    });


</script>
@endpush 