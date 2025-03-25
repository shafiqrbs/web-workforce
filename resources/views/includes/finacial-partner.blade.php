<section class="team-section alternat-2 sec-pad pb-140 team-section-padding" style="margin-bottom: 50px">
{{--    <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-10.png);"></div>--}}
    <div class="auto-container">
        <div class="sec-title centred">
            <h2>Our partner and Stakeholder</h2>
            <div class="title-shape"></div>
        </div>
        <div class="four-item-carousel owl-carousel owl-theme owl-nav-none owl-dots-none">

            @if($financialPartner)
                @foreach($financialPartner as $partner)
                    <div class="team-block-one">
                        <div class="inner-box finalcial-partner-image">
                            <a href="{{$partner['facebook_link']}}" >
                                @if($img = $partner['profile_image'])
{{--                                    <figure class="image-box">--}}
                                        {{ ImgUploader::print_image("financial_partner/mid/$img") }}
{{--                                    </figure>--}}
                                @endif
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
