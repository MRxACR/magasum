@extends('layouts.app')

@section('custom_styles')
    <style>
        @page {
            size: landscape|A4|A5;
            margin: 0cm !important;
            zoom: 70%;
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
    @isset($inventaire)
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <a href="{{ url('inventaires') }}" class="btn btn-outline-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="40"
                                height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"></path>
                            </svg>
                            Sorties
                        </a>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none d-flex">

                        <form action="{{ url('inventaires/'.$inventaire->id) }}" method="post">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-outline-danger me-1" >
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="4" y1="7" x2="20" y2="7"></line>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                 </svg>
                                Suprimer
                            </button>
                            
                        </form>

                        <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
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
                        <div class="row">
                            <div class="col-sm-6 text-sm-start text-center mb-3">

                                @isset($inventaire->document)
                                    {!! $inventaire->document->heading !!}
                                @endisset


                            </div>
                            <div class="col-sm-6 text-sm-end text-center mb-3">
                                <p class="fs-3"><strong>N°: <u>{{ $inventaire->id}}</u></strong></p>
                                <p class="fs-3"><strong>Tizi-ouzou Le: <u> {{ date('d-m-Y', strtotime($inventaire->date)) }}</u>
                                    </strong></p>

                            </div>
                            <div class="col-12 my-5">
                                <h1 class="text-uppercase text-center">
                                    @isset($inventaire->document)
                                        {!! $inventaire->document->titre !!}
                                    @else
                                        FICHE D'INVENTAIRE D'ÉQUIPEMENTS
                                    @endisset
                                </h1>
                            </div>
                        </div>

                        <table class="table table-transparent table-responsive table-bordered fs-5 ">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 1%">N°</th>
                                    <th>Designation</th>
                                    @if($inventaire->champs->unite) <th class="text-center" style="width: 1%">Unité</th> @endif
                                    @if($inventaire->champs->n_inventaire) <th class="text-center" style="width: 1%">Numéro d'inventiare</th> @endif
                                    @if($inventaire->champs->n_serie) <th class="text-center" style="width: 1%">Numéro de série</th> @endif
                                    @if($inventaire->champs->quanite) <th class="text-center" style="width: 1%">Quanité</th> @endif
                                    @if($inventaire->champs->prix_unt) <th class="text-center" style="width: 15%">Prix unitaire</th> @endif
                                    @if($inventaire->champs->prix_ttc) <th class="text-end" style="width: 15%">Prix Total</th> @endif
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 1;
                                    $break = false;
                                @endphp

                                @foreach ($inventaire->articles as $article)
                                <tr>
                                    <td class="text-center" style="width: 1%">{{$counter++}}</td>
                                    <td>{{$article->desg_art}}</td>
                                    @if($inventaire->champs->unite) <td class="text-center" style="width: 1%">{{$article->unite->abr}}</td> @endif
                                    @if($inventaire->champs->n_inventaire) <td class="text-center" style="width: 1%">{{$article->pivot->n_inventaire}}</td> @endif
                                    @if($inventaire->champs->n_serie) <td class="text-center" style="width: 1%">{{$article->pivot->n_referance}}</td> @endif
                                    @if($inventaire->champs->quanite) <td class="text-center" style="width: 1%">{{$article->pivot->quantity}}</td> @endif
                                    @if($inventaire->champs->prix_unt) <td class="text-center" style="width: 1%">{{ number_format($article->pivot->prix,2, ',', ' ') }} DA</td> @endif
                                    @if($inventaire->champs->prix_ttc) <td class="text-end" style="width: 1%">{{number_format($article->pivot->prix * $article->pivot->quantity,2, ',', ' ') }} DA</td> @endif
                                </tr>
                                @endforeach
                                

                            </tbody>
                            
                            
                        </table>
                        @if($inventaire->champs->prix_ttc)
                            <div class="d-flex justify-content-end">
                                <p class="fs-3 ms-4"><strong>Total:</strong> {{ number_format($inventaire['total'],2, ',', ' ') }} DA</p>
                            </div>
                        @endif

                        <div class="row d-flex justify-content-between text-uppercase mt-5">

                            @isset($inventaire->document)
                                {!! $inventaire->document->subheading !!}
                             @endisset

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
@endsection

@section('custom_scripts')
@endsection
