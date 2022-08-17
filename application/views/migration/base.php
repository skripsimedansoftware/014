<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/sweetalert2/sweetalert2.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/bootstrap/3.4.x/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/bootstrap/3.4.x/css/bootstrap-theme.min.css') ?>">
	<title><?= isset($title) ? $title . ' - ' . env('APP_NAME') : env('APP_NAME') ?></title>
</head>
<body>
<div class="container">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><?= env('APP_NAME') ?></a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="<?= matches_request(NULL, 'migration', 'index') ? 'active' : '' ?>"><a href="<?= base_url('migration') ?>">Home</a></li>
					<li class="<?= matches_request(NULL, 'migration', 'database') ? 'active' : '' ?>"><a href="<?= base_url('migration/database') ?>">Database</a></li>
					<li class="<?= matches_request(NULL, 'migration', 'setup') ? 'active' : '' ?>"><a href="<?= base_url('migration/setup') ?>">Setup</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<?= $__content; ?>
</div>
</body>
<script type="text/javascript" src="<?= base_url('assets/jquery/core/jquery-3.6.0.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/bootstrap/3.4.x/js/bootstrap.min.js') ?>"></script>
</html>
