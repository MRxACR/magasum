@extends('layouts.app')

@section('custom_styles')
    <style>
        @page {
            size: A4 !important;
            margin: 0.5cm !important;
            zoom: 70% !important;
        }

        @media print {
            .pagebreak {
                clear: both;
                page-break-after: always;
            }
        }
    </style>
@endsection



@section('content')
    @isset($reception)
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">


                    <div class="col-sm-3">
                        <a href="{{ url('receptions') }}" class="btn btn-outline-primary  w-sm-auto w-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="40"
                                height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"></path>
                            </svg>
                            Réceptions
                        </a>
                    </div>
                    <div class="col-sm-3 ms-sm-auto">
                        @can('supprimer_receptions')
                        <form action="{{ url('receptions/' . $reception->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger me-1  w-sm-auto w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                    width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="4" y1="7" x2="20" y2="7"></line>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                </svg>
                                Supprimer
                            </button>

                        </form>
                    @endcan
                </div>
                <div class="col-sm-3">
                    <button type="button" class="btn btn-primary w-sm-auto w-100" onclick="javascript:window.print();">
                        <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2">
                            </path>
                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                            <rect x="7" y="13" width="10" height="8" rx="2"></rect>
                        </svg>
                        Imprimer
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body font-monospace">
        <div class="container-xl">
            <div class="card card-lg">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-6 text-sm-start text-center mb-3">
                            @isset($reception->document)
                                {!! $reception->document->heading !!}
                            @endisset
                        </div>

                        <div class="col-sm-6 mb-3 text-center text-sm-end">
                            <p class="fs-3">
                                <strong>Bon de Réception N°:</strong> <span>{{ $reception->num }}</span>
                            </p>
                        </div>

                        <div class="col-12 mb-4">

                            @isset($reception->document)
                                @if ($reception->document->logo != '')
                                    <div class="text-center mb-3">
                                        <img src="{{ url($reception->document->logo, []) }}" width="70">
                                    </div>
                                @endif
                            @endisset

                            <h1 class="text-uppercase text-center">

                                @isset($reception->document)
                                    {!! $reception->document->titre !!}
                                @else
                                    Bon De Réception
                                @endisset
                            </h1>
                        </div>

                        <div class="col-12">
                            <p class="fs-4"><strong>Commande N°:</strong>
                                <span>{{ $reception->livraison->commande->num }}</span> <strong>Du</strong>
                                <span>{{ $reception->livraison->commande->date }}</span>
                            </p>
                            <p class="fs-4"><strong>Fournisseur N°:</strong>
                                <span>{{ $reception->livraison->commande->fournisseur->nom }}
                                    {{ $reception->livraison->commande->fournisseur->prenom }}
                                    ({{ $reception->livraison->commande->fournisseur->rs }})</span> <strong>Tél:</strong>
                                <span>{{ $reception->livraison->commande->fournisseur->tel }}</span>
                            </p>
                            <div class="d-flex justify-content-between">
                                <p class="fs-4"><strong>Facture N°:</strong> <span>{{ $reception->facture->num }} </span>
                                    <strong>Du:</strong> <span>{{ $reception->facture->date }}</span>
                                </p>
                                <p class="fs-4"><strong>Bon de Livraison N°:</strong>
                                    <span>{{ $reception->livraison->num }} </span> <strong>Du:</strong>
                                    <span>{{ $reception->livraison->date }}</span>
                                </p>

                            </div>
                        </div>


                    </div>

                    <div class="mb-3">
                        <table class="table table-transparent table-responsive table-bordered fs-5 mb-5">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 1%">N°</th>
                                    <th class="text-start">Designation</th>
                                    <th class="text-center" style="width: 1%">Quantité</th>
                                    <th class="text-center">Prix unitaire</th>
                                    <th class="text-center">Montant HT</th>
                                    <th class="text-end" style="width: 1%">N° D'inventaire</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle text-center">
                                @php
                                    $counter = 1;
                                    $break = false;
                                @endphp

                                @foreach ($reception->articles as $article)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td class="text-start">{{ $article->desg_art }}</td>
                                        <td>{{ $article->pivot->quantity }}</td>
                                        <td>{{ number_format($article->pivot->prix, 2, ',', ' ') }} DA</td>
                                        <td>{{ number_format($article->pivot->prix * $article->pivot->quantity, 2, ',', ' ') }}
                                            DA</td>
                                        <td>{{ $article->pivot->n_inventaire }}</td>
                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <p class="fs-4"><strong>Merche N°:</strong> <span>{{ $reception->num_marche }}</span></p>
                            <p class="fs-4"><strong>Consultation N°:</strong>
                                <span>{{ $reception->num_consultation }}</span>
                            </p>
                            <p class="fs-4"><strong>Bon de commande N°:</strong>
                                <span>{{ $reception->livraison->commande->num }}</span>
                            </p>
                            <p class="fs-4"><strong>ODS N°:</strong> <span>{{ $reception->num_ods }}</span></p>
                        </div>
                        <div class="col-sm-6 text-end">
                            <div class="text-start">
                                <p class="fs-4"><strong>Total Hors Taxe:</strong> <span>{{ $reception->montant_ht }}
                                        DA</span></p>
                                <p class="fs-4"><strong>TVA %:</strong> <span>{{ $reception->tva }} %</span></p>
                                <p class="fs-4"><strong>Montant TVA:</strong> <span>{{ $reception->montant_tva }}
                                        DA</span></p>
                                <p class="fs-4"><strong>Montant TTC:</strong> <span>{{ $reception->montant_ttc }}
                                        DA</span></p>
                            </div>
                        </div>


                    </div>

                    {{-- <br class="pagebreak"> --}}


                    {{-- @foreach ($article->catalogues as $catalogue)
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <strong><u>Bon de commande</u></strong>
                                        <p><strong>N°:</strong> <span>{{$catalogue->commande->num}}</span><br><strong>Date:</strong>
                                            <span>{{$catalogue->commande->date}}</span></p>
                                    </div>
                                    <div class="col-sm-4">
                                        <strong><u>Fournisseur</u></strong>
                                        <p><strong>Nom et prénom:</strong> <span> {{$catalogue->fournisseur->nom}} {{$catalogue->fournisseur->prenom}}</span><br><strong>Rs:</strong>
                                            <span>{{$catalogue->fournisseur->rs}}</span></p>
                                    </div>
                                    <div class="col-sm-2">
                                        <strong><u>Bon de livraison</u></strong>
                                        <p><strong>N°:</strong> <span>/</span><br><strong>Date:</strong>
                                            <span>/</span></p>
                                    </div>
                                    <div class="col-sm-2">
                                        <strong><u>Facture</u></strong>
                                        <p><strong>N°:</strong> <span>/</span><br><strong>Date:</strong>
                                            <span>/</span></p>
                                    </div>
                                    <div class="col-sm-2">
                                        <strong><u>Bon de réception</u></strong>
                                        <p><strong>N°:</strong> <span>/</span><br><strong>Date:</strong>
                                            <span>/</span></p>
                                    </div>
                                </div>
                                <table class="table table-transparent table-responsive table-bordered fs-5 mb-5">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 1%">Type de Ducument</th>
                                            <th class="text-center" style="width: 1%">N°</th>
                                            <th class="text-center" style="width: 1%">Date</th>
                                            <th class="text-center" style="width: 1%">Mouvement</th>
                                            <th class="text-center" style="width: 1%">Quanité</th>
                                            <th class="text-center" style="width: 1%">Stock</th>
                                            <th class="text-center" style="width: 1%">Prix U</th>
                                            <th class="text-center" style="width: 1%">Inventiare</th>
                                            <th class="text-center">Affectation</th>
                                            <th class="text-center" style="width: 1%">Nom bénéficiaire</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle text-center">
                                        @php
                                            $counter = 1;
                                            $break = false;
                                        @endphp



                                    </tbody>


                                </table>
                            </div>
                        @endforeach --}}
                </div>
            </div>
        </div>
    </div>
@endisset
@endsection

@section('custom_scripts')
@endsection
