@extends('layouts.app')
@section('content')


    <!-- Page Title -->
    @if(isset($gallery) && !empty($gallery))
        <section class="page-title" style="background-image: url({{asset('photo_gallery/'.$gallery->cover_image)}});background-size: cover;">
    @else
        <section class="page-title" style="background-image: url({{asset('banner/no-image.jpg')}});">
    @endif
        <div class="auto-container">
            <div class="content-box">
                <div class="title centred">
                    <h1>{{$gallery->name}}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Title -->


    <!-- event-details -->
    <section class="event-details">
        <div class="auto-container">
            <div class="event-info">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 single-column">
                        <div class="single-item">
                            <div class="icon-box"><i class="flaticon-gps"></i></div>
                            <h4 class="event-details-title">{{count($gallery->photoGalleryImages)}}</h4>
                            <ul class="list clearfix">
                                <li style="text-align: center"><i class="flaticon-gps"></i>Total Photos</li>
                            </ul>
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-6 col-sm-12 single-column">
                        <div class="single-item">
                            <div class="icon-box"><i class="fas fa-user-hard-hat"></i></div>
                            <h4 class="event-details-title">{{date('D-M-Y',strtotime($gallery->created_at))}}</h4>
                            <ul class="list clearfix">
                                <li style="text-align: center"><i class="fas fa-user-hard-hat"></i>Date</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="overview-box" style="padding-bottom: 0px !important;">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-column">
                        <div class="text">
                            <div class="group-title">
                                <h3>Gallery Overview</h3>
                                <div class="title-shape"></div>
                            </div>
                            <p style="text-align: justify"> {{$gallery->description}} </p>
                        </div>
                    </div>

                    @if(count($gallery->photoGalleryImages)>0)
                        @foreach($gallery->photoGalleryImages as $photo)
                            <div class="col-lg-4 col-md-6 col-sm-12 schedule-block">

                                <div class="schedule-block-one" style="margin-bottom: 10px;">

                                    <div class="inner-box">

{{--                                        <div class="image-box">--}}
                                        <div class="image-box" style="padding-right: 0px;">
                                            <a href="{{asset('photo_gallery/'.$photo->gallery_image)}}" data-title="{{$photo->caption}}" data-toggle="lightbox" data-gallery="example-gallery">
                                            <figure class="image">
                                                @if($img=$photo->gallery_image)
                                                        <img src="{{asset('photo_gallery/mid/'.$img)}}" alt="" class="img-fluid">
                                                @else
                                                    <img src="{{asset('assets/no-image.jpeg')}}" alt="">
                                                @endif
                                            </figure>
                                            </a>

                                            <div class="content-box">
{{--                                                <div class="post-date"><h3>{{date('d',strtotime($photo->created_at))}}<span>{{date('M',strtotime($photo->created_at))}}’{{date('y',strtotime($photo->created_at))}}</span></h3></div>--}}
                                                <div class="text">
                                                    @php
                                                        $name = strip_tags($photo->caption);
                                                        if (strlen($name) > 25) {
                                                            $stringCut = substr($name, 0, 25);
                                                            $endPoint = strrpos($stringCut, ' ');
                                                            $name = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                            $name .= '...';
                                                        }
                                                    @endphp
                                                    @if($name)
                                                    <h4><a href="{{route('gallery_details',$photo->id)}}">{{$name}}</a></h4>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- event-details end -->


@endsection

@push('styles')
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" integrity="sha512-Velp0ebMKjcd9RiCoaHhLXkR1sFoCCWXNp6w4zj1hfMifYB5441C+sKeBl/T/Ka6NjBiRfBBQRaQq65ekYz3UQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('scripts')
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js" integrity="sha512-Y2IiVZeaBwXG1wSV7f13plqlmFOx8MdjuHyYFVoYzhyRr3nH/NMDjTBSswijzADdNzMyWNetbLMfOpIPl6Cv9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

                    <script>
                        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                            event.preventDefault();
                            $(this).ekkoLightbox();
                        });
                    </script>
@endpush
