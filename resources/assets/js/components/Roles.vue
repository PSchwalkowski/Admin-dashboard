<template>
	<div class="panel panel-default">
		<div class="panel-heading"></div>
		<div class="panel-body">
			<table class="table table-striped table-hover" id="roles-list">
				<thead>
					<th>ID</th>
					<th>Name</th>
					<th>Description</th>
					<th width="80px"></th>
				</thead>
				<tbody>
					<tr v-for="(role, index) in roles" v-bind:style="index > 9 ? {display: 'none'} : {}">
						<td>{{ role.id }}</td>
						<td>{{ role.display_name }} <small><em>{{ role.name }}</em></small></td>
						<td>{{ role.description }}</td>
						<td>
							<button type="button" name="role-edit"
								v-bind:value="role.id" v-on:click="setRoleDataForEdit"
								class="btn btn-default btn-hover-primary btn-circle"
								data-toggle="modal" data-target="#roles-edit">
								<i class="fa fa-pencil" aria-hidden="true"></i>
							</button>
							<button type="button"
								v-bind:value="role.id" v-on:click="setRoleIdForDelete"
								class="btn btn-default btn-hover-danger btn-circle"
								data-toggle="modal" data-target="#roles-delete">
								<i class="fa fa-trash-o" aria-hidden="true"></i>
							</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="panel-footer text-center">
			<button type="button" v-on:click="loadMore" name="loadMore"
				class="btn btn-default btn-circle">
				<i class="fa fa-chevron-down" aria-hidden="true"></i>
			</button>
		</div>

		<!-- Modals -->
		<div class="modal fade" id="roles-create" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header modal-success">
            <button type="button" class="close" data-dismiss="modal"
              aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Create new role</h4>
          </div>
          <form role="form" v-on:submit="createRole">
						<div class="modal-body">
							<div class="alert alert-danger" style="display: none;">
								<ul></ul>
							</div>

							<fieldset>
								<div class="form-group has-feedback">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa" aria-hidden="true"></i>
										</div>
										<input type="text" name="name" class="form-control"
											placeholder="Name">
									</div>
								</div>

								<div class="form-group has-feedback">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa" aria-hidden="true"></i>
										</div>
										<input type="text" name="display_name" class="form-control"
											placeholder="Disaply name">
									</div>
								</div>

								<div class="form-group has-feedback">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa" aria-hidden="true"></i>
										</div>
										<textarea name="description" rows="2" class="form-control"
											placeholder="Description"></textarea>
									</div>
								</div>
							</fieldset>
	          </div>
	          <div class="modal-footer">
							<button type="reset"
								class="btn btn-default btn-hover-info btn-circle pull-left">
								<i class="fa fa-refresh" aria-hidden="true"></i></button>
	            <button type="submit"
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
		<div class="modal fade" id="roles-edit" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header modal-primary">
            <button type="button" class="close" data-dismiss="modal"
              aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit role: <span class="role-name"></span></h4>
          </div>
          <form role="form" v-on:submit="editRole">
						<div class="modal-body">
							<div class="alert alert-danger" style="display: none;">
								<ul></ul>
							</div>

							<fieldset>
								<div class="form-hidden">
									<input type="hidden" name="id">
								</div>

								<div class="form-group has-feedback">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa" aria-hidden="true"></i>
										</div>
										<input type="text" name="name" class="form-control"
											placeholder="Name">
									</div>
								</div>

								<div class="form-group has-feedback">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa" aria-hidden="true"></i>
										</div>
										<input type="text" name="display_name" class="form-control"
											placeholder="Display name">
									</div>
								</div>

								<div class="form-group has-feedback">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa" aria-hidden="true"></i>
										</div>
										<textarea name="description" rows="2" class="form-control"
											placeholder="Description"></textarea>
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
		<div class="modal fade" id="roles-delete" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header modal-danger">
            <button type="button" class="close" data-dismiss="modal"
              aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Confimation</h4>
          </div>
          <div class="modal-body">
            <p class="text-danger">Are you really want to delete this role?</p>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal"
							v-on:click="deleteRole" name="deleteRole"
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
				roles: []
			}
		},
		created() {
			this.getRoles().then(roles => {
				this.roles = roles;
			});
		},
		watch: {
			roles: function(roles) {
				var moreButton = $('button[name="loadMore"]');
				if (roles.length <= 10) {
					moreButton.hide();
				} else {
					moreButton.show();
				}
			}
		},
		methods: {

			/**
			 * Get roles from API
			 * @return {Promise} Roles list request
			 */
      getRoles: function() {
        return axios.get('/api/v1/roles').then(res => {
					return res.data;
        });
      },


			/**
			 * Get role record from local roles list
			 * @param  {number} id
			 * @return {object} role record
			 */
			getRole: function(id) {
				let result = this.roles.filter(role => {
					if (role.id == id) return role;
				});

				return result[0];
			},

			/**
			 * Create role
			 * @param  {event} event DOM Event Object
			 * @return {void}
			 */
			createRole: function(event) {
				event.preventDefault();

				const modal = $('#roles-create');
				const errorsList = $('.alert ul', modal);
				const formData = {
					name: $('[name="name"]').val(),
					display_name: $('[name="display_name"]').val(),
					description: $('[name="description"]').val()
				}

				axios.post('/api/v1/roles', formData).then(res => {
					if (res.status == 201) {
						errorsList.parent().slideUp();
						$('.form-group', modal).removeClass('has-error');

						this.roles.push(res.data);
						modal.modal('hide');
						$('form', modal).get(0).reset();
					}
				})
				.catch(error => {
					$('.form-group', modal).removeClass('has-error');
					errorsList.empty();

					$.each(error.response.data, function(field, message) {
						errorsList.append($('<li/>').text(message[0]));
						$('[name="' + field + '"]').closest('.form-group').addClass('has-error');
					});

					errorsList.parent().slideDown('hidden');
				});
			},

			/**
			 * Fill edit form with role data
			 * @param {event} event DOM Event Object
			 * @return {void}
			 */
			setRoleDataForEdit: function(event) {
				  var roleId = $(this.$parent.getTargetButtonFromEvent(event)).val();
					let role = this.getRole(roleId);

					let modal = $('#roles-edit');
					$('.role-name', modal).text(role.display_name)
					$('[name="name"]', modal).val(role.name);
					$('[name="display_name"]', modal).val(role.display_name);
					$('[name="description"]', modal).val(role.description);
					$('[name="id"]', modal).val(role.id);
			},

			/**
			 * Edit role
			 * @param {event} event DOM Event Object
			 * @return {void}
			 */
			editRole: function(event) {
				event.preventDefault();

				let modal = $('#roles-edit');
				let errorsList = $('.alert ul', modal);
				let formData = {
					id: $('[name="id"]', modal).val(),
					name: $('[name="name"]', modal).val(),
					display_name: $('[name="display_name"]', modal).val(),
					description: $('[name="description"]', modal).val()
				}

				axios.put('/api/v1/roles', formData).then(res => {
					if (res.status == 200) {
						errorsList.parent().slideUp();
						$('.form-group', modal).removeClass('has-error');

						let role = this.getRole(res.data.id);

						role.name = res.data.name;
						role.display_name = res.data.display_name;
						role.description = res.data.description;

						modal.modal('hide');
						$('form', modal).get(0).reset();
					}
				})
				.catch(error => {
					$('.form-group', modal).removeClass('has-error');
					errorsList.empty();

					$.each(error.response.data, function(field, message) {
						errorsList.append($('<li/>').text(message[0]));
						$('[name="' + field + '"]').closest('.form-group').addClass('has-error');
					});

					errorsList.parent().slideDown();
				});
			},

			/**
			 * Set role id as value to button
			 * @param {event} event DOM Event Object
			 * @return {void}
			 */
			setRoleIdForDelete: function(event) {
				let id = $(this.$parent.getTargetButtonFromEvent(event)).val();
				$('#roles-delete button[name="deleteRole"]').val(id);
			},

			/**
			 * Delete role
			 * @param {event} event DOM Event Object
			 * @return {void}
			 */
			deleteRole: function(event) {
				var id = parseInt($(this.$parent.getTargetButtonFromEvent(event)).val());

        axios.delete('/api/v1/roles/', {
          data: { id: id }
        })
        .then(res => {
          if (res.status === 204) {
            this.roles = this.roles.filter((role, index) => {
              if (role.id !== id) return role;
            });
          }
        })
        .catch(error => {
          console.error(error);
        });
			},

			/**
			 * Show more list items
			 * @param  {event} event DOM Event Object
			 * @return {void}
			 */
			loadMore: function(event) {
				var hiddenRoles = $('#roles-list tr:hidden');

				hiddenRoles.slice(0, 10).each(function() {
					$(this).fadeIn();
				});

				if (hiddenRoles.length < 10) {
					$(this.$parent.getTargetButtonFromEvent(event)).hide();
				}
			}
		}
	}
</script>
