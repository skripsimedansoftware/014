<div class="content-wrapper">
	<section class="content-header">
		<h1>User <small>profile</small></h1>
	</section>
	<section class="content">
		<div class="box">
			<div class="box-body">
				<img src="<?= base_url(user_session('photo', 'assets/adminlte/2.4.x/dist/img/user2-160x160.jpg')) ?>" class="img-circle img-thumbnail" style="height: 120px;">

				<div class="row" style="margin-top: 1%;">
					<div class="col-lg-4">
						<table class="table">
							<tbody>
								<tr>
									<td>Email</td>
									<td><?= $profile['email'] ?></td>
								</tr>
								<tr>
									<td>Username</td>
									<td><?= $profile['username'] ?></td>
								</tr>
								<tr>
									<td>Full Name</td>
									<td><?= $profile['full-name'] ?></td>
								</tr>
								<tr>
									<td>Gender</td>
									<td><?= ucfirst($profile['gender']) ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<?php if (user_session('id') == $profile['id']) : ?>
			<div class="box-footer">
				<a href="<?= module_link('profile/'.$profile['id'].'/update') ?>" class="btn btn-primary">Update Information <i class="fa fa-edit"></i></a>
			</div>
			<?php endif; ?>
		</div>
	</section>
</div>
