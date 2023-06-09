@extends('layouts.app')

@section('custom_styles')
    <style>
        @page {
            size: landscape !important;
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
    @isset($article)
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <a href="{{ url('articles') }}" class="btn btn-outline-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="40"
                                height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"></path>
                            </svg>
                            Articles
                        </a>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none d-flex">

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
                <div class="card card-lg ">
                    <div class="card-body ">
                        <div class="row mb-3">
                            <div class="col-sm-6 text-start mb-3">
                                @isset($article->document)
                                    {!! $article->document->heading !!}
                                @endisset
                            </div>

                            <div class="col-sm-6 mb-3">
                                @isset($article->document)
                                    @if ($article->document->logo != '')
                                        <div class="text-center mb-3">
                                            <img src="{{ url($article->document->logo, []) }}" width="70">
                                        </div>
                                    @endif
                                @endisset
                            </div>

                            <div class="col-12 mt-3">
                                <div class="text-start">
                                    <p><strong>Désignation:</strong> <span>{{ $article->desg_art }}</span>
                                    </p>
                                    <p><strong>Référance N°:</strong>
                                        <span>{{ $article->id_art }}/{{ date('Y', strtotime($article->created_at)) }}</span>
                                    </p>
                                    <p><strong>Quantité en stock°:</strong> <span>{{ $article->stock }}</span></p>
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <h1 class="text-uppercase text-center">

                                    @isset($article->document)
                                        {!! $article->document->titre !!}
                                    @else
                                        FICHE DE STOCK
                                    @endisset
                                </h1>
                            </div>



                        </div>


                    
                            <div class="table-responsive">
                                <table class="table table-transparent  table-responsive table-bordered fs-5 mb-5">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 1%">NO</th>
                                            <th class="text-start">Ducument</th>
                                            <th class="text-center">N° Document</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center" style="width: 1%">Mouvement</th>
                                            <th class="text-center" style="width: 1%">Quanité</th>
                                            <th class="text-center">Info</th>
                                            <th class="text-center">Nom bénéficiaire | fournisseur</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle text-center">
                                        @php
                                            $counter = 1;
                                            $break = false;
                                        @endphp
    
                                        @forelse ($mouvements as $key => $mouvement)
                                            <tr>
                                                <td>{{ $counter++ }}</td>
                                                <td class="text-start">{{ $mouvement['document'] }}</td>
                                                <td>{{ $mouvement['num'] }}</td>
                                                <td>{{ $mouvement['date'] }}</td>
                                                <td>{{ $mouvement['mouvement'] }}</td>
                                                <td>{{ $mouvement['quanite'] }}</td>
                                                <td class="text-start">{{ $mouvement['info'] }}</td>
                                                <td class="text-start">{{ $mouvement['beneficiaire'] }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">Aucun mouvement a été trouver</td>
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
@endsection
