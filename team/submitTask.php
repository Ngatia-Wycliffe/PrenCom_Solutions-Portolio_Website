<?php require('core/init.php'); ?>
<?php 
	$task = new Task;
	$taskid = $_POST['taskId'];
	$submitted = date("Y-m-d");
	if ($task->submitTask($taskid, $submitted)) {
		echo "Task Submitted";
	}else{
		echo "Something went wrong";
	}
	

 ?>	
