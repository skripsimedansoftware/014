<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?= isset($title) ? $title . ' - ' . env('SITE_NAME') : env('SITE_NAME'); ?></title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="<?= base_url('assets/adminlte/2.4.x/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/adminlte/2.4.x/bower_components/font-awesome/css/font-awesome.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/adminlte/2.4.x/dist/css/AdminLTE.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/adminlte/2.4.x/plugins/iCheck/square/blue.css') ?>">
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		<style type="text/css">
		.help-block.error {
			color: red;
		}
		</style>
	</head>
	<?= $__content; ?>
	<script src="<?= base_url('assets/adminlte/2.4.x/bower_components/jquery/dist/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/adminlte/2.4.x/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('assets/adminlte/2.4.x/plugins/iCheck/icheck.min.js') ?>"></script>
</html>
