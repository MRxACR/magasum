@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <a href="{{ url('fournisseurs') }}" class="btn btn-outline-primary">
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
                        @isset($fournisseur)
                            <button class="btn btn-outline-warning" onclick="$('#fournisseur-form').submit()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check"
                                    width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M5 12l5 5l10 -10"></path>
                                </svg>
                                Mettre a jour
                            </button>
                        @else
                            <button class="btn btn-outline-success" onclick="$('#fournisseur-form').submit()">
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
                <form
                    action="@isset($fournisseur) {{ url('fournisseurs/' . $fournisseur->id) }} @else {{ url('fournisseurs') }} @endisset"
                    method="post" id="fournisseur-form">
                    @isset($fournisseur)
                        @method('PUT')
                    @else
                        @method('POST')
                    @endisset
                    @csrf
                    <div class="row">


                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Raison Sociale</label>
                                <input type="text" class="form-control @error('rs') is-invalid @enderror" name="rs"
                                placeholder="Reson sociale fournisseur"
                                @if (old('rs') != null) 
                                value="{{ old('rs') }}"
                                @else
                                    @isset($fournisseur)
                                        value="{{ $fournisseur->rs }}"
                                    @endisset @endif>
                                @error('rs')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Nom</label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom"
                                    placeholder="Nom fournisseur"
                                    @if (old('nom') != null) value="{{ old('nom') }}"
                                    @else
                                        @isset($fournisseur)
                                            value="{{ $fournisseur->nom }}"
                                        @endisset @endif>
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Prénom</label>
                                <input type="text" class="form-control @error('prenom') is-invalid @enderror"
                                    name="prenom" placeholder="Prenom fournisseur"
                                    @if (old('prenom') != null) value="{{ old('prenom') }}"
                                    @else
                                        @isset($fournisseur)
                                            value="{{ $fournisseur->prenom }}"
                                        @endisset @endif>
                                @error('prenom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Adresse</label>
                                <input type="text" class="form-control @error('adr') is-invalid @enderror" name="adr"
                                placeholder="Adresse"
                                @if (old('adr') != null) 
                                value="{{ old('adr') }}"
                                @else
                                    @isset($fournisseur)
                                        value="{{ $fournisseur->adr }}"
                                    @endisset @endif>
                                @error('adr')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Numéro de Téléphone</label>
                                <input type="text" class="form-control @error('tel') is-invalid @enderror" name="tel"
                                    placeholder="Numéro de Téléphone"
                                    @if (old('tel') != null) value="{{ old('tel') }}"
                                    @else
                                        @isset($fournisseur)
                                            value="{{ $fournisseur->tel }}"
                                        @endisset @endif>
                                @error('tel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Numéro Fax</label>
                                <input type="text" class="form-control @error('fax') is-invalid @enderror"
                                    name="fax" placeholder="Numéro Fax"
                                    @if (old('fax') != null) value="{{ old('fax') }}"
                                    @else
                                        @isset($fournisseur)
                                            value="{{ $fournisseur->fax }}"
                                        @endisset @endif>
                                @error('fax')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Willaya</label>
                                <input type="text" class="form-control @error('willaya') is-invalid @enderror" name="willaya"
                                placeholder="Willaya"
                                @if (old('willaya') != null) 
                                value="{{ old('willaya') }}"
                                @else
                                    @isset($fournisseur)
                                        value="{{ $fournisseur->willaya }}"
                                    @endisset @endif>
                                @error('willaya')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Registre de Commerce</label>
                                <input type="text" class="form-control @error('rc') is-invalid @enderror" name="rc"
                                    placeholder="Numéro Eegistre de Commerce"
                                    @if (old('rc') != null) value="{{ old('rc') }}"
                                    @else
                                        @isset($fournisseur)
                                            value="{{ $fournisseur->rc }}"
                                        @endisset @endif>
                                @error('rc')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Numéro Ai</label>
                                <input type="text" class="form-control @error('ai') is-invalid @enderror"
                                    name="ai" placeholder="Numéro Ai"
                                    @if (old('ai') != null) value="{{ old('ai') }}"
                                    @else
                                        @isset($fournisseur)
                                            value="{{ $fournisseur->ai }}"
                                        @endisset @endif>
                                @error('ai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Matricule Fiscale</label>
                                <input type="text" class="form-control @error('mf') is-invalid @enderror"
                                    name="mf" placeholder="Numéro Matricule Fiscale"
                                    @if (old('mf') != null) value="{{ old('mf') }}"
                                    @else
                                        @isset($fournisseur)
                                            value="{{ $fournisseur->mf }}"
                                        @endisset @endif>
                                @error('mf')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    
                                @enderror
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
