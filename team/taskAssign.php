<?php require('core/init.php'); ?>
<?php 
	$task = new Task;
	$selected = array();
	$data = array();
	$state = 1;
	$members = isset($_POST['members'])?$_POST['members']:null;
	$processType = isset($_POST['processType'])?$_POST['processType']:null;
	$data['taskID'] = isset($_POST['task'])?$_POST['task']:null;
	$data['comment'] = isset($_POST['text'])?$_POST['text']:null;
	$data['deadline'] = isset($_POST['duedate'])?$_POST['duedate']:null;
	$selected = explode(',', $members);
	if ($processType == 0) {
		if (is_uploaded_file($_FILES['attachment']['tmp_name'])) {
		if ($task->uploadFile()) {
			$data['file'] = $_FILES['attachment']['name']; 

			if ($task->assignTask($data, $state, $selected, $_SESSION['team_id'])) {
			echo "Successfully Assigned the task";
			}else{
			echo "Something Went Wrong in assignTask";
			}
		}
		
		}else{
			if ($task->assignTask($data, $state, $selected, $_SESSION['team_id'])) {
			echo "Successfully Assigned the task";
			}else{
			echo "Something Went Wrong in assignTask";
			}
		}
	}elseif ($processType == 1) {
		if ($task->updateAssignTo($data['taskID'], $selected, $_SESSION['team_id'])) {
			
		}
	}else{

	}
	


 ?>	
