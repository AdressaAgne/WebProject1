<?php
	
	include_once("../../controllers/include.php");

			
	echo($formating->makeClickableLinks($formating->findAndReplace(strip_tags($_POST['html']))));
