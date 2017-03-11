<!DOCTYPE html>
<html lang="en">
  <head>
    {{ Html::meta('', '', ['charset' => 'utf8']) }}
    {{ Html::meta('', 'IE=edge', ['http-equiv' => 'X-UA-Compatible']) }}
    {{ Html::meta('viewport', 'width=device-width, initial-scale=1') }}

    <!-- CSRF Token -->
    {{ Html::meta('csrf-token', csrf_token()) }}

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    {{ Html::style(asset('css/vendors/metisMenu.min.css')) }}
    {{ Html::style(asset('css/app.css')) }}


    <!-- Scripts -->
    <script>
      window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
      ]) !!};

			var currentUser = {!! json_encode(Auth::user()) !!}
    </script>
  </head>
  <body>
    <div class="app">
      <nav class="navbar navbar-default navbar-static-top" role="navigation">
        @include('partials.nav-top')
        @include('partials.nav-sidebar')
      </nav>

      <div id="page-wrapper">
        @yield('content')
      </div>
    </div>

    <!-- Scripts -->
    {{ Html::script(asset('/js/app.js')) }}
  </body>
</html>
