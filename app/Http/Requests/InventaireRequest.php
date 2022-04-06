<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventaireRequest extends FormRequest
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
            'initial' => ['required','bail','numeric'],
            'physique' => ['required','bail','numeric'],
            'final' => ['required','bail','numeric'],
            'maj' => ['required','bail','numeric'],
            'exercice_code' => ['required', 'bail', 'max:30'],
            'nature' => ['required', 'bail', 'max:30'],
        ];
    }
}
