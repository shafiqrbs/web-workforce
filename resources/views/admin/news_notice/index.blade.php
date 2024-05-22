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
                    <li> <span>News & Notices</span> </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">Manage News & Notices <small></small> </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">News & Notices</span> </div>
                            <div class="actions">
                                <a href="{{ route('create.news.notice') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add New New & Notice</a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-container">
                                <form method="post" role="form" id="faq-search-form">
                                    <table class="table table-striped table-bordered table-hover"  id="faq_datatable_ajax">
                                        <thead>
                                        <tr role="row" class="filter">
                                            <td></td>
                                            <td><input type="text" class="form-control" name="title" id="title" autocomplete="off" placeholder="Enter News Title"></td>
                                            <td><input type="text" class="form-control" name="content" id="content" autocomplete="off" placeholder="Enter News Content"></td>
                                            <td>
                                                <select name="type" id="type" class="form-control type">
                                                    <option value="">Choose Type</option>
                                                    <option value="NEWS">News</option>
                                                    <option value="NOTICE">Notices</option>
                                                </select>
                                            </td>
                                            <td colspan="3"></td>
                                        </tr>
                                        <tr role="row" class="heading">
                                            <th>SL</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Type</th>
                                            <th>Last updated</th>
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
            var oTable = $('#faq_datatable_ajax').DataTable({
                processing: true,
                serverSide: true,
                stateSave: false,
                searching: false,
                pageLength: 25,

                ajax: {
                    url: '{!! route('list.news.notice') !!}',
                    data: function (d) {
                        d.title = $('input[name=title]').val();
                        d.content = $('input[name=content]').val();
                        d.type = $('.type').val();
                    }
                }, columns: [
                    {data: 'rownum', name: 'rownum', orderable: false},
                    {data: 'title', name: 'title', orderable: false},
                    {data: 'content', name: 'content', orderable: false},
                    {data: 'post_type', name: 'post_type', orderable: false},
                    {data: 'last_update', name: 'last_update', orderable: false},
                    {data: 'status', name: 'status', orderable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                "rowCallback": function (nRow, aData, iDisplayIndex) {
                    var oSettings = this.fnSettings ();
                    $("td:first", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
                    return nRow;
                },
            });
            $('#faq-search-form').on('submit', function (e) {
                oTable.draw();
                e.preventDefault();
            });

            $('#title').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#content').on('keyup', function (e) {
                oTable.draw();
                e.preventDefault();
            });
            $('.type').on('change', function (e) {
                oTable.draw();
                e.preventDefault();
            });
        });

        function delete_news_notice(id) {
            if (confirm('Are you sure! you want to delete?')) {
                $.post("{{ route('delete.news.notice') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
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
            var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 5 )');
            $.post("{{ route('make.not.active.news') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
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
            var isActiveColumn = $('#onclick_active_' + id).closest('tr').find('td:eq( 5 )');

            $.post("{{ route('make.active.news') }}", {id: id, _method: 'PUT', _token: '{{ csrf_token() }}'})
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








{{--
@extends('admin.layouts.admin_layout')

@push('css')
--}}
{{--<link rel="stylesheet" href="{{ asset('public/modules/blogs/css/blogs.css') }}">--}}{{--

--}}
{{--<link href="{{ asset('css/bootstrap-multiselect.css') }}" rel="stylesheet" type="text/css" />--}}{{--

@endpush
@section('content')
    <style>
        .dataTable td p{
            margin: 0!important;
        }
    </style>
<div class="content-wrapper">

    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            @if(session()->has('message.added'))

            <div class="alert alert-success fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                {!! session('message.content') !!}
            </div>
            @endif
            @if(session()->has('message.updated'))
            <div class="alert alert-success fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                {!! session('message.content') !!}
            </div>
            @endif
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE BAR -->
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="content-header">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-9">

                                    <h1 style="margin-top:0 ">
                                        Manage News & Notice
                                    </h1>
                                </div>
                                <div class="col-md-2 col-md-offset-1">
                                    <a href="{{route('create.news.notice')}}" class="btn btn-success" >Add
                                        new</a>
                                </div>
                            </div>


                            <ul class="breadcrumb">
                                <li class="active"><a href="{{route('list.news.notice')}}"><i
                                            class="fa fa-dashboard"></i> Manage
                                        News & Notice</a></li>
                                <li><a href="{{ route('list.news.notice.category') }}"><i class="fa fa-file-text-o"></i>
                                        Manage
                                        Categories</a></li>

                            </ul>

                        </div>


                    </section>


                    <section class="content">

                        <div class="panel-body">
                            <table class="table" id="newsAndNoticeTable">
                                <thead>
                                    <tr>

                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Last updated</th>
                                        <th>Actions</th>
                                    </tr>
                                    {{ csrf_field() }}
                                </thead>
                                <tbody>
                                    @foreach($newsAndNotices as $blog)
                                    <tr class="item{{$blog->id}}">

                                        <td>
                                            {!!\Illuminate\Support\Str::words($blog->title, 5,'..') !!}
                                        </td>
                                        <td>
                                            {!!\Illuminate\Support\Str::words($blog->content, 5,'..') !!}
                                        </td>

                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $blog->updated_at)->diffForHumans() }}
                                        </td>
                                        <td>
                                            <a id="popup" class="edit-modal btn btn-success"
                                                href="{{route('edit.news.notice',$blog->id)}}"><span
                                                    class="fa fa-pencil"></span>
                                                Edit</a>
                                            <button id="popup" class="delete-modal btn btn-danger"
                                                onClick="delete_news_notice({{$blog->id}});"><span class="fa fa-trash"></span>
                                                Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- /.panel-body -->
                    </section>
                </div>
            </div><!-- /.panel panel-default -->
            <!-- /.col-md-8 -->

            @endsection



            @push('scripts')
                    <script src="{{ asset('modules/news_notice/js/news_notice.js') }}"></script>


            <script>

            $('#newsAndNoticeTable').dataTable();
            </script>

            @endpush--}}
