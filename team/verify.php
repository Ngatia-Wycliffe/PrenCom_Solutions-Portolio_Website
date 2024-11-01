<?php require('core/init.php'); ?>
<?php 
	$user = new User;
	$email = htmlspecialchars($_POST['email']);
	
	if ($user->emailExists($email)) {
	
		echo "<div style='color: red; font:1.2em;'>The Email Already Exists</div>";
	} else {
			if ($user->addMember($_SESSION['team_id'], $email)) {
			echo "Link has been Sent";		
		} 
		
	}
	

 ?>