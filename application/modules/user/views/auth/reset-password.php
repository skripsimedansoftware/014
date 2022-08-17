<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="<?= base_url() ?>" target="_blank"><b><?= env('APP_NAME') ?></b></a>
		</div>
		<div class="login-box-body">
			<?php if (isset($error)) : ?>
				<div class="alert alert-danger"><?= $error ?></div>
				<?php else: ?>
				<p class="login-box-msg">Enter verification code to reset password</p>
			<?php endif; ?>
			<form action="<?= module_link('reset-password') ?>" method="post">
				<div class="form-group has-feedback">
					<input type="text" name="verification-code" class="form-control" placeholder="Verification Code" value="<?= set_value('verification-code', $verification_code) ?>">
					<span class="fa fa-key form-control-feedback"></span>
					<?= form_error('verification-code', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group has-feedback">
					<input type="password" name="password" class="form-control" placeholder="New Password">
					<span class="fa fa-lock form-control-feedback"></span>
					<?= form_error('password', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="form-group has-feedback">
					<input type="password" name="password_confirm" class="form-control" placeholder="Re-type New Password">
					<span class="fa fa-lock form-control-feedback"></span>
					<?= form_error('password_confirm', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
					</div>
				</div>
				<div class="row" style="margin-top: 4%;">
					<div class="col-lg-12">
						<a href="<?= base_url() ?>"><i class="fa fa-arrow-left"></i> Back to site</a>
						<a href="<?= module_link('sign-up') ?>" class="pull-right">Sign up</a>
						<span class="pull-right">&nbsp;/&nbsp;</span>
						<a href="<?= module_link('sign-in') ?>" class="pull-right">Sign in</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
