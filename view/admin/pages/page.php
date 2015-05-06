
<div class="row align-center hidden" id="loading">
	<span><i class="fa fa-refresh fa-spin"></i></span>
</div>
<div class="row">
	<h3>New Page</h3>
	<div class="col-4 col-tab-6">
		<div class="form-element">
			<label> Page url
				<input type="text" class="negative col-12" required name="url" value="" id="url" placeholder="Url"/>
			</label>
		</div>
	</div>
	<div class="col-4 col-tab-6">
		<div class="form-element">
			<label> Page Title
				<input type="text" class="negative col-12" required name="title" value="" placeholder="Title"/>
			</label>
		</div>
	</div>
	<div class="col-4 col-tab-6">
		<div class="form-element">
			<label> Page Header
				<input type="text" class="negative" required name="name" value="" placeholder="Header"/>
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
				<input list="files" type="text" class="negative" required name="file" value="" placeholder="File name"/>
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
			<button class="btn negative" id="add_page"><i class="fa fa-plus"></i> Add page</button>
		</div>
	</div>

</div>

<table class="even divider hover border" id="page_table">
	<thead>
		<tr>
			<td>Page Url</td>
			<td>Title</td>
			<td>Name</td>
			<td>Menu</td>
			<td>Restr</td>
			<td>Grade</td>
			<td>Type</td>
			<td colspan="2"></td>
		</tr>
	</thead>
	<tbody>		
		<?php foreach ($base->pagestructure as $key => $value) { 
		
		
		?>
			<tr class="page_tr" id="page_<?= $value['id'] ?>">
				<td><a href="<?= $key ?>"><?= $key ?></a></td>
				<td><?= $formating->shortText($value['title'], 0, 20) ?></td>
				<td><?= $value['name'] ?></td>
				<td class="align-center" width="60"><?php echo($value['menu'] == 1 ? "<i class='fa fa-check'></i>" : "<i class='fa fa-close'></i>") ?></td>
				<td class="align-center" width="60"><?php echo($value['restricted'] == 1 ? "<i class='fa fa-check'></i>" : "<i class='fa fa-close'></i>") ?></td>
				<td class="align-center" width="60"><?= $value['grade'] ?></td>
				<td width="120"><?= $formating->getPageTypeText($value['page']) ?></td>
				<td width="60">
				<?php if ($formating->getPageTypeText($value['page']) != 'Custome') { ?>
					<a href="/admin/edit/<?= $value['id'] ?>" style="display: block;" class="btn negative" id="edit" data-id="<?= $value['id'] ?>"><i class="fa fa-edit"></i></a>
				<?php } ?></td>
				<td width="60"><?php if ($key != '/' && $key != '404') { ?><a href="" style="display: block;" class="btn danger" id="deletepage" data-id="<?= $value['id'] ?>"><i class="fa fa-trash"></i></a><?php } ?></td>
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
		if ($("[name='menu']").is(":checked")) {
			menu = 1;
		} else {
			menu = 0;
		}
		if ($("[name='tool']").is(":checked")) {
			tool = 1;
		} else {
			tool = 0;
		}
		if ($("[name='restriction']").is(":checked")) {
			restriction = 1;
		} else {
			restriction = 0;
		}
		var grade = $("[name='grade']").val();
		var file = $("[name='file']").val();
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
		  	file: file
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
		   	<td colspan='2'></td>\
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