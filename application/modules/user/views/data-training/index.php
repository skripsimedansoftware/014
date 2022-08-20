<div class="content-wrapper">
	<section class="content-header">
		<h1>Data Training <small>Sentiment</small></h1>
		<ol class="breadcrumb">
			<li><a href="<?= module_link() ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Data Training</li>
		</ol>
	</section>
	<section class="content">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Title</h3>
			</div>
			<div class="box-body">
				<table class="table table-hover table-striped">
					<thead>
						<th>#</th>
						<th>Class</th>
						<th>Text</th>
						<th>Option</th>
					</thead>
					<tbody>
						<?php foreach ($data_training->result_array() as $key => $data) : ?>
						<tr>
							<td><?= $key+1 ?></td>
							<td><?= $data['classification'] ?></td>
							<td><?= $data['text'] ?></td>
							<td>
								<a class="btn btn-sm btn-primary" href="<?= module_link('data_training/update/'.$data['id']) ?>">Edit</a>
								<a class="btn btn-sm btn-danger" href="<?= module_link('data_training/delete/'.$data['id']) ?>">Delete</a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="box-footer">
				<a href="<?= module_link('data_training/create') ?>" class="btn btn-primary">Tambah Data</a>
			</div>
		</div>
	</section>
</div>
