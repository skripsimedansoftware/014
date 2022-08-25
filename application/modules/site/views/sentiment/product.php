<div class="content-wrapper">
	<section class="content-header">
		<h1>Analisis Sentimen<small>Ulasan Produk</small></h1>
		<ol class="breadcrumb">
			<li><a href="<?= module_link() ?>"><i class="fa fa-home"></i> Beranda</a></li>
			<li><a href="<?= module_link('sentiment') ?>">Analisis Sentimen</a></li>
			<li class="active">Ulasan Produk</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-lg-6">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Info Produk</h3>
					</div>
					<div class="box-body">
						<?php
						if ($product->num_rows() >= 1) :
							$product = $product->row_array();
							$product_data = json_decode($product['data']);
							?>
							<img src="<?= base_url('api/shopee/image/'.$product_data->image) ?>" class="img-responsive img-circle img-thumbnail center-block">
							<table class="table table-hover table-striped">
								<tbody>
									<tr>
										<td>Nama</td><td><?= $product_data->name ?></td>
									</tr>
									<tr>
										<td>Harga</td><td><?= $product_data->price ?></td>
									</tr>
									<tr>
										<td>Rating</td><td><?= number_format($product_data->item_rating->rating_star, 1) ?></td>
									</tr>
									<tr>
										<td>Jumlah Komentar</td><td><?= $comment->num_rows() ?></td>
									</tr>
								</tbody>
							</table>
							<?php
						endif;
						?>
					</div>
					<div class="box-footer">
						<a class="btn btn-block btn-primary" id="get-comments">Ambil Komentar</a>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Sentimen</h3>
					</div>
					<div class="box-body">
					</div>
					<div class="box-footer">
						<a href="<?= module_link('sentiment/analysis/'.$this->uri->segment(4).'/'.$this->uri->segment(5)) ?>" class="btn btn-block btn-info" id="get-analysis">Analisis Sentimen</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
