<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Dashboard') }} - @yield('page-title', 'Home')</title>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
	<div class="uk-navbar-container tm-navbar-container uk-active uk-navbar-blue">
		<div class="uk-container uk-container-expand">
			<nav uk-navbar>
				<div class="uk-navbar-left">
					<a class="uk-navbar-toggle" uk-toggle="target: #sidebar; cls: sidebar-hidden" uk-navbar-toggle-icon></a>
					<a href="#" class="uk-navbar-item uk-logo">{{ config('app.name', 'Dashboard') }}</a>
				</div>
				@if(Auth::check())
				<div class="uk-navbar-right uk-light">
					<ul class="uk-navbar-nav">
						<li class="uk-active">
							<a href="#">{{-- Auth::user()->name --}}Username &nbsp;<span class="ion-ios-arrow-down"></span></a>
							<div uk-dropdown="pos: bottom-right; mode: click; offset: -17;">
								<ul class="uk-nav uk-navbar-dropdown-nav">
									<li class="uk-nav-header">Options</li>
									<li><a href="#">Edit Profile</a></li>
									<li class="uk-nav-header">Actions</li>
									<li><a href="#">Logout</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
				@endif
			</nav>
		</div>
	</div>
	@guest
		@include('auth.login')
	@else
	<div id="sidebar" class="sidebar-left uk-background-default">
		<div class="uk-align-center">
			<div class="user-profile-details">
				<img width="100" class="uk-border-circle" src="http://via.placeholder.com/450x450" />
				<div class="uk-margin-top"></div>
				<div class="uk-text-truncate"><strong>Lorem ipsum</strong></div>
				<div class="uk-text-truncate">lorem@ipsum.com</div>
			</div>
			<br />
		</div>
		<ul class="uk-nav uk-nav-default">
			<li class="uk-nav-header">
				UI Elements
			</li>
			<li><a href="#">Buttons</a></li>
			<li><a href="#">Components</a></li>
			<li><a href="#">Tables</a></li>
		</ul>
	</div>

	<div class="main-content-container">
		<div class="uk-section-small uk-section-default">
			<div class="uk-container uk-container-large">
				{{--@yield('page-header')--}}
				<h1><span class="ion-ios-ionic"></span> @yield('page-title', 'Home')</h1>
				@yield('page-description')
			</div>
		</div>
		<div class="uk-section-small">
			<div class="uk-container uk-container-large">
				@yield('content')
			</div>
		</div>
	</div>
	@endguest

	{{--
	<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
		<div class="container">
			<a class="navbar-brand" href="{{ url('/') }}">
				{{ config('app.name', 'Laravel') }}
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
							aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<!-- Left Side Of Navbar -->
				<ul class="navbar-nav mr-auto">

				</ul>

				<!-- Right Side Of Navbar -->
				<ul class="navbar-nav ml-auto">
					<!-- Authentication Links -->
					@guest
						<li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
						<li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
					@else
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
								 aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('logout') }}"
									 onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</div>
						</li>
					@endguest
				</ul>
			</div>
		</div>
	</nav>

	<main class="py-4">
		@yield('content')
	</main>
	--}}
</div>
</body>
</html>
