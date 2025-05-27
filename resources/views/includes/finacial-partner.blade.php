<section class="explore-style-two departments-page sec-pad centred">
    <div class="auto-container">
        <div class="sec-title centred">
            <h2>Our Partner and Stakeholder</h2>
            <div class="title-shape"></div>
        </div>
        <div class="row clearfix">
            @if($financialPartner)
                @foreach($financialPartner as $partner)
                    @if($img = $partner['profile_image'])
                    <div class="col-lg-3 col-md-6 col-sm-12 explore-block">
                        <div class="explore-block-two">
                            <div class="inner-box">
                                <figure class="image-box"> {{ ImgUploader::print_image("financial_partner/mid/$img") }}</figure>
                                <div class="content-box">
                                    <h4>{{$partner['name']}}</h4>
                                </div>
                                <div class="overlay-content">
                                    <p>{{$partner['address']}}</p>
                                    <div class="text">
                                        <h4>{{$partner['name']}}</h4>
                                        <a target="_blank" href="{{$partner['facebook_link']}}" >Read More</a>
                                    </div>
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

