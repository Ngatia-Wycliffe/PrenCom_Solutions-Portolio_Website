<?php require('core/init.php'); ?>
<?php 
	$task = new Task;
	$approve = $_POST['taskId'];
	$approved = date("Y-m-d");
	if ($task->approveTask($approve, $approved)) {
		echo "Task Approved";
	}else{
		echo "Something went wrong";
	}
	

 ?>	
