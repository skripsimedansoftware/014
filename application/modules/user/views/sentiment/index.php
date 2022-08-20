<div class="content-wrapper">
	<section class="content-header">
		<h1>Analisis Sentimen</h1>
		<ol class="breadcrumb">
			<li><a href="<?= module_link() ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Analisis Sentimen</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-lg-4">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Cari Toko</h3>
					</div>
					<div class="box-body">
						<select id="search-store" style="width: 100%;"></select>
					</div>
					<div class="overlay store-search-loading hidden"><i class="fa fa-refresh fa-spin"></i></div>
				</div>
			</div>
			<div class="col-lg-8 hidden store-detail">
				<div class="box box-success">
					<div class="box-header with-border"><h3 class="box-title">Detail Toko</h3></div>
					<div class="box-body store-detail-body"></div>
					<div class="overlay store-detail-loading"><i class="fa fa-refresh fa-spin"></i></div>
					<div class="box-footer store-detail-footer"></div>
				</div>
			</div>
		</div>
	</section>

	<section class="content hidden store-products"></section>
</div>
