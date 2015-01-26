
<?php 
include("editor_menu.php");
$btnSelection = $bigEditor;
?>			
	<div class="row">
		<div class="tag">
				<ul class="comment-icons">
		<?php 
		
			for ($i = 0; $i < count($btnSelection); $i++) {
				if (isset($btnSelection[$i]['break'])) {
					echo("</ul><ul class='comment-icons'>");
				} else {
				echo(" <li");
				
					if (isset($btnSelection[$i]['data-class'])) {
						echo(' data-class="'.$btnSelection[$i]["data-class"].'"');
					}
					if (isset($btnSelection[$i]['data-type'])) {
						echo(' data-type="'.$btnSelection[$i]["data-type"].'"');
					}
					
					if (isset($btnSelection[$i]['data-start'])) {
						echo(' data-start="'.$btnSelection[$i]["data-start"].'"');
					}
					if (isset($btnSelection[$i]['data-close'])) {
						echo(' data-close="'.$btnSelection[$i]["data-close"].'"');
					}
					
					if (isset($btnSelection[$i]['data-tip'])) {
						echo(' data-tip="'.$btnSelection[$i]["data-tip"].'"');
					}
					
					echo(' class="');
					if (isset($btnSelection[$i]['class'])) {
						echo($btnSelection[$i]['class']);
					} else {
						echo("");
					}
					echo('">');
					
					
					if (isset($btnSelection[$i]['icon'])) {
						echo('<i class="fa fa-'.$btnSelection[$i]["icon"].'"></i>');
					}
					if (isset($btnSelection[$i]['text'])) {
						echo($btnSelection[$i]["text"]);
					}
					if (isset($btnSelection[$i]['tooltip'])) {
						echo('<ul class="tooltip"><li>'.$btnSelection[$i]["tooltip"].'</li></ul>');
					} 
					
					if (isset($btnSelection[$i]['data-class'])) {
						
						if ($btnSelection[$i]['data-class'] == "dropdown") {
						
							
						
							echo("<ul class='dropdown'>");
							for ($j = 0; $j < count($btnSelection[$i]['content']); $j++) {
								echo("<li");
								
									if (isset($btnSelection[$i]['content'][$j]['data-class'])) {
										echo(' data-class="'.$btnSelection[$i]['content'][$j]["data-class"].'"');
									}
									if (isset($btnSelection[$i]['content'][$j]['data-type'])) {
										echo(' data-type="'.$btnSelection[$i]['content'][$j]["data-type"].'"');
									}
									
									echo(' class="');
									if (isset($btnSelection[$i]['content'][$j]['class'])) {
										echo($btnSelection[$i]['content'][$j]['class']);
									} else {
										echo("btn");
									}
									echo('">');
								
								
									if (isset($btnSelection[$i]['content'][$j]['icon'])) {
										echo('<i class="'.$btnSelection[$i]['content'][$j]["icon"].'"></i>');
									}
									if (isset($btnSelection[$i]['content'][$j]['tooltip'])) {
										echo('<ul class="tooltip"><li>'.$btnSelection[$i]['content'][$j]["tooltip"].'</li></ul>');
									} 
								
								echo("</li>");
							}

								
							echo("</ul>");
							
						}
						
					}
					
				echo("</li>");
				}
			} ?>
				
	<li id="trash" class="right"><i class="fa fa-trash"></i>
		<ul class="tooltip">
			<li>Clear</li>
		</ul>
	</li>
</ul>
</div>
	<form method="post" action="">
		<div class="editor-body">
			<textarea id="editor" name="html" rows="20"class="modern-textarea full" placeholder=""></textarea>
		</div>
	
	
		<div class="row">
			<div class="col-12">
				<button class="btn negative right" type="button" id="preview-btn">Preview</button>
				<input type="hidden" name="name" value="" placeholder="User" />
				<button type="submit" class="btn negative right" name="submit">Post</button>
			</div>
		</div>
		</form>
	</div>	
	
	<div class="row">
		<div class="col-12" id="preview">
		
		</div>
	</div>

<script>
$(function() {
	var len_prefix = "Characters: ";
	var word_prefix = "Words: ";
	$("li[data-class='icon']").click(function() {
		changeText("[/"+$(this).attr("data-type")+"]");
		updateStatusBar();
		updatePreview();
	});
	
	$("#preview-btn").click(function() {
		updatePreview();
	});
	
	function updatePreview() {
		bb = $("#editor").val();
		$.ajax({
		  type: "POST",
		  url: "/modules/editor/editor_preview.php",
		  data: { html: bb}
		}).done(function( data ) {
		    $("#preview").html(data);
		  });
		
		
		updateStatusBar();
	}
	
	
	$("li[data-class='style']").click(function() {
		replaceTextBB("editor", $(this).attr("data-type"), $(this).attr("data-type"));
		updateStatusBar();
		updatePreview();
	});
	
	$("li[data-class='special']").click(function() {
		replaceTextBB("editor", $(this).attr("data-start"), $(this).attr("data-close"));
		updateStatusBar();
		updatePreview();
	});
	
	$("li[data-tip]").hover(function() {
		$("#tip").html("tip: "+$(this).attr("data-tip"));
	});
	
	$("li[data-class='dropdown']").click(function() {
		$(this).find("ul.dropdown li").toggle();
		$(this).find("ul.dropdown").toggle();
	});
	
	$("#trash").click(function() {
		$("#editor").val('');
		$("#editor").focus();
		updatePreview();
	});
	
	$("#editor").keyup(function() {
		updateStatusBar();
	}).keydown(function() {
		updateStatusBar();
	}).keypress(function() {
		updateStatusBar();
	}).change(function() {
		updateStatusBar();
	});;
	
	function updateStatusBar() {
//		var editor = $("#editor").val();
//		var len = editor.length;
//		
//		
//		$("#len").text(len_prefix + len);
//		
//
//		if (editor.match(/\S+/g).length <= 0) {
//			var words = 0;
//		} else {
//			var words = editor.match(/\S+/g).length;
//		}
//		$("#words").text(word_prefix + words);
	}
	
	function changeText(text) {
		var output_text = text;
		replaceText("editor", output_text);
	}
	
	function replaceText(id, text) {
		var editor = $("#" + id);
		var len = editor.val().length;
		var start = editor[0].selectionStart;
		var end = editor[0].selectionEnd;
		
		var focusPoint = start + text.length;
		
		var selectedText = editor.val().substring(start, end);
	
		editor.select().val(editor.val().substring(0, start) + text + editor.val().substring(end, len));
	}	
	
	function replaceTextBB(id, tagStart, tagEnd) {
		
		var editor = $("#" + id);
		var len = editor.val().length;
		var start = editor[0].selectionStart;
		var end = editor[0].selectionEnd;
		
		
		var selectedText = editor.val().substring(start, end);
		var text = "[" + tagStart + "]" + selectedText + "[/" + tagEnd + "]";
		console.log("var's set");
		
		editor.select().val(editor.val().substring(0, start) + text + editor.val().substring(end, len));
		console.log("Applying text");
	}
	
	$.fn.selectRange = function(start, end) {
		if (!end) end = start;
		return this.each(function() {
			if (this.setSelectionRage) {
				this.focus();
				this.setSelectionRage(start, end);
			} else if (this.createTextRage) {
				var range = this.createTextRange();
				range.collapse(true);
				range.moveEnd('character', end);
				range.moveStart('character', start);
				range.select();
				
			}
		});
	};
	
});

</script>