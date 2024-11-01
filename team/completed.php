<?php require('core/init.php'); ?>
<?php 
	$user = new User;
	$task = new Task;
	$template = new Template('templates/completed.php');
	
	if (isset($_SESSION['member_id'])) {
		$template->teamAdmin = $user->getAccount($_SESSION['member_id']);
		$template->members = $user->getMembers($_SESSION['team_id']);
		$template->tasks = $task->getApproved($_SESSION['member_id']);
		echo $template;

	}else{
 		header('Location:Login.php');
 	}

 ?>