<?php require('core/init.php'); ?>
<?php 
	$template = new Template("templates/Login.php");
	$user = new User;

	if(isset($_POST['login'])){

		$email = $_POST['email'];
		$password = $_POST['pwd'];

		if($user->login($email, $password) ){
			redirect('index.php');
			
		} else {
			redirect('Login.php','Invalid Login Credentials', 'error');
		}
		
	}

	echo $template;

 ?>