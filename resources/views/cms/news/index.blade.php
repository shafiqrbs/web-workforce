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
                                <li>{{$pageTitle}}</li>
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
    <!-- news-section -->
    <section class="news-section blog-grid sec-pad-2">
        <div class="auto-container">
            <div class="row clearfix">
                @if($news)
                    @foreach($news as $notice)
                        <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                            <div class="news-block-one">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image">
                                            <a href="{{route('news.details',$notice->id)}}"><i class="fas fa-link"></i></a>
                                            @if($notice->image)
                                                <img src="{{asset('/news_notice/mid')}}/{{$notice->image}}" alt="">
                                            @endif
                                        </figure>
                                        <div class="post-date"><h3>{{$notice->created_at->format('d')}}<span>{{$notice->created_at->format("M'Y")}}</span></h3></div>
                                    </div>
                                    <div class="lower-content">
                                        <div class="category"><a href="{{route('news.list')}}"><i class="flaticon-star"></i>{{$notice->post_type}}</a></div>
                                        <h4><a href="{{route('news.details',$notice->id)}}">{!!\Illuminate\Support\Str::words($notice->title, 10,'..') !!}</a></h4>
                                        <ul class="post-info clearfix">
                                            <li><i class="far fa-user"></i><a href="{{url('/')}}" >{{$notice->createdBy->name}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif
            </div>
            <div class="pagination-wrapper centred">
                {{ $news->links('includes.pagination-view') }}
            </div>
        </div>
    </section>
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
    </style>
@endpush
