<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ClubFormRequest extends Request
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
                'registration_number' => 'required',
                'short_name' => 'required',
                'email' => 'required|email|unique:shooting_sport_clubs,email'.$id_str,
                'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:12|unique:shooting_sport_clubs,mobile_en'.$id_str,
            ];
        } else {
            return [
                'name' => 'required',
                'registration_number' => 'required',
                'short_name' => 'required',
                'email' => 'required|email|unique:shooting_sport_clubs,email'.$id_str,
                'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:12|unique:shooting_sport_clubs,mobile_en'.$id_str,
                'club_logo' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter name.',
            'registration_number.required' => 'Please enter registration number.',
            'mobile.required' => 'Please enter mobile number.',
            'mobile.unique' => 'Mobile number already exists.',
            'mobile.integer' => 'Mobile must be integer.',
            'mobile.min:8' => 'Mobile minimum 8 digit.',
            'mobile.max:12' => 'Mobile maximum 12 digit.',
            'email.required' => 'Please enter email.',
            'email.email' => 'Please enter valid email.',
            'email.unique' => 'Email already exists.',
            'email.club_logo' => 'Please select club logo.',
//            'club_type.required' => 'Please select club type.'
        ];
    }

}
