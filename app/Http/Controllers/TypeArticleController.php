<?php

namespace App\Http\Controllers;

use App\Models\TypeArticle;
use App\Http\Requests\StoreTypeArticleRequest;
use App\Http\Requests\UpdateTypeArticleRequest;

class TypeArticleController extends Controller
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
     * @param  \App\Http\Requests\StoreTypeArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeArticleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeArticle  $typeArticle
     * @return \Illuminate\Http\Response
     */
    public function show(TypeArticle $typeArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeArticle  $typeArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeArticle $typeArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTypeArticleRequest  $request
     * @param  \App\Models\TypeArticle  $typeArticle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeArticleRequest $request, TypeArticle $typeArticle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeArticle  $typeArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeArticle $typeArticle)
    {
        //
    }
}
