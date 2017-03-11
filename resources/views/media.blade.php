@extends('layouts.app')

@section('content')
  <div class="row page-header">
		<div class="col-xs-12">
			<h1>Media library <button type="button" name="media-create"
				class="btn btn-default btn-hover-success btn-circle pull-right"
				data-toggle="modal" data-target="#media-create">
				<i class="fa fa-upload" aria-hidden="true"></i>
			</button></h1>
		</div>
  </div>

  <div class="row">
    <div class="col-xs-12">
			<media></media>
    </div>
  </div>
@endsection
