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
                            <h2>Employers</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="jobseeker">
        <div class="container">
            <div class="imr">
                <div class="im-12">
                    <h3 class="text-center">Attention HTTConnect Employers!</h3>

                    <p>
                        The site is currently ONLY open to "Jobseekers" for them to Register their Free Profiles.
                        Once "Any" province reaches a minimum count of 1,000 registered jobseeker profiles, we will open it up to you to ensure you have a good selection of HTTConnect jobseekers to choose from.
                        Check back and take a look at the "Jobseeker Profile Count (by Province)" on the homepage of the site so you can decide when to Register.
                    </p>

                    <p>
                        You know what skills you require so simply search and hire!!!!
                    </p>

                    <h5 class="text-right">HTTConnect Management Team</h5>

                </div>
            </div>
        </div>
    </section>

    @push('scripts')
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

            $(document).ready(function() {
                $('.select2').select2();

                var id = $('#stateValue').val();
                var added_city_id = $('.added_city_id').val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('render_cities') }}',
                    data: {id, added_city_id, _token: '{{csrf_token()}}'},
                    success: function (data) {
                        $('#render_city_data').html(data['html']);
                    }
                });

            });

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
            function userFormValidation() {
                var form3 = $('form[name=user_form]');
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
                        'password': {
                            required: true,
                            minlength: 8
                        },
                        'password_confirmation': {
                            required: true,
                            equalTo: "#password",
                            minlength: 8
                        },
                        'industry':{
                            required: true
                        },
                        'business_years':{
                            required: true
                        },
                        'company_name':{
                            required: true
                        },
                        'state': {
                            required: true
                        },
                        'gender': {
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
                        'number_employees': {
                            required: true
                        },
                        'education': {
                            required: true
                        },
                        'experience': {
                            required: true
                        },
                        'job_title[]': {
                            required: true
                        },
                        'job_type[]': {
                            required: true
                        },
                        'language[]': {
                            required: true
                        },
                        'is_third_party_hiring': {
                            required: true
                        },
                        'willing_to_relocate': {
                            required: true
                        },
                        'profile_visibility': {
                            required: true
                        },
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
                        password: {
                            required: "Password is required.",
                            minlength: 'Password should be more than 8 characters long'
                        },
                        password_confirmation: {
                            required: "Password Confirmation is required.",
                            equalTo: 'Password Confirmation must be same  password',
                            minlength: 'Password Confirmation should be more than 8 characters long'
                        },
                        industry: {
                            required: "Industry is required."
                        },
                        business_years: {
                            required: "Business years is required."
                        },
                        company_name:{
                            required: "Company Name is required."
                        },
                        state: {
                            required: "Province is required."
                        },
                        gender: {
                            required: "Gender is required."
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
                        number_employees:{
                            required: "Number of employees is required."
                        },
                        education: {
                            required: "Level of Education is required."
                        },
                        experience: {
                            required: "Years of Experience is required."
                        },
                        'job_title[]': {
                            required: "Job Titles is required."
                        },
                        'job_type[]': {
                            required: "Job Types is required."
                        },
                        'language[]': {
                            required: "Language is required."
                        },
                        'is_third_party_hiring': {
                            required: "Third party hiring is required."
                        },
                        'willing_to_relocate': {
                            required: "Willing To Relocate is required."
                        },
                        'profile_visibility': {
                            required: "Profile Visibility is required."
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
            $(document).ready(function () {
                $('.select2').on('change', function () {
                    $(this).valid();
                });

            });

            $(document).ready(function () {
                $("#job_title").select2({
                    multiple:true,
                    placeholder: "Choose Job Title(s)",
                });
            });

            $(document).ready(function () {
                $("#language").select2({
                    multiple:true,
                    placeholder: "Choose Language(s)",
                });
            });
        </script>
    @endpush
    @include('includes.footer')
@endsection

