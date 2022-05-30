<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RetourRequest extends FormRequest
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
            'date' => ['bail', 'required', 'date'],
            'obs' => ['bail', 'required', 'max:50'],
            'bureau' => ['bail','required','numeric'],
            'stock' => ['bail','required','numeric'],
            'articles.*' => ['bail','required','numeric'],
            'qtes.*' => ['bail','required','numeric','min:0'],
        ];
    }
}
