@extends('layouts.app')

@section('custom_styles')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection

@section('content')
    <div class="container-xxl">

        <!-- Page title -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <a href="{{ url('receptions') }}" class="btn btn-outline-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back"
                            width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"></path>
                        </svg>
                        Page précedente
                    </a>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        @isset($reception)
                            <button class="btn btn-outline-warning" onclick="presubmit()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check"
                                    width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M5 12l5 5l10 -10"></path>
                                </svg>
                                Mettre à jour
                            </button>
                        @else
                            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#confirmation"
                                onclick="confrmation()">
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

    <div class="page-body" x-data="{ type: @if (old('type') != null) '{{ old('type') }}' @else 'bl' @endif }">
        <div class="container-xxl">
            <div class="card p-3">
                <form
                    action="@isset($reception) {{ url('receptions/' . $reception->id) }} @else {{ url('receptions') }} @endisset"
                    method="post" id="articles-form">
                    @isset($reception)
                        @method('PUT')
                    @else
                        @method('POST')
                    @endisset
                    @csrf
                    <div class="row">
                        
                        <div class="hr-text">Bon de Livraison</div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Fournisseur</label>
                                <select class="form-select" name="fournisseur" id="fournisseur">
                                    @foreach ($fournisseurs as $fournisseur)
                                        <option value="{{ $fournisseur->id }}"
                                            @if (old('fournisseur') != null) @if (old('fournisseur') == $fournisseur->id) selected @endif
                                        @else
                                            @isset($commande) @if ($commande->fournisseur_id == $fournisseur->id) @endif  @endisset
                                            @endif >{{ $fournisseur->nom }}
                                            {{ $fournisseur->prenom }} ({{ $fournisseur->rs }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Tva %</label>
                                <input type="number" min="0" max="100"
                                    class="form-control @error('tva') is-invalid @enderror" value='19'
                                    name="tva" id="tva" placeholder="tva " maxlength="20" required
                                    @if (old('tva') != null) value="{{ old('tva') }}"
                                    @else
                                        @isset($commande)
                                            value="{{ $commande->catalogue->tva }}"
                                        @endisset @endif>
                                @error('tva')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="" class="form-label">N° Bon de livraison</label>
                                <div class="input-group">

                                    <input type="text" class="form-control @error('livraison') is-invalid @enderror"
                                        name="livraison" id="livraison" placeholder="####/SDMM/23" maxlength="15"
                                        required
                                        @if (old('livraison') != null) value="{{ old('livraison') }}" @else @isset($reception)
                                            value="{{ $reception->livraison->num }}"
                                        @endisset @endif>
                                    @error('livraison')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Date Bon de livraison</label>
                                <input type="text" class="form-control @error('date_livraison') is-invalid @enderror"
                                    name="date_livraison" id="" placeholder="date_livraison"
                                    @if (old('date_livraison') != null) value="{{ old('date_livraison') }}" @else @isset($reception) value="{{ date('d/m/Y', strtotime($reception->livraison->date)) }}" @else value="{{ date('d/m/Y') }}" @endisset @endif>
                                @error('date_livraison')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="hr-text">Bon de commande</div>
                        </div>

                        <div class="col-md-6 d-none d-md-block">
                            <div class="hr-text">Facture</div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="" class="form-label">N° bon de commande</label>
                                <div class="input-group">

                                    <input type="text" class="form-control @error('num_bc') is-invalid @enderror"
                                        name="num_bc" id="facture" placeholder="####/SDMM/23" maxlength="15"
                                        required
                                        @if (old('num_bc') != null) value="{{ old('num_bc') }}"@endif>
                                    @error('num_bc')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Date bon de commande</label>
                                <input type="text" class="form-control @error('date_bc') is-invalid @enderror"
                                    name="date_bc" id="" placeholder="##/##/####"
                                    @if (old('date_bc') != null) value="{{ old('date_bc') }}" @else value="{{ date('d/m/Y') }}" @endif>
                                @error('date_bc')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 d-block d-md-none">
                            <div class="hr-text">Facture</div>
                        </div>


                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="" class="form-label">N° de facture</label>
                                <div class="input-group">

                                    <input type="text" class="form-control @error('facture') is-invalid @enderror"
                                        name="facture" id="facture" placeholder="####/SDMM/23" maxlength="15"
                                        required
                                        @if (old('facture') != null) value="{{ old('facture') }}" @else @isset($reception)
                                            value="{{ $reception->facture->num }}"
                                        @endisset @endif>
                                    @error('facture')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Date la facture</label>
                                <input type="text" class="form-control @error('date_facture') is-invalid @enderror"
                                    name="date_facture" id="" placeholder="##/##/####"
                                    @if (old('date_facture') != null) value="{{ old('date_facture') }}" @else @isset($reception) value="{{ date('d/m/Y', strtotime($reception->livraison->date)) }}" @else value="{{ date('d/m/Y') }}" @endisset @endif>
                                @error('date_facture')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="hr-text">Bon de réception</div>


                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="" class="form-label">N° Bon de réception</label>
                                <div class="input-group">

                                    <input type="text" class="form-control @error('num') is-invalid @enderror"
                                        name="num" id="num" placeholder="####/SDMM/23" maxlength="15" required
                                        @if (old('num') != null) value="{{ old('num') }}" @else @isset($reception)
                                            value="{{ $reception->num }}"
                                        @endisset @endif>
                                    @error('num')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="" class="form-label">N° de marche</label>
                                <div class="input-group">

                                    <input type="text" class="form-control @error('num_marche') is-invalid @enderror"
                                        name="num_marche" id="num_marche" placeholder="####/SDMM/23" maxlength="15"
                                        required
                                        @if (old('num_marche') != null) value="{{ old('num_marche') }}" @else @isset($reception)
                                            value="{{ $reception->num_marche }}"
                                        @endisset @endif>
                                    @error('num_marche')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="" class="form-label">N° de consultation</label>
                                <div class="input-group">

                                    <input type="text"
                                        class="form-control @error('num_consultation') is-invalid @enderror"
                                        name="num_consultation" id="num_consultation" placeholder="####/SDMM/23"
                                        maxlength="15" required
                                        @if (old('num_consultation') != null) value="{{ old('num_consultation') }}" @else @isset($reception)
                                            value="{{ $reception->num_consultation }}"
                                        @endisset @endif>
                                    @error('num_consultation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="" class="form-label">N° ODS</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('num_ods') is-invalid @enderror"
                                        name="num_ods" id="num_ods" placeholder="####/SDMM/23" maxlength="15" required
                                        @if (old('num_ods') != null) value="{{ old('num_ods') }}" @else @isset($reception)
                                            value="{{ $reception->num_ods }}"
                                        @endisset @endif>
                                    @error('num_ods')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="hr-text">Articles</div>       

                        <x-forms.articles :categories="$categories" :unites="$unites" :types="$types_articles"/>

                    </div>
                </form>


            </div>
        </div>
    </div>
    
    
    
@endsection
