<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProfessionFormRequest extends Request
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
                'profession' => 'required|unique:professions,profession' . $id_str,
            ];
        } else {
            return [
                'profession' => 'required|unique:professions,profession' . $id_str,
            ];
        }
    }

    public function messages()
    {
        return [
            'profession.required' => 'Please enter profession name.',
            'profession.unique' => 'Profession name has already been taken.',
        ];
    }

}
