<?php 
include_once("../../../controllers/include.php");
$query = $database->_db->prepare("DELETE FROM pages WHERE id = :id");
$arr = array(
		'id' => $_POST['id']
	);

$database->arrayBinderInt($query, $arr);

if ($query->execute()) {
	echo(true);
} else {
	echo(false);
}