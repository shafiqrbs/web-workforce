<header>
    <div class="container">
        <div class="imr">
            <div class="im-12">
                <div class="header-inner">
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('/') }}assets/images/logo.png" alt="">
                        </a>
                    </div>
                    <div class="main-menu-inner">
                        <div class="nav-header">
                            <div class="hamburger"></div>
                        </div>
                        <div class="collapse-nav">
                            <div class="nav-header">
                                <div class="hamburger"></div>
                            </div>
                            <ul class="main_menu">

                                <li class="blue">
                                    <a href="{{ url('/') }}">Home</a>
                                </li>
                                @foreach($show_in_top_menu as $top_menu) @php $cmsContent = App\CmsContent::getContentBySlug($top_menu->page_slug); @endphp
                                @if($top_menu->page_slug=='about-us')
                                    @php
                                        $class = 'red';
                                    @endphp
                                    @elseif($top_menu->page_slug=='why-us'||$top_menu->page_slug=='our-difference')
                                    @php
                                        $class = 'light-green';
                                    @endphp
                                    @elseif($top_menu->page_slug=='how-it-works')
                                    @php
                                        $class = 'light-green';
                                    @endphp
                                    @elseif($top_menu->page_slug=='pricing')
                                    @php
                                        $class = 'yellow';
                                    @endphp
                                    @else
                                    @php
                                        $class = 'dark-blue';
                                    @endphp
                                    @endif
                                @if($top_menu->page_slug!='why-us' && $top_menu->page_slug!='how-it-works'&& $top_menu->page_slug!='our-difference')
                                    <li class="{{$class}}">
                                        <a href="{{ route('cms', $top_menu->page_slug) }}">{{isset($cmsContent)? $cmsContent->page_title:'' }}</a>
                                    </li>

                                    @elseif($top_menu->page_slug=='how-it-works')
                                    <li class="{{$class}} menu-item-has-children">
                                        <a href="javascript:void(0)">Why Us</a>
                                        <ul class="sub-menu">
                                             <li><a href="{{ url('cms/our-difference') }}">Our Difference</a></li>
                                            <li><a href="{{ url('cms/how-it-works') }}">How it Works</a></li>
                                        </ul>
                                    </li>
                                @endif
                                @endforeach

                                    @if(!Auth::user() && !Auth::guard('company')->user())
                                    <li class="yellow">
                                        <a style="font-style: normal; border-radius:0px;" href="{{route('login')}}">Sign In</a>
                                    </li>
                                        @else
                                            @if(Auth::user()->email_verified_at!=null)
                                        <li class="light-green menu-item-has-children">
                                            <a href="javascript:void(0)"><i class="fa fa-user-alt" aria-hidden="true"></i></a>
                                            <ul style="min-width: auto" class="sub-menu">
                                                <li><a href="{{route('home')}}">Dashboard</a></li>
                                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">{{__('Logout')}}</a> </li>
                                                <form id="logout-form-header" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </ul>
                                        </li>
                                            @else

                                        <li>
                                        </li>

                                    @endif

                                    @endif

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>