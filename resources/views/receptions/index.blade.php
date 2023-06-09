@extends('layouts.app')


@section('content')
    @isset($receptions)
        <div class="container-xl" id="commandes">
            <!-- Page title -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">Réception</h2>
                        <div class="text-muted mt-1">{{ $receptions->count() }} Elément(s)</div>
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


                            @can('cree_receptions')
                                <a href="{{ url('receptions/create') }}" class="btn btn-outline-primary ms-3">
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
                    <div class="col-12 mb-3">
                        <div class="card table-responsive">

                            <table class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th class="w-1 text-center">N° ordre</th>
                                        <th class="w-1 text-center">N° bon réception</th>
                                        <th class="text-start">N° bon de commande</th>
                                        <th class="text-center">N° bon de livraison</th>
                                        <th class="text-center">N° facture</th>
                                        <th class="text-center">Articles</th>
                                        <th class="text-end">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="commande-list">

                                    @php
                                        $counter = 1;
                                    @endphp

                                    @forelse ($receptions as $reception)
                                        <tr onclick="location.href = '{{ url('receptions/' . $reception->id) }}'"
                                            class="cursor-pointer">
                                            <td class="w-1 text-center ord">{{ $counter++ }}</td>
                                            <td class="w-1 text-center num_br">{{ $reception->num }}</td>
                                            <td class="w-1 text-center num_bc">{{ $reception->livraison->commande->num }}</td>
                                            <td class=" text-center num_bl">{{ $reception->livraison->num }}</td>
                                            <td class="text-center num_fac">{{ $reception->facture->num }}</td>
                                            <td class="w-1 text-center articles">{{ $reception->articles->count() }}</td>
                                            <td class="text-end date">{{ $reception->date }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center"> Aucune réception trouvée </td>
                                        </tr>
                                    @endforelse


                                </tbody>
                            </table>
                        </div>

                    </div>


                </div>

            </div>

        </div>
    @endisset
@endsection

@section('custom_scripts')
    <script>
        // Create List Object
        const commandes = new List('commandes', {
            listClass: 'commande-list',
            valueNames: [
                'ord',
                'num_br',
                'num_bc',
                'num_bl',
                'articles',
                'date'
            ]
            //page: 8

        });
        // Filter Text 
        function search(key) {
            commandes.search(key);
        }
    </script>
@endsection
