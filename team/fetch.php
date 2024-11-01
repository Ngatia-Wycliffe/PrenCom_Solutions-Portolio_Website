<?php require('core/init.php'); ?>
<?php 
	$task = new Task;
	$notification = new Notification;
	$process = $_POST['process'];
	$memberid = $_POST['memberid'];
	$result = array();
	$output = '';
	if($process == 0){
		$result = $task->checkNewtasks($memberid);
		$count = $task->numberOftasks($memberid);
		if ($result != false) {
			foreach ($result as $value) {
				// $output .= 
				// '<li>	
				// 	<label>Task Name:</label><value>'.$value[0]["title"].' </value><br>
				// 	<label>Due Date:</label><value>'.$value[0]["due_date"].'</value><br>
				// 	<div>
				// 		<button class="btn-sm btn-success mr-2 ml-5">Accept</button>
				// 		<button class="btn-sm btn-danger">Reject</button>
				// 	</div>
									
				// </li>';

				$output .='<li id="newtask-'.$value['task_id'].'"><label class="ml-1 mr-1">The Task,</label>'.$value['title'].'<label class="ml-1 mr-1">Due On</label>'.$value['due_date'].'<br><button onclick="accepted('.$value['task_id'].')" class="btn-sm btn-outline-success ck-btn-sm ml-5" id="acceptTask" >Accept</button><button onclick="rejected('.$value['task_id'].')" class="btn-sm btn-outline-danger ck-btn-sm ml-5">Reject</button></li><hr style="margin-top: 2px">';
			}
			$output .='<value class="mem" id="count">'.$count.'</value>';
			echo $output;
		}else{
			echo '<value class="text-muted">No New Task assigned to You</value>';
		 }
	}elseif ($process == 1) {
		$result = $notification->checkNewnotifications($memberid);
		$count = $notification->numberOfnotifications($memberid);
		if ($result != false) {
			foreach ($result as $value) {
				$output .='<li class="p-1 pt-2 m-0" id="newnoti-'.$value['notification_id'].'" style="background: darkgrey">'.$value['notification_text'].'</li><hr style="margin: 0;">';
			}
			$output .='<value class="mem" id="count-3">'.$count.'</value>';
			echo $output;
		}else{
			$result = $notification->getfewNotifications($memberid);
			$count = '';
			if ($result != false) {
				foreach ($result as $value) {
					$sent_on = strtotime($value['sent_on']);
					$sent_on = date('jS M Y', $sent_on);
					$output .='<li class="p-1 pt-2 m-0" id="newnoti-'.$value['notification_id'].'">'.$value['notification_text'].'<small class="ml-1" style="color:gray;"> sent on '. $sent_on.'</small></li><hr style="margin: 0;">';
				}
				$output .='<value class="mem" id="count-3">'.$count.'</value>';
				echo $output;
			}
		 }
	}else{
		$result = $notification->checkNewmessages($memberid);
		$count = $notification->numberOfmessages($memberid);
		if ($result != false) {
			foreach ($result as $value) {
				$output .='<li class="p-1 pt-2 m-0" id="newmsg-'.$value['message_id'].'" style="background: darkgrey">'.$value['message'].'</li><hr style="margin: 0;">';
			}
			$output .='<value class="mem" id="count-2">'.$count.'</value>';
			echo $output;
		}else{
			$result = $notification->getfewMessages($memberid);
			$count = '';
			if ($result != false) {
				foreach ($result as $value) {
					$sent_on = strtotime($value['sent_on']);
					$sent_on = date('jS M Y', $sent_on);
					$output .='<li class="p-1 pt-2 m-0" id="newmsg-'.$value['message_id'].'"><span><img src="templates/pics/'.$value['sender_pic'].'?>" class="photo img-thumbnail rounded-circle ml-2 mr-1 p-0" alt=""></span>'.$value['message'].'<span class"ml-1"><a style="font-size:0.9em;font-weight:normal" href="privatechat.php?id='.$value['sender_id'].'">View Message</a></span><small class="ml-1" style="color:gray;"> sent on '. $sent_on.'</small></li><hr style="margin: 0;">';
				}
				$output .='<value class="mem" id="count-2">'.$count.'</value>';
				echo $output;
			}else{
				echo "Nothing To Show";
			}
		 }

	}
	
 ?>	
