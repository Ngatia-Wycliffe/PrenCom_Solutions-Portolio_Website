<?php require('core/init.php'); ?>
<?php 
	$task = new Task;
	$subtask = new Subtask;
	$process = $_POST['process'];
	if ($process == 0) {
		# code...
	}elseif ($process == 1) {
		$subtaskid  = $_POST['subtaskid'];
		$completed  = $_POST['completed'];
		$taskid  = $_POST['task'];
		if ($subtask->subtaskCompleted($taskid, $subtaskid, $completed)) {
			if ($completed == 'checked') {
				if ($subtask->checkActivities($subtaskid, $completed)) {
					echo "CheckList Item Completed";
					}
			}else{
				if ($subtask->uncheckActivities($subtaskid, $completed)) {
					echo "Completion Undone";
				}
				
			}
		}else{
			echo "Something Went Wrong";
		}
	}else{
		$activityid  = $_POST['activityid']; 
		$status = $_POST['status'];
		$taskid = $_POST['task'];
		$subtaskid = $_POST['subtask'];
		if($status == 'checked'){
			$completed = 'unchecked';
		}else{
			$completed = 'checked';
		}
		if ($subtask->activityCompleted($activityid, $completed, $subtaskid, $taskid)) {
			$value = ($status == 'checked')?'unchecked':'checked';
			echo $value;
		}else{
			echo " ";
		}
	}
 ?>	
