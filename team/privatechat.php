<?php require('core/init.php'); ?>
<?php 
	$user = new User;
	$task = new Task;
	$chat = new Chat;
	$template = new Template('templates/privatechat.php');

	if (isset($_SESSION['member_id'])) {
		$template->teamAdmin = $user->getAccount($_SESSION['member_id']);
		$currentchat = isset($_GET['id'])?$_GET['id']:null;
		$template->members = $user->getMembers($_SESSION['team_id']);
		if(isset($currentchat)){
		$chatroom = 1;
		$template->currentchat = $currentchat;
		$template->chats = $chat->getConversation($_SESSION['member_id'], $currentchat);
		$template->chatfriend = $chat->getCurrentchat($currentchat);
		$template->lastchat = $chat->getlastchat($chatroom, $currentchat, $_SESSION['member_id']);
		echo $template;
		}else{
			header("Location:messages.php");
		}
		
	}else{
		header("Location:Login.php");
	}
	

 ?>