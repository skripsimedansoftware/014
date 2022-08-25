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
		<link rel="stylesheet" href="<?= base_url('assets/sweetalert2/sweetalert2.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/select2/dist/css/select2.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/select2/bootstrap-3-theme/dist/select2-bootstrap.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/adminlte/2.4.x/bower_components/morris.js/morris.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/adminlte/2.4.x/dist/css/AdminLTE.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/adminlte/2.4.x/dist/css/skins/_all-skins.min.css') ?>">

		<script src="<?= base_url('assets/adminlte/2.4.x/bower_components/jquery/dist/jquery.min.js') ?>"></script>
		<script src="<?= base_url('assets/adminlte/2.4.x/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
		<script src="<?= base_url('assets/adminlte/2.4.x/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
		<script src="<?= base_url('assets/adminlte/2.4.x/bower_components/fastclick/lib/fastclick.js') ?>"></script>
		<script src="<?= base_url('assets/adminlte/2.4.x/bower_components/raphael/raphael.min.js') ?>"></script>
		<script src="<?= base_url('assets/adminlte/2.4.x/bower_components/morris.js/morris.min.js') ?>"></script>
		<script src="<?= base_url('assets/sweetalert2/sweetalert2.all.min.js') ?>"></script>
		<script src="<?= base_url('assets/select2/dist/js/select2.min.js') ?>"></script>
		<script src="<?= base_url('assets/adminlte/2.4.x/dist/js/adminlte.min.js') ?>"></script>
		<style type="text/css">
		.help-block.error {
			color: red;
		}

		.select2-result-store {
			padding-top: 4px;
			padding-bottom: 3px;
		}

		.select2-result-store__avatar {
			float: left;
			width: 60px;
			margin-right: 10px;
		}

		.select2-result-store__avatar img {
			width: 100%;
			height: auto;
			border-radius: 2px;
		}

		.select2-result-store__meta {
			margin-left: 70px;
		}

		.select2-result-store__title {
			color: black;
			font-weight: bold;
			word-wrap: break-word;
			line-height: 1.1;
			margin-bottom: 4px;
		}

		.select2-result-store__followers,
		.select2-result-store__following {
			display: inline-block;
			color: #aaa;
			font-size: 12px;
		}

		.select2-result-store__following {
			margin-left: 10px;
		}

		.select2-result-store__description {
			font-size: 13px;
			color: #777;
			margin-top: 4px;
		}

		.select2-results__option--highlighted .select2-result-store__title {
			color: black;
		}

		.select2-results__option--highlighted .select2-result-store__description {
			color: #767785;
		}

		.select2-results__option--highlighted .select2-result-store__followers,
		.select2-results__option--highlighted .select2-result-store__following {
			color: #00738c;
		}

		.swal2-popup {
			font-size: 1.6rem !important;
		}
		</style>
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>
	<body class="hold-transition skin-green layout-top-nav">
		<div class="wrapper">
			<header class="main-header">
				<nav class="navbar navbar-static-top">
					<div class="container">
						<div class="navbar-header">
							<a href="<?= module_link() ?>" class="navbar-brand"><b><?= env('SITE_NAME') ?></b></a>
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
								<i class="fa fa-bars"></i>
							</button>
						</div>
						<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
							<ul class="nav navbar-nav">
								<li class="<?= matches_request('site', false, 'index') ? 'active' : '' ?>"><a href="<?= module_link() ?>">Beranda</a></li>
							</ul>
						</div>
						<div class="navbar-custom-menu">
							<ul class="nav navbar-nav">
								<li><a href="<?= base_url('user/sign-in') ?>">Masuk <i class="fa fa-sign-in"></i></a></li>
							</ul>
						</div>
					</div>
				</nav>
			</header>
			<?= $__content; ?>
			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Version</b> <?= env('VERSION') ?>
				</div>
				<strong>Copyright &copy; <?= env('SITE_NAME') ?> - <a href="<?= base_url() ?>" target="_blank"><?= env('APP_NAME') ?></a>.</strong> All rights
				reserved.
			</footer>
		</div>
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

		function nFormatter(num, digits) {
			const lookup = [
				{ value: 1, symbol: "" },
				{ value: 1e3, symbol: "K" },
				{ value: 1e6, symbol: "M" },
				{ value: 1e9, symbol: "G" },
				{ value: 1e12, symbol: "T" },
				{ value: 1e15, symbol: "P" },
				{ value: 1e18, symbol: "E" }
			];

			const rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
			var item = lookup.slice().reverse().find(function(item) {
				return num >= item.value;
			});

			return item ? (num / item.value).toFixed(digits).replace(rx, "$1") + item.symbol : "0";
		}

		function shopTemplateResult(data) {
			console.log('shopTemplateResult', data)

			if (data.loading) {
				return data.text;
			}

			var html = '';

			html += '<div class="col-lg-12">'+data.id+'</div>';
			return html;
		}

		function shopTemplateSelection(data) {
			console.log('shopTemplateSelection', data);
			return data
		}

		$('#search-store').select2({
			placeholder: 'Search Store',
			minimumInputLength: 2,
			containerCssClass: ':all:',
			ajax: {
				cache: true,
				url: '<?= base_url('api/shopee/search_user') ?>',
				dataType: 'json',
				data: (params) => {
					var query = { keyword: params.term }

					query.offset = (params.page !== undefined) ? (6*(params.page-1)) : 0;

					return query;
				},
				processResults: function (data) {
					return {
						results: $.map(data.data.users, function (obj) {
							obj.id = obj.shopid || obj.username;
							obj.text = obj.shopname || obj.username;

							return obj;
						}),

						pagination: { more: (data.data.users.length >= 6) }
					}
				}
			},
			templateResult: (i_store) => {
				if (i_store.loading) {
					return i_store.text;
				}

				var html = '<div class="select2-result-store clearfix" data-username="'+i_store.username+'">';
					html += '<div class="select2-result-store__avatar"><img src="<?= base_url('api/shopee/image/') ?>' + i_store.portrait + '"/></div>';
					html += '<div class="select2-result-store__meta">';
						html += '<div class="select2-result-store__title">' + i_store.shopname + '</div>';
						html += '<div class="select2-result-store__description">' + i_store.username + '</div>';
						html += "<div class='select2-result-store__statistics'>";
							html += "<div class='select2-result-store__followers'><span class='fa fa-users'></span> " + i_store.follower_count + " Followers</div>";
							html += "<div class='select2-result-store__following'><span class='fa fa-users'></span> " + i_store.following_count + " Following</div>";
						html += '</div>';
					html += '</div>';
				html += '</div>';

				return $(html);
			},
			templateSelection: (i_store) => {
				return i_store.shopname || i_store.username
			},
			escapeMarkup: function (markup) { return markup }
		});

		$('#search-store').on('select2:select', function (e) {
			$('.store-search-loading').removeClass('hidden');
			$('.store-detail-body').empty();
			$('.store-detail-footer').empty();

			$('.store-detail').removeClass('hidden');
			$('.store-detail-loading').removeClass('hidden');

			$('.store-products').empty();
			$('.store-products').addClass('hidden');

			var data = e.params.data;

			$.ajax({
				url: '<?= base_url('api/shopee/get_shop_detail/') ?>'+data.username,
				type: 'GET',
				dataType: 'JSON',
				success: function(detail) {
					$('.store-search-loading').addClass('hidden');
					$('.store-detail-loading').addClass('hidden');

					var html = '';

					html += '<table class="table table-hover table-striped">';
					html += '<tbody>';
						html += '<tr><td style="width:20%"><b>ID Toko</b></td><td>: '+detail.data.shopid+'</td></tr>';
						html += '<tr><td style="width:20%"><b>Username</b></td><td>: @'+detail.data.account.username+'</td></tr>';
						html += '<tr><td style="width:20%"><b>Nama Toko</b></td><td>: '+detail.data.name+'</td></tr>';
						html += '<tr><td style="width:20%"><b>Lokasi</b></td><td>: '+detail.data.shop_location+'</td></tr>';
						html += '<tr><td style="width:20%"><b>Deskripsi Toko</b></td><td>: '+detail.data.description+'</td></tr>';
						html += '<tr><td style="width:20%"><b>Respon Rate</b></td><td>: '+detail.data.response_rate+'%</td></tr>';
					html += '</tbody>';
					html += '</table>';
					$('.store-detail-body').append(html);
					$('.store-detail-footer').append('<a target="_blank" href="https://shopee.co.id/'+detail.data.account.username+'" class="btn btn-info">Kunjungi Toko Di Shopee</a>');

					$.ajax({
						url: '<?= base_url('api/shopee/store_product/') ?>'+detail.data.shopid+'/'+12,
						type: 'GET',
						dataType: 'JSON',
						data: {
							sort_type: 1
						},
						success: function (products) {
							$('.store-products').removeClass('hidden');

							var chunkSize = 3

							for (let i = 0; i < products.data.sections[0].data.item.length; i += chunkSize) {
								const chunk = products.data.sections[0].data.item.slice(i, i + chunkSize);
								var html_product = '';
								chunk.forEach((item, index) => {
									var formatter = new Intl.NumberFormat(['id'], {
										style: 'currency',
										currency: 'Rp.',
										currency: item.currency,
										minimumFractionDigits: 0,
										maximumFractionDigits: 0
									});

									html_product += '<div class="col-lg-4 product-detail">';
										html_product += '<div class="box box-primary">';
											html_product += '<div class="box-header with-border"><h3 class="box-title">'+item.name+'</h3></div>';
											html_product += '<div class="box-body">';
												html_product += '<img id="'+item.image+'" src="<?= base_url('api/shopee/image/') ?>'+item.image+'" class="img-circle img-thumbnail img-responsive center-block">';
												html_product += '<div class="row">';
													html_product += '<div class="col-lg-12" style="margin-top:2%">';
													html_product += '<table class="table table-hover table-striped">';
														html_product += '<tbody>';
															html_product += '<tr><td>Tersedia</td><td>'+nFormatter(item.stock)+'</td></tr>';
															html_product += '<tr><td>Terjual</td><td>'+nFormatter(item.historical_sold)+'</td></tr>';
															html_product += '<tr><td>Disukai</td><td>'+nFormatter(item.liked_count)+'</td></tr>';
															html_product += '<tr><td>Merek</td><td>'+item.brand+'</td></tr>';
															html_product += '<tr><td>Penilaian</td><td>'+item.item_rating.rating_star.toFixed(1)+'</td></tr>';
															html_product += '<tr><td>Harga</td><td>'+item.currency+' '+formatter.format(parseInt(item.price.toString().slice(0, -5)))+'</td></tr>';
														html_product += '<tbody>';
													html_product += '</table>';
													html_product += '</div>';
												html_product += '</div>';
											html_product += '</div>';
											html_product += '<div class="box-footer">';
												html_product += '<a target="_blank" href="<?= module_link('sentiment/product/') ?>'+item.shopid+'/'+item.itemid+'" class="btn btn-block bg-navy">Analisis Sentimen</a>';
											html_product += '</div>';
										html_product += '</div>';
									html_product += '</div>';
								});

								$('.store-products').append('<div class="row">'+html_product+'</div>');
							}
						},
						error: function(error) {
							console.log('error', error);
						}
					});
				},
				error: function(error) {
					console.log('error', error);
				}
			});
		});

		$(document).on('click', '#get-comments', (function() {
			Swal.fire({
				title: 'Jumlah Komentar',
				input: 'text',
				inputAttributes: {
					autocapitalize: 'off'
				},
				showCancelButton: true,
				confirmButtonText: 'Ambil Komentar',
				showLoaderOnConfirm: true,
				preConfirm: (crawl) => {
					var all_request = new Array();
					for (i = 0; i < (crawl/50); i++) {
						var request = new Promise((resolve, reject) => {
							 $.ajax({
								url: '<?= base_url('api/shopee/get_item_ratings/'.$this->uri->segment(4).'/'.$this->uri->segment(5)) ?>',
								type: 'GET',
								dataType: 'JSON',
								data: { offset: (i*50) },
								success: function(data) {
									resolve(true)
								},
								error: function(error) {
									reject(false);
								}
							})
						});

						all_request.push(request);
					}

					return Promise.all(all_request);
				},
				allowOutsideClick: () => !Swal.isLoading()
			}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Komentar berhasil di ambil',
						showConfirmButton: false,
						timer: 1500
					}).then(() => {
						window.location.reload();
					}, console.log);
				}
			});
		}));
		</script>
	</body>
</html>
