@extends('layouts.app')

@section('custom_styles')
    <style>
        .pagination {
            display: flex;
            justify-content: center;
            text-align: center;
        }

        .pagination li {
            display: inline-block;
            padding: 8px;
        }
    </style>
@endsection

@section('content')
    <div class="container-xl" >
        <!-- Page title -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Articles</h2>
                    <div class="text-muted mt-1">{{ $articles->count() }} Elément(s)</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <div class="me-2 d-none d-sm-block">
                            <div class="input-icon">
                                <input type="text" class="form-control" placeholder="Search…"
                                    onkeyup="search_artciels(this.value)">
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

                    </div>

                </div>
            </div>

            <div class="d-block d-sm-none p-2">
                <div class="input-icon">
                    <input type="text" class="form-control" placeholder="Search…" onkeyup="search_artciels(this.value)">
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

        <div class="page-body" id="articles-list">

            <div class="container-xl">
                <div class="card" id="table-default">
                    <div class="table-responsive" style="min-height: 300px;">
                        <table class="table card-table table-vcenter table-hover text-nowrap datatable cursor-pointer">
                            <thead>
                                <tr>
                                    <th class="w-1">
                                        <button class="table-sort sort" data-sort="no">
                                            No
                                        </button>
                                    </th>
                                    <th>
                                        <button class="table-sort sort" data-sort="designation">
                                            Designation
                                        </button>
                                    </th>
                                    <th class="w-1">
                                        <button class="table-sort sort" data-sort="categorie">
                                            Categorie
                                        </button>
                                    </th>
                                    <th class="w-1">
                                        <button class="table-sort sort" data-sort="type">
                                            Type
                                        </button>
                                    </th>
                                    <th class="w-1">
                                        <button class="table-sort sort" data-sort="quantite">
                                            Quanité du Stock
                                        </button>
                                    </th>
                                    <th class="w-25 text-center">
                                        <button class="table-sort sort" data-sort="etat">
                                            Etat du stock
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="articles-lis-class">
                                <tr>
                                    <td colspan="6" class="text-center">Aucun article trouvée</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('custom_scripts')
    <script src="https://cdn.jsdelivr.net/npm/textversionjs@1.1.3/src/textversion.min.js"></script>

    <script>

        let options = {
            listClass: 'articles-lis-class',
            valueNames: ['no', 'designation', 'categorie', 'type', 'quantite', 'url', 'etat', 'alert' ],
 
            item: function(values) {
                return `<tr  onclick="location.href = '${values.url}'"><td class="no"></td><td class="designation"></td><td class="categorie"></td><td class="type"></td><td class="text-center" class="quantite">${values.quantite}</td><td class="w-25 text-end etat-pg"><div class="progress progress-lg"><div danger="${values.alert}" class="tr_class" class="progress-bar" style="width: ${values.etat}%" role="progressbar"></div></div></td></tr>`;
            }
        }

        const articles = new List('articles-list', options);

        // Search articles  
        async function search_artciels(value) {

            // to check if the input is not null 
            if (value == '') {
                // send request to the server
                this.articles = await $.ajax({
                    type: "GET",
                    url: "{{ url('api/articles') }}",
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
                        articles.clear();


                        for (let i = 0; i < data.articles.length; i++) {
                            articles.add(data.articles[i]);
                        }
                    }
                });
            } else {
                // send request to the server
                this.articles = await $.ajax({
                    type: "POST",
                    url: "{{ url('api/articles/search/2') }}",
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
                        articles.clear();
                        for (let i = 0; i < data.articles.length; i++) {
                            articles.add(data.articles[i]);
                        }
                    }


                });
            }
            alertes();
        }


        search_artciels('');

        function search_list(value){
            articles.search(value);
        }

        function alertes() { 
            let articles = $(".tr_class");
            for (let i = 0; i < articles.length; i++) {
                const element = articles[i];
                if(JSON.parse(element.getAttribute('danger'))) element.classList.add('bg-warning');
                else element.classList.add('bg-primary');
            }
         }
    </script>
@endsection
