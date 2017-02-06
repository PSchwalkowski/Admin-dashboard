@extends('layouts.app')

@section('content')
  @include('components.page-header', ['title' => '&nbsp;'])

  <div class="row">
    <div class="col-xs-12">

      {{ Form::open(['action' => 'UserController@postCreate']) }}
        <div class="panel panel-default">
          <div class="panel-heading">Create user</div>
          <div class="panel-body">

            @include('components.messages')

            <fieldset>
              <div class="form-group">
                {{ Form::text('name', old('name'), [
                  'class' => 'form-control',
                  'placeholder' => 'Name'
                  ]) }}
              </div>
              <div class="form-group">
                {{ Form::email('email', old('email'), [
                  'class' => 'form-control',
                  'placeholder' => 'E-mail'
                  ]) }}
              </div>
              <div class="form-group">
                {{ Form::password('password', [
                  'class' => 'form-control',
                  'placeholder' => 'Password'
                  ]) }}
              </div>
            </fieldset>
          </div>
          <div class="panel-footer clearfix">
            <button type="submit" name="submit" class="btn btn-default btn-circle">
              <i class="fa fa-check" aria-hidden="true"></i>
            </button>
            <button type="reset" name="submit" class="btn btn-default btn-circle">
              <i class="fa fa-times" aria-hidden="true"></i>
            </button>
            <a href="{{ url('/users') }}" class="btn btn-default btn-circle pull-right">
              <i class="fa fa-undo" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      {{ Form::close() }}

    </div>
  </div>
@endsection
