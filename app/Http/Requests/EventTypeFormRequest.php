<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EventTypeFormRequest extends Request
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
                'event_type' => 'required|unique:event_type,event_type' . $id_str,
            ];
        } else {
            return [
                'event_type' => 'required|unique:event_type,event_type' . $id_str,
            ];
        }
    }

    public function messages()
    {
        return [
            'event_type.required' => 'Please enter event type.',
            'event_type.unique' => 'Event type has already been taken.',
        ];
    }

}
