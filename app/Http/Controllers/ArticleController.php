<?php

namespace App\Http\Controllers;

use App\Models\Unite;
use App\Models\Article;
use App\Models\TypeArticle;
use Illuminate\Http\Request;
use App\Custom\Class\ArticleCustom;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('voir_articles');
        $articles = Article::paginate(50);
        foreach ($articles as $article) {
            $article_fr_db = new ArticleCustom($article);
            $article["quantite"] = $article_fr_db->quantite_disp();
            $article["etat"] =  $article_fr_db->etat();
            $article["alert"] = $article_fr_db->en_alert();
        }
        return view("articles.index")->with([
            "articles" => $articles 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('cree_articles');
        $articles = Article::all();
        $types = TypeArticle::all();
        $unites = Unite::all();
        return view("articles.create")->with([
            "articles" => $articles ,
            "types" => $types ,
            "unites" => $unites ,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $this->authorize('cree_articles');
        TypeArticle::where('id_typ_art', $request->id_typ_art)->firstOrFail();
        Unite::where('id_unt', $request->id_unt)->firstOrFail();
        Article::create($request->all());
        return redirect('articles')->with([
            'status'=>'success',
            'message'=>'article ajouter avec success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $this->authorize('voir_articles');

        $article_fr_db = new ArticleCustom($article);
   
        $article['stock'] = $article_fr_db->quantite_disp();

        // Create a mouvements object
        $mouvements = collect();

        // Remplissage de l'object mouvements avec des sorties 
        $sorties = $article->sorties;
        foreach ($sorties as $sortie) {

            if($sortie->type == "rf") {
                $sortie['document'] = $sortie->reforme->document->titre;;
                $sortie['info'] = "-";
                $sortie['beneficiaire'] = null;
            }
            elseif($sortie->type == "bs") {
                $sortie['document'] = $sortie->bon_de_sortie->document->titre;;
                $sortie['info'] = $sortie->bon_de_sortie->service;
                $sortie['beneficiaire'] = $sortie->nom.' '.$sortie->prenom;
            }
            elseif($sortie->type == "pc") {
                $sortie['document'] = $sortie->prise_en_charge->document->titre;
                $sortie['info'] = $sortie->prise_en_charge->fonction;
                $sortie['beneficiaire'] = $sortie->nom.' '.$sortie->prenom;
            }

            $champ = [
                "num" => $sortie->num,
                "date" => $sortie->date,
                "mouvement" => "sortie",
                "quanite" => $sortie->pivot->quantity,
                "prix" => $sortie->pivot->prix,
                "document"  => $sortie->document,
                "beneficiaire" =>  $sortie->beneficiaire,
                "info" =>  $sortie->info,
                "created_at" => $sortie->created_at,
                
            ];

            $mouvements->push($champ);
        }

        // Remplissage de l'object mouvements avec des inventaires 
        $inventaires = $article->inventaires;
        foreach ($inventaires as $inventaire) {

            
            
            $champ = [
                "num" => $inventaire->id,
                "date" => $inventaire->date,
                "mouvement" => "-",
                "quanite" => $inventaire->pivot->quantity,
                "prix" => $inventaire->pivot->prix,
                "document"  => $inventaire->document->titre, 
                "beneficiaire" =>  "-",
                "info" =>  "-",
                "created_at" => $inventaire->created_at,
            ];

            $mouvements->push($champ);

        }

        // Remplissage de l'object mouvements avec des commande 
        $catalogues = $article->catalogues;
        foreach ($catalogues as $catalogue) {

            $champ = [
                "num" => $catalogue->commande->num,
                "date" => $catalogue->commande->date,
                "mouvement" => "-",
                "quanite" => $catalogue->pivot->quantity,
                "prix" =>  $catalogue->pivot->prix,
                "document"  => $catalogue->commande->document->titre, 
                "beneficiaire" =>  $catalogue->commande->fournisseur->nom . ' ' . $catalogue->commande->fournisseur->prenom,
                "info" =>  "-",
                "created_at" => $catalogue->commande->created_at,
            ];

            $mouvements->push($champ);
        }

        // Remplissage de l'object mouvements avec des receptions 
        $receptions = $article->receptions;
        foreach ($receptions as $reception) {

            $champ = [
                "num" => $reception->num,
                "date" => $reception->date,
                "mouvement" => "entrée",
                "quanite" => $reception->pivot->quantity,
                "prix" =>  $reception->pivot->prix,
                "document"  => $reception->document->titre, 
                "beneficiaire" =>  "Magasin",
                "info" =>  $reception->pivot->n_inventaire,
                "facture" =>  $reception->facture->num,
                "facture_date" =>  $reception->facture->date,
                "created_at" => $reception->created_at,
            ];

            $mouvements->push($champ);
        }

       return view('articles.show')->with(
        [
            "mouvements" => $mouvements->sortBy('created_at'),
            'article' => $article,
        ]
       );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $this->authorize('modifier_articles');
        $articles = Article::all();
        $types = TypeArticle::all();
        $unites = Unite::all();
        return view("articles.create")->with([
            "articles" => $articles ,
            "article" => $article ,
            "types" => $types ,
            "unites" => $unites ,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $this->authorize('modifier_articles');

        TypeArticle::where('id_typ_art', $request->id_typ_art)->firstOrFail();
        Unite::where('id_unt', $request->id_unt)->firstOrFail();
        $article->update($request->all());
        return redirect('articles')->with([
            'status'=>'success',
            'message'=>'article est mis a jour avec success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $this->authorize('supprimer_articles');
        $article->delete();

        return redirect('articles')->with([
            'status'=>'success',
            'message'=>'article à élé supprimer avec success',
        ]);
    }

    public function api_get_articles()
    {
        $this->authorize('voir_articles');
        $data = [];
        $articles = Article::paginate(10);

        foreach ($articles as $article) {
            $article_fr_db = new ArticleCustom($article);

            $article_data = [
                "no" => $article->id_art,
                "designation" => $article->desg_art,
                "categorie" => $article->categorie->desg,
                "type" => $article->type->desg,
                "quantite" => $article_fr_db->quantite_disp(),
                "url" => url("articles/".$article->id_art),
                "etat" => $article_fr_db->etat(),
                "alert" => $article_fr_db->en_alert(),

            ];
            array_push($data, $article_data);
        }
        return response()->json([
            'success' => true,
            'articles' => $data,
        ], 200);
    }

    public function api_search_articles(Request $request)
    {
        $this->authorize('voir_articles');
        $article = Article::where("desg_art","like","%".$request['data']."%")->paginate(10);

        return response()->json([
            'success' => true,
            'articles' => $article,
        ], 200);
    }

    //'no', 'designation', 'categorie', 'type', 'quantite', 'url', 'etat'
    public function api_search_articles_2(Request $request)
    {
        $this->authorize('voir_articles');
        $data = [];

        // search by designation
        $articles = Article::where("desg_art", "like", "%" . $request['data'] . "%");
        
        // search by quantity
        $articles = $articles->orWhere("qte_stock", "like", "%" . $request['data'] . "%");

        // search by id
        $articles = $articles->orWhere("id_art", "like", "%" . $request['data'] . "%");

        // return only 10 rows
        $articles = $articles->paginate(10);
        
        // get the specified data
        foreach ($articles as $article) {
            $article_fr_db = new ArticleCustom($article);

            $article_data = [
                "no" => $article->id_art,
                "designation" => $article->desg_art,
                "categorie" => $article->categorie->desg,
                "type" => $article->type->desg,
                "quantite" => $article_fr_db->quantite_disp(),
                "url" => url("articles/".$article->id_art),
                "etat" => $article_fr_db->etat(),
                "alert" => $article_fr_db->en_alert(),

            ];
            array_push($data, $article_data);
        }

        // return the respense
        return response()->json([
            'success' => true,
            'articles' => $data,
        ], 200);
    }
}
