
<!-- feature-section -->
<section class="feature-section sec-pad" style="background-image: url(assets/images/background/feature-bg.jpg);">
    <div class="auto-container">
        <div class="sec-title centred">
            <h6><i class="flaticon-star"></i><span>Council Information</span><i class="flaticon-star"></i></h6>
            <h2>More About Our Government</h2>
            <div class="title-shape"></div>
        </div>
        <div class="row clearfix">
            @if(sizeof($programs)>0)
                @foreach($programs as $program)
                    <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                <div class="feature-block-two wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <figure class="image-box">
                            @if($img = $program['feature_image'])
                                {{ ImgUploader::print_image("archive/mid/$img") }}
                            @else
                                <img src="{{asset('assets/no-image.jpeg')}}" alt="">
                            @endif
                        </figure>
                        <div class="lower-content">
                            <div class="icon-box"><i class="flaticon-group"></i></div>
                            <div class="light-icon"><i class="flaticon-group"></i></div>
                            @php
                                $maxLength = 20;
                                $cropped = strlen($program->archive_name_en) > $maxLength ? substr($program->archive_name_en, 0, $maxLength) . '...' : $program->archive_name_en;
                                    @endphp
                            <h4><a href="">{{$cropped}}</a></h4>
                            <div class="btn-box"><a href="">Read More<i class="flaticon-right-arrow"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- feature-section end -->