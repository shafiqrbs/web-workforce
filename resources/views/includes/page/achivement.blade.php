<section class="auto-container">
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12 ">
            <div class="auto-container sec-pad pb-120">
                <div class="sec-title centred">
                    <h2>Our Partner and Stakeholder</h2>
                    <div class="title-shape"></div>
                </div>
                <div class="row clearfix">
                    @if(sizeof($achievements['financialPartnerGroup'])>0)
                        @foreach($achievements['financialPartnerGroup'] as $group)
                            <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                                <div class="funfact-block-one">
                                    <div class="inner-box">
                                        <div class="count-outer count-box counted">
                                            <span class="count-text" data-speed="1500" data-stop="{{$group['total'] ?? 0}}">{{$group['total'] ?? 0}}</span>
                                        </div>
                                        <h6>{{$group['partner_group'] ?? 'Workforce Nutrition Alliance Members Mens'}}</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach()
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
            <div class="department-sidebar">
                <div class="sidebar-banner centred">
                    <div class="inner-box">
                        <h3>OUR Beneficiaries</h3>
                    </div>
                </div>
                <div class="sidebar-category">
                    <div class="inner-box">
                        <div class="widget-content">
                            <ul class="category-list clearfix">
                                <li>
                                    <div class="icon-box"><i class="flaticon-police"></i></div>
                                    <h5><a href="{{route('financial_partner_details','male')}}">Male {{$achievements['totals']->total_male ?? 0}}</a></h5>
                                </li>
                                <li>
                                    <div class="icon-box"><i class="flaticon-traffic-sign"></i></div>
                                    <h5><a href="{{route('financial_partner_details','female')}}">Female {{$achievements['totals']->total_female ?? 0}}</a></h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>