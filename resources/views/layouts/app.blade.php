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
    <div id="wrapper" class="app">

      <nav class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">{{ config('app.name') }}</a>
        </div><!-- /.navbar-header -->

        @if (!Auth::guest())
          <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
              </a>
              <ul class="dropdown-menu dropdown-messages">
                <li><a href="#"><div>
                  <strong>John Smith</strong>
                  <span class="pull-right text-muted"><em>Yesterday</em></span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</p>
                </div></a></li>
                <li class="divider"></li>
                <li><a class="text-center" href="#">
                  <strong>Read all messages</strong>
                  <i class="fa fa-angle-right"></i>
                </a></li>
              </ul><!-- /.dropdown-messages -->
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
              </a>
              <ul class="dropdown-menu dropdown-tasks">
                <li><a href="#"><div>
                  <p>
                    <strong>Task 1</strong>
                    <span class="pull-right text-muted">40% Complete</span>
                  </p>
                  <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                      <span class="sr-only">40% Complete (success)</span>
                    </div>
                  </div>
                </div></a></li>
                <li class="divider"></li>
                <li><a class="text-center" href="#">
                  <strong>See all tasks</strong>
                  <i class="fa fa-angle-right"></i>
                </a></li>
              </ul><!-- /.dropdown-tasks -->
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
              </a>
              <ul class="dropdown-menu dropdown-alerts">
                <li><a href="#"><div>
                  <i class="fa fa-comment fa-fw"></i> New Comment
                  <span class="pull-right text-muted small">4 minutes ago</span>
                </div></a></li>
                <li class="divider"></li>
                <li><a href="#"><div>
                  <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                  <span class="pull-right text-muted small">12 minutes ago</span>
                </div></a></li>
                <li class="divider"></li>
                <li><a class="text-center" href="#">
                  <strong>See all alerts</strong>
                  <i class="fa fa-angle-right"></i>
                </a></li>
              </ul><!-- /.dropdown-alerts -->
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
              </a>
              <ul class="dropdown-menu dropdown-user">
                <li><a href="#">
                  <i class="fa fa-user fa-fw"></i> User Profile
                </a></li>
                <li><a href="#">
                  <i class="fa fa-cog fa-fw"></i> Settings
                </a></li>
                <li class="divider"></li>
                <li>
                  <a href="{{ url('/logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out fa-fw"></i> Logout
                  </a>

                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </li>
              </ul><!-- /.dropdown-user -->
            </li>
          </ul><!-- /.navbar-top-links -->
          <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
              <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                  <div class="input-group custom-search-form">
                    {{ Form::text('search', null, [
                      'class' => 'form-control',
                      'placeholder' => 'Search...'
                    ])}}
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-default">
                        <i class="fa fa-search"></i>
                      </button>
                    </span>
                  </div><!-- /.input-group -->
                </li>
                <li><a href="/">
                  <i class="fa fa-dashboard fa-fw"></i> Dashboard
                </a></li>
                <li><a href="{{ url('users')}}">
                  <i class="fa fa-users fa-fw"></i> Users
                </a></li>
                {{--
                  <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts
                      <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                      <li><a href="#">Flot Charts</a></li>
                      <li><a href="#">Morris.js Charts</a></li>
                    </ul>
                  </li>
                --}}
              </ul>
            </div>
          </div>
        @endif
      </nav>

      <div id="page-wrapper">
        @yield('content')
      </div>
    </div>

    <!-- Scripts -->
    {{ Html::script(asset('/js/app.js')) }}
  </body>
</html>
