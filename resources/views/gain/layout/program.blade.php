<section id="about" class="goals-section">
    <div class="container">
        <h2 class="section-title">Our Programs</h2>
        <div class="row g-4">

            @foreach($programs as $program)

                <div class="col-lg-4">
                    <div class="goal-card">
                        <div class="goal-image">
                            @if($img = $program['feature_image'])
                                {{ ImgUploader::print_image("archive/mid/$img") }}
                            @else
                                <img src="{{asset('assets/no-image.jpeg')}}" alt="">
                            @endif
                        </div>
                        @php
                        dump($program);
                            $maxLength = 50;
                            $cropped = strlen($program->archive_name_en) > $maxLength ? substr($program->archive_name_en, 0, $maxLength) . '...' : $program->archive_name_en;
                            $cropped = strlen($program->archive_name_en) > $maxLength ? substr($program->archive_name_en, 0, $maxLength) . '...' : $program->archive_name_en;
                        @endphp
                        <h4>{{$cropped}}</h4>
                        <p>To promote healthier diets and sustainable food systems that benefit people, communities, and the
                            planet through innovative nutrition solutions and evidence-based interventions.</p>


{{--                        <h4><a href="">{{$cropped}}</a></h4>--}}
{{--                        <div class="btn-box"><a href="">Read More<i class="flaticon-right-arrow"></i></a></div>--}}
                    </div>
                </div>

            @endforeach


            {{--<div class="col-lg-4">
                <div class="goal-card">
                    <div class="goal-image">
                        <img src="path/to/vision-image.jpg" alt="Vision">
                    </div>
                    <h4>Vision</h4>
                    <p>A world where everyone has access to nutritious, affordable, and sustainable food choices that
                        support optimal health and well-being for all.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="goal-card">
                    <div class="goal-image">
                        <img src="path/to/values-image.jpg" alt="Core Values">
                    </div>
                    <h4>Core Values</h4>
                    <p>Integrity, sustainability, innovation, and unwavering commitment to improving global nutrition
                        standards and creating lasting positive change.</p>
                </div>
            </div>--}}
        </div>
    </div>
</section>


@push('styles')
    <style>
        /* Goals Section */
        .goals-section {
            background: var(--light-pink);
            padding: 100px 0;
        }

        .goal-card {
            background: white;
            border-radius: 20px;
            padding: 3rem 2rem;
            text-align: center;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .goal-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(45deg, var(--primary-color), #e02e4a);
        }

        .goal-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
        }

        .goal-image {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(45deg, var(--primary-color), #e02e4a);
            padding: 2px;
        }

        .goal-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            background: white;
        }

        .goal-card h4 {
            font-size: 1.6rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--text-dark);
        }

        .goal-card p {
            color: var(--text-muted);
            font-size: 1rem;
            line-height: 1.7;
        }
    </style>@endpush