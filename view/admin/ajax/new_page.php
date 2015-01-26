<?php 
error_reporting(~0);
ini_set('display_errors', 1);

include_once("../../../controllers/include.php");

$query = $database->_db->prepare("INSERT INTO pages (url, title, name, menu, restricted, grade, file) VALUES (:url, :title, :name, :menu, :res, :grade, :file)");
$arr = array(
		'url' => $_POST['url'],
		'title' => $_POST['title'],
		'name' => $_POST['name'],
		'menu' => $_POST['menu'],
		'res' => $_POST['restriction'],
		'grade' => $_POST['grade'],
		'file' => $_POST['file']
	);

$database->arrayBinder($query, $arr);

	if ($query->execute()) {
		if ($admin->newPage($database->_db->lastInsertId())) {
			echo($database->_db->lastInsertId());
		}
	} else {
		echo(false);
	}
		

