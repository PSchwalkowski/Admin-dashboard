@extends('layouts.app')

@section('content')
  <div class="row page-header">
  	<div class="col-xs-12">
  	  <h1>Users <button type="button" name="users-create"
  	    class="btn btn-default btn-hover-success btn-circle pull-right"
  	    data-toggle="modal" data-target="#users-create">
  	    <i class="fa fa-plus" aria-hidden="true"></i>
  	  </button></h1>
  	</div>
  </div>

  <div class="row">
    <div class="col-xs-12">
			<users></users>
    </div>
  </div>
@endsection
