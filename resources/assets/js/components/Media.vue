<template>
	<div class="panel panel-default">
		<div class="panel-heading"></div>
		<div class="panel-body"></div>
		<div class="panel-footer"></div>

		<!-- Modals -->
		<div class="modal fade" id="media-create" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header modal-success">
            <button type="button" class="close" data-dismiss="modal"
              aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Click or drag and drop files on area.</h4>
          </div>
          <form role="form" enctype="multipart/form-data" v-on:submit="uploadFiles">
						<div class="modal-body">
							<div class="alert alert-danger hidden">
								<ul></ul>
							</div>

							<fieldset>
								<div class="form-group has-feedback media-upload-area"
									v-on:dragover="addDragClass" v-on:dragleave="removeDragClass">
									<input type="file" name="files" multiple="multiple"
										class="form-control" v-on:change="processUploadFilesSelect">
								</div>

								<div class="media-upload-files-list">
								</div>
							</fieldset>
	          </div>
	          <div class="modal-footer">
							<button type="reset" v-on:click="resetUploadForm"
								class="btn btn-default btn-hover-info btn-circle pull-left">
								<i class="fa fa-refresh" aria-hidden="true"></i></button>
	            <button type="submit"
	              class="btn btn-default btn-hover-success btn-circle">
	              <i class="fa fa-upload" aria-hidden="true"></i></button>
	            <button type="button" data-dismiss="modal"
	              class="btn btn-default btn-circle">
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
				files: this.$parent.files
			}
		},
		methods: {
			addDragClass: function(event) {
				$(event.target).parent().addClass('dragover');
			},

			removeDragClass: function(event) {
				$(event.target).parent().removeClass('dragover');
			},

			resetUploadForm: function() {
				const modal = $('#media-create');
				const filesList = $('.media-upload-files-list', modal);

				$('.progress', filesList).slideUp();
				setTimeout(function () {
					filesList.empty();
				}, 500);
			},

			processUploadFilesSelect: function(event) {
				const files = event.target.files;
				const modal = $('#media-create');
				const filesList = $('.media-upload-files-list', modal);

				filesList.empty();

				_.each(files, function(file, index) {
					var progressBar = '<div class="progress" id="media-' + index +
						'" style="display:none;">' +
						'<div class="progress-bar progress-bar-striped active" ' +
						'role="progressbar" aria-valuenow="0" ' +
						'aria-valuemin="0" aria-valuemax="100">' +
    					'<span>' + file.name + '</span>' +
					'</div>';
					filesList.append(progressBar).find('.progress').slideDown();
				});
			},

			uploadFiles: function(event) {
				event.preventDefault();

				const modal = $('#media-create');
				const files = $('[type="file"]', modal).get(0).files;

				if (files.length < 1) {
					const uploadArea = $('.media-upload-area', modal);

					uploadArea.addClass('has-error');
					setTimeout(function () {
						uploadArea.removeClass('has-error');
					}, 200);
					return;
				}

				_.each(files, (file, index) => {
					const progressBar = $('.progress#media-' + index + ' .progress-bar');
					var formData = new FormData();
					formData.append('file', file, file.name);

					axios.post('/api/v1/media', formData, {
						onUploadProgress: (progressEvent) => {
							const total = Math.round(progressEvent.loaded * 100 / progressEvent.total);
							progressBar.css({width: total + '%'});

							if (total == 100) {
								progressBar.removeClass('active progress-bar-striped');
							}
						}
					}).then(res => {
						if (res.status == 201) {
							this.files.push(res.data);
							progressBar.addClass('progress-bar-success');
						}
					});
				});
			}
		}
	}
</script>
