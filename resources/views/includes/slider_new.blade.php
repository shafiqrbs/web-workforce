<section id="banner">
    <div class="home-banner" style="background-image: url('assets/images/tia.png');">
        <div class="home-banner-contents" style="background-image: url('assets/images/overlay2.png');">
            <!-- <h1><strong class="text-green">Hospitality,</strong> <strong class="text-red">Travel & Tourism </strong> <strong class="text-black">Recruitment</strong></h1> -->
            <div class="banner-top-image">
                <img src="{{asset('/')}}assets/images/text3.png" alt="">
            </div>
            <div class="banner-contents-inner">
                <div class="banner-content-image">
                    <img src="{{asset('/')}}assets/images/hero_new.png" alt="">
                </div>
                <div class="banner-contents">
                    <div class="blue-round">
                        <h2>Get Ready to <strong>Re - Open !</strong></h2>
                    </div>
                    <div class="banner-contents-bottom">
                        <h2>So simple ! so unique ! saves Time !</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="banner-bottom">
    <div class="banner-bottom-bg" style="background-image: url('design/assets/images/overlay.png');">
        <div class="banner-bottom-contents">
            <div class="banner-job">
                <div class="jobseekers-title">
                    <a href="{{route('register')}}">
                        <img src="{{asset('/')}}assets/images/jobseekers_new.png" alt="">
                    </a>
                </div>
                <div class="jobseeker-image">
                    <img src="{{asset('/')}}assets/images/office.png" alt="">
                </div>
            </div>
            <div class="banner-employers">
                <div class="jobseekers-title">
                    @if(!Auth::user() )
                    <a href="{{ route('employer_register') }}">
                        <img src="{{asset('/')}}assets/images/employer_new.png" alt="">
                    </a>
                    @else
                        <a href="javascript:void(0)">
                            <img src="{{asset('/')}}assets/images/employee.png" alt="">
                        </a>
                    @endif
                </div>
                <div class="jobseeker-image">
                    <img src="{{asset('/')}}assets/images/employ.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>