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

                        <div class="col-12">
                            <div class="card @error('articles') border-danger @enderror">
                                <div class="card-body">
                                    <h4 class="card-title">Articles</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="" class="form-label check-field">Designation</label>
                                                <input type="text" class="form-control" id="desg_art"
                                                    onkeyup="search_artciels(this.value)" placeholder=""
                                                    onchange="set_default_attribute(this.value)">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="" class="form-label check-field">Quantité</label>
                                                <input type="text" class="form-control" id="quantity" onkeyup="num_validation(this)" onchange="num_validation(this)"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="" class="form-label check-field">prix</label>
                                                <input type="text" class="form-control" id="prix" onkeyup="num_validation(this)" onchange="num_validation(this)"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Categorie</label>
                                                <select class="form-select" id="categorie_id">
                                                    @isset($categories)
                                                        @foreach ($categories as $categorie)
                                                            <option value="{{ $categorie->id }}">{{ $categorie->desg }}
                                                            </option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Unité</label>
                                                <select class="form-select" id="unite_id">
                                                    @isset($unites)
                                                        @foreach ($unites as $unite)
                                                            <option value="{{ $unite->id }}">{{ $unite->desg }}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Type d'article</label>
                                                <select class="form-select" id="type_id">
                                                    @isset($types_articles)
                                                        @foreach ($types_articles as $types_article)
                                                            <option value="{{ $types_article->id }}">
                                                                {{ $types_article->desg }}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label">Ajouter à la liste</label>
                                                <button type="button" onclick="new_field()"
                                                    class="btn btn-outline-primary w-100">Ajouter</button>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Liste</label>
                                            <div class="table-responsive">
                                                <table
                                                    class="table 
                                                table-hover	
                                                table-bordered
                                                
                                                align-middle">
                                                    <thead class="">
                                                        <tr class="text-uppercase">
                                                            <th style="width: 1%">No</th>
                                                            <th>Designation</th>
                                                            <th class="w-1">Quantité</th>
                                                            <th class="w-1">prix</th>
                                                            <th class="w-1">categorie</th>
                                                            <th class="w-1">Unité</th>
                                                            <th class="w-1">Type</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-group-divider" id="articles_table">

                                                        @if (old('articles') != null)
                                                            @foreach (old('articles') as $key => $value)
                                                                <tr class="articles[{{ $key }}] article"
                                                                    name="articles[{{ $key }}]">
                                                                    <td style="width: 1%" class="order">
                                                                        {{ $key }}
                                                                    </td>
                                                                    <td class="w-25"><input
                                                                            name="articles[{{ $key }}][desg_art]"
                                                                            class="form-control" readonly
                                                                            value="{{ $value['desg_art'] }}">
                                                                    </td>
                                                                    <td class="w-1">
                                                                        <input
                                                                            name="articles[{{ $key }}][quantity]"
                                                                            type="number" class="form-control qte"
                                                                            value="{{ $value['quantity'] }}">
                                                                    </td>
                                                                    <td class="w-1"><input
                                                                            name="articles[{{ $key }}][prix]"
                                                                            type="number" class="form-control prx"
                                                                            value="{{ $value['prix'] }}">
                                                                    </td>
                                                                    <td class="w-1"><input
                                                                            name="articles[{{ $key }}][categorie]"
                                                                            class="form-control" readonly
                                                                            value="{{ $value['categorie'] }}">
                                                                    </td>
                                                                    <td class="w-1"><input
                                                                            name="articles[{{ $key }}][unite]"
                                                                            class="form-control" readonly
                                                                            value="{{ $value['unite'] }}">
                                                                    </td>
                                                                    <td class="w-1"><input
                                                                            name="articles[{{ $key }}][type]"
                                                                            class="form-control" readonly
                                                                            value="{{ $value['type'] }}">
                                                                    </td>

                                                                    <td style="width: 1%">
                                                                        <button
                                                                            class="btn btn-outline-danger btn-icon rounded-circle"
                                                                            onclick="this.parentElement.parentElement.remove();">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="icon icon-tabler icon-tabler-minus"
                                                                                width="40" height="40"
                                                                                viewBox="0 0 24 24" stroke-width="2"
                                                                                stroke="currentColor" fill="none"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none"></path>
                                                                                <line x1="5" y1="12"
                                                                                    x2="19" y2="12"></line>
                                                                            </svg>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            @isset($commande)
                                                                @php 
                                                                    $counter = 0;
                                                                @endphp
                                                                @foreach ($commande->catalogue->articles() as $article)
                                                                    <tr class="articles[{{ $counter }}] article"
                                                                        name="articles[{{ $counter }}]">
                                                                        <td style="width: 1%" class="order">
                                                                            {{ $counter }}
                                                                        </td>
                                                                        <td class="w-25"><input
                                                                                name="articles[{{ $counter }}][desg_art]"
                                                                                class="form-control" readonly
                                                                                value="{{ $article->desg_art }}">
                                                                        </td>
                                                                        <td class="w-1">
                                                                            <input
                                                                                name="articles[{{ $counter }}][quantity]"
                                                                                type="number" class="form-control qte"
                                                                                value="{{ $article->pivot->quantity }}" onchange="num_validation(this)">
                                                                        </td>
                                                                        <td class="w-1"><input
                                                                                name="articles[{{ $counter }}][prix]"
                                                                                type="number" class="form-control prx"
                                                                                value="{{ $article->pivot->prix }}" onchange="num_validation(this)">
                                                                        </td>
                                                                        <td class="w-1"><input
                                                                                name="articles[{{ $counter }}][categorie]"
                                                                                class="form-control" readonly
                                                                                value="{{ $article->categorie->desg }}">
                                                                        </td>
                                                                        <td class="w-1"><input
                                                                                name="articles[{{ $counter }}][unite]"
                                                                                class="form-control" readonly
                                                                                value="{{ $article->unite->desg }}">
                                                                        </td>
                                                                        <td class="w-1"><input
                                                                                name="articles[{{ $counter }}][type]"
                                                                                class="form-control" readonly
                                                                                value="{{ $article->type->desg }}">
                                                                        </td>

                                                                        <td style="width: 1%">
                                                                            <button
                                                                                class="btn btn-outline-danger btn-icon rounded-circle"
                                                                                onclick="this.parentElement.parentElement.remove();">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    class="icon icon-tabler icon-tabler-minus"
                                                                                    width="40" height="40"
                                                                                    viewBox="0 0 24 24" stroke-width="2"
                                                                                    stroke="currentColor" fill="none"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round">
                                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                                        fill="none"></path>
                                                                                    <line x1="5" y1="12"
                                                                                        x2="19" y2="12"></line>
                                                                                </svg>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endisset
                                                        @endif

                                                    </tbody>
                                                    <tfoot>

                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection

