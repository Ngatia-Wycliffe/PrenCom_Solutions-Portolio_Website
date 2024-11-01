<?php require('core/init.php'); ?>
<?php 
	$chat = new Chat;
	$message = $_POST['message'];
	if(isset($_POST['chatroom'])){
		$chatroom = 1;
		$chatmate = $_POST['chatmate'];
		if($chat->sendChat($chatroom, $message, $chatmate, $_SESSION['member_id'], $_SESSION['fname'], $_SESSION['lname'], $_SESSION['mypic'])){
			echo true;
		}else{
			echo false;
		}
	}else{
		$chatroom = 0;
		$chatmate = 0;
		if($chat->sendChat($chatroom, $message, $chatmate, $_SESSION['member_id'], 0, 0, $_SESSION['mypic'])){
			echo true;
		}else{
			echo false;
		}
	}
	

 ?>