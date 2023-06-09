<?php

namespace App\Http\Controllers;

use App\Models\BonSortie;
use App\Http\Requests\StoreBonSortieRequest;
use App\Http\Requests\UpdateBonSortieRequest;

class BonSortieController extends Controller
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
     * @param  \App\Http\Requests\StoreBonSortieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBonSortieRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BonSortie  $bonSortie
     * @return \Illuminate\Http\Response
     */
    public function show(BonSortie $bonSortie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BonSortie  $bonSortie
     * @return \Illuminate\Http\Response
     */
    public function edit(BonSortie $bonSortie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBonSortieRequest  $request
     * @param  \App\Models\BonSortie  $bonSortie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBonSortieRequest $request, BonSortie $bonSortie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BonSortie  $bonSortie
     * @return \Illuminate\Http\Response
     */
    public function destroy(BonSortie $bonSortie)
    {
        //
    }
}
