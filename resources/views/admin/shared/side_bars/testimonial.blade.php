<li class="nav-item {{ Request::is('admin/list-testimonials')?'open':''}}{{ Request::is('admin/sort-testimonials')?'open':''}}"> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-file-text-o" aria-hidden="true"></i> <span class="title">Testimonials</span> <span class="arrow {{ Request::is('admin/list-testimonials')?'open':''}}{{ Request::is('admin/sort-testimonials')?'open':''}}"></span> </a>
    <ul class="sub-menu" style="{{ Request::is('admin/list-testimonials')?'display: block':''}}{{ Request::is('admin/sort-testimonials')?'display: block':''}}">
        <li class="nav-item {{ Request::is('admin/list-testimonials')?'active':''}}"> <a href="{{ route('list.testimonials') }}" class="nav-link ">  <span class="title">List Testimonials</span> </a> </li>
        {{--<li class="nav-item  "> <a href="{{ route('create.testimonial') }}" class="nav-link ">  <span class="title">Add new Testimonial</span> </a> </li>--}}
        <li class="nav-item {{ Request::is('admin/sort-testimonials')?'active':''}}"> <a href="{{ route('sort.testimonials') }}" class="nav-link "> <span class="title">Sort Testimonials</span> </a> </li>
    </ul>
</li>