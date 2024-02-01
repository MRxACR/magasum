<?php

namespace App\Http\Requests;

use App\Models\Article;
use App\Models\Reception;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreReceptionRequest extends FormRequest
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
            //'commande_id' => ['required', Rule::exists('commandes', 'id')],
            'livraison' => ['required', 'min:4', 'max:15'],
            'date_livraison' => ['date_format:d/m/Y'],
            'facture' => ['required', 'min:4', 'max:15'],
            'date_facture' => ['date_format:d/m/Y'],
            'num' => ['required', 'string', 'min:5', 'max:15', 'unique:receptions,num'],
            //'articles.*.id' => ['required',  Rule::exists('article_catalogue', 'article_id')],
            
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

  
        if(array_key_exists("articles",$validator->getData())){
            $validator->after(function ($validator) {
                return;

            
                $inventaire_prise = [];
                $all_reception = Reception::all();
        
                foreach ($all_reception as $reception) {
                    foreach($reception->articles as $article_repection){
                        $quantity = $article_repection->pivot->quantity;
                        $inventaire = explode('/',$article_repection->pivot->n_inventaire);
                        $num_inventaire = intval($inventaire[0]);
                        if($num_inventaire != null) for($i=$num_inventaire; $i < ($num_inventaire + $quantity); $i++) $inventaire_prise[] .= $i;
                    }
                };
    
                $teste = collect();
    
                foreach ($validator->getData()["articles"] as $key => $row) {
                    $num_inventaire = intval(explode('/',$row['n_inventaire'])[0]);
                    $article = Article::find($row['id']);
                    
                    if($article->type->desg == 'inventoriable') {
                        $teste->push($article);
                        
                        if($row['n_inventaire'] == null || $row['n_inventaire'] == "") $validator->errors()->add('articles', $article->desg_art  ."Un numéro d'inventaire n'est pas défini");
                        if(!is_int($num_inventaire) && isset($num_inventaire)) $validator->errors()->add('articles', "Tous les numéros d'inventaire doivent commencer par un chiffre");
                        if(in_array($num_inventaire,$inventaire_prise)) $validator->errors()->add('articles', "Le num d'inventaire ".$num_inventaire." est déja utilisé");
                        
                    }
                }
    
                //dd($validator->errors());
    
    
    
            });
        }
    }
}
