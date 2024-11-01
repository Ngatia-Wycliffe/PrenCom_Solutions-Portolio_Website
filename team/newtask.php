  <?php require('core/init.php'); ?>
<?php 
	$task = new task;
	$subtask = new Subtask;
	$taskname = htmlspecialchars($_POST['taskname']);
	$state = 0;
	$process = isset($_POST['process'])?$_POST['process']:0;

	if($process == 0){
		if ($task->addTask($taskname, $state, $_SESSION['member_id'])) {
			$lastID = $task->lastInserted();
			echo 'New Task Created<value id="lastID" class="mem">'.$lastID.'</value>';	
		
		} else {
				if ($user->addMember($_SESSION['team_id'], $email)) {
				echo "<div style='color: red; font:1.2em;'>Something went Wrong</ div>";	
			} 
			
		}	
	}else{
		$taskid = $_POST['taskid'];
		if ($subtask->addsubTask($taskid, $taskname)) {
			$lastID = $task->lastInserted();
			echo 'Subtask Created<value id="lastID" class="mem">'.$lastID.'</value>';	
		
		} else {
				if ($user->addMember($_SESSION['team_id'], $email)) {
				echo "<div style='color: red; font:1.2em;'>Something went Wrong</ div>";	
			} 
			
		}	
	}
	
	
	

 ?>