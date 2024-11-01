<?php require('core/init.php'); ?>
<?php 
	$user = new User;
	$task = new Task;
	$template = new Template('templates/dashboard.php');

	if (isset($_SESSION['member_id'])) {
		$template->teamAdmin = $user->getAccount($_SESSION['member_id']);
		$template->members = $user->getMembers($_SESSION['team_id']);
		$template->tasks = $task->getAssignedTasks2($_SESSION['member_id']);
		$template->totalTasks = $task->gettotalTasks($_SESSION['member_id'],20);
		$template->totalUnassigned = $task->gettotalTasks($_SESSION['member_id'],0);
		$template->totalAssigned = $task->gettotalTasks($_SESSION['member_id'],1);
		$template->totalCompleted = $task->gettotalTasks($_SESSION['member_id'],2);
		echo $template;
	}else{
 		header('Location:Login.php');
 	}
	

 ?>