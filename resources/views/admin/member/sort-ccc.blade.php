@extends('admin.layouts.admin_layout')
@section('content')
<div class="page-content-wrapper"> 
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content"> 
        <!-- BEGIN PAGE HEADER--> 
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>
                <li> <a href="">Camp Commandant & Coach</a> <i class="fa fa-circle"></i> </li>
                <li> <span>Sort</span> </li>
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
                        <div class="caption font-red-sunglo"> <i class="icon-settings font-red-sunglo"></i> <span class="caption-subject bold uppercase">Sort Camp Commandant & Coach</span> </div>
                    </div>
                    <div class="portlet-body form">          
                        <ul class="nav nav-tabs">              
                            <li class="active"> <a href="#Details" data-toggle="tab" aria-expanded="false"> Sort Camp Commandant & Coach </a> </li>
                        </ul>
                        <div class="tab-content">              
                            <div class="tab-pane fade active in" id="Details">
                                {!! APFrmErrHelp::showErrorsNotice($errors) !!}
                                @include('flash::message')
                                <div class="form-body">
                                    <h3>Drag and Drop to Sort the Members</h3>
                                    <div id="executive_member_sort_data_div">
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
                url: "{{ route('sort_ccc_members') }}",
                success: function (responseData) {
                    $("#executive_member_sort_data_div").html('');
                    $("#executive_member_sort_data_div").html(responseData);
                    /**************************/
                    $('#sortable').sortable({
                        update: function (event, ui) {
                            var faqOrder = $(this).sortable('toArray').toString();
                            $.post("{{ route('ec_member_sort_update') }}", {faqOrder: faqOrder, _method: 'PUT', _token: '{{ csrf_token() }}'})
                        }
                    });
                    $("#sortable").disableSelection();
                }
            });
        }
    </script>
@endpush