
<li class="nav-item {{ Request::is('admin/employer-list-users')?'open':''}}{{ Request::is('admin/employer-profile-summary/*')?'open':''}}{{ Request::is('admin/employer-payment-history/*')?'open':''}}{{ Request::is('admin/admin/deleted-employer')?'open':''}}"> <a href="javascript:;" class="nav-link nav-toggle"> <i class="icon-user"></i> <span class="title">Employer</span> <span class="arrow {{ Request::is('admin/employer-list-users')?'open':''}}{{ Request::is('admin/employer-profile-summary/*')?'open':''}}{{ Request::is('admin/employer-payment-history/*')?'open':''}}{{ Request::is('admin/deleted-employer')?'open':''}}"></span> </a>
    <ul class="sub-menu" style="{{ Request::is('admin/employer-list-users')?'display: block':''}}{{ Request::is('admin/employer-profile-summary/*')?'display: block':''}}{{ Request::is('admin/employer-payment-history/*')?'display: block':''}}{{ Request::is('admin/deleted-employer')?'display: block':''}}">
        <li class="nav-item {{ Request::is('admin/employer-list-users')?'active':''}}"> <a href="{{ route('employer.list.users') }}" class="nav-link "> <i class="icon-user"></i> <span class="title">List Employer Profiles</span> </a> </li>
       <li class="nav-item {{ Request::is('admin/deleted-employer')?'active':''}} "> <a href="{{ route('list.admin.deleted_employer') }}" class="nav-link "> <i class="icon-user"></i> <span class="title">Deleted Employer</span> </a> </li>

         {{--<li class="nav-item {{ Request::is('admin/profile-videos')?'active':''}}">
             <a href="{{ route('list.admin.profile_video') }}" class="nav-link "> <i class="icon-camera"></i> <span class="title">Profile Videos</span> </a>
        </li>

        <li class="nav-item {{ Request::is('deleted-user')?'active':''}}">
            <a href="{{ route('list.admin.deleted_user') }}" class="nav-link "> <i class="icon-user"></i> <span class="title">Deleted Jobseekers</span> </a>
        </li>--}}
    </ul>
</li>