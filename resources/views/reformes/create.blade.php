@extends('layouts.app')

@section('custom_styles')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <link href="{{ url('assets/css/quill.snow.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-xl">

        <form action="{{ url('reformes/articles_expires') }}" method="post" id="articles_expires">
            @method('POST')
            @csrf
        </form>

        <!-- Page title -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <a href="{{ url('reformes') }}" class="btn btn-outline-primary">
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
                        @isset($reforme)
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

    <div class="page-body" x-data="{ type: 'bs'}">
        <div class="container-xl">
            <div class="card p-3">
                <form
                    action="@isset($reforme) {{ url('reformes/' . $reforme->sortie->id) }} @else {{ url('reformes') }} @endisset"
                    method="post" id="articles-form">
                    @isset($reforme)
                        @method('PUT')
                    @else
                        @method('POST')
                    @endisset
                    @csrf
                    <div class="row">
                        
                        <div class="col-md-12 mb-5 is-invalid">
                            <label class="form-label required">Motif</label>
                            <div id="editor" class="border @error('motif') border border-danger is-invalid @enderror" 
                                style="background-color: var(--tblr-bg-forms);color: inherit;border: 1px solid var(--tblr-border-color);
                            border-radius: var(--tblr-border-radius);">
                                
                                @if (old('motif') != null)
                                    {!! json_decode(old('motif'))!!}
                                @else
                                    @isset($reforme)
                                        {!! $reforme->motif !!}
                                    @endisset
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <div class="my-3">
                                <label class="form-label required">Articles</label>
                                <div class="card">
                                    <div class="card-body rounded @error('articles') border border-danger is-invalid @enderror">
                                        
                                        <div class="d-flex justify-content-end">
                                            <div>
                                                <button type="button" class="btn btn-outline-primary"
                                                    onclick="new_article()">Ajouter un
                                                    article
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row my-3">
                                            <div class="col mb-3">
                                                <label class="form-label required">Designation</label>
                                                <select class="select-beast" placeholder="Selectioner un article..."
                                                    class="form-select" autocomplete="on" id="id_art">
                                                    @foreach ($articles as $article)
                                                        <option value="{{ $article->id_art }}">
                                                            {{ $article->desg_art }} - {{ $article->unite->abr }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="form-label required">Quantité</label>
                                                <input type="number" min="1" max="9999" class="form-control"
                                                    placeholder="Quantité" id="qte_art" value="1">
                                            </div>
                                            <div class="col mb-3">
                                                <label class="form-label required">Observation</label>
                                                <input type="text" class="form-control" placeholder="Observation"
                                                    maxlength="100" id="obs_art">
                                            </div>
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


                                                    @if (old('articles') !== null)
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
                                                        @isset($reforme)
                                                            @foreach ($reforme->sortie->articles as $article)
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

                                                    @isset($articles_exp)
                                                        @foreach ($articles_exp as $article)
                                                            <tr  
                                                                id='art-{{ $article->id_art }}' class="article"
                                                                desg="{{ $article->desg_art }} - {{ $article->unite->abr }}"
                                                                qte="{{ $article->qte_stock }}"
                                                                obs=""
                                                                ref="" 
                                                                >
                                                                <td class="text-center row-no">{{ $counter++ }}</td>
                                                                <td class="w-25 desg">
                                                                    {{ $article->desg_art }}
                                                                </td>
                                                                <td class="w-3 qte text-center" id="qte">
                                                                    {{ $article->qte_stock }}
                                                                </td>
                                                                <td class="w-25 obg">
                                                                </td>

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
                                                </tbody>
                                            </table>
                                        </div>

                                        <textarea class="d-none" name="motif" id="motif" cols="30" rows="10"></textarea>
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
    <script src="{{ url('assets/js/quill.js') }}"></script>

    <script>
        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'], // toggled buttons
            ['blockquote', 'code-block'],
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }],
            [{
                'indent': '-1'
            }, {
                'indent': '+1'
            }], // outdent/indent

            [{
                'header': [1, 2, 3, 4, 5, 6, false]
            }],

            [{
                'color': []
            }, {
                'background': []
            }], // dropdown with defaults from theme
            [{
                'font': []
            }],
            [{
                'align': []
            }],

            ['clean'] // remove formatting button
        ];
        var quill = new Quill('#editor', {
            placeholder: 'motif pour la réforme',
            modules: {
                toolbar: toolbarOptions
            },
            name: 'motif',
            theme: 'snow'
        });
    </script>

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
            for (let i = 0; i < rows.length; i++) {
                rows[i].innerHTML = i+1;
            }
        };

        function articles_teplate(id = "", desgnation = "", quantity = 0, observation = "", referance = "", no = 1,prix ="") {
            return `
                         <tr id='art-` + id + `' class="article" desg="` + desgnation + `" qte="` + quantity +
                            `" obs="` + observation + `" ref="` + referance + `" prx="`+prix+`">
                            <td class="text-center counter row-no" >` + no + `</td>
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
                '#qte_art').val(), $('#obs_art').val(), $('#ref_art').val(), 1));
            countRows();
        }

        function presubmit() {
            let articles = $('.article');
            let article_list = [];

            for (let i = 0; i < articles.length; i++) {
                let article = {};
                article.article_id = articles[i].id.replace('art-', '');
                article.quantity = articles[i].getAttribute('qte');
                article.prix = articles[i].getAttribute('prx');
                article.designation = articles[i].getAttribute('desg');
                article.referance = articles[i].getAttribute('ref');
                article.observation = articles[i].getAttribute('obs');
                article_list.push(article);
            }

            console.log(article_list);
            $('#articles_list').val(JSON.stringify(article_list));
            $('#motif').val(JSON.stringify($('.ql-editor')[0].innerHTML));

            $('#articles-form').submit();

        }
    </script>
@endsection
