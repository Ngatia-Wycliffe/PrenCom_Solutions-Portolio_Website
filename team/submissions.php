<?php require('core/init.php'); ?>
<?php 
	$user = new User;
	$tasks = new Task;
	$template = new Template('templates/submissions.php');
	if (isset($_SESSION['member_id'])) {
		$template->teamAdmin = $user->getAccount($_SESSION['member_id']);
		$template->members = $user->getMembers($_SESSION['team_id']);
		$submitted = 1;
		$template->tasks = $tasks->getSubmitted($_SESSION['member_id']);
		echo $template;

	}else{
 		header('Location:Login.php');
 	}
	

 ?>