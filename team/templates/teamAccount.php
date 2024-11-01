<!DOCTYPE>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Create Team Account</title>
	<link rel="stylesheet" href="templates/font-awesome-4/css/font-awesome.min.css">
	<link rel="stylesheet" href="templates/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="templates/css/styler.css">
</head>
<body>
 <div class="ck-bgshade">
	<div class="ck-header">
	<div class="ck-logo  pt-0 pl-3 ">
				<h1 class="mb-0"><i><front>Task</front><line>Control</line></i></h1>
			</div>
	<div class="ck-caption pb-1"><h5>Register to create your Team Account</h5></div>
		
	</div>
	<div class="ck-section">
			<div class="display-status" id="display">
				<h4><?php displayMessage(); ?></h4>
			</div>

		<form action="teamAccount.php" method="post" class="ck-form" enctype="multipart/form-data" autocomplete="off">
			
			<div><label for="">Names</label></div>
			<div class="row">
				<div class="col">
					<input type="text" class="form-control" id="first" placeholder="First Name" name="fname" required >
				</div>
				<div class="col">
					<input type="text" class="form-control" id="last" placeholder="Last Name" name="lname" required>
				</div>
			</div>
			
			<div class="form-group mt-1">
				<label for="mail">Email</label>
				<input type="email" class="form-control" id="mail" placeholder="example@email.com" name="email" required>
			</div>
			
			<div class="row">
				<div class="col">
					<div><label for="">Password</label></div>
					<input type="password" class="form-control" id="password" placeholder="Password" name="pwd" required>
				</div>
				<div class="col">
					<div><label for="">Confirm Password</label></div>
					<input type="password" class="form-control" id="confirm" placeholder="Confirm Password" required>
				</div>
			</div>	
					<br>
			<div class="form-group">
				<label for="team-name">Choose your Team Name</label>
				<input type="text" name="team" class="form-control" id="team-name" placeholder="Team Name" required >
			</div>
			<div class="form-group">
				<label for="attachment"><strong class="mr-2">Upload your profile picture</strong></label>
				<input type="file" name="pic" class="form-control-file ml-5" id="attachment" required>
			</div>
			<div class="form-group">
				<input type="submit" name="register" class="form-control btn btn-primary" value="Register">
			</div>
			<div class="ck-caption">
				<h5>Already have a team? <a href="Login.php">Login</a></h5>
			</div>

		</form>
	</div>
	<div class="ck-footer pb-2">
		<footer>TaskControl &copy; 2018</footer>
	</div>
	</div>
	<script type="text/javascript" charset="utf-8" async defer>
		
		var password = document.getElementById("password");
		var confirm = document.getElementById("confirm");
		function validatePassword(){
			if (password.value!= confirm.value) {
				confirm.setCustomValidity("Passwords Don't Match");
			}else{
				confirm.setCustomValidity('');
			}
		}
		password.onchange = validatePassword;
		confirm.onkeyup = validatePassword;

	</script>
	<script src="templates/bootstrap/js/jquery.min.js" type="text/javascript"></script>
	<script src="templates/bootstrap/js/bootstrap.js" type="text/javascript"></script>
	<script src="templates/bootstrap/js/popper.js" type="text/javascript"></script>
	<script src="templates/bootstrap/js/tooltip.js" type="text/javascript"></script>
	<script src="templates/myscript.js" type="text/javascript"></script>
	
</body>
</html>