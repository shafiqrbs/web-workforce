
<li class="nav-item {{ Request::is('admin/payment-history')?'open':''}}"> <a href="javascript:;" class="nav-link nav-toggle"> <i class="icon-user"></i> <span class="title">Payment History</span> <span class="arrow {{ Request::is('admin/payment-history')?'open':''}}"></span> </a>
    <ul class="sub-menu" style="{{ Request::is('admin/payment-history')?'display: block':''}}">
        <li class="nav-item {{ Request::is('admin/payment-history')?'active':''}}"> <a href="{{ route('payment.history') }}" class="nav-link "> <i class="icon-user"></i> <span class="title">List Payment History</span> </a> </li>
       {{--<li class="nav-item {{ Request::is('admin/deleted-employer')?'active':''}} "> <a href="{{ route('list.admin.deleted_employer') }}" class="nav-link "> <i class="icon-user"></i> <span class="title">Deleted Employer</span> </a> </li>--}}

         {{--<li class="nav-item {{ Request::is('admin/profile-videos')?'active':''}}">
             <a href="{{ route('list.admin.profile_video') }}" class="nav-link "> <i class="icon-camera"></i> <span class="title">Profile Videos</span> </a>
        </li>

        <li class="nav-item {{ Request::is('deleted-user')?'active':''}}">
            <a href="{{ route('list.admin.deleted_user') }}" class="nav-link "> <i class="icon-user"></i> <span class="title">Deleted Jobseekers</span> </a>
        </li>--}}
    </ul>
</li>