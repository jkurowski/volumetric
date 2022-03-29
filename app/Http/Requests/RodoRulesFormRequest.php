<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RodoRulesFormRequest extends FormRequest
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
            'title' => 'required|string|min:5|max:255',
            'time' => 'numeric',
            'text' => 'required',
            'required' => 'boolean',
            'status' => 'boolean'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'text.required' => 'To pole jest wymagane',
            'title.required' => 'To pole jest wymagane',
            'title.max.string' => 'Maksymalna ilość znaków: 255',
            'title.min.string' => 'Minimalna ilość znaków: 5'
        ];
    }
}
