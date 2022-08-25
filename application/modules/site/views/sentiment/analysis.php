<div class="content-wrapper">
	<?php
	$product_data = json_decode($product->row()->data)
	?>
	<section class="content-header">
		<h1>Analisis Sentimen<small>Ulasan Produk</small></h1>
		<ol class="breadcrumb">
			<li><a href="<?= module_link() ?>"><i class="fa fa-home"></i> Beranda</a></li>
			<li><a href="<?= module_link('sentiment') ?>">Analisis Sentimen</a></li>
			<li class="active"><?= $product_data->name ?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-lg-6">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Data Training Chart</h3>
					</div>
					<div class="box-body chart-responsive">
						<div class="chart" id="data-training" style="height: 300px; position: relative;"></div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Total Data <b><?= array_sum($class_count) ?></b></h3>
					</div>
					<div class="box-body chart-responsive">
						<div class="chart" id="sentiment-analysis" style="height: 300px; position: relative;"></div>
						<ul class="chart-legend clearfix" id="sentiment-analysis-legend"></ul>
					</div>
				</div>
			</div>
		</div>
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Hasil Sentiment Ulasan Produk : <b><?= $product_data->name ?></b></h3>
			</div>
			<div class="box-body">
				<table class="table table-hover table-striped">
					<thead>
						<th>No</th>
						<th>Komentar</th>
						<th>Hasil Sentimen</th>
					</thead>
					<tbody>
						<?php foreach ($sentiments as $key => $data) : ?>
						<tr>
							<td><?= $key+1 ?></td>
							<td><?= $data['comment']['real'] ?></td>
							<td>
								<b>
								<?php
								if (count(array_unique($data['sentiment'])) == 1)
								{
									echo 'NETRAL';
								}
								else
								{
									echo strtoupper(array_search(max($data['sentiment']), $data['sentiment']));
								}
								?>
								</b>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
</div>

<script type="text/javascript">
var class_count = <?= json_encode($class_count) ?>;
var data_training_count = <?= json_encode($data_training_count) ?>;

new Morris.Donut({
	element: 'data-training',
	resize: true,
	colors: ['#3c8dbc', '#00a65a', '#f56954'],
	data: Object.keys(data_training_count).map((name, key) => {
		return { label: name, value: data_training_count[name] }
	}),
	hideHover: 'auto'
});

new Morris.Donut({
	element: 'sentiment-analysis',
	resize: true,
	colors: ['#3c8dbc', '#00a65a', '#f56954'],
	data: Object.keys(class_count).map((name, key) => {
		var total_data = <?= array_sum($class_count) ?>;
		$('#sentiment-analysis-legend').append('<li><i class="fa fa-circle-o"></i> '+name+' '+((class_count[name]/total_data)*100).toFixed(2)+'%</li>');
		return { label: name, value: class_count[name] }
	}),
	hideHover: 'auto'
});
</script>
