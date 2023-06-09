<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use NumberFormatter;
use App\Models\Unite;
use App\Models\Article;
use App\Models\Commande;
use App\Models\Catalogue;
use App\Models\Categorie;
use App\Models\Fournisseur;
use App\Models\TypeArticle;
use App\Models\TypeCommande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("voir_commandes");

        $commandes = Commande::all();

        return view("commandes.index")->with('commandes', $commandes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize("cree_commandes");

        $fournisseurs = Fournisseur::all();

        $articles = Article::all();

        $unites = Unite::all();

        $categories = Categorie::all();

        $types = TypeCommande::all();

        $unites = Unite::all();

        $types_articles = TypeArticle::all();

        return view("commandes.create")->with([

            "types" => $types,

            "fournisseurs" => $fournisseurs,

            "articles" => $articles,

            "unites" => $unites,

            "categories" => $categories,

            "types_articles" => $types_articles,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommandeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommandeRequest $request)
    {
        $this->authorize("cree_commandes");

        $request['date'] = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');

        $articles = [];

        foreach ($request->articles as $key => $article_x) {

            $article = Article::where('desg_art', 'like', '%' . $article_x["desg_art"] . '%')->first();

            $categorie_id = Categorie::where('desg', 'like', '%' . $article_x["categorie"] . '%')->first()->id;

            $unite_id = Unite::where('desg', 'like', '%' . $article_x["unite"] . '%')->first()->id;

            $type_id = TypeArticle::where('desg', 'like', '%' . $article_x["type"] . '%')->first()->id;

            if (!$article) $article = Article::create([

                "desg_art" => $article_x["desg_art"],

                "categorie_id" => $categorie_id,

                "unite_id" => $unite_id,

                "type_id" => $type_id,
            ]);

            $article['commande_quantity'] = $article_x["quantity"];

            $article['commande_prix'] = $article_x["prix"];

            $articles[] = $article;
        }


        $catalogue = Catalogue::create([

            "fournisseur_id" => $request->fournisseur,

            "tva" => $request->tva,
        ]);



        foreach ($articles as $article)
            $catalogue->articles()->attach(
                $article->id_art,
                [
                    "quantity" => $article->commande_quantity,

                    "prix" => $article->commande_prix,
                ]
            );


        $champs = [

            "num" => $request->num,

            "date" => $request->date,

            "denomination" => $request->denomination,

            "code" => $request->code,

            "adresse" => $request->adresse,

            "telephone" => $request->telephone,

            "fix" => $request->fix,

            "object" => $request->object,

            "fournisseur_id" => $catalogue->fournisseur_id,

            "catalogue_id" => $catalogue->id,

            "type_commande_id" => $request->type,

            "document_id" => 5,
        ];

        $commande = Commande::create($champs);



        return redirect('commandes/' . $commande->id)->with([

            'status' => 'success',

            'message' => Lang::get('messages.commande.creation'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande)
    {
        $this->authorize("voir_commandes");

        $formater = new NumberFormatter("fr", NumberFormatter::SPELLOUT);

        $types = TypeCommande::all();

        $montant_ht = 0;

        foreach ($commande->catalogue->articles as $article) {

            $montant_ht += $article->pivot->prix * $article->pivot->quantity;
        }

        $commande['montant_ht'] = number_format($montant_ht, 2, '.', '');

        $commande['montant_tva'] = number_format($commande->catalogue->tva * $montant_ht / 100, 2, '.', '');

        $commande['montant_ttc'] = number_format($commande->montant_tva + $montant_ht, 2, '.', '');

        $montant_ttc_exploded = explode('.', number_format($commande->montant_ttc, 2, '.', ''));

        $commande['somme_en_lettre'] = isset($montant_ttc_exploded[1]) ?  $formater->format($montant_ttc_exploded[0]) . ' dinars et ' . $formater->format($montant_ttc_exploded[1]) . ' cts' : $formater->format($montant_ttc_exploded[0]) . ' dinars';

        return view('commandes.show')->with([

            'commande' => $commande,

            'types' => $types,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function edit(Commande $commande)
    {
        $this->authorize("edit_commandes");

        return redirect('commandes');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommandeRequest  $request
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommandeRequest $request, Commande $commande)
    {
        $this->authorize("edit_commandes");

        return redirect('commandes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commande $commande)
    {
        $this->authorize("supprimer_commandes");

        if ($commande->livraison) {
            return redirect('commandes')->with([

                'status' => 'warning',

                'message' => Lang::get("messages.commande.erreur"),

            ]);
        } else {

            $commande->update(["num" => null]);

            $commande->delete();

            return redirect('commandes')->with([

                'status' => 'success',

                'message' => Lang::get("messages.commande.supprimer"),

            ]);
        }

    }



    public function api_get_commande(Request $request)
    {
        $this->authorize("voir_commandes");

        //no designation quantite prix montant
        $commande = Commande::find($request['data']);

        $data = [];

        $i = 1;

        //return $commande->catalogue->articles[0]->pivot->quantity;
        foreach ($commande->catalogue->articles as $article) {

            $article_data = [

                "no" => $i++,

                "id" => $article->id_art,

                "designation" => $article->desg_art,

                "categorie" => $article->categorie->desg,

                "type" => $article->type_id == 2,

                "quantite" => $article->pivot->quantity ?? 0,

                "prix" => number_format($article->pivot->prix, 2, ',', ' ') . ' DA',

                "montant" => number_format($article->pivot->quantity * $article->pivot->prix, 2, ',', ' ') . ' DA',

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
