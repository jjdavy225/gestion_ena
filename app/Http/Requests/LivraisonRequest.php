<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivraisonRequest extends FormRequest
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
            'date' => ['required','bail','date'],
            'remise' => ['required','bail','numeric'],
            'tva' => ['required','bail','numeric'],
            'montant' => ['required','bail','numeric'],
            'delai' => ['required','bail','numeric'],
            'commande' => ['bail','required','numeric'],
            // 'agent' => ['bail','required','numeric'],
            'stock' => ['bail','required','numeric'],
            'num_bon' => ['bail','required','numeric'],
            'date_bon' => ['required', 'bail', 'date'],
            'fact_num' => ['bail', 'required', 'numeric'],
            'fact_date' => ['required', 'bail', 'date'],
        ];
    }
}
