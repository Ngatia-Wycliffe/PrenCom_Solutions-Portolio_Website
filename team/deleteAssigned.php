<?php require('core/init.php'); ?>
<?php 
	$task = new Task;
	$taskId = htmlspecialchars($_POST['taskId']);
	$state = 0;
	
	if ($task->deleteAssigned($taskId)) {
		$tasks = $task->getAllTasks($state, $_SESSION['member_id']);
		if (empty($tasks)) {
			echo json_encode(0);
		}else{
			echo json_encode(1);
		}
	}else{
		echo "Something Went Wrong";
	}

 ?>