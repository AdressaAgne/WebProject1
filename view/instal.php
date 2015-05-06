<div class="container">

	<div class="row">
		<form method="post" action="">
			<div class="col-6 col-offset-3 tag">
				<div class="page-header align-center">
					<h1>Database setup</h1>
				</div>
				<div class="form-element">
					<label>Database Host <small>localhost</small>
						<input type="text" class="" name="host" value="" placeholder="Host" />
					</label>
				</div>
				<div class="form-element">
					<label>Database Username <small>root</small>
						<input type="text" class="" name="username" value="" placeholder="Username" />
					</label>
				</div>
				<div class="form-element">
					<label>Database Password <small>root</small>
						<input type="password" class="" name="password" value="" placeholder="Password" />
					</label>
				</div>
				<div class="form-element">
					<label>Database Name
						<input type="text" class="" name="name" value="" placeholder="Database" />
					</label>
				</div>
				
				<div class="form-element align-center">
					<br />
					<button class="btn big" id="install" name="install" />Install Database</button>
				</div>
			</div>
		</form>
	</div>

</div>

<script>
	$(function() {	
		$("#install").click(function() {
			var host = $("[name='host']").val();
			var username = $("[name='username']").val();
			var password = $("[name='password']").val();
			var name = $("[name='name']").val();
			
			$.ajax( {
				type: "POST",
			  	url: "/view/admin/ajax/install.php",
			  	data: {
			  		host: host,
			  		username: username,
			  		password: password,
			  		name: name
			 	 }
			  }).done(function(data) {
			   		console.log(data);
			   		
			   		location.href = "/";
			  }).fail(function() {
			    	console.log("Adding config.ini failed: "+data);
			  }).always(function(data) {
			   		console.log("Request done.");
			  });
			  return false;
		});
	
	});
</script>