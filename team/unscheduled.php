<?php require('core/init.php'); ?>
<?php 
	$user = new User;
	$task = new Task;
	$schedule = new Schedule;
	$chat = new Chat;
	$template = new Template('templates/unscheduled.php');
	if (isset($_SESSION['member_id'])) {
		$template->teamAdmin = $user->getAccount($_SESSION['member_id']);
		$state = 1;
		$template->members = $user->getMembers($_SESSION['team_id']);
		$template->members = $user->getMembers($_SESSION['team_id']);
		$template->messages = $chat->getMymessages($_SESSION['member_id']);
		$template->tasks = $task->getUnscheduled($_SESSION['member_id']);
		echo $template;
	}else{
		header('Location: Login.php');
	}
    
 ?>