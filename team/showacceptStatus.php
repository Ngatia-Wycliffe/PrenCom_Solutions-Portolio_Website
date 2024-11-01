<?php require('core/init.php'); ?>
<?php 
	$task = new Task;
	$taskid = $_POST['taskId'];
	$results = array();

	$results = $task->showacceptStatus($taskid);
	$output ='';
	$status = '';
	if($results != false){
		foreach ($results as $value) {
			switch ($value['accepted']) {
				case 0:
					$status = '<label style="color:#17a2b8; font-size:1.4em">Pending...</label>';
					break;
				case 1:
					$status = '<label style="color:#28a745; font-size:1.4em">Accepted</label>';
					break;
				case 2:
					$status = '<label style="color:#dc3545; font-size:1.4em">Rejected</label>';
					break;
			}
			$output .='<tr><td><span><img src="templates/pics/'.$value['profile_pic'].'" class="ck-profile img-thumbnail rounded-circle p-0" alt=""></span></td><td>'.$status.'</td></tr>';
		}
		
		echo $output;
	}else{
		echo "Something Is not right";
	}
 ?>