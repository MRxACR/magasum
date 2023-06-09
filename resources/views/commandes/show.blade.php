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
                //clear: both;
                page-break-after: always;
            }
        }
    </style>
@endsection



@section('content')
    @isset($commande)
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">

                    <div class="col-sm-3">
                        <a href="{{ url('commandes') }}" class="btn btn-outline-primary  w-sm-auto w-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="40"
                                height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"></path>
                            </svg>
                            Commandes
                        </a>
                    </div>
                    <div class="col-sm-3 ms-sm-auto">
                        @can('supprimer_commandes')
                            <form action="{{ url('commandes/' . $commande->id) }}" method="post">
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
                        <div class="row " style="page-break-after: always;">
                            <div class="col-sm-12 text-center">
                                @isset($commande->document)
                                    {!! $commande->document->heading !!}
                                @endisset



                            </div>

                            @isset($commande->document)
                                <div class="text-center mb-3">
                                    @if ($commande->document->logo != '')
                                        <img src="{{ url($commande->document->logo, []) }}" width="70">
                                    @endif
                                </div>
                            @endisset

                            <div class="col-12 mb-2">
                                <h1 class="text-uppercase text-center">

                                    @isset($commande->document)
                                        {!! $commande->document->titre !!}
                                    @else
                                        BON DE COMMANDE
                                    @endisset
                                </h1>
                            </div>

                            <div class="col-12 text-end mb-3 ">
                                <p class="fs-3"><strong>N°:</strong> <u>{{ $commande->num }}</u></p>
                                <p class="fs-3"><strong>Date:</strong> <u>
                                        {{ date('d-m-Y', strtotime($commande->date)) }}</u>
                                </p>

                            </div>

                            <div class="d-flex justify-content-between ">
                                <div class="col-md-4 mb-3 w-25" style="width: 40">
                                    <div class="card" style="border: 1px solid black;padding:0.2em;height : 100%">
                                        <div class="card-body">
                                            <h5 class="card-title text-center  text-uppercase"><u>Service du
                                                    contrôleur<br>financier</u></h5>
                                            <p class="card-text">A: ................</p>
                                            <p class="card-text">Le: ................</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8 mb-3  text-center w-75" style="width: 40">
                                    <h5 class="card-title text-uppercase"><u><strong>Identification du service
                                                contractant</strong></u></h5>
                                    <div class="text-start px-3">
                                        <p><strong><u>Dénomination:</u> </strong>{{ $commande->denomination }}</p>
                                        <p><strong><u>Code gestionnaire:</u> </strong>{{ $commande->code }}</p>
                                        <p><strong><u>Adresse:</u> </strong>{{ $commande->adresse }}</p>
                                        <p><strong><u>Téléphone:</u> </strong>{{ $commande->telephone }} <strong><u>Fax:</u>
                                            </strong> {{ $commande->fix }}</p>
                                    </div>
                                    <h5 class="card-title text-uppercase"><u><strong>Identification du Prestataire</strong></u>
                                    </h5>
                                    <div class="text-start px-3">
                                        <p><strong><u>Nom et prénom:</u> </strong>{{ $commande->fournisseur->nom }}
                                            {{ $commande->fournisseur->prenom }}</p>
                                        <p><strong><u>Raison sociale:</u> </strong>{{ $commande->fournisseur->rs }}</p>
                                        <p><strong><u>Adresse:</u> </strong>{{ $commande->fournisseur->adr }}</p>
                                        <p><strong><u>Willaya:</u> </strong> {{ $commande->fournisseur->willaya }}</p>
                                        <p><strong><u>Téléphone:</u> </strong>{{ $commande->fournisseur->tel }}
                                            <strong><u>Fax:</u></strong> {{ $commande->fournisseur->fax }}
                                        </p>
                                        <p><strong><u>N° RC:</u> </strong>{{ $commande->fournisseur->rc }}</p>
                                        <p><strong><u>N° d'agrément:</u> </strong>{{ $commande->fournisseur->ai }}</p>
                                    </div>
                                    <h5 class="card-title text-uppercase"><u><strong>Caracteristique de la
                                                commande</strong></u></h5>

                                </div>
                            </div>

                            <div>
                                <div class="text-start px-3 d-flex justify-content-between"
                                    style="border: 1px solid black;padding:1em;min-height:150px;">

                                    <div class="w-50">
                                        @isset($types)
                                            <label class="mb-2"><strong><u>Nature de la commande</u></strong></label><br>
                                            @foreach ($types as $type)
                                                <label>
                                                    <input type="radio" name="type"
                                                        @if ($type->id == $commande->type_commande_id) checked @endif
                                                        onclick="javascript: return false;">
                                                    {{ $type->desg }}
                                                </label>
                                                <br>
                                            @endforeach
                                        @endisset
                                    </div>

                                    <div class="w-100">
                                        <label class="mb-2"><strong><u>Objet de la commande</u></strong></label>
                                        <div class="w-100 text-start">
                                            {{ $commande->object }}
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>



                        <div class="card table-responsive my-5">

                            <table class="table table-transparent table-responsive table-bordered fs-5">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 1%">N°</th>
                                        <th>Designation</th>
                                        <th class="text-center" style="width: 1%">Unité</th>
                                        <th class="text-center" style="width: 1%">Quanité</th>
                                        <th class="text-center" style="width: 15%">Prix unitaire</th>
                                        <th class="text-end" style="width: 15%">Montant</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $counter = 1;
                                        $break = false;
                                    @endphp


                                    @foreach ($commande->catalogue->articles as $article)
                                        <tr>
                                            <td class="text-center" style="width: 1%">{{ $counter++ }}</td>
                                            <td>{{ $article->desg_art }}</td>
                                            <td class="text-center" style="width: 1%">{{ $article->unite->abr }}</td>
                                            <td class="text-center" style="width: 1%">{{ $article->pivot->quantity }}</td>
                                            <td class="text-center" style="width: 1%">
                                                {{ number_format($article->pivot->prix, 2, ',', ' ') }} DA</td>
                                            <td class="text-end" style="width: 1%">
                                                {{ number_format($article->pivot->prix * $article->pivot->quantity, 2, ',', ' ') }}
                                                DA</td>
                                        </tr>
                                    @endforeach


                                    <tr class="text-end">
                                        <th scope="row" colspan="5">Montant HT</th>
                                        <td>{{ number_format($commande->montant_ht, 2, '.', ' ') }} DA</td>
                                    </tr>
                                    <tr class="text-end">
                                        <th scope="row" colspan="5">TVA %</th>
                                        <td>{{ number_format($commande->catalogue->tva, 2) }} %</td>
                                    </tr>
                                    <tr class="text-end">
                                        <th scope="row" colspan="5">Montant de la TVA</th>
                                        <td>{{ number_format($commande->montant_tva, 2, '.', ' ') }} DA</td>
                                    </tr>
                                    <tr class="text-end">
                                        <th scope="row" colspan="5">Montant TTC</th>
                                        <td>{{ number_format($commande->montant_ttc, 2, '.', ' ') }} DA</td>
                                    </tr>
                                </tbody>


                            </table>

                        </div>


                        <div class="row">
                            <div class="col-12">
                                <p>
                                    Arrêter le présent bon de commande à la somme de:
                                    <strong>{{ $commande->somme_en_lettre }}</strong>. <br>Le prestataire s'engage à exécuter
                                    la présente
                                    commande selon les conditions Arrêteés. <br>
                                <div class="d-none">
                                    La source de financement: ................................ <br>
                                    Le délai de livraison ou d'exécution est estimé à ...................... à compter de la
                                    date de signature du présent bon de commande.
                                </div>
                                </p>
                                <div class="d-flex justify-content-between mt-5">
                                    <p class="text-start">
                                        <strong>Le Sous Directeur</strong>
                                    </p>
                                    <p class="text-end">
                                        <strong>Tizi-ouzou le:</strong> .......................
                                    </p>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endisset
@endsection

@section('custom_scripts')
@endsection
