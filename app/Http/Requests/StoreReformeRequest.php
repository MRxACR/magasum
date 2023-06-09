<?php

namespace App\Http\Requests;

use App\Models\Article;
use App\Custom\Class\ArticleCustom;
use Illuminate\Foundation\Http\FormRequest;

class StoreReformeRequest extends FormRequest
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
            'motif' => "required|min:15",
        ];
    }

     /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {

        $validator->after(function ($validator) {

            // Récupérer l'article
            $articles = json_decode($validator->getData()["articles"]);

            // vérifier si la liste d'articles n'est pas vide
            if (count($articles) < 1) $validator->errors()->add('articles', 'Vous devez au moins ajouter un article');

            // Vérification pour chaque article
            foreach ($articles as $article) {
                $article_db = Article::find($article->article_id);
                
                $article_fr_db = new ArticleCustom($article_db);
                
                // vérifier si l'article existe dans la base de données
                if(! $article_db ) $validator->errors()->add('articles', "un article n'éxiste pas dans la base de données");
                
                // vérifier si la quantité de l'article est disponible
                if( !$article_fr_db->est_dispo($article->quantity) ) $validator->errors()->add('articles', "Quantité de ".$article->designation." est indisponible, la quantité disponible est: " . $article_fr_db->quantite_disp());
            }



        });
    }
}
