<?php require('core/init.php'); ?>
<?php 
	$user = new User;
	$template = new Template('templates/addmember.php');

	if (isset($_SESSION['member_id'])) {
		$template->teamAdmin = $user->getAccount($_SESSION['member_id']);
		$template->members = $user->getMembers($_SESSION['team_id']);
		echo $template;
	}else{
 		header('Location:Login.php');
 	}
	

 ?>