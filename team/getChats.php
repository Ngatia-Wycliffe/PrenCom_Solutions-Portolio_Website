<?php require('core/init.php'); ?>
<?php 
	$chat = new Chat;
	$lastchat = $_POST['lastchat'];
	if (isset($_POST['chatroom'])) {
		$chatroom = 1;
		$chatmate = $_POST['chatmate'];
		$me = $_POST['me'];
		$newchats = $chat->loadNewchats($chatroom,$lastchat, $chatmate, $me);
		print $newchats;
	}else{
		$chatroom = 0;
		$chatmate = 0;
		$me = 0;
		$newchats = $chat->loadNewchats($chatroom,$lastchat, $chatmate, $me);
		print $newchats;
	}
	
 ?>