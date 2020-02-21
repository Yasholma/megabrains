<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LectureRequest extends FormRequest
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
        return [
            'section' => 'required|min:5|max:255',
            'sectionDesc' => 'required|min:10|max:300',
        ];
    }

    public function messages()
    {
        return [
            'section.required' => 'Section Title is required',
            'sectionDesc.required' => 'Section Description is required.',
        ];
    }
}
