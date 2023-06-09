<?php

namespace App\Http\Controllers;

use App\Models\Signal;
use App\Models\Sortie;
use App\Models\Article;
use App\Models\Reforme;
use App\Models\Commande;
use App\Models\BonSortie;
use App\Models\Reception;
use App\Models\Inventaire;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Models\PriseEnCharge;
use Illuminate\Support\Facades\DB;
use App\Custom\Class\ArticleCustom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $fournisseurs = Fournisseur::all()->count();
        $articles = Article::all();
        $sorties = Sortie::all()->count();
        $bonSorties = BonSortie::all()->count();
        $priseCharges = PriseEnCharge::all()->count();
        $reformes = Reforme::all()->count();
        $commandes = Commande::all()->count();
        $inventaires = Inventaire::all()->count();
        $receptions = Reception::all()->count();
        
        $disponible = 0;
        $alert = 0;
        $repture = 0;
        $total = 0;

        foreach ($articles as $article) {
            $article_fr_db = new ArticleCustom($article);
            $total ++;
            if($article_fr_db->en_repture()) $repture++;
            elseif($article_fr_db->en_alert()) $alert++;
            else $disponible ++; 
        }

        $total = $total>0?$total:1;
        $disponible = $disponible/$total*100;
        $alert = $alert/$total*100;
        $repture = $repture/$total*100;
    
        $articles_demandee = Article::with('sorties')->paginate(9);

        foreach ($articles_demandee as $demandee) {
            $article_fr_db = new ArticleCustom($demandee);
            $demandee['quantite'] = $article_fr_db->quantite_disp();
            $demandee['etat'] = $article_fr_db->etat();
            $demandee['alert'] = $article_fr_db->en_alert();
        }

        return view('home')->with(
            [
                "articles" => $articles->count(),
                "fournisseurs" => $fournisseurs,
                "sorties" => $sorties,
                "bonSorties" => $bonSorties,
                "priseCharge" => $priseCharges,
                "reformes" => $reformes,
                "commandes" => $commandes,
                "inventaires" => $inventaires,
                "receptions" => $receptions,
                "disponible" => $disponible,
                "alert" => $alert,
                "repture" => $repture,
                "articles_demandee" => $articles_demandee,
            ]
        );
    }

    public function api_get_home()
    {
        $data = [];

        // Push the Last 5 fornisseurs into data array
        $fournisseurs = Fournisseur::orderBy('id', 'DESC')->paginate(5);
        foreach ($fournisseurs as $fournisseur) {
            $fournisseur_data = [
                "title" => $fournisseur->nom . ' ' . $fournisseur->prenom,
                "subtitle" => $fournisseur->rs,
                "date" => $fournisseur->created_at->diffForHumans(),
                "url" => url("fournisseurs"),
                "type" => "fournisseur",
            ];
            array_push($data, $fournisseur_data);
        }


        // Push the Last 5 articles into data array
        $articles = Article::orderBy('id_art', 'DESC')->paginate(5);
        foreach ($articles as $article) {
            $article_data = [
                "title" => $article->desg_art,
                "subtitle" => $article->qte_stock,
                "date" => $article->created_at->diffForHumans(),
                "url" => url("articles"),
                "type" => "articles",

            ];
            array_push($data, $article_data);
        }


        // Push the Last 5 bs into data array
        $bonSorties = BonSortie::orderBy('sortie_id', 'DESC')->paginate(5);
        foreach ($bonSorties as $bs) {
            $bs_data = [
                "title" => $bs->sortie->nom . ' ' . $bs->sortie->prenom,
                "subtitle" => $bs->sortie->num,
                "date" => $bs->sortie->created_at->diffForHumans(),
                "url" => url("sorties/bs/" . $bs->sortie->id),
                "type" => "bon de sortie",

            ];
            array_push($data, $bs_data);
        }

        // Push the Last 5 pc into data array
        $priseCharges = PriseEnCharge::orderBy('sortie_id', 'DESC')->paginate(5);
        foreach ($priseCharges as $pc) {
            $pc_data = [
                "title" => $pc->sortie->nom . ' ' . $pc->sortie->prenom,
                "subtitle" => $pc->sortie->num,
                "date" => $pc->sortie->created_at->diffForHumans(),
                "url" => url("sorties/pc/" . $pc->sortie->id),
                "type" => "price en charge",

            ];
            array_push($data, $bs_data);
        }

        // Push the Last 5 rf into data array
        $reformes = Reforme::orderBy('sortie_id', 'DESC')->paginate(5);
        foreach ($reformes as $rf) {
            $rf_data = [
                "title" => $rf->sortie->nom . ' ' . $rf->sortie->prenom,
                "subtitle" => $rf->sortie->num,
                "date" => $rf->sortie->created_at->diffForHumans(),
                "url" => url("reformes/" . $rf->id),
                "type" => "reforme",

            ];
            array_push($data, $rf_data);
        }

        // return json response
        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function api_search_home(Request $request)
    {
        $data = [];
        $articles = Article::where("desg_art", "like", "%" . $request['data'] . "%")->orWhere('n_inventaire', "like", "%" . $request['data'] . "%")->paginate(5);
        foreach ($articles as $article) {
            $article_data = [
                "title" => $article->desg_art,
                "subtitle" => $article->n_inventaire,
                "date" => $article->created_at->diffForHumans(),
                "url" => url("articles"),
                "type" => "articles",

            ];
            array_push($data, $article_data);
        }

        $fournisseurs = Fournisseur::where("nom", "like", "%" . $request['data'] . "%")->orWhere('prenom', "like", "%" . $request['data'] . "%")->orWhere('rs', "like", "%" . $request['data'] . "%")->paginate(5);
        foreach ($fournisseurs as $fournisseur) {
            $fournisseur_data = [
                "title" => $fournisseur->nom . ' ' . $fournisseur->prenom,
                "subtitle" => $fournisseur->rs,
                "date" => $fournisseur->created_at->diffForHumans(),
                "url" => url("fournisseurs"),
                "type" => "fournisseur",
            ];
            array_push($data, $fournisseur_data);
        }



        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function signal(Request $request)
    {
       

        $request->validate([
            "url" => ["required","url"],
            "desc" => ["required"],
            ]);
        
        $request["user_id"] = Auth::user()->id;

        $signal = Signal::create($request->all());

        return redirect()->back()->with([
            'status' => 'success',
            'message' => Lang::get("messages.signale.envoie"),
        ]);
        
    }
}
