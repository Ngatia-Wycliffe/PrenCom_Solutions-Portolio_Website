<?php require('core/init.php'); ?>
<?php 
	$task = new Task;
	$notification = new Notification;
	$taskid = isset($_POST['taskID'])?$_POST['taskID']:null;
	$memberid = isset($_POST['memberid'])?$_POST['memberid']:null;
	$process = isset($_POST['process'])?$_POST['process']:0;
	if ($process == 0) {
		if ($task->acceptTask($taskid, $memberid)) {
		# code...
			echo "TASK ACCEPTED";
		}else{
			echo "Something Went";
		}
	}elseif ($process == 1) {
		if($notification->updatestatus($memberid)){
			echo "Notification read";
		}
		else{
			echo "Something went wrong";
		}
	}else{
		if($notification->updateMsgstatus($memberid)){
			echo "Message read";
		}
		else{
			echo "Something went wrong";
		}
	}
	

	 
 ?>