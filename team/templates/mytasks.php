<?php include 'includes/header.php'; ?>
			
			<div class="ck-view mt-3">
				<div class="view-header d-flex justify-content-between pl-3 pt-0 pb-0 pr-2">
				<nav class="nav">
			  			<a class="nav-link  ck-active" href="#">All MyTasks</a>
						<a class="nav-link" href="scheduled.php">My Schedule</a>
						<a class="nav-link" href="unscheduled.php">UnScheduled Tasks</a>
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
			  <div class="ck-panel mt-2 pl-4 pt-2 pb-2 pr-3 mytasks" id="ckPanel">
			  		 <table class="table">
			  			<thead>
			  				<tr>
			  					<th scope="col">#</th>
			  					<th scope="col">Task Title</th>
			  					<th scope="col" style="color:#dc3545;">Due Date</th>
			  					<th scope="col">Scheduled For</th>
			  				</tr>
			  			</thead>
			  			<tbody>
			  			<?php 
			  			$n = 0;
			  			foreach($tasks as $task) :?>
			  				<tr>
			  					<th scope="row"><?php echo ++$n; ?></th>
			  					<td><?php echo $task['title'] ;?></td>
			  					<td style="font-weight: bold;"><?php $time = strtotime($task['due_date']);
			  							  $due_date = date('jS M Y', $time);
			  							  echo $due_date;
			  						?></td> 
			  					<td id="scheduleTab-<?php echo $task['task_id']; ?>">
								<?php if(strtotime($task['scheduled_date']) == 0): ?>
			  						<button class="btn-sm btn-outline-success ck-btn scheduler" id="scheduler-<?php echo $task['task_id']; ?>" onclick="schedule(<?php echo $task['task_id']; ?>)">Schedule</button>
									<input type="date" min="<?php print(date('Y-m-d')) ?>" max="<?php print(date('Y-m-d',strtotime($task['due_date']))) ;?>" id="schedule-<?php echo $task['task_id'] ?>" placeholder="schedule by date"  class="mem schedule-box" >
									<button style="border:none" class="btn-sm btn-success mem saver" id="save-<?php echo $task['task_id']; ?>" onclick="saveSchedule(<?php echo $task['task_id'] ?>)">Save</button>
								</td>
								<?php else: ?>
									<div style="font-style: italic;">
										<span id="mydate-<?php echo $task['task_id'];?>" class="mydate">
										<?php $time2 = strtotime($task['scheduled_date']);
			  							  $scheduled_date = date('l (jS M)', $time2);
			  							  echo $scheduled_date;?>
			  							  </span>
			  							 <input type="date" min="<?php print(date('Y-m-d')) ?>" max="<?php print(date('Y-m-d',strtotime($task['due_date']))) ;?>" class="mem schedule-box" id="schedule-<?php echo $task['task_id'] ?>" placeholder="schedule by date">
										<button style="border:none" class="btn-sm btn-success mem saver" id="save-<?php echo $task['task_id']; ?>" onclick="saveSchedule(<?php echo $task['task_id'] ?>)">Save</button>
									</div>
								</td>
									<td>
										<div style="font-style: italic">
			  							 <button onclick="reSchedule(<?php echo $task['task_id'];?>,
			  							  '<?php 
			  							   echo $task['scheduled_date'];
			  							   ?>')" class="btn-sm btn-default ml-1 reschedule" style="border: none" id="reschedule-<?php echo $task['task_id'];?>">Re-Schedule</button>
									</div>
									</td>
			  					<?php endif; ?>
			  					
			  						
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
			var member = <?php echo $_SESSION['member_id'] ?>;

			function schedule (task) {
				$('#scheduler-'+task).hide();
				$('#schedule-'+task).fadeIn(1000);
				$('#save-'+task).fadeIn(1500); 

			}
			function saveSchedule (task) {
				var scheduledFor = $('#schedule-'+task).val();
				var formData = new FormData();
				formData.append('scheduled',scheduledFor);
				formData.append('task_id',task);
				formData.append('member_id',member);
				$.ajax({
					url: "scheduleTask.php",
					type: "POST",
					data: formData,
					contentType: false,
					cache: false,
					processData: false,
					success: function (response) {
						if(response){
							formattedDate = moment(scheduledFor);
							console.log("is date valide: ", formattedDate.isValid());
							$('#mydate-'+task).html(formattedDate.format("dddd")+' ('+formattedDate.format("Do MMM")+')');
							$('#scheduleTab-'+task).html(formattedDate.format("dddd")+' ('+formattedDate.format("Do MMM")+')');
							$('#schedule-'+task).hide();
							$('#save-'+task).hide();
							$('#mydate-'+task).show();
							$('#reschedule-'+task).show();
						}else{
							alert("Something went wrong");
						}
					}
				});
			}
			function reSchedule(task, date){
				$('#mydate-'+task).hide();
				$('#reschedule-'+task).hide();
				$('#schedule-'+task).fadeIn(1000);
				$('#save-'+task).fadeIn(1500); 
				$('#schedule-'+task).val(date);
			}

			$('input[type=date]').click(function(event) {
				event.stopPropagation();
			});
			$('html').click(function(event) {
				/* Act on the event */
				// if (!$('#myDropdown').is(':hidden')) {
					if(!event.target.matches('button')){
					$('#ckPanel input').each(function(index, el) {
							$(this).hide();
							$('.saver').hide();
							$('.scheduler').show();
							$('.mydate').show();
							$('.reschedule').show();
						});
						
					}
				// }
			});

		</script>
<?php include 'includes/footer.php'; ?>