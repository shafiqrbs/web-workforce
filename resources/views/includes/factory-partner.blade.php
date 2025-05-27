<section class="award-section bg-color-1">
    <div class="auto-container">
        <div class="sec-title">
            <h2>Our Factory Partners</h2>
            <div class="title-shape"></div>
        </div>
        <div class="row clearfix">
            @if($factories)
                @foreach($factories as $partner)
                    @if($img = $partner['profile_image'])
                        <div class="col-xl-3 col-lg-4 col-md-6 award-block">
                            <div class="award-block-one">
                                <div class="inner-box">
                                    <figure class="image-box">
                                        @if($img = $partner['profile_image'])

                                            {{ ImgUploader::print_image("financial_partner/mid/$img") }}
                                        @else
                                            <img src="{{asset('assets/no-image.jpeg')}}" alt="">
                                        @endif
                                    </figure>
                                    <h4>{{$partner['name']}}</h4>
                                    <div class="overlay-content">
                                        <h4>{{$partner['name']}}</h4>
                                        <p>{{$partner['short_message']}}</p>
                                        <a href="">Read More<i class="flaticon-right-arrow"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</section>
