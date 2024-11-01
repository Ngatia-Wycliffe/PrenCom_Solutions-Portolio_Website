<?php require('core/init.php'); ?>
<?php 
	$task = new Task;
	$task_id = $_POST['task_id'];
	$scheduled = $_POST['scheduled'];
	$member_id = $_POST['member_id'];
	if($task->scheduleTask($task_id, $member_id, $scheduled)){
		echo true;
	}else{
		echo false;
	}
 ?>