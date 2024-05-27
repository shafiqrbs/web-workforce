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
