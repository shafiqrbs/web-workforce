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
                                <div class="profile-main-top-custom">
                                    <div class="jobseeker-inner">
                                        <h2>Change Password</h2>
                                        <div class="jobseeker-form">

                                            <div class="form-items">
                                                <form name="change_password" class="form-horizontal" method="POST" action="{{ route('pass.change') }}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}

                                                    <div class="single-input full-width{{ $errors->has('password') ? ' has-error' : '' }}">
                                                        <input type="password" name="password" minlength="8" id="password" required="required" placeholder="New Password" required="required" value="{{ old('password') }}">
                                                        <p>Password should be at least 8 characters</p>

                                                        @if ($errors->has('password'))
                                                            <span class="help-block custom-help-block"> <strong>{{ $errors->first('password') }}</strong> </span>
                                                        @endif
                                                    </div>

                                                    <div class="single-input full-width{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                                                        <input type="password" id="confirm_password"  minlength="8" name="confirm_password" class="form-control" required="required" placeholder="Confirm Password" required="required" value="{{ old('confirm_password') }}">
                                                        @if ($errors->has('confirm_password'))
                                                            <span class="help-block custom-help-block">
                                                                <strong>{{ $errors->first('confirm_password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <div class="single-submit-button">
                                                        <input type="submit" value="Save">
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(auth()->user()->is_suspended == 1)
                        <div class="text-center mt-3 mb-5" style="color: red;">
                            <h3>Your profile is suspended. Please contact us as soon as possible !</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @include('includes.footer_social')
@endsection
@push('styles')

    <link href="{{asset('/')}}css/custom-bootstrap.min.css" rel="stylesheet">
@endpush
@push('scripts')
    @include('includes.immediate_available_btn')
        <script>

            userFormValidation();

            var password = document.getElementById("password")
                , confirm_password = document.getElementById("confirm_password");

            function validatePassword(){
                if(password.value != confirm_password.value) {
                    confirm_password.setCustomValidity("Passwords Don't Match");
                } else {
                    confirm_password.setCustomValidity('');
                }
            }

            password.onchange = validatePassword;
            confirm_password.onkeyup = validatePassword;

            function userFormValidation() {
                var form3 = $('form[name=change_password]');
                var error3 = $('.alert-danger', form3);
                var success3 = $('.alert-success', form3);
                form3.validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'custom-help-block', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    ignore: "", // validate all fields including form hidden input
                    rules: {
                        'password': {
                            required: true,
                            minlength: 8
                        },
                        'confirm_password': {
                            required: true,
                            equalTo: "#password",
                            minlength: 8
                        }

                    },

                    messages: { // custom messages for radio buttons and checkboxes
                        password: {
                            required: "Password is required.",
                            minlength: 'Password should be more than 8 characters long'
                        },
                        confirm_password: {
                            required: "Password Confirmation is required.",
                            equalTo: 'Password Confirmation must be same  password',
                            minlength: 'Password Confirmation should be more than 8 characters long'
                        }
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



        </script>
@endpush