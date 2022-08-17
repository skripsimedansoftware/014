<div class="content-wrapper">
	<section class="content-header">
		<h1>User Profile <small>update</small></h1>
	</section>
	<section class="content">
		<form method="post" action="<?= module_link('profile/'.$profile['id'].'/update') ?>" enctype="multipart/form-data">
			<div class="box">
				<div class="box-body">
					<div class="row">
						<div class="col-lg-6">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label>Email</label>
										<input type="text" class="form-control" name="email" value="<?= $profile['email'] ?>" placeholder="Email">
										<?= form_error('email', '<span class="help-block error">', '</span>'); ?>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Username</label>
										<input type="text" class="form-control" name="username" value="<?= $profile['username'] ?>" placeholder="Username">
										<?= form_error('username', '<span class="help-block error">', '</span>'); ?>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Full Name</label>
										<input type="text" class="form-control" name="full-name" value="<?= $profile['full-name'] ?>" placeholder="Full Name">
										<?= form_error('full-name', '<span class="help-block error">', '</span>'); ?>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Gender</label>
										<select class="form-control" name="gender">
											<option value="male">Male</option>
											<option value="female">Female</option>
										</select>
										<?= form_error('gender', '<span class="help-block error">', '</span>'); ?>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<img  class="img img-responsive img-circle" id="profile-upload-preview" src="<?= base_url(user_session('photo', 'assets/adminlte/2.4.x/dist/img/user2-160x160.jpg')) ?>" alt="Profile Image" style="margin-bottom: 2%; height:160px;width: 160px;">
										<input type="file" onchange="readURL(this);" name="photo">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-success">Update Profile</button>
				</div>
			</div>
		</form>
	</section>
</div>
