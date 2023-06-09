<?php

namespace App\Http\Controllers;

use App\Custom\Class\ArticleCustom;
use App\Models\Article;
use App\Models\Inventaire;
use App\Http\Requests\StoreInventaireRequest;
use App\Http\Requests\UpdateInventaireRequest;

class InventaireController extends Controller
{

    public function info_stock()
    {

        $info_stock = [];
        $nbr_elements = 0;
        $valeur_stock = 0;

        $stock = Article::all();

        $info_stock["nombre_articles"] = $stock->count();

        foreach ($stock as $article) {
            $nbr_elements += $article->qte_stock;
            $valeur_stock += $article->qte_stock * $article->prix;
        }

        $info_stock["nombre_elements"] = $nbr_elements;
        $info_stock["valeur_stock"] = $valeur_stock;

        return $info_stock;
    }

    public function index()
    {
        $this->authorize("voir_inventaires");

        $inventaires = Inventaire::all();
        $elements_inv = 0;
        $articles_inv = 0;
        $valeur_inv = 0;

        $articles = Article::all();

        foreach ($articles as $article) {
            $article_fr_db = new ArticleCustom($article);
            if ($article_fr_db->est_dispo()) {
                $articles_inv++;
                $valeur_inv += $article_fr_db->quantite_disp() * $article_fr_db->prix_stock();
                $elements_inv += $article_fr_db->quantite_disp();
            }
            
        }

        return view('inventaires.index')
            ->with([
                "inventaires" => $inventaires,
                "info_stock" => $this->info_stock(),
                "elements_inv" => $elements_inv,
                "articles_inv" => $articles_inv,
                "valeur_inv" => $valeur_inv,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize("create_inventaires");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInventaireRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInventaireRequest $request)
    {
        $this->authorize("cree_inventaires");

        $articles = Article::all();
        $champs = [
            "champs" => json_encode([
                "unite" => isset($request->unite),
                "quanite" => isset($request->quanite),
                "prix_unt" => isset($request->prix_unt),
                "prix_ttc" => isset($request->prix_ttc),
                "n_inventaire" => isset($request->n_inventaire),
                "n_serie" => isset($request->n_serie),
            ]),
        ];
        $inventaire = Inventaire::create($champs);

        foreach ($articles as $key => $article) {
            $article_fr_db = new ArticleCustom($article);
            if (!$article_fr_db->est_dispo()) $articles->forget($key);
            else {
                $inventaire->articles()->attach(
                    $article->id_art,
                    [
                        "quantity" => $article_fr_db->quantite_disp(),
                        "n_inventaire" => $article->n_inventaire,
                        "n_referance" => $article->nsr_art,
                        "prix" => $article_fr_db->prix_stock(),
                    ]
                );
            }
        };

        return redirect('inventaires/' . $inventaire->id)->with([
            'status' => 'success',
            'message' => 'L\'inventaire à été créé',
            'inventaire' => $inventaire,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventaire  $inventaire
     * @return \Illuminate\Http\Response
     */
    public function show(Inventaire $inventaire)
    {
        $this->authorize("voir_inventaires");

        $total = 0;
        $elements = 0;
        foreach ($inventaire->articles as $article) {
            $total += $article->pivot->prix * $article->pivot->quantity;;
            $elements += $article->pivot->quantity;
        }

        $inventaire["total"] = $total;
        $inventaire["elements"] = $elements;
        $inventaire["champs"] = json_decode($inventaire->champs);
        return view('inventaires.show')->with('inventaire', $inventaire);;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventaire  $inventaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventaire $inventaire)
    {
        $this->authorize("edit_inventaires");

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInventaireRequest  $request
     * @param  \App\Models\Inventaire  $inventaire
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInventaireRequest $request, Inventaire $inventaire)
    {
        $this->authorize("edit_inventaires");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventaire  $inventaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventaire $inventaire)
    {
        $this->authorize("supprimer_inventaires");

        $inventaire->delete();
        return redirect('inventaires')->with([
            'status' => 'success',
            'message' => 'L\'inventaire à été suprimer supprimer',
        ]);
    }
}
