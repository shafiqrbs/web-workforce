<li class="nav-item  {{ Request::is('admin/photo-gallery/*')?'open':''}}"> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-club" aria-hidden="true"></i> <span class="title">Photo Gallery</span> <span class="arrow {{ Request::is('admin/photo-gallery/*')?'open':''}}"></span> </a>
    <ul class="sub-menu" style="{{ Request::is('admin/photo-gallery/*')?'display: block':''}}">
        <li class="nav-item {{ Request::is('admin/photo-gallery/list')?'active':''}}"> <a href="{{ route('list.gallery') }}" class="nav-link "> <span class="title">List gallery</span> </a> </li>
        <li class="nav-item {{ Request::is('admin/photo-gallery/create')?'active':''}}"> <a href="{{ route('create.gallery') }}" class="nav-link "> <span class="title">Add new gallery</span> </a> </li>
        <li class="nav-item {{ Request::is('admin/sort-gallery')?'active':''}}"> <a href="{{ route('sort_gallery') }}" class="nav-link "> <span class="title">Sort gallery</span> </a> </li>
    </ul>
</li>