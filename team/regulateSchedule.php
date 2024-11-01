<?php require('core/init.php'); ?>
<?php 
	$task = new Task;
	$interval = $_POST['interval'];
	$taskid = $_POST['task'];
	if ($task->regulateSchedule($interval, $taskid)) {
		echo "Interval Changed";
	}else{
		echo "Something went wrong";
	}
	

 ?>	
