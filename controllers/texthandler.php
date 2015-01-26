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
	
	public function getPageTypeText($page) {
			switch ($page) {
				case "types/page":
					return "Static page";
				break;
				
				case "types/blog":
					return "Blog";
				break;
				
				default:
					return "Custome";
				break;
			}
		}
	public function findAndReplace($s) {
			$s = preg_replace("#(https?://.+\.mp4)#iUs", '<video controls><source src="$1" type="video/mp4">Your browser does not support the video tag.</video>', $s);
			
			return $s;
		}
	
	public function makeClickableLinks($s) {
			//Line break
			$s = preg_replace('@(\n)@', '</p><p>', $s);
			$s = preg_replace('@(\t)@', '<span class="tab"></span>', $s);
			
			$s = preg_replace("#(\[code\](.+)\[/code\])#iUs", "<div class='code'>$2</div>", $s);
			
		
			//text tags
			$bbCode_array = array(
				"b" => "b",
				"em" => "em",
				"h" => "h3",
				"h1" => "h1",
				"h2" => "h2",
				"h3" => "h3",
				
			);
			
			foreach ($bbCode_array as $key => $value) {
				$s = preg_replace("#(\[".$key."\](.+)\[\/".$key."\])#iUs", "<".$value.">$2</".$value.">", $s);
			}
			
			
			$bbCodeClass_array = array(
				"money" => "money",
				"s" => "strike"
				
			);
			
			foreach ($bbCodeClass_array as $key => $value) {
				$s = preg_replace("#(\[".$key."\](.+)\[/".$key."\])#iUs", "<span class='".$value."'>$2</span>", $s);
			}
			
				
			//div class
			$bbCodeDiv_array = array(
				"center" => "align-center",
				"left" => "align-left",
				"right" => "align-right",
				"code" => "code",
				"block-1" => "block-1",
				"block-2" => "block-2",
				"block-3" => "block-3"
				
			);
			
			
			
			foreach ($bbCodeDiv_array as $key => $value) {
				$s = preg_replace("#(\[".$key."\](.+)\[/".$key."\])#iUs", "<div class='".$value."'>$2</div>", $s);
			}
			
			
		
			//icons
			$arr = array(
					't' => '<span class="tab"></span>'
					
				);
		
			foreach ($arr as $key => $value) {
				$s = preg_replace("@(\[\/".$key."\])@", $value, $s);
			}
	
	
			//link
			$s = preg_replace('@(\[url\=(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)\](.+)\[\/url\])@', '<a href="$2" target="_blank">$8</a>', $s);
			$s = preg_replace('@(\[url\](https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)\[\/url\])@', '<a href="$2" target="_blank">$2</a>', $s);
			
			//img
			$s = preg_replace('@(\[img\](https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)\[\/img\])@', '<img src="$2" alt="$6" />', $s);
			
			//link
			$s = preg_replace('@(\[url\=(http?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)\](.+)\[\/url\])@', '<a href="$2" target="_blank">$8</a>', $s);
			$s = preg_replace('@(\[url\](http?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)\[\/url\])@', '<a href="$2" target="_blank">$2</a>', $s);
			
			//img
			$s = preg_replace('@(\[img\](http?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)\[\/img\])@', '<img src="$2" alt="$6" />', $s);
			
			//youtube

			$s = preg_replace("#\[youtube\]http:\/\/(?:www\.)?youtu(?:be\.com\/watch\?v=|\.be\/)([\w\-\_]*)(&(amp;)?[\w\?‌​=]*)?\[\/youtube\]#iUs", '<iframe width="640" height="360" src="//www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>', $s);
			
			$s = preg_replace("#\[youtube\]([a-zA-Z0-9_-]{11})\[\/youtube\]#iUs", '<iframe width="640" height="360" src="//www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>', $s);
	

			
			return $s;
		}
	
}