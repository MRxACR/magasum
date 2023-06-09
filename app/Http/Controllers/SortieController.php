<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;
use App\Models\Sortie;
use App\Models\Article;
use App\Models\Reforme;
use App\Models\BonSortie;
use App\Models\PriseEnCharge;
use App\Custom\Class\ArticleCustom;
use Illuminate\Support\Facades\Lang;
use App\Http\Requests\StoreSortieRequest;
use App\Http\Requests\UpdateSortieRequest;

class SortieController extends Controller
{
    public function index()
    {
        $this->authorize('voir_sorties');

        $sorties = Sortie::all();

        $prise_charges = PriseEnCharge::all();

        $bon_sorties = BonSortie::all();

        $reformes = Reforme::all();
        
        return view('sorties.index')->with(
            [

                'sorties' => $sorties,

                'bon_sorties' => $bon_sorties,

                'prise_charges' => $prise_charges,

                'reformes' => $reformes,
            ]
        );
    }

    public function create()
    {
        $this->authorize('cree_sorties');
        $articles = Article::all();

        foreach ($articles as $key => $article) {

            $article_fr_db = new ArticleCustom($article);

            if(!$article_fr_db->est_dispo()) $articles->forget($key);
        }

        return view('sorties.create')->with(
            [
                'articles' => $articles,
            ]
        );
    }

    public function store(StoreSortieRequest $request)
    {
        $this->authorize('cree_sorties');

        $request['date'] = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        
        $articles = json_decode($request->articles);

        $sortie = Sortie::create($request->all());

        foreach ($articles as $article){
        
            $article_db = Article::find($article->article_id);

            $sortie->articles()->attach($article->article_id, ["quantity" => $article->quantity, "observation" => $article->observation, "referance" => 
            
            $article->referance,"prix" => $article_db->prix]);

        }

        $champs = [

            "sortie_id" => $sortie->id,

            "service" => $request->service,

            "fonction" => $request->fonction,
        ];

        if ($request->type == 'bs') {

            $bs = BonSortie::create($champs);

            return redirect('sorties/bs/' . $sortie->id)->with([
                
                'status' => 'success',
                
                'message' => Lang::get('messages.sortie.creation.bs'),
                
                'bs' => $bs,
            ]);

        } 
        else {

            $pc = PriseEnCharge::create($champs);

            return redirect('sorties/pc/' . $sortie->id)->with([
                
                'status' => 'success',
                
                'message' => Lang::get('messages.sortie.creation.pc'),
                
                'bs' => $pc,
            ]);
        }
    }

    public function show(Sortie $sortie)
    {
        $this->authorize('show_sorties');
    }

    public function edit($sortie)
    {
        $this->authorize('modifier_sorties');

        $sortie = Sortie::findOrFail($sortie);

        $articles = Article::all();

        return view('sorties.create')->with([

            "sortie" => $sortie,

            'articles' => $articles,
        ]);
    }

    public function update(UpdateSortieRequest $request, $sortie)
    {
        $this->authorize('modifier_sorties');

        $request['date'] = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');

        $sortie = Sortie::findOrFail($sortie);

        if($sortie->prise_en_charge) $sortie->prise_en_charge->delete();
        
        if($sortie->bon_de_sortie) $sortie->bon_de_sortie->delete();
        
        $sortie->update(['num' => null]);

        $sortie->delete();

        $sortie = Sortie::create($request->all());

        $articles = json_decode($request->articles);

        foreach ($articles as $article){

                $article_db = Article::find($article->article_id);

                $sortie->articles()->attach($article->article_id, ["quantity" => $article->quantity, "observation" => $article->observation, "referance" => 
                
                $article->referance,"prix" => $article_db->prix]);
                }


        $champs = [
            
            "sortie_id" => $sortie->id,
            
            "service" => $request->service,
            
            "fonction" => $request->fonction,
        ];

        if ($request->type == 'bs') {
            
            $bs = BonSortie::create($champs);
            
            return redirect('sorties/bs/' . $sortie->id)->with([

                'status' => 'success',
                
                'message' => Lang::get('messages.sortie.mise.bs'),
                
                'bs' => $bs,

            ]);

        } else {
            
            $pc = PriseEnCharge::create($champs);

            return redirect('sorties/pc/' . $sortie->id)->with([

                'status' => 'success',

                'message' => Lang::get('messages.sortie.mise.pc'),

                'pc' => $pc,
            ]);
        }

    }
    public function destroy($sortie)
    {
        $this->authorize('supprimer_sorties');

        $sortie = Sortie::findOrFail($sortie);

        if($sortie->prise_en_charge) $sortie->prise_en_charge->delete();
        
        if($sortie->bon_de_sortie) $sortie->bon_de_sortie->delete();
        
        $sortie->update(['num' => null]);

        $sortie->delete();

        return redirect('sorties')->with([
            
            'status' => 'success',
            
            'message' => Lang::get('messages.sortie.supprimer.global'),
        ]);
    }

    public function bonSortie($id)
    {
        $this->authorize('voir_sorties');

        $bs = BonSortie::findOrFail($id);
        return view('sorties.bs')->with([
            "bs" => $bs,
        ]);
    }

    public function PriseCharge($id)
    {
        $this->authorize('voir_sorties');

        $pc = PriseEnCharge::findOrFail($id);
        return view('sorties.pc')->with([
            "pc" => $pc,
        ]);
    }

    public function signer($id)
    {
        $this->authorize('signer');

        $sortie = Sortie::findOrFail($id);
        $sortie->update(array('signer' => true));
        return redirect()->back();
    }

    public function unsigner($id)
    {
        $this->authorize('un_signer');

        $sortie = Sortie::findOrFail($id);
        $sortie->update(array('signer' => false));
        return redirect()->back();
    }
}
