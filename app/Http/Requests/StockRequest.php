<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
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
            // 'entree'
            // 'sortie'
            // 'retour'
            // 'stock'
            'exercice_code' => ['required','bail','max:10'],
            'nature' => ['required', 'bail', 'max:30'],
            'montant_initial' => ['required', 'bail', 'numeric'],
            // 'entree_montant'
            // 'assemble_montant'
            // 'sortie_montant'
            // 'retour_montant'
            // 'stock_montant'
        ];
    }
}
