<?php include 'includes/header.php'; ?>

			<div class="ck-view mt-3 ">
			<div class="view-header pl-3 pt-0 pb-0 pr-2">
				<nav class="nav">
					<a class="nav-link ck-active" href="newproject.php">Create Project</a> 
				</nav>
			</div>
			  <div class="ck-panel mt-2 pl-4 pt-2 pb-2 pr-3">
				<form class="ml-5" method="post" action="newproject.php">
					<div class="form-group">
						<label for=""><strong>Project Name:</strong></label>
						<input type="text" class="form-control" id="" name="project" required>
					</div>
					<input name="finish" type="submit" value="Create Project"  class="btn btn-warning">
				</form>	
				<div class ="response-box animated" id="response-box">
					
				</div>

			  </div>
			</div>
		</div>
		<script>
			$(document).ready(function() {
				function taskAlert () {

				 $.ajax({
				 	url: "fetch.php",
				 	method: "POST",
				 	data:{view : view},
				 	success:function (data) {
				 		/* body... */
				 		alert(data);
				 	}
				 });

				 }
			});
		</script>
<?php include 'includes/footer.php'; ?>
		