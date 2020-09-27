<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@7.3.1/themes/algolia-min.css" integrity="sha256-HB49n/BZjuqiCtQQf49OdZn63XuKFaxcIHWf0HNKte8=" crossorigin="anonymous">

    <!-- cdn algolia -->
    <script src="https://cdn.jsdelivr.net/npm/algoliasearch@4.0.0/dist/algoliasearch-lite.umd.js" integrity="sha256-MfeKq2Aw9VAkaE9Caes2NOxQf6vUa8Av0JqcUXUGkd0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4.0.0/dist/instantsearch.production.min.js" integrity="sha256-6S7q0JJs/Kx4kb/fv0oMjS855QTz5Rc2hh9AkIUjUsk=" crossorigin="anonymous"></script>
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

    <script type="text/javascript">
      const searchClient = algoliasearch(
        'SJ7SUHX87E',
        '2861bf463d87e9c46f95f655787cf1fb'
       );

      const search = instantsearch({
        indexName: 'apartments',
        searchClient,
      });

      search.addWidgets([
        instantsearch.widgets.searchBox({
          container: '#searchbox',
          placeholder: 'Cerca appartamento',
        }),

        instantsearch.widgets.hits({
          container: '#hits',
          templates: {
            item: `
              <article>
                <p>@{{ city }}</p>
              </article>
            `
          }
        })
      ]);

      search.start();

    </script>
</body>
</html>
