<!DOCTYPE>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<link rel="stylesheet" href="templates/font-awesome-4/css/font-awesome.min.css">
	<link rel="stylesheet" href="templates/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="templates/css/styler.css">
</head>
<body>
 <div class="ck-bgshade">
	<div class="ck-header">
	<div class="ck-logo  pt-0 pl-3 ">
				<h1 class="mb-0"><i><front>Project</front>&nbsp;<line>Control</line></i></h1>
			</div>
	<div class="ck-caption pb-1"><h5>Login to your team Account</h5></div>
		
	</div>
	<div class="ck-section mt-5 ">
			<div class="display-status" id="display">
				<?php displayMessage(); ?>       
			</div>
		<form action="Login.php" method="post" class="ck-form login" enctype="multipart/form-data" >
			
			

			<h3>Login To Join Your Team</h3>
			<div class="form-group mt-1">
				<label >Email</label>
				<input type="email" class="form-control" id="mail" placeholder="Email" name="email" required>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" placeholder="Password" name="pwd" required>
			</div>
			<div class="form-group">
				<input type="submit" name="login" id="login" class="form-control btn btn-primary" value="Login">
			</div>
			<div class="ck-caption">
				<h5>Don't have a team? <a href="teamAccount.php">Create One</a></h5>
			</div>

		</form>
	</div>
	<div class="ck-footer-login pb-2">
		<footer> <p> ProjectControl. <i class="ck-f"> Copyright &copy; 2018.</i> All Rights Reserved. Developed $ Designed by <i class="ck-f"> Ngatia Wycliffe. </i> Powered by <i class="ck-f"> Comp-rite Kenya Limited.</i> </p></footer>
	</div>
	</div>
	<script type="text/javascript" charset="utf-8" async defer>
		
		

	</script>
	<script src="templates/bootstrap/js/jquery.min.js" type="text/javascript"></script>
	<script src="templates/bootstrap/js/bootstrap.js" type="text/javascript"></script>
	<script src="templates/bootstrap/js/popper.js" type="text/javascript"></script>
	<script src="templates/bootstrap/js/tooltip.js" type="text/javascript"></script>
	<script src="templates/myscript.js" type="text/javascript"></script>
	
</body>
</html>