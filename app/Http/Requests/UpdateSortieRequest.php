<?php

namespace App\Http\Requests;

use App\Models\Article;
use App\Custom\Class\ArticleCustom;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSortieRequest extends FormRequest
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
            'num' => "required|min:4|max:15",
            'nom' => "required|string|min:4|max:15",
            'prenom' => "required|string|min:4|max:15",
            'date' => "required|date_format:d/m/Y",
            'service' => "string|min:4|max:50",
            'fonction' => "string|min:4|max:50",
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
            $articles_selected = json_decode($validator->getData()["articles"]);
           
            

            // vérifier si la liste d'articles n'est pas vide
            if (count($articles_selected) < 1) $validator->errors()->add('articles', 'Vous devez au moins ajouter un article');

            // Vérification pour chaque article
            foreach ($articles_selected as $article) {
                $article_db = Article::find($article->article_id);

                $article_fr_db = new ArticleCustom($article_db);

                // vérifier si l'article existe dans la base de données
                if(! $article_db ) $validator->errors()->add('articles', "un article n'éxiste pas dans la base de données");
                
                // vérifier si la quantité de l'article est disponible
                if( !$article_fr_db->est_dispo($article->quantity) ) $validator->errors()->add('articles', "Quantité de ".$article->designation." est indisponible, la quantité disponible est: " . $article_fr_db->quantite_disp());
                
                //$article_fr_db->close();
            }
        });

    }
}
