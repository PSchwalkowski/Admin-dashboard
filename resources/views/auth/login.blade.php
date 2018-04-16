@extends('layouts.app')

@section('content')
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
										</div>
										@if ($errors->has('email'))
											<span class="uk-text-meta">
													<strong>{{ $errors->first('email') }}</strong>
                        </span>
										@endif
									</div>

									<div class="uk-margin">
										<div class="uk-position-relative">
											<span class="uk-form-icon ion-ios-lock"></span>
											<input name="password" class="uk-input{{ $errors->has('password') ? ' uk-form-danger' : '' }}"
														 type="password" placeholder="{{ __('Password') }}" required>
										</div>
										@if ($errors->has('password'))
											<span class="uk-text-meta">
													<strong>{{ $errors->first('password') }}</strong>
                        </span>
										@endif
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
@endsection