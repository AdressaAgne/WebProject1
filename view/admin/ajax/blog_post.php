<?php 
include_once("../../../controllers/include.php");
error_reporting(~0);
ini_set('display_errors', 1);

if ($admin->newBlogPost($_POST['id'], $_POST['html'], $_POST['header'], $_POST['user'], $_POST['tags'])) {
	echo("New blog post posted");
}