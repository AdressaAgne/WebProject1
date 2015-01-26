<?php 
include_once("../../../controllers/include.php");
error_reporting(~0);
ini_set('display_errors', 1);

if ($admin->editPageSettings($_POST['url'], $_POST['title'], $_POST['name'], $_POST['menu'], $_POST['type'], $_POST['restriction'], $_POST['grade'], $_POST['id'])) {
	echo("Settings Updated");
}

		

