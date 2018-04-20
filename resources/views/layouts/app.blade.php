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
				@if(Auth::check())
					<div class="uk-navbar-left">
						<a class="uk-navbar-toggle" uk-toggle="target: #app; cls: sidebar-hidden" uk-navbar-toggle-icon></a>
						<a href="{{ route('home') }}" class="uk-navbar-item uk-logo">{{ config('app.name', 'Dashboard') }}</a>
					</div>
					<div class="uk-navbar-right uk-light">
						<ul class="uk-navbar-nav">
							<li class="uk-active">
								<a href="#">{{ Auth::user()->name }} &nbsp;<span class="ion-ios-arrow-down"></span></a>
								<div uk-dropdown="pos: bottom-right; mode: click; offset: -17;">
									<ul class="uk-nav uk-navbar-dropdown-nav">
										<li class="uk-nav-header">Options</li>
										<li><a href="#">Edit Profile</a></li>
										<li class="uk-nav-header">Actions</li>
										<li>
											<a href="{{ route('logout') }}" onclick="event.preventDefault();
																										 document.getElementById('logout-form').submit();">
												{{ __('Logout') }}
											</a>
											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												@csrf
											</form>
										</li>
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
		@yield('content')
	@else
		<div id="sidebar" class="sidebar-left uk-background-default">
			<div class="uk-align-center">
				<div class="user-profile-details">
					<img width="100" class="uk-border-circle" src="http://via.placeholder.com/450x450"/>
					<div class="uk-margin-top"></div>
					<div class="uk-text-truncate"><strong>{{ Auth::user()->name }}</strong></div>
				</div>
				<br/>
			</div>
			<ul class="uk-nav uk-nav-default">
				<li class="uk-nav-header">
					<span class="ion-ios-settings"></span> Configuration
				</li>
				<li><a href="{{ route('users.list') }}">Users</a></li>
			</ul>
		</div>

		<div class="main-content-container">
			<div class="uk-section-small uk-section-default">
				<div class="uk-container uk-container-large">
					@yield('page-header')
				</div>
			</div>
			<div class="uk-section-small">
				<div class="uk-container uk-container-large">
					@yield('content')
				</div>
			</div>
		</div>
	@endguest
</div>
</body>
</html>
