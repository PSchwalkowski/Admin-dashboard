@extends('layouts.app')

@section('content')
  @include('components.page-header', ['title' => 'Dashboard'])

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <i class="fa fa-comments fa-5x"></i>
            </div>
            <div class="col-xs-9 text-right">
              <div class="huge">26</div>
              <div>New Comments!</div>
            </div>
          </div>
        </div>
        <a href="#">
          <div class="panel-footer clearfix">
            <span class="pull-left">View Details</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          </div>
        </a>
      </div>
    </div>
  </div>
@endsection
