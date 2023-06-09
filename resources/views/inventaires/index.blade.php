@extends('layouts.app')


@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title text-capitalize">Inventaire</h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <div class="d-none d-sm-block">
                            <div class="input-icon">
                                <input type="text" class="form-control" placeholder="Search…"
                                    onkeyup="search(this.value)">
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



                        @can('cree_inventaires')
                            <button type="button" class="btn btn-outline-primary ms-3" data-bs-toggle="modal"
                                data-bs-target="#nouveau">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="40"
                                    height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                Nouveau
                            </button>
                        @endcan

                    </div>
                </div>
            </div>
            <div class="d-block d-sm-none p-2">
                <div class="input-icon">
                    <input type="text" class="form-control" placeholder="Search…" onkeyup="search(this.value)">
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

        <div class="modal modal-blur fade" id="nouveau" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">


                    <form action="{{ url('inventaires') }}" method="post">
                        @csrf
                        @method('POST')
                        <div class="modal-header">
                            <h5 class="modal-title">Enregistrerr une nouvelle fiche d'inventaire: <span
                                    class="badge bg-primary mx-2">{{ date('d-m-Y') }}</span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <h3>Selectioner les champs de la nouvelle fiche d'inventaire</h3>
                                <h4 class="text-muted">Cette operation risque de prendre du temps</h4>

                            </div>
                            <div class="list-group">
                                <label class="list-group-item">
                                    <input class="form-check-input me-1" name="designation" type="checkbox" checked
                                        disabled>
                                    Designation des l'articles
                                </label>
                                <label class="list-group-item">
                                    <input class="form-check-input me-1" name="unite" type="checkbox" checked>
                                    Unité des l'articles
                                </label>
                                <label class="list-group-item">
                                    <input class="form-check-input me-1" name="quanite" type="checkbox" checked>
                                    Quantité
                                </label>
                                <label class="list-group-item">
                                    <input class="form-check-input me-1" name="prix_unt" type="checkbox" checked>
                                    Prix unitaire
                                </label>
                                <label class="list-group-item">
                                    <input class="form-check-input me-1" name="prix_ttc" type="checkbox">
                                    Prix total
                                </label>
                                <label class="list-group-item d-none">
                                    <input class="form-check-input me-1" name="n_inventaire" type="checkbox">
                                    Numéro d'inventaire
                                </label>
                                <label class="list-group-item d-none">
                                    <input class="form-check-input me-1" name="n_serie" type="checkbox">
                                    Numéro de série
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="row">
                @isset($info_stock)
                    <div class="col-md-6">
                        <div class="row row-cards">

                            <div class="col-12">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-primary text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-box-seam" width="40"
                                                        height="40" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M12 3l8 4.5v9l-8 4.5l-8 -4.5v-9l8 -4.5"></path>
                                                        <path d="M12 12l8 -4.5"></path>
                                                        <path d="M8.2 9.8l7.6 -4.6"></path>
                                                        <path d="M12 12v9"></path>
                                                        <path d="M12 12l-8 -4.5"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">

                                                    Articles: {{ $articles_inv }} et élements : {{ $elements_inv }}
                                                </div>
                                                <div class="text-muted">
                                                    Informations globales sur l'état actuelle du stock
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-success text-white avatar">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-coin" width="40"
                                                        height="40" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <circle cx="12" cy="12" r="9"></circle>
                                                        <path
                                                            d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1">
                                                        </path>
                                                        <path d="M12 7v10"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{ number_format($valeur_inv, 2, ',', ' ') }} DA
                                                </div>
                                                <div class="text-muted">
                                                    Valeur total
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endisset
                <div class="col-md-6">
                    <div class="card" id="table-default">
                        <div class="table-responsive" style="min-height: 300px;">
                            <table class="table card-table table-vcenter text-nowrap datatable table-hover"
                                id="sorties">
                                <thead>
                                    <tr>
                                        <th style="width: 1%">
                                            <button class="table-sort" data-sort="no">
                                                NO
                                            </button>
                                        </th>
                                        <th style="width: 1%">
                                            <button class="table-sort" data-sort="no">
                                                Articles
                                            </button>
                                        </th>

                                        <th>
                                            <button class="table-sort text-end" data-sort="date">
                                                Date
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="reformes">




                                    @isset($inventaires)
                                        @forelse ($inventaires as $inventaire)
                                            <tr class="cursor-pointer"
                                                onclick="location.href = '{{ url('inventaires/' . $inventaire->id) }}'">
                                                <td class="no text-center">{{ $inventaire->id }}</td>
                                                <td class="no text-center">{{ $inventaire->articles()->count() }}</td>
                                                <td class="text-end date">{{ $inventaire->date }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Aucune inventaire trouvée</td>
                                            </tr>
                                        @endforelse
                                    @endisset


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('custom_scripts')
    <script>
        // Create List Object
        const reformes = new List('sorties', {
            listClass: 'reformes',
            valueNames: [
                'no',
                'num',
                'motif',
                'articles',
                'date'
            ]
            //page: 8

        });

        // Filter Text 
        function search(key) {
            reformes.search(key);
        }
    </script>
@endsection
