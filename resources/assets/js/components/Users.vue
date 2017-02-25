<template>
	<div class="panel panel-default">
		<div class="panel-heading"></div>
		<div class="panel-body">
			<table class="table table-striped table-hover" id="users-list">
	      <thead>
	        <th>ID</th>
	        <th>Name</th>
	        <th>E-mail</th>
	        <th width="80px"></th>
	      </thead>
	      <tbody>
	        <tr v-for="(user, index) in users" v-bind:style="index > 9 ? {display: 'none'} : {}">
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
		</div>
		<div class="panel-footer text-center">
			<button type="button" v-on:click="loadMore"
				class="btn btn-default btn-circle">
				<i class="fa fa-chevron-down" aria-hidden="true"></i>
			</button>
		</div>

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
    <div class="modal fade" id="users-create" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"
              aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Create new user</h4>
          </div>
          <form role="form" action="" v-on:submit="createUser">
						<div class="modal-body">
							<div class="alert alert-danger hidden">
								<ul></ul>
							</div>

							<fieldset>
								<div class="form-group has-feedback">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-user-o" aria-hidden="true"></i>
										</div>
										<input type="text" name="name" class="form-control"
											placeholder="Username">
									</div>
								</div>

								<div class="form-group has-feedback">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-envelope-o" aria-hidden="true"></i>
										</div>
										<input type="email" name="email" class="form-control"
											placeholder="E-Mail">
									</div>
								</div>

								<div class="form-group has-feedback">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-lock" aria-hidden="true"></i>
										</div>
										<input type="password" name="password" class="form-control"
											placeholder="E-Mail">
									</div>
								</div>
							</fieldset>
	          </div>
	          <div class="modal-footer">
						<button type="reset"
							class="btn btn-default btn-hover-info btn-circle pull-left">
							<i class="fa fa-refresh" aria-hidden="true"></i></button>
	            <button type="submit" name="createUser"
	              class="btn btn-default btn-hover-success btn-circle">
	              <i class="fa fa-check" aria-hidden="true"></i></button>
	            <button type="button" data-dismiss="modal"
	              class="btn btn-default btn-hover-warning btn-circle">
	              <i class="fa fa-times" aria-hidden="true"></i></button>
	          </div>
          </form>
        </div>
      </div>
    </div>
	</div>

</template>

<script>
  export default {
    data() {
      return {
        users: this.$parent.users,
        user: this.$parent.user
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
        return axios.get('/api/v1/users').then(res => {
					return res.data;
        });
      },

			/**
			 * Create user
			 * @param  {event} event DOM Event Object
			 * @return	{void}
			 */
			createUser: function(event) {
				event.preventDefault();

				const modal = $('#users-create');
				const errorsList = $('.alert ul', modal);
				const formData = {
					name: $('[name="name"]').val(),
					email: $('[name="email"]').val(),
					password: $('[name="password"]').val()
				}

				axios.post('/api/v1/users', formData).then(res => {
					if (res.status == 201) {
						errorsList.parent().addClass('hidden');
						$('.form-group', modal).removeClass('has-error');

						this.users.push(res.data);
						modal.modal('hide');
						$('form', modal).get(0).reset();
					}
				})
				.catch(error => {
					$('.form-group', modal).removeClass('has-error');
					errorsList.parent().removeClass('hidden');
					errorsList.empty();

					$.each(error.response.data, function(field, message) {
						errorsList.append($('<li/>').text(message[0]));
						$('[name="' + field + '"]').closest('.form-group').addClass('has-error');
					});
				});
			},

			/**
			 * Set user id as value to button deleteUser button
			 * @param {event} event DOM Event Object
			 * @return {void}
			 */
      setUserIdForDelete: function(event) {
        var id = $(this.$parent.getTargetButtonFromEvent(event)).val();
        $('#users-delete button[name="deleteUser"]').val(id);
      },

			/**
			 * Delete user
			 * @param {event} event DOM Event Object
			 * @return {void}
			 */
      deleteUser: function(event) {
        var id = parseInt($(this.$parent.getTargetButtonFromEvent(event)).val());
				if (id == this.user.id) {
					alert('You can\'t remove your own account ;)');
					return;
				}

				return;
        axios.delete('/api/v1/users/', {
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
      },

			loadMore: function(event) {
				var hiddenUsers = $('#users-list tr:hidden');

				hiddenUsers.slice(0, 10).each(function() {
					$(this).fadeIn();
				});

				if (hiddenUsers.length < 10) {
					$(this.$parent.getTargetButtonFromEvent(event)).hide();
				}
			}
    }
  }
</script>
