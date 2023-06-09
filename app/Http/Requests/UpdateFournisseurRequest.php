<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFournisseurRequest extends FormRequest
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
            'nom' => ['required', 'string', 'min:4', 'max:20'],
            'prenom' => ['required', 'string', 'min:4', 'max:20'],
            'tel' => ['required', 'string', 'min:4', 'max:20'],
            'fax' => ['required', 'string', 'min:4', 'max:20'],
            'adr' => ['string'],
            'rc' => ['required', 'string', 'min:4', 'max:20'],
            'ai' => ['required', 'string', 'min:4', 'max:20'],
            'mf' => ['required', 'string', 'min:4', 'max:20'],
        ];
    }
}
