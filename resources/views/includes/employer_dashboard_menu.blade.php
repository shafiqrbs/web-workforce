<div class="dashboard-tab">
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

        {{--<li class="{{ Request::is('profile-summary') ? 'active' : ''}}">
            <a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('view.public.profile') }}">
                <div class="d-icon">
                    <img src="{{asset('/')}}assets/images/profile_new.png" alt="">
                </div>
                My Profile
            </a>
        </li>--}}

        {{--<li class="{{ Request::is('employer-save-search') ? 'active' : ''}}">
            <a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('saveSearch') }}">
                <div class="d-icon">
                    <img src="{{asset('/')}}assets/images/Save Search.png" alt="">
                </div>
                Saved Searches @if(isset($saveSearchCount))
                    ({{ $saveSearchCount }})
                @endif
            </a>
        </li>--}}

        {{--<li class="{{ Request::is('saved-jobseeker-profile') ? 'active' : ''}}">
            <a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('savedJobseekerPofile') }}">
                <div class="d-icon">
                    <img src="{{asset('/')}}assets/images/ps.png" alt="">
                </div>
                Saved Jobseeker Profiles @if(isset( $countSaveProfile))({{ $countSaveProfile}})@endif
            </a>
        </li>--}}

        {{--<li class="{{ Request::is('employer-package/list')? 'active' : '' }}">
            <a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{route('employee.packages.list')}}">
                <div class="d-icon">
                    <img src="{{asset('/')}}assets/images/payment.png" alt="">
                </div>
                My Payment Details
            </a>
        </li>--}}

        {{--<li class="{{ Request::is('manage-access') ? 'active' : ''}}">
            <a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('manageAccess') }}">
                <div class="d-icon">
                    <img src="{{asset('/')}}assets/images/manage_access.png" alt="">
                </div>
                Manage Access
            </a>
        </li>--}}

        {{--<li class="{{ Request::is('user/testimonials') ? 'active' : ''}}">
            <a style="pointer-events: {{ auth()->user()->is_suspended == 1 ? 'none' : '' }}" href="{{ route('user.testimonials') }}">
                <div class="d-icon">
                    <img src="{{asset('/')}}assets/images/ar.png" alt="">
                </div>
                Add a Review
            </a>
        </li>--}}

        {{--<li class="menu-item-has-children tab-dropdown">
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
        </li>--}}


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