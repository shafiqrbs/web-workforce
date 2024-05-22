@extends('admin.layouts.admin_layout')
@section('content')
<div class="page-content-wrapper"> 
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content"> 
        <!-- BEGIN PAGE HEADER--> 
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li> <a href="{{ route('admin.home') }}">{{__('messages.Home')}}</a> <i class="fa fa-circle"></i> </li>
                <li> <a href="{{ route('list.executive.committee.members') }}">{{__('messages.Judges_Jury')}}</a> <i class="fa fa-circle"></i> </li>
                <li> <span>{{__('messages.Sort')}}</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR --> 
        <!-- BEGIN PAGE TITLE-->
        <!--<h3 class="page-title">Edit User <small>Users</small> </h3>-->
        <!-- END PAGE TITLE--> 
        <!-- END PAGE HEADER-->
        <br />
        @include('flash::message')
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo"> <i class="icon-settings font-red-sunglo"></i> <span class="caption-subject bold uppercase">{{__('messages.Judges_Jury_sort')}}</span> </div>
                    </div>
                    <div class="portlet-body form">          
                        <ul class="nav nav-tabs">              
                            <li class="active"> <a href="#Details" data-toggle="tab" aria-expanded="false"> {{__('messages.Judges_Jury_sort')}} </a> </li>
                        </ul>
                        <div class="tab-content">              
                            <div class="tab-pane fade active in" id="Details">
                                {!! APFrmErrHelp::showErrorsNotice($errors) !!}
                                @include('flash::message')
                                <div class="form-body">
                                    <h3>{{__('messages.Drag_and_Drop_to_Sort')}}</h3>
                                    <div id="judges_jury_sort_data_div">
                                    </div>
                                </div>
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
        $(document).ready(function () {
            refresh_club_sort_data();
        });
        function refresh_club_sort_data() {
            $.ajax({
                type: "GET",
                url: "{{ route('sort_jury') }}",
                success: function (responseData) {
                    $("#judges_jury_sort_data_div").html('');
                    $("#judges_jury_sort_data_div").html(responseData);
                    /**************************/
                    $('#sortable').sortable({
                        update: function (event, ui) {
                            var juryOrder = $(this).sortable('toArray').toString();
                            $.post("{{ route('jury_sort_update') }}", {juryOrder: juryOrder, _method: 'PUT', _token: '{{ csrf_token() }}'})
                        }
                    });
                    $("#sortable").disableSelection();
                }
            });
        }
    </script>
@endpush