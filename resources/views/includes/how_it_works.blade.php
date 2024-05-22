<section id="works">
    <div class="work-title">
        <h2>How it works</h2>
    </div>
    <div class="work-inner">
        <div class="single-work">
            <div class="single-work-image left-image">
                <img src="{{asset('/')}}assets/images/w1.png" alt="">
            </div>
            <ul>
                <li>Free!</li>
                <li>Upload Video and Resume  <br>takes minutes!</li>
                <li>No Job postings to apply for!</li>
                <li>Let employers find you!</li>
            </ul>
        </div>
        <div class="single-work">
            <div class="youtube-link">
                    <video class="home-page-video" style="border: 2px solid #000;" controls controlsList="nodownload" width="100%" height="280px" id="vid"  poster="{{ asset('assets/images/you.png') }}" src="{{ asset('/videos/videojp.mp4') }}"></video>
                    {{--<img src="design/assets/images/you.png" alt="">--}}
                    {{--<iframe width="100%" height="280" src="{{ asset('/videos/videojp.mp4') }}" title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>--}}
            </div>
        </div>
        <div class="single-work">
            <div class="single-work-image right-image">
                <img src="{{asset('/')}}assets/images/w2.png" alt="">
            </div>
            <ul>
                <li>No job postings!</li>
                <li>Why pay over $500 for a time consuming job posting?</li>
                <li>Why pay hundreds of $$$ for functionality you'll never use?</li>
                <li>You know who you are looking for so “Search and Hire”!</li>
            </ul>
        </div>
    </div>
</section>