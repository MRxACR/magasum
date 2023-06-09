<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFournisseurRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *, 'unique:commandes,num'
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
            'rs' => ['required', 'string','max:50'],
            'nom' => ['required', 'string', 'min:4', 'max:20'],
            'prenom' => ['required', 'string', 'min:4', 'max:20'],
            'tel' => ['required', 'string', 'min:4', 'max:20', 'unique:fournisseurs,tel'],
            'fax' => ['required', 'string', 'min:4', 'max:20', 'unique:fournisseurs,fax'],
            'adr' => ['string'],
            'rc' => ['required', 'string', 'min:4', 'max:20', 'unique:fournisseurs,rc'],
            'ai' => ['required', 'string', 'min:4', 'max:20', 'unique:fournisseurs,ai'],
            'mf' => ['required', 'string', 'min:4', 'max:20', 'unique:fournisseurs,mf'],
        ];
    }
}
