<!DOCTYPE html>
<html lang="en">
  <head>
    {{ Html::meta('', '', ['charset' => 'utf8']) }}
    {{ Html::meta('', 'IE=edge', ['http-equiv' => 'X-UA-Compatible']) }}
    {{ Html::meta('viewport', 'width=device-width, initial-scale=1') }}

    <!-- CSRF Token -->
    {{ Html::meta('csrf-token', csrf_token()) }}

    <title>{{ config('app.name') }} - login</title>

    <!-- Styles -->
    {{ Html::style(asset('css/vendors/metisMenu.min.css')) }}
    {{ Html::style(asset('css/app.css')) }}


    <!-- Scripts -->
    <script>
      window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
      ]) !!};
    </script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        @yield('content')
      </div>
    </div>

    <!-- Scripts -->
    {{ Html::script(asset('/js/app.js')) }}
  </body>
</html>
