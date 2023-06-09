@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <a href="{{ url('articles') }}" class="btn btn-outline-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="40"
                            height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"></path>
                        </svg>
                        Page précedente
                    </a>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        @isset($article)
                            <button class="btn btn-outline-warning" onclick="$('#articles-form').submit()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check"
                                    width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M5 12l5 5l10 -10"></path>
                                </svg>
                                Mettre a jour
                            </button>
                        @else
                            <button class="btn btn-outline-success" onclick="$('#articles-form').submit()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check"
                                    width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M5 12l5 5l10 -10"></path>
                                </svg>
                                Enregistrer
                            </button>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card p-3">
                <form action="@isset($article) {{ url('articles/'.$article->id_art) }} @else {{ url('articles') }} @endisset" method="post" id="articles-form">
                    @isset($article)
                        @method('PUT')
                    @else
                        @method('POST')
                    @endisset
                    @csrf
                    <div class="row" x-data="{ nsr_art: '@isset($article){!! $article->nsr_art !!}@endisset', n_inventaire: '@isset($article){!! $article->n_inventaire !!}@endisset' }">


                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Désignation</label>
                                <input type="text" class="form-control" name="desg_art"
                                    value="@if (old('desg_art') != null) {{ old('desg_art') }} @else @isset($article) {{ $article->desg_art }} @endisset @endif"
                                    placeholder="Nom de l'article">
                            </div>
                            <div class="invalid-feedback">Invalid feedback</div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">N° Serie</label>
                                <input type="text" class="form-control" name="nsr_art"
                                    value="@if (old('nsr_art') != null) {{ old('nsr_art') }} @else @isset($article) {{ $article->nsr_art }}@endisset @endif"
                                    placeholder="Ref-123456789" x-model="nsr_art">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">N° Inventaire</label>
                                <input type="text" class="form-control" name="n_inventaire"
                                    value="@if (old('n_inventaire') != null) {{ old('n_inventaire') }} @else @isset($article){{ $article->n_inventaire }}@endisset @endif"
                                    placeholder="12345/SDMM/22" x-model="n_inventaire">

                            </div>
                        </div>

                        <div class="col-md-6" x-show="n_inventaire.length==0 && nsr_art.length==0">
                            <div class="mb-3">
                                <label class="form-label">Quanitité Alerte</label>
                                <input type="text" class="form-control" name="qte_alt"
                                    value="@if (old('qte_alt') != null) {{ old('qte_alt') }} @else @isset($article) {{ $article->qte_alt }}@endisset @endif">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <div class="form-label">Type Article</div>
                                <select class="form-select" name="id_typ_art">
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id_typ_art }}" @isset($article) @if($type->id_typ_art == $article->id_typ_art) selected @endif @endisset >{{ $type->typ_art }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <div class="form-label">Unité</div>
                                <select class="form-select" name="id_unt">
                                    @foreach ($unites as $unit)
                                        <option value="{{ $unit->id_unt }}" @isset($article) @if($unit->id_unt == $article->id_unt) selected @endif @endisset >{{ $unit->desg_unt }} ({{ $unit->abr_unt }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('custom_scripts')
@endsection
