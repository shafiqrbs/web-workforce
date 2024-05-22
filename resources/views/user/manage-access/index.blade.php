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
                                <div class="jobseeker-inner" style="padding:35px;">
                                    <div class="show-profile" style="margin-top:0px;">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="profile-img">
                                                    {{auth()->user()->printUserImage()}}
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="profile-info">
                                                            <h4>{{auth()->user()->name ? auth()->user()->name : ''}}</h4>
                                                            <ul>

                                                                @if(Auth::user()->getLocation())
                                                                    <li><i class="fa fa-map-marker"></i> {{ Auth::user()->getLocation() }}</li>
                                                                @endif
                                                                @if(auth()->user()->phone)
                                                                    <li><i class="fa fa-phone-alt"></i> {{auth()->user()->phone}}</li>
                                                                @endif
                                                                @if(auth()->user()->email)
                                                                    <li style="padding-bottom: 10px;"><i class="fa fa-envelope"></i> {{auth()->user()->email}}</li>
                                                                @endif
                                                            </ul>
                                                           {{-- <p style="margin-bottom: 0rem;"><i class="fa fa-map-marker"></i> Banasree,Rampura,Dhaka.</p>
                                                            <p style="margin-bottom: 0rem;"><i class="fa fa-phone-alt"></i> 01917000804</p>
                                                            <p style="margin-bottom: 0rem;"><i class="fa fa-envelope"></i> rakib@rightbrainsolution.com</p>--}}
                                                        </div>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="profile-right float-right">
                                                            <ul>
                                                                <li>Created {{ auth()->user()->created_at->format('j F, Y') }}</li>
                                                                @if(auth()->user()->updated_at)
                                                                    <li>
                                                                        Updated {{ auth()->user()->updated_at->format('j F, Y') }}
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                            {{--<div class="text-right pr-4">
                                                                <i class="fas fa-video" style="font-size:25px; margin:2px 5px;"></i>
                                                                <i class="far fa-save" style="font-size:25px;  margin:2px 5px";></i>
                                                            </div>--}}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="employer-add-user">
                                        @if(count($subUsers)<3 && ( auth()->user()->package_end_date && date("Y-m-d H:i:s", strtotime(auth()->user()->package_end_date))>date("Y-m-d H:i:s")))
                                        <div class="add-user-btn">
                                            <button type="button" class="add-account-btn" onclick="modalLink()">  <i class="fas fa-user-plus" style="color: #000;"></i> Add User</button>
                                        </div>
                                        @endif

                                    </div>
                                    <div class="jobseeker-form">
                                        <div class="form-items">
                                            <form>

                                                <div class="pt-3" >
                                                    <span>User Status</span>
                                                    <table id="resume">
                                                        <thead>

                                                        <tr>
                                                            <th width="20%" style="background: #E0E4E5;text-align: center;">First Name</th>
                                                            <th width="15%" style="background: #E0E4E5;text-align: center;">Last Name</th>
                                                            <th width="35%" style="background: #E0E4E5;text-align: center;">Email</th>
                                                            <th width="10%" style="background: #E0E4E5;text-align: center;">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if($subUsers)
                                                                @foreach($subUsers as $item)
                                                                <tr>

                                                                    <td>{{ $item->first_name}}</td>
                                                                    <td>{{ $item->last_name}}</td>
                                                                    <td>{{ $item->email}}</td>
                                                                    <td style="text-align: center;">
                                                                        <a class="delete-confirm" href="{{ route('delete.sub.account',['id'=> $item->id]) }}" style="color: #EC521E;">
                                                                            <i class="fas fa-trash"></i>
                                                                        </a>
                                                                        @if($item->is_active == 0)
                                                                            <a data-status="inactive" data-id="{{$item->id}}" class="active-user">
                                                                                <i class="fa fa-user-slash" style="color: #000;"></i>
                                                                            </a>
                                                                            @else
                                                                            <a data-status="active" data-id="{{$item->id}}" class="active-user">
                                                                                <i class="fa fa-user" color="green"></i>
                                                                            </a>
                                                                        @endif

                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </form>

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

    <div class="container">
        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background:#FFFAE8; border: none;position: relative; min-height: 65px;">
                        <button style="position: absolute;right: 16px;padding: 8px 15px;" type="button" class="create-user-btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><< Back</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body termsModal about-wraper" style="background:#FFFAE8; padding: 0 50px 50px;">
                        <div class="jobseeker-form">
                            <div class="form-items">
                                <form name="add_user" id="theform" class="form-horizontal" method="POST" action="{{ route('create-user') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="candidate_or_employer" value="sub_account"/>
                                    <div class="form-step step-one">

                                        <div class="single-input{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                            <label for="name">First Name *</label>
                                            <input type="text" name="first_name" required="required" placeholder="{{__('First Name')}}" value="{{old('first_name')}}">
                                            @if ($errors->has('first_name'))
                                                <span class="help-block custom-help-block"> <strong>{{ $errors->first('first_name') }}</strong> </span>
                                            @endif
                                        </div>

                                        <div class="single-input{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                            <label for="Name">Last Name *</label>
                                            <input type="text" name="last_name" required="required" placeholder="{{__('Last Name')}}" value="{{old('last_name')}}">
                                            @if ($errors->has('last_name'))
                                                <span class="help-block custom-help-block"> <strong>{{ $errors->first('last_name') }}</strong></span>
                                            @endif
                                        </div>

                                        <div class="single-input full-width{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email">Email *</label>
                                            <input type="email" name="email" onkeyup="duplicateEmail(this)" onblur="duplicateEmail(this)" required="required" placeholder="{{__('Email')}}" value="{{old('email')}}">
                                            @if ($errors->has('email'))
                                                <span class="help-block custom-help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <div class="single-input{{ $errors->has('country') ? ' has-error' : '' }}">
                                            <label for="password">Country *</label>
                                            <select name="country" required="required">
                                                <option value="{{ $country->id }}">{{ $country->country }}</option>
                                            </select>
                                            @if ($errors->has('country'))
                                                <span class="help-block custom-help-block"> <strong>{{ $errors->first('country') }}</strong> </span>
                                            @endif
                                        </div>

                                        <div class="single-input{{ $errors->has('state') ? ' has-error' : '' }}">
                                            <label for="Name">Province *</label>
                                            <div id="render_state_data">
                                                <select name="state" onchange="stateSelected()"  id="stateValue" required="required">
                                                    <option value="">Choose A Province</option>
                                                    @foreach($states as $state)
                                                        <option value="{{ $state->id }}" {{ old('state') == $state->id ? 'selected' : '' }}>{{ $state->state }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->has('state'))
                                                <span class="help-block custom-help-block"> <strong>{{ $errors->first('state') }}</strong> </span>
                                            @endif
                                        </div>

                                        <div class="single-input{{ $errors->has('city') ? ' has-error' : '' }}">
                                            <label for="Name">City *</label>
                                            <input type="hidden" class="added_city_id" value="{{old('city')}}">
                                            <div id="render_city_data">
                                                <select name="city" id="" required="required">
                                                    <option value="">Choose A City</option>
                                                </select>
                                            </div>
                                            @if ($errors->has('city'))
                                                <span class="help-block custom-help-block"> <strong>{{ $errors->first('city') }}</strong> </span>
                                            @endif
                                        </div>


                                        <div class="single-input{{ $errors->has('postal_code') ? ' has-error' : '' }}">
                                            <label for="Name">Postal Code *</label>
                                            <input type="text" name="postal_code" required="required" placeholder="{{__('')}}" value="{{old('postal_code')}}">
                                            @if ($errors->has('postal_code'))
                                                <span class="help-block custom-help-block"> <strong>{{ $errors->first('postal_code') }}</strong> </span>
                                            @endif
                                        </div>

                                    </div>

                                    {{--<div style="padding-top: 20px;" class="single-input">
                                        <div id="formrowRecaptcha" class="formrow {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                            {!! app('captcha')->display() !!}
                                            @if ($errors->has('g-recaptcha-response'))
                                                <span class="help-block  custom-help-block">
                                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>--}}

                                    <div class="create-user pt-3">
                                        <input type="submit" class="create-user-btn" value="Create User" id="btnSaveIt">
                                       {{-- <input type="submit" class="create-user-btn confirmButton" value="Create User">--}}
                                        <p class="pt-2">Password for this user will be automatically generated and will be sent via email with validation link.</p>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


    @include('includes.footer_social')
