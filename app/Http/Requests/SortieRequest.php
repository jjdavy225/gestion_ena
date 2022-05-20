<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SortieRequest extends FormRequest
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
            'articles.*' => ['bail','required','numeric'],
            'qtes.*' => ['bail','required','numeric','min:0'],
            'date' => ['bail','required','date'],
            'nature' => ['bail','required','max:40'],
            'type_sortie' =>['required',Rule::in(['complete','partielle'])],
            'demande' => ['bail','required','numeric']
        ];
    }
}
