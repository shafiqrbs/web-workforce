<div class="section testimonialwrap">
    <div class="container">
        <!-- title start -->
        <div class="titleTop">
{{--            <div class="subtitle">{{__('Testimonials')}}</div>--}}
            {{--<h3>{{__('Success')}} <span>{{__('Stories')}}</span></h3>--}}
        </div>
        <!-- title end -->

        <ul class="testimonialsList owl-carousel">
            @if(isset($testimonials) && count($testimonials))
                @foreach($testimonials as $testimonial)
                    <li class="item">
                        <div class="ratinguser" data-rating-stars="5"
                             data-rating-readonly="true"
                             data-rating-value="{{$testimonial->rating}}"
                             data-rating-input="#dataReadonlyInput">
                        </div>
                        <div class="clientname">{{$testimonial->testimonial_by}}</div>
{{--                        <div class="clientinfo">{{$testimonial->company}}</div>--}}
                        <p>"{{$testimonial->testimonial}}"</p>

                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>