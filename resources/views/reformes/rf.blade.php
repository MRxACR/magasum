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
    @isset($rf)
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <a href="{{ url('reformes') }}" class="btn btn-outline-primary">
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

                        @can('supprimer_reformes')
                            <form action="{{ url('reformes/' . $rf->sortie->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger me-1">
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

                        @can('modifier_reformes')
                            <a href="{{ url('reformes/' . $rf->sortie->id . '/edit', []) }}" class="btn btn-outline-warning me-1">
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
        <div class="page-body font-monospace">
            <div class="container-xl">
                <div class="card card-lg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 text-sm-start text-center mb-3">

                                @isset($rf->document)
                                    {!! $rf->document->heading !!}
                                @endisset


                            </div>
                            <div class="col-sm-6 text-sm-end text-center mb-3">
                                <p class="fs-3"><strong>N°: <u>{{ $rf->sortie->num }}</u></strong></p>
                                <p class="fs-3"><strong>Tizi-ouzou Le: <u>
                                            {{ date('d-m-Y', strtotime($rf->sortie->date)) }}</u>
                                    </strong></p>

                            </div>
                            <div class="col-12 my-5">
                                <h1 class="text-uppercase text-center">
                                    @isset($rf->document)
                                        {!! $rf->document->titre !!}
                                    @else
                                        Réforme
                                    @endisset
                                </h1>

                                <div class="mx-md-3 mt-4">
                                    <strong>Motif:</strong>
                                    <p class="m-sm-2">
                                        {!! $rf->motif !!}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card table-responsive ">
                            <table class="table table-transparent table-bordered fs-5 ">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 1%">N°</th>
                                        <th>Designation</th>
                                        <th class="text-center" style="width: 1%">Unité</th>
                                        <th class="text-center" style="width: 1%">Quanité</th>
                                        <th class="text-end" style="width: 25%">Observation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $counter = 1;
                                        $break = false;
                                    @endphp
                                    @foreach ($rf->sortie->articles as $article)
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
                                            <td class="text-end">{{ $article->pivot->observation }}</td>
                                        </tr>
                                    @endforeach {{-- --}}

                                </tbody>
                            </table>

                        </div>

                        <div class="row d-flex justify-content-between text-uppercase mt-5">

                            @isset($rf->document)
                                {!! $rf->document->subheading !!}
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
