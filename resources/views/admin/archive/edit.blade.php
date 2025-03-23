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
                <li> <a href="{{ route('list.archives') }}">{{__('messages.Posts')}}</a> <i class="fa fa-circle"></i> </li>
                <li> <span>{{__('messages.Update')}}</span> </li>
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
                        <div class="caption font-red-sunglo"> <i class="icon-settings font-red-sunglo"></i> <span class="caption-subject bold uppercase">{{__('messages.post_Form')}}</span> </div>
                        <div class="actions">
                            <a href="{{ route('create.archive') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> {{__('messages.add_new_Posts')}}</a>
                        </div>
                    </div>
                    <div class="portlet-body form">          
                        <ul class="nav nav-tabs">              
                            <li class="active"> <a href="#Details" data-toggle="tab" aria-expanded="false"> {{__('messages.Posts')}} </a> </li>
                        </ul>
                        {!! Form::model($archive, array('method' => 'put', 'route' => array('update.archive', $archive->id), 'class' => 'form', 'files'=>true)) !!}
                        {!! Form::hidden('id', $archive->id) !!}
                        <div class="tab-content">              
                            <div class="tab-pane fade active in" id="Details"> @include('admin.archive.forms.form') </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY --> 
    </div>
    @endsection