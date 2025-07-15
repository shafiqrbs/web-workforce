<section class="news-section">
    <div class="container">
        <h2 class="section-title"> News & blogs</h2>
        <div class="row g-4">

            @foreach($newsAndNotices as $newsnotice)
                <div class="col-lg-4">
                    <div class="news-card">
                        @if($newsnotice->image && !empty($newsnotice->image))
                            <img src="{{asset('/news_notice/mid')}}/{{$newsnotice->image}}" alt="" class="news-card-image">
                        @else
                            <img src="{{asset('assets/news-default.png')}}">
                        @endif
                        <div class="news-card-content">
                            <h5>{{mb_strimwidth($newsnotice->title, 0, 100, '...')}}</h5>
                            <p>{{$newsnotice->post_type}}</p>
                            <p>{{date('j F Y, l', strtotime($newsnotice->created_at))}}</p>
                            <a href="{{route('news.details',$newsnotice->id)}}">
                            <button class="btn btn-outline-primary">
                                    Read More
                            </button>
                            </a>

                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
</section>


@push('styles')
    <style>
        .news-section {
            background: white;
            padding: 100px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .news-card {
            background: white;
            border-radius: 15px;
            padding: 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            border-top: 4px solid var(--primary-color);
            overflow: hidden;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .news-card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 0;
        }

        .news-card-content {
            padding: 2.5rem;
        }

        .news-card h5 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .news-card p {
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

    </style>
@endpush