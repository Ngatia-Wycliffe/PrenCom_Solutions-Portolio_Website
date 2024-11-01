<?php require('core/init.php'); ?>
<?php 
	$notification = new Notification;
	$task = new Task;
	$tasktitle = '';
	$taskid = $_POST['taskID'];
	$memberid = $_POST['memberid'];
	$taskdetails = $task->rejectTask($taskid, $memberid);
	
	foreach ($taskdetails as $detail) {
			$tasktitle = $detail['title'];
		}
	if ($notification->taskRejected($tasktitle, $_SESSION['team_id'], $_SESSION['member_id'], $_SESSION['name'])){
			echo "Task Rejected";
			}else{
			echo "Something Went Wrong";
			}
	
 ?>