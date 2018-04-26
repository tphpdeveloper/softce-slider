<?php

namespace Softce\Slider\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class SlideRequest extends Request
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
        $rules = [
            'new_slide' => 'image',
            'text' => 'max:255'
        ];
        if($this->slide) {
            $rules['slide'] = 'image';
        }

        return $rules;
    }
}
