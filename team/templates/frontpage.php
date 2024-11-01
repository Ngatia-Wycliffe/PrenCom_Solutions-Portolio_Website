<?php include 'includes/header.php'; ?>

<?php if(isLoggedIn()) : ?>
			<div class="ck-view mt-3">
			<div class="view-header d-flex justify-content-between pl-3 pt-0 pb-0 pr-2">
				<nav class="nav">
					<a class="nav-link  ck-active" href="" >Team Members</a>
					<a class="nav-link" href="teamchats.php">Team Chats</a>
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
			  <div class="ck-panel mt-2 pl-4 pt-2 pb-2 pr-3" id="ck-panel">
			  	<?php  if($anyMembers) :?>
			  		<?php foreach($members as $member): ?>
			  			<?php if($_SESSION['member_id'] == $member['member_id']){ continue;} ?>
					  	<div class="ck-tile">
							<span><img src="templates/pics/<?php echo $member['profile_pic']; ?>" class="ck-pic img-thumbnail rounded-circle ml-2 mr-4 p-0" alt=""></span>
							<div class="desc">
								<name><?php echo $member['fname'].' '.$member['lname']; ?></name><br>
								<desc><?php echo $member['job']; ?></desc>

							</div>
						</div>
					<?php endforeach; ?>
				

				<div id="myModal" class="modal">
				
					<div class="modal-content">
						<div class="modal-header">
							<h5>Notifications</h5>
							<span class="close">&times</span>
						</div>
						<div class="modal-body">
							<div class="ck-notify">
								<p><b>Teresa Mendoza</b> Has been Assigned to Task:Design Web Layout</p>
							</div>
							<div class="ck-notify">
								<p><b>McGee Drake</b>, <b>Njoroge Daniel</b> Has been Assigned to Task:Design Logo</p>
							</div>
							<div class="ck-notify">
								<p><b>Teresa Mendoza</b> Has been Assigned to Task:Design Web Layout</p>
							</div>
								
						</div>	
						<div class="modal-footer">
							
						</div>
					</div>
				
				</div>
			<?php else :?>
					<div class="nodata">
						<h1>No Members</h1>
					</div>
			<?php endif; ?>
			  </div>
			</div>
		</div>

		<script>
			
		</script>
	<?php endif; ?>
	<?php include 'includes/footer.php'; ?>