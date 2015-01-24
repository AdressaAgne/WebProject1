<?php 
	

	$ini = array(
		"; DataBase\n",
		"\nhost = ".$_POST['host'],
		"\nusername = ".$_POST['username'],
		"\npassword = ".$_POST['password'],
		"\nname = ".$_POST['name'],
		"\n; Settings\n",
		"\nsetup = true"
	);
	
	
	
	$myfile = fopen("../../../controllers/config.ini", "w") or die("Unable to open file!");
	
		foreach ($ini as $key => $value) {
			
			$txt = $value;
			fwrite($myfile, $txt);
			
		}
		
	fclose($myfile);
	