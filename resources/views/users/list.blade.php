@extends('layouts.app')

@section('page-header')
	<h1><span class="ion-ios-ionic"></span> {{ __('Users list') }}</h1>
@endsection

@section('content')
	<div class="uk-card uk-card-body uk-card-default uk-animation-fade uk-margin-bottom">
		<table class="uk-table uk-table-striped uk-table-responsive">
			<thead>
				<th>{{ __('Name') }}</th>
				<th>{{ __('Email') }}</th>
				<th></th>
			</thead>
			<tbody>
				@foreach($users as $user)
					<tr>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td class="text-right">
							<button class="uk-button uk-button-default uk-button-small action-button" title="{{ __('modify') }}">
								<span class="ion-ios-create"></span>
							</button>
							<button class="uk-button uk-button-default uk-button-danger uk-button-small action-button" title="{{ __('delete') }}">
								<span class="ion-ios-trash-outline"></span>
							</button>
						</td>
					</tr>
				@endforeach
			<tfoot>
				<tr>
					<td colspan="2">
						<form>
							<div class="uk-inline uk-width-3-4">
								<span class="uk-form-icon" uk-search-icon></span>
								<input class="uk-input" type="text" placeholder="{{ __('Search...') }}">
							</div>
							<button class="uk-button uk-button-default" type="submit">Go</button>
						</form>
					</td>
					<td>
						<form>
							<select class="uk-select">
								<option value="">{{ __('Choose page') }}</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
						</form>
					</td>
				</tr>
			</tfoot>
			</tbody>
		</table>
	</div>
@endsection
