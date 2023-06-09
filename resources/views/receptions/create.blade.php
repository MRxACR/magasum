@extends('layouts.app')

@section('custom_styles')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection

@section('content')
    <div class="container-xl">

        <!-- Page title -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <a href="{{ url('receptions') }}" class="btn btn-outline-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back"
                            width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"></path>
                        </svg>
                        Page précedente
                    </a>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        @isset($reception)
                            <button class="btn btn-outline-warning" onclick="presubmit()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check"
                                    width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M5 12l5 5l10 -10"></path>
                                </svg>
                                Mettre à jour
                            </button>
                        @else
                            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#confirmation"
                                onclick="confrmation()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check"
                                    width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M5 12l5 5l10 -10"></path>
                                </svg>
                                Enregistrer
                            </button>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="confirmation" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
          <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-status bg-primary"></div>
            <div class="modal-body text-center py-4">
              <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-primary icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 9v2m0 4v.01"></path><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"></path></svg>
              <h3>Confirmation?</h3>
              <div class="text-muted">Veuillez bien confirmer la réception.</div>
            </div>
            <div class="modal-footer">
              <div class="w-100">
                <div class="row">
                  <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                        Annuler
                    </a></div>
                  <div class="col"><a href="#" class="btn btn-primary w-100" onclick='$("#articles-form").submit();'>
                      Enregistrer
                    </a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>




    <div class="page-body">
        <div class="container-xl">
            <div class="card p-3">
                <form
                    action="@isset($reception) {{ url('receptions/' . $reception->id) }} @else {{ url('receptions') }} @endisset"
                    method="post" id="articles-form">
                    @isset($reception)
                        @method('PUT')
                    @else
                        @method('POST')
                    @endisset
                    @csrf
                    <div class="row">
                        <div class="hr-text">Bon de commande</div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Bon de commande</label>
                                <select class="form-select @error('commande_id') is-invalid @enderror" name="commande_id" id="commande_id" onclick="select_commande()"> 
                                    @foreach ($commandes as $commande)
                                        <option value="{{ $commande->id }}" rs="{{ $commande->fournisseur->rs }}" date="{{ date("d/m/Y" , strtotime($commande->date)) }}" fournisseur="{{ $commande->fournisseur->nom }} {{ $commande->fournisseur->prenom }}">N°: {{ $commande->num }}
                                            
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                              <label class="form-label">Date</label>
                              <div class="form-control-plaintext" id="date"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Fournisseur</label>
                              <div class="align-middle h-100">
                                <div class="form-control-plaintext" id="fournisseur"></div>
                              </div>
                            </div>
                        </div>

                        <div class="hr-text">Bon de Livraison</div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="" class="form-label">N° Bon de livraison</label>
                                <div class="input-group">

                                    <input type="text" class="form-control @error('livraison') is-invalid @enderror"
                                        name="livraison" id="livraison" placeholder="####/SDMM/23" maxlength="15"
                                        required
                                        @if (old('livraison') != null) value="{{ old('livraison') }}" @else @isset($reception)
                                            value="{{ $reception->livraison->num }}"
                                        @endisset @endif>
                                    @error('livraison')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Date don de livraison</label>
                                <input type="text" class="form-control @error('date_livraison') is-invalid @enderror"
                                    name="date_livraison" id="" placeholder="date_livraison"
                                    @if (old('date_livraison') != null) value="{{ old('date_livraison') }}" @else @isset($reception) value="{{ date('d/m/Y', strtotime($reception->livraison->date)) }}" @else value="{{ date('d/m/Y') }}" @endisset @endif>
                                @error('date_livraison')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="hr-text">Facture</div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="" class="form-label">N° de facture</label>
                                <div class="input-group">

                                    <input type="text" class="form-control @error('facture') is-invalid @enderror"
                                        name="facture" id="facture" placeholder="####/SDMM/23" maxlength="15"
                                        required
                                        @if (old('facture') != null) value="{{ old('facture') }}" @else @isset($reception)
                                            value="{{ $reception->facture->num }}"
                                        @endisset @endif>
                                    @error('facture')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Date la facture</label>
                                <input type="text" class="form-control @error('date_facture') is-invalid @enderror"
                                    name="date_facture" id="" placeholder="date_facture"
                                    @if (old('date_facture') != null) value="{{ old('date_facture') }}" @else @isset($reception) value="{{ date('d/m/Y', strtotime($reception->livraison->date)) }}" @else value="{{ date('d/m/Y') }}" @endisset @endif>
                                @error('date_facture')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="hr-text">Bon de réception</div>


                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="" class="form-label">N° Bon de réception</label>
                                <div class="input-group">

                                    <input type="text" class="form-control @error('num') is-invalid @enderror"
                                        name="num" id="num" placeholder="####/SDMM/23" maxlength="15" required
                                        @if (old('num') != null) value="{{ old('num') }}" @else @isset($reception)
                                            value="{{ $reception->num }}"
                                        @endisset @endif>
                                    @error('num')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="" class="form-label">N° de marche</label>
                                <div class="input-group">

                                    <input type="text" class="form-control @error('num_marche') is-invalid @enderror"
                                        name="num_marche" id="num_marche" placeholder="####/SDMM/23" maxlength="15"
                                        required
                                        @if (old('num_marche') != null) value="{{ old('num_marche') }}" @else @isset($reception)
                                            value="{{ $reception->num_marche }}"
                                        @endisset @endif>
                                    @error('num_marche')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="" class="form-label">N° de consultation</label>
                                <div class="input-group">

                                    <input type="text"
                                        class="form-control @error('num_consultation') is-invalid @enderror"
                                        name="num_consultation" id="num_consultation" placeholder="####/SDMM/23"
                                        maxlength="15" required
                                        @if (old('num_consultation') != null) value="{{ old('num_consultation') }}" @else @isset($reception)
                                            value="{{ $reception->num_consultation }}"
                                        @endisset @endif>
                                    @error('num_consultation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="" class="form-label">N° ODS</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('num_ods') is-invalid @enderror"
                                        name="num_ods" id="num_ods" placeholder="####/SDMM/23" maxlength="15" required
                                        @if (old('num_ods') != null) value="{{ old('num_ods') }}" @else @isset($reception)
                                            value="{{ $reception->num_ods }}"
                                        @endisset @endif>
                                    @error('num_ods')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="hr-text">Articles</div>

                        <div class="col-12" id="articles-list">
                            <div class="card @error('articles') border-danger @enderror">
                                <div class="card-body">
                                    <h4 class="card-title">Articles</h4>
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label">Liste</label>
                                            <div class="table-responsive">
                                                <table
                                                    class="table 
                                                table-hover	
                                                table-bordered
                                                
                                                align-middle">
                                                    <thead class="">
                                                        <tr class="text-uppercase">
                                                            <th style="width: 1%">No</th>
                                                            <th>Designation</th>
                                                            <th class="w-1">Quantité</th>
                                                            <th class="text-center">prix</th>
                                                            <th class="text-center">Montant HT</th>
                                                            <th class="w-25">N° Inventaire</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="articles-list-class">  
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection

@section('custom_scripts')
    <script>
        let options = {
            listClass: 'articles-list-class',
            valueNames: ['no', 'designation', 'categorie', 'type', 'quantite', 'prix', 'montant'],
            item: function(values) {
                return `<tr name="articles[${values.no}]"><td class="d-none"><input class="form-control d-none" value="${values.id}" name="articles[${values.no}][id]" /></td> <td class="no"></td><td class="designation" name="articles[${values.no}][designation]">Disk dure externne</td><td class="text-center quantite" name="articles[${values.no}][quantite]">26</td><td class="text-center prix" name="articles[${values.no}][prix]">7100</td><td class="text-center montant"  name="articles[${values.no}][montant]">35500</td><td><input show="${values.type}" type="text" class="form-control inventaire" placeholder="####/SDMM/23" name="articles[${values.no}][n_inventaire]"></td></tr>`;           }
        }

        const articles = new List('articles-list', options);

        // Search articles  
        async function select_commande() {

            // send request to the server
            this.articles = await $.ajax({
                    type: "POST",
                    url: "{{ url('api/articles/commandes/search') }}",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: JSON.stringify({
                        "data": $('#commande_id').val(),
                        "_token": "{!! csrf_token() !!}"
                    }),

                    // if the request is success
                    success: function(data) {
                        articles.clear();
                        for (let i = 0; i < data.articles.length; i++) {
                            const element = data.articles[i];
                            articles.add(data.articles[i]);
                            
                        };
                        hide_inv();
                    }
                });

            get_attributes();





        }

        function get_attributes() {
           

            $('#date').text($('#commande_id').find(":selected").attr('date'));
            $('#fournisseur').text($('#commande_id').find(":selected").attr('fournisseur') + ' - ' + $('#commande_id').find(":selected").attr('rs'));
        }

        function hide_inv() { 
            
            let inputs = $('.inventaire');
            for (let i = 0; i < inputs.length; i++) {
                const element = inputs[i];
                if(element.getAttribute('show') == "false") element.classList.add('d-none');
            }
            
         }
        select_commande();
    </script>
@endsection
