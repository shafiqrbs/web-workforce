



<li class="nav-item  {{ Request::is('admin/list-professions')?'open':''}}{{ Request::is('admin/create-profession')?'open':''}}{{ Request::is('admin/sort-profession')?'open':''}}{{ Request::is('admin/edit-profession/*')?'open':''}}"> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fas fa-graduation-cap"></i> <span class="title">Professions</span> <span class="arrow {{ Request::is('admin/list-professions')?'open':''}}{{ Request::is('admin/create-profession')?'open':''}}{{ Request::is('admin/sort-profession')?'open':''}}{{ Request::is('admin/edit-profession/*')?'open':''}}"></span> </a>
    <ul class="sub-menu" style="{{ Request::is('admin/list-professions')?'display: block':''}}{{ Request::is('admin/create-profession')?'display: block':''}}{{ Request::is('admin/sort-profession')?'display: block':''}}{{ Request::is('admin/edit-profession/*')?'display: block':''}}">
        <li class="nav-item {{ Request::is('admin/list-professions')?'active':''}}"> <a href="{{ route('list.professions') }}" class="nav-link "> <span class="title">List Professions</span> </a> </li>
        <li class="nav-item {{ Request::is('admin/create-profession')?'active':''}}"> <a href="{{ route('create.profession') }}" class="nav-link "> <span class="title">Add New Profession</span> </a> </li>
        <li class="nav-item {{ Request::is('admin/sort-profession')?'active':''}}"> <a href="{{ route('sort.professions') }}" class="nav-link "> <span class="title">Sort Professions</span> </a> </li>
    </ul>
</li>