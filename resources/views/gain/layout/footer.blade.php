<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <a class="navbar-brand d-flex align-items-center mb-3" href="#">
                    <img class="footer-logo-image" src="{{ asset('assets/images/logo.svg') }}" alt="">
                </a>
                <p class="mb-4"><p>{!! $siteSetting->site_street_address !!}</p>
                <div class="social-links">
                    <a href="{{$siteSetting->facebook_address}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{$siteSetting->youtube_address}}" target="_blank"><i class="fab fa-youtube"></i></a>
                    <a href="" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="{{$siteSetting->linkedin_address}}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-2">
                <h6>Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li><a href="{{route('cms.achievement.list')}}">Achievement</a></li>
                    <li><a href="{{route('cms.case-story')}}">Case Story</a></li>
                    <li><a href="{{route('cms.events')}}">Events</a></li>
                </ul>
            </div>
            <div class="col-lg-2">
                <h6>Services</h6>
                <ul class="list-unstyled">
                    <li><a href="https://www.gainhealth.org/" target="_blank">Global Alliance for Improved Nutrition</a></li>
                    <li><a href="https://www.gainhealth.org/impact/programmes/workforce-nutrition" target="_blank">Workforce Nutrition Alliance</a></li>
                    <li><a href="https://play.google.com/store/apps/details?id=com.fairshop.pos&hl=en&gl=US" target="_blank">Fair Shop</a></li>
                </ul>
            </div>
            <div class="col-lg-2">
                <h6>Resources</h6>
                <ul class="list-unstyled">
                    <li><a href="{{route('cms.news')}}">News & Notice</a></li>
                    <li><a href="{{route('cms.resources')}}">Resources</a></li>
                    <li><a href="{{route('photo_gallery')}}">Gallery</a></li>
                </ul>
            </div>
            <div class="col-lg-2">
                <h6>Support</h6>
                <ul class="list-unstyled">
                    <li><a href="{{$siteSetting->facebook_address}}" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                    <li><a href="{{$siteSetting->youtube_address}}" target="_blank"><i class="fab fa-youtube"></i> Youtube</a></li>
                    <li><a href="{{$siteSetting->linkedin_address}}" target="_blank"><i class="fab fa-linkedin-in"></i> Linkedin</a></li>
                    <a href="" target="_blank"><i class="fab fa-instagram"></i> Instagram</a>
                </ul>
            </div>
        </div>
        <hr class="my-4" style="border-color: #333;">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <p class="mb-0">&copy; 2025 {{$siteSetting->site_name}}. All rights reserved.</p>
            </div>
            <div class="col-lg-6 text-lg-end">
                <p class="mb-0">Made with <strong> {{$siteSetting->site_name}} </strong> for better nutrition</p>
            </div>
        </div>
    </div>
</footer>