@section('custom_scripts')

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
        // Search articles  
        async function search_artciels(value) {

            // to check if the input is not null 
            if (value == '') return [];

            // send request to the server
            this.articles = await $.ajax({
                type: "POST",
                url: "{{ url('api/articles/search') }}",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify({
                    "data": value,
                    "_token": "{!! csrf_token() !!}"
                }),

                // if the request is success
                success: function(data) {

                    // to handle all designation
                    let desg_articles = [];

                    // get all designation
                    for (let i = 0; i < data.articles.data.length; i++) {
                        const element = data.articles.data[i];
                        desg_articles.push(element.desg_art)
                    }

                    // autocomplite the input
                    $("#desg_art").autocomplete({
                        source: desg_articles
                    });
                }
            });

        }

        // Set the default values to the selected item 
        async function set_default_attribute(value) {

            // send request to the server
            this.articles = await $.ajax({
                type: "POST",
                url: "{{ url('api/articles/search') }}",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify({
                    "data": value,
                    "_token": "{!! csrf_token() !!}"
                }),

                // if the request is success
                success: function(data) {
                    if (data.articles.length == 0) return 0;
                    article = data.articles[0];


                    try {
                        $("#prix").val(article.prix);
                        $("#quantity").val(article.qte_stock);
                        $("#categorie_id").val(article.categorie_id);
                        $("#unite_id").val(article.unite_id);
                        $("#type_id").val(article.type_id);
                    } catch (error) {
                        console.log(error);
                    }

                }
            });
        }

        // return the template of the field 
        function template_field(order = 1, desg_art = "", quantity = "", prix = "", categorie = "", unite = "", type = "") {

            return `<tr class="articles[` + order + `] article" name="articles[` + order + `]">
                    <td style="width: 1%" class="order">` + order + `</td>
                    <td class="w-25"><input name="articles[` + order +
                `][desg_art]" class="form-control" readonly  value="` + desg_art + `"></td>
                    <td class="w-1">
                        <input name="articles[` + order +
                `][quantity]" type="number" class="form-control qte" value="` +
                quantity + `" onchange="num_validation(this)">
                </td>
                    <td class="w-1"><input name="articles[` + order +
                `][prix]" type="number" class="form-control prx" value="` + prix + `" onchange="num_validation(this)"></td>
                    <td class="w-1"><input name="articles[` + order +
                `][categorie]" class="form-control"  readonly  value="` + categorie + `"></td>
                    <td class="w-1"><input name="articles[` + order +
                `][unite]" class="form-control"  readonly  value="` + unite + `"></td>
                    <td class="w-1"><input name="articles[` + order +
                `][type]" class="form-control"  readonly  value="` + type + `"></td>
                    <td style="width: 1%">
                        <button class="btn btn-outline-danger btn-icon rounded-circle"
                                    onclick="this.parentElement.parentElement.remove();">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-minus"
                                width="40" height="40" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"
                                    fill="none"></path>
                                <line x1="5" y1="12" x2="19"
                                    y2="12"></line>
                            </svg>
                        </button></td>
                    </tr>
            `;
        }

        // clear all alerts
        function clear_alerts() {
            let alerts = $('.is-invalid');
            for (let i = 0; i < alerts.length; i++) {
                const element = alerts[i];
                element.classList.remove('is-invalid')

            }
        }

        // clear fields
        function clear_fields() {
            let fields = $('.check-field');
            for (let i = 0; i < fields.length; i++) {
                const element = fields[i];
                element.value = "";

            }
        }

        // add new field
        function new_field() {

            clear_alerts();

            let old_fields = $(".article");
            let order = old_fields.length + 1;
            let errors = 0;

            let desg_art = $('#desg_art').val();
            let quantity = $('#quantity').val();
            let prix = $('#prix').val();

            let categorie = $('#categorie_id').find(":selected").text().replace(
                '\n                                                                ', '');
            let unite = $('#unite_id').find(":selected").text().replace(
                '\n                                                                ', '');
            let type = $('#type_id').find(":selected").text().replace(
                '\n                                                                ', '');

            if (desg_art == '') {
                $('#desg_art')[0].classList.add('is-invalid');
                errors++
            }
            if (quantity == '' || isNaN(quantity) || quantity < 0 || quantity == 0 ) {
                $('#quantity')[0].classList.add('is-invalid');
                errors++
            }
            if (prix == '' || isNaN(prix) || prix < 0 || prix == 0 ) {
                $('#prix')[0].classList.add('is-invalid');
                errors++
            }
            if (categorie == '') {
                $('#categorie_id')[0].classList.add('is-invalid');
                errors++
            }
            if (unite == '') {
                $('#unite_id')[0].classList.add('is-invalid');
                errors++
            }
            if (type == '') {
                $('#type_id')[0].classList.add('is-invalid');
                errors++
            }

            if (errors === 0) {
                // remove old field if exist
                let el = old_fields.find('[value="'+desg_art+'"]')
                if (el[0]) {
                    el[0].parentElement.parentElement.remove();
                }
                // apend row to the table 
                $('#articles_table').append(template_field(order, desg_art, quantity, prix, categorie, unite, type))
                // clear check fields fields
                clear_fields()
            }

        }

        // to confirme the submit
        function confrmation() {
            // Get values
            let num = $('#num').val();
            let fournisseur = $('#fournisseur').find(":selected").text();
            let tva = Number($('#tva').val());
            let m_ht = 0;
            let m_tva = 0;
            let m_ttc = 0;

            let articles = $('.article');

            for (let i = 0; i < articles.length; i++) {
                const element = articles[i];
                m_ht += element.getElementsByClassName('qte')[0].value * element.getElementsByClassName('prx')[0].value;

            }

            m_tva = tva * m_ht / 100;
            m_ttc = m_tva + m_ht;


            $("#conf_num").text(num);
            $("#conf_fournisseur").text(fournisseur);
            $("#conf_tva").text(tva + ' %');
            $("#conf_ht").text(m_ht + ' DA');
            $("#conf_m_tva").text(m_tva + ' DA');
            $("#conf_ttc").text(m_ttc + ' DA');

        }

        // numerique validation
        function num_validation(Element){
            let value = Element.value;
            if (value == '' || isNaN(value) || value < 0 || value == 0) Element.classList.add('is-invalid');
            else Element.classList.remove('is-invalid');
        }

        // String validation if it not null
        function string_validation(Element){
            let value = Element.value;
            if (value == '') Element.classList.add('is-invalid');
            else Element.classList.remove('is-invalid');
        }
    </script>
@endsection
