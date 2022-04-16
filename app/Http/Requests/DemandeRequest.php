<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DemandeRequest extends FormRequest
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
            'qtes.*' => ['bail','required','numeric'],
            'date' => ['bail','required','date'],
            'objet' => ['bail','required','max:300'],
            'fiche' => ['bail','required','max:300'],
            'delai' => ['bail','required','numeric'],
            'code_secteur' => ['bail','required','max:300'],
        ];
    }
}
