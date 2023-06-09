@extends('layouts.app')


@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Sorties</h2>
                    <div class="text-muted mt-1">{{ $prise_charges->count() + $bon_sorties->count() }} Elément(s)</div>
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



                        @can('cree_sorties')
                            <a href="{{ url('sorties/create') }}" class="btn btn-outline-primary ms-3">
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

            <div class="row" id="sorties">
                <div class="col-md-6 mb-3">
                    <div class="card p-3">
                        <h3 class="page-title mb-2">Prises en charges ({{ $prise_charges->count() }})</h3>

                        <div class="card-table table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Bénéficiaire</th>
                                        <th class="text-center">Articles</th>
                                        <th class="text-end">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="prise-charges">

                                    @foreach ($prise_charges as $pc)
                                        <tr onclick="location.href = '{{ url('sorties/pc/' . $pc->sortie->id) }}'"
                                            class="cursor-pointer">
                                            <td class="num">{{ $pc->sortie->num }}</td>
                                            <td class="name">{{ $pc->sortie->nom }} {{ $pc->sortie->prenom }}</td>
                                            <td class="articles text-center" style="width: 2%">
                                                {{ $pc->sortie->articles->count() }}</td>
                                            <td class="text-end date">{{ date('d-m-Y', strtotime($pc->sortie->date)) }}
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 mb-3">
                    <div class="card p-3">
                        <h3 class="page-title mb-2">Bons de sortie ({{ $bon_sorties->count() }})</h3>
                        <div class="card-table table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Bénéficiaire</th>
                                        <th class="text-center">Articles</th>
                                        <th class="text-end">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="bon-sorties">

                                    @foreach ($bon_sorties as $bs)
                                        <tr onclick="location.href = '{{ url('sorties/bs/' . $bs->sortie->id) }}'"
                                            class="cursor-pointer">
                                            <td class="num">{{ $bs->sortie->num }}</td>
                                            <td class="name">{{ $bs->sortie->nom }} {{ $bs->sortie->prenom }}</td>
                                            <td class="articles text-center" style="width: 2%">
                                                {{ $bs->sortie->articles->count() }}</td>
                                            <td class="text-end date">{{ date('d-m-Y', strtotime($bs->sortie->date)) }}
                                            </td>
                                        </tr>
                                    @endforeach


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
        const prise_charges = new List('sorties', {
            listClass: 'prise-charges',
            valueNames: [
                'num',
                'name',
                'date'
            ],
            page: 8

        });
        const bon_sorties = new List('sorties', {
            listClass: 'bon-sorties',
            valueNames: [
                'num',
                'name',
                'date'
            ],
            page: 8

        });

        // Filter Text 
        function search(key) {
            prise_charges.search(key);
            bon_sorties.search(key);
        }
    </script>
@endsection
