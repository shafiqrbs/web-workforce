@extends('layouts.app')
@section('content')
    @include('includes.header')
    @include('includes.inner_page_title')

    <section id="title">
        <div class="title-inner">
            <div class="container">
                <div class="imr">
                    <div class="im-12">
                        <div class="title">
                            <h2>Packages</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class=" white yellow" id="jobseeker">
        <div class="container">
            <div class="imr">
                <div class="im-12">
                    <div class="jobseeker-form">
                        <div class="form-items">

                            <div class="main-body">

                                @if(isset($packages))
                                    <div class="jobseeker-inner">
                                        <form id="paymentForm" name="package_purchase_form" method="POST" action="" enctype="multipart/form-data" >
                                            {{ csrf_field() }}
                                            <input type="hidden" class="package_id" value="" name="package_id">
                                            <input type="hidden" class="payment_for" value="new" name="payment_for">
                                            <div class="form-step step-one">
                                                <div class="single-input">
                                                    <label for="noOfUsers">No. of Users</label>
                                                    <select class="noOfUsers" name="noOfUsers" id="noOfUsers">
                                                        <option value="">Choose No. of Users</option>
                                                        <option value="1">One User</option>
                                                        <option value="2">Two Users</option>
                                                        <option value="3">Three Users</option>
                                                        <option value="4">Four Users</option>
                                                    </select>
                                                </div>
                                                <div class="single-input">
                                                    <label for="freeForMonth">No. of Months</label>
                                                    <select class="freeForMonth" name="freeForMonth" id="freeForMonth">
                                                        <option value="">Choose No. of Months</option>
                                                        <option value="30">One Month</option>
                                                        <option value="90">Three Months</option>
                                                        <option value="180">Six Months</option>
                                                        <option value="365">Twelve Months</option>
                                                    </select>
                                                </div>
                                                <h4>Amount: <span class="package_amount"></span></h4>
                                                {{--<div class="single-submit-button">
                                                    <input type="submit" value="Add Package">
                                                </div>--}}

                                            </div>
                                        </form>
                                    </div>

                                    <div style="display: none" id="paypal-button-container"></div>
                                @endif
                                <section id="table-wrapper">
                                    <div class="imr">
                                        <div class="im-12">
                                            <div class="">
                                                <div class="schedule">
                                                    <table width="100%" style="font-size: 14px;" cellspacing="0">
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

    </section>



    @include('includes.footer_social')
@endsection
@push('styles')

    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}
    <link href="{{asset('/')}}css/custom-bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
        .formrow iframe {
            height: 78px;
        }
        .default-btn{
            background: #ffcb32; font-weight: bold;
        }

        .modal{
            display: none;
        }
        .termsModal{
            text-align: justify;
            padding: 30px;
            line-height: 30px;
            font-size: 16px;
            height: 70vh;
            overflow-y: scroll;
        }
    </style>
@endpush


@push('scripts')
    <script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_CLIENT_ID')}}"></script>
    <script type="text/javascript">
        $('select').on('change', function () {
            var noOfUsers = $('.noOfUsers').val();
            var freeForMonth = $('.freeForMonth').val();

            if(noOfUsers && freeForMonth){
                $.ajax({
                    type: 'GET',
                    url: '{{ route('ajax.employee.packages.user.month') }}',
                    dataType:'json',
                    data: {
                        noOfUsers:noOfUsers,
                        freeForMonth:freeForMonth,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (data) {
                        if(data.status==200){
                            console.log(data)
                            $('.package_amount').text('$'+ data.package_amount);
                            $('.package_id').val(data.package_id);
                        }else {
                            $('.package_amount').text("");
                            $('.package_id').val("");
                        }

                    }
                });
            }else {
                $('.package_amount').text("");
                $('.package_id').val("");
                return false;
            }



        })
    </script>

    <script>
        $(document).ready(function(){
            paypal.Buttons({
                onInit: function(data, actions) {

                    $('#paypal-button-container').show();

                    actions.disable();

                    $('select').on('change', function () {
                        var element = $(this);
                        var noOfUsers = $(element).closest('form').find('.noOfUsers').val();
                        var freeForMonth = $(element).closest('form').find('.freeForMonth').val();

                        if(noOfUsers && freeForMonth){
                            $.ajax({
                                type: 'GET',
                                url: '{{ route('ajax.employee.packages.user.month') }}',
                                dataType:'json',
                                data: {
                                    noOfUsers:noOfUsers,
                                    freeForMonth:freeForMonth,
                                    _token: '{{csrf_token()}}'
                                },
                                success: function (data) {

                                    if(data.status==200){
                                        var packageAmount = data.package_amount;
                                        if(packageAmount<=0){
                                            actions.disable();
                                            $('.dashboard-inner').before('<div class="alert alert-danger" role="alert">This amount is not sufficient.</div>')
                                            return false;
                                        }else {
                                            $('.package_id').val(data.package_id);
                                            var paymentFor = $('.payment_for').val();
                                            var package_id = data.package_id;

                                            if(!package_id){
                                                actions.disable();
                                                $('.dashboard-inner').before('<div class="alert alert-danger" role="alert">Please select one package!</div>')
                                                return false;
                                            }

                                            if(!package_id && paymentFor=='new'){
                                                actions.disable();
                                                return false;
                                            }
                                            if(package_id && paymentFor=='new'){
                                                actions.enable();
                                            }

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

                    });

                    // Disable the buttons


                    // Listen for changes to the checkbox

                },

                // onClick is called when the button is clicked
                onClick: function() {
                    $('.alert').remove();
                    var paymentFor = $('#employerTabContent').find('.active').find('.payment_for').val();
                    var package_id = $('#employerTabContent').find('.active').find('.package_id').val();
                    if(!package_id){
                        $('.dashboard-inner').before('<div class="alert alert-danger" role="alert">Please select one package!</div>')
                    }
                },
                // Call your server to set up the transaction
                createOrder: function(data, actions) {
                    var paymentFor = $('.payment_for').val();
                    var _token = "{{ csrf_token() }}";
                    var package_id = $('.package_id').val();
                    if(package_id==""){
                        return false;
                    }
                    var url = '/createorder/{{$user->id}}/'+package_id+'/'+paymentFor;
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
                            var redirect_url = "{{ route('confirmation_page',$user->id) }}";
                                window.location.href = redirect_url;
                        }
                        console.log(orderData);

                    });
                }
            }).render('#paypal-button-container');
        });
    </script>

    <!-- jQuery Modal -->



@endpush