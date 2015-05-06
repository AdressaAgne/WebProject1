<?php $static_page = $static->get_static_content($base->get_id()); ?>
<div class="container">
	<div class="row">
		<div class="col-8 col-offset-2">
			<div class="page-header">
				<h1><?= $base->get_name() ?> <small><?= $base->get_id() ?></small></h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-8 col-offset-2">
			<?= $formating->makeClickableLinks(strip_tags($static_page['html'])) ?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-8 col-offset-2">
			<?php 
				$query = $database->_db->prepare("SELECT * FROM blog WHERE page_id = :id");
				$arr = array(
					'id' => $base->get_id()
				);
				$database->arrayBinder($query, $arr);
				
				if ($query->execute()) {
					$rowCount = $query->rowCount();
					if ($rowCount == 0) { ?>
						<div class="col-12 align-center">
							<p>Emtpy Blog <small><?= $base->get_id() ?></small></p>
						</div>
					<?php } else {
						while ($row = $row = $query->fetch(PDO::FETCH_ASSOC)) { ?>
						<div class="row">
							<h1><a href="/archive/<?= $row['permalink'] ?>"><?= $row['header'] ?></a></h1>
						</div>
						<div class="row">
							<?= $row['text'] ?>
						</div>
					<?php }
					}
				}
			
			 ?>	
		</div>
	</div>
</div>