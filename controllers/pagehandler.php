<?php 
class Base {
	public $pagestructure = [
		'/' => array(
			"id" => 0,
			'title' => 'Home',
			"name" => 'Home',
			"page" => 'main',
			"menu" => 1,
			"tool" => 0,
			"image" => '',
			"restricted" => 0,
			"grade" => 4,
			"style" => '',
			'footer' => 1
		),
		'404' => array(
			"id" => 1,
			'title' => '404 Page not found',
			"name" => '404 Page not found',
			"page" => 'error/404',
			"menu" => 0,
			"tool" => 0,
			"image" => '',
			"restricted" => 0,
			"grade" => 4,
			"style" => '',
			'footer' => 1
		)
		
	];
}