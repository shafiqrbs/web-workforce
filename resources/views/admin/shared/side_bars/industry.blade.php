<li class="nav-item {{ Request::is('admin/list-industries')?'open':''}}{{ Request::is('admin/create-industry')?'open':''}}{{ Request::is('admin/sort-industries')?'open':''}}{{ Request::is('admin/edit-industry/*')?'open':''}}"> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-building-o" aria-hidden="true"></i> <span class="title">Industries</span> <span class="arrow {{ Request::is('admin/list-industries')?'open':''}}{ Request::is('admin/create-industry')?'open':''}}{{ Request::is('admin/sort-industries')?'open':''}}{{ Request::is('admin/edit-industry/*')?'open':''}}"></span> </a>
    <ul class="sub-menu" style="{{ Request::is('admin/list-industries')?'display: block':''}}{{ Request::is('admin/create-industry')?'display: block':''}}{{ Request::is('admin/sort-industries')?'display: block':''}}{{ Request::is('admin/edit-industry/*')?'display: block':''}}">
        <li class="nav-item {{ Request::is('admin/list-industries')?'active':''}}"> <a href="{{ route('list.industries') }}" class="nav-link "> <span class="title">List Industries</span> </a> </li>
        <li class="nav-item {{ Request::is('admin/create-industry')?'active':''}}"> <a href="{{ route('create.industry') }}" class="nav-link "> <span class="title">Add new Industry</span> </a> </li>
        <li class="nav-item {{ Request::is('admin/sort-industries')?'active':''}}"> <a href="{{ route('sort.industries') }}" class="nav-link "> <span class="title">Sort Industries</span> </a> </li>
    </ul>
</li>