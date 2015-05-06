<?php 
//pages
require_once("pagehandler.php");

//databases
require_once("pdo.php");
require_once("structure.php");

//controllers
require_once("adminController.php");
require_once("accountController.php");
require_once("pageController.php");
require_once("texthandler.php");

$database = new Database();
$admin = new Admin();
$base = new Structure();
$static = new StaticPage();

$formating = new TextHandler();
$account = new AccountController();


if (empty($database->config['host'] || empty($database->config['username'])) || empty($database->config['password']) || empty($database->config['name'])) {
	$base->pagestructure['/'] = array(
		'page' => 'instal',
		'title' => 'Database setup',
		'footer' => true,
		'style' => ""
	);
	$base->pagestructure['404']['page'] = 'instal';
} else {
	
	if (file_exists("controllers/config.ini")) {
	
		if ($database->config['setup'] == true) {
			$query = $database->_db->prepare("
			
			CREATE TABLE `pages` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `url` varchar(255) NOT NULL,
			  `title` varchar(255) NOT NULL,
			  `menu` tinyint(1) NOT NULL,
			  `name` varchar(255) NOT NULL,
			  `file` varchar(255) NOT NULL,
			  `restricted` tinyint(1) NOT NULL,
			  `grade` int(11) NOT NULL,
			  `style` varchar(255) NOT NULL,
			  `footer` tinyint(1) NOT NULL DEFAULT '1',
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
			
			CREATE TABLE `Static_page` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `html` text NOT NULL,
			  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  `page_id` int(11) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
			
			CREATE TABLE `blog` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `page_id` int(11) NOT NULL,
			  `text` text NOT NULL,
			  `header` text NOT NULL,
			  `permalink` varchar(255) NOT NULL,
			  `user_id` int(11) NOT NULL,
			  `tags` text NOT NULL,
			  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
			
			
			INSERT INTO `pages` 
			(`url`, `title`, `menu`, `name`, `file`, `restricted`, `grade`, `style`, `footer`) VALUES
			('/', 'Home', 1, 'Home', 'types/page', 0, 4, '', 1),
			('/404', '404 Page not found', 0, '404 Page not found', 'types/page', 0, 4, '', 1),
			('/403', '403 No access', 0, '403 No access', 'types/page', 0, 4, '', 1),
			('/admin', 'Admin Panel', 1, 'Admin', 'admin/admin', 0, 1, '', 1),
			('/archive', 'Blog Archive', 0, 'Blog Archive', 'archive', 0, 4, '', 1);
			
			INSERT INTO `Static_page` (`html`, `time`, `page_id`) VALUES
			('This is your home screen', '2015-01-26 04:47:31', 1),
			('404 Page not found', '2015-01-26 04:47:31', 2),
			('403 No access', '2015-01-29 08:45:42', 3);
			
			");
			if ($query->execute()) {
				
				$ini = array(
					"; DataBase\n",
					"\nhost = ".$database->config['host'],
					"\nusername = ".$database->config['username'],
					"\npassword = ".$database->config['password'],
					"\nname = ".$database->config['name'],
					"\n\n; Settings\n",
					"\nsetup = false"
				);
				$database->writeIni($ini);
				
			}
		}
		
		$query = $database->_db->prepare("SELECT * FROM pages");
		if ($query->execute()) {
			while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
				$new_page = array(
					"id" => $row['id'],
					"title" => $row['title'],
					"name" => $row['name'],
					"page" => $row['file'],
					"menu" => $row['menu'],
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
}

