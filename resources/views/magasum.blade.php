<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <link rel="shortcut icon" href="{{ url(config('website.favicon')) }}" type="image/x-icon">
    <title>{{ config('website.app-name', 'LaravelX') }}</title>

    @vite('resources/sass/app.scss')

    <!-- Custom styles for this Page-->
    @yield('custom_styles')

</head>

<body class="{{ config('website.theme', 'theme-light') }} ">
    <div class="page">
        <div class="sticky-top">

        </div>
        <div class="page-wrapper container-lg p-5">

            <div class="col d-flex align-items-center justify-content-center">
                <img src="{{ url('img/Magasum.png') }}" alt="{{ config('website.app-name', 'LaravelX') }}"
                    class="img-fluid" href="{{ url('/home') }}" id="image">

                @if (Route::has('login'))
                    <div class="my-4">
                        @auth
                            <script>
                                setTimeout(function() {
                                    window.location.href = "{!! url('/home') !!}"; //will redirect to your blog page (an ex: blog.html)
                                }, 2000);
                            </script>
                        @else
                            <script>
                                setTimeout(function() {
                                    window.location.href = "{!! route('login') !!}"; //will redirect to your blog page (an ex: blog.html)
                                }, 2000);
                            </script>
                        @endauth
                    </div>
                @endif
            </div>



        </div>
    </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#image").fadeOut("slow");
            $("#image").fadeIn("slow");
        });
    </script>

    <!-- Core plugin JavaScript-->
    @vite('resources/js/app.js')

    <!-- Page level custom scripts -->
    @yield('custom_scripts')

</body>

</html>
