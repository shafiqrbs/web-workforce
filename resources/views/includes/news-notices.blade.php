<section class="news-style-two  pb-100 sec-pad-news">
{{--    <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-12.png);"></div>--}}
    <div class="auto-container">
        <div class="sec-title centred">
            <h6><i class="flaticon-star"></i><span>News & Notices</span><i class="flaticon-star"></i></h6>
            <h2>Latest From Our Newsroom</h2>
            <div class="title-shape"></div>
        </div>
        <div class="row clearfix">
            @if(isset($newsAndNotices) && count($newsAndNotices)>0)
                @foreach($newsAndNotices as $newsnotice)
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-two wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                @if($newsnotice->image && !empty($newsnotice->image))
                                    <figure class="image-box news-image"><img src="{{asset('/news_notice/mid')}}/{{$newsnotice->image}}" alt="News Image"></figure>
                                @else
                                    <figure class="image-box news-image"><img src="{{asset('assets/news-default.png')}}"></figure>
                                @endif

                                <div class="content-box">
                                    <div class="category"><a href="blog-details.html"><i class="flaticon-star"></i>{{$newsnotice->post_type}}</a></div>
                                    <div class="text">
                                        <div class="post-date" style="position: fixed;
    top: 0px;">
                                            <h3>
                                                {{$newsnotice->created_at->format('d')}}
                                                <span>{{$newsnotice->created_at->format("M'Y")}}</span>
                                            </h3>
                                        </div>
                                        <h4>
                                            <a href="{{route('news.details',$newsnotice->id)}}" >
{{--                                                {!!\Illuminate\Support\Str::words($newsnotice->title, 50,'..') !!}--}}
                                                {{mb_strimwidth($newsnotice->title, 0, 37, '...')}}
                                            </a>
                                        </h4>
                                        <ul class="post-info clearfix">
                                            <li><i class="far fa-user"></i><a href="{{url('/')}}" >{{$newsnotice->createdBy->name}}</a></li>
                                            {{--                                        <li><i class="far fa-comment"></i><a href="blog-details.html">2 Comments</a></li>--}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
