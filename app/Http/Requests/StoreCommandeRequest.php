<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommandeRequest extends FormRequest
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
            'num' => ['required', 'string', 'min:9', 'max:14', 'unique:commandes,num'],
            'date' => ['date_format:d/m/Y'],
            'denomination' => ['required', 'string', 'min:4', 'max:50'],
            'code' => ['alpha_num', 'max:50'],
            'adresse' => ['string', 'max:50'],
            'telephone' => [ 'max:12'],
            'fix' => [ 'max:11'],
            'fournisseur' => ['required', Rule::exists('fournisseurs', 'id')],
            'type' => ['required', Rule::exists('type_commandes', 'id')],
            'tva' => ['required', "numeric"],
            'object' => ['required', "string", "max:255"],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        
        $validator->after(function ($validator) {
            if (!isset($validator->getData()["articles"])) {
                $validator->errors()->add('articles', 'Vous devez au moins ajouter un article a la liste');
            }
            else{
                $articles_desg = [];
                foreach ($validator->getData()["articles"] as $key => $article) {
                    
                    if( !is_string($article["desg_art"]) ) $validator->errors()->add('articles', 'Un nom d\'article est invalide');
                    if( in_array($article["desg_art"], $articles_desg) ) $validator->errors()->add('articles', "Un nom d'article doit être unique dans la liste");
                    if( strlen($article["desg_art"]) < 4 ||  strlen($article["desg_art"]) > 50) $validator->errors()->add('articles', "Un nom d'article doit avoir ou mininum 4 caractères et au maximum 50 caractères");
                    if( strlen($article["quantity"]) > 5 ||  !is_numeric($article["quantity"]) ) $validator->errors()->add('articles', "Quantité invalid");
                    if( strlen($article["quantity"]) > 10 || !is_numeric($article["prix"]) ) $validator->errors()->add('articles', "Prix invalid");
                    
                    $articles_desg[] .= $article["desg_art"];
                }
            }
        });
    }
}
