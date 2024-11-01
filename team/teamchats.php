<?php require('core/init.php'); ?>
<?php
	$user = new User;
	$chat = new Chat;
	$template = new Template('templates/teamchats.php');
	$chatroom = 0;
	$chatmate = 0;
	$me = 0;
	if (isset($_SESSION['member_id'])) {
		$template->teamAdmin = $user->getAccount($_SESSION['member_id']);
		$template->members = $user->getMembers($_SESSION['team_id']);
		$template->chats = $chat->getAllChats();
		$template->lastchat =$chat->getlastchat($chatroom, $chatmate, $me);
		echo $template;

	}else{
 		header('Location:Login.php');
 	}
	

 ?>