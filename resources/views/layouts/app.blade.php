<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@7.3.1/themes/algolia-min.css" integrity="sha256-HB49n/BZjuqiCtQQf49OdZn63XuKFaxcIHWf0HNKte8=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1/leaflet.css" />

    <!-- cdn algolia -->
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
    <script src="https://cdn.jsdelivr.net/leaflet/1/leaflet.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/algoliasearch@4.0.0/dist/algoliasearch-lite.umd.js" integrity="sha256-MfeKq2Aw9VAkaE9Caes2NOxQf6vUa8Av0JqcUXUGkd0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4.0.0/dist/instantsearch.production.min.js" integrity="sha256-6S7q0JJs/Kx4kb/fv0oMjS855QTz5Rc2hh9AkIUjUsk=" crossorigin="anonymous"></script> --}}
</head>
<body>

    <div id="app">
        <!-- HEADER -->
        <header>
          @include('partials.header')
        </header>

        <!-- MAIN -->
        <main class="py-4">
            @yield('content')
        </main>

        <!-- FOOTER -->
        <footer>
          @include('partials.footer')
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
