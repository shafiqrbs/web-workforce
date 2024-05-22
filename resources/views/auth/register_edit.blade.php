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
                            <h2>Edit Information</h2>
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
                    <div class="jobseeker-inner">
                        <h2>Jobseeker</h2>
                        <div class="jobseeker-form">
                            <div class="form-items">
                                <form name="user_edit_form" id="editform" method="POST" action="{{ route('registration_update',$user->id) }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="candidate_or_employer" value="candidate"/>
                                    <div class="form-step step-one">
                                        <h3>Account Information</h3>
                                        <div class="single-input{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email">Email *</label>
                                            <input type="email" name="email" required="required" value="{{ $user->email }}">
                                            @if ($errors->has('email'))
                                                <span class="help-block custom-help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="single-input{{ $errors->has('phone') ? ' has-error' : '' }}">
                                            <label for="phone">Telephone Number</label>
                                            <input type="text" name="phone" value="{{$user->phone}}">
                                            @if ($errors->has('phone'))
                                                <span class="help-block custom-help-block"> <strong>{{ $errors->first('phone') }}</strong> </span>
                                            @endif
                                        </div>

                                        <div class="single-input{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password">Password *</label>
                                            <input type="password" name="password"  minlength="8"  id="password" class="password" required="required" placeholder="{{__('Password')}}" value="{{old('password')}}">
                                            <p>Password should be at least 8 characters</p>
                                            @if ($errors->has('password'))
                                                <span class="help-block custom-help-block"> <strong>{{ $errors->first('password') }}</strong> </span>
                                            @endif
                                        </div>

                                        <div class="single-input{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                            <label for="password">Password Confirmation *</label>
                                            <input type="password" minlength="8"  name="password_confirmation" id="confirm_password" class="password_confirmation" required="required" placeholder="{{__('Password Confirmation')}}" value="{{old('password_confirmation')}}">
                                            @if ($errors->has('password_confirmation'))
                                                <span class="help-block custom-help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-step step-two">
                                        <h3>Personal Information</h3>
                                        <div class="single-input{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                            <label for="name">First Name *</label>
                                            <input type="text" name="first_name" required="required" placeholder="{{__('First Name *')}}" value="{{ $user->first_name}}">
                                            @if ($errors->has('first_name'))
                                                <span class="help-block custom-help-block"> <strong>{{ $errors->first('first_name') }}</strong> </span>
                                            @endif
                                        </div>

                                        <div class="single-input{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                            <label for="Name">Last Name *</label>
                                            <input type="text" name="last_name" required="required" placeholder="{{__('Last Name')}}" value="{{ $user->last_name }}">
                                            @if ($errors->has('last_name'))
                                                <span class="help-block custom-help-block"> <strong>{{ $errors->first('last_name') }}</strong></span>
                                            @endif
                                        </div>

                                        <div class="single-input{{ $errors->has('gender') ? ' has-error' : '' }}">
                                            <label for="gender">Gender *</label>
                                            <select name="gender" required="required">
                                                <option value="">Choose A Gender *</option>
                                                @foreach($genders as $gender)
                                                    <option value="{{ $gender->id }}" {{ $user->gender->id == $gender->id ? 'selected' : '' }}>{{ $gender->gender }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('gender'))
                                                <span class="help-block custom-help-block"> <strong>{{ $errors->first('gender') }}</strong> </span>
                                            @endif
                                        </div>

                                        <div class="single-input{{ $errors->has('country') ? ' has-error' : '' }}">
                                            <label for="password">Country *</label>
                                            <select name="country" required="required">
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}" {{ $user->country->id == $country->id ? 'selected' : '' }}>{{ $country->country }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('country'))
                                                <span class="help-block custom-help-block"> <strong>{{ $errors->first('country') }}</strong> </span>
                                            @endif
                                        </div>

                                        <div class="single-input{{ $errors->has('state') ? ' has-error' : '' }}">
                                            <label for="Name">Province *</label>
                                            <div id="render_state_data">
                                                <select name="state" onchange="stateSelected()"  id="stateValue" required="required">
                                                    <option value="">Choose A Province * </option>
                                                    @foreach($states as $state)
                                                        <option value="{{ $state->id }}" {{ $user->state->id == $state->id ? 'selected': '' }}>{{ $state->state }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->has('state'))
                                                <span class="help-block custom-help-block"> <strong>{{ $errors->first('state') }}</strong> </span>
                                            @endif
                                        </div>

                                        <div class="single-input{{ $errors->has('city') ? ' has-error' : '' }}">
                                            <label for="Name">City *</label>
                                            <input type="hidden" class="added_city_id" value="{{$user->city&&$user->city->id!=''?$user->city->id:''}}">
                                            <div id="render_city_data">
                                                <select name="city" id="" required="required">
                                                    <option value="">Choose A City *</option>
                                                </select>
                                            </div>
                                            @if ($errors->has('city'))
                                                <span class="help-block custom-help-block"> <strong>{{ $errors->first('city') }}</strong> </span>
                                            @endif
                                        </div>

                                        <div class="single-input{{ $errors->has('street_address') ? ' has-error' : '' }}">
                                            <label for="Name">Street Address</label>
                                            <input type="text" name="street_address" placeholder="{{__('Street Address')}}" value="{{ $user->street_address }}">
                                            @if ($errors->has('street_address'))
                                                <span class="help-block custom-help-block"> <strong>{{ $errors->first('street_address') }}</strong> </span>
                                            @endif
                                        </div>

                                        <div class="single-input{{ $errors->has('postal_code') ? ' has-error' : '' }}">
                                            <label for="Name">Postal Code *</label>
                                            <input type="text" name="postal_code" required="required" placeholder="{{__('Postal Code')}}" value="{{ $user->postal_code }}">
                                            @if ($errors->has('postal_code'))
                                                <span class="help-block custom-help-block"> <strong>{{ $errors->first('postal_code') }}</strong> </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-step step-three">
                                        <h3>Career Information</h3>
                                        <div class="single-input{{ $errors->has('education') ? ' has-error' : '' }}">
                                            <label for="education">Level of Education *</label>
                                            <select name="education" required="required">
                                                <option value="">Choose Level of Education *</option>
                                                @foreach($degreeLevels as $degreeLevel)
                                                    <option value="{{ $degreeLevel->id }}"  {{ $user->degree_level_id ==  $degreeLevel->id ? 'selected' : ''}} >{{ $degreeLevel->degree_level }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('education'))
                                                <span class="help-block custom-help-block"> <strong>{{ $errors->first('education') }}</strong> </span>
                                            @endif
                                        </div>

                                        <div class="single-input{{ $errors->has('experience') ? ' has-error' : '' }}">
                                            <label for="Experience">Years of Experience *</label>
                                            <select name="experience" required="required">
                                                <option value="">Choose Years of Experience *</option>
                                                @foreach($jobExperiences as $jobExperience)
                                                    <option value="{{ $jobExperience->id }}" {{ $user->jobExperience->id ==  $jobExperience->id ? 'selected' : ''}}>{{ $jobExperience->job_experience }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('experience'))
                                                <span class="help-block custom-help-block"> <strong>{{ $errors->first('experience') }}</strong> </span>
                                            @endif
                                        </div>

                                        <div class="single-input{{ $errors->has('expected_salary') ? ' has-error' : '' }}">
                                            <label for="salary">Expected Salary</label>
                                            <input type="number" name="expected_salary" min="1" placeholder="{{__('Expected Salary')}}" value="{{ $user->expected_salary}}">
                                        </div>

                                        <div class="single-input{{ $errors->has('salary_period') ? ' has-error' : '' }}">
                                            <label for="period">Salary Period</label>
                                            <select name="salary_period" class="select-2">
                                                <option value="">Choose Salary Period</option>
                                                @foreach($salaryPeriods as $salaryPeriod)
                                                    <option value="{{$salaryPeriod->id}}" {{ $user->salaryPeriod && $user->salaryPeriod->id ==  $salaryPeriod->id ? 'selected' : ''}}>{{ $salaryPeriod->salary_period }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="single-input full-width {{ $errors->has('job_title') ? ' has-error' : '' }}">
                                            <label for="Job Title">Job Title(s) *</label>
                                            <div class="select2Dropdown">
                                                <select name="job_title[]" id="job_title" class="job_title select2" required="required"  multiple>
                                                    @foreach($jobTitles as $jobTitle)
                                                        <option value="{{ $jobTitle->id }}" {{ in_array($jobTitle->id, $userJobTitles) ? 'selected' : '' }}>{{ $jobTitle->job_title }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('job_title'))
                                                    <span class="help-block custom-help-block"> <strong>{{ $errors->first('job_title') }}</strong> </span>
                                                @endif
                                                <div class="errorMessage" style="display: none"></div>
                                            </div>
                                        </div>

                                        <div class="single-input full-width {{ $errors->has('custom_job_title') ? ' has-error' : '' }}">
                                            <label for="salary">If You Have Any Other Job Title, Please Add Here</label>
                                            <input type="text" class="form-control" name="custom_job_title" value="{{$user->other_job_title}}">
                                            <p>Please add here separated by a comma</p>
                                        </div>

                                        <div class="single-input full-width{{ $errors->has('job_type') ? ' has-error' : '' }}">
                                            <label for="Job Types">Job Type(s) *</label>
                                            <div class="select2Dropdown">
                                                <select name="job_type[]" id="job_type" class="select2" required="required" multiple>
                                                    @foreach($jobTypes as $jobType)
                                                        <option value="{{ $jobType->id }}" {{ in_array($jobType->id, $userJobTypes) ? 'selected' : '' }}>{{ $jobType->job_type }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('job_type'))
                                                    <span class="help-block custom-help-block"> <strong>{{ $errors->first('job_type') }}</strong> </span>
                                                @endif
                                                <div class="errorMessage" style="display: none"></div>
                                            </div>
                                        </div>

                                        <div class="single-input{{ $errors->has('language') ? ' has-error' : '' }}">
                                            <label for="Language">Language(s) *</label>
                                            <div class="select2Dropdown">
                                                <select name="language[]" id="language" class="select2" required="required" multiple>
                                                    @foreach($languages as $language)
                                                        <option value="{{ $language->id }}" {{ in_array($language->id, $userLanguages) ? 'selected' : '' }}>{{ $language->lang }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('language'))
                                                    <span class="help-block custom-help-block"> <strong>{{ $errors->first('language') }}</strong> </span>
                                                @endif
                                                <div class="errorMessage" style="display: none"></div>
                                            </div>
                                        </div>

                                        <div class="single-input{{ $errors->has('other_languages') ? ' has-error' : '' }}">
                                            <label for="Other Language">Other Languages</label>
                                            <input type="text" name="other_languages" placeholder="{{__('Other Languages')}}" value="{{$user->other_languages}}">
                                            <p>Please add here separated by a comma</p>

                                            @if ($errors->has('other_languages'))
                                                <span class="help-block custom-help-block"> <strong>{{ $errors->first('other_languages') }}</strong> </span>
                                            @endif

                                        </div>

                                        <div class="single-radio full-width">
                                            <div class="formrow{{ $errors->has('is_immediate_available') ? ' has-error' : '' }}">
                                                <div class="row pt-2 pb-2">
                                                    <p style="font-weight: bold; float:left;">Ready To Work Now ? *</p>
                                                    <div class="col-md-6 text-right" style="text-align:right; float:right">
                                                        <div class="form-check form-check-inline" style="display:inline;">
                                                            <input class="form-check-input" type="radio" name="is_immediate_available" id="iainlineRadio1" required="required" value="1" {{ $user->is_immediate_available  ==1 ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="iainlineRadio1">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" style="display:inline;">
                                                            <input class="form-check-input" type="radio" name="is_immediate_available" id="iainlineRadio2" required="required" value="0" {{ $user->is_immediate_available == 0  ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="iainlineRadio2">No</label>
                                                        </div>
                                                        <div class="errorMessage" style="display: none"></div>
                                                    </div>
                                                </div>
                                                @if ($errors->has('is_immediate_available'))
                                                    <span class="help-block custom-help-block"> <strong>{{ $errors->first('is_immediate_available') }}</strong> </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="single-radio full-width">
                                            <div class="formrow{{ $errors->has('willing_to_relocate') ? ' has-error' : '' }}">
                                                <div class="row pt-2 pb-2">
                                                    <p style="font-weight: bold; float:left;">Willing To Relocate ? *</p>
                                                    <div class="col-md-6 text-right" style="text-align:right; float:right">
                                                        <div class="form-check form-check-inline" style="display:inline;">
                                                            <input class="form-check-input" type="radio" name="willing_to_relocate" id="willingRadio1" required="required" value="1" {{ $user->willing_to_relocate  ==1 ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="willingRadio1">Yes</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" style="display:inline;">
                                                            <input class="form-check-input" type="radio" name="willing_to_relocate" id="willingRadio2" required="required" value="0" {{ $user->willing_to_relocate == 0  ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="willingRadio2">No</label>
                                                        </div>
                                                        <div class="errorMessage" style="display: none"></div>
                                                    </div>
                                                </div>
                                                @if ($errors->has('willing_to_relocate'))
                                                    <span class="help-block custom-help-block"> <strong>{{ $errors->first('willing_to_relocate') }}</strong> </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="single-radio full-width">
                                            <div class="formrow{{ $errors->has('profile_visibility') ? ' has-error' : '' }}">
                                                <div class="row pt-2 pb-2">
                                                    <p style="font-weight: bold; float:left;">Profile Visibility *</p>
                                                    <div class="col-md-6 text-right" style="text-align:right; float:right">
                                                        <div class="form-check form-check-inline" style="display:inline;">
                                                            <input class="form-check-input" type="radio" name="profile_visibility" id="profileRadio1" required="required" value="1" {{ $user->profile_visibility  ==1 ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="profileRadio1">Public</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" style="display:inline;">
                                                            <input class="form-check-input" type="radio" name="profile_visibility" id="profileRadio2" required="required" value="0" {{ $user->profile_visibility == 0  ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="profileRadio2">Private</label>
                                                        </div>
                                                        <div class="errorMessage" style="display: none"></div>
                                                    </div>
                                                </div>
                                                @if ($errors->has('profile_visibility'))
                                                    <span class="help-block custom-help-block"> <strong>{{ $errors->first('profile_visibility') }}</strong> </span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="note">
                                            <p>NB: If “public”, employers can see your profile, if “private”, they can’t.</p>
                                        </div>


                                        <div class="single-submit-button">
                                            <input type="submit" value="Update Information">
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>

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


            userFormValidation();

            function userFormValidation() {
                var form3 = $('form[name=user_edit_form]');
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
                        'phone': {
                            maxlength: 20
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
                        'is_immediate_available': {
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
                        phone: {
                            maxlength: 'Telephone Number should be less than 20 characters long'
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
                        'is_immediate_available': {
                            required: "Ready To Work is required."
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
                $("#job_type").select2({
                    multiple:true,
                    placeholder: "Choose Job Types(s)",
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
    @include('includes.footer_social')
@endsection