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
    </script>
  </head>
  <body>
    <div id="wrapper">
      <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
          <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
              <span class="sr-only">Toggle Navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
              {{ config('app.name', 'Laravel') }}
            </a>
          </div>

          <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
              &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
              <!-- Authentication Links -->
              @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
              @else
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <ul class="dropdown-menu" role="menu">
                    <li>
                      <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                      </a>

                      <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                      </form>
                    </li>
                  </ul>
                </li>
              @endif
            </ul>
          </div>
        </div>
      </nav>

      @yield('content')
    </div>

    <!-- Scripts -->
    {{ Html::script(asset('/js/app.js')) }}
  </body>
</html>
