<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sortie;
use App\Models\Article;
use App\Models\Facture;
use App\Models\Commande;
use Dotenv\Parser\Value;
use App\Models\Catalogue;
use App\Models\Livraison;
use App\Models\Reception;
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
        $this->authorize("cree_receptions");

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

        $commandes = Commande::whereDoesntHave('livraison')->get();

        return view('receptions.create')->with(
            [
                "commandes" => $commandes,
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

        $commande = Commande::find($request->commande_id);

        $catalogue = $commande->catalogue;

        $livraison = Livraison::create([

            'commande_id' => $request->commande_id,

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
        
        $articles_to_submit = collect();

        foreach ($request->articles as $key => $value) {
            
            $articles_to_submit->push([
                "id" => $value["id"],
                "n_inventaire" => $value["n_inventaire"],
            ]);
        };

        foreach ($catalogue->articles as $article) {

            $article_fr_db = new ArticleCustom($article);

            $qte_init = $article_fr_db->quantite_disp() + $article->pivot->quantity;
            $qte_alt = intval($qte_init * 30 / 100);

            $article->update([
                "qte_init" => $qte_init,
                "qte_stock" => $qte_init,
                "qte_alt" => $qte_alt,
            ]);
            
            $n_inventaire = $articles_to_submit->where('id',$article->id_art)->first()['n_inventaire'];
            $quanity = $article->pivot->quantity;
            $prix = $article->pivot->prix;

            $reception->articles()->attach($article->id_art, ["quantity" => $quanity, "prix" => $prix, "n_inventaire" => $n_inventaire]);
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
        $tva = $reception->livraison->commande->catalogue->tva;

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
