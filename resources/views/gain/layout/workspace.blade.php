<section class="workspace-section" style="margin-top: 350px">
    <div class="container">
        <div class="workspace-content">
            <div class="workspace-text">
                <h2 class="workspace-title">Workforce Nutrition</h2>
{{--                <p>{{$aboutContent->page_title}}</p>--}}
{{--                <p>{{$aboutContent->page_sub_title}}</p>--}}
                <p><?php echo $aboutContent->page_content ; ?></p>
            </div>
            <div class="workspace-image">
{{--                <img style="width: 510px; height: 605px" src="{{asset('page_image/'.$aboutContent->image)}}" alt="">--}}
            </div>
        </div>
    </div>
</section>


@push('styles')
    <style>
        /* Workspace Section */
        .workspace-section {
            background: white;
            padding: 100px 0;
        }

        .workspace-content {
            display: flex;
            align-items: center;
            gap: 4rem;
        }

        .workspace-text {
            flex: 1;
            padding-right: 2rem;
        }

        .workspace-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 2rem;
        }

        .workspace-text p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }

        .workspace-image {
            flex: 1;
            height: 450px;
            background: url({{asset('page_image/'.$aboutContent->image)}});
            background-size: cover;
            background-position: center;
            border-radius: 20px;
            position: relative;
        }

        .workspace-image::after {
            content: '';
            position: absolute;
            top: 20px;
            right: 20px;
            bottom: 20px;
            left: 20px;
            border: 3px solid var(--primary-color);
            border-radius: 15px;
        }
    </style>
@endpush

