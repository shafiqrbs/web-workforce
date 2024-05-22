<li class="nav-item  {{ Request::is('admin/list-arms')?'open':''}}{{ Request::is('admin/create-arms')?'open':''}}{{ Request::is('admin/edit-arms/*')?'open':''}}{{ Request::is('admin/sort-arms')?'open':''}}{{ Request::is('admin/sort-arms')?'open':''}}">
    <a href="javascript:;" class="nav-link nav-toggle"> <i class="fas fa-skull-crossbones"></i>
        <span class="title">{{__('messages.Arms')}}</span>
        <span class="arrow {{ Request::is('admin/list-arms')?'open':''}}{{ Request::is('admin/create-arms')?'open':''}}{{ Request::is('admin/edit-arms/*')?'open':''}}{{ Request::is('admin/sort-arms')?'open':''}}"></span>
    </a>
    <ul class="sub-menu" style="{{ Request::is('admin/list-arms')?'display: block':''}}{{ Request::is('admin/create-arms')?'display: block':''}}{{ Request::is('admin/edit-arms/*')?'display: block':''}}{{ Request::is('admin/sort-arms')?'display: block':''}}">
        <li class="nav-item {{ Request::is('admin/list-arms')?'active':''}}">
            <a href="{{ route('list_arms') }}" class="nav-link ">
                <span class="title">{{__('messages.Arms_list')}}</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/create-arms')?'active':''}}">
            <a href="{{ route('create_arms') }}" class="nav-link ">
                <span class="title">{{__('messages.Arms_add')}}</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/sort-arms')?'active':''}}">
            <a href="{{ route('sort_arms') }}" class="nav-link ">
                <span class="title">{{__('messages.Arms_sort')}}</span>
            </a>
        </li>
    </ul>
</li>