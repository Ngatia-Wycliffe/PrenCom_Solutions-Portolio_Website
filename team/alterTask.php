<?php require('core/init.php'); ?>
<?php 
	$task = new Task;
	$processType = isset($_POST['process'])?$_POST['process']:null;
	if ($processType != 1) {
		$taskID = $_POST['task'];
		$column = $_POST['column'];
		$value = $_POST['value'];
		if ($task->alterTask($taskID, $column, $value)) {
		echo "Successfully Altered!";
	}else{
		echo "Could not be Altered!!";
	}
	}else{
		$file = $_POST['file'];
		if ($task->deleteFile($file)) {
			echo "File Deleted";
		}else{
			echo "Something went Wrong";
		}
	}
	
 ?>	
