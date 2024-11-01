<?php include 'includes/header.php'; ?>
			<div class="newextra" style="position:relative;">
			<div class="response-box " id="response-box">New Task Created</div>
			<div class="ck-view mt-3">
			<div class="view-header d-flex justify-content-between pl-3 pt-0 pb-0 pr-2">
				<nav class="nav">
					<a class="nav-link  ck-active" href="">Add Task</a>
					<a class="nav-link" href="addmember.php">Add Member</a>
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
			  	<nav class="nav mb-2">
					<a class="nav-link panel-active pb-0" href="">Create Task</a>
					<a class="nav-link" href="">Assign Task</a>
				</nav>
				<form class="ml-5" id="myform">
					<div class="form-group">
						<label for="taskname"><strong>Task Title:</strong></label>
						<input name="taskname" type="text" class="form-control" id="taskname" required>
						
					</div>
					<div class="mt-4">
						<button name="finish" type="submit" class="btn btn-outline-success ck-btn mr-5">Create Only</button>
						<button name="assign" type="submit" class="btn btn-outline-primary ck-btn " onclick="btnClicked(1)">Create & Assign</button>
					</div>
					<div class="create-list">
						<ul id="createList">
						<h5>Tasks Created</h5>
						<hr>
						</ul>
					</div>
					
				</form>	

			  </div>
			</div>
			</div>
			
		</div>

		<script>
			
		</script>
		<script>
			var clicked = 0;
			var created = 0;

				function btnClicked (status) {
					// body... 
					clicked = status;
				};

				function deleteCreated(taskcreated, createdid){
					$.post("taskDelete.php", {taskId: createdid}, function (data) {
					/* body... */
					$('#create-' + taskcreated).toggleClass('deleteEffect');
					setTimeout(function(){
						$('#create-' + taskcreated).hide();	
						// $('#tbrow-' + task).html('<h5 class="slideIn ml-5" style="color: #28a745;">Deleted Successfully</h5>');		
										}, 500);
					// setTimeout(function(){
					// 	$('#tbrow-' + task).hide('slow');			
					// 				}, 2500);
						});
				};

			$('#myform').submit(function(e) {
			/* Act on the event */
			e.preventDefault();
			var formData = $(this).serialize();
			$.post("newtask.php", formData, function(data) {
				/*optional stuff to do after success */
				if(clicked == 0){
					$('#create-'+created).removeClass('slideToappear');
					created++;
					var taskname = $('#taskname').val();
					$('#myform')[0].reset();
					$("#response-box").html(data);
					$("#response-box").addClass('ascend');
					$("#response-box").show();
					var ID = $('#response-box value').html();
					var createdID = parseInt(ID);
					document.getElementById('createList').innerHTML += '<li id=create-'+ created +'>'+ taskname +'<button type="button" onclick="deleteCreated('+ created +','+ createdID +')" class="btn-sm btn-danger ck-btn-sm">Delete</button></li>';
					$('#create-'+ created).addClass('slideToappear');
					$('#create-'+ created).show();
					$('#create-'+ created).css('opacity', '1');
					$('#create-'+ created).css('transform', 'translateX(0)');
					$('#create-'+ created +' button').fadeIn();
				setTimeout(function(){
					$("#response-box").slideDown();
					$("#response-box").fadeOut('slow');
					$('#create-'+created).removeClass('slideToappear');
				}, 1000);
				}else{
						$("#response-box").html(data);
						var id = $("#lastID").text();
						window.location.href = 'assigntask.php?id='+id+'&location=1';
						clicked = 0;
				}
				

			});


		});
		</script>
	<?php include 'includes/footer.php'; ?>