@extends('layouts.app')
@section('content')
    <!-- Header start -->
    @include('includes.header')
    <!-- Header end -->
    <!-- Inner Page Title start -->
    @include('includes.inner_page_title', ['page_title'=>__('Reviews')])
    <!-- Inner Page Title end -->
    <section id="title">
        <div class="title-inner">
            <div class="container">
                <div class="imr">
                    <div class="im-12">
                        <div class="title">
                            <h2>{{$status=='employee'?'Employer':'Jobseeker '}} Reviews</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="section white">
        <div class="container">
            <div class="imr">
                <div class="im-12">
                    <div class="section-contents">
                        <ul class="list-group">
                            @if(isset($testimonials) && count($testimonials)>0)
                                @foreach($testimonials as $testimonial)
                                    <li class="list-group-item">
                                        <div class="dataReadonlyReview" data-rating="{{$testimonial->rating}}">
                                        </div>
                                        <div class="pt-2">
                                            <h4 class="text-left">{{$testimonial->user?$testimonial->user->first_name:''}}</h4>
                                        </div>
                                        <div>
                                            <p class="text-left">{{$testimonial->testimonial}}</p>
                                        </div>

                                        <div class="pt-2">
                                            <p class="text-left font-weight-bold">Date of Review: <span style="font-weight:400;">{{$testimonial->created_at->format('F Y')}}</span></p>
                                        </div>

                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer_social')
@endsection
@push('scripts')
    <script type="text/javascript">
        $(".dataReadonlyReview").starRating({
            totalStars: 5,
            emptyColor: 'white',
            hoverColor: '#ff8000',
            activeColor: '#ff8000',
            strokeColor: '#ff8000',
            strokeWidth: 9,
            useGradient: true,
            readOnly: true,
            starGradient: {
                start: '#ff8000',
                end: '#ff8000'
            },
        });
    </script>
@endpush