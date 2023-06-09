@extends('layouts.app')


@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title text-capitalize">Réformes</h2>
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


                        @can('cree_reformes')
                            <a href="{{ url('reformes/create') }}" class="btn btn-outline-primary ms-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="40"
                                    height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                Nouveau
                            </a>
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

        <div class="page-body">


            <div class="row">
                <div class="col-md-6">
                    <div class="row row-cards">

                        <div class="col-12">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="bg-red text-white avatar">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/brand-github -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-box-off" width="40"
                                                    height="40" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M17.765 17.757l-5.765 3.243l-8 -4.5v-9l2.236 -1.258m2.57 -1.445l3.194 -1.797l8 4.5v8.5">
                                                    </path>
                                                    <path d="M14.561 10.559l5.439 -3.059"></path>
                                                    <path d="M12 12v9"></path>
                                                    <path d="M12 12l-8 -4.5"></path>
                                                    <path d="M3 3l18 18"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{ $articles_rf }} article(s) [ {{ $elements_rf }} élements(s) ]
                                            </div>
                                            <div class="text-muted">
                                                Réformes total
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
                                            <span class="bg-red text-white avatar">
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
                                                {{ number_format($valeur_rf, 2, ',', ' ') }} DA
                                            </div>
                                            <div class="text-muted">
                                                Montant des pertes total
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
                                            <span class="bg-red text-white avatar">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <line x1="12" y1="5" x2="12" y2="19">
                                                    </line>
                                                    <line x1="18" y1="13" x2="12" y2="19">
                                                    </line>
                                                    <line x1="6" y1="13" x2="12" y2="19">
                                                    </line>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <div class="font-weight-medium">
                                                {{ number_format($valeur_rf / $nbr_years, 2, ',', ' ') }} DA / années
                                            </div>
                                            <div class="text-muted">
                                                Estimation des pertes / années
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
                                            <button class="table-sort w-1" data-sort="num">
                                                Numéro
                                            </button>
                                        </th>
                                        <th style="width: 1%">
                                            <button class="table-sort" data-sort="articles">
                                                Articles
                                            </button>
                                        </th>
                                        <th style="width: 1%">
                                            <button class="table-sort text-end" data-sort="date">
                                                Date
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="reformes">


                                    @php
                                        $counter = 1;
                                        $rf = 0;
                                    @endphp


                                    @forelse ($reformes as $reforme)
                                        <tr class="cursor-pointer"
                                            onclick="location.href = '{{ url('reformes/' . $reforme->sortie->id) }}'">
                                            <td class="no">{{ $counter++ }}</td>
                                            <td class="num">{{ $reforme->sortie->num }}</td>

                                            <td class="text-center articles">{{ $reforme->sortie->articles()->count() }}
                                            </td>
                                            <td class="text-end date">{{ $reforme->sortie->date }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Aucune réforme trouvée</td>
                                        </tr>
                                    @endforelse

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
