<?php

namespace App\Http\Controllers;

use App\Models\TypeCommande;
use App\Http\Requests\StoreTypeCommandeRequest;
use App\Http\Requests\UpdateTypeCommandeRequest;

class TypeCommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTypeCommandeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeCommandeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeCommande  $typeCommande
     * @return \Illuminate\Http\Response
     */
    public function show(TypeCommande $typeCommande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeCommande  $typeCommande
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeCommande $typeCommande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTypeCommandeRequest  $request
     * @param  \App\Models\TypeCommande  $typeCommande
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeCommandeRequest $request, TypeCommande $typeCommande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeCommande  $typeCommande
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeCommande $typeCommande)
    {
        //
    }
}
