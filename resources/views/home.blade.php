@extends('layouts.app')

@section('custom_styles')
@endsection

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">


                @can('voir_articles')
                    <div class="col-md-6 col-xl-3">

                        <a href="{{ url('articles') }}" class="card card-link card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-primary text-white avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-box-seam" width="40" height="40"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
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
                                            Articles
                                        </div>
                                        <div class="text-muted">
                                            {{ $articles }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan

                @can('voir_commandes')
                    <div class="col-md-6 col-xl-3">
                        <a href="{{ url('commandes', []) }}" class="card card-link card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-cyan text-white avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-checklist" width="40" height="40"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8">
                                                </path>
                                                <path d="M14 19l2 2l4 -4"></path>
                                                <path d="M9 8h4"></path>
                                                <path d="M9 12h2"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            Commandes
                                        </div>
                                        <div class="text-muted">
                                            @isset($commandes)
                                                {{ $commandes }}
                                            @else
                                                0
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan

                @can('voir_receptions')
                    <div class="col-md-6 col-xl-3">

                        <a href="{{ url('receptions') }}" class="card card-link card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-green text-white avatar">


                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-arrow-big-down-lines" width="40"
                                                height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M15 12h3.586a1 1 0 0 1 .707 1.707l-6.586 6.586a1 1 0 0 1 -1.414 0l-6.586 -6.586a1 1 0 0 1 .707 -1.707h3.586v-3h6v3z">
                                                </path>
                                                <path d="M15 3h-6"></path>
                                                <path d="M15 6h-6"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            Réception
                                        </div>
                                        <div class="text-muted">
                                            @isset($receptions)
                                                {{ $receptions }}
                                            @else
                                                0
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan

                @can('voir_sorties')
                    <div class="col-md-6 col-xl-3">
                        <a href="{{ url('sorties', []) }}" class="card card-link card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-pink text-white avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-arrow-big-up-lines" width="40"
                                                height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M9 12h-3.586a1 1 0 0 1 -.707 -1.707l6.586 -6.586a1 1 0 0 1 1.414 0l6.586 6.586a1 1 0 0 1 -.707 1.707h-3.586v3h-6v-3z">
                                                </path>
                                                <path d="M9 21h6"></path>
                                                <path d="M9 18h6"></path>
                                            </svg>
                                        </span>

                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            Sorties
                                        </div>
                                        <div class="text-muted">
                                            @php
                                                $bss = $bonSorties ?? 0;
                                                $pcs = $priseCharge ?? 0;
                                            @endphp
                                            {{ $bss + $pcs }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan

                @can('voir_fournisseurs')
                    <div class="col-md-6 col-xl-3">
                        <a href="{{ url('fournisseurs') }}" class="card card-link card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-azure text-white avatar">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            Fournisseurs
                                        </div>
                                        <div class="text-muted">
                                            @isset($fournisseurs)
                                                {{ $fournisseurs }}
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan

                @can('voir_reformes')
                    <div class="col-md-6 col-xl-3">
                        <a href="{{ url('reformes', []) }}" class="card card-link card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-red text-white avatar">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-box-off" width="40" height="40"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
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
                                            Réformes
                                        </div>
                                        <div class="text-muted">
                                            @isset($reformes)
                                                {{ $reformes }}
                                            @else
                                                0
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan

                @can('voir_inventaires')
                    <div class="col-md-6 col-xl-3">
                        <a href="{{ url('inventaires', []) }}" class="card card-link card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-yellow text-white avatar">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/message -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4">
                                                </path>
                                                <line x1="8" y1="9" x2="16" y2="9"></line>
                                                <line x1="8" y1="13" x2="14" y2="13"></line>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            Inventaire
                                        </div>
                                        <div class="text-muted">
                                            @isset($inventaires)
                                                {{ $inventaires }}
                                            @else
                                                0
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan

                @can('voir_paramaitres')
                    <div class="col-md-6 col-xl-3 d-none">
                        <a href="#" class="card card-link card-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="bg-orange text-white avatar">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-alert-octagon" width="40"
                                                height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M8.7 3h6.6c.3 0 .5 .1 .7 .3l4.7 4.7c.2 .2 .3 .4 .3 .7v6.6c0 .3 -.1 .5 -.3 .7l-4.7 4.7c-.2 .2 -.4 .3 -.7 .3h-6.6c-.3 0 -.5 -.1 -.7 -.3l-4.7 -4.7c-.2 -.2 -.3 -.4 -.3 -.7v-6.6c0 -.3 .1 -.5 .3 -.7l4.7 -4.7c.2 -.2 .4 -.3 .7 -.3z">
                                                </path>
                                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                            </svg>
                                        </span>

                                    </div>
                                    <div class="col">
                                        <div class="font-weight-medium">
                                            Paramaitres
                                        </div>
                                        <div class="text-muted">
                                            16
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan

                @can('voir_articles')
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <p class="mb-3"><strong>Etat de stock</strong></p>
                                <div class="progress progress-separated mb-3">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                        style="width: {{ $disponible }}%" aria-label="Regular"></div>
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{ $alert }}%" aria-label="System"></div>
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{ $repture }}%" aria-label="Shared"></div>
                                </div>
                                <div class="row">
                                    <div class="col-auto d-flex align-items-center pe-2">
                                        <span class="legend me-2 bg-primary"></span>
                                        <span>Articles disponible</span>

                                    </div>
                                    <div class="col-auto d-flex align-items-center px-2">
                                        <span class="legend me-2 bg-warning"></span>
                                        <span>Articles en alerte</span>

                                    </div>
                                    <div class="col-auto d-flex align-items-center ps-2">
                                        <span class="legend me-2 bg-danger"></span>
                                        <span>Articles en rupture de stock</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan

                @can('voir_articles')
                    <div class="col-md-6 col-lg-4">
                        <div class="card divide-y" style="height: 100%">
                            <div class="card-header text-capitalize">
                                <strong>Les articles les plus demandés</strong>
                            </div>
                            <table class="table card-table table-vcenter table-hover ">
                                <thead>
                                    <tr>
                                        <th>Designation</th>
                                        <th>Quanité</th>
                                        <th class="text-center">Etat</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($articles_demandee as $article)
                                        <tr onclick="location.href = '{{ url('articles/' . $article->id_art) }}'" class="cursor-pointer">
                                            <td>{{ Str::limit($article->desg_art, 10, '...') }}</td>
                                            <td>{{ $article->quantite }}</td>
                                            <td class="w-50">
                                                <div class="progress progress-xs">
                                                    <div class="progress-bar @if ($article->alert) bg-warning @endif bg-primary"
                                                        style="width: {{ $article->etat }}%"></div>
                                                </div>
                                            </td>
                                        </tr>

                                    @empty

                                        <tr>
                                            <td colspan="3" class="text-center">Aucune sortie trouvée</td>
                                        </tr>
                                    @endforelse



                                </tbody>
                            </table>
                        </div>
                    </div>
                @endcan

                @can('voir_articles')
                    <div class="col-md-6 col-lg-8" id="research">
                        <div class="card" style="height: 100%">
                            <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" placeholder="Recherche rapide..."
                                        onkeyup="search_artciels(value)">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search"
                                            width="40" height="40" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="10" cy="10" r="7"></circle>
                                            <line x1="21" y1="21" x2="15" y2="15"></line>
                                        </svg>
                                    </span>
                                </div>
                                <div class="divide-y quick-items list">


                                </div>
                            </div>
                        </div>
                    </div>
                @endcan


            </div>
        </div>
    </div>
