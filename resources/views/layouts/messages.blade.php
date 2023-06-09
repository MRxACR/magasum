@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="container-xl mt-3 d-print-none">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>

                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                         </svg>
                    </div>
                    <div>
                        <h4 class="alert-title">Erreur</h4>
                        <div class="text-muted">{{ $error }}</div>
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        </div>

        @php
            break;
        @endphp

    @endforeach

@else
    @if (Session::has('message'))
        @if (session('status') == 'success')
            <div class="container-xl mt-3 d-print-none">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l5 5l10 -10"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="alert-title">Operation réussie</h4>
                            <div class="text-muted">{{ session('message') }}</div>
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            </div>
        @endif
        @if (session('status') == 'warning')
            <div class="container-xl mt-3 d-print-none">
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div class="icon alert-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 9v2m0 4v.01"></path>
                                <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75"></path>
                             </svg>

                        </div>
                        <div>
                            <h4 class="alert-title">Impossible d'effectuer l'opération</h4>
                            <div class="text-muted">{{ session('message') }}</div>
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            </div>
        @endif
    @endif

@endif
