@extends('layouts.app')

@section('custom_styles')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container-xl">

        <!-- Page title -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <a href="{{ url('sorties') }}" class="btn btn-outline-primary">
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
                            <button class="btn btn-outline-success" onclick="presubmit()">
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



    <div class="page-body" x-data="{ type: @if (old('type') != null) '{{ old('type') }}' @else @isset($sortie->type) '{{ $sortie->type }}' @else 'bs' @endisset @endif }">
        <div class="container-xl">
            <div class="card p-3">
                <form
                    action="@isset($sortie) {{ url('sorties/' . $sortie->id) }} @else {{ url('sorties') }} @endisset"
                    method="post" id="articles-form">
                    @isset($sortie)
                        @method('PUT')
                    @else
                        @method('POST')
                    @endisset
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required">Type de sortie</label>
                                <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="form-selectgroup-item flex-fill required">
                                                <input type="radio" name="type" value="bs"
                                                    class="form-selectgroup-input"
                                                    @if (old('type') == 'bs') checked="true" @else @isset($sortie) @if ($sortie->type == 'bs') checked @endif
                                                    @else checked @endisset @endif

                                                x-on:click="type = 'bs'">
                                                <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                    <div class="me-3">
                                                        <span class="form-selectgroup-check"></span>
                                                    </div>
                                                    <div>
                                                        Bon de sortie
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-selectgroup-item flex-fill">
                                                <input type="radio" name="type" value="pc"
                                                    @if (old('type') == 'pc') checked="true" @else  @isset($sortie) @if ($sortie->type == 'pc') checked @endif
                                                    @endisset @endif

                                                class="form-selectgroup-input" x-on:click="type = 'pc'">
                                                <div class="form-selectgroup-label d-flex align-items-center p-3">
                                                    <div class="me-3">
                                                        <span class="form-selectgroup-check"></span>
                                                    </div>
                                                    <div>
                                                        Prise en charge
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="" class="form-label required">Numéro</label>
                                <div class="input-group">

                                    <template x-if="type=='bs'">
                                        <span class="input-group-text">
                                            BS/
                                        </span>
                                    </template>

                                    <template x-if="type=='pc'">
                                        <span class="input-group-text ">
                                            PC/
                                        </span>
                                    </template>
                                    <input type="text" class="form-control @error('num') is-invalid @enderror"
                                        name="num" placeholder="####/2022" maxlength="15" required
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
                                <label class="form-label required">Date</label>
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
                                <label class="form-label required">Nom</label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                    name="nom" placeholder="Nom du bénéficiaire" maxlength="20" required
                                    @if (old('nom') != null) value="{{ old('nom') }}"
                                    @else
                                        @isset($sortie)
                                                value="{{ $sortie->nom }}"
                                        @endisset @endif>
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label required">Prénom</label>
                                <input type="text" class="form-control @error('prenom') is-invalid @enderror"
                                    name="prenom" placeholder="Prénom du bénéficiaire" maxlength="20" required
                                    @if (old('prenom') != null) value="{{ old('prenom') }}"
                                    @else
                                        @isset($sortie)
                                            value="{{ $sortie->prenom }}"
                                        @endisset @endif>
                                @error('prenom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <template x-if="type=='bs'">
                                <div class="mb-3">
                                    <label for="service" class="form-label required">Service</label>
                                    <input type="text" class="form-control @error('service') is-invalid @enderror"
                                        name="service" id="service"
                                        @if (old('service') !== null) value="{{ old('service') }}" @else @isset($sortie->bon_de_sortie) value="{{ $sortie->bon_de_sortie->service }}" @endisset @endif
                                        maxlength="50" required aria-describedby="infoService"
                                        placeholder="service bénificiaire">
                                    @error('service')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </template>

                            <template x-if="type=='pc'">
                                <div class="mb-3">
                                    <label for="fonction" class="form-label required">Fonction</label>
                                    <input type="text" class="form-control @error('fonction') is-invalid @enderror"
                                        name="fonction" maxlength="50" required id="fonction"
                                        @if (old('fonction') !== null) value="{{ old('fonction') }}" @else @isset($sortie->prise_en_charge) value="{{ $sortie->prise_en_charge->fonction }}" @endisset @endif
                                        placeholder="Fonction du bénificiaire">
                                    @error('fonction')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </template>

                        </div>

                        <div class="col-md-12">
                            <div class="my-3">
                                <div class="card">

                                    <div class="card-body rounded @error('articles') border border-danger @enderror ">
                                        <div class="d-flex justify-content-between">
                                            <div class="form-label required">Articles</div>
                                            <div>
                                                <button type="button" class="btn btn-outline-primary"
                                                    onclick="new_article()">Ajouter un
                                                    champ</button>

                                            </div>
                                        </div>

                                        <div class="row my-3">
                                            <div class="col mb-3">
                                                <label class="form-label required">Designation</label>
                                                <select class="select-beast" placeholder="Selectioner un article..."
                                                    class="form-select" autocomplete="on" id="id_art">
                                                    @foreach ($articles as $article)
                                                        <option value="{{ $article->id_art }}">
                                                            {{ $article->desg_art }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="form-label required">Quantité</label>
                                                <input type="number" min="1" max="9999" class="form-control"
                                                    placeholder="Quantité" id="qte_art" value="1">
                                            </div>
                                            <div class="col mb-3">
                                                <label class="form-label">Observation</label>
                                                <input type="text" class="form-control" placeholder="Observation"
                                                    maxlength="100" id="obs_art">
                                            </div>

                                            <template x-if="type=='pc'">
                                                <div class="col-md-4 col-md-2  mb-3">
                                                    <label class="form-label">Reférance</label>
                                                    <input type="text" class="form-control" placeholder="Referance"
                                                        maxlength="20" id="ref_art">
                                                </div>
                                            </template>
                                        </div>
                                        <div class="table-responsive" style="min-height: 300px;">
                                            <table class="table mb-0 table-transparent table-bordered"
                                                id="articles-table">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 1%">NO°</th>
                                                        <th>Article</th>
                                                        <th style="width: 1%">Quantité</th>
                                                        <th>Observation</th>
                                                        <template x-if="type=='pc'">
                                                            <th>Referance</th>
                                                        </template>
                                                        <th style="width: 1%" class="w-1 text-end">Retirer</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="articles">
                                                    @php
                                                        $counter = 1;
                                                    @endphp


                                                    @if(old('articles') !== null)
                                                        @php
                                                            $articlesList = json_decode(old('articles'));
                                                            $articlesIDS = [];
                                                            foreach ($articlesList as $article) {
                                                                $articlesIDS[] .= $article->article_id;
                                                            }
                                                        @endphp
                                                        

                                                        @foreach (json_decode(old('articles')) as $article)
                                                            
                                                            <tr id='art-{{ $article->article_id }}' class="article"
                                                                    desg="{{ $article->designation }}"
                                                                    qte="{{ $article->quantity }}"
                                                                    obs="{{ $article->observation }}"
                                                                    ref="{{ $article->referance }}">
                                                                    <td class="text-center row-no">{{ $counter++ }}</td>
                                                                    <td class="w-25 desg">
                                                                        {{ $article->designation }}
                                                                    </td>
                                                                    <td class="w-3 qte text-center" id="qte">
                                                                        {{ $article->quantity }}
                                                                    </td>
                                                                    <td class="w-25  obg">
                                                                        {{ $article->observation }}
                                                                    </td>
                                                                    <template x-if="type=='pc'">
                                                                        <td class='ref'>
                                                                            {{ $article->referance }}
                                                                        </td>
                                                                    </template>

                                                                    <td class="text-end" style="width: 1%">
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
                                                        @isset($sortie)
                                                            @foreach ($sortie->articles as $article)
                                                                <tr id='art-{{ $article->id_art }}' class="article"
                                                                    desg="{{ $article->desg_art }} - {{ $article->unite->abr }}"
                                                                    qte="{{ $article->pivot->quantity }}"
                                                                    obs="{{ $article->pivot->observation }}"
                                                                    ref="{{ $article->pivot->referance }}">
                                                                    <td class="text-center row-no">{{ $counter++ }}</td>
                                                                    <td class="w-25 desg">
                                                                        {{ $article->desg_art }}
                                                                    </td>
                                                                    <td class="w-3 qte text-center" id="qte">
                                                                        {{ $article->pivot->quantity }}
                                                                    </td>
                                                                    <td class="w-25  obg">
                                                                        {{ $article->pivot->observation }}
                                                                    </td>
                                                                    <template x-if="type=='pc'">
                                                                        <td class='ref'>
                                                                            {{ $article->pivot->referance }}
                                                                        </td>
                                                                    </template>

                                                                    <td class="text-end" style="width: 1%">
                                                                        <button
                                                                            class="btn btn-outline-danger btn-icon rounded-circle"
                                                                            onclick="this.parentElement.parentElement.remove();">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="icon icon-tabler icon-tabler-minus"
                                                                                width="40" height="40" viewBox="0 0 24 24"
                                                                                stroke-width="2" stroke="currentColor"
                                                                                fill="none" stroke-linecap="round"
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
                                            </table>
                                        </div>

                                        <textarea class="d-none" name="articles" id="articles_list" cols="30" rows="10"></textarea>
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
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

    <script>
        new TomSelect(".select-beast", {
            sortField: {
                field: "text",
                class: 'form-control'
            }
        });

        if (true) {
            document.getElementsByClassName('ts-control')[0].style = `
                background-color: var(--tblr-bg-forms);
                color: inherit;
                border: 1px solid var(--tblr-border-color);
                border-radius: var(--tblr-border-radius);
                transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
                `;
        }

        function countRows(){
            rows = $('.row-no');
            if(rows.length < 1) rows[0].innerHTML = 1;
            else
            for (let i = 0; i < rows.length; i++) {
                rows[i].innerHTML = i+1;
            }
        };



        function articles_teplate(id = "", desgnation = "", quantity = 0, observation = "", referance = "", no = 1) {
            return `
                         <tr id='art-` + id + `' class="article" desg="` + desgnation + `" qte="` + quantity +
                            `" obs="` + observation + `" ref="` + referance + `">
                            <td class="text-center counter row-no" >0</td>
                            <td class="w-25 desg">
                                ` + desgnation + `
                            </td>
                            <td class="w-3 qte text-center" id="qte">
                                ` + quantity + `
                            </td>
                            <td class="w-25 obg">
                                ` + observation + `
                            </td>
                            <template x-if="type=='pc'">
                                <td class='ref'>
                                ` + referance + `
                            </td>
                            </template>
                            
                            <td class="text-end" style="width: 1%">
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
                                </button>
                            </td>
                        </tr>
                    `;
        }

        function new_article() {
            let art_id = $('#id_art').find(":selected").val();
            $('#art-' + art_id).remove();
            $('#articles').append(articles_teplate(art_id, $('#id_art').find(":selected").text().replace('\n', ''), $(
                '#qte_art').val(), $('#obs_art').val(), $('#ref_art').val(), $('.article').length + 1));
            countRows();
        }

        function presubmit() {
            let articles = $('.article');
            let article_list = [];

            for (let i = 0; i < articles.length; i++) {
                let article = {};
                article.article_id = articles[i].id.replace('art-', '');
                article.quantity = articles[i].getAttribute('qte');
                article.designation = articles[i].getAttribute('desg');
                article.referance = articles[i].getAttribute('ref');
                article.observation = articles[i].getAttribute('obs');
                article_list.push(article);
            }

            console.log(article_list);
            $('#articles_list').val(JSON.stringify(article_list));

            $('#articles-form').submit();

        }
    </script>
@endsection
