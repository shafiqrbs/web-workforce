<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ArchiveFormRequest extends Request
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
                'archive_name' => 'required|unique:archives,archive_name_en' . $id_str,
                'sub_title' => 'required',
            ];
        } else {
            return [
                'archive_name' => 'required|unique:archives,archive_name_en' . $id_str,
                'sub_title' => 'required',
//                'archive_pdf' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'archive_name.required' => 'Please enter archive name.',
            'archive_name.unique' => 'Archive name has already been taken.',
            'sub_title.required' => 'Please select sub title.',
//            'archive_pdf.required' => 'Choose archive pdf',
        ];
    }

}
