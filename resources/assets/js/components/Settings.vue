<template>
	<div class="panel panel-default">
		<div class="panel-heading"></div>
		<form role="form" v-on:submit="saveSettings" name="settings">
			<div class="panel-body">
				<fieldset>
					<div class="form-group has-feedback">
						<div class="row">
							<div class="col-xs-12 col-sm-4">
								<label class="control-form">Page title</label>
							</div>
							<div class="col-xs-12 col-sm-8">
								<input type="text" name="title" class="form-control"
									v-bind:value="getSettingsByName('title')">
							</div>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="panel-footer">
				<button type="submit"
					class="btn btn-default btn-hover-success btn-circle">
					<i class="fa fa-check" aria-hidden="true"></i></button>
			</div>
		</form>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				settings: this.$parent.settings,
			}
		},
		created: function() {
			this.getSettings().then(settings => {
				this.settings = settings;
			});
		},
		methods: {

			/**
			 * Get settings from API
			 * @return {Promise}
			 */
			getSettings: function() {
				return axios.get('/api/v1/settings').then(res => {
					return res.data;
				});
			},

			/**
			 * Get settings by settings name
			 * @param  {string} name
			 * @return {any}
			 */
			getSettingsByName: function(name) {
				var result = this.settings.filter(settings => {
					if (settings.name == name) {
						return settings;
					};
				});

				if (!result.length) return;

				return result[0].value;
			},

			/**
			 * Save all settings
			 * @param  {event} event DOM Event Object
			 * @return {void}
			 */
			saveSettings: function(event) {
				event.preventDefault();

				const form = $('form[name="settings"]');
				const formData = {
					title: $('[name="title"]').val()
				}

				axios.put('/api/v1/settings', formData).then(res => {
					if (res.status == 200) {
						this.settings = res.data;
					}
				})
				.catch(error => {
					console.log(error);
				});
			}

		}
	}
</script>
