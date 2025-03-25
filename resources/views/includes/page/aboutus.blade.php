<section class="about-section sec-pad bg-color-1">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                <div class="content_block_1">
                    <div class="content-box">
                        <div class="sec-title">
                            <h6><i class="flaticon-star"></i><span>Welcome to GAIN BANGLADESH</span></h6>
                            <h2>{{$aboutContent->page_title}}</h2>
                            <div class="title-shape"></div>
                        </div>
                        <div class="text">  <?php echo $aboutContent->page_content ; ?>  </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                <div class="image_block_1">
                    <div class="image-box">
                        <figure class="image"><img style="width: 510px; height: 605px" src="{{asset('page_image/'.$aboutContent->image)}}" alt=""></figure>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- explore-section -->
<section class="explore-section centred bg-color-2">
    <figure class="vector-image"><img src="{{asset('assets/images/icons/vector-1.png')}}" alt=""></figure>
    <div class="pattern-layer" style="background-image: url({{asset('assets/images/icons/vector-1.png')}});"></div>
    <div class="auto-container">
        <div class="sec-title centred light">
            <h2>Goals to Achieve</h2>
            <div class="title-shape"></div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-4 col-md-6 col-sm-12 explore-block">
                <div class="explore-block-one wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <figure class="image-box"><img src="{{asset('assets/images/gain/images-mission.jpeg')}}" alt=""></figure>
                        <div class="content-box">
                            <div class="text">
                                <div class="icon-box"><i class="flaticon-scroll"></i></div>
                                <h4>Mission</h4>
                            </div>
                            <div class="overlay-content">
                                <h4>Mission</h4>
                                <p>Improve workforce nutrition in Bangladesh.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 explore-block">
                <div class="explore-block-one wow fadeInUp animated animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <figure class="image-box"><img src="{{asset('assets/images/gain/images-vision.jpeg')}}" alt=""></figure>
                        <div class="content-box">
                            <div class="text">
                                <div class="icon-box"><i class="flaticon-goverment"></i></div>
                                <h4>Vision</h4>
                            </div>
                            <div class="overlay-content">
                                <h4></h4>
                                <p>A healthier, more productive workforce.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 explore-block">
                <div class="explore-block-one wow fadeInUp animated animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <figure class="image-box"><img src="{{asset('assets/images/gain/images-values.jpeg')}}" alt=""></figure>
                        <div class="content-box">
                            <div class="text">
                                <div class="icon-box"><i class="flaticon-budget"></i></div>
                                <h4>Core Values</h4>
                            </div>
                            <div class="overlay-content">
                                <h4>Core Values</h4>
                                <p>Sustainability, Accessibility, Collaboration, Innovation, Impact.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- explore-section end -->
