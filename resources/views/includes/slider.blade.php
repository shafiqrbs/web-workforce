<section class="banner-section style-two centred">
    <div class="banner-carousel owl-theme owl-carousel owl-dots-none">
        @if($sliders)
            @foreach($sliders as $slider)
                <div class="slide-item">
                    <div class="image-layer" style="background-image:url({{asset('slider_images/'.$slider->slider_image)}})"></div>
                    <div class="auto-container">
                        <div class="content-box">
                            <h1>{{$slider->slider_heading}}</h1>
                            <p>{{$slider->slider_description}}</p>
                            @if(isset($slider->slider_link_text))
                                <div class="btn-box">
                                    <a href="{{$slider->slider_link}}"  class="theme-btn">{{$slider->slider_link_text}}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</section>

<!-- activities-section -->
<section class="activities-section centred bg-color-1">
    <div class="auto-container">
        <div class="inner-container">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                    <div class="single-item">
                        <div class="icon-box"><i class="flaticon-global-warming"></i></div>
                        <h4>Sustainability</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                    <div class="single-item">
                        <div class="icon-box"><i class="flaticon-diagram"></i></div>
                        <h4>Accessibility</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                    <div class="single-item">
                        <div class="icon-box"><i class="flaticon-teamwork"></i></div>
                        <h4>Innovation</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                    <div class="single-item">
                        <div class="icon-box"><i class="flaticon-analytics"></i></div>
                        <h4>Impact</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- activities-section end -->


