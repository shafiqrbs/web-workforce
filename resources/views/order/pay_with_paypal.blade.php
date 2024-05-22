@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end -->

@include('includes.employer_tab')

<section id="dashboard">
    <div class="container">
        <div class="imr">
            <div class="im-12">
                <div class="dashboard-inner">
                    @include('flash::message')
                    @include('includes.employer_dashboard_menu')

                    <div class="dashboard-tab-content">


                        <div class="profile-main">

                            <div class="jobseeker-form">
                                <div class="form-items">

                                    <div class="main-body">
                                        @if($package)

                                            @php
                                                $now = time();
                                                $startDate = strtotime($user->package_start_date);
                                                $endDate = strtotime($user->package_end_date);
                                                $datediff = 0;
                                                if ($endDate>$now){
                                                $datediff = $now - $startDate;
                                                }
                                                $diffDay = round($datediff / (60 * 60 * 24));
                                            @endphp

                                            <h4>Package Name: {{$package->package_title}}</h4>
                                            {{--<input type="hidden" class="added_no_of_users" value="{{$subUsers?($subUsers+1):0}}">--}}
                                            <input type="hidden" class="added_package_price" value="{{$endDate>$now?$package->package_price:0}}">
                                            <input type="hidden" class="package_num_days" value="{{$endDate>$now?$package->package_num_days:0}}">
                                            <input type="hidden" class="used_amount" value="{{$diffDay>0?number_format(($package->package_price/$package->package_num_days)*$diffDay,'2','.',''):0}}">



                                            <h4>Package Expires On: {{$user->package_end_date?$user->package_end_date->format('M d, Y'):""}}</h4>
                                        @endif

                                            {{--<table id="resume">
                                                <thead>
                                                    <tr>
                                                        <th width="16%" style="background: #E0E4E5;">No of Users</th>
                                                        <th width="18%" style="background: #E0E4E5;">No of Months</th>
                                                        <th width="23%" style="background: #E0E4E5;">Payment Amount</th>
                                                        <th width="23%" style="background: #E0E4E5;">From Access Date</th>
                                                        <th width="20%" style="background: #E0E4E5;">To Access Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{$package->package_num_listings}}</td>
                                                        <td>{{$package->package_num_days / 30}}</td>
                                                        <td>${{$package->package_price}}</td>
                                                        <td>{{$user->package_start_date?$user->package_start_date->format('M d, Y'):""}}</td>
                                                        <td>{{$user->package_end_date?$user->package_end_date->format('M d, Y'):""}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <h3 style="text-align: center; padding: 10px 0px;">Payment History</h3>--}}


                                            <ul class="nav nav-tabs pt-4" id="packageTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="renew-tab" data-toggle="tab" href="#renew" role="tab" aria-controls="renew" aria-selected="false">Renew</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="upgrade-tab" data-toggle="tab" href="#upgrade" role="tab" aria-controls="home" aria-selected="true">Change Package</a>
                                                </li>

                                            </ul>
                                            <div class="tab-content" id="employerTabContent">
                                                <div class="tab-pane fade show active" id="renew" role="tabpanel" aria-labelledby="renew-tab">

                                                    @if(isset($packages))
                                                        <div class="jobseeker-inner" style="padding-left: 25px; padding-right: 25px">
                                                            <form id="renewPackageForm" name="package_renew_form" method="POST" action="" enctype="multipart/form-data" >
                                                                {{ csrf_field() }}
                                                                <input type="hidden" class="package_id" value="" name="package_id">
                                                                <input type="hidden" class="payment_for" value="renew" name="payment_for">
                                                                <div class="form-step step-one">
                                                                    <div class="single-input">
                                                                        <label for="noOfUsers">No. of Users</label>
                                                                        <select class="noOfUsers" name="noOfUsers" id="noOfUsers">
                                                                            <option value="{{(int)auth()->user()->jobs_quota}}">
                                                                                @if(auth()->user()->jobs_quota==1)
                                                                                One User
                                                                                @elseif(auth()->user()->jobs_quota==2)
                                                                                Two Users
                                                                                @elseif(auth()->user()->jobs_quota==3)
                                                                                Three Users
                                                                                @elseif(auth()->user()->jobs_quota==4)
                                                                                Four Users
                                                                                @endif
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="single-input">
                                                                        <label for="freeForMonth">No. of Months</label>
                                                                        <select class="freeForMonth" name="freeForMonth" id="freeForMonth">
                                                                            <option value="">Choose No. of Months</option>
                                                                            <option value="30" {{$package && (int)$package->package_num_days==30?'selected="selected"':''}}>One Month</option>
                                                                            <option value="90" {{$package && (int)$package->package_num_days==90?'selected="selected"':''}}>Three Months</option>
                                                                            <option value="180" {{$package && (int)$package->package_num_days==180?'selected="selected"':''}}>Six Months</option>
                                                                            <option value="365" {{$package && (int)$package->package_num_days==365?'selected="selected"':''}}>Twelve Months</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="alert_message"></div>
                                                                    <div class="row" style="width: 100%">
                                                                        <div class="col-md-12">
                                                                            <h4>Amount: <span class="package_amount"></span></h4>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="single-input">
                                                                        <p>Package Effective Date: <span class="package_effective_date"></span></p>
                                                                    </div>
                                                                    <div class="single-input">
                                                                        <p>Package Expired Date: <span class="package_expired_date"></span></p>
                                                                    </div>
                                                                    {{--<div class="single-submit-button">
                                                                        <input type="submit" {{auth()->user()->package_end_date && auth()->user()->package_end_date>date('Y-m-d H:i:s')?'disabled':''}}  value="Renew Package">
                                                                    </div>--}}

                                                                </div>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="tab-pane fade" id="upgrade" role="tabpanel" aria-labelledby="upgrade-tab">
                                                    @if(isset($packages))
                                                        <div class="jobseeker-inner" style="padding-left: 25px; padding-right: 25px">
                                                            <form id="upgradePackageForm" name="package_upgrade_form" method="POST" enctype="multipart/form-data" >
                                                                {{ csrf_field() }}
                                                                <input type="hidden" class="package_id" value="" name="package_id">
                                                                <input type="hidden" class="payment_for" value="upgrade" name="payment_for">
                                                                <div class="form-step step-one">
                                                                    <div class="single-input">
                                                                        <label for="noOfUsers">No. of Users</label>
                                                                        <select class="noOfUsers" name="noOfUsers" id="noOfUsers">
                                                                            <option value="">Choose No. of Users</option>
                                                                            <option value="1" {{auth()->user()->jobs_quota&&(int)auth()->user()->jobs_quota==1?'selected="selected"':''}}>One User</option>
                                                                            <option value="2" {{auth()->user()->jobs_quota&&(int)auth()->user()->jobs_quota==2?'selected="selected"':''}}>Two Users</option>
                                                                            <option value="3" {{auth()->user()->jobs_quota&&(int)auth()->user()->jobs_quota==3?'selected="selected"':''}}>Three Users</option>
                                                                            <option value="4" {{auth()->user()->jobs_quota&&(int)auth()->user()->jobs_quota==4?'selected="selected"':''}}>Four Users</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="single-input">
                                                                        <label for="freeForMonth">No. of Months</label>
                                                                        <select class="freeForMonth" name="freeForMonth" id="freeForMonth">
                                                                            <option value="">Choose No. of Months</option>
                                                                            <option value="30" {{$package && (int)$package->package_num_days==30?'selected="selected"':''}}>One Month</option>
                                                                            <option value="90" {{$package && (int)$package->package_num_days==90?'selected="selected"':''}}>Three Months</option>
                                                                            <option value="180" {{$package && (int)$package->package_num_days==180?'selected="selected"':''}}>Six Months</option>
                                                                            <option value="365" {{$package && (int)$package->package_num_days==365?'selected="selected"':''}}>Twelve Months</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="alert_message"></div>
                                                                    <p>Package Value: <span class="package_amount"></span></p>
                                                                    <br/>
                                                                    <p>Prorated (Credit): <span class="prorated_amount"></span></p>
                                                                    <br/>
                                                                    <p>Remaining (Due): <span class="remaining_amount"></span></p>
                                                                    <br>
                                                                        <div class="single-input">
                                                                            <p>Package Effective Date: <span class="package_effective_date"></span></p>
                                                                        </div>
                                                                        <div class="single-input">
                                                                            <p>Package Expired Date: <span class="package_expired_date"></span></p>
                                                                        </div>
                                                                    {{--<div class="single-submit-button">
                                                                        <input type="submit" class="upgrade_package" value="Upgrade Package">
                                                                    </div>--}}

                                                                </div>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                             <div style="display: none" id="paypal-button-container"></div>

                                            <table id="resume" style="margin-top: 50px;">
                                                <thead>
                                                <tr>
                                                    <th width="16%" style="background: #E0E4E5;">No of Users</th>
                                                    <th width="18%" style="background: #E0E4E5;">No of Months</th>
                                                    <th width="23%" style="background: #E0E4E5;">Payment Amount</th>
                                                    <th width="23%" style="background: #E0E4E5;">From Access Date</th>
                                                    <th width="20%" style="background: #E0E4E5;">To Access Date</th>
                                                    <th width="20%" style="background: #E0E4E5;">Payment For</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($paymentHistory as $item)
                                                    <tr>
                                                        <td>{{$item->package_num_listings}}</td>
                                                        <td>{{number_format(($item->package_num_days / 30),0)}}</td>
                                                        <td>${{$item->total_amount}}</td>
                                                        <td>{{date('M d, Y', strtotime($item->package_start_date)) }}</td>
                                                        <td>{{date('M d, Y', strtotime($item->package_end_date)) }}</td>
                                                        <td>{{$item->payment_for}}</td>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                                <section id="table-wrapper">
                                                    <div class="imr">
                                                        <div class="im-12">
                                                            <div class="">
                                                                <div class="schedule">
                                                                    <table style="font-size: 14px; width: 100%" cellspacing="0">
                                                                        <tbody>
                                                                        <tr>
                                                                            <th class="red">No. of users</th>
                                                                            <th class="malta">Fee for one month</th>
                                                                            <th class="sky">Fee for three months</th>
                                                                            <th class="yellow">Fee for six months</th>
                                                                            <th class="blue">Fee for twelve months</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width: 120px;">1</td>
                                                                            <td style="width: 127px;">$99</td>
                                                                            <td style="width: 144px;">$250<br>Save $47</td>
                                                                            <td style="width: 129px;">$525<br>Save $69</td>
                                                                            <td style="width: 167px;">$1088<br>Save $100</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width: 120px;">2</td>
                                                                            <td style="width: 127px;">$175</td>
                                                                            <td style="width: 144px;">$450<br>Save $75</td>
                                                                            <td style="width: 129px;">$950<br>Save $100</td>
                                                                            <td style="width: 167px;">$1900<br>Save $200</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width: 120px;">3</td>
                                                                            <td style="width: 127px;">$225</td>
                                                                            <td style="width: 144px;">$575<br>Save $100</td>
                                                                            <td style="width: 129px;">$1200<br>Save $150</td>
                                                                            <td style="width: 167px;">$2400<br>Save $300</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width: 120px;">4</td>
                                                                            <td style="width: 127px;">$325</td>
                                                                            <td style="width: 144px;">$850<br>Save $125</td>
                                                                            <td style="width: 129px;">$1750<br>Save $200</td>
                                                                            <td style="width: 167px;">$3500<br>Save $400</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                    </div>


                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@include('includes.footer_social')
