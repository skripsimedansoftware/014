<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="<?= base_url() ?>" target="_blank"><b><?= env('APP_NAME') ?></b></a>
		</div>
		<div class="login-box-body">
			<p class="login-box-msg">Create new account</p>
			<form action="<?= module_link('sign-up') ?>" method="post">
				<div class="form-group has-feedback">
					<input type="text" name="full-name" class="form-control" placeholder="Full Name" value="<?= set_value('full-name') ?>">
					<span class="fa fa-user form-control-feedback"></span>
					<?= form_error('full-name', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group has-feedback">
					<input type="text" name="email" class="form-control" placeholder="Email" value="<?= set_value('email') ?>">
					<span class="fa fa-envelope form-control-feedback"></span>
					<?= form_error('email', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group has-feedback">
					<input type="password" name="password" class="form-control" placeholder="Password">
					<span class="fa fa-lock form-control-feedback"></span>
					<?= form_error('password', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Sign Up</button>
					</div>
				</div>
				<div class="row" style="margin-top: 4%;">
					<div class="col-lg-12">
						<a href="<?= module_link('forgot-password') ?>">Forgot password</a>
						<a href="<?= module_link('sign-in') ?>" class="pull-right">Sign in</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
