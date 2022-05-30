<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MouvementRequest extends FormRequest
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
            'obs' => ['bail','required','max:40'],
            'type' =>['bail','required','max:40'],
            'agent_mouvement' =>['bail','required','max:40'],
            'bureau_initial' => ['bail','required','numeric'],
            'bureau_final' => ['bail','required','numeric','different:bureau_initial'],
            'articles.*' => ['required','bail','numeric'],
            'qtes.*' => ['required','bail','numeric','min:0'],
        ];
    }
}
