<li class="nav-item {{ Request::is('admin/news-notice/list')?'open':''}}{{ Request::is('admin/list-news-notice-category')?'open':''}}{{ Request::is('admin/news-notice/create')?'open':''}}{{ Request::is('admin/news-notice/edit/*')?'open':''}}{{ Request::is('admin/sort-news')?'open':''}}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fab fa-neos"></i>
        <span class="title">News & Notice</span> <span class="arrow {{ Request::is('admin/list-news-notice-category')?'open':''}}{{ Request::is('admin/news-notice/list')?'open':''}}{{ Request::is('admin/news-notice/create')?'open':''}}{{ Request::is('admin/news-notice/edit/*')?'open':''}}{{ Request::is('admin/sort-news')?'open':''}}"></span> </a>
    <ul class="sub-menu" style="{{ Request::is('admin/list-news-notice-category')?'display: block':''}}{{ Request::is('admin/news-notice/list')?'display: block':''}}{{ Request::is('admin/news-notice/create')?'display: block':''}}{{ Request::is('admin/news-notice/edit/*')?'display: block':''}}{{ Request::is('admin/sort-news')?'display: block':''}}">
        <li class="nav-item {{ Request::is('admin/news-notice/list')?'active':''}}"> <a href="{{ route('list.news.notice') }}" class="nav-link "> <span class="title">News List</span> </a> </li>
        <li class="nav-item {{ Request::is('admin/news-notice/create')?'active':''}}"> <a href="{{ route('create.news.notice') }}" class="nav-link "> <span class="title">Add News</span> </a> </li>
        <li class="nav-item {{ Request::is('admin/sort-news')?'active':''}}"> <a href="{{ route('sort.news') }}" class="nav-link "> <span class="title">Sort News</span> </a> </li>
        <li class="nav-item {{ Request::is('admin/list-news-notice-category')?'active':''}}"> <a href="{{ route('list.news.notice.category') }}" class="nav-link "> <span class="title">News Categories</span> </a> </li>
    </ul>
</li>