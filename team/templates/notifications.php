<?php include 'includes/header.php'; ?>

			<div class="ck-view mt-3 newview">
			<div class="view-header d-flex justify-content-between pl-3 pt-0 pb-0 pr-2">
				<nav class="nav">
			  			<h3>Messages Inbox</h3>
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
			  		<div class="message-list">
			  			<ul>
			  				
			  			</ul>
			  		</div>
			  </div>
			</div>

			</div> 

		<!-- Pages JavaScripts -->

		<script>
			
		</script>
		
<?php include 'includes/footer.php'; ?>