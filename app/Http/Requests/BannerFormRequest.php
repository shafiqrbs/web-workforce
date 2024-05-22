<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BannerFormRequest extends Request
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
                'banner_title' => 'required',
                'page_slug' => 'required|unique:banners,page_slug' . $id_str,
            ];
        } else {
            return [
                'banner_title' => 'required',
                'page_slug' => 'required|unique:banners,page_slug' . $id_str,
                'banner_image' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'banner_title.required' => 'Please enter banner title.',
            'page_slug.required' => 'Please choose page',
            'page_slug.unique' => 'Page Banner already exists',
            'banner_image.required' => 'Please select banner image.',
        ];
    }

}
