<?php 
	if ($base->get_var(1) == "") {
		$admin_page = "pages";
	} else {
		$admin_page = $base->get_var(1);
	}
 ?>
<div class="container-fluid">
	<div class="row">
		<div class="">
			<ul class="menu-vertical">
				<li class="header">Admin Panel</li>
				<?php foreach ($admin->admin_structure as $key => $value) { ?>
					<li <?php if ("/".$admin_page == $key) { echo(" class='active' ");} ?>><a href="/admin<?= $key ?>"><?= $value['name'] ?></a></li>
				<?php } ?>
			</ul>
		</div>
		<div class="col-12 admin-page">
			<?php include($admin->get_content("/".$admin_page)) ?>
		</div>
	</div>
</div>
