
@if(count($formerAthletesData)>0)
<section class="explore-style-two sec-pad-athlete pb-140 centred">
    <div class="pattern-layer">
{{--        <div class="pattern-1" style="background-image: url(assets/images/shape/shape-8.png);"></div>--}}
    </div>
    <div class="auto-container">
        <div class="sec-title centred">
            <h6><i class="flaticon-star"></i><span>Former Athletes</span><i class="flaticon-star"></i></h6>
            <h2>Meet Our Athletes</h2>
            <div class="title-shape"></div>
        </div>
        <div class="four-item-carousel owl-carousel  owl-nav-none">
            @foreach($formerAthletesData as $athlete)
                <div class="explore-block-two">
                    <div class="inner-box">
                        <figure class="image-box">
                            @if($img=$athlete['profile_image'])
                                {{ ImgUploader::print_image("athlete_profile/$img") }}
                            @else
                                <img src="{{asset('assets/no-image.jpeg')}}" alt="">
                            @endif
                        </figure>
                        <div class="content-box">
                            <h4 style="left: 15px !important;">{{$athlete->athlete_name}} <br>{{$athlete->athlete_type}}</h4>
                        </div>
                        <a href="{{route('athlete_details',$athlete['id'])}}" >
                        <div class="overlay-content">
                            <div class="icon-box">{{ ImgUploader::print_image("athlete_profile/$img") }}</div>
                            <div class="text">
                                <h4>{{$athlete->athlete_name}} <br>{{$athlete->athlete_type}}</h4>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif