<div class="navbar-expand-md d-print-none">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
            <div class="container-xl">
                <ul class="navbar-nav">

                    <li class="nav-item @if (request()->routeIs('home')) active @endif">
                        <a class="nav-link" href="{{ route('home') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Accueil') }}
                            </span>
                        </a>
                    </li>

                    @can('voir_fournisseurs')
                        <li class="nav-item @if (str_contains(url()->current(), 'fournisseurs')) active @endif">
                            <a class="nav-link" href="{{ url('fournisseurs') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    {{ __('Fournisseurs') }}
                                </span>
                            </a>
                        </li>
                    @endcan

                    @can('voir_commandes')
                        <li class="nav-item @if (str_contains(url()->current(), 'commandes')) active @endif">
                            <a class="nav-link" href="{{ url('commandes') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checklist"
                                        width="40" height="40" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8">
                                        </path>
                                        <path d="M14 19l2 2l4 -4"></path>
                                        <path d="M9 8h4"></path>
                                        <path d="M9 12h2"></path>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    {{ __('Commandes') }}
                                </span>
                            </a>
                        </li>
                    @endcan

                    @can('voir_articles')
                        <li class="nav-item @if (str_contains(url()->current(), 'articles')) active @endif">
                            <a class="nav-link" href="{{ url('articles') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-box-seam"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 3l8 4.5v9l-8 4.5l-8 -4.5v-9l8 -4.5"></path>
                                        <path d="M12 12l8 -4.5"></path>
                                        <path d="M8.2 9.8l7.6 -4.6"></path>
                                        <path d="M12 12v9"></path>
                                        <path d="M12 12l-8 -4.5"></path>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    {{ __('Articles') }}
                                </span>
                            </a>
                        </li>
                    @endcan

                    @can('voir_receptions')
                        <li class="nav-item @if (str_contains(url()->current(), 'receptions')) active @endif">
                            <a class="nav-link" href="{{ url('receptions') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-arrow-big-down-lines" width="40"
                                        height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M15 12h3.586a1 1 0 0 1 .707 1.707l-6.586 6.586a1 1 0 0 1 -1.414 0l-6.586 -6.586a1 1 0 0 1 .707 -1.707h3.586v-3h6v3z">
                                        </path>
                                        <path d="M15 3h-6"></path>
                                        <path d="M15 6h-6"></path>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    {{ __('Réceptions') }}
                                </span>
                            </a>
                        </li>
                    @endcan

                    @can('voir_sorties')
                        <li class="nav-item @if (str_contains(url()->current(), 'sorties')) active @endif">
                            <a class="nav-link" href="{{ url('sorties') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-arrow-big-up-lines" width="40"
                                        height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M9 12h-3.586a1 1 0 0 1 -.707 -1.707l6.586 -6.586a1 1 0 0 1 1.414 0l6.586 6.586a1 1 0 0 1 -.707 1.707h-3.586v3h-6v-3z">
                                        </path>
                                        <path d="M9 21h6"></path>
                                        <path d="M9 18h6"></path>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    {{ __('Sorties') }}
                                </span>
                            </a>
                        </li>
                    @endcan

                    @can('voir_reformes')
                        <li class="nav-item @if (str_contains(url()->current(), 'reformes')) active @endif">
                            <a class="nav-link" href="{{ url('reformes') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-box-off" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M17.765 17.757l-5.765 3.243l-8 -4.5v-9l2.236 -1.258m2.57 -1.445l3.194 -1.797l8 4.5v8.5">
                                        </path>
                                        <path d="M14.561 10.559l5.439 -3.059"></path>
                                        <path d="M12 12v9"></path>
                                        <path d="M12 12l-8 -4.5"></path>
                                        <path d="M3 3l18 18"></path>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    {{ __('Réformes') }}
                                </span>
                            </a>
                        </li>
                    @endcan

                    @can('voir_inventaires')
                        <li class="nav-item @if (str_contains(url()->current(), 'inventaires')) active @endif">
                            <a class="nav-link" href="{{ url('inventaires') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4">
                                        </path>
                                        <line x1="8" y1="9" x2="16" y2="9"></line>
                                        <line x1="8" y1="13" x2="14" y2="13"></line>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    {{ __('Inventaires') }}
                                </span>
                            </a>
                        </li>
                    @endcan
                    
                    {{-- @role('admin') --}}
                    {{-- <li class="nav-item @if (request()->routeIs('users.index')) active @endif">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    {{ __('Users') }}
                                </span>
                            </a>
                        </li> --}}
                    {{-- @endrole --}}



                    {{-- <li class="nav-item @if (request()->routeIs('about')) active @endif">
                        <a class="nav-link" href="{{ route('about') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="12" cy="12" r="9"></circle>
                                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    <polyline points="11 12 12 12 12 16 13 16"></polyline>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Info') }}
                            </span>
                        </a>
                    </li>

                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-list-details" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M13 5h8"></path>
                                    <path d="M13 9h5"></path>
                                    <path d="M13 15h8"></path>
                                    <path d="M13 19h5"></path>
                                    <rect x="3" y="4" width="6" height="6"
                                        rx="1"></rect>
                                    <rect x="3" y="14" width="6" height="6"
                                        rx="1"></rect>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                Submenus
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">
                                Submenu Item #1
                            </a>
                            <div class="dropend">
                                <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                    Submenu Item #2
                                </a>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item">
                                        Subsubmenu Item #1
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        Subsubmenu Item #2
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        Subsubmenu Item #3
                                    </a>
                                </div>
                            </div>
                            <a class="dropdown-item" href="#">
                                Submenu Item #3
                            </a>
                        </div>
                    </li> --}}


                </ul>
            </div>
        </div>
    </div>
</div>
