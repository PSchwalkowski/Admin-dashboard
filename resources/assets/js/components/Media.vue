<template>
	<div class="panel panel-default">
		<div class="panel-heading"></div>
		<div class="panel-body">
			<div class="media-list">
				<div class="col-xs-12 col-sm-2 media-item" v-for="(file, index) in files"
					v-bind:style="index > 17 ? {display: 'none'} : {}">
					<a href="#">
						<img v-if="file.type == 'image'"
							v-bind:src="file.url" v-bind:alt="file.alt"
							v-bind:title="file.title || file.name">

						<i class="fa fa-file-audio-o" v-if="file.type == 'audio'"
							v-bind:src="file.url" v-bind:alt="file.alt"
							v-bind:title="file.title || file.name"></i>

						<i class="fa fa-file-archive-o" v-if="file.type == 'archive'"
							v-bind:src="file.url" v-bind:alt="file.alt"
							v-bind:title="file.title || file.name"></i>

						<i class="fa fa-file-text-o" v-if="file.type == 'document'"
							v-bind:src="file.url" v-bind:alt="file.alt"
							v-bind:title="file.title || file.name"></i>

						<i class="fa fa-file-o" v-if="file.type == 'other'"
							v-bind:src="file.url" v-bind:alt="file.alt"
							v-bind:title="file.title || file.name"></i>

					</a>
				</div>
			</div>
		</div>

		<div class="panel-footer text-center">
			<button type="button" v-on:click="loadMore" name="loadMore"
				class="btn btn-default btn-circle">
				<i class="fa fa-chevron-down" aria-hidden="true"></i>
			</button>
		</div>

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
							<div class="alert alert-danger" style="display: none;">
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
				files: this.$parent.files,
				uploadedFiles: 0
			}
		},
		created: function() {
			this.getFiles().then(files => {
				this.files = files;
			});
		},
		watch: {
			files: function(files) {
				var moreButton = $('button[name="loadMore"]');
				if (files.length <= 10) {
					moreButton.hide();
				} else {
					moreButton.show();
				}
			}
		},
		methods: {

			/**
			 * Add dragover class to wrapper
			 * @param  {event} event DOM Event Object
			 * @return {void}
			 */
			addDragClass: function(event) {
				$(event.target).parent().addClass('dragover');
			},

			/**
			 * Remove dragove class from wrapper
			 * @param  {event} event DOM Event Object
			 * @return {void}
			 */
			removeDragClass: function(event) {
				$(event.target).parent().removeClass('dragover');
			},

			/**
			 * Reset upload form
			 */
			resetUploadForm: function() {
				const modal = $('#media-create');
				const filesList = $('.media-upload-files-list', modal);

				$('.progress', filesList).slideUp();
				setTimeout(function () {
					filesList.empty();
				}, 500);
			},

			/**
			 * Display progressbars
			 * @param  {event} event DOM Event Object
			 * @return {void}
			 */
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

			/**
			 * Process upload
			 * @param  {event} event DOM Event Object
			 * @return {void}
			 */
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
								this.uploadedFiles++;
							}
						}
					})
					.then(res => {
						if (res.status == 201) {
							this.files.push(res.data);
							progressBar.addClass('progress-bar-success');

							if (this.uploadedFiles == files.length) {
								setTimeout(() => {
									this.resetUploadForm();
								}, 2000);

								this.uploadedFiles = 0;
							}
						}
					})
					.catch(error => {
						const errorsList = $('.alert ul', modal);

						if (errorsList.parent().is(':hidden')) {
							errorsList
								.append($('<li/>').text('Something went wrong... try again later.'))
								.parent().slideDown();

							progressBar.addClass('progress-bar-danger');
						}
					});
				});
			},

			/**
			 * Get files from API
			 * @return {Promise}
			 */
			getFiles: function() {
				return axios.get('/api/v1/media').then(res => {
					return res.data;
				});
			},

			/**
			 * Show more list items
			 * @param  {event} event DOM Event Object
			 * @return {void}
			 */
			loadMore: function(event) {
				var hiddenItems = $('.media-list .media-item:hidden');

				hiddenItems.slice(0, 6).each(function() {
					$(this).fadeIn();
				});

				if (hiddenItems.length < 6) {
					$(this.$parent.getTargetButtonFromEvent(event)).hide();
				}
			}
		}
	}
</script>
