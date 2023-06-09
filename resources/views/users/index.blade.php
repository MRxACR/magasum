@extends('layouts.app')

@section('content')
    <div class="container-xl" x-data="myData()" x-init="grap_data()">
        <!-- Page title -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">Gallery</h2>
                    <div class="text-muted mt-1">1-12 of 241 photos</div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex">
                        <div class="me-3 d-none d-md-block">
                            <div class="input-icon">
                                <input type="text" class="form-control" placeholder="Search…">
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
                        <button class="btn btn-primary" @click="grap_data()">
                            Refresh
                        </button>
                        <button class="btn btn-success ms-2" @click="restoreAll()">
                            Restore
                        </button>
                    </div>
                </div>
            </div>
        </div>



        <div class="page-body">
            <div class="container-xl">

                <template x-if="loading">
                    <div class="progress my-3">
                        <div class="progress-bar progress-bar-indeterminate bg-primary"></div>
                    </div>
                </template>

                <div class="card">
                    <div class="table-responsive">

                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                    <th class="w-1"></th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>

                                <template x-for="row in data">
                                    <tr>
                                        <td x-text="row.id"></td>
                                        <td x-text="row.name"></td>
                                        <td x-text="row.email"></td>
                                        <td x-text=' moment(row.created_at).fromNow()  '></td>
                                        <td class="">
                                            <button class="btn btn-icon btn-ghost-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-pencil" width="40"
                                                    height="40" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                                                    <line x1="13.5" y1="6.5" x2="17.5" y2="10.5">
                                                    </line>
                                                </svg>
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-icon btn-ghost-danger" @click="softDelete(row.id,row)">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-trash" width="40" height="40"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <line x1="4" y1="7" x2="20" y2="7">
                                                    </line>
                                                    <line x1="10" y1="11" x2="10" y2="17">
                                                    </line>
                                                    <line x1="14" y1="11" x2="14" y2="17">
                                                    </line>
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>

                <br>
                <br>

            </div>
        </div>
    </div>
@endsection


@section('custom_scripts')
    <script src="{{ url('assets/js/moment.min.js') }}"></script>

    <script>
        function myData() {
            return {
                loading: false,
                app_data: "",
                headers: [],
                data: [],
                async grap_data() {
                    this.loading = true;
                        await fetch('/users_all')
                        .then((response) => response.json())
                        .then((json) => {
                            this.app_data = json;
                            this.headers = json.headers;
                            this.data = json.data;
                        });
                    this.loading = false;
                },
                async softDelete(id, user) {

                    await fetch('/users/' + id, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            body: JSON.stringify({
                                "data": user,
                                "_token": "{!! csrf_token() !!}"
                            })
                        })
                        .then((response) => Promise.all([response.json(), response]) )
                        .then(([responseData,response]) => this.respenceAlert(responseData,response)
                        );
                    this.grap_data();
                },
                async restoreAll() {
                    await fetch("{!! route('users.restore') !!}", {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    }).then((response) => 
                        Promise.all([response.json(), response])
                    ).then(([responseData,response]) =>
                        this.respenceAlert(responseData,response)
                    )

                    this.grap_data();
                },
                respenceAlert(responseData,response) {
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-bottom-right",
                        "preventDuplicates": false,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    if (response.ok) toastr.success(responseData.success);
                    else if (response.status == 401) toastr.warning(responseData.error);
                    else toastr.error(responseData.error);
                }
            }
        }
    </script>
@endsection
