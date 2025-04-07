<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Informe de Producción de Líneas Personales Proyectat">
        <meta name="keywords" content="Informes, producción Proyectat">
        <meta name="author" content="JGMC Digital">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Proyectat - @yield('title')</title>
        {{-- @yield('css') --}}

        {{-- ========================================= --}}

        {{-- Favicon --}}
        <link rel="shortcut icon" href="{{asset('img/favicon.png')}}" type="image/x-icon">

        {{-- ========================================= --}}
        
        <!-- Bootstrap CSS 5.3.2 -->
        <!-- Se puede indicar la versión al final del nombre de la carpeta pero en los archivos debe ir al ppio -->
        <link rel="stylesheet" href="{{asset('bootstrap5.3.2/5.3.2_bootstrap.min.css')}}" >

        {{-- ========================================= --}}

        <!-- FontAwesome 6 (CDN) -->
        <link rel="stylesheet" href="{{asset('font_awesome6.7.2/css/all.min.css')}}"> {{-- Necesario para el ícono del logout --}}

        <!-- Styles Locales -->
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">

        {{-- ========================================= --}}

        {{-- Sweetalert2 (No necesita jquery para funcionar) --}}
        <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.min.css')}}">

        {{-- ========================================= --}}

        <!--  jQuery -->
        {{-- Aquí en el head funciona para todo, ubicado en el body, no funciona el spinner de los modales --}}
        <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>

        @yield('css')
    </head>

    {{-- =========================================================================== --}}
    {{-- =========================================================================== --}}

    <body>
        <div class="container-fluid p-0 position-relative">
            @php
                $rutas_excluidas = ['/', 'login', 'logout', 'cambiar_clave', 'recuperar_clave_link', 'recuperar_clave'];
                $ruta_actual = Request::path();
                $mostrarComponentes = Auth::check() || !in_array($ruta_actual, $rutas_excluidas);
            @endphp

            <div class="wrapper">
                {{-- Topbar solo si aplica --}}
                @if ($mostrarComponentes)
                    @include('layouts.topbar')
                @endif
        
                <div class="content @yield('content-class')">
                    @yield('content')
                </div>
        
                {{-- Footer solo si aplica --}}
                @if ($mostrarComponentes)
                    @include('layouts.footer')
                @endif
            </div>
        </div>

        {{-- ======================================================== --}}
        {{-- ======================================================== --}}

        <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('DataTables/Buttons-2.3.4/js/buttons.html5.min.js') }}"></script>

        {{-- ======================================================== --}}
        {{-- ======================================================== --}}

        <!-- Bootstrap JS 5.3.2, después, ya que puede depender de jQuery en algunos casos -->
        <!-- Se puede indicar la versión en la carpeta, en los archivos debe ir al ppio -->
        <script src="{{asset('bootstrap5.3.2/5.3.2_bootstrap.bundle.min.js')}}"></script> {{-- Bundle ya tiene popper --}}

        {{-- Es complemento de Bundle para las tabs --}}
        {{-- <script src="{{asset('bootstrap5.3.2/4.6.2_bootstrap.min.js')}}"></script> --}}
        
        {{-- ========================================================================= --}}

        {{-- Sweetalert (No necesita jquery para funcionar) --}}
        <script src="{{asset('js/sweetalert2.all.js')}}"></script>
        <script src="{{asset('js/sweetalert2.min.js')}}"></script>

        {{-- ========================================================================= --}}
        
        <!-- SCRIPTS -->
        @include('sweetalert::alert')

        @yield('scripts')
    </body>
</html>
