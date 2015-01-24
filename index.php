<?php 

	//error_reporting(~0);
	//ini_set('display_errors', 1);
	session_start();
	
	//pages
	require_once("controllers/include.php");
	
	if ($base->get_restriction()) {
		if (isset($_SESSION['rank']) && ($_SESSION['rank'] < $base->get_grade())) {
			
		} else {
			header("location: /forbidden");
		}
	}
		
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Agne Ødegaard" />
	<meta name="description" content="" />
	<meta name="application-name" content="Web Project 1" />
	
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Apple Device: App-->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	
	<!-- Apple Device: Remove Status bar-->
	<meta name="apple-mobile-web-app-status-bar-style" content=“black”>
	
	<!--	Getting page title-->
	<title><?php echo($base->get_title()); ?></title>
	
	<!--Main css-->
	<link rel="stylesheet" href="/css/main.css" />
	
	<!--Favicon
	[if IE]>
		<link rel="shortcut icon" href="/img/ico/iconX32.ico">
	<![endif]
	<link rel="icon" href="/img/ico/iconX96.png" />
	-->
	<!--Font Awesome-->
	<link rel="stylesheet" href="/css/font-awesome.min.css" />
	
	<?php if (!empty($base->get_styles())) { ?>
		<!-- Alternative Style -->
		<link rel="stylesheet" href="<?= $base->get_styles()?>" />
	<?php } ?>
	
	<!-- Apple Device: Home Screen icon-->
	<link rel="apple-touch-icon" sizes="76x76" href="/img/apple/iconX76_bg.png" />
	<link rel="apple-touch-icon" sizes="120x120" href="/img/apple/iconX120_bg.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="/img/apple/iconX152_bg.png" />
	
	
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!--jQuery-1.11.1.min-->
	<script src="/js/min/jquery.js"></script>
	
	<!--Main Javascript-->
	<script src="/js/min/main-min.js" type="text/javascript"></script>

</head>
<body>
		
<!--	Menu	-->		

<div class="menu clearfix">
	<div class="container">
		<ul class="">
			<li class="head"></li>
		<?php //fetching each page to display on the menu
			foreach ($base->pagestructure as $key => $value) {
				if (isset($value['menu']) && $value['menu'] == true) {
					echo("<li><a class='tag' href='".$key."'>".$value['name']."</a></li>");
				}
			} ?>
		</ul>
		<!--<ul class="right">
		<?php if (!isset($_SESSION['ign'])) { ?>
			<li><a class='tag' href='#login_box' id="login_btn">Login</a></li>
			<li><a class='tag' href='#login_box' id="registarte_btn">Register</a></li>
		<?php } else { ?>	
			<?php if ($_SESSION['rank'] < 3) {
				echo("<li><a class='tag' href='/admin'><i class='icon-".$_SESSION['rank']." small'></i></a></li>");
			} ?>
			<li><a class='tag' href='/user'><?= $_SESSION['ign'] ?></a></li>
			<li><a class='tag' href='/logout'>Logout</a></li>
		<?php } ?>
		</ul>-->
	</div>
</div>
<!--	end Menu	-->	

	
	<?php if (isset($_GET['error'])) {
		echo($_GET['error']);
	} ?>
	
	
<!--	Content	-->
	<?php include($base->get_content()); ?>
<!--	end content	-->

		
<?php if ($base->get_footer()) { ?>
<!--	Footer of the page	-->

	<div class="container clearfix">
		<div class="row">
			<!-- Footer -->
		</div>
	</div>
<!--	end Footer	-->		
<?php } ?>

</body>
</html>