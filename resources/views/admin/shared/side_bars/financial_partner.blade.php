<li class="nav-item {{ Request::is('admin/financial-partner/list')?'open':''}}{{ Request::is('admin/financial-partner/create')?'open':''}}{{ Request::is('admin/financial-partner/sort')?'open':''}}{{ Request::is('admin/financial-partner/edit/*')?'open':''}}">

    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-handshake-alt"></i>
        <span class="title">Financial Partner</span>
        <span class="arrow {{ Request::is('admin/financial-partner/list')?'open':''}}{{ Request::is('admin/financial-partner/create')?'open':''}}{{ Request::is('admin/financial-partner/edit/*')?'open':''}}{{ Request::is('admin/financial-partner/sort')?'open':''}}"></span>
    </a>
    <ul class="sub-menu" style="{{ Request::is('admin/financial-partner/list')?'display: block':''}}{{ Request::is('admin/financial-partner/create')?'display: block':''}}{{ Request::is('admin/financial-partner/edit/*')?'display: block':''}}{{ Request::is('admin/financial-partner/sort')?'display: block':''}}">
        <li class="nav-item {{ Request::is('admin/financial-partner/list')?'active':''}}">
            <a href="{{ route('financial_partner_list') }}" class="nav-link "> <span class="title">Financial Partner List</span> </a>
        </li>
        <li class="nav-item {{ Request::is('admin/financial-partner/create')?'active':''}}">
            <a href="{{ route('financial_partner_add') }}" class="nav-link "> <span class="title">Add New Partner</span> </a>
        </li>
        <li class="nav-item {{ Request::is('admin/financial-partner/sort')?'active':''}}"> <a href="{{ route('financial_partner_sort') }}" class="nav-link "> <span class="title">Sort Financial Partner</span> </a> </li>

    </ul>
</li>