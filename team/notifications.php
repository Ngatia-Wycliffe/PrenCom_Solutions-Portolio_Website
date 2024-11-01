<?php require('core/init.php'); ?>
<?php 
	$user = new User;
	$task = new Task;
	$chat = new Chat;
	$notification = new Notification;
	$template = new Template('templates/notifications.php');
	$template->teamAdmin = $user->getAccount($_SESSION['member_id']);

	if (isset($_SESSION['member_id'])) {
		$template->members = $user->getMembers($_SESSION['team_id']);
		// $template->notifications = $chat->getMyNotifications($_SESSION['member_id']);
		echo $template;
	}else{
		header('Location: Login.php');
	}
	

 ?>