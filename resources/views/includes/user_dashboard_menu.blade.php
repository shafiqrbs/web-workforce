<div class="dashboard-tab">
    <div class="activer">
        <div class="active-btn">
            <h4>
                @if(isset(auth()->user()->is_immediate_available))
                    {{ auth()->user()->is_immediate_available == 1 ? 'Available to Work Now' : 'Not Available to Work Now' }}
                @endif
            </h4>
        </div>
    </div>
    <ul>
        <li class="{{ Request::is('home') ? 'active' : ''}}">
            <a href="{{route('home')}}">
                <div class="d-icon">
                    <img src="{{asset('/')}}assets/images/dash.png" alt="">
                </div>
                Dashboard
            </a>
        </li>

        <li class="{{ Request::is('edit-profile') ? 'active' : ''}}">
            <a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('my.profile') }}">
                <div class="d-icon">
                    <img src="{{asset('/')}}assets/images/ps.png" alt="">
                </div>
                Edit Profile
            </a>
        </li>

        <li class="{{ Request::is('profile-summary') ? 'active' : ''}}">
            <a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('view.public.profile') }}">
                <div class="d-icon">
                    <img src="{{asset('/')}}assets/images/ps.png" alt="">
                </div>
                Profile Summary
            </a>
        </li>

        <li class="{{ Request::is('manage-resume') ? 'active' : ''}}">
            <a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('manage.resume') }}">
                <div class="d-icon">
                    <img src="{{asset('/')}}assets/images/mr.png" alt="">
                </div>
                Manage Resume
            </a>
        </li>

        <li class="{{ Request::is('video') || Request::is('approval/video') ? 'active' : '' }}">
            <a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('list.video') }}">
                <div class="d-icon">
                    <img src="{{asset('/')}}assets/images/mv.png" alt="">
                </div>
                My Video
            </a>
        </li>

        <li class="{{ Request::is('user/testimonials') ? 'active' : ''}}">
            <a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('user.testimonials') }}">
                <div class="d-icon">
                    <img src="{{asset('/')}}assets/images/ar.png" alt="">
                </div>
                Add a Review
            </a>
        </li>

        <li class="menu-item-has-children tab-dropdown">
            <div class="d-icon"><img src="{{asset('/')}}assets/images/cog.png" alt=""><strong style="font-weight: bold">Setting</strong></div>
            <ul class="sub-menu" style="{{ Request::is('account/delete/reason') ? 'display: block;' : ''}}{{ Request::is('change/password') ? 'display: block;' : ''}}{{ Request::is('email/preference') ? 'display: block;' : ''}}">
                <li class="{{ Request::is('account/delete/reason') ? 'active' : ''}}">
                    <a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('account.delete.reason') }}">
                        Delete My Account
                    </a>
                </li>

                <li class="{{ Request::is('change/password') ? 'active' : ''}}">
                    <a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('pass.change.page') }}">
                        Change Password
                    </a>
                </li>

                <li class="{{ Request::is('email/preference') ? 'active' : ''}}">
                    <a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('email.preference') }}">
                        Email Preferences
                    </a>
                </li>
            </ul>
        </li>


        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div class="d-icon">
                    <img src="{{asset('/')}}assets/images/cog.png" alt="">
                </div>
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</div>

@push('scripts')
    @include('includes.immediate_available_btn')
@endpush