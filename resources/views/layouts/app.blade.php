<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ url(config('website.favicon')) }}" type="image/x-icon">

    <meta name="description" content="">
    <title>{{ config('website.app-name', 'Laravel') }}</title>

    @vite('resources/sass/app.scss')

    <link rel="stylesheet" href="{{ url('/assets/css/toastr.min.css') }}">

    <!-- Custom styles for this Page-->
    @yield('custom_styles')

    <script>
        function bodyFn() {
            return {
                theme: localStorage.getItem('theme') ?? "theme-light",
                toggle_theme() {
                    this.theme = this.theme == "theme-dark" ? 'theme-light' : "theme-dark";
                    localStorage.setItem('theme', this.theme)
                }
            }
        }
    </script>

</head>

<body class="{{ auth()->user()->theme ?? 'theme-light' }}">
    {{-- Signaler un erreur model --}}
    <div class="modal modal-blur fade " id="error-signal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex justify-content-between">Signaler Une Erreur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <form action=" {{ url('signal', []) }} " method="post" id="submit_signal">
                        @csrf
                        @method("POST")

                        <div class="mb-3">
                            <label for="" class="form-label">Url :</label>
                            <input type="text" class="form-control" name="url" aria-describedby="helpId"
                                placeholder="Entrer l'url de la page">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Description de l'erreur</label>
                            <textarea class="form-control" name="desc" id="" rows="3"></textarea>
                        </div>

                        <div class="mb-3 text-center">
                            <label for="" class="form-label">Contacter le devlopper de l'application </label>
                            <a href="https://www.facebook.com/ctp.nmdp7" class="btn btn-facebook btn-icon"
                                aria-label="Facebook" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3">
                                    </path>
                                </svg>
                            </a>
                            <a href="https://github.com/MRxACR" class="btn btn-gitub btn-icon" aria-label="gitub"
                                target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-brand-github" width="40" height="40"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5">
                                    </path>
                                </svg>
                            </a>
                            <a href="https://twitter.com/acrabdou" class="btn btn-twitter btn-icon" aria-label="twitter"
                                target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-brand-twitter" width="40" height="40"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c-.002 -.249 1.51 -2.772 1.818 -4.013z">
                                    </path>
                                </svg>
                            </a>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="$('#submit_signal').submit()">Enregistrer</button>
                </div>
            </div>

        </div>
    </div>



    <div class="page">
        <div class="sticky-top">
            <header class="navbar navbar-expand-md navbar-light sticky-top d-print-none">
                <div class="container-xl">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbar-menu">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                        <a href="{{ url('/home', []) }}">
                            <img src="{{ url(config('website.app-logo', 'img/logo.svg')) }}"
                                alt="{{ config('website.app-name', 'magasum logo') }}" class="navbar-brand-image p-1">
                        </a>

                    </h1>
                    <div class="navbar-nav flex-row order-md-last">


                        <div class="nav-item me-2">
                            <div class="form-selectgroup">



                            </div>
                        </div>
                        @auth
                            <div class="nav-item me-2">
                                <div class="form-selectgroup">


                                    <a class="form-selectgroup-item" onclick="location.reload();">
                                        <span class="form-selectgroup-label text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-refresh" width="40"
                                                height="40" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                                            </svg>

                                        </span>


                                        <form action="{{ route('toggle.theme') }}" method="post" id="toggle-theme">
                                            @csrf
                                            @method('POST')
                                        </form>


                                    </a>

                                    <a class="form-selectgroup-item" data-bs-toggle="modal"
                                        data-bs-target="#error-signal">
                                        <span class="form-selectgroup-label text-warning">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-alert-triangle" width="40"
                                                height="40" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M12 9v2m0 4v.01"></path>
                                                <path
                                                    d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75">
                                                </path>
                                            </svg>

                                        </span>


                                        <form action="{{ route('toggle.theme') }}" method="post" id="toggle-theme">
                                            @csrf
                                            @method('POST')
                                        </form>


                                    </a>

                                    <a class="form-selectgroup-item" onclick="$('#toggle-theme').submit()">
                                        <span class="form-selectgroup-label">
                                            @if (auth()->user()->theme == 'theme-light')
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-moon" width="40"
                                                    height="40" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z">
                                                    </path>
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <circle cx="12" cy="12" r="4"></circle>
                                                    <path
                                                        d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7">
                                                    </path>
                                                </svg>
                                            @endif

                                        </span>


                                        <form action="{{ route('toggle.theme') }}" method="post" id="toggle-theme">
                                            @csrf
                                            @method('POST')
                                        </form>


                                    </a>
                                </div>
                            </div>

                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                                    aria-label="Open user menu">
                                    <span class="avatar avatar-sm"
                                        style="background-image: url(https://eu.ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }})"></span>
                                    <div class="d-none d-xl-block ps-2">
                                        {{ auth()->user()->name ?? null }}
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <a href="{{ route('profile.show') }}" class="dropdown-item">{{ __('Profile') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}" class="dropdown-item"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Déconnexion') }}
                                        </a>
                                    </form>
                                </div>
                            </div>
                        @endauth

                    </div>
                </div>
            </header>

            @include('layouts.navigation')

        </div>
        <div class="page-wrapper">

            @include('layouts.messages')

            @yield('content')

            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">

                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    &copy; {{ date('Y') }}
                                    <a href="{{ config('app.url') }}"
                                        class="link-secondary">{{ config('app.name') }}</a>
                                </li>
                                <li class="list-inline-item">
                                    Version 0.1 alpha
                                </li>
                                <li class="list-inline-item">

                                    <a href="{{ config('app.link') }}" target="_blank"
                                        class="link-secondary">{{ config('app.dev') }}</a>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    </div>

    <script src="{{ url('assets/js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ url('assets/js/list.min.js') }}"></script>
    <script src="{{ url('assets/js/cdn.min.js') }}" defer></script>
    <script src="{{ url('assets/js/toastr.min.js') }}"></script>
    <script src="{{ url('assets/js/axios.min.js') }}"></script>
    <script src="{{ url('assets/js/dist/context-menu.js') }}"></script>

    <!-- Core plugin JavaScript-->
    @vite('resources/js/app.js')

    <!-- Page level custom scripts -->
    @yield('custom_scripts')

</body>

</html>
