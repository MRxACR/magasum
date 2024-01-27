<div class="col-12">
    <div class="card @error('articles') border-danger @enderror">
        <div class="card-body">
            <h4 class="card-title">Articles</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="" class="form-label check-field">Designation</label>
                        <input type="text" class="form-control" id="desg_art"
                            onkeyup="search_artciels(this.value)" placeholder=""
                            onchange="set_default_attribute(this.value)">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="" class="form-label check-field">Quantité</label>
                        <input type="text" class="form-control" id="quantity" onkeyup="num_validation(this)" onchange="num_validation(this)"
                            placeholder="">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="" class="form-label check-field">prix</label>
                        <input type="text" class="form-control" id="prix" onkeyup="num_validation(this)" onchange="num_validation(this)"
                            placeholder="">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Categorie</label>
                        <select class="form-select" id="categorie_id">
                            @isset($categories)
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->desg }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Unité</label>
                        <select class="form-select" id="unite_id">
                            @isset($unites)
                                @foreach ($unites as $unite)
                                    <option value="{{ $unite->id }}">{{ $unite->desg }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Type d'article</label>
                        <select class="form-select" id="type_id">
                            @isset($types)
                                @foreach ($types as $types_article)
                                    <option value="{{ $types_article->id }}">{{ $types_article->desg }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Ajouter à la liste</label>
                        <button type="button" onclick="new_field()"
                            class="btn btn-outline-primary w-100">Ajouter</button>
                    </div>
                </div>

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
                                    <th class="w-1">prix</th>
                                    <th class="w-1">categorie</th>
                                    <th class="w-1">Unité</th>
                                    <th class="w-1">Type</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="articles_table">

                                @if (old('articles') != null)
                                    @foreach (old('articles') as $key => $value)
                                        <tr class="articles[{{ $key }}] article"
                                            name="articles[{{ $key }}]">
                                            <td style="width: 1%" class="order">
                                                {{ $key }}
                                            </td>
                                            <td class="w-25"><input
                                                    name="articles[{{ $key }}][desg_art]"
                                                    class="form-control" readonly
                                                    value="{{ $value['desg_art'] }}">
                                            </td>
                                            <td class="w-1">
                                                <input
                                                    name="articles[{{ $key }}][quantity]"
                                                    type="number" class="form-control qte"
                                                    value="{{ $value['quantity'] }}">
                                            </td>
                                            <td class="w-1"><input
                                                    name="articles[{{ $key }}][prix]"
                                                    type="number" class="form-control prx"
                                                    value="{{ $value['prix'] }}">
                                            </td>
                                            <td class="w-1"><input
                                                    name="articles[{{ $key }}][categorie]"
                                                    class="form-control" readonly
                                                    value="{{ $value['categorie'] }}">
                                            </td>
                                            <td class="w-1"><input
                                                    name="articles[{{ $key }}][unite]"
                                                    class="form-control" readonly
                                                    value="{{ $value['unite'] }}">
                                            </td>
                                            <td class="w-1"><input
                                                    name="articles[{{ $key }}][type]"
                                                    class="form-control" readonly
                                                    value="{{ $value['type'] }}">
                                            </td>

                                            <td style="width: 1%">
                                                <button
                                                    class="btn btn-outline-danger btn-icon rounded-circle"
                                                    onclick="this.parentElement.parentElement.remove();">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-minus"
                                                        width="40" height="40"
                                                        viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                            fill="none"></path>
                                                        <line x1="5" y1="12"
                                                            x2="19" y2="12"></line>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    @isset($commande)
                                        @php 
                                            $counter = 0;
                                        @endphp
                                        @foreach ($commande->catalogue->articles() as $article)
                                            <tr class="articles[{{ $counter }}] article"
                                                name="articles[{{ $counter }}]">
                                                <td style="width: 1%" class="order">
                                                    {{ $counter }}
                                                </td>
                                                <td class="w-25"><input
                                                        name="articles[{{ $counter }}][desg_art]"
                                                        class="form-control" readonly
                                                        value="{{ $article->desg_art }}">
                                                </td>
                                                <td class="w-1">
                                                    <input
                                                        name="articles[{{ $counter }}][quantity]"
                                                        type="number" class="form-control qte"
                                                        value="{{ $article->pivot->quantity }}" onchange="num_validation(this)">
                                                </td>
                                                <td class="w-1"><input
                                                        name="articles[{{ $counter }}][prix]"
                                                        type="number" class="form-control prx"
                                                        value="{{ $article->pivot->prix }}" onchange="num_validation(this)">
                                                </td>
                                                <td class="w-1"><input
                                                        name="articles[{{ $counter }}][categorie]"
                                                        class="form-control" readonly
                                                        value="{{ $article->categorie->desg }}">
                                                </td>
                                                <td class="w-1"><input
                                                        name="articles[{{ $counter }}][unite]"
                                                        class="form-control" readonly
                                                        value="{{ $article->unite->desg }}">
                                                </td>
                                                <td class="w-1"><input
                                                        name="articles[{{ $counter }}][type]"
                                                        class="form-control" readonly
                                                        value="{{ $article->type->desg }}">
                                                </td>

                                                <td style="width: 1%">
                                                    <button
                                                        class="btn btn-outline-danger btn-icon rounded-circle"
                                                        onclick="this.parentElement.parentElement.remove();">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-minus"
                                                            width="40" height="40"
                                                            viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z"
                                                                fill="none"></path>
                                                            <line x1="5" y1="12"
                                                                x2="19" y2="12"></line>
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                @endif

                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@section('custom_scripts')

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>

        // clear all alerts
        function clear_alerts() {
            let alerts = $('.is-invalid');
            for (let i = 0; i < alerts.length; i++) {
                const element = alerts[i];
                element.classList.remove('is-invalid')

            }
        }

        // clear fields
        function clear_fields() {
            let fields = $('.check-field');
            for (let i = 0; i < fields.length; i++) {
                const element = fields[i];
                element.value = "";

            }
        }

        // return the template of the field 
        function template_field(order = 1, desg_art = "", quantity = "", prix = "", categorie = "", unite = "", type = "") {

            return `<tr class="articles[` + order + `] article" name="articles[` + order + `]">
                    <td style="width: 1%" class="order">` + order + `</td>
                    <td class="w-25"><input name="articles[` + order +
                `][desg_art]" class="form-control" readonly  value="` + desg_art + `"></td>
                    <td class="w-1">
                        <input name="articles[` + order +
                `][quantity]" type="number" class="form-control qte" value="` +
                quantity + `" onchange="num_validation(this)">
                </td>
                    <td class="w-1"><input name="articles[` + order +
                `][prix]" type="number" class="form-control prx" value="` + prix + `" onchange="num_validation(this)"></td>
                    <td class="w-1"><input name="articles[` + order +
                `][categorie]" class="form-control"  readonly  value="` + categorie + `"></td>
                    <td class="w-1"><input name="articles[` + order +
                `][unite]" class="form-control"  readonly  value="` + unite + `"></td>
                    <td class="w-1"><input name="articles[` + order +
                `][type]" class="form-control"  readonly  value="` + type + `"></td>
                    <td style="width: 1%">
                        <button class="btn btn-outline-danger btn-icon rounded-circle"
                                    onclick="this.parentElement.parentElement.remove();">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="icon icon-tabler icon-tabler-minus"
                                width="40" height="40" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z"
                                    fill="none"></path>
                                <line x1="5" y1="12" x2="19"
                                    y2="12"></line>
                            </svg>
                        </button></td>
                    </tr>
            `;
        }

        // Search articles  
        async function search_artciels(value) {

            // to check if the input is not null 
            if (value == '') return [];

            // send request to the server
            this.articles = await $.ajax({
                type: "POST",
                url: "{{ url('api/articles/search') }}",
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

                    // to handle all designation
                    let desg_articles = [];

                    // get all designation
                    for (let i = 0; i < data.articles.data.length; i++) {
                        const element = data.articles.data[i];
                        desg_articles.push(element.desg_art)
                    }

                    // autocomplite the input
                    $("#desg_art").autocomplete({
                        source: desg_articles
                    });
                }
            });

        }

        // Set the default values to the selected item 
        async function set_default_attribute(value) {

            // send request to the server
            this.articles = await $.ajax({
                type: "POST",
                url: "{{ url('api/articles/search') }}",
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
                    if (data.articles.length == 0) return 0;
                    article = data.articles[0];


                    try {
                        $("#prix").val(article.prix);
                        $("#quantity").val(article.qte_stock);
                        $("#categorie_id").val(article.categorie_id);
                        $("#unite_id").val(article.unite_id);
                        $("#type_id").val(article.type_id);
                    } catch (error) {
                        console.log(error);
                    }

                }
            });
        }

        // numerique validation
        function num_validation(Element){
            let value = Element.value;
            if (value == '' || isNaN(value) || value < 0 || value == 0) Element.classList.add('is-invalid');
            else Element.classList.remove('is-invalid');
        }

        // add new field
        function new_field() {

            clear_alerts();

            let old_fields = $(".article");
            let order = old_fields.length + 1;
            let errors = 0;

            let desg_art = $('#desg_art').val();
            let quantity = $('#quantity').val();
            let prix = $('#prix').val();

            let categorie = $('#categorie_id').find(":selected").text().replace(
                '\n                                                                ', '');
            let unite = $('#unite_id').find(":selected").text().replace(
                '\n                                                                ', '');
            let type = $('#type_id').find(":selected").text().replace(
                '\n                                                                ', '');

            if (desg_art == '') {
                $('#desg_art')[0].classList.add('is-invalid');
                errors++
            }
            if (quantity == '' || isNaN(quantity) || quantity < 0 || quantity == 0 ) {
                $('#quantity')[0].classList.add('is-invalid');
                errors++
            }
            if (prix == '' || isNaN(prix) || prix < 0 || prix == 0 ) {
                $('#prix')[0].classList.add('is-invalid');
                errors++
            }
            if (categorie == '') {
                $('#categorie_id')[0].classList.add('is-invalid');
                errors++
            }
            if (unite == '') {
                $('#unite_id')[0].classList.add('is-invalid');
                errors++
            }
            if (type == '') {
                $('#type_id')[0].classList.add('is-invalid');
                errors++
            }

            if (errors === 0) {
                // remove old field if exist
                let el = old_fields.find('[value="'+desg_art+'"]')
                if (el[0]) {
                    el[0].parentElement.parentElement.remove();
                }
                // apend row to the table 
                $('#articles_table').append(template_field(order, desg_art, quantity, prix, categorie, unite, type))
                // clear check fields fields
                clear_fields()
            }

        }

        // to confirme the submit
        function confrmation() {
            // Get values
            let num = $('#num').val();
            let fournisseur = $('#fournisseur').find(":selected").text();
            let tva = Number($('#tva').val());
            let m_ht = 0;
            let m_tva = 0;
            let m_ttc = 0;

            let articles = $('.article');

            for (let i = 0; i < articles.length; i++) {
                const element = articles[i];
                m_ht += element.getElementsByClassName('qte')[0].value * element.getElementsByClassName('prx')[0].value;

            }

            m_tva = tva * m_ht / 100;
            m_ttc = m_tva + m_ht;


            $("#conf_num").text(num);
            $("#conf_fournisseur").text(fournisseur);
            $("#conf_tva").text(tva + ' %');
            $("#conf_ht").text(m_ht + ' DA');
            $("#conf_m_tva").text(m_tva + ' DA');
            $("#conf_ttc").text(m_ttc + ' DA');

        }

        

    </script>
@endsection