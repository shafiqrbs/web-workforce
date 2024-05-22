<!--Footer-->
{{--<div class="largebanner shadow3">
<div class="adin">
{!! $siteSetting->above_footer_ad !!}
</div>
<div class="clearfix"></div>
</div>--}}


<div class="footerWrap"> 
    <div class="container">
        <div class="row"> 

            <!--Quick Links-->
            <div class="col-md-3 col-sm-3">
                <!--Quick Links menu Start-->
                <a href="#" class="btn red">FAQ's</a>
                <a href="#" class="btn red">Reviews</a>
            </div>
            <!--Quick Links menu end-->

            <div class="col-md-6 col-sm-6">
                <h5 class="text-center">{{__('Realtime jobseeker profile count (by Province)')}}</h5>
                <div class="form-row pt-2">
                    <div class="form-group col-2">
                        <input type="email" class="form-control" placeholder="B.S.">
                    </div>
                    <div class="form-group col-2">
                        <input type="password" class="form-control"  placeholder="Alta.">
                    </div>
                    <div class="form-group col-2">
                        <input type="password" class="form-control"  placeholder="Sask.">
                    </div>
                    <div class="form-group col-2">

                        <input type="password" class="form-control"  placeholder="Man.">
                    </div>
                    <div class="form-group col-2">

                        <input type="password" class="form-control"  placeholder="Ont.">
                    </div>
                    <div class="form-group col-2">
                        <input type="password" class="form-control"  placeholder="Que.">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-2">
                        <input type="email" class="form-control" placeholder="N.B.">
                    </div>
                    <div class="form-group col-2">
                        <input type="password" class="form-control"  placeholder="P.E.I">
                    </div>
                    <div class="form-group col-2">
                        <input type="password" class="form-control"  placeholder="N.S.">
                    </div>
                    <div class="form-group col-2">

                        <input type="password" class="form-control"  placeholder="N.L.">
                    </div>
                    <div class="form-group col-2">
                        <input type="password" class="form-control"  placeholder="Y.T.">
                    </div>
                    <div class="form-group col-2">
                        <input type="password" class="form-control"  placeholder="N.W.T.">
                    </div>
                </div>
            </div>

            <!--Jobs By Industry-->
            {{--<div class="col-md-3 col-sm-6">
                <h5>{{__('Jobs By Industry')}}</h5>
                <!--Industry menu Start-->
                <ul class="quicklinks">
                    @php
                    $industries = App\Industry::getUsingIndustries(10);
                    @endphp
                    @foreach($industries as $industry)
                    <li><a href="{{ route('job.list', ['industry_id[]'=>$industry->industry_id]) }}">{{$industry->industry}}</a></li>
                    @endforeach
                </ul>
                <!--Industry menu End-->
                <div class="clear"></div>
            </div>--}}

            <!--About Us-->
            <div class="col-md-3 col-sm-12">
                <h5>Follow us on: </h5>
                <!-- Social Icons -->
                <div class="social">@include('includes.footer_social')</div>
                <!-- Social Icons end --> 

            </div>
            <!--About us End--> 


        </div>
    </div>
</div>
<!--Footer end--> 
<!--Copyright-->
<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="bttxt">{{__('Copyright')}} &copy; {{date('Y')}} {{ $siteSetting->site_name }}. {{__('All Rights Reserved')}}. {{__('Design by')}}: <a href="http://rightbrainsolution.com" >Right Brain Solution</a></div>
            </div>
            <div class="col-md-4">
                <div class="paylogos">
                    <a href="#" class="btn red">Site map</a>
                    <a href="#" class="btn red">Terms of use</a>
                    <a href="#" class="btn red">Privacy Policy</a>
                </div>
            </div>
        </div>

    </div>
</div>
