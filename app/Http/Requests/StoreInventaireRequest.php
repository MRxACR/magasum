<?php

namespace App\Http\Requests;

use App\Models\Article;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreInventaireRequest extends FormRequest
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
            //
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
        if( Article::all()->count() == 0 ) $validator->errors()->add('articles', "Aucun article n'a été trouver dans la base de données");
        });
    }
}
