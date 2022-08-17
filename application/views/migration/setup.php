<div class="jumbotron">
	<h1>Application Setup</h1>
	<div class="row">
		<div class="col-lg-12">
		<?php if ($this->session->userdata('migraton') === FALSE) : ?>
			<div class="alert alert-danger"><?= $this->session->userdata('migraton-error'); ?></div>
		<?php endif; ?>
		</div>
		<form action="<?= base_url('migration/setup') ?>" method="post">
			<div class="col-lg-6">
				<div class="form-group">
					<label>App Name</label>
					<input type="text" name="app_name" class="form-control" value="<?= set_value('app_name') ?>">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Site Name</label>
					<input type="text" name="site_name" class="form-control" value="<?= set_value('site_name') ?>">
				</div>
			</div>
			<div class="col-lg-12">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</div>
