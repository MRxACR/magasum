<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite('resources/sass/app.scss')
</head>
<body class="{{ config('website.theme', 'theme-light') }} border-top-wide border-primary d-flex flex-column">

    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="text-center mb-4">
                <a href="{{ config('app.url') }}" class="navbar-brand navbar-brand-autodark">
                    <img src="{{ url(config('website.app-logo', 'img/logo.svg') ) }}" alt="{{ config('website.app-name', 'Laravel') }}" class="navbar-brand-image">

                </a>
            </div>

            @yield('content')

        </div>
    </div>

    @vite('resources/js/app.js')
</body>
</html>
