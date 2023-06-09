<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Http\Requests\StoreFournisseurRequest;
use App\Http\Requests\UpdateFournisseurRequest;
use Illuminate\Support\Facades\Lang;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("voir_fournisseurs");
        
        $fournisseurs = Fournisseur::all();
        return view('fournisseurs.index')->with(
            ['fournisseurs' => $fournisseurs]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize("cree_fournisseurs");
        return view('fournisseurs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFournisseurRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFournisseurRequest $request)
    {
        $this->authorize("cree_fournisseurs");

        Fournisseur::create($request->all());
        return redirect('fournisseurs')->with([
            'status'=>'success',
            'message'=> Lang::get('messages.fournisseur.creation'),
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function show(Fournisseur $fournisseur)
    {
        $this->authorize("show_fournisseurs");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        $this->authorize("modifier_fournisseurs");
        return view('fournisseurs.create')->with([
            'fournisseur' => $fournisseur,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFournisseurRequest  $request
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFournisseurRequest $request, Fournisseur $fournisseur)
    {
        $this->authorize("modifier_fournisseurs");
        $fournisseur->update($request->all());
        return redirect('fournisseurs')->with([
            'status'=>'success',
            'message'=> Lang::get('messages.fournisseur.mise'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fournisseur $fournisseur)
    {
        $this->authorize("supprimer_fournisseurs");
        if ($fournisseur->commandes->count()>0) {
            return redirect('fournisseurs')->with([
                'status'=>'warning',
                'message'=> Lang::get('messages.fournisseur.supprimer.erreur'),
            ]);
        }
        else {
            $fournisseur->delete();
            return redirect('fournisseurs')->with([
                'status'=>'success',
                'message'=> Lang::get('messages.fournisseur.supprimer.reussi'),
            ]);
        }


        
    }
}
