<?php require('core/init.php'); ?>
<?php 
	$task = new Task;
	$unassigned = array();
	$members = isset($_POST['members'])?$_POST['members']:null;
	$task_id = isset($_POST['task'])?$_POST['task']:null;
	$unassigned = explode(',', $members);
	if ($task->deleteAssignees($unassigned, $task_id)) {
		
	}else{
		echo "Something Went Wrong on deleteAssignees";
	}

 ?>