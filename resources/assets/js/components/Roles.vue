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
					<tr v-for="(role, index) in roles" v-bind:style="index > 9 ? {display: 'none'} : {}">
						<td>{{ role.id }}</td>
						<td>{{ role.name }}</td>
						<td>{{ role.email }}</td>
						<td>
							<button type="button" name="user-edit"
								v-bind:value="role.id"
								class="btn btn-default btn-hover-primary btn-circle"
								data-toggle="modal" data-target="#users-edit">
								<i class="fa fa-pencil" aria-hidden="true"></i>
							</button>
							<button type="button" name="user-delete"
								v-bind:value="role.id"
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
			
		},
		methods: {

		}
	}
</script>
