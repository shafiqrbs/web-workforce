@extends('admin.layouts.admin_layout')

@push('css')

<link rel="stylesheet" href="{{ asset('modules/news_notice/css/news_notice.css') }}">



@endpush

@section('content')

<style type="text/css">

.table td,

.table th {

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

                <li> <a href="{{route('list.news.notice')}}">Posts</a> <i class="fa fa-circle"></i> </li>

                <li> <span>Update</span> </li>

            </ul>

        </div>

        <!-- END PAGE BAR -->

        <!-- BEGIN PAGE TITLE-->

        <h3 class="page-title">Update Post </h3>

        <!-- END PAGE TITLE-->

        <!-- END PAGE HEADER-->

        <div class="row">

            <div class="col-lg-12">

                <div class="card m-b-30">

                    <div class="card-body">

                        <div class="">



                            @if(session()->has('message.added'))

                            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center"

                                role="alert">

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                    <span aria-hidden="true">×</span>

                                </button>

                                <i class="mdi mdi-checkbox-marked-circle font-32"></i><strong class="pr-1">Success!</strong>

                                {!! session('message.content') !!}.

                            </div>

                            @endif


                            <div class="tab-content">

                                <div class="tab-pane active show" id="settings">

                                    <div class="row">

                                        <div class="col-lg-12">

                                            <div class="">



                                                <form method="POST" files="true" action="{{route('update.news.notice', $newsAndNotice->id)}}" enctype="multipart/form-data">

                                                    {{csrf_field()}}

                                                    <input type="hidden" value="{{ $newsAndNotice-> id }}" name="id" id="id">



                                                    <div class="row">

                                                        <div class="col-lg-9">


                                                            <div class="form-group {{ $errors->has('title_update') ? 'has-error' : '' }}">

                                                                <label class="control-label" for="title">Title</label>



                                                                <input type="text" class="form-control" name="title_update" id="title_update" autofocus value="{{ $newsAndNotice->title?$newsAndNotice->title:'' }}" autocomplete="off">

                                                                <span class="text-danger">{{ $errors->first('title_update') }}</span>
                                                            </div>

                                                            <div class="form-group {{ $errors->has('content_update') ? 'has-error' : '' }}">

                                                                <label class="control-label" for="content">Content</label>
                                                                <textarea class="form-control" name="content_update" id="description" cols="40" rows="5" autofocus>{{ $newsAndNotice->content }}</textarea>

                                                                <span class="text-danger">{{ $errors->first('content_update') }}</span>

                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label" for="post_type">Post Type</label>
                                                                <select class="form-control" name="post_type" id="post_type">
                                                                    <option value="NEWS" {{ $newsAndNotice->post_type=='NEWS'?'selected="selected"':''}}>News</option>
                                                                    <option value="NOTICE" {{ $newsAndNotice->post_type=='NOTICE'?'selected="selected"':''}}>Notice</option>
                                                                </select>

                                                            </div>

                                                            <div class="form-group">
                                                                <input type="checkbox" name="is_sticky" id="is_sticky" value="1" {{$newsAndNotice->is_sticky==1?'checked="checked"':''}}> Is Sticky News For Front Page
                                                            </div>

                                                            <div class="clearfix"></div>
                                                        </div>

                                                        <div class="col-lg-3">

                                                            <div class="blogboxint">

                                                                <input type="submit" value="Publish" class="btn btn-primary">

                                                            </div>

                                                            <div class="blogboxint">


                                                                @if($categories!='')

                                                                <div class="form-group">

                                                                    <label class="control-label" for="title">Select Category</label>
                                                                    <ul class="optionlist" style="list-style: none; padding: 0;">

                                                                        @php
                                                                            $addedCategories = $newsAndNotice->categories()->pluck('news_and_notice_categories.id as catId')->toArray();
                                                                        @endphp
{{--                                                                        {{dd($addedCategories)}}--}}
                                                                        @foreach($categories as $cate)
                                                                        <li>
                                                                            <input type="checkbox" name="cate_id_update[]" id="cate_id_update_{{$cate->id}}" value="{{$cate->id}}" {{in_array($cate->id, $addedCategories)?'checked="checked"':''}}>

                                                                            <label for="cate_id_update_{{$cate->id}}">{!!$cate->title!!}</label>


                                                                        </li>



                                                                        @endforeach





                                                                    </ul>



                                                                </div>

                                                                @endif

                                                            </div>


                                                            <div class="form-group">
                                                                <label class="control-label" for="post_type">On Behalf of</label>
                                                                {!! Form::select('member_id', ['' => 'Choose Executive Committee']+$executiveCommittee,$newsAndNotice->member_id, array('class'=>'form-control', 'id'=>'member_id')) !!}
                                                            </div>



                                                            <div class="blogboxint">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="Upload Image">Featured Image</label> <span style="font-size: 10px">( Greater than or equal to width 1920px & height 730px. )</span>
                                                                    <input type="file" class="form-control" name="imageupdate" id="imageupdate" autofocus>
                                                                    <span class="text-danger">{{ $errors->first('imageupdate') }}</span>

                                                                    <div class="image_append" id="image_append">

                                                                        @if($newsAndNotice->image!='')

                                                                        <div class='featured-images-main' id='listing_img_{{$newsAndNotice->id}}'><img  src="{{asset('/news_notice/thumb')}}/{{$newsAndNotice->image}}"><i onClick='remove_featured_image("{{$newsAndNotice->id}}");' class='fa fa-times'></i></div>

                                                                        @endif

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>











                                                </form>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>



            </div>

        </div>



        <style type="text/css">

        .float-right .custom-control-label {

            color: #fff !important;

        }

        </style>

        @endsection

        @push('scripts')
        @include('admin.shared.tinyMCEFront') 
        <script src="{{ asset('modules/news_notice/js/news_notice.js') }}"></script>

        <style type="text/css">

        #fea_img {

            border: 2px dashed #ddd;

            /* background: #2a2f3e; */

            padding: 50px 30px;

            text-align: center;

        }



        .jFiler-input {

            max-width: 401px;

            margin: 0 auto 15px auto !important;

        }



        .jFiler-items-grid .jFiler-item .jFiler-item-container {

            margin: 0 14px 30px 0;

        }



        .cropper-bg {

            background-image: none !important;

            height: 100% !important;

        }



        .img-crop {

            display: block;

            width: 100%;

            height: 100%;
        }



            canvas {

                margin: 0 !important;

            }


        </style>

        @endpush