@extends('layouts.app')

@section('custom_styles')
    <style>
        @page {
            size: A1|A4|A5;
            margin: 0.5cm !important;
            zoom: 80%;
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
    @isset($pc)
        <div class="modal modal-blur fade" id="delete-confirmation" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal-title">Confirmation ?</div>
                        <div>assurez-vous de vouloir supprimer cet enregistrement.</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary me-auto"
                            data-bs-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                            onclick="$('#delete-form').submit()">Confirmer</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <a href="{{ url('sorties') }}" class="btn btn-outline-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back"
                                width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"></path>
                            </svg>
                            Sorties
                        </a>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none d-flex">
                        @can('supprimer_sorties')
                            <form action="{{ url('sorties/' . $pc->sortie->id) }}" method="post" id="delete-form">
                                @csrf
                                @method('DELETE')


                            </form>

                            <button type="submit" class="btn btn-outline-danger me-1" data-bs-toggle="modal"
                                data-bs-target="#delete-confirmation">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="40"
                                    height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="4" y1="7" x2="20" y2="7"></line>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                </svg>
                                Supprimer
                            </button>
                        @endcan

                        @can('modifier_sorties')
                            <a href="{{ url('sorties/' . $pc->sortie->id . '/edit', []) }}" class="btn btn-outline-warning me-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="40"
                                    height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                    <path d="M16 5l3 3"></path>
                                </svg>
                                Modifier
                            </a>
                        @endcan

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
        <div
            class="page-body font-monospace @isset($pc->document) {!! $pc->document->police !!} @endisset
            
            ">
            <div class="container-xl">
                <div class="card card-lg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 text-sm-start text-center mb-3 fw-bold">
                                @isset($pc->document)
                                    {!! $pc->document->heading !!}
                                @endisset

                            </div>
                            <div class="col-sm-6 text-sm-end text-center mb-3">
                                <p class="fs-3"><strong>Tizi-ouzou Le: </strong><span
                                        class="text-decoration-underline">{{ date('d-m-Y', strtotime($pc->sortie->date)) }}</span>
                                </p>
                                <p class="fs-3"><strong>N°: </strong><span
                                        class="text-decoration-underline">{{ $pc->sortie->num }}</span></p>

                            </div>
                            <div class="col-12 my-5">
                                <h1 class="text-uppercase text-center text-decoration-underline">
                                    @isset($pc->document)
                                        {!! $pc->document->titre !!}
                                    @else
                                        Prise en charge
                                    @endisset
                                </h1>
                            </div>
                        </div>

                        <div class="fs-3 mb-5 container-md">
                            <p>
                                Je soussigné, <strong class="text-uppercase">M(Mme). {{ $pc->sortie->nom }}
                                    {{ $pc->sortie->prenom }}</strong><br>
                                Fonction: <strong class="text-uppercase">{{ $pc->fonction }}</strong> <br>
                                Certifie avoir pris en charge, ce jour: <strong>{{ $pc->sortie->date }}</strong> <br>
                                Le matériel suivant:
                            </p>
                        </div>

                        <div class="table-responsive">

                            <table class="table table-transparent table-responsive table-bordered fs-5 ">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 1%">N°</th>
                                        <th>Designation</th>
                                        <th class="text-center" style="width: 1%">Unité</th>
                                        <th class="text-center" style="width: 1%">Quanité</th>
                                        <th class="text-center" style="width: 1%">Référance</th>
                                        <th class="text-end" style="width: 25%">Observation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $counter = 1;
                                    @endphp
                                    @foreach ($pc->sortie->articles as $article)
                                        <tr>
                                            <td class="text-center">{{ $counter++ }}</td>
                                            <td>
                                                <p>{{ $article->desg_art }}</p>
                                            </td>
                                            <td class="text-center">
                                                {{ $article->unite->abr }}
                                            </td>
                                            <td class="text-center">
                                                {{ $article->pivot->quantity }}
                                            </td>
                                            <td class="text-end">{{ $article->pivot->referance }}</td>
                                            <td class="text-end">{{ $article->pivot->observation }}</td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>

                        <div class="row  justify-content-between text-uppercase mt-5 d-flex">
                            <div class="col-sm-6 text-sm-start text-center">
                                <div class="h3 mb-3">
                                    <p class="h3">Le Cedant</p>
                                    @if (auth()->user()->signature)
                                        @if ($pc->sortie->signer)
                                            <div class="navbar-brand-autodark ">
                                                <img src="{{ url(auth()->user()->signature) }}" class="img-fluid rounded-top"
                                                    class="img-thumbnail img-fluid " width="150"
                                                    style="position: relative; top:-50px ;">
                                            </div>

                                            <div class="d-print-none ">
                                                <form action="{{ route('signer', ['id' => $pc->sortie->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button d-print-none" class="btn btn-ghost-danger"
                                                        type="submit">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-x" width="40"
                                                            height="40" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <line x1="18" y1="6" x2="6"
                                                                y2="18"></line>
                                                            <line x1="6" y1="6" x2="18"
                                                                y2="18"></line>
                                                        </svg>
                                                        Annuler la signature
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="d-print-none ">
                                                <form action="{{ route('signer', ['id' => $pc->sortie->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('put')
                                                    <button type="button d-print-none" class="btn btn-ghost-primary"
                                                        type="submit">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-writing-sign" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path
                                                                d="M3 19c3.333 -2 5 -4 5 -6c0 -3 -1 -3 -2 -3s-2.032 1.085 -2 3c.034 2.048 1.658 2.877 2.5 4c1.5 2 2.5 2.5 3.5 1c.667 -1 1.167 -1.833 1.5 -2.5c1 2.333 2.333 3.5 4 3.5h2.5">
                                                            </path>
                                                            <path
                                                                d="M20 17v-12c0 -1.121 -.879 -2 -2 -2s-2 .879 -2 2v12l2 2l2 -2z">
                                                            </path>
                                                            <path d="M16 7h4"></path>
                                                        </svg>
                                                        Signer
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endif

                                </div>
                            </div>
                            <div class="col-sm-6 text-sm-end text-center ps-sm-5">
                                <p class="h3 mb-3">le Preneur</p>

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
