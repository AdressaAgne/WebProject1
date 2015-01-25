
<div class="row align-center hidden" id="loading">
	<span><i class="fa fa-refresh fa-spin"></i></span>
</div>
<table class="even divider hover border" id="page_table">
	<thead>
		<tr>
			<td><i class="fa fa-link"></i></td>
			<td>Title</td>
			<td>Name</td>
			<td>Menu</td>
			<td>Tool</td>
			<td>Restr</td>
			<td>Grade</td>
			<td>Type</td>
			<td colspan="2"><i class="fa fa-image"></i></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><input type="text" class="negative col-12" required name="url" value="" id="url" placeholder="Url"/></td>
			<td><input type="text" class="negative col-12" required name="title" value="" placeholder="Title"/></td>
			<td><input type="text" class="negative col-12" required name="name" value="" placeholder="Name"/></td>
			<td>
				<div class="form-element inline">
					<label class="">
						<input type="checkbox" class="negative" checked name="menu" value="" />
					</label>
				</div>	
			</td>
				<td>
				<div class="form-element inline">
					<label class="">
						<input type="checkbox" class="negative" name="tool" value="" />
					</label>
				</div>
			</td>
				<td>
				<div class="form-element inline">
					<label class="">
						<input type="checkbox" class="negative" name="restriction" value="" />
					</label>
				</div>
			</td>
			<td>
				<div class="form-element inline right">
					<select name="grade" class="negative">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4" selected="">4</option>
					</select>
				</div>
			</td>
			<td>
				<input list="files" type="text" class="negative col-12" required name="file" value="" placeholder="File name"/>
				<datalist id="files">
					<option value="types/blog">Blog</option>
					<option value="types/page">Page</option>
				</datalist>
			</td>
			<td><input type="text" class="negative col-12" name="image" value="" placeholder="Image"/></td>
			<td>
				<button class="btn negative right" id="add_page"><i class="fa fa-plus"></i></button>
			</td>
		</tr>
		
		<?php foreach ($base->pagestructure as $key => $value) { ?>
			<tr class="page_tr" id="page_<?= $value['id'] ?>">
				<td><a href="<?= $key ?>"><?= $key ?></a></td>
				<td><?= $formating->shortText($value['title'], 0, 10) ?></td>
				<td><?= $value['name'] ?></td>
				<td><?php echo($value['menu'] == 1 ? "<i class='fa fa-check'></i>" : "<i class='fa fa-close'></i>") ?></td>
				<td><?php echo($value['tool'] == 1 ? "<i class='fa fa-check'></i>" : "<i class='fa fa-close'></i>") ?></td>
				<td><?php echo($value['restricted'] == 1 ? "<i class='fa fa-check'></i>" : "<i class='fa fa-close'></i>") ?></td>
				<td><?= $value['grade'] ?></td>
				<td><?= $value['page'] ?></td>
				<td><?= $value['image'] ?></td>
				<td><?php if ($key != '/' && $key != '404') { ?><button class="btn negative" id="deletepage" data-id="<?= $value['id'] ?>"><i class="fa fa-trash"></i></button><?php } ?></td>
			</tr>
			
		<?php } ?>
	</tbody>

</table>

<script>
$(function() {
	
	$("[id*=deletepage]").click(function() {
		var id = $(this).attr("data-id");
		console.log(id);
		
		$.ajax( {
		  type: "POST",
		  url: "/view/admin/ajax/delete_page.php",
		  data: {id: id}
		  }).done(function(data) {
		  	if (data) {
		  		 console.log("Page Deleted");
		  		 $("#page_"+id).hide();
		  	} else {
		  		 console.log("Error: " + data);
		  	}
		  })
		  .fail(function() {
		    console.log("Failed while deleting page, with error: "+data);
		  })
		  .always(function(data) {
		   console.log("Request done.");
		});
		
	});
	
	$("#add_page").click(function() {
		var url = $("[name='url']").val();
		var title = $("[name='title']").val();
		var name = $("[name='name']").val();
		var menu = $("[name='menu']:checked").val();
		var tool = $("[name='tool']").val();
		var restriction = $("[name='restriction']").val();
		var grade = $("[name='grade']").val();
		var file = $("[name='file']").val();
		var image = $("[name='image']").val();
		//"<i class='ball-yellow'></i>" : "<i class='ball-red'></i>"
		$.ajax( {
		  type: "POST",
		  url: "/view/admin/ajax/new_page.php",
		  data: {
		  	url: url,
		  	title: title,
		  	name: name,
		  	menu: menu,
		  	tool: tool,
		  	restriction: restriction,
		  	grade: grade,
		  	file: file,
		  	image: image
		  		}
		  }).done(function(data) {;
		   if (data) {
		   	 console.log("Page added succesfully");
		   } else {
		   	 console.log("Error: " + data);
		   }
		   
		  if(menu == 1) {  menu = "<i class='fa fa-check'></i>" }else{  menu = "<i class='fa fa-close'></i>" };
		  if(tool == 1) {  tool = "<i class='fa fa-check'></i>" }else{  tool = "<i class='fa fa-close'></i>" };
		  if(restriction == 1) {  restriction = "<i class='fa fa-check'></i>" }else{  restriction = "<i class='fa fa-close'></i>" };
		   
		   $("#page_table").append("<tr class='page_tr'>\
		   	<td><a href='"+url+"'>"+url+"</a></td>\
		   	<td>"+title+"</td>\
		   	<td>"+name+"</td>\
		   	<td>"+menu+"</td>\
		   	<td>"+tool+"</td>\
		   	<td>"+restriction+"</td>\
		   	<td>"+grade+"</td>\
		   	<td>"+file+"</td>\
		   	<td colspan='2'>"+image+"</td>\
		   </tr>");
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