<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <figure class="logo"><a href="{{route('index')}}"><img width="50%" src="{{ asset('assets/images/logo.svg') }}" alt=""></a></figure>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('index')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cms.achievement.list')}}">Achievement</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cms.case-story')}}">Case Story</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cms.events')}}">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cms.news')}}">News & Notice</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cms.resources')}}">Resources</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('photo_gallery')}}">Gallery</a>
                </li>
            </ul>
            <button class="btn btn-primary ms-3">Get Started</button>
        </div>
    </div>
</nav>