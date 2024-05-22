<footer>
    <div class="footer-inner">
        <div class="footer-top">
            <div class="container">
                <div class="imr">
                    <div class="im-12">
                        <div class="footer-social">
                            <div class="footer-social-box">
                                <h3>Follow us on:</h3>
                                <ul>
                                    <li><a href="https://www.instagram.com/httconnect/"><img src="{{asset('/')}}assets/images/insta.png" alt=""></a></li>
                                    <li><a href="https://twitter.com/ConnectHtt/"><img src="{{asset('/')}}assets/images/twitter.png" alt=""></a></li>
                                    <li><a href="https://www.facebook.com/HTT-Connect-106319908219676/"><img src="{{asset('/')}}assets/images/facebook.png" alt=""></a></li>
                                    <li><a href="https://www.linkedin.com/company/httconnect/"><img src="{{asset('/')}}assets/images/in.png" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-center">
            <div class="container">
                <div class="imr">
                    <div class="im-12">
                        <div class="footer-menu">
                            <ul>
                                <li class="red"><a href="{{ route('faq')}}">Faq's</a></li>
                                <li class=" light-green menu-item-has-children">
                                    <a href="javascript:void(0)">Reviews</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('review',['candidate'])}}">Job Seeker</a></li>
                                        <li><a href="{{ route('review',['employee'])}}">Employer</a></li>
                                    </ul>
                                </li>
                                <li class="dark-blue"><a href="{{url('/cms/terms-of-use')}}">Terms of Use</a></li>
                                <li class="dark-blue"><a href="{{url('/cms/privacy-policy')}}">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="line-image left"><img src="{{asset('/')}}assets/images/line.png" alt=""></div>
            <div class="container">
                <div class="imr">
                    <div class="im-12">
                        <div class="copyright">
                            <p>© 2021 HTT Connect, All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="line-image right"><img src="{{asset('/')}}assets/images/line.png" alt=""></div>
        </div>
    </div>
</footer>

{{--
@if ((string)$siteSetting->facebook_address !== '')
<a href="{{ $siteSetting->facebook_address }}" ><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
@endif
@if ((string)$siteSetting->google_plus_address !== '')
<a href="{{ $siteSetting->google_plus_address }}" ><i class="fa fa-google-plus-square" aria-hidden="true"></i></a>
@endif
@if ((string)$siteSetting->pinterest_address !== '')
<a href="{{ $siteSetting->pinterest_address }}" ><i class="fa fa-pinterest-square" aria-hidden="true"></i></a>
@endif
@if ((string)$siteSetting->twitter_address !== '')
<a href="{{ $siteSetting->twitter_address }}" ><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
@endif
@if ((string)$siteSetting->instagram_address !== '')
<a href="{{ $siteSetting->instagram_address }}" ><i class="fa fa-instagram" aria-hidden="true"></i></a>
@endif
@if ((string)$siteSetting->linkedin_address !== '')
<a href="{{ $siteSetting->linkedin_address }}" ><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
@endif
@if ((string)$siteSetting->youtube_address !== '')
<a href="{{ $siteSetting->youtube_address }}" ><i class="fa fa-youtube-square" aria-hidden="true"></i></a>
@endif
@if ((string)$siteSetting->tumblr_address !== '')
<a href="{{ $siteSetting->tumblr_address }}" ><i class="fa fa-tumblr-square" aria-hidden="true"></i></a>
@endif
@if ((string)$siteSetting->flickr_address !== '')
<a href="{{ $siteSetting->flickr_address }}" ><i class="fa fa-flickr-square" aria-hidden="true"></i></a>
@endif--}}