@endsection

@section('custom_scripts')
    <script>
        // Search articles  
        async function search_artciels(value) {

            // to check if the input is not null 
            if (value == '') {
                // send request to the server
                this.articles = await $.ajax({
                    type: "GET",
                    url: "{{ url('api/home') }}",
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
                        items.clear();
                        for (let i = 0; i < data.data.length; i++) {
                            items.add(data.data[i]);
                            console.log(data.data[i]);
                        }
                    }
                });
            } else {
                // send request to the server
                this.articles = await $.ajax({
                    type: "POST",
                    url: "{{ url('api/home/search') }}",
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
                        items.clear();
                        for (let i = 0; i < data.data.length; i++) {
                            items.add(data.data[i]);
                            console.log(data.data[i]);
                        }
                    }
                });
            }




        }

        search_artciels('');

        //Create listjs object
        var options = {
            valueNames: ['title', 'subtitle', 'subtitle', 'date', 'url', 'type'],
            page: 5,
            item: function(values) {
                return `<div>
                    <div class="row">
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
                            <div class="text-truncate name">
                                <p><strong class="title"></strong> <span class="subtitle2"></span></p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="text-truncate date"></div>
                                <a href="${values.url}" class="text-truncate pe-auto type"></a>
                            </div>
                        </div>
                        <div class="col-auto align-self-center">
                        </div>
                    </div>
                </div>`;
            }

        };

        var values = [{
                name: 'Jonny Strömberg',
                born: 1986
            },
            {
                name: 'Jonas Arnklint',
                born: 1985
            },
            {
                name: 'Martina Elm',
                born: 1986
            }
        ];

        var items = new List('research', options);

        function search(value) {
            items.search(value);
        }
    </script>
@endsection
