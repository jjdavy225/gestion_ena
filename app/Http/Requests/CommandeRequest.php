<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommandeRequest extends FormRequest
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
            'date' => ['bail','required','date'],
            'objet' => ['bail','required','max:500'],
            'num_fact' => ['bail','required','max:500'],
            'date_fact' => ['bail','required','date'],
            'remise' => ['bail','required','numeric'],
            'tva' => ['bail','required','numeric'],
            'montant' => ['bail','required','numeric'],
            'delai_paie' => ['bail','required','numeric'],
            'delai_liv' => ['bail','required','numeric'],
            'date_liv' => ['bail', 'required', 'date'],
            'fournisseur' => ['required','bail','numeric'],
            'agent' => ['required','bail','numeric'],
            'frais' => ['bail', 'required', 'numeric'],
            'garantie' => ['bail', 'required', 'numeric'],
        ];
    }
}
