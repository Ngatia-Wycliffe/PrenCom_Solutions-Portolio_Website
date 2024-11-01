<?php require('core/init.php'); ?>
<?php 
	$user = new User;
	$task = new Task;
	$template = new Template('templates/assigntask.php');
	
	//Get task from URL
	$taskid = isset($_GET['id'])?$_GET['id']:null;
	$location = isset($_GET['location'])?$_GET['location']:null;
	
	if (isset($_SESSION['member_id'])) {
		if (isset($_POST['finish'])) {
			
		}


		if (isset($taskid, $_SESSION['member_id'])) {
			$template->teamAdmin = $user->getAccount($_SESSION['member_id']);
			$template->mytask = $task->getTask($taskid, $_SESSION['member_id']);
			$template->taskID = $taskid;
			$template->members = $user->getMembers($_SESSION['team_id']);
			$template->assignedTasks = $task->getassignedTasks($_SESSION['team_id']);
		}else{
			header("Location:unassignedTasks.php");
		}
		if (isset($_POST['cancel'])) {
			$task->deleteTask($taskid);
		}


		echo $template;
	}else{
 		header('Location:Login.php');
 	}
	

 ?>