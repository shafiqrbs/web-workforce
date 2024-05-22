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
                    <li><a href="{{route('arms')}}">{{$pageTitle}}</a></li>
                    @if($pathPageTitle)
                        <li><a href="">{{$pathPageTitle}}</a></li>
                    @endif
                    @if($armsData['name'])
                        <li>{{$armsData['name']}}</li>
                    @endif
                </ul>
            </div>
        </div>
    </section>

    <!-- Athelete details start -->
    <section class="solutions-section">
        <figure class="image-layer custom-image-layer">
            @if($img=$armsData['arms_image'])
                {{ ImgUploader::print_image("arms/mid/$img") }}
            @else
                <img src="{{asset('assets/no-image.jpeg')}}" alt="">
            @endif
        </figure>
        <div class="auto-container">
            <div class="sec-title centred">
                <h6><i class="flaticon-star"></i><span>{{$armsData['name']}}</span><i class="flaticon-star"></i></h6>
                <h2>{{$pageTitle.' '.$pathPageTitle}}</h2>
                <div class="title-shape"></div>
            </div>
            <div class="inner-container">
                <div class="upper-box clearfix">
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.bullet_size')}}</h4>
                            <p>{{$armsData['bullet_size']}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.quantity')}}</h4>
                            <p>{{$armsData['quantity']}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.max_velocity')}}</h4>
                            <p>{{$armsData['max_velocity']}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.overall_length')}}</h4>
                            <p>{{$armsData['overall_length']}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.buttplate')}}</h4>
                            <p>{{$armsData['buttplate']}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.function')}}</h4>
                            <p>{{$armsData['function']}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.weight')}}</h4>
                            <p>{{$armsData['weight']}}</p>
                        </div>
                    </div>
                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.trigger_pull')}}</h4>
                            <p>{{$armsData['trigger_pull']}}</p>
                        </div>
                    </div>

                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.scopeable')}}</h4>
                            <p>{{$armsData['scopeable']}}</p>
                        </div>
                    </div>

                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.safety')}}</h4>
                            <p>{{$armsData['safety']}}</p>
                        </div>
                    </div>

                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.suggested_for')}}</h4>
                            <p>{{$armsData['suggested_for']}}</p>
                        </div>
                    </div>

                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.Caliber')}}</h4>
                            <p>{{$armsData['Caliber']}}</p>
                        </div>
                    </div>

                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.muzzle_energy')}}</h4>
                            <p>{{$armsData['muzzle_energy']}}</p>
                        </div>
                    </div>

                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.loudness')}}</h4>
                            <p>{{$armsData['loudness']}}</p>
                        </div>
                    </div>

                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.barrel_length')}}</h4>
                            <p>{{$armsData['barrel_length']}}</p>
                        </div>
                    </div>

                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.shot_capacity')}}</h4>
                            <p>{{$armsData['shot_capacity']}}</p>
                        </div>
                    </div>

                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.barrel')}}</h4>
                            <p>{{$armsData['barrel']}}</p>
                        </div>
                    </div>

                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.front_sight')}}</h4>
                            <p>{{$armsData['front_sight']}}</p>
                        </div>
                    </div>

                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.rear_sight')}}</h4>
                            <p>{{$armsData['rear_sight']}}</p>
                        </div>
                    </div>

                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.trigger')}}</h4>
                            <p>{{$armsData['trigger']}}</p>
                        </div>
                    </div>

                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.power_plant')}}</h4>
                            <p>{{$armsData['power_plant']}}</p>
                        </div>
                    </div>

                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.max_shots_per_fill')}}</h4>
                            <p>{{$armsData['max_shots_per_fill']}}</p>
                        </div>
                    </div>

                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.operating_pressuer')}}</h4>
                            <p>{{$armsData['operating_pressuer']}}</p>
                        </div>
                    </div>

                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.body_type')}}</h4>
                            <p>{{$armsData['body_type']}}</p>
                        </div>
                    </div>

                    <div class="solution-block-one">
                        <div class="inner-box">
                            <div class="icon-box"><i class="flaticon-click"></i></div>
                            <h4>{{__('messages.fixed_adj_power')}}</h4>
                            <p>{{$armsData['fixed_adj_power']}}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Athelete details end -->

    <!-- testimonial-section -->
{{--    <section class="testimonial-section centred" style="background-image: url(assets/images/background/testimonial-bg.jpg);">--}}
    <section class="testimonial-section centred">
        <h2 class="related-Athletes-title">{{__('messages.Related_Arms')}}</h2>

        <div class="auto-container">

            <div class="three-item-carousel owl-carousel owl-theme owl-dots-none owl-nav-none">
                @foreach($relatedArms as $related)
                    <a href="{{route('arms_details',$related['id'])}}">
                <div class="testimonial-block-one">
                    <div class="inner-box">
                        <figure class="image-box custom-image-box">
                            @if($img=$related['arms_image'])
                                {{ ImgUploader::print_image("arms/mid/$img") }}
                            @else
                                <img src="{{asset('assets/no-image.jpeg')}}" alt="">
                            @endif
                        </figure>

                        <div class="author-box">
                            <h4>{{$related['name']}}</h4>
{{--                            <span class="designation">{{$related['max_velocity']}}</span>--}}
                        </div>
                    </div>
                </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    <!-- testimonial-section end -->

    {{--@include('includes.footer_social')--}}
@endsection

@push('styles')

@endpush
