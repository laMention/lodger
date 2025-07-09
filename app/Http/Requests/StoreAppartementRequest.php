<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppartementRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'categorie' => 'required',
            'localisation' => 'required|max:255',
            'image_appart' => 'required|image|mimes:jpeg,png,jpg',
            'libelle_caution' => 'required',
            'periode' => 'required',
            'montant' => 'required|numeric',
            'loyer' => 'required|numeric',
            'libelle_commission' => 'required',
            'periode_commission' => 'required',
            'montant_commission' => 'required|numeric',
            'libelle_avance' => 'required',
            'periode_avance' => 'required',
            'montant_avance' => 'required|numeric',
            'proprio_phone' => 'numeric|min:13',
            'proprio_email' => 'email|unique:users,email'
        ];
    }
}
