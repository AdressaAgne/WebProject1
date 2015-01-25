<?php $static_page = $static->get_static_content($base->get_id()); ?>
<div class="container">
	<div class="page-header">
		<h2><?= $base->get_name() ?> <small><?= $base->get_id() ?></small></h2>
	</div>
	
	<div class="row">
		<div class="col-12">
			<?= $static_page['html'] ?>
		</div>
	</div>
</div>