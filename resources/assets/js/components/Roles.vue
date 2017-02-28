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
								v-bind:value="role.id"
								class="btn btn-default btn-hover-primary btn-circle"
								data-toggle="modal" data-target="#roles-edit">
								<i class="fa fa-pencil" aria-hidden="true"></i>
							</button>
							<button type="button" name="role-delete"
								v-bind:value="role.id"
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
			<button type="button" class="btn btn-default btn-circle">
				<i class="fa fa-chevron-down" aria-hidden="true"></i>
			</button>
		</div>

		<!-- Modals -->
		<div class="modal fade" id="roles-create" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"
              aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Create new role</h4>
          </div>
          <form role="form" v-on:submit="createRole">
						<div class="modal-body">
							<div class="alert alert-danger hidden">
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
											placeholder="Description"
										></textarea>
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
				roles: []
			}
		},
		created() {
			this.getRoles().then(roles => {
				this.roles = roles;
			});
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
						errorsList.parent().addClass('hidden');
						$('.form-group', modal).removeClass('has-error');

						this.roles.push(res.data);
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
			}
		}
	}
</script>
