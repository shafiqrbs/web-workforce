<!-- search-popup -->
<div id="search-popup" class="search-popup">
    <div class="close-search"><span>Close</span></div>
    <div class="popup-inner">
        <div class="overlay-layer"></div>
        <div class="search-form">
            <form method="post" action="{{route('index')}}">
                <div class="form-group">
                    <fieldset>
                        <input type="search" class="form-control" name="search-input" value="" placeholder="Search Here" required >
                        <input type="submit" value="Search Now!" class="theme-btn style-four">
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- search-popup end -->
<!-- sidebar cart item -->
<div class="xs-sidebar-group info-group info-sidebar">
    <div class="xs-overlay xs-bg-black"></div>
    <div class="xs-sidebar-widget">
        <div class="sidebar-widget-container">
            <div class="widget-heading">
                <a href="#" class="close-side-widget"><i class="fal fa-times"></i></a>
            </div>
            <div class="sidebar-textwidget">
                <div class="sidebar-info-contents">
                    <div class="content-inner">
                        <div class="logo">
                            <a href="{{route('index')}}"><img src="{{ asset('assets/images/logo.svg') }}" alt="" /></a>
                        </div>
                        <div class="content-box">
                            <h4>Book Now</h4>
                            <form action="{{route('index')}}" method="post" class="booking-form">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Name" required="">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Email" required="">
                                </div>
                                <div class="form-group">
                                    <textarea name="message" placeholder="Text"></textarea>
                                </div>
                                <div class="form-group message-btn">
                                    <button type="submit">Send Now</button>
                                </div>
                            </form>
                        </div>
                        <div class="contact-info">
                            <h4>Contact Info</h4>
                            <ul>
                                <li>Chicago 12, Melborne City, USA</li>
                                <li><a href="tel:+8801682648101">+88 01682648101</a></li>
                                <li><a href="mailto:info@example.com">info@example.com</a></li>
                            </ul>
                        </div>
                        <ul class="social-box">
                            <li class="facebook"><a href="#" class="fab fa-facebook-f"></a></li>
                            <li class="twitter"><a href="#" class="fab fa-twitter"></a></li>
                            <li class="linkedin"><a href="#" class="fab fa-linkedin-in"></a></li>
                            <li class="instagram"><a href="#" class="fab fa-instagram"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END sidebar widget item -->
<!-- main header -->
<header class="main-header style-one">
    <div class="header-lower">
        <div class="auto-container">
            <div class="outer-box clearfix">
                <div class="logo-box pull-left">
                    <figure class="logo"><a href="{{route('index')}}"><img src="{{ asset('assets/images/logo.svg') }}" alt=""></a></figure>
                </div>
                <div class="menu-area clearfix pull-right">
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li class="current"><a href="#home">Home</a></li>
                                <li class="dropdown"><a href="#impact">Impact</a>
                                    <ul>
                                        <li><a href="#achievement">Achievement</a></li>
                                        <li><a href="#case-story">Case Story</a></li>
                                    </ul>
                                </li>
                                <li class=""><a href="#event">Events</a></li>
                                <li class=""><a href="#news">News & Blog</a></li>
                                <li class=""><a href="#resource">Resources</a></li>
                                <li><a href="#contact">Contact</a></li>
                            </ul>
                        </div>
                    </nav>
                    <div class="menu-right-content clearfix">
                        <ul class="other-option clearfix">
                            <li class="search-btn">
                                <button type="button" class="search-toggler"><i class="far fa-search"></i></button>
                            </li>
                            <li class="nav-box">
                                <div class="nav-toggler navSidebar-button"><i class="fas fa-th-large"></i></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--sticky Header-->
    <div class="sticky-header">
        <div class="auto-container">
            <div class="outer-box clearfix">
                <div class="logo-box pull-left">
                    <figure class="logo"><a href="{{route('index')}}"><img src="{{ asset('assets/images/logo.svg') }}" alt=""></a></figure>
                </div>
                <div class="menu-area clearfix pull-right">
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                    <div class="menu-right-content clearfix">
                        <ul class="other-option clearfix">
                            <li class="search-btn">
                                <button type="button" class="search-toggler"><i class="far fa-search"></i></button>
                            </li>
                            <li class="nav-box">
                                <div class="nav-toggler navSidebar-button"><i class="fas fa-th-large"></i></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- main-header end -->
<!-- Mobile Menu  -->
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <div class="close-btn"><i class="fas fa-times"></i></div>

    <nav class="menu-box">
        <div class="nav-logo"><a href="{{route('index')}}"><img src="{{ asset('assets/frontend/images/logo-2.png') }}" alt="" title=""></a></div>
        <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
        <div class="contact-info">
            <h4>Contact Info</h4>
            <ul>
                <li>Level 4, House no-20, Road no-99, Gulshan-2,
                    Dhaka, Bangladesh</li>
                <li><a href="tel:+8801682648101">+88-02-222280202</a></li>
                <li><a href="mailto:info@example.com">info@gainhealth.org/a></li>
            </ul>
        </div>
        <div class="social-links">
            <ul class="clearfix">
                <li><a href="{{route('index')}}"><span class="fab fa-twitter"></span></a></li>
                <li><a href="{{route('index')}}"><span class="fab fa-facebook-square"></span></a></li>
                <li><a href="{{route('index')}}"><span class="fab fa-pinterest-p"></span></a></li>
                <li><a href="{{route('index')}}"><span class="fab fa-instagram"></span></a></li>
                <li><a href="{{route('index')}}"><span class="fab fa-youtube"></span></a></li>
            </ul>
        </div>
    </nav>
</div><!-- End Mobile Menu -->



