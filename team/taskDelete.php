<?php require('core/init.php'); ?>
<?php 
	$task = new Task;
	$subtask = new Subtask;
	$taskId = htmlspecialchars($_POST['taskId']);
	$state = 0;
	$process = isset($_POST['process'])?$_POST['process']:0;

	if ($process == 0) {
		if ($task->deleteTask($taskId)) {
		$tasks = $task->getAllTasks($state, $_SESSION['member_id']);
		if (empty($tasks)) {
			echo json_encode(0);
		}else{
			echo json_encode(1);
		}
		}else{
			echo "Something Went Wrong";
		}

	}elseif($process == 1){
		if ($subtask->deletesubTask($taskId)) {
			echo true;
		}else{
			echo false;
		}
	}else{
		if ($subtask->deleteActivity($taskId)) {
			echo true;
		}else{
			echo false;
		}	
	}
	

 ?>