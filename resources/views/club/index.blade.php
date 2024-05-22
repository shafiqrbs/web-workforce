@extends('layouts.app')
@section('content')

    @if(isset($bannerData) && !empty($bannerData))
        <section class="page-title" style="background-image: url({{asset('banner/'.$bannerData->banner_image)}});">
    @else
       <section class="page-title" style="background-image: url({{asset('banner/no-image.jpg')}});">
    @endif
        <div class="auto-container">
            <div class="content-box">
                <div class="title centred">
                    @if(isset($bannerData) && !empty($bannerData))
                        <h1>{{$bannerData->banner_title}}</h1>
                    @else
                        <h1>No Banner title</h1>
                    @endif
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{url('/')}}">{{__('messages.Home')}}</a></li>
                    <li>
                        @if(isset($pathPageTitle) && !empty($pathPageTitle))
                            <a href="{{route('club_find')}}">
                        @endif
                        {{$pageTitle}}
                        @if(isset($pathPageTitle) && !empty($pathPageTitle))
                                </a>
                        @endif
                    </li>
                    @if(isset($pathPageTitle) && !empty($pathPageTitle))
                        <li>{{$pathPageTitle}}</li>
                    @endif
                    @if(isset($subPathPageTitle) && !empty($subPathPageTitle))
                        <li>{{$subPathPageTitle}}</li>
                    @endif

                </ul>
            </div>
        </div>
    </section>

    <section class="contact-style-two sec-pad custom-section-pad">
        <div class="auto-container">
            <div class="form-inner custom-form-inner-padding">
                <div class="sec-title centred">
                    <h3 class="header-color"><i class="flaticon-star"></i><span>{{$pageTitle}}</span><i
                                class="flaticon-star"></i></h3>
                </div>

                    {!! Form::open(array('method' => 'get', 'route' => 'club_find', 'files'=>true,'id'=>'contact-form','class'=>'default-form','novalidate'=>'novalidate')) !!}
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 big-column">
                            <div class="form-group">
                                {!! Form::label('division_id', __('messages.Division'), ['class' => 'bold']) !!}
                                {!! Form::select('division_id',$divisions,$divisionID, array('class'=>'form-control ignore js-example-basic-single', 'id'=>'division_id','required'=>'true','placeholder'=>__('messages.Choose_Division'))) !!}
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 big-column">
                            <div class="message-btn">
                                <button class="theme-btn custom-search-button" type="submit" name="submit-form" value="club-search">{{__('messages.Find')}}</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
            </div>


                <div class="row">
                    <div class="col-md-12">
                        <h5 class="club-found-message">{{$message}}</h5>
                    </div>
                    @if($clubData)
                    @foreach($clubData as $value)
                        <div class="col-md-3">
                            <div class="explore-block-two margin-bottom-50">
                                <div class="inner-box">
                                    <figure class="image-box">
                                        @if($img=$value['club_logo'])
                                            {{ ImgUploader::print_image("club/mid/$img") }}
                                        @else
                                            <img src="{{asset('assets/no-image.jpeg')}}" alt="" width="270" height="270">
                                        @endif
                                    </figure>
                                    <div class="content-box">
                                        <h4 class="text-center">{{$value['name']}}</h4>
                                    </div>
                                    <a href="{{route('club_details',$value['id'])}}">
                                        <div class="overlay-content">
                                            <p class="text-center">{{$value['name']}}</p>
                                            <div class="text">
                                                <h4 class="text-center">{{$value['address']}}</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endif
                </div>
        </div>
    </section>



@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
                    <style>
                        .select2-container--default .select2-selection--single .select2-selection__rendered {
                            font-size: 15px !important;
                        }
                    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush
