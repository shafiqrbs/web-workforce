
<li class="nav-item {{ Request::is('admin/list-users')?'open':''}}{{ Request::is('admin/profile-summary/*')?'open':''}}{{ Request::is('admin/profile-videos')?'open':''}}{{ Request::is('admin/deleted-user')?'open':''}} {{ Request::is('admin/sort-athletes')?'open':''}}{{ Request::is('admin/create-athlete-user')?'open':''}}"> <a href="javascript:;" class="nav-link nav-toggle"> <i class="icon-user"></i> <span class="title">Athletes</span> <span class="arrow {{ Request::is('admin/list-users')?'open':''}}{{ Request::is('admin/profile-summary/*')?'open':''}}{{ Request::is('admin/profile-videos')?'open':''}}{{ Request::is('admin/deleted-user')?'open':''}} {{ Request::is('admin/sort-athletes')?'open':''}}{{ Request::is('admin/create-athlete-user')?'open':''}}"></span> </a>
    <ul class="sub-menu" style="{{ Request::is('admin/list-users')?'display: block':''}}{{ Request::is('admin/profile-summary/*')?'display: block':''}}{{ Request::is('admin/profile-videos')?'display: block':''}}{{ Request::is('admin/deleted-user')?'display: block':''}}{{ Request::is('admin/sort-athletes')?'display: block':''}}{{ Request::is('admin/create-athlete-user')?'display: block':''}}">
        <li class="nav-item {{ Request::is('admin/list-users')?'active':''}}"> <a href="{{ route('list.users') }}" class="nav-link ">  <span class="title">List Athletes</span> </a> </li>
       <li class="nav-item  {{ Request::is('admin/create-athlete-user')?'active':''}}"> <a href="{{ route('create_athlete_user') }}" class="nav-link "> <span class="title">Add New Athlete</span> </a> </li>

         {{--<li class="nav-item {{ Request::is('admin/profile-videos')?'active':''}}">
             <a href="{{ route('list.admin.profile_video') }}" class="nav-link "> <i class="icon-camera"></i> <span class="title">Profile Videos</span> </a>
        </li>--}}

        {{--<li class="nav-item {{ Request::is('admin/deleted-user')?'active':''}}">
            <a href="{{ route('list.admin.deleted_user') }}" class="nav-link "> <i class="icon-user"></i> <span class="title">Deleted Athletes</span> </a>
        </li>--}}

        <li class="nav-item {{ Request::is('admin/sort-athletes')?'active':''}}"> <a href="{{ route('sort.athletes') }}" class="nav-link "> <span class="title">Sort Athletes</span> </a> </li>


    </ul>
</li>