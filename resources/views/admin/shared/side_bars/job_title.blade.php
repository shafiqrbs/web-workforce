<li class="nav-item {{ Request::is('admin/list-job-titles')?'open':''}}{{ Request::is('admin/create-job-title')?'open':''}}{{ Request::is('admin/edit-job-title/*')?'open':''}}"> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-font" aria-hidden="true"></i> <span class="title">Job Titles</span> <span class="arrow {{ Request::is('admin/list-job-titles')?'open':''}}{{ Request::is('admin/create-job-title')?'open':''}}{{ Request::is('admin/edit-job-title/*')?'open':''}}"></span> </a>
    <ul class="sub-menu" style="{{ Request::is('admin/list-job-titles')?'display: block':''}}{{ Request::is('admin/create-job-title')?'display: block':''}}{{ Request::is('admin/edit-job-title/*')?'display: block':''}}">
        <li class="nav-item {{ Request::is('admin/list-job-titles')?'active':''}}"> <a href="{{ route('list.job.titles') }}" class="nav-link "> <span class="title">List Job Titles</span> </a> </li>
        <li class="nav-item  {{ Request::is('admin/create-job-title')?'active':''}}"> <a href="{{ route('create.job.title') }}" class="nav-link "> <span class="title">Add new Job Title</span> </a> </li>
        {{--<li class="nav-item  "> <a href="{{ route('sort.job.titles') }}" class="nav-link "> <span class="title">Sort Job Titles</span> </a> </li>--}}
    </ul>
</li>