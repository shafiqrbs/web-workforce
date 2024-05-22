<section id="banner">
    <div style="background: #ffe992; min-height: 125px;">
    </div>
</section>


<div class="container">
    <ul class="nav nav-tabs pt-4" id="employerTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{!Request::is('home')?'active':''}}" id="profile-tab" href="{{ route('home') }}" role="tab" aria-controls="profile" aria-selected="false">Dashboard</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{!Request::is('edit-profile')?'active':''}}" id="edit-profile" href="{{ route('my.profile') }}" role="tab" aria-controls="edit-profile" aria-selected="false">Update Profile</a>
        </li>
        {{--<li class="nav-item">
            <a class="nav-link {{Request::is('search/job-seekers')?'active':''}}" id="search-tab" href="{{route('job.seeker.search')}}" role="tab" aria-controls="home" aria-selected="true">Search</a>
        </li>--}}

    </ul>
</div>