<?php $blog = $static->get_blog_post($base->get_var(1)); ?>
<div class="container">	
	<div class="row">
		
		<div class="col-12">
			<div class="row">
				<h1><?= $blog['header'] ?> <small><?= $base->get_var(1) ?></small></h1>
			</div>
			<div class="row">
				<?= $blog['text'] ?>
			</div>
			
			<div class="row">
				<h3>Tags:</h3>
				<?php 
					$tags = explode(",", $blog['tags']);
					
					foreach ($tags as $key => $value) {
						echo("<span class='tag'>".$value."</span> ");
					}
					
					
				 ?>
			</div>
			
		</div>
	</div>
</div>