@extends('layouts.app')
@section('content')


    @if(isset($bannerData) && !empty($bannerData))
        <section class="page-title" style="background-image: url({{asset('banner/'.$bannerData->banner_image)}});">
            @else
                <section class="page-title" style="background-image: url({{asset('banner/no-image.jpg')}});">
                    @endif
                    <div class="auto-container">
                        <div class="content-box">
                            <div class="title centred">
                                @if(isset($bannerData) && !empty($bannerData))
                                    <h1>{{$bannerData->banner_title}}</h1>
                                @else
                                    <h1>No Banner title</h1>
                                @endif
                            </div>
                            <ul class="bread-crumb clearfix">
                                <li><a href="{{url('/')}}">Home</a></li>
                                <li>
                                    @if(isset($pathPageTitle) && !empty($pathPageTitle))
                                        <a href=" {{route('archive_index')}}">
                                            @endif

                                            {{$pageTitle}}
                                            @if(isset($pathPageTitle) && !empty($pathPageTitle))
                                        </a>
                                    @endif
                                </li>
                                @if(isset($pathPageTitle) && !empty($pathPageTitle))
                                    <li>{{$pathPageTitle}}</li>
                                @endif
                                @if(isset($subPathPageTitle) && !empty($subPathPageTitle))
                                    <li>{{$subPathPageTitle}}</li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </section>


    <!-- events-grid -->
    <section class="events-grid sec-pad-2">
        <div class="auto-container">
            <h2 style="font-size: 15px;border-bottom: 1px solid;padding-bottom: 5px;font-weight: bold;">{{$galleries->total()}} Results & Records in Gallery </h2>
            <div class="row clearfix margin-top-10">
                @if(count($galleries)>0)
                    @foreach($galleries as $gallery)
                    <div class="col-lg-4 col-md-6 col-sm-12 schedule-block">
                        <div class="schedule-block-one">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image">
                                        @if($img=$gallery->cover_image)
                                            {{ ImgUploader::print_image("photo_gallery/mid/$img") }}
                                        @else
                                            <img src="{{asset('assets/no-image.jpeg')}}" alt="">
                                        @endif
                                    </figure>
                                    <div class="content-box">
                                        <div class="post-date"><h3>{{date('d',strtotime($gallery->created_at))}}<span>{{date('M',strtotime($gallery->created_at))}}’{{date('y',strtotime($gallery->created_at))}}</span></h3></div>
                                        <div class="text">
                                            <span class="category"><i class="flaticon-star"></i>{{date('H:m:s A',strtotime($gallery->created_at))}}</span><br>
                                            @php
                                                $name = strip_tags($gallery->name);
                                                if (strlen($name) > 25) {
                                                    $stringCut = substr($name, 0, 25);
                                                    $endPoint = strrpos($stringCut, ' ');
                                                    $name = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                    $name .= '...';
                                                }
                                            @endphp
                                            <h4><a href="{{route('gallery_details',$gallery->id)}}">{{$name}}</a></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="lower-content">
                                    <ul class="post-info clearfix">
                                        @php
                                            $description = strip_tags($gallery->description);
                                            if (strlen($description) > 70) {
                                                $stringCut = substr($description, 0, 70);
                                                $endPoint = strrpos($stringCut, ' ');
                                                $description = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                $description .= '...';
                                            }
                                        @endphp
                                        <li><i class="flaticon-gps"></i>{{$description}}</li>
                                    </ul>
                                    <div class="links"><a href="{{route('gallery_details',$gallery->id)}}">Read More<i class="flaticon-right-arrow"></i></a></div>
{{--                                    <div class="share-box"><a href="index.html">Share<i class="fas fa-share-alt"></i></a></div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
            {{--<div class="pagination-wrapper centred">
                <ul class="pagination clearfix">
                    {{ $galleries->links('includes.pagination-view') }}
                </ul>
            </div>--}}
            <div class="pagination-wrapper centred">
                {{ $galleries->links('includes.pagination-view') }}
            </div>
        </div>
    </section>
    <!-- events-grid end -->

    <!-- news-section -->
    {{--<section class="news-section blog-grid sec-pad-2">
        <div class="auto-container">
            <div class="row clearfix">
                @if($galleries)
                    @foreach($galleries as $gallery)
                        <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                            <div class="news-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image">
                                            <a href="blog-details.html"><i class="fas fa-link"></i></a>
                                            @if($gallery->cover_image)
                                                <img src="{{asset('photo_gallery/thumb')}}/{{$gallery->cover_image}}" alt="">
                                            @endif
                                        </figure>
                                    </div>
                                    <div class="lower-content">
                                        <h4><a href="">{!!\Illuminate\Support\Str::words($gallery->name, 10,'..') !!}</a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="pagination-wrapper centred">
                <ul class="pagination clearfix">
                    <li><a href="blog.html"><i class="far fa-angle-double-left"></i></a></li>
                    <li><a href="blog.html" class="current">1</a></li>
                    <li><a href="blog.html">2</a></li>
                    <li><a href="blog.html"><i class="far fa-angle-double-right"></i></a></li>
                </ul>
            </div>
        </div>
    </section>--}}
    <!-- news-section end -->

@endsection

@push('styles')
                    <style>
                        .pager{
                            padding: 0px;
                        }

                        .pager li{
                            display: inline;
                        }
                        .pagination_custom_style{
                            border: 1px solid;
                            padding: 5px 10px;
                            font-size: 15px;
                            font-weight: bold;
                            background: #e41e2f;
                            color: #fff;
                        }
                        .active{
                            background: #fff;
                            color: #e41e2f;
                        }

                        .schedule-block-three .inner-box:hover h3{
                            color: #fff;
                        }
                    </style>
@endpush
