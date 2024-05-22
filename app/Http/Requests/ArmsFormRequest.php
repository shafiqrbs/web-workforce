<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ArmsFormRequest extends Request
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
                'bullet_size' => 'required',
                'quantity' => 'required',
            ];
        } else {
            return [
                'name' => 'required',
                'arms_image' => 'required',
                'bullet_size' => 'required',
                'quantity' => 'required',
            ];
        }



    }

    public function messages()
    {
        return [
            'name.required' => __('messages.Please_enter_name'),
            'arms_image.required' => __('messages.Please_select_image'),
            'bullet_size.required' => __('messages.Please_enter_bullet_size'),
            'quantity.required' => __('messages.Please_enter_quantity'),
        ];
    }

}
