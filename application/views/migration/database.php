<div class="jumbotron">
	<h1>Database Installation</h1>
	<div class="row">
		<div class="col-lg-12">
		<?php if (isset($error)) : ?>
			<div class="alert alert-danger"><?= $error['message'] ?></div>
		<?php endif; ?>
		</div>
		<form action="<?= base_url('migration/database') ?>" method="post">
			<div class="col-lg-6">
				<div class="form-group">
					<label>Database Name</label>
					<input type="text" name="database" class="form-control" value="<?= set_value('database') ?>">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Database Driver</label>
					<select class="form-control" name="dbdriver">
						<option value="mysqli">MySQL</option>
						<option value="postgre">PostgreSQL</option>
						<option value="odbc">ODBC</option>
					</select>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label>Hostname</label>
					<input type="text" name="hostname" class="form-control" value="<?= set_value('hostname') ?>">
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control" value="<?= set_value('username') ?>">
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label>Password</label>
					<input type="text" name="password" class="form-control" value="<?= set_value('password') ?>">
				</div>
			</div>
			<div class="col-lg-12">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</div>
