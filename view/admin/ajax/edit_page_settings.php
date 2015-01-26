<?php 
include_once("../../../controllers/include.php");

if ($admin->editPageSettings($_POST['url'], $_POST['title'], $_POST['name'], $_POST['menu'], $_POST['type'], $_POST['restriction'], $_POST['grade'], $_POST['id'])) {
	echo("Settings Updated");
}

		