@endsection
@push('styles')
        <link href="{{asset('/')}}css/custom-bootstrap.min.css" rel="stylesheet">
<style type="text/css">
    .userccount p{ text-align:left !important;}
</style>
@endpush
@push('scripts')

       <script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_CLIENT_ID')}}"></script>

       <script>
        $(document).ready(function(){
            $('select').on('change', function () {
                var element = $(this);
                var used_amount = $('.used_amount').val();
                var added_package_price = $('.added_package_price').val();
                var noOfUsers = $(element).closest('form').find('.noOfUsers').val();
                var freeForMonth = $(element).closest('form').find('.freeForMonth').val();

                var paymentFor = $(element).closest('form').find('.payment_for').val();


                if(noOfUsers && freeForMonth){
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('ajax.employee.packages.user.month') }}',
                        dataType:'json',
                        data: {
                            noOfUsers:noOfUsers,
                            freeForMonth:freeForMonth,
                            paymentFor:paymentFor,
                            _token: '{{csrf_token()}}'
                        },
                        success: function (data) {
                            if(data.status==200){
                                var packageAmount = data.package_amount;
                                var prorated_amount = added_package_price-used_amount;
                                var remaining_amount = packageAmount-prorated_amount;
                                var paymentFor = $('#employerTabContent').find('.active').find('.payment_for').val();
                                if(remaining_amount<=0 && paymentFor=='upgrade'){
                                    $(element).closest('form').find('.package_effective_date').text('');
                                    $(element).closest('form').find('.package_expired_date').text('');
                                    $(element).closest('form').find('.package_amount').text('');
                                    $(element).closest('form').find('.prorated_amount').text('');
                                    $(element).closest('form').find('.remaining_amount').text('');
                                    $(element).closest('form').find('.package_id').val('');
                                    $('.upgrade_package').prop('disabled',true);

                                }else if(packageAmount<=0  && paymentFor=='renew'){
                                    $(element).closest('form').find('.package_effective_date').text('');
                                    $(element).closest('form').find('.package_expired_date').text('');
                                    $(element).closest('form').find('.package_amount').text('');
                                    $(element).closest('form').find('.prorated_amount').text('');
                                    $(element).closest('form').find('.remaining_amount').text('');
                                    $(element).closest('form').find('.package_id').val('');
                                    $('.upgrade_package').prop('disabled',true);
                                }else {
                                    $(element).closest('form').find('.package_effective_date').text(data.package_effective_date);
                                    $(element).closest('form').find('.package_expired_date').text(data.package_expired_date);
                                    $(element).closest('form').find('.package_amount').text('$'+ packageAmount);
                                    $(element).closest('form').find('.prorated_amount').text('$'+ parseFloat(prorated_amount).toFixed(2));
                                    $(element).closest('form').find('.remaining_amount').text('$'+ parseFloat(remaining_amount).toFixed(2));
                                    $(element).closest('form').find('.package_id').val(data.package_id);
                                    $('.upgrade_package').prop('disabled',false);
                                }
                            }else {
                                $('.package_amount').text("");
                                $('.package_id').val("");
                            }

                        }
                    });
                }else {
                    $('.package_amount').text("");
                    $('.package_id').val("");
                }



            }).change();

            $('.nav-tabs li').click(function () {
                $('select').on('change', function () {
                    var element = $(this);
                    var used_amount = $('.used_amount').val();
                    var added_package_price = $('.added_package_price').val();
                    var noOfUsers = $(element).closest('form').find('.noOfUsers').val();
                    var freeForMonth = $(element).closest('form').find('.freeForMonth').val();
                    var paymentFor = $(element).closest('form').find('.payment_for').val();

                    if(noOfUsers && freeForMonth){
                        $.ajax({
                            type: 'GET',
                            url: '{{ route('ajax.employee.packages.user.month') }}',
                            dataType:'json',
                            data: {
                                noOfUsers:noOfUsers,
                                freeForMonth:freeForMonth,
                                paymentFor:paymentFor,
                                _token: '{{csrf_token()}}'
                            },
                            success: function (data) {
                                if(data.status==200){
                                    var packageAmount = data.package_amount;
                                    var prorated_amount = added_package_price-used_amount;
                                    var remaining_amount = packageAmount-prorated_amount;
                                    var paymentFor = $('#employerTabContent').find('.active').find('.payment_for').val();
                                    if(remaining_amount<=0 && paymentFor=='upgrade'){
                                        $(element).closest('form').find('.package_effective_date').text('');
                                        $(element).closest('form').find('.package_expired_date').text('');
                                        $(element).closest('form').find('.package_amount').text('');
                                        $(element).closest('form').find('.prorated_amount').text('');
                                        $(element).closest('form').find('.remaining_amount').text('');
                                        $(element).closest('form').find('.package_id').val('');
                                        $('.upgrade_package').prop('disabled',true);

                                    }else if(packageAmount<=0  && paymentFor=='renew'){
                                        $(element).closest('form').find('.package_effective_date').text('');
                                        $(element).closest('form').find('.package_expired_date').text('');
                                        $(element).closest('form').find('.package_amount').text('');
                                        $(element).closest('form').find('.prorated_amount').text('');
                                        $(element).closest('form').find('.remaining_amount').text('');
                                        $(element).closest('form').find('.package_id').val('');
                                        $('.upgrade_package').prop('disabled',true);
                                    }else {
                                        $(element).closest('form').find('.package_effective_date').text(data.package_effective_date);
                                        $(element).closest('form').find('.package_expired_date').text(data.package_expired_date);
                                        $(element).closest('form').find('.package_amount').text('$'+ packageAmount);
                                        $(element).closest('form').find('.prorated_amount').text('$'+ parseFloat(prorated_amount).toFixed(2));
                                        $(element).closest('form').find('.remaining_amount').text('$'+ parseFloat(remaining_amount).toFixed(2));
                                        $(element).closest('form').find('.package_id').val(data.package_id);
                                        $('.upgrade_package').prop('disabled',false);
                                    }
                                }else {
                                    $('.package_amount').text("");
                                    $('.package_id').val("");
                                }

                            }
                        });
                    }else {
                        $('.package_amount').text("");
                        $('.package_id').val("");
                    }



                }).change();
            });

            paypal.Buttons({
                onInit: function(data, actions) {

                    $('#paypal-button-container').show();

                    actions.disable();

                    $('select').on('change', function () {
                        var element = $(this);
                        var used_amount = $('.used_amount').val();
                        var added_package_price = $('.added_package_price').val();
                        // var added_no_of_users = $('.added_no_of_users').val();
                        var noOfUsers = $(element).closest('form').find('.noOfUsers').val();
                        var freeForMonth = $(element).closest('form').find('.freeForMonth').val();
                        var paymentFor = $(element).closest('form').find('.payment_for').val();

                        if(noOfUsers && freeForMonth){
                            $.ajax({
                                type: 'GET',
                                url: '{{ route('ajax.employee.packages.user.month') }}',
                                dataType:'json',
                                data: {
                                    noOfUsers:noOfUsers,
                                    freeForMonth:freeForMonth,
                                    paymentFor:paymentFor,
                                    _token: '{{csrf_token()}}'
                                },
                                success: function (data) {
                                    $('.alert').remove();
                                    if(data.status==200){
                                        var packageAmount = data.package_amount;
                                        var prorated_amount = added_package_price-used_amount;
                                        var remaining_amount = packageAmount-prorated_amount;
                                        var paymentFor = $('#employerTabContent').find('.active').find('.payment_for').val();
                                        var package_id = data.package_id;
                                        if(!package_id){
                                            actions.disable();
                                            $('.alert_message').append('<div class="alert alert-danger" role="alert">Please select one package!</div>')

                                            return false;
                                        }else if(packageAmount<=0){
                                            actions.disable();
                                            $('.alert_message').append('<div class="alert alert-danger" role="alert">You are not eligible to choose a package which cost less than your current package. You must wait until your current package expires to choose this package.</div>')
                                            return false;
                                        }else if(remaining_amount<=0 && paymentFor=='upgrade'){
                                            actions.disable();
                                            $('.alert_message').append('<div class="alert alert-danger" role="alert">You are not eligible to choose a package which cost less than your current package. You must wait until your current package expires to choose this package.</div>')
                                            return false;
                                        }
                                        /*else if(remaining_amount>0 && paymentFor=='upgrade' && added_no_of_users>noOfUsers){
                                            actions.disable();
                                            $('.alert_message').append('<div class="alert alert-danger" role="alert">To get this package, you\'ve to reduce no. of users you added before.</div>');
                                            return false;
                                        }*/
                                        else if(packageAmount<=0 && paymentFor=='renew'){
                                            actions.disable();
                                            $('.alert_message').append('<div class="alert alert-danger" role="alert">You are not eligible to choose a package which cost less than your current package. You must wait until your current package expires to choose this package.</div>')
                                            return false;
                                        }else {
                                            actions.enable();

                                        }
                                    }else {
                                        actions.disable();
                                        return false;
                                    }

                                }
                            });
                        }else {
                            actions.disable();
                            return false;
                        }

                    }).change();

                   // Disable the buttons


                    // Listen for changes to the checkbox

                },

                // onClick is called when the button is clicked
                onClick: function(data, actions) {
                    $('.alert').remove();
                    // $('select').on('change', function () {
                    //     var element = $(this);
                        var used_amount = $('.used_amount').val();
                        var added_package_price = $('.added_package_price').val();
                        // var added_no_of_users = $('.added_no_of_users').val();
                        var noOfUsers = $('#employerTabContent').find('.active').find('.noOfUsers').val();
                        var freeForMonth = $('#employerTabContent').find('.active').find('.freeForMonth').val();
                        var paymentFor = $('#employerTabContent').find('.active').find('.payment_for').val();

                        if(noOfUsers && freeForMonth){
                            $.ajax({
                                type: 'GET',
                                url: '{{ route('ajax.employee.packages.user.month') }}',
                                dataType:'json',
                                data: {
                                    noOfUsers:noOfUsers,
                                    freeForMonth:freeForMonth,
                                    paymentFor:paymentFor,
                                    _token: '{{csrf_token()}}'
                                },
                                success: function (data) {
                                    $('.alert').remove();
                                    if(data.status==200){
                                        var packageAmount = data.package_amount;
                                        var prorated_amount = added_package_price-used_amount;
                                        var remaining_amount = packageAmount-prorated_amount;
                                        var paymentFor = $('#employerTabContent').find('.active').find('.payment_for').val();
                                        var package_id = data.package_id;
                                        if(!package_id){
                                            $('.alert_message').append('<div class="alert alert-danger" role="alert">Please select one package!</div>')

                                            return false;
                                        }else if(packageAmount<=0){
                                            $('.alert_message').append('<div class="alert alert-danger" role="alert">You are not eligible to choose a package which cost less than your current package. You must wait until your current package expires to choose this package.</div>')
                                            return false;
                                        }else if(remaining_amount<=0 && paymentFor=='upgrade'){
                                            $('.alert_message').append('<div class="alert alert-danger" role="alert">You are not eligible to choose a package which cost less than your current package. You must wait until your current package expires to choose this package.</div>')
                                            return false;
                                        }
                                        /*else if(remaining_amount>0 && paymentFor=='upgrade' && added_no_of_users>noOfUsers){
                                            $('.alert_message').append('<div class="alert alert-danger" role="alert">To get this package, you\'ve to reduce no. of users you added before.</div>');
                                            return false;
                                        }*/
                                        else if(packageAmount<=0 && paymentFor=='renew'){
                                            $('.alert_message').append('<div class="alert alert-danger" role="alert">You are not eligible to choose a package which cost less than your current package. You must wait until your current package expires to choose this package.</div>')
                                            return false;
                                        }else {
                                            return true;

                                        }
                                    }else {
                                        $('.alert_message').append('<div class="alert alert-danger" role="alert">Ops! Something wrong!.</div>');
                                        return false;
                                    }

                                }
                            });
                        }else {
                            return false;
                        }

                    // }).change();
                },
                // Call your server to set up the transaction
                createOrder: function(data, actions) {
                    var paymentFor = $('#employerTabContent').find('.active').find('.payment_for').val();
                    var _token = "{{ csrf_token() }}";
                    var package_id = $('#employerTabContent').find('.active').find('.package_id').val();
                    if(package_id==""){
                        return false;
                    }
                    var url = '/createorder/{{auth()->id()}}/'+package_id+'/'+paymentFor;
                    return fetch(url, {
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': _token,
                            'Content-Type': 'application/json',
                        },

                    }).then(function(res) {
                        return res.json();
                    }).then(function(orderData) {
                        return orderData.result.id;
                    });
                },
                // Call your server to finalize the transaction
                onApprove: function(data, actions) {
                    var _token = "{{ csrf_token() }}";

                    return fetch('/capture/order/' + data.orderID + '/capture', {
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': _token,
                            'Content-Type': 'application/json',
                        },
                    }).then(function(res) {
                        return res.json();
                    }).then(function(orderData) {
                        if(orderData.result.status=='COMPLETED'){
                            var redirect_url = "{{ route('employee.packages.list') }}";
                            window.location.href = redirect_url;
                        }

                    });
                }
            }).render('#paypal-button-container');
        });
    </script>

@endpush