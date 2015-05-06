<?php

class StaticPage extends Database{
	
	public function get_static_content($id) {
		
		$query = $this->_db->prepare("SELECT * FROM Static_page INNER JOIN pages ON pages.id = Static_page.page_id WHERE Static_page.page_id = :id");
		$arr = array(
			'id' => $id
		);
		$this->arrayBinder($query, $arr);
		if ($query->execute()) {
			$row = $query->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		
	}
	
	
	public function get_blog_post($link) {
		
		$query = $this->_db->prepare("SELECT * FROM blog WHERE permalink = :link");
		$arr = array(
			'link' => $link
		);
		$this->arrayBinder($query, $arr);
		
		if ($query->execute()) {
			$row = $query->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		
	}
	
}