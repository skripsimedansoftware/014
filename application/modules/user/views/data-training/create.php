<div class="content-wrapper">
	<section class="content-header">
		<h1>Data Training <small>Sentiment</small></h1>
		<ol class="breadcrumb">
			<li><a href="<?= module_link() ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="<?= module_link('data_training') ?>">Data Training</a></li>
			<li class="active">Create</li>
		</ol>
	</section>
	<section class="content">
		<div class="box">
			<form method="post" action="<?= module_link('data_training/create') ?>">
				<div class="box-header with-border">
					<h3 class="box-title">New Data Training</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Text</label>
						<input type="text" name="text" class="form-control" placeholder="Text" value="<?= set_value('text') ?>">
						<?= form_error('text', '<span class="help-block error">', '</span>'); ?>
					</div>
					<div class="form-group">
						<label>Class</label>
						<select name="class" class="form-control">
							<option value="Positif" <?= strtolower(set_value('class')) == 'positif' ? 'selected' : '' ?>>Positif</option>
							<option value="Negatif" <?= strtolower(set_value('class')) == 'negatif' ? 'selected' : '' ?>>Negatif</option>
						</select>
						<?= form_error('class', '<span class="help-block error">', '</span>'); ?>
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</section>
</div>
