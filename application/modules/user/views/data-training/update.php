<div class="content-wrapper">
	<section class="content-header">
		<h1>Data Training <small>Sentiment</small></h1>
		<ol class="breadcrumb">
			<li><a href="<?= module_link() ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="<?= module_link('data_training') ?>">Data Training</a></li>
			<li class="active">Update</li>
		</ol>
	</section>
	<section class="content">
		<div class="box">
			<form method="post" action="<?= module_link('data_training/update/'.$this->uri->segment(4)) ?>">
				<div class="box-header with-border">
					<h3 class="box-title">Update Data Training</h3>
				</div>
				<div class="box-body">
					<div class="form-group">
						<label>Text</label>
						<input type="text" name="text" class="form-control" placeholder="Text" value="<?= set_value('text', $data['text']) ?>">
						<?= form_error('text', '<span class="help-block error">', '</span>'); ?>
					</div>
					<div class="form-group">
						<label>Class</label>
						<input type="text" name="class" class="form-control" placeholder="Class" value="<?= set_value('class', $data['classification']) ?>">
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
