<?php require('core/init.php'); ?>
<?php 
	$user = new User;
	$task = new Task;
	$subtask = new Subtask;
	$template = new Template('templates/taskdetails.php');
	
	if (isset($_SESSION['member_id'])) {
		$template->teamAdmin = $user->getAccount($_SESSION['member_id']);

		$taskid = isset($_GET['id'])?$_GET['id']:null;
		if (isset($taskid, $_SESSION['member_id'])) {
			$template->Task = $task->getTask($taskid, $_SESSION['member_id']);
			$template->taskID = $taskid;
			$template->members = $user->getMembers($_SESSION['team_id']);
			$template->taskMembers = $task->getMembersassigned($taskid);
			$template->subtasks = $subtask->getSubtasks($taskid);
			$template->files = $task->getFiles($taskid);
			echo $template;
		}else{
			header('Location:tasks.php');
		}
		

	}else{
 		header('Location:Login.php');
 	}
	

 ?>