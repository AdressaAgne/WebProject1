<?php 

class Admin extends Database {

	protected $_page;
	protected $_vars;

	public $admin_structure = array(
		"/pages" => array(
			'id'	=> 	1,
			'name' 	=> 	'<i class="fa fa-files-o fa-fw"></i> Pages',
			'file' 	=> 	'page'
		),
		"/post" => array(
			'id'	=> 	2,
			'name' 	=> 	'<i class="fa fa-pencil fa-fw"></i> New Post',
			'file' 	=> 	'post'
		),
		"/edit" => array(
			'id'	=> 	3,
			'name' 	=> 	'<i class="fa fa-edit fa-fw"></i> Edit Page',
			'file' 	=> 	'edit_page'
		),
		"/accounts" => array(
			'id'	=> 	3,
			'name' 	=> 	'<i class="fa fa-user fa-fw"></i> Accounts',
			'file' 	=> 	'account'
		),
		"/media" => array(
			'id'	=> 	3,
			'name' 	=> 	'<i class="fa fa-image fa-fw"></i> Media',
			'file' 	=> 	'media'
		),
		"/theme" => array(
			'id'	=> 	3,
			'name' 	=> 	'<i class="fa fa-tint fa-fw"></i> Theme',
			'file' 	=> 	'theme'
		)
	);

	private function _completeUrl($page) {
		return "pages/".$page.".php";
	}

	public function get_content($var) {
		
		return $this->_completeUrl($this->admin_structure[$var]['file']);
	}

	public function newPage($id) {
		
		$query = $this->_db->prepare("INSERT INTO Static_page (html, page_id) VALUES ('<p>New static page</p>', ".$id.")");
		
		return $query->execute();
	}
	
}