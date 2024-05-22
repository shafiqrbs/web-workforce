<li class="nav-item  {{ Request::is('admin/list-jury')?'open':''}}{{ Request::is('admin/create-jury')?'open':''}}{{ Request::is('admin/edit-jury/*')?'open':''}}{{ Request::is('admin/sort-jury')?'open':''}}{{ Request::is('admin/sort-jury')?'open':''}}">
    <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-user-tie"></i>
        <span class="title">{{__('messages.Judges_Jury')}}</span>
        <span class="arrow {{ Request::is('admin/list-jury')?'open':''}}{{ Request::is('admin/create-jury')?'open':''}}{{ Request::is('admin/edit-jury/*')?'open':''}}{{ Request::is('admin/sort-jury')?'open':''}}"></span>
    </a>
    <ul class="sub-menu" style="{{ Request::is('admin/list-jury')?'display: block':''}}{{ Request::is('admin/create-jury')?'display: block':''}}{{ Request::is('admin/edit-jury/*')?'display: block':''}}{{ Request::is('admin/sort-jury')?'display: block':''}}">
        <li class="nav-item {{ Request::is('admin/list-jury')?'active':''}}">
            <a href="{{ route('list_jury') }}" class="nav-link ">
                <span class="title">{{__('messages.Judges_Jury_list')}}</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/create-jury')?'active':''}}">
            <a href="{{ route('create_jury') }}" class="nav-link ">
                <span class="title">{{__('messages.Judges_Jury_add')}}</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/sort-jury')?'active':''}}">
            <a href="{{ route('sort_jury') }}" class="nav-link ">
                <span class="title">{{__('messages.Judges_Jury_sort')}}</span>
            </a>
        </li>
    </ul>
</li>