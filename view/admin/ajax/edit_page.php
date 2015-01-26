<?php 
include_once("../../../controllers/include.php");

if ($admin->editPage($_POST['text'], $_POST['id'])) {
	echo("Page saved");
}
		

