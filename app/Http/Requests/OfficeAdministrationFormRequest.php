<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OfficeAdministrationFormRequest extends Request
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
                'designation_id' => 'required',
                'email' => 'required|email|unique:committee_members,email'.$id_str,
                'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:12|unique:committee_members,mobile'.$id_str,
                'facebook_link' => 'nullable|url|regex:/http(?:s):\/\/(?:www\.)facebook\.com\/.+/i',
            ];
        } else {
            return [
                'name' => 'required',
                'designation_id' => 'required',
                'profile_image' => 'required',
                'email' => 'required|email|unique:committee_members,email'.$id_str,
                'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:12|unique:committee_members,mobile'.$id_str,
                'facebook_link' => 'nullable|url|regex:/http(?:s):\/\/(?:www\.)facebook\.com\/.+/i',
            ];
        }

    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter name.',
            'designation_id.required' => 'Please select designation.',
            'profile_image.required' => 'Please select profile image.',
            'email.required' => 'Please enter email.',
            'email.email' => 'Please enter valid email.',
            'mobile.required' => 'Please enter registration number.'
        ];
    }

}
