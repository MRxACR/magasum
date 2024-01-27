@extends('layouts.app')

@section('custom_styles')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection

@section('content')
    <div class="container-xl">

        <!-- Page title -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <a href="{{ url('commandes') }}" class="btn btn-outline-primary">
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
                        @isset($sortie)
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
                            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal-large"
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

    <div class="modal modal-blur fade" id="modal-large" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-5">Bon de commande:</dt>
                        <dd class="col-7" id="conf_num"></dd>
                        <dt class="col-5">Fournisseur:</dt>
                        <dd class="col-7" id="conf_fournisseur"></dd>
                        <dt class="col-5">TVA:</dt>
                        <dd class="col-7" id="conf_tva"> %</dd>
                        <dt class="col-5">Montant HT:</dt>
                        <dd class="col-7" id="conf_ht"></dd>
                        <dt class="col-5">Montant TVA:</dt>
                        <dd class="col-7" id="conf_m_tva"></dd>
                        <dt class="col-5">Montant TTC:</dt>
                        <dd class="col-7" id="conf_ttc"></dd>
                    </dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"
                        onclick="$('#articles-form').submit()">Confirmer</button>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body" x-data="{ type: 'bs' }">
        <div class="container-xl">
            <div class="card p-3">
                <form
                    action="@isset($commande) {{ url('commandes/' . $sortie->id) }} @else {{ url('commandes') }} @endisset"
                    method="post" id="articles-form">
                    @isset($commande)
                        @method('PUT')
                    @else
                        @method('POST')
                    @endisset
                    @csrf
                    <div class="row">

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="" class="form-label">Numéro</label>
                                <div class="input-group">

                                    <input type="text" class="form-control @error('num') is-invalid @enderror"
                                        name="num" id="num" placeholder="####/2022" maxlength="15" required
                                        @if (old('num') != null) value="{{ old('num') }}" @else @isset($sortie)  @if ($sortie->type == 'pc') value="{{ str_replace('pc/', '', $sortie->num) }}" @endif
                                        @if ($sortie->type == 'bs') value="{{ str_replace('bs/', '', $sortie->num) }}" @endif
                                        @endisset @endif
                                    >
                                    @error('num')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Date</label>
                                <input type="text" class="form-control @error('date') is-invalid @enderror"
                                    name="date" id="" placeholder="Date"
                                    @if (old('date') != null) value="{{ old('date') }}" @else @isset($sortie) value="{{ date('d/m/Y', strtotime($sortie->date)) }}" @else value="{{ date('d/m/Y') }}" @endisset @endif>
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">denomination</label>
                                <input type="text" class="form-control @error('denomination') is-invalid @enderror"
                                    name="denomination" placeholder="denomination " maxlength="20" required
                                    @if (old('denomination') != null) value="{{ old('denomination') }}"
                                    @else
                                        @isset($sortie)
                                                value="{{ $sortie->denomination }}"
                                        @endisset @endif>
                                @error('denomination')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">code</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    name="code" placeholder="code " maxlength="20" required
                                    @if (old('code') != null) value="{{ old('code') }}"
                                    @else
                                        @isset($sortie)
                                            value="{{ $sortie->code }}"
                                        @endisset @endif>
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">adresse</label>
                                <input type="text" class="form-control @error('adresse') is-invalid @enderror"
                                    name="adresse" placeholder="adresse " maxlength="20" required
                                    @if (old('adresse') != null) value="{{ old('adresse') }}"
                                    @else
                                        @isset($sortie)
                                            value="{{ $sortie->adresse }}"
                                        @endisset @endif>
                                @error('adresse')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">telephone</label>
                                <input type="text" class="form-control @error('telephone') is-invalid @enderror"
                                    name="telephone" placeholder="telephone " maxlength="20" required
                                    @if (old('telephone') != null) value="{{ old('telephone') }}"
                                    @else
                                        @isset($sortie)
                                            value="{{ $sortie->telephone }}"
                                        @endisset @endif>
                                @error('telephone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">fix</label>
                                <input type="text" class="form-control @error('fix') is-invalid @enderror"
                                    name="fix" placeholder="fix " maxlength="20" required
                                    @if (old('fix') != null) value="{{ old('fix') }}"
                                    @else
                                        @isset($sortie)
                                            value="{{ $sortie->fix }}"
                                        @endisset @endif>
                                @error('fix')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Fournisseurs</label>
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

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Type de la commande</label>
                                <select class="form-select" name="type">
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}"
                                            @if (old('type') != null) @if (old('type') == $type->id) selected @endif
                                        @else
                                            @isset($commande) @if ($commande->type_commande_id == $type->id) @endif  @endisset
                                            @endif>{{ $type->desg }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tva %</label>
                                <input type="number" min="0" max="100"
                                    class="form-control @error('tva') is-invalid @enderror" value='0'
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

                        <div class="col-12">
                            <div class="mb-3">
                                <label for="object" class="form-label">Objet de la commande</label>
                                <textarea class="form-control @error('object') is-invalid @enderror" name="object" id="object" rows="3">
                                    @if (old('object') != null){{ old('object') }}
                                    @else
                                    @isset($comande) {{ $comande->object }}@endisset @endif
                                </textarea>
                                @error('object')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <x-forms.articles :categories="$categories" :unites="$unites" :types="$types_articles"/>

                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection


