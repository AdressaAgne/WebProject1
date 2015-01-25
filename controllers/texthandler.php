<?php 

class TextHandler {

	public function removeText($r, $t) {
		return preg_replace('#('.$r.')#iUs', '', $t);
	}
	

	public function surroundText($regex, $replace, $sting) {
		return preg_replace('#('.$regex.')#iUs', $replace , $sting);
	}
	
	public function shortText($text, $i, $j) {
		if (strlen($text) > $j) {
			return substr($text, $i, $j)."...";
		} else {
			return $text;
		}
	}
	
}