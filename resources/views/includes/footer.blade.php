<footer>
    <div class="footer-inner">
        <div class="footer-top">
            <div class="container">
                <div class="imr">
                    <div class="im-12">
                        <div class="province-inner">
                            <div class="province">
                                <div class="province-title">
                                    <h3>Realtime jobseeker profile count (by Province)</h3>
                                </div>

                                <div class="province-lists">

                                    <ul>
                                        @if(isset($provinceWiseUsers))
                                            @foreach($provinceWiseUsers as $item)
                                                <li>
                                                    <label for="a">{{ $item->short_name }} </label>
                                                    <input type="text" class="text-center" value="{{ $item->totalUser }}" disabled></li>
                                            @endforeach
                                        @endif
                                    </ul>

                                </div>

                            </div>
                            <div class="province-image">
                                <img src="{{asset('/')}}assets/images/family.png" alt="">
                            </div>
                        </div>
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