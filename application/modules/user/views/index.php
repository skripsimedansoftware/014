<div class="content-wrapper">
	<section class="content-header">
		<h1>Dashboard<small> <?= env('APP_NAME') ?></small></h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-lg-6">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Visualisasi Sentimen Naive Bayes</h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-8">
								<div class="chart-responsive">
									<canvas id="pieChart" height="150"></canvas>
								</div>
							</div>
							<div class="col-md-4">
								<ul class="chart-legend clearfix">
									<li><i class="fa fa-circle-o text-green"></i> Positif</li>
									<li><i class="fa fa-circle-o text-primary"></i> Netral</li>
									<li><i class="fa fa-circle-o text-red"></i> Negatif</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="box-footer no-padding">
						<ul class="nav nav-pills nav-stacked">
							<li><a href="#">United States of America<span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
							<li><a href="#">United States of America<span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
							<li><a href="#">United States of America<span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
