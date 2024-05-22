<div class="profile-main">
    <div class="profile-main-top-custom">
        <div class="jobseeker-inner">
            <h2>Edit Profile</h2>
            <div class="jobseeker-form">
                <div class="form-items">
                    <form id="editForm" name="user_edit_form" method="POST" action="{{ route('update.employer.profile') }}" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <div class="form-step step-one">
                            <h3>Profile Image</h3>
                            <div class="single-input">
                                @if($user->image)
                                    <div style="position: relative; width: auto; float: left">
                                        <button type="button" data-image-url="{{ URL::asset('/admin_assets/no-image.png') }}" data-action="{{route('delete.profile.image',['id'=>$user->id])}}" data-user-id="{{$user->id}}" class="profile_image_remove">X</button>
                                        <img class="addedImage" id="blah" src="{{ URL::asset('/user_images') }}/{{ $user->image }}" height="150" width="150">
                                    </div>
                                @else
                                    <img id="blah" src="{{ URL::asset('/admin_assets/no-image.png') }}" height="150" width="150">
                                @endif
                            </div>

                            <div class="single-input">
                                <label class="select-img-btn"> {{__('Select Profile Image')}}
                                    <input type="file" id="imgInp" name="image" style="display: none" >
                                </label>
                                <span style="font-size:14px;">The image must be a file of type: jpeg or png.</span>
                                @if ($errors->has('image'))
                                    <span class="help-block custom-help-block">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-step step-one">
                            <h3>Account Information</h3>
                            <div class="single-input">
                                <label for="email">Email</label>
                                <input style="border: 2px solid #ddd; color: #999;" type="email" disabled value="{{ $user->email }}">
                            </div>

                            <div class="single-input{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone">Telephone Number</label>
                                <input type="text" name="phone" value="{{$user->phone}}">
                                @if ($errors->has('phone'))
                                    <span class="help-block custom-help-block"> <strong>{{ $errors->first('phone') }}</strong> </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-step step-two">
                            <h3>Personal Information</h3>
                            <div class="single-input{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="name">First Name *</label>
                                <input type="text" name="first_name" value="{{ $user->first_name }}" required="required">
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

                            <div class="single-input full-width {{ $errors->has('custom_job_title') ? ' has-error' : '' }}">
                                <label for="salary">Job Title *</label>
                                <input type="text" name="custom_job_title" value="{{ $user->other_job_title }}">
                            </div>

                        </div>

                        <div class="form-step step-three">
                            <h3>Company or Business Information</h3>
                            <div class="single-input{{ $errors->has('company_name') ? ' has-error' : '' }}">
                                <label for="company_name">Company or Business Name *</label>
                                <input type="text" name="company_name" required="required" placeholder="{{__('Company or Business Name')}}" value="{{ $user->company_name}}">
                                @if ($errors->has('company_name'))
                                    <span class="help-block custom-help-block"> <strong>{{ $errors->first('company_name') }}</strong> </span>
                                @endif
                            </div>

                            <div class="single-input{{ $errors->has('industry') ? ' has-error' : '' }}">
                                <label for="industry">Industry *</label>
                                <select name="industry" required="required">
                                    <option value="">Choose a Industry</option>
                                    @foreach($industry as $industries)
                                        <option value="{{ $industries->id }}" {{ $user->industry&&$user->industry->id == $industries->id ? 'selected' : '' }}>{{ $industries->industry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('industry'))
                                    <span class="help-block custom-help-block"> <strong>{{ $errors->first('industry') }}</strong> </span>
                                @endif
                            </div>

                            <div class="single-input full-width{{ $errors->has('type_of_business') ? ' has-error' : '' }}">
                                <label for="type_of_business">Type of Business(e.g. Restaurant, Hotel, Airline, Tour Operator) *</label>
                                <input type="text" name="type_of_business" required="required" placeholder="{{__('Type in Business')}}" value="{{ $user->type_of_business }}">
                                @if ($errors->has('business_years'))
                                    <span class="help-block custom-help-block"> <strong>{{ $errors->first('business_years') }}</strong> </span>
                                @endif
                            </div>

                            <div class="single-input{{ $errors->has('business_years') ? ' has-error' : '' }}">
                                <label for="business_years">Years in Business *</label>
                                <input type="number" name="business_years" required="required" placeholder="{{__('Years in Business')}}" value="{{ $user->business_years }}">
                                @if ($errors->has('business_years'))
                                    <span class="help-block custom-help-block"> <strong>{{ $errors->first('business_years') }}</strong> </span>
                                @endif
                            </div>

                            <div class="single-input{{ $errors->has('number_employees') ? ' has-error' : '' }}">
                                <label for="number_employees">Number of Employee at Your Location *</label>
                                <input type="number" name="number_employees"  min="1" placeholder="{{__('Number of Employees')}}" value="{{ $user->number_employees }}">
                            </div>

                            <div class="single-input{{ $errors->has('country') ? ' has-error' : '' }}">
                                <label for="password">Country *</label>
                                <select name="country" required="required">
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ $user->country && $user->country->id == $country->id ? 'selected' : '' }}>{{ $country->country }}</option>
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
                                        <option value="">Choose A Province</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}" {{ $user->state && $user->state->id == $state->id ? 'selected': '' }}>{{ $state->state }}</option>
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
                                        <option value="">Choose A City</option>
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

                            <div class="single-input{{ $errors->has('social_media') ? ' has-error' : '' }}">
                                <label for="social_media">How did You Hear About us? *</label>
                                <select name="social_media" class="select-2">
                                    <option value="">Please Select</option>
                                    @foreach($socialMedias as $socialMedia)
                                        <option value="{{ $socialMedia->id }}" {{ $user->social_id == $socialMedia->id ? 'selected' : '' }}>{{ $socialMedia->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{--<div class="single-input full-width {{ $errors->has('job_title') ? ' has-error' : '' }}">
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
                            </div>--}}




                           {{-- <div class="single-input{{ $errors->has('language') ? ' has-error' : '' }}">
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
                            </div>--}}

                            {{--<div class="single-input{{ $errors->has('other_languages') ? ' has-error' : '' }}">
                                <label for="Other Language">Other Languages</label>
                                <input type="text" name="other_languages" placeholder="{{__('Other Languages')}}" value="{{$user->other_languages}}">
                                <p>Please add here separated by a comma</p>

                                @if ($errors->has('other_languages'))
                                    <span class="help-block custom-help-block"> <strong>{{ $errors->first('other_languages') }}</strong> </span>
                                @endif

                            </div>--}}

                            <div class="single-radio full-width">
                                <div class="formrow{{ $errors->has('is_third_party_hiring') ? ' has-error' : '' }}">
                                    <div class="pt-2 pb-2">
                                        <p style="font-weight: bold; float:left;">Are You a Third Party Recruiter Hiring on Behalf of a Client ? *</p>
                                        <div class="text-right" style="text-align:right; float:right">
                                            <div class="form-check form-check-inline" style="display:inline;">
                                                <input class="form-check-input" type="radio" name="is_third_party_hiring" id="iainlineRadio1" required="required" value="1" {{ $user->is_third_party_hiring  ==1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="iainlineRadio1">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline" style="display:inline;">
                                                <input class="form-check-input" type="radio" name="is_third_party_hiring" id="iainlineRadio2" required="required" value="0" {{  $user->is_third_party_hiring == 0  ? 'checked' : '' }}>
                                                <label class="form-check-label" for="iainlineRadio2">No</label>
                                            </div>
                                            <div class="errorMessage" style="display: none"></div>
                                        </div>
                                    </div>
                                    @if ($errors->has('is_third_party_hiring'))
                                        <span class="help-block custom-help-block"> <strong>{{ $errors->first('is_third_party_hiring') }}</strong> </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-step step-one">

                                <h3>Additional Information</h3>

                                <div class="single-input full-width">
                                    <label for="period">Profile Summary</label>
                                    <textarea rows="10" cols="50" style="width: 100%; border:2px solid #000; padding: 10px 13px;" name="summary">{{ $userSummary ?  $userSummary : '' }}</textarea>
                                </div>
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

<div class="jobseeker-form">
    <div class="form-items">

    </div>

</div>






@push('scripts')
    <script>
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


            $("#imgInp").change(function(){
                readURL(this);
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

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result).show();
                };

                reader.readAsDataURL(input.files[0]);
            }
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
                    'state': {
                        required: true
                    },
                    'type_of_business': {
                        required: true
                    },
                    'custom_job_title': {
                        required: true
                    },
                    'social_media': {
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
                    'image': {
                        extension: "jpg|jpeg|png"
                    }
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
                    state: {
                        required: "Province is required."
                    },
                    type_of_business: {
                        required: "Type of Business is required."
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
                    'custom_job_title': {
                        required: "Job Titles is required."
                    },
                    'social_media': {
                        required: "How did You Hear About us is required."
                    },
                    image: {
                        extension: "You've chosen a wrong image format. Please choose the correct format."
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