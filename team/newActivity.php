  <?php require('core/init.php'); ?>
<?php 
	$task = new task;
	$subtask = new Subtask;
	$activity = htmlspecialchars($_POST['activityname']);
	$taskid = $_POST['taskid'];
	$parent = $_POST['parent'];

	if ($subtask->addActivity($parent,$activity,$taskid)) {
		$lastID = $subtask->lastInserted();
		echo 'Activity Created<value id="lastID" class="mem">'.$lastID.'</value>';	
			
	}else{
		echo "Something Went Wrong";
	}
	
	
	

 ?>