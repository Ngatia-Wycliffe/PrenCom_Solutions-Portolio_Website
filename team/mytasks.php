<?php require('core/init.php'); ?>
<?php 
	$user = new User;
	$tasks = new Task;
	$schedule = new Schedule;
	$chat = new Chat;
	$template = new Template('templates/mytasks.php');
	if (isset($_SESSION['member_id'])) {
		$template->teamAdmin = $user->getAccount($_SESSION['member_id']);
		$state = 1;
		$template->tasks = $tasks->getMyTasks($_SESSION['member_id']);
		$template->members = $user->getMembers($_SESSION['team_id']);
		$template->members = $user->getMembers($_SESSION['team_id']);
		$template->messages = $chat->getMymessages($_SESSION['member_id']);
		echo $template;
	}else{
		header('Location: Login.php');
	}
    
 ?>