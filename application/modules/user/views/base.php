<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?= isset($title) ? $title . ' - ' . env('SITE_NAME') : env('SITE_NAME'); ?></title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="<?= base_url('assets/adminlte/2.4.x/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/adminlte/2.4.x/bower_components/font-awesome/css/font-awesome.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/adminlte/2.4.x/bower_components/Ionicons/css/ionicons.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/adminlte/2.4.x/dist/css/AdminLTE.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/adminlte/2.4.x/dist/css/skins/_all-skins.min.css') ?>">
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
				<a href="<?= base_url() ?>" class="logo" target="_blank">
					<span class="logo-mini"><b>A</b>DM</span>
					<span class="logo-lg"><b><?= env('APP_NAME') ?></b></span>
				</a>
				<nav class="navbar navbar-static-top">
					<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<li class="dropdown user user-menu">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<img src="<?= base_url(user_session('photo', 'assets/adminlte/2.4.x/dist/img/user2-160x160.jpg')) ?>" class="user-image" alt="User Image">
									<span class="hidden-xs"><?= $user_session['full-name'] ?></span>
								</a>
								<ul class="dropdown-menu">
									<li class="user-header">
										<img src="<?= base_url(user_session('photo', 'assets/adminlte/2.4.x/dist/img/user2-160x160.jpg')) ?>" class="img-circle" alt="User Image">
										<p><?= $user_session['full-name'] ?></p>
									</li>
									<li class="user-footer">
										<div class="pull-left">
											<a href="<?= module_link('profile') ?>" class="btn btn-default btn-flat">Profile</a>
										</div>
										<div class="pull-right">
											<a href="<?= module_link('sign-out') ?>" class="btn btn-default btn-flat">Sign out</a>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</nav>
			</header>
			<aside class="main-sidebar">
				<section class="sidebar">
					<div class="user-panel">
						<div class="pull-left image">
							<img src="<?= base_url(user_session('photo', 'assets/adminlte/2.4.x/dist/img/user2-160x160.jpg')) ?>" class="img-circle" alt="User Image">
						</div>
						<div class="pull-left info">
							<p><?= $user_session['full-name'] ?></p>
							<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
						</div>
					</div>
					<form action="#" method="get" class="sidebar-form">
						<div class="input-group">
							<input type="text" name="q" class="form-control" placeholder="Search...">
							<span class="input-group-btn">
								<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>
					<ul class="sidebar-menu" data-widget="tree">
						<li class="header">MAIN NAVIGATION</li>
						<li class="<?= matches_request(FALSE, 'user', 'index') ? 'active' : '' ?>"><a href="<?= module_link() ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
						<li class="treeview">
							<a href="#">
								<i class="fa fa-users"></i> <span>Users</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
								<li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
							</ul>
						</li>
						<li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
						<li class="header">LABELS</li>
						<li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
						<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
						<li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
					</ul>
				</section>
			</aside>
			<?= $__content; ?>
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Version</b> 2.4.13
				</div>
				<strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
				reserved.
			</footer>
			<div class="control-sidebar-bg"></div>
		</div>
		<script src="<?= base_url('assets/adminlte/2.4.x/bower_components/jquery/dist/jquery.min.js') ?>"></script>
		<script src="<?= base_url('assets/adminlte/2.4.x/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
		<script src="<?= base_url('assets/adminlte/2.4.x/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
		<script src="<?= base_url('assets/adminlte/2.4.x/bower_components/fastclick/lib/fastclick.js') ?>"></script>
		<script src="<?= base_url('assets/adminlte/2.4.x/dist/js/adminlte.min.js') ?>"></script>
		<script type="text/javascript">
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#profile-upload-preview').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		</script>
	</body>
</html>
