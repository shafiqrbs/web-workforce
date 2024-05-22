



<li class="nav-item  {{ Request::is('admin/list-event-type')?'open':''}}{{ Request::is('admin/create-event-type')?'open':''}}{{ Request::is('admin/sort-event-type')?'open':''}}{{ Request::is('admin/edit-event-type/*')?'open':''}}"> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fas fa-graduation-cap"></i> <span class="title">Event Types</span> <span class="arrow {{ Request::is('admin/list-event-type')?'open':''}}{{ Request::is('admin/create-event-type')?'open':''}}{{ Request::is('admin/sort-event-type')?'open':''}}{{ Request::is('admin/edit-event-type/*')?'open':''}}"></span> </a>
    <ul class="sub-menu" style="{{ Request::is('admin/list-event-type')?'display: block':''}}{{ Request::is('admin/create-event-type')?'display: block':''}}{{ Request::is('admin/sort-event-type')?'display: block':''}}{{ Request::is('admin/edit-event-type/*')?'display: block':''}}">
        <li class="nav-item {{ Request::is('admin/list-event-type')?'active':''}}"> <a href="{{ route('list_event_type') }}" class="nav-link "> <span class="title">List event type</span> </a> </li>
        <li class="nav-item {{ Request::is('admin/create-event-type')?'active':''}}"> <a href="{{ route('create_event_type') }}" class="nav-link "> <span class="title">Add New event type</span> </a> </li>
{{--        <li class="nav-item {{ Request::is('admin/sort-event-type')?'active':''}}"> <a href="{{ route('sort_event_type') }}" class="nav-link "> <span class="title">Sort event type</span> </a> </li>--}}
    </ul>
</li>