<?php if (!empty($base->get_var(2))) { ?>
<?php
include("modules/editor/editor_menu.php");

$page_edit = $static->get_static_content($base->get_var(2));

$btnSelection = $bigEditor;
?>

<div class="row">
	<h3>Edit Page <small><?= $page_edit['name'] ?></small></h3>
	<div class="col-4 col-tab-6">
		<div class="form-element">
			<label> Page url
				<input type="text" class="negative col-12" required name="url" value="<?= $page_edit['url'] ?>" id="url" placeholder="Url"/>
			</label>
		</div>
	</div>
	<div class="col-4 col-tab-6">
		<div class="form-element">
			<label> Page Title
				<input type="text" class="negative col-12" required name="title" value="<?= $page_edit['title'] ?>" placeholder="Title"/>
			</label>
		</div>
	</div>
	<div class="col-4 col-tab-6">
		<div class="form-element">
			<label> Page Header
				<input type="text" class="negative" required name="page_name" value="<?= $page_edit['name'] ?>" placeholder="Header"/>
			</label>
		</div>
	</div>
	<div class="col-4 col-tab-6">
		<div class="form-element">
			<label>Menu</label>
		</div>
		<div class="form-element inline">
			<label class="">
				<input type="checkbox" class="negative" checked name="menu" value="" /> Add to Menu
			</label>
		</div>	
	</div>
	<div class="col-4 col-tab-6">
		<div class="form-element">
			<label>Page type <small>Use dropdown for presets</small>
				<input list="files" type="text" class="negative" required name="file" value="<?= $page_edit['file'] ?>" placeholder="File name"/>
			</label>
			<datalist id="files">
				<option value="types/blog">Blog</option>
				<option value="types/page">Page</option>
			</datalist>
		</div>
	</div>
	<div class="col-4 col-tab-6">
		<div class="form-element">
			<label class="">
				<input type="checkbox" class="negative" name="restriction" value="" /> Restricted page
			</label>
			<select name="grade" class="negative">
				<option value="1">Admin Only</option>
				<option value="2">Moderator Only</option>
				<option value="3">User Only</option>
				<option value="4" selected="">Everyone</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="form-element">
			<button class="btn negative" id="save_settings"><i class="fa fa-save"></i> Save</button>
		</div>
	</div>
</div>
		
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
		<div class="editor-body">
			<textarea id="editor" name="html" rows="20"class="modern-textarea full" placeholder=""><?= $page_edit['html'] ?></textarea>
		</div>
	
	
		<div class="row">
			<div class="col-12">
				<button class="btn negative" type="button" id="preview-btn">Preview</button>
				<input id="pageid" type="hidden" name="name" value="<?= $page_edit['page_id'] ?>" placeholder="User" />
				<button id="savePageText" class="btn negative"><i class="fa fa-save"></i> Save</button>
			</div>
		</div>
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
	
	$("#savePageText").click(function() {
		bb = $("#editor").val();
		id = $("#pageid").val();
		$.ajax({
		  type: "POST",
		  url: "/view/admin/ajax/edit_page.php",
		  data: { text: bb, id: id}
		}).done(function( data ) {
		    $("#preview").html(data);
		  });
	});
	
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
	$("#save_settings").click(function() {
		var url = $("[name='url']").val();
		var title = $("[name='title']").val();
		var name = $("[name='page_name']").val();
		if ($("[name='menu']").is(":checked")) {
			menu = 1;
		} else {
			menu = 0;
		}
		if ($("[name='restriction']").is(":checked")) {
			restriction = 1;
		} else {
			restriction = 0;
		}
		var grade = $("[name='grade']").val();
		var file = $("[name='file']").val();
		
		
		$.ajax( {
		  type: "POST",
		  url: "/view/admin/ajax/edit_page_settings.php",
		  data: {
		  	url: url,
		  	title: title,
		  	name: name,
		  	menu: menu,
		  	restriction: restriction,
		  	grade: grade,
		  	type: file,
		  	id: <?= $page_edit['id'] ?>
		  }
		  }).done(function(data) {
		   	console.log(data);
		  })
		  .fail(function() {
		    console.log("Failed while adding page, with error: "+data);
		  })
		  .always(function(data) {
		   console.log("Request done.");
		});
	});
	
});

</script>
	
<?php } else { ?>
		
		<?php foreach ($base->pagestructure as $key => $value) { 
			if ($value['page'] == "types/page") {
				$page_edit = $static->get_static_content($value['id']);
		?>		
			
			<div class="col-4 col-tab-6 col-phone-12">
				<div class="align-center">
					<a href="/admin/edit/<?= $value['id'] ?>"><h3><?= $value['name'] ?> <small><?= $key ?></small></h3></a>
				</div>
				<div class="col-12">
					<div class="fade">
						<?= $formating->makeClickableLinks($page_edit['html']) ?>
						<div class="fade-block"></div>
					</div>
				</div>
			</div>	
			
		<?php }
		 } ?>
	
	
<?php } ?>