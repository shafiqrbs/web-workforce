<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class JuryFormRequest extends Request
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
        $id = (int) $this->input('id', 0);
        $id_str = '';
        if ($id > 0) {
            $id_str = ',' . $id;
        }
        if ($this->request->get('form_type') == 'update') {
            return [
                'name' => 'required',
//                'profile_image' => 'required',
                'email' => 'required|email|unique:members,email'.$id_str,
                'mobile' => 'required|min:8|max:12|unique:members,mobile'.$id_str,
                'issf_license_no' => 'required',
                'license_valid_date' => 'required',
            ];
        } else {
            return [
                'name' => 'required',
                'profile_image' => 'required',
                'email' => 'required|email|unique:members,email'.$id_str,
                'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:12|unique:members,mobile'.$id_str,
                'issf_license_no' => 'required',
                'license_valid_date' => 'required',
            ];
        }



    }

    public function messages()
    {
        return [
            'name.required' => __('messages.Please_enter_name'),
            'email.required' => __('messages.Please_enter_email'),
            'email.email' => __('messages.Please_enter_valid_email'),
            'email.unique' => __('messages.Email_must_be_unique'),
            'profile_image.required' => __('messages.Please_select_image'),
            'mobile.required' => __('messages.Please_enter_mobile'),
            'mobile.min' => __('messages.Mobile_must_be_8_digit'),
            'mobile.regex' => __('messages.Mobile_must_be_digit'),
            'mobile.max' => __('messages.Mobile_max_be_12_digit'),
            'mobile.unique' => __('messages.Mobile_must_be_unique'),
            'issf_license_no.required' => __('messages.Please_enter_issf_license_no'),
            'license_valid_date.required' => __('messages.Please_select_license_valid_date'),
        ];
    }

}
