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
                    <li> <span>Category</span> </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">Manage Category <small></small> </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Category</span> </div>
                            <div class="actions">
                                <a onclick="load_news_notice_category_add_form()" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Category</a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-container">
                                    <table class="table table-striped table-bordered table-hover"  id="faq_datatable_ajax" >
                                        <thead>

                                        <tr role="row" class="heading">
                                            <th width="10%">SL</th>
                                            <th width="25%">Title</th>
                                            <th width="25%">Slug</th>
                                            <th width="20%">Last updated</th>
                                            <th width="20%">Actions</th>
                                        </tr>
                                        {{ csrf_field() }}

                                        </thead>
                                        <tbody>
                                        @if($categories)
                                            @php $index=1; @endphp
                                            @foreach($categories as $category)
                                                <tr class="item{{$category->id}}">
                                                    <td>{{$index}}</td>
                                                    <td>{{$category->title}}</td>
                                                    <td>{{$category->slug}}</td>

                                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $category->updated_at)->diffForHumans() }}
                                                    </td>
                                                    <td>
                                                        <button id="popup" class="edit-modal btn btn-success" onClick="load_news_notice_category_content_edit_form({{$category->id}});">
                                                            <span class="fa fa-pencil"></span> Edit</button>

                                                        <button id="popup" class="delete-modal btn btn-danger"  onClick="delete_news_notice_category({{$category->id}});">
                                                            <span class="fa fa-trash"></span> Delete</button>
                                                    </td>
                                                </tr>
                                                @php $index++; @endphp
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>

    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" files="true" action="{{ route('create.news.notice.category')}}"
                      enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Category</h4>
                    </div>
                    <div class="modal-body">
                        {{csrf_field()}}
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label class="control-label col-sm-3" for="title">Title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="title" id="title" autofocus
                                       value="{{ old('title_add') }}">
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            </div>
                        </div>
                    </div>
                    <div style="clear:both"></div>
                    <br>
                    <div class="modal-footer">
                        <input type="submit" value="Add" class="btn btn-primary">
                        <input type="submit" value="Close" class="btn btn-warning" data-dismiss="modal">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal form to add a form close -->


    <!-- Modal form to edit a form -->
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" files="true" action="{{route('update.news.notice.category')}}"
                      enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update Category</h4>

                    </div>
                    <div class="modal-body">
                        {{csrf_field()}}
                        <input type="hidden" name="id" id="id">
                        <div class="form-group {{ $errors->has('title_update') ? 'has-error' : '' }}">
                            <label class="control-label col-sm-3" for="title">Title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="title_update" id="title_update"
                                       value="{{ old('title_update') }}">
                                <span class="text-danger">{{ $errors->first('title_update') }}</span>
                            </div>
                        </div>
                    </div>
                    <div style="clear:both"></div>
                    <br>
                    <div class="modal-footer">
                        <input type="submit" value="Update" class="btn btn-primary">
                        <input type="submit" value="Close" class="btn btn-warning" data-dismiss="modal">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('modules/news_notice_categories/js/news_notice_categories.js') }}"></script>

    <script>
        /*function load_news_notice_category_add_form (){
            $('#addModal').modal('show');
        }


        function load_news_notice_category_content_edit_form(id){
            $.getJSON(APP_URL+'/admin/news-notice-category/find/'+id, function(data) {
                $('#id').val(data.id);
                $('#title_update').val(data.title);
                $('#slug_update').val(data.slug);
                $('#editModal').modal('show');
            });
        }
*/

        <?php
        if ($errors->has('title') || $errors->has('slug')) {
        ?>
        $('#addModal').modal('show');

        <?php
        }
        ?>
        <?php
        if ($errors->has('title_update') || $errors->has('slug_update')) {
        ?>
        $('#editModal').modal('show');

        <?php
        } ?>

        $('#news_notice_category_table').dataTable();

    </script>
@endpush