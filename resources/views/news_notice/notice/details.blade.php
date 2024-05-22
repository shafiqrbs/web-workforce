@extends('layouts.app')
@section('content')


    @if($news->image)
        <section class="page-title blog-page style-two" style="background-image: url({{asset('/news_notice/'.$news->image)}});">
            @else
                <section class="page-title blog-page style-two" style="background-image: url({{asset('assets/news-default.png')}});">
                    @endif

{{--    <section class="page-title blog-page style-two" style="background-image: url({{asset('uploads/news_notice/'.$news->image)}});">--}}
        <div class="auto-container">
            <div class="content-box">
                <div class="title centred">
                    <span class="category"><i class="flaticon-star"></i>{{$news->post_type}}</span><br>
                    <h1>{{$news->title}}</h1>
                </div>
            </div>
        </div>
        <div class="lower-box">
            <div class="auto-container">
                <div class="post-content">
                    <div class="left-column">
                        <div class="post-date"><h3>{{$news->created_at->format('d')}}<span>{{$news->created_at->format("M'Y")}}</span></h3></div>
                        <ul class="post-info clearfix">
                            <li><i class="far fa-user"></i><a href="#">{{$news->createdBy->name}}</a></li>
                            @if(isset($news->onBehalfBy))
                            <li><i class="far fa-user"></i><a href="#">{{$news->onBehalfBy->name}}</a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="right-column">
                        <div class="share-box"><a href="#">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $news->updated_at)->diffForHumans()}}<i class="flaticon-clock-circular-outline"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->


    <!-- sidebar-page-container -->
    <section class="sidebar-page-container sec-pad-2">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="blog-details-content">
                        <div class="inner-box ">
                            <figure class="news-image-custom image-box ">
                                <img class="" src="{{asset('/news_notice/mid/'.$news->image)}}" alt="">
                            </figure>
                            <div class="text" style="text-align: justify">
                                <p><?php echo $news->content;?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="blog-sidebar">
                        @if(isset($popularNotices))
                            <div class="sidebar-widget post-widget">
                                <div class="widget-title">
                                    <h3>Popular Notice</h3>
                                </div>
                                <div class="widget-content">
                                    @foreach($popularNotices as $notice)
                                        <div class="post">
                                            <figure class="post-thumb"><a href="{{route('notice.details',$notice->id)}}">
                                                    @if($notice->image)
                                                        <img src="{{asset('/news_notice/mid/'.$notice->image)}}" alt="{{$notice->title}}" style="height: 70px">
                                                    @else
                                                        <img src="{{asset('assets/news-default.png')}}" alt="News" style="height: 70px">
                                                    @endif

                                                </a></figure>
                                            <h6><a href="{{route('notice.details',$notice->id)}}">{{$notice->title}}</a></h6>
                                            <p><i class="far fa-calendar"></i>{{$notice->created_at->format('d')}}&nbsp;{{$notice->created_at->format("M-Y")}}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if(isset($popularNews))
                            <div class="sidebar-widget post-widget">
                                <div class="widget-title">
                                    <h3>Popular News</h3>
                                </div>
                                <div class="widget-content">
                                    @foreach($popularNews as $popular)
                                        <div class="post">


                                            <figure class="post-thumb"><a href="{{route('news.details',$popular->id)}}">
                                                    @if($popular->image)
                                                    <img src="{{asset('/news_notice/mid/'.$popular->image)}}" alt="{{$popular->title}}" style="height: 70px">
                                                    @else
                                                        <img src="{{asset('assets/news-default.png')}}" alt="News" style="height: 70px">
                                                    @endif
                                                </a></figure>
                                            <h6><a href="{{route('news.details',$popular->id)}}">{{$popular->title}}</a></h6>
                                            <p><i class="far fa-calendar"></i>{{$popular->created_at->format('d')}}&nbsp;{{$popular->created_at->format("M-Y")}}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if($archives)
                            <div class="sidebar-widget tags-widget">
                                <div class="widget-title">
                                    <h3>Archives</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="tags-list clearfix">
                                        @foreach($archives as $archive)
                                            <li><a href="{{route('archive_download_user',$archive->id)}}"><i class="fas fa-cloud-download"></i> &nbsp;{{$archive->archive_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sidebar-page-container end -->


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
