<?php include 'includes/header.php'; ?>
	
			<div class="ck-view mt-3">
			<div class="view-header d-flex justify-content-between pl-3 pt-0 pb-0 pr-2">
				<nav class="nav">
					
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
			  <div class="ck-panel mt-2 pl-4 pt-2 pb-2 pr-3">
			<?php if(!empty($tasks)): ?>
				<div class="text-right genreport"><a href="generate.php"><button class="btn btn-default">Generate Report</button></a></div>
			<?php endif; ?>
				<div class="summary">
					<h5>Tasks Created</h5>
					<?php if(!empty($totalTasks)): ?>
					<div class="progress" style="height: 50px">
					  <div class="progress-bar bg-success" style="width:
					  <?php
						$portion = $totalCompleted/$totalTasks * 100;
						echo round($portion);
					   ?>%
					  ">
					  </div>
					  <div class="progress-bar bg-info" style="width:
					  <?php
						$portion = $totalAssigned/$totalTasks * 100;
						echo round($portion);
					   ?>%
					  ">
					  </div>
					  <div class="progress-bar bg-warning" style="width:
					  <?php
						$portion = $totalUnassigned/$totalTasks * 100;
						echo round($portion);
					   ?>%
					  ">
					  </div>
					</div>
					<div class="key d-flex justify-content-between">
						<div>Unassigned <div class="mybox bg-warning"></div><value><?php echo $totalUnassigned ?></value></div>
						<div>Assigned <div class="mybox bg-info"></div><value><?php echo $totalAssigned ?></value></div>
					  	<div>Completed <div class="mybox bg-success"></div><value><?php echo $totalCompleted ?></value></div>
					 </div>
					<?php else: ?>
						<div class="ck-tab">
							<h1>No Tasks</h1>
						</div>
					<?php endif; ?>
				</div>
					<hr>
				<div class="aggregate">
					<h6>Progress & Status of Assigned Tasks</h6>
					<?php if(!empty($tasks)): ?>
					<table class="table table-striped mytable">
						<thead>
							<th>Task</th>
							<th>Progress</th>
							<th>Status</th>
						</thead>
						<tbody>
							<?php foreach($tasks as $task): ?>
							<tr>
								<td><?php echo $task['title'] ?></td>
								<td>
									<?php if($task['progress'] > 10) :?>
									<div class="progress">
									  <div class="progress-bar bg-success" style="width:<?php echo $task['progress'] ?>%"><?php echo $task['progress'] ?>%</div>
									</div>
									<?php else: ?>
									<div class="progress" style="height: 25px">
									  <div class="progress-bar bg-success" style="width:<?php echo $task['progress'] ?>%"></div><?php echo $task['progress'] ?>%
									</div>
									<?php endif; ?>	
								</td>
								<td class="status-task">
										<?php
										$startdate = strtotime($task['accepted_on']);
										$enddate = strtotime($task['due_date']);
										$today  = time();
										$dateDiff = $enddate - $startdate;
										$dateDiffForToday = $today - $startdate;
										$percentage = $dateDiffForToday/$dateDiff * 100;
										$percentage = round($percentage);

										if($percentage <= $task['progress']):
										 ?>
										<div class="text-success">On Schedule</div>
										<?php else: ?>
										<div class="text-danger">Behind</div>
										<?php endif; ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
						
					</table>
					<?php else: ?>
						<div class="ck-tab">
							<h1>No Tasks</h1>
						</div>
					<?php endif; ?>
				</div>

	
			  </div>

			</div>
		</div>
		<script>
			
		</script>
		
<?php include 'includes/footer.php'; ?>
		