<?php require('core/init.php'); ?>
<?php 
	if(isset($_POST['logOut'])){
		$user = new User;
		if ($user->logOut()) {
			redirect('Login.php','You have Logged Out Successfully','success');
		} else {
			redirect('index.php');
		}
		
	}

 ?>
 