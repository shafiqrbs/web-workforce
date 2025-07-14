<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EventFormRequest extends Request
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
        if ($this->request->get('form_type') == 'update') {
            return [
                'event_name' => 'required',
                'event_type_id' => 'required',
//                'number_of_club' => 'required|integer',
//                'number_of_athlete' => 'required|integer',
//                'number_of_official' => 'required|integer',
//                'event_image' => 'image|dimensions:min_width=900,min_height=500',
                'event_image' => 'image',
            ];
        } else {
            return [
                'event_name' => 'required',
                'event_image' => 'required|image|dimensions:min_width=900,min_height=300',
                'event_type_id' => 'required',
//                'number_of_club' => 'required|integer',
//                'number_of_athlete' => 'required|integer',
//                'number_of_official' => 'required|integer',
            ];
        }
    }

    public function messages()
    {
        return [
            'event_name.required' => 'Please enter event name.',
            'event_image.required' => 'Please select event image.',
            'event_image.image' => 'Please select valid image format.',
            'event_image.dimensions' => 'Image width & height must be greater than or equal to 900px & 500px.',
            'event_type.required' => 'Please enter event type.',
            'number_of_club.required' => 'Please enter number of clubs.',
            'number_of_club.integer' => 'Number of clubs must be integer.',
            'number_of_athlete.required' => 'Please enter number of athletes.',
            'number_of_athlete.integer' => 'Number of athletes must be integer.',
            'number_of_official.required' => 'Please enter number of officials.',
            'number_of_official.integer' => 'Number of officials must be integer.',
        ];
    }

}
