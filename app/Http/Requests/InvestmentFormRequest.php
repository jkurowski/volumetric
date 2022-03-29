<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvestmentFormRequest extends FormRequest
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
            'status' => 'integer',
            'name' => 'required|string|min:5|max:100',
            'address' => 'required',
            'city' => 'required',
            'deadline' => '',
            'start_date' => '',
            'lat' => '',
            'lng' => '',
            'zoom' => '',
            'entry_content' => '',
            'url' => 'required'
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
            'address.required' => 'To pole jest wymagane',
            'city.required' => 'To pole jest wymagane',
            'url.required' => 'To pole jest wymagane',
            'deadline.required' => 'To pole jest wymagane',
            'name.required' => 'To pole jest wymagane',
            'name.max.string' => 'Maksymalna ilość znaków: 100',
            'name.min.string' => 'Minimalna ilość znaków: 5'
        ];
    }
}
