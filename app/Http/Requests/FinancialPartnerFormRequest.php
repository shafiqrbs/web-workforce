<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FinancialPartnerFormRequest extends Request
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
                'email' => 'required|email|unique:financial_partners,email'.$id_str,
                'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:12|unique:financial_partners,mobile'.$id_str,
                'facebook_link' => 'nullable|url',
                'partner_group' => 'required',

            ];
        } else {
            return [
                'name' => 'required',
                'email' => 'required|email|unique:financial_partners,email'.$id_str,
                'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:12|unique:financial_partners,mobile'.$id_str,
                'profile_image' => 'required',
                'facebook_link' => 'nullable|url',
                'partner_group' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter name.',
            'mobile.required' => 'Please enter mobile number.',
            'mobile.integer' => 'Mobile must be integer.',
            'mobile.min:8' => 'Mobile minimum 8 digit.',
            'mobile.max:12' => 'Mobile maximum 12 digit.',
            'email.required' => 'Please enter email.',
            'email.email' => 'Please enter valid email.',
            'profile_image.required' => 'Please select image.',
            'facebook_link.url' => 'Please provide link',
        ];
    }

}
