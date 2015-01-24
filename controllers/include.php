<?php 
//pages
require_once("pagehandler.php");

//databases
require_once("pdo.php");
require_once("structure.php");

//controllers
require_once("accountController.php");
require_once("texthandler.php");



$database = new Database();
$base = new Structure();

if (empty($database->config['host'] || empty($database->config['username'])) || empty($database->config['password']) || empty($database->config['name'])) {
	$base->pagestructure['/']['page'] = 'instal';
	$base->pagestructure['404']['page'] = 'instal';
} else {

	if ($database->config['setup'] == true) {
		$query = $database->_db->prepare("CREATE TABLE `pages` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `url` varchar(255) NOT NULL,
		  `title` varchar(255) NOT NULL,
		  `menu` tinyint(1) NOT NULL,
		  `tool` tinyint(1) NOT NULL,
		  `name` varchar(255) NOT NULL,
		  `image` varchar(255) NOT NULL,
		  `file` varchar(255) NOT NULL,
		  `restricted` tinyint(1) NOT NULL,
		  `grade` int(11) NOT NULL,
		  `style` varchar(255) NOT NULL,
		  `footer` tinyint(1) NOT NULL DEFAULT '1',
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;
		INSERT INTO `pages` (`url`, `title`, `menu`, `tool`, `name`, `image`, `file`, `restricted`, `grade`, `style`, `footer`) VALUES ('/admin', 'Admin Panel', 1, 0, 'Admin', '', 'admin/admin', 0, 1, '', 1);");
		if ($query->execute()) {
			
			$ini = array(
				"; DataBase\n",
				"\nhost = ".$database->config['host'],
				"\nusername = ".$database->config['username'],
				"\npassword = ".$database->config['password'],
				"\nname = ".$database->config['name'],
				"\n; Settings\n",
				"\nsetup = false"
			);
			$database->writeIni($ini);
			
		}
	}

	$formating = new TextHandler();
	$account = new AccountController();
	
	$query = $database->_db->prepare("SELECT * FROM pages");
	if ($query->execute()) {
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$new_page = array(
				"id" => $row['id'],
				"title" => $row['title'],
				"name" => $row['name'],
				"page" => $row['file'],
				"menu" => $row['menu'],
				"tool" => $row['tool'],
				"image" => $row['image'],
				"restricted" => $row['restricted'],
				"grade" => $row['grade'],
				"style" => $row['style'],
				'footer' => $row['footer']
			);
			
			if (!isset($base->pagestructure[$row['url']])) {
				$base->pagestructure[$row['url']] = $new_page;
			}
		}
	}
}

