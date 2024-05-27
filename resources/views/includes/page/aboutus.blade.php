
<!-- service-style-two -->
<section class="service-style-two bg-color-3">
    <div class="outer-container">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="row clearfix">
                    @if($abouts)
                        @foreach($abouts as $slider)
                            <div class="col-lg-4 col-md-4 col-sm-12 info-column">
                        <div class="info-block-one">
                            <div class="inner-box">
                                <div class="content-box">
                                    <div class="image-box">
                                        <figure class="image">
                                            <img height="200" width="100%" src="{{asset('news_notice/'.$slider->image)}}" alt="">
                                        </figure>
                                        <h4>{{ $slider->title }}</h4>
                                        <p><?php echo $slider->content ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- service-style-two end -->
