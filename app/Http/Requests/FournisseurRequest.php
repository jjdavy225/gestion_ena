<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FournisseurRequest extends FormRequest
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
            'sigle' => ['bail','required','max:30'],
            'siege' => ['bail','required','max:30'],
            'adresse' => ['bail','max:40'],
            'tel' => ['bail','required','max:20'],
            'fax' => ['bail','required','max:20'],
            'email' => ['bail','required','email','max:30'],
            'site_web' => ['bail'],
            'r_com' => ['bail','max:40'],
            'ccont' => ['bail','max:40'],
            'banque' => ['bail','max:50'],
            'compte' => ['bail','max:50'],
            'contact' => ['bail','max:20'],
            'activite' => ['bail','required','max:30'],
            'capital' => ['bail'],
            'regime_impot' => ['bail','max:50'],
            'centre_impot' => ['bail','max:50'],
        ];
    }
}
