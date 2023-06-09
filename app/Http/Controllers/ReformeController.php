<?php

namespace App\Http\Controllers;

use App\Custom\Class\ArticleCustom;
use Carbon\Carbon;
use App\Models\Sortie;
use App\Models\Article;
use App\Models\Reforme;
use Illuminate\Support\Facades\Lang;
use App\Http\Requests\StoreReformeRequest;
use App\Http\Requests\UpdateReformeRequest;

class ReformeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("voir_reformes");

        $reformes = Reforme::all();
        $articles_rf = 0;
        $elements_rf = 0;
        $valeur_rf = 0;
        foreach ($reformes as $reforme) {
            $articles_rf += $reforme->sortie->articles->count();
            foreach ($reforme->sortie->articles as $article) {
                $article_db = new ArticleCustom($article);
                $elements_rf += $article->pivot->quantity;
                $valeur_rf += $article->pivot->quantity * $article_db->prix_stock();
            }

        };

        


        $startDate = Carbon::parse($reformes->first()->sortie->date ?? now());
        $endDate = Carbon::parse($reformes->last()->sortie->date ?? now());
        $nbr_years =   $startDate->diffInYears($endDate);
        $nbr_years = $nbr_years > 0 ? $nbr_years : 1;
        return view('reformes.index')->with(
            [
                "reformes" => $reformes,
                "nbr_years" => $nbr_years,
                "articles_rf" => $articles_rf,
                "elements_rf" => $elements_rf,
                "valeur_rf" => $valeur_rf,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize("cree_reformes");

        $articles = Article::all();
        return view('reformes.create')->with([
            "articles" => $articles,
        ]);
    }

    public function articlesExpires()
    {
        $this->authorize("cree_reformes_expiser");

        $articles = Article::all();
        $articles_exp = [];
        $count = 0;

        foreach ($articles as $key => $value) {
            $count++;
            // mettre une condition valide plus tard
            $articles_exp[$key] = $value;
            if ($count > 10) break;
        }
        return view('reformes.create')->with([
            "articles" => $articles,
            "articles_exp" => $articles_exp,
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReformeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReformeRequest $request)
    {
        $this->authorize("cree_reformes");

        $request['num'] = "rf" . '/' . fake()->numerify('####/') . date('m/Y');

        $request["motif"] = json_decode($request->motif);

        $sortie = Sortie::create(['num' => $request->num, 'type' => 'rf']);
        $articles = json_decode($request->articles);


        foreach ($articles as $article) {
            $article_db = Article::find($article->article_id);
            $sortie->articles()->attach($article->article_id, ["quantity" => $article->quantity, "observation" => $article->observation, "prix" => $article_db->prix]);
        }

        $request["sortie_id"] = $sortie->id;
        $request["document_id"] = 3;

        $reforme = Reforme::create($request->all());

        return redirect('reformes/' . $sortie->id)->with([
            'status' => 'success',
            'message' => Lang::get('messages.sortie.creation.rf'),
            'rf' => $reforme,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reforme  $reforme
     * @return \Illuminate\Http\Response
     */
    public function show(Reforme $reforme)
    {
        $this->authorize("voir_reformes");
        return view('reformes.rf')->with([
            "rf" => $reforme,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reforme  $reforme
     * @return \Illuminate\Http\Response
     */
    public function edit(Reforme $reforme)
    {
        $this->authorize("modifier_reformes");


        $articles = Article::all();
        return view('reformes.create')->with([
            "articles" => $articles,
            "reforme" => $reforme,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReformeRequest  $request
     * @param  \App\Models\Reforme  $reforme
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReformeRequest $request, Reforme $reforme)
    {
        $this->authorize("modifier_reformes");

        $request["motif"] = json_decode($request->motif);

        $sortie = $reforme->sortie;
        $articles = json_decode($request->articles);

        $sortie->articles()->detach();
        foreach ($articles as $article) {
            $sortie->articles()->attach($article->article_id, ["quantity" => $article->quantity, "observation" => $article->observation, "prix" => Article::find($article->article_id)->prix]);
        }

        $request["sortie_id"] = $sortie->id;
        $request["document_id"] = 3;

        $reforme->update($request->all());


        return redirect('reformes/' . $sortie->id)->with([
            'status' => 'success',
            'message' => Lang::get('messages.sortie.mise.rf'),
            'rf' => $reforme,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reforme  $reforme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reforme $reforme)
    {
        $this->authorize("supprimer_reformes");

        $reforme->sortie->delete();
        $reforme->delete();
        return redirect('reformes')->with([
            'status' => 'success',
            'message' => Lang::get('messages.sortie.supprimer.rf'),
        ]);
    }
}
