<li class="nav-item {{ Request::is('admin/list-genders')?'open':''}}{{ Request::is('admin/create-gender')?'open':''}}{{ Request::is('admin/sort-genders')?'open':''}}{{ Request::is('admin/edit-gender/*')?'open':''}}"> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-venus-double" aria-hidden="true"></i> <span class="title">Genders</span> <span class="arrow {{ Request::is('admin/list-genders')?'open':''}}{{ Request::is('admin/create-gender')?'open':''}}{{ Request::is('admin/sort-genders')?'open':''}}{{ Request::is('admin/edit-gender/*')?'open':''}}"></span> </a>
    <ul class="sub-menu" style="{{ Request::is('admin/list-genders')?'display: block':''}}{{ Request::is('admin/create-gender')?'display: block':''}}{{ Request::is('admin/sort-genders')?'display: block':''}}{{ Request::is('admin/edit-gender/*')?'display: block':''}}">
        <li class="nav-item {{ Request::is('admin/list-genders')?'active':''}}"> <a href="{{ route('list.genders') }}" class="nav-link "> <span class="title">List Genders</span> </a> </li>
        <li class="nav-item {{ Request::is('admin/create-gender')?'active':''}}"> <a href="{{ route('create.gender') }}" class="nav-link "> <span class="title">Add new Gender</span> </a> </li>
        <li class="nav-item {{ Request::is('admin/sort-genders')?'active':''}}"> <a href="{{ route('sort.genders') }}" class="nav-link "> <span class="title">Sort Genders</span> </a> </li>
    </ul>
</li>