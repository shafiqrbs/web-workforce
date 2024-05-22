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
                <li> <a href="{{ route('list_event_type') }}">Event Type</a> <i class="fa fa-circle"></i> </li>
                <li> <span>Update</span> </li>
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
                        <div class="caption font-red-sunglo"> <i class="icon-settings font-red-sunglo"></i> <span class="caption-subject bold uppercase">Event Type Form</span> </div>
                        <div class="actions">
                            <a href="{{ route('create_event_type') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Event Type</a>
                        </div>
                    </div>
                    <div class="portlet-body form">          
                        <ul class="nav nav-tabs">              
                            <li class="active"> <a href="#Details" data-toggle="tab" aria-expanded="false"> Event Type </a> </li>
                        </ul>
                        {!! Form::model($eventType, array('method' => 'put', 'route' => array('update_event_type', $eventType->id), 'class' => 'form', 'files'=>true)) !!}
                        {!! Form::hidden('id', $eventType->id) !!}
                        <div class="tab-content">              
                            <div class="tab-pane fade active in" id="Details"> @include('admin.event_type.forms.form') </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY --> 
    </div>
    @endsection