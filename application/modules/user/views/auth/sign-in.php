<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="<?= base_url() ?>" target="_blank"><b><?= env('APP_NAME') ?></b></a>
		</div>
		<div class="login-box-body">
			<p class="login-box-msg">Sign in to start your session</p>
			<form action="<?= module_link('sign-in') ?>" method="post">
				<div class="form-group has-feedback">
					<input type="text" name="identity" class="form-control" placeholder="Email / Username" value="<?= set_value('identity') ?>">
					<span class="fa fa-envelope form-control-feedback"></span>
					<?= form_error('identity', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group has-feedback">
					<input type="password" name="password" class="form-control" placeholder="Password">
					<span class="fa fa-lock form-control-feedback"></span>
					<?= form_error('password', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
					</div>
				</div>
				<div class="row" style="margin-top: 4%;">
					<div class="col-lg-12">
						<a href="<?= base_url() ?>"><i class="fa fa-arrow-left"></i> Back to site</a>
						<a href="<?= module_link('forgot-password') ?>" class="pull-right">Forgot password</a>
						<span class="pull-right">&nbsp;/&nbsp;</span>
						<a href="<?= module_link('sign-up') ?>" class="pull-right">Sign up</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
