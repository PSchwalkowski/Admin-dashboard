@if (!Auth::guest())
	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">
				<li class="sidebar-search">
					<div class="input-group custom-search-form">
						<input type="text" name="search" class="form-control"
							placeholder="Search">
						<span class="input-group-btn">
							<button type="button" class="btn btn-default">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div><!-- /.input-group -->
				</li>
				<li><a href="{{ route('home') }}">
					<i class="fa fa-dashboard fa-fw"></i> Dashboard
				</a></li>
				<li>
					<a href="#">
						<i class="fa fa-bar-chart-o fa-fw"></i> Users Management
						<span class="fa arrow"></span>
						<?php // TODO: Fix arrow position when active ?>
					</a>
					<ul class="nav nav-second-level">
						<li><a href="{{ route('users.index') }}">Users</a></li>
						<li><a href="{{ route('roles.index') }}">Roles</a></li>
					</ul>
				</li>
				<li><a href="{{ route('media.index') }}">
					<i class="fa fa-folder-open-o fa-fw"></i> Media library
				</a></li>
				<li><a href="{{ route('settings.index') }}">
					<i class="fa fa-cogs fa-fw"></i> Settings
				</a></li>
			</ul>
		</div>
	</div>
@endif
