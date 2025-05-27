<footer class="main-footer">
    <div class="footer-top-two footer-custom-padding">
        <div class="auto-container">
            <div class="row footer-custom-border" >
                <div class=" col-md-6 footer-column" style="text-align: center">
                    <div class="footer-widget logo-widget">
                        <figure class="footer-logo"><a href="{{url('/')}}"><img class="footer-logo-image" src="{{ asset('assets/images/logo.svg') }}" alt=""></a></figure>
                        <div class="text">
                            <p class="footer-site-name">{{$siteSetting->site_name}}</p>
                            <p>{{$siteSetting->site_street_address}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 footer-column">
                    <div class="footer-widget links-widget">
                        <div class="widget-title">
                            <h4>Useful links</h4>
                        </div>

                        <div class="widget-content">
                            <ul class="links-list clearfix" style="border-bottom: 0px">
                                <li><a href="https://www.gainhealth.org/" target="_blank">Global Alliance for Improved Nutrition</a></li>
                                <li><a href="https://www.gainhealth.org/impact/programmes/workforce-nutrition" target="_blank">Workforce Nutrition Alliance</a></li>
                                <li><a href="https://play.google.com/store/apps/details?id=com.fairshop.pos&hl=en&gl=US" target="_blank">Fair Shop</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix" style="padding-top: 15px;">
                <div class="col-md-12 col-sm-12 footer-column">
                    <div class="footer-widget links-widget">
                        <div class="widget-content">
                            <ul class="social-box clearfix">
                                <div class="row mb-5">
                                    @if($siteSetting->facebook_address)
                                        <div class="col-md-3 mb-2">
                                            <li>
                                                <a  href="{{$siteSetting->facebook_address}}" style="background: #1877F2" target="_blank">
                                                    <i class="fab fa-facebook-f"></i><span>Visit</span>Facebook
                                                </a>
                                            </li>
                                        </div>
                                    @endif

                                    @if($siteSetting->youtube_address)
                                        <div class="col-md-3 mb-2">
                                            <li>
                                                <a  href="{{$siteSetting->youtube_address}}"  target="_blank"
                                                    style="background: #c13232"><i class="fab fa-youtube"></i><span>Visit</span>Youtube</a>
                                            </li>
                                        </div>
                                    @endif

                                    @if($siteSetting->linkedin_address)
                                        <div class="col-md-3 mb-2">
                                            <li>
                                                <a  href="{{$siteSetting->linkedin_address}}"  target="_blank"
                                                    style="background: #0B66C2">
                                                    <i class="fab fa-linkedin"></i><span>Visit</span>Linkedin</a>
                                            </li>
                                        </div>
                                    @endif

                                    <div class="col-md-3">
                                        <li>
                                            <a  href="#" style="background: #c13232"><i class="fas fa-restroom" ></i><span>
                                                        {{ \App\Models\VisitorCount::visitorDataInsert()  }}</span>Visitors</a>
                                        </li>
                                    </div>

                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="footer-bottom alternat-2">
        <div class="auto-container">
            <div class="bottom-inner clearfix">
                <div class="copyright text-center">
                    <p>&copy; {{ date('Y')}} By {{ $siteSetting->site_name }}.  All Rights Reserved. </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<style>
    .logo a img {
        display: inline-block;
        max-width: 100%;
        height: 60px;
        transition-delay: .1s;
        transition-timing-function: ease-in-out;
        transition-duration: .7s;
        transition-property: all;
    }
    .footer-top-two .links-widget .links-list li {
        position: relative;
        float: left;
        width: 100%!important;
        margin-bottom: 12px;
    }
    .footer-logo-image {
        background: #fff;
        padding: 10px;
        border-radius:0!important;
    }
</style>