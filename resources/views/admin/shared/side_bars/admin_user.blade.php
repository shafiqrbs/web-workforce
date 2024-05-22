@if(APAuthHelp::check(['SUP_ADM']))
<li class="heading">
    <h3 class="uppercase">Admin Users</h3>
</li>
<li class="nav-item {{ Request::is('admin/list-admin-users')?'open':''}}{{ Request::is('admin/create-admin-user')?'open':''}}{{ Request::is('admin/edit-admin-user/*')?'open':''}}"> <a href="javascript:;" class="nav-link nav-toggle"> <i class="icon-user"></i> <span class="title">Admin Users</span> <span class="arrow {{ Request::is('admin/list-admin-users')?'open':''}}{{ Request::is('admin/create-admin-user')?'open':''}}{{ Request::is('admin/edit-admin-user/*')?'open':''}}"></span> </a>
    <ul class="sub-menu" style="{{ Request::is('admin/list-admin-users')?'display: block':''}}{{ Request::is('admin/create-admin-user')?'display: block':''}}{{ Request::is('admin/edit-admin-user/*')?'display: block':''}}">
        <li class="nav-item {{ Request::is('admin/list-admin-users')?'active':''}}"> <a href="{{ route('list.admin.users') }}" class="nav-link "> <i class="icon-user"></i> <span class="title">List All Admin Users</span> </a> </li>
        <li class="nav-item {{ Request::is('admin/create-admin-user')?'active':''}}"> <a href="{{ route('create.admin.user') }}" class="nav-link "> <i class="icon-users"></i> <span class="title">Add Admin User</span> </a> </li>
    </ul>
</li>
@endif