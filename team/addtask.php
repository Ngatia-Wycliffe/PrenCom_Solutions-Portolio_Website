<?php require('core/init.php'); ?>
<?php 
	$user = new User;
	$task = new Task;
	$template = new Template('templates/addtask.php');

	if (isset($_SESSION['member_id'])) {
		$template->teamAdmin = $user->getAccount($_SESSION['member_id']);
		$template->members = $user->getMembers($_SESSION['team_id']);
		if(isset($_POST['finish'])){
			$title = $_POST['tasktitle'];
			$state = 0;
			$task->addTask($title, $state, $_SESSION['member_id']);
		}
		else if (isset($_POST['assign'])) {
			$title = $_POST['tasktitle'];
			$state = 1;
			$task->addTask($title, $state, $_SESSION['member_id']);
		}
		echo $template;

	}else{
 		header('Location:Login.php');
 	}
	

 ?>