<?php 
include_once("../../../controllers/include.php");
$query = $database->_db->prepare("INSERT INTO pages (url, title, name, menu, tool, restricted, grade, image, file) VALUES (:url, :title, :name, :menu, :tool, :res, :grade, :image, :file)");
$arr = array(
		'url' => $_POST['url'],
		'title' => $_POST['title'],
		'name' => $_POST['name'],
		'menu' => $_POST['menu'],
		'tool' => $_POST['tool'],
		'res' => $_POST['restriction'],
		'grade' => $_POST['grade'],
		'image' => $_POST['image'],
		'file' => $_POST['file']
	);

$database->arrayBinder($query, $arr);

	if ($query->execute()) {
		echo(true);
	} else {
		echo(false);
	}
		

