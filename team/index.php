<?php require('core/init.php'); ?>
<?php 
	$user = new User;
	$task = new Task;
	$project = new Project;
	$notification = new Notification;
	
	$template = new Template('templates/frontpage.php');
 	if (isset($_SESSION['member_id'])) {
 		$template->teamAdmin = $user->getAccount($_SESSION['member_id']);
 		$template->fewnotifications = $notification->getfewNotifications($_SESSION['member_id']);
 		$template->newMessages = $notification->checkNewmessages($_SESSION['member_id']);
 		if ($user->checkMembers($_SESSION['member_id'], $_SESSION['team_id'])) {
		$template->anyMembers = true;
		$template->members = $user->getMembers($_SESSION['team_id']);
		} else {
			$template->anyMembers = false;
		}
		echo $template;
 		
 	}else{
 		header('Location:Login.php');
 	}
 	

	

	

 ?>