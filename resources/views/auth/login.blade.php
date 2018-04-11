<div class="content-background">
	<div class="uk-section-large">
		<div class="uk-container uk-container-large">
			<div uk-grid class="uk-child-width-1-1@s uk-child-width-2-3@l">
				<div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
				<div class="uk-width-1-1@s uk-width-3-5@l uk-width-1-3@xl">
					<div class="uk-card uk-card-default">
						<div class="uk-card-header">{{ __('Login Page') }}</div>
						<div class="uk-card-body">
							<form method="POST" action="{{ route('login') }}">
								@csrf

								<fieldset class="uk-fieldset">
									<div class="uk-margin">
										<div class="uk-position-relative">
											<span class="uk-form-icon ion-ios-person"></span>
											<input name="email" class="uk-input{{ $errors->has('email') ? ' uk-form-danger' : '' }}"
														 type="email" placeholder="{{ __('E-Mail Address') }}"
														 value="{{ old('email') }}" required autofocus>
											@if ($errors->has('email'))
												<span class="uk-text-meta">
													<strong>{{ $errors->first('email') }}</strong>
                        </span>
											@endif
										</div>
									</div>

									<div class="uk-margin">
										<div class="uk-position-relative">
											<span class="uk-form-icon ion-ios-lock"></span>
											<input name="password" class="uk-input{{ $errors->has('password') ? ' uk-form-danger' : '' }}"
														 type="password" placeholder="{{ __('Password') }}" required>
											@if ($errors->has('password'))
												<span class="uk-text-meta">
													<strong>{{ $errors->first('password') }}</strong>
                        </span>
											@endif
										</div>
									</div>

									<div class="uk-margin">
										<button type="submit" class="uk-button uk-button-primary">
											<span class="ion-ios-arrow-forward"></span>&nbsp; {{ __('Login') }}
										</button>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{{--
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Login') }}</div>

				<div class="card-body">
					<form method="POST" action="{{ route('login') }}">
						@csrf

						<div class="form-group row">
							<label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
											 name="email" value="{{ old('email') }}" required autofocus>

								@if ($errors->has('email'))
									<span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

							<div class="col-md-6">
								<input id="password" type="password"
											 class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

								@if ($errors->has('password'))
									<span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
								@endif
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-6 offset-md-4">
								<div class="checkbox">
									<label>
										<input type="checkbox"
													 name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
									</label>
								</div>
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit" class="btn btn-primary">
									{{ __('Login') }}
								</button>

								<a class="btn btn-link" href="{{ route('password.request') }}">
									{{ __('Forgot Your Password?') }}
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

--}}