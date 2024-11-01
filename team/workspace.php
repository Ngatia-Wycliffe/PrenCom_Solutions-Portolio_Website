<?php require('core/init.php'); ?>
<?php 
	$user = new User;
	$task = new Task;
	$subtask = new Subtask;
	$template = new Template('templates/workspace.php');

	if (isset($_SESSION['member_id'])) {
		$template->teamAdmin = $user->getAccount($_SESSION['member_id']);
		$template->members = $user->getMembers($_SESSION['team_id']);
		$taskid = isset($_GET['id'])?$_GET['id']:null;
		if (isset($taskid)) {
			$template->Task = $task->gettaskInfo($taskid);
			$template->taskID = $taskid;
			$template->taskMembers = $task->getMembersassigned($taskid);
			$template->teamMates = $task->getteamMates($taskid);
			$template->subtasks = $subtask->getSubtasks($taskid);
			$template->todolist  = $subtask->getTodolist($taskid);
			$template->files = $task->getFiles($taskid);
			$template->scheduled_date = $task->getScheduled($taskid);
			$template->scheduleby = $task->getnextScheduled($taskid);
			echo $template;
		}else{
			header('Location:scheduled.php');
		}
		
	}else{
 		header('Location:Login.php');
 	}
	

 ?>