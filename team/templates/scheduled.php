<?php include 'includes/header.php'; ?>

			<div class="ck-view mt-3">
				<div class="view-header d-flex justify-content-between pl-3 pt-0 pb-0 pr-2">
					<nav class="nav">
						<a class="nav-link" href="mytasks.php">All MyTasks</a>
						<a class="nav-link  ck-active" href="#">My Schedule</a>
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
			  <div class="ck-panel mt-2 pl-4 pt-2 pb-2 pr-3 mytasks" style="font-size: 0.9em" id="ckPanel">

					<div class="mytask-list">
					<?php if($todaysTasks != false): ?>
						<h5>Today's Tasks</h5>
						<hr>
						<ul>
						<?php foreach($todaysTasks as $Task): ?>
							<li>
								<div class="mytask-title" onclick="gotoWorkspace(<?php echo $Task['task_id']?>)">
									<span class="day mr-2">
									<?php 
										$time = strtotime($Task['scheduled_date']);
										$day = date('D', $time);
										echo $day;
									 ?></span><?php echo $Task['title'] ?>
								</div>
								<!-- <div class="mytask-due">
									<label for="">Due On</label>
									<?php $time = strtotime($Task['due_date']);
			  							  $due_date = date('jS M Y', $time);
			  							  echo $due_date;?>
								</div> -->
								<div class="mytask-details">
									<span> <input type="date" min="<?php print(date('Y-m-d')) ?>" max="<?php print(date('Y-m-d',strtotime($Task['due_date']))) ;?>" class="mem schedule-box" id="schedule-<?php echo $Task['task_id'] ?>" placeholder="schedule by date">
										<button style="border:none" class="btn-sm btn-success mem saver" id="save-<?php echo $Task['task_id']; ?>" onclick="saveSchedule(<?php echo $Task['task_id'] ?>)">Save</button>	</span>
									<button onclick="reSchedule(<?php echo $Task['task_id'];?>,
			  							  '<?php 
			  							   echo $Task['scheduled_date'];
			  							   ?>')" class="btn-sm btn-default ml-1 reschedule" style="border: none" id="reschedule-<?php echo $Task['task_id'];?>">Re-Schedule
			  						</button>
									<!-- <button class="btn-sm btn-default">View Details</button> -->
								</div>
							</li>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>	

					<?php if($tommorowsTasks != false or $tommorowsTasks != ''): ?>
						<h5>Tommorow's Tasks</h5>
						<hr>
						<ul>
						<?php foreach($tommorowsTasks as $tommorowTask): ?>
							<li>
								<div class="mytask-title" onclick="gotoWorkspace(<?php echo $tommorowTask['task_id']?>)">
									<span class="day mr-2">
									<?php 
										$time = strtotime($tommorowTask['scheduled_date']);
										$day = date('D', $time);
										echo $day;
									 ?></span><?php echo $tommorowTask['title'] ?>
								</div>
								<!-- <div class="mytask-due">
									<label for="">Due On</label>
									<?php $time = strtotime($tommorowTask['due_date']);
			  							  $due_date = date('jS M Y', $time);
			  							  echo $due_date;?>
								</div> -->
								<div class="mytask-details">
									<span> <input type="date" min="<?php print(date('Y-m-d')) ?>" max="<?php print(date('Y-m-d',strtotime($tommorowTask['due_date']))) ;?>" class="mem schedule-box" id="schedule-<?php echo $tommorowTask['task_id'] ?>" placeholder="schedule by date">
										<button style="border:none" class="btn-sm btn-success mem saver" id="save-<?php echo $tommorowTask['task_id']; ?>" onclick="saveSchedule(<?php echo $tommorowTask['task_id'] ?>)">Save</button>	</span>
									<span>
										<button onclick="reSchedule(<?php echo $tommorowTask['task_id'];?>,
			  							  '<?php 
			  							   echo $tommorowTask['scheduled_date'];
			  							   ?>')" class="btn-sm btn-default ml-1 reschedule" style="border: none" id="reschedule-<?php echo $tommorowTask['task_id'];?>">Re-Schedule
			  							</button>
									</span>
									<!-- <button class="btn-sm btn-default">View Details</button> -->
								</div>
							</li>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<?php if($thisWeeks != false or $thisWeeks != ''): ?>
						<h5>Rest of the week</h5>
						<hr>
						<ul>
						<?php foreach($thisWeeks as $thisWeek): ?>
							<li>
								<div class="mytask-title" onclick="gotoWorkspace(<?php echo $thisWeek['task_id']?>)">
									<span class="day mr-2">
									<?php 
										$time = strtotime($thisWeek['scheduled_date']);
										$day = date('D', $time);
										echo $day;
									 ?></span><?php echo $thisWeek['title'] ?>
								</div>
								<!-- <div class="mytask-due">
									<label for="">Due On</label>
									<?php $time = strtotime($tommorowTask['due_date']);
			  							  $due_date = date('jS M Y', $time);
			  							  echo $due_date;?>
								</div> -->
								<div class="mytask-details">
									<span> <input type="date" min="<?php print(date('Y-m-d')) ?>" max="<?php print(date('Y-m-d',strtotime($thisWeek['due_date']))) ;?>" class="mem schedule-box" id="schedule-<?php echo $thisWeek['task_id'] ?>" placeholder="schedule by date">
										<button style="border:none" class="btn-sm btn-success mem saver" id="save-<?php echo $thisWeek['task_id']; ?>" onclick="saveSchedule(<?php echo $thisWeek['task_id'] ?>)">Save</button>	</span>
									<span>
										<button onclick="reSchedule(<?php echo $thisWeek['task_id'];?>,
			  							  '<?php 
			  							   echo $thisWeek['scheduled_date'];
			  							   ?>')" class="btn-sm btn-default ml-1 reschedule" style="border: none" id="reschedule-<?php echo $thisWeek['task_id'];?>">Re-Schedule
			  							</button>
									</span>
									<!-- <button class="btn-sm btn-default">View Details</button> -->
								</div>
							</li>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<?php if($nextWeeks != false or $nextWeeks != ''): ?>
						<h5>Next Week</h5>
						<hr>
						<ul>
						<?php foreach($nextWeeks as $nextWeek): ?>
							<li>
								<div class="mytask-title" onclick="gotoWorkspace(<?php echo $nextWeek['task_id']?>)">
									<span class="day mr-2">
									<?php 
										$time = strtotime($nextWeek['scheduled_date']);
										$day = date('D', $time);
										echo $day;
									 ?></span><?php echo $nextWeek['title'] ?>
								</div>
								<!-- <div class="mytask-due">
									<label for="">Due On</label>
									<?php $time = strtotime($tommorowTask['due_date']);
			  							  $due_date = date('jS M Y', $time);
			  							  echo $due_date;?>
								</div> -->
								<div class="mytask-details">
									<span> <input type="date" min="<?php print(date('Y-m-d')) ?>" max="<?php print(date('Y-m-d',strtotime($nextWeek['due_date']))) ;?>" class="mem schedule-box" id="schedule-<?php echo $nextWeek['task_id'] ?>" placeholder="schedule by date">
										<button style="border:none" class="btn-sm btn-success mem saver" id="save-<?php echo $nextWeek['task_id']; ?>" onclick="saveSchedule(<?php echo $nextWeek['task_id'] ?>)">Save</button>	</span>
									<span>
										<button onclick="reSchedule(<?php echo $nextWeek['task_id'];?>
			  							  '<?php 
			  							   echo $nextWeek['scheduled_date'];
			  							   ?>')" class="btn-sm btn-default ml-1 reschedule" style="border: none" id="reschedule-<?php echo $nextWeek['task_id'];?>">Re-Schedule
			  							</button>
			  						</span>
									<!-- <button class="btn-sm btn-default">View Details</button> -->
								</div>
							</li>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					</div>
				
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
							window.location.href = 'scheduled.php';
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

		function gotoWorkspace(task){
				window.location.href = 'workspace.php?id='+task;
		}

		</script>
<?php include 'includes/footer.php'; ?>