@endsection

@push('styles')

    <link href="{{asset('/')}}css/custom-bootstrap.min.css" rel="stylesheet">
@endpush

@push('scripts')

    <script type="text/javascript">
        function modal() {
            var check =  $('#checkboxTerms').is(':checked');
            if(check == true){
                $('#register_confirm').submit();
                $('#myModal').modal('hide');
            }
        }

        function modalLink() {
            $('#myModal').modal('show');
        }
        $(document).on('click','.confirmButton',function () {
            $('#register_confirm').submit();
            $('#myModal').modal('hide');
        })

        function stateSelected() {
            var id = $('#stateValue').val();
            $.ajax({
                type: 'POST',
                url: '{{ route('render_cities') }}',
                data: {id, _token: '{{csrf_token()}}'},
                success: function (data) {
                    $('#render_city_data').html(data['html']);
                }
            });
        }

        userFormValidation();
        function userFormValidation() {
            var form3 = $('form[name=add_user]');
            var error3 = $('.alert-danger', form3);
            var success3 = $('.alert-success', form3);
            form3.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'custom-help-block', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "", // validate all fields including form hidden input
                rules: {
                    'first_name': {
                        required: true
                    },
                    'last_name': {
                        required: true
                    },
                    'email': {
                        required: true,
                        email: true
                    },
                    'state': {
                        required: true
                    },

                    'country': {
                        required: true
                    },
                    'city': {
                        required: true
                    },
                    'postal_code': {
                        required: true
                    },
                    'g-recaptcha-response': {
                        reCaptchaMethod: true
                    }
                },

                messages: { // custom messages for radio buttons and checkboxes
                    first_name: {
                        required: "First Name is required."
                    },
                    last_name: {
                        required: "Last Name is required."
                    },
                    email: {
                        required: "Email is required.",
                        email: 'Email must be a valid email address.'
                    },
                    state: {
                        required: "Province is required."
                    },
                    country: {
                        required: "Country is required."
                    },
                    city: {
                        required: "City is required."
                    },
                    postal_code: {
                        required: "Postal Code is required."
                    },
                    'g-recaptcha-response': {
                        reCaptchaMethod: "Recaptcha is required."
                    },
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.parent(".input-group").length > 0) {
                        error.insertAfter(element.parent(".input-group"));
                    } else if (element.attr("data-error-container")) {
                        error.appendTo(element.attr("data-error-container"));
                    } else if (element.parents('.radio-list').length > 0) {
                        error.appendTo(element.parents('.radio-list').attr("data-error-container"));
                    } else if (element.parents('.form-check-inline').length > 0) {
                        error.appendTo(element.parents('.col-md-6').find('.errorMessage').show());
                    } else if (element.parents('.checkbox-list').length > 0) {
                        error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
                    } else if (element.parents('.select2Dropdown').length > 0) {
                        error.appendTo(element.parents('.select2Dropdown').find('.errorMessage').show());
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit
                    success3.hide();
                    error3.show();
                    if (!validator.numberOfInvalids())
                        return;

                    $('html, body').animate({
                        scrollTop: $(validator.errorList[0].element).offset().top
                    }, 2000);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.formrow').addClass('has-error'); // set error class to the control group
                    // $(document).scrollTo('.has-error', 2000);
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.formrow').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.formrow').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    success3.show();
                    error3.hide();
                    form[0].submit(); // submit the form
                }
            });
        }

        $('.delete-confirm').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Are you sure?',
                text: 'Are you sure you want to permanently delete this account ?',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });

            function duplicateEmail(element){
                var email = $(element).val();
                $.ajax({
                    type: "POST",
                    url: '{{url('checkemail')}}',
                    data: {email:email, _token: '{{csrf_token()}}'},
                    dataType: "json",
                    success: function(res) {
                        $('#email-error').html('');
                        if(res.exists){
                            $('#email-error').html('This Email has already been taken.');
                            $('.create-user-btn').prop('disabled',true);
                            // alert('true');
                        }else{
                            $('#email-error').html('');
                            $('.create-user-btn').prop('disabled',false);
                        }
                    },
                    error: function (jqXHR, exception) {

                    }
                });
            }

        $(".active-user").click(function(event){
            var element = $(this);
            event.preventDefault();
            var id = $(this).attr('data-id');
            var status = $(this).attr('data-status');

            $.ajax({
                url: "{{url('activeUser')}}",
                type:"POST",
                data:{id:id,status:status, _token: '{{csrf_token()}}'},

                success:function(response){
                    $('.alert').remove();
                    $(element).text('')
                    if(response.status==200) {
                        $('.jobseeker-form').before('<div class="alert alert-success" role="alert">'+response.message+'</div>')
                        // location.reload(true);
                        $(element).attr('data-status',response.account_status);
                        if(response.account_status=='active'){
                            $(element).append('<i class="fa fa-user" color="green"></i>');
                        }else {
                            $(element).append('<i class="fa fa-user-slash" style="color: #000;"></i>');
                        }
                    }
                    if(response.status==503) {
                        $(element).append('<i class="fa fa-user-slash" style="color: #000;"></i>');
                        $('.jobseeker-form').before('<div class="alert alert-danger" role="alert">'+response.message+'</div>')
                    }
                },
            });
        });



    </script>


    @include('includes.immediate_available_btn')
@endpush
