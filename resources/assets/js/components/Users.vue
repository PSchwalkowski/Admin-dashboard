<template>
  <div id="users">

    <table class="table table-striped table-hover">
      <thead>
        <th>ID</th>
        <th>Name</th>
        <th>E-mail</th>
        <th width="80px"></th>
      </thead>
      <tbody>
        <tr v-for="user in users">
          <td>{{ user.id }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>
            <button type="button" name="user-edit" v-bind:value="user.id"
              class="btn btn-default btn-hover-primary btn-circle"
              data-toggle="modal" data-target="#users-edit">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </button>
            <button type="button" name="user-delete"
              v-bind:value="user.id" v-on:click="setUserIdForDelete"
              class="btn btn-default btn-hover-danger btn-circle"
              data-toggle="modal" data-target="#users-delete">
              <i class="fa fa-trash-o" aria-hidden="true"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Modals -->
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
              name="deleteUser" v-on:click="deleteUser"
              class="btn btn-default btn-hover-danger btn-circle">
              <i class="fa fa-check" aria-hidden="true"></i></button>
            <button type="button" data-dismiss="modal"
              class="btn btn-default btn-hover-info btn-circle">
              <i class="fa fa-times" aria-hidden="true"></i></button>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
  export default {
    data() {
      return {
        users: this.users || []
      }
    },
    created() {
			this.getUsers().then(users => {
				this.users = users;
			});
    },
    methods: {
			/**
			 * Get users from API
			 * @return {Promise} Users list request
			 */
      getUsers: function() {
        return axios.get('/api/users').then(res => {
					return res.data;
        });
      },
      setUserIdForDelete: function(event) {
        var id = $(this.$parent.getTargetButtonFromEvent(event)).val();
        $('#users-delete button[name="deleteUser"]').val(id);
      },
      deleteUser: function(event) {
        var id = parseInt($(this.$parent.getTargetButtonFromEvent(event)).val());

        axios.delete('/api/users/', {
          data: { id: id }
        })
        .then(res => {
          if (res.status === 204) {
            this.users = this.users.filter((user, index) => {
              if (user.id !== id) return user;
            });
          }
        })
        .catch(error => {
          console.error(error);
        });
      }
    }
  }
</script>
