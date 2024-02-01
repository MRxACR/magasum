<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Unite;
use App\Models\Sortie;
use App\Models\Article;
use App\Models\Facture;
use App\Models\Commande;
use Dotenv\Parser\Value;
use App\Models\Catalogue;
use App\Models\Categorie;
use App\Models\Livraison;
use App\Models\Reception;
use App\Models\Fournisseur;
use App\Models\TypeArticle;
use Illuminate\Http\Request;
use App\Custom\Class\ArticleCustom;
use Illuminate\Support\Facades\Lang;
use App\Http\Requests\StoreReceptionRequest;
use App\Http\Requests\UpdateReceptionRequest;

class ReceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("voir_receptions");

        $receptions = Reception::all();
        return view('receptions.index')->with('receptions', $receptions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize("cree_receptions");

        $fournisseurs = Fournisseur::all();

        $articles = Article::all();

        $unites = Unite::all();

        $categories = Categorie::all();

        $types_articles = TypeArticle::all();

        $commandes = Commande::whereDoesntHave('livraison')->where('published', true)->get();

        return view('receptions.create')->with(
            [
                "commandes" => $commandes,

                "fournisseurs" => $fournisseurs,

                "articles" => $articles,

                "unites" => $unites,

                "categories" => $categories,

                "types_articles" => $types_articles,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReceptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReceptionRequest $request)
    {
        $this->authorize("cree_receptions");
        
        //dd($request);

        $articles = [];

        foreach ($request->articles as $key => $article_x) {

            $article = Article::where('desg_art', '=', $article_x["desg_art"] )->first();

            $categorie_id = Categorie::where('desg', '=', $article_x["categorie"] )->first()->id;

            $unite_id = Unite::where('desg', '=', $article_x["unite"])->first()->id;

            $type_id = TypeArticle::where('desg', '=', $article_x["type"])->first()->id;

            if (!$article) $article = Article::create([

                "desg_art" => $article_x["desg_art"],

                "categorie_id" => $categorie_id,

                "unite_id" => $unite_id,

                "type_id" => $type_id,

                "qte_init" => $article_x["quantity"],

                "qte_alt" => 1,
            ]);

            $article['commande_quantity'] = $article_x["quantity"];

            $article['commande_prix'] = $article_x["prix"];

            $article['n_inventaire'] = $article_x["inventaire"];
            
            $article['n_reference'] = $article_x["reference"];

            $article['quanity'] = $article_x["quantity"];

            $article['price'] = $article_x["prix"];

            $articles[] = $article;
        }

        $catalogue = Catalogue::create([

            "fournisseur_id" => $request->fournisseur,

            "tva" => $request->tva,
        ]);

        $old_id = 0;
        
        $id = 0;

        

        foreach ($articles as $article){

            if ($old_id != $article->id_art) $id = 0;

            $id++;

            $catalogue->articles()->attach(
                $article->id_art,
                [
                    "id" => $id,

                    "quantity" => $article->commande_quantity,

                    "prix" => $article->commande_prix,
                ]
            );

            $article['cat_id'] = $id;

            $old_id = $article->id_art;

        }
            

        $livraison = Livraison::create([

            'commande_id' => null,

            'catalogue_id' => $catalogue->id,

            'commande_num' => $request->num_bc,

            'commande_date' =>  Carbon::createFromFormat('d/m/Y', $request->date_bc)->format('Y-m-d'),

            'num' => $request->livraison,

            'date' => Carbon::createFromFormat('d/m/Y', $request->date_livraison)->format('Y-m-d'),

        ]);

        $facture = Facture::create([
            'livraison_id' => $livraison->id,

            'num' => $request->facture,

            'date' => Carbon::createFromFormat('d/m/Y', $request->date_facture)->format('Y-m-d'),

        ]);

        $reception = Reception::create([

            'num' => $request->num,

            'livraison_id' => $livraison->id,

            'facture_id' => $facture->id,

            'date' => date('Y-m-d'),

            'num_marche' => $request->num_marche,

            'num_consultation' => $request->num_consultation,

            'num_ods' => $request->num_ods,

        ]);

        $articles = collect($articles);

        foreach ($articles as $key => $article) {
            $reception->articles()->attach($article->id_art, ["id" => $article->cat_id, "quantity" => $article->quanity, "prix" => $article->price, "n_inventaire" => $article->n_inventaire, "n_reception" => $article->n_reference]);
        }

        return redirect('receptions/' . $reception->id)->with([

            'status' => 'success',

            'message' => Lang::get('messages.reception.creation'),

            'pc' => $reception,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function show(Reception $reception)
    {
        $this->authorize("voir_receptions");


        $montant_ht = 0;
        $tva = $reception->livraison->catalogue->tva;

        foreach ($reception->articles as $article) $montant_ht += $article->pivot->prix * $article->pivot->quantity;

        
        $montant_tva = $montant_ht * $tva / 100;
        $montant_ttc = $montant_tva + $montant_ht;

        $reception['tva'] = number_format($tva, 2, '.', '');
        $reception['montant_ht'] = number_format($montant_ht, 2, '.', '');
        $reception['montant_tva'] = number_format($montant_tva, 2, '.', '');
        $reception['montant_ttc'] = number_format($montant_ttc, 2, '.', '');


        return view('receptions.show')->with('reception', $reception);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function edit(Reception $reception)
    {
        $this->authorize("edit_receptions");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReceptionRequest  $request
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReceptionRequest $request, Reception $reception)
    {
        $this->authorize("edit_receptions");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reception $reception)
    {
        $this->authorize("supprimer_receptions");

        $sortie_after = Sortie::where('created_at','>=',$reception->created_at);

        if($sortie_after->count() > 0) {
            return redirect('receptions/')->with([
                'status' => 'warning',
                'message' => Lang::get('messages.reception.erreur'),
    
            ]);
        }
        else {
            $reception->delete();
            return redirect('receptions/')->with([
                'status' => 'success',
                'message' => Lang::get('messages.reception.supprimer'),
    
            ]);
        }
        
    }

}
