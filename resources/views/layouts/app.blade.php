<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @inject('side_menu', 'App\Services\ReadPermissions')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        {{-- CSS Font-Awesome --}}
        <link href="{{ asset('fontawesome/css/fontawesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('fontawesome/css/brands.min.css') }}" rel="stylesheet">
        <link href="{{ asset('fontawesome/css/solid.min.css') }}" rel="stylesheet">

        {{-- Styles Bootstrap --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        {{-- Global styles for menus --}}
        <link href="{{ asset('css/menus.css') }}" rel="stylesheet">

        {{-- Styles for a specific theme --}}
        @auth
            <link href="{{ asset('css/themes/'.auth()->user()->theme.'.css') }}" rel="stylesheet">
        @else
            <link href="{{ asset('css/themes/standard.css') }}" rel="stylesheet">
        @endauth

        {{-- Styles for the main area --}}
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">

        {{-- Styles for a specific page --}}
        @yield('head_css')

        {{-- jQuery y Javascript Bootstrap --}}
        <script language="javascript" src="{{ asset('js/app.js') }}"></script>

        {{-- Javascript for a specific page --}}
        @yield('head_js')
    </head>
    <body>
        <div id="app">
            @include ('commons.navbar')
            @include('commons.side_menu_bar')
            <main class="global_main">
                @yield('content')
            </main>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <script language="javascript">
            // PREPARACIÓN PARA PETICIONES AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /* MECANISMO PARA EL MENÚ LATERAL */
            function slideMenu() {
                var activeState = $("#menu-container").hasClass("active");
                $("#menu-container").animate({left: activeState ? "0%" : "-100%"}, 400);
            }

            $('#logout_link').on('click', function (e) {
                e.preventDefault();
                $('#logout-form').submit();
            });

            $("#sideMenuButtonWrapper").click(function(e) {
                e.stopPropagation();
                e.preventDefault();
                $("#sideMenuButton").toggleClass("open");
                $("#menu-container").toggleClass("active");
                slideMenu();
            });

            $(".menu-list").find(".accordion-toggle").click(function(e) {
                e.preventDefault();
                $(this).next().toggleClass("open").slideToggle("fast");
                $(this).toggleClass("active-tab").find(".menu-link").toggleClass("active");
                $(".menu-list .accordion-content").not($(this).next()).slideUp("fast").removeClass("open");
                $(".menu-list .accordion-toggle").not($(this)).removeClass("active-tab").find(".menu-link").removeClass("active");
            });

            /* PARA PULSACIONES DE VER CLAVE, SI EXISTEN EN LA VISTA
            Y ESTÁ DISPONIBLE POR CONFIGURACIÓN
            LA CLASE pw-icon QUEDA RESERVADA PARA LOS COMPONENTES DE CLAVE EN CASO DE SER VISIBLES BAJO DEMANDA. */
            $('.pw-icon').on('click', function(e) {
                e.preventDefault();
                var component = $(this).data('id');
                if ($(this).find('i').hasClass('fa-eye')) {
                    $('#' + component).attr('type', 'text');
                } else {
                    $('#' + component).attr('type', 'password');
                }
                $(this).find('i').toggleClass('fa-eye').toggleClass('fa-eye-slash');
            });
        </script>
        @yield ('foot_js')
    </body>
</html>
