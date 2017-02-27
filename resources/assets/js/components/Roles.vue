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
						<td>{{ role.display_name }} <small>{{ role.name }}</small></td>
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
				console.log(this.roles);
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
		}
	}
</script>
