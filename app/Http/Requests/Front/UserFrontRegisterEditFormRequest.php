<?php

namespace App\Http\Requests\Front;

use Auth;
use App\Http\Requests\Request;

class UserFrontRegisterEditFormRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:80',
            'last_name' => 'required|max:80',
            'phone' => 'max:20',
            'password' => 'required|confirmed|min:8|max:50',
            'password_confirmation' => 'required|min:8|max:50',
            'email' => 'required',
            'gender' => 'required',
            'education' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'experience' => 'required',
            'postal_code' => 'required|max:100',
            'job_title' => 'required',
            'job_type' => 'required',
            'language' => 'required',
            'is_immediate_available' => 'required',
            'willing_to_relocate' => 'required',
            'profile_visibility' => 'required',
//            'g-recaptcha-response' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => __('First Name is required.'),
            'last_name.required' => __('Last Name is required.'),
            'phone.max' => __('Telephone Number should be less than 20 characters long.'),
            'email.required' => __('Email is required.'),
            'email.email' => __('Email must be a valid email address.'),
            'email.unique' => __('This Email has already been taken.'),
            'password.required' => __('Password is required.'),
            'password_confirmation.required' => __('Password Confirmation is required.'),
            'password.min' => __('Password should be more than 8 characters long'),
            'gender.required' => __('Gender is required.'),
            'country.required' => __('Country is required.'),
            'city.required' => __('City is required.'),
            'state.required' => __('Province is required.'),
            'job_title.required' => __('Job Titles is required.'),
            'job_type.required' => __('Job Types is required.'),
            'language.required' => __('Language is required.'),
            'education.required' => __('Level of Education is required.'),
            'experience.required' => __('Years of Experience is required.'),
            'postal_code.required' => __('Postal Code is required.'),
            'is_immediate_available.required' => __('Ready To Work is required.'),
            'willing_to_relocate.required' => __('Willing To Relocate is required.'),
            'profile_visibility.required' => __('Profile Visibility is required.'),
//            'g-recaptcha-response.required' => __('Recaptcha is required.'),
        ];
    }

}
