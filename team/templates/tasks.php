<?php include 'includes/header.php'; ?>
			<div style="position: relative;">
				<div class="response-box " id="response-box">Task Deleted</div>
			</div>
			<div class="overlay" id="deleteOverlay">
			  <div class="popup" id="deleteAction">
			    <p>If you delete this task anyone assigned to it will no longer see it. Are you sure you want to delete it?</p>
			    <div class="text-right">
			      <button class="btn btn-cancel mr-3" id="noDelete">No</button>
			      <button class="btn btn-primary" id="yesDelete">Yes</button>
			    </div>
			  </div>
			</div>
			<div class="overlay" id="statusOverlay">
			  <div class="popup" id="acceptedStatus">
			    <div class="text-right">
			      <span id="taskTitle" class="mr-5 pr-5" style="font-size: 1.4em;"></span><span class="close ml-4" id="closestatus">&times</span>
			    </div>
			    <div class="popup-table">
			    	<table class="table" id="popupTable">
			    		<thead>
			    			<tr>
			    				<th scope="col">Members</th>
			    				<th scope="col">Task Responses</th>
			    			</tr>
			    		</thead>
			    		<tbody>
				    		
			    		</tbody>
			    	</table>
			    </div>
			    
			  </div>
			</div>

			<div class="ck-view mt-3 ">
			<div class="view-header d-flex justify-content-between pl-3 pt-0 pb-0 pr-2">
				<nav class="nav">
					<a class="nav-link  ck-active" href="#">Assigned </a>
					<a class="nav-link" href="unassignedTasks.php">Unassigned</a>
					<a class="nav-link" href="submissions.php">Submitted</a>
					<a class="nav-link " href="completed.php">Completed</a>
				</nav>
				<div class="notification-bar" >
						<?php if(!$teamAdmin): ?>
						<span class="notify-wrapper mr-2">
							<span id="newTask">New Task</span><span id="badge" class="badge badge-danger ml-2"></span>
							<div class="notifylist" id="newTab-1">
								<h5>New Task</h5>
									<hr>
								<ul>
									
								</ul>
							</div>
						</span>
						<?php endif; ?>
						<span class="notify-wrapper">
							<span id="message" class="material-icons md-18 icon-align">message</span>
							<span id="badge-msg" class="badge badge-danger"></span>
							<div class="notifylist" id="newTab-2" >
								<h5>Messages</h5>
									<hr>
								<ul>
								<?php if(!empty($newMessages)):  ?>
								<?php foreach($newMessages as $newMessage): ?>
									<li class="p-1 pt-2 m-0" id="newmsg-<?php echo $newMessage['message_id']; ?>"><span><img src="templates/pics/<?php echo $newMessage['sender_pic']; ?>?>" class="photo img-thumbnail rounded-circle ml-2 mr-1 p-0" alt=""></span><?php echo $newMessage['message']; ?><span class"ml-1"><a style="font-size:0.9em;font-weight:normal" href="privatechat.php?id='.$value['sender_id'].'">View Message</a></span><small class="ml-1" style="color:gray;"> sent on <?php echo $newMessage['sent_on']; ?></small></li><hr style="margin: 0;">
								<?php endforeach; ?>
								<?php else: ?>
									No new Messages
								<?php endif; ?>
								</ul>
							</div>
						</span>
						<span class="notify-wrapper">
							<span id='notification' class="material-icons md-18 icon-align " style="margin-right: 0;padding-right: 0;">add_alert</span>
							<span id="badge-noti" class="badge badge-danger ml-0 "></span>
							<div class="notifylist p-0 " id="newTab-3" >
								<h5 class="p-1 pl-2">Notifications</h5>
									<hr class="mb-0">
								<ul class="p-0">
								<?php foreach($fewnotifications as $notification): ?>
									<!-- <li class="p-1 pt-2 m-0" id="newnoti-<?php echo $notification['notification_id']; ?>" <?php if($notification['notification_status']==0): ?>style="background: darkgrey" <?php endif; ?>>
										<?php echo $notification['notification_text'] ?>
									</li><hr style="margin: 0;"> -->
								<?php endforeach; ?>
								</ul>
							</div>
						</span>
				</div>
			</div>
			<?php if(!empty($tasks)) :?>
			  <div class="ck-panel mt-2 pl-4 pt-2 pb-2 pr-3">
			  		<table class="table mytable">
			  			<thead>
			  				<tr>
			  					<th scope="col"></th>
			  					<th scope="col">Task Title</th>
			  					<th scope="col" style="color: #dc3545;">Due Date</th>
			  					<th scope="col" style="color:#343a40">Responses</th>
			  					<th scope="col">Action</th>
			  				</tr>
			  			</thead>
			  			<tbody>
			  			<?php 
			  			$n = 0;
			  			foreach($tasks as $task) :?>
			  				<tr id="task-<?php echo $task['task_id'];?>">
			  					<th scope="row"><?php echo ++$n; ?></th>
			  					<td><?php echo $task['title'] ;?></td>
			  					<td style="font-weight: bold;"><?php $time = strtotime($task['due_date']);
			  							  $due_date = date('jS M Y', $time);
			  							  echo $due_date;
			  						?></td>
			  					<td style="cursor: pointer;" id="acceptTask-<?php echo $task['task_id'] ?>" onclick = "showAccepted(<?php echo $task['task_id'] ?>, '<?php echo $task['title'] ?>')"><a style="text-align: center;" href="#">
			  						<?php
			  							if($task['assigned'] ==1){
			  								if($task['accepted_status'] == 0){
			  									echo '<label for="" style="color:#17a2b8">Pending...</label>';
			  								}
			  								elseif($task['accepted'] == 2){
			  									echo '<label for="" style="color:#28a745">Accepted</label>';
			  								}else{
			  									echo '<label for="" style="color:#dc3545">Rejected</label>';
			  								}
			  							}else{
			  								if ($task['assigned'] != $task['accepted_status']) {
			  									echo $task['accepted_status'].'/'.$task['assigned'];
				  							}else{
				  								echo $task['accepted_status'].'/'.$task['assigned'];
				  							}
				  						}
			  							

			  						?>
			  							
			  						</a></td>
			  					<td><a href="taskdetails.php?id=<?php echo urlencode($task['task_id']); ?>"><button onclick="showInfo(<?php echo $task['task_id'];?>)" class="btn-sm btn-default ck-btn" style="border: none">View Details</button></a>
			  					<button onclick="deleteAssigned(<?php echo $task['task_id'];?>)" class="btn-sm btn-default ck-btn" style="border: none" id="deleteAssigned"  >Delete</button>
			  					</td>
			  				</tr>
			  			<?php endforeach; ?>
			  			</tbody>
			  		</table>
			  </div>


			  
			<?php else :?>
				<div class="ck-tab">
					<h1>No Tasks</h1>
				</div>
			<?php endif; ?>
			</div>
		</div>
		<script>
			var deletetask = '';
			function deleteAssigned (task) {
				$('#deleteOverlay').fadeIn();
				$('#deleteAction').animate({top: '30%'}, 1000);
				deletetask = task;
			}
			$('#noDelete').click(function(event) {
				$('#deleteAction').animate({top: '-100%'}, 1000);
				$('#deleteOverlay').fadeOut();
				deletetask = '';
			});

			$('#yesDelete').click(function(event) {
				
				$.post("deleteAssigned.php", {taskId: deletetask}, function (data) {
					/* body... */
						$('#deleteAction').animate({top: '-100%'}, 1000);
						$('#deleteOverlay').fadeOut();
						$('#task-' + deletetask).toggleClass('deleteEffect');
						setTimeout(function(){
							$('#task-' + deletetask).hide();		
											}, 500);
						deletetask = '';
						$("#response-box").addClass('ascend1');
						$("#response-box").show();
						setTimeout(function(){
									$("#response-box").fadeOut(1000);
									}, 1500);
							});
			});
			$('#closestatus').click(function(event) {
				$('#acceptedStatus').animate({top: '-100%'}, 1000);
				$('#statusOverlay').fadeOut();
			});
		function showAccepted(taskid, $title){
			$('#statusOverlay').fadeIn();
			$('#acceptedStatus').animate({top: '10%'}, 1000);
			$('#taskTitle').text($title);
				$.post('showacceptStatus.php', {taskId: taskid}, function (data) {
					/* body... */
					$('#popupTable tbody').html(data);

							});
		}


			function alertMe(){
				alert('It works');
			}
		</script>
<?php include 'includes/footer.php'; ?>