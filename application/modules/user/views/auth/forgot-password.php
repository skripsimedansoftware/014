<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="<?= base_url() ?>" target="_blank"><b><?= env('APP_NAME') ?></b></a>
		</div>
		<div class="login-box-body">
			<p class="login-box-msg">Find your account</p>
			<form action="<?= module_link('forgot-password') ?>" method="post">
				<div class="form-group has-feedback">
					<input type="text" name="identity" class="form-control" placeholder="Email / Username" value="<?= set_value('identity') ?>">
					<span class="fa fa-envelope form-control-feedback"></span>
					<?= form_error('identity', '<span class="help-block error">', '</span>'); ?>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Send Email Verification</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
