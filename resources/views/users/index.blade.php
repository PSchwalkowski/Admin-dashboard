@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-xs-12">
      <h1 class="page-header">Users <a href="{{ url('/users/create') }}"
        class="btn btn-default btn-hover-success btn-circle pull-right">
        <i class="fa fa-plus" aria-hidden="true"></i>
      </a></h1>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading"></div>
        <div class="panel-body">
          <table class="table table-striped" id="users-table">
            <thead>
              <th>ID</th>
              <th>Name</th>
              <th>E-mail</th>
              <th width="80px"></th>
            </thead>
            <tbody>
              <tr v-for="user in users">
                <td>@{{ user.id }}</td>
                <td>@{{ user.name }}</td>
                <td>@{{ user.email }}</td>
                <td>
                  <button type="button" name="user-edit" v-bind:value="user.id"
                    class="btn btn-default btn-hover-primary btn-circle"
                    data-toggle="modal" data-target="#users-edit">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </button>
                  <button type="button" name="user-delete" v-bind:value="user.id"
                    v-on:click="showDeleteUserModal"
                    class="btn btn-default btn-hover-danger btn-circle"
                    data-toggle="modal" data-target="#users-delete">
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="panel-footer"></div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="users-delete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"
            aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Confimation</h4>
        </div>
        <div class="modal-body">
          <p class="text-danger">Are you really want to delete this user?</p>
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal"
            v-on:click="deleteUser" name="deleteUser"
            class="btn btn-default btn-hover-danger btn-circle">
            <i class="fa fa-check" aria-hidden="true"></i></button>
          <button type="button" data-dismiss="modal"
            class="btn btn-default btn-hover-info btn-circle">
            <i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
  </div>
@endsection
