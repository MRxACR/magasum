@extends('layouts.app')

@section('custom_styles')
    <style>
        .pagination {
            display: flex;
            justify-content: center;
            text-align: center;
        }

        .pagination li {
            display: inline-block;
            padding: 8px;
        }
    </style>
@endsection

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Fournisseurs</h2>
                    <div class="text-muted mt-1">{{ $fournisseurs->count() }} Elément(s)</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <div class="me-3 d-none d-sm-block">
                            <div class="input-icon">
                                <input type="text" class="form-control" placeholder="Search…"
                                    onkeyup="filterSearching(this.value)">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search"
                                        width="40" height="40" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="10" cy="10" r="7"></circle>
                                        <line x1="21" y1="21" x2="15" y2="15"></line>
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <a href="{{ url('fournisseurs/create') }}" class="btn btn-outline-primary ms-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="40"
                                height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Nouveau
                        </a>
                    </div>
                </div>
            </div>
            <div class="d-block d-sm-none p-2">
                <div class="input-icon">
                    <input type="text" class="form-control" placeholder="Search…" onkeyup="filterSearching(this.value)">
                    <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="40"
                            height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="10" cy="10" r="7"></circle>
                            <line x1="21" y1="21" x2="15" y2="15"></line>
                        </svg>
                    </span>
                </div>
            </div>
        </div>

        <!-- offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="more-canvas" aria-labelledby="more-canvasLabel"
            aria-modal="true" role="dialog">
            <div class="offcanvas-header">
                <h2 class="offcanvas-title" id="more-canvasLabel">Informations sur l'article</h2>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="card">
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-5">N°:</dt>
                            <dd class="col-7" id="id-four"></dd>

                            <dt class="col-5">Rs:</dt>
                            <dd class="col-7" id="rs-four"></dd>

                            <dt class="col-5">Nom:</dt>
                            <dd class="col-7" id="nom-four"></dd>

                            <dt class="col-5">Prénom:</dt>
                            <dd class="col-7" id="prenom-four"></dd>

                            <dt class="col-5">Téléphone:</dt>
                            <dd class="col-7" id="tel-four"></dd>

                            <dt class="col-5">Fix:</dt>
                            <dd class="col-7" id="fix-four"></dd>

                            <dt class="col-5">Willaya:</dt>
                            <dd class="col-7" id="wil-four"></dd>

                            <dt class="col-5">Rc:</dt>
                            <dd class="col-7" id="rc-four"></dd>

                            <dt class="col-5">Ai:</dt>
                            <dd class="col-7" id="ai-four"></dd>

                            <dt class="col-5">Matricule fiscal:</dt>
                            <dd class="col-7" id="mf-four"></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="container-xl">
                <div class="card" id="table-default">
                    <div class="table-responsive" style="min-height: 300px;">
                        <table class="table card-table table-vcenter text-nowrap datatable table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        N°
                                    </th>
                                    <th>
                                        <button class="table-sort" data-sort="sort-rs">
                                            Rs
                                        </button>
                                    </th>
                                    <th class="w-1">
                                        <button class="table-sort" data-sort="sort-nom">
                                            Nom et Prénom
                                        </button>
                                    </th>
                                    <th>
                                        <button class="table-sort" data-sort="sort-tel">
                                            Téléphone
                                        </button>
                                    </th>
                                    <th>
                                        <button class="table-sort" data-sort="sort-wil">
                                            Willaya
                                        </button>
                                    </th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody class="table-tbody">


                                @forelse ($fournisseurs as $fournisseur)
                                    <tr>
                                        <td>{{ $fournisseur->id }}</td>
                                        <td class='sort-rs'>
                                            {{ Str::limit($fournisseur->rs, 50) }}
                                        </td>
                                        <td class='sort-nom'>
                                            {{ $fournisseur->nom }} {{ $fournisseur->prenom }}
                                        </td>
                                        <td class='sort-tel'>
                                            {{ $fournisseur->tel }}
                                        </td>
                                        <td class='sort-wil'>
                                            {{ $fournisseur->willaya }}
                                        </td>
                                        <td>
                                            <div class="dropstart">
                                                <button class="btn-action dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-demo">
                                                    <span class="dropdown-header">{{ __('Options') }}</span>
                                                    <a class="dropdown-item" data-bs-toggle="offcanvas"
                                                        href="#more-canvas" role="button" aria-controls="more-canvas"
                                                        onclick="detail({{ $fournisseur }})">

                                                        <span class="dropdown-item-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-help" width="40"
                                                                height="40" viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <circle cx="12" cy="12" r="9">
                                                                </circle>
                                                                <line x1="12" y1="17" x2="12"
                                                                    y2="17.01"></line>
                                                                <path
                                                                    d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4">
                                                                </path>
                                                            </svg>
                                                        </span>
                                                        détail
                                                    </a>
                                                    @can('modifier_fournisseurs')
                                                        <a class="dropdown-item"
                                                            href="{{ url('fournisseurs/' . $fournisseur->id . '/edit') }}">
                                                            <!-- Download SVG icon from http://tabler-icons.io/i/edit -->
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon dropdown-item-icon" width="24" height="24"
                                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                                fill="none" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path
                                                                    d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                                <path
                                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                                <path d="M16 5l3 3" />
                                                            </svg>
                                                            modifier
                                                        </a>
                                                    @endcan

                                                    @can('supprimer_fournisseurs')
                                                        <div class="dropdown-divider"></div>
                                                        <form action="{{ url('fournisseurs/' . $fournisseur->id) }}"
                                                            method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="icon dropdown-item-icon icon-tabler icon-tabler-trash text-danger"
                                                                    width="24" height="24" viewBox="0 0 24 24"
                                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                    </path>
                                                                    <line x1="4" y1="7" x2="20"
                                                                        y2="7"></line>
                                                                    <line x1="10" y1="11" x2="10"
                                                                        y2="17"></line>
                                                                    <line x1="14" y1="11" x2="14"
                                                                        y2="17"></line>
                                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                                                    </path>
                                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3">
                                                                    </path>
                                                                </svg>
                                                                supprimer
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Aucune fournisseur trouvée</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('custom_scripts')
    <script>
        var table_headers = [
            'rs',
            'nom',
            'tel',
            'wil',
            'info1',
            'info2',
            'info3'
        ]
        for (var i = 0; i < table_headers.length; i++) {
            table_headers[i] = "sort-" + table_headers[i]
        }


        // Create List Object
        const list = new List('table-default', {
            sortClass: 'table-sort',
            listClass: 'table-tbody',
            valueNames: table_headers,
            page: 8,
        });

        // Filter Text 
        function filterSearching(key) {
            list.search(key);
        }

        function remove_filters(type = "") {
            var items_filter = document.getElementsByClassName('filter');
            for (var i = 0; i < items_filter.length; i++) {
                if (items_filter[i].classList.contains(type) || type == "") items_filter[i].classList.remove('d-none');
            }
        }

        function detail(fournisseur) {
            //console.log(fournisseur.nom);

            $('#id-four').html(fournisseur.id);
            $('#rs-four').html(fournisseur.rs);
            $('#nom-four').html(fournisseur.nom);
            $('#prenom-four').html(fournisseur.prenom);
            $('#tel-four').html(fournisseur.tel);
            $('#fix-four').html(fournisseur.fax);
            $('#wil-four').html(fournisseur.willaya);
            $('#rc-four').html(fournisseur.rc);
            $('#ai-four').html(fournisseur.ai);
            $('#mf-four').html(fournisseur.mf);

        }
    </script>
@endsection
