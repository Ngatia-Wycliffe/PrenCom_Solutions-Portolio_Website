<?php include 'includes/header.php'; ?>
	<div class="overlay" id="subtaskOverlay">
			  <div class="popup" id="subtaskAction" style="border-radius: 2px">
			    <form id="subtaskform" method="post">
			    	<div class="text-right">
				    <span class="close ml-4 " id="closecreator">&times</span>
				    </div>
						<div class="form-group">
							<label for="taskname"><strong>Subtask Title:</strong></label>
							<input name="taskname" type="text" class="form-control" id="taskname" required>
							
						</div>
					    
					 	<button type="submit" name="submit" class="btn btn-success">Create Subtask</button>
					 
					 <div class="create-list">
						<ul id="createList">
						<h5>Subtasks created</h5>
						<hr>
						</ul>
					</div>
					 
			    </form>
			  </div>
			</div>
			<div class="ck-view">
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
			  	<?php 
				  	$location = isset($_GET['location'])?$_GET['location']:null;
				  	if (isset($location)):
			  	 ?>
					<a class="nav-link" href="">Create Task</a>
				<?php else:?>
					<a class="nav-link" href="addtask.php">Create Task</a>
				<?php endif; ?>
					<a class="nav-link panel-active pb-0"  href="">Assign Task</a>
				</nav>



				<form class="mb-2 ml-5  myform" id="taskform" method="post">
					<div class="form-group">
						<?php foreach($mytask as $task) :?>
						<label for="tasktitle" class="ck-label mb-4 mt-2" style="text-align: center; width:400px;">
							<value class="ml-3" style="font-size: 1.5em;"><strong><?php echo $task['title']; ?></strong>
							</value>
							<hr style="background-color: gray; padding: 0.2px;">	
						</label>
						<?php endforeach; ?>	
					</div>

					<div class="form-group">
					 	<label class="ck-label" class="ck-label">
					 		<span><strong>Assign To:</strong></span>
					 		<button id="assign"  type="button" class="btn btn-secondary ">Assign</button>
					 		<span id="error-tab" class="ml-2 p-1 mem" style="color: red"></span>
					 	</label>
						
					 	
					</div>
					<label class="ck-label" class="ck-label">
					 		<span><strong>Selected:</strong></span>
					 		<member id="membSelect"></member>
					 </label>
					<div class="form-group" style="width: 500px;">
						<label class="ck-label">
							<span><strong>Deadline Date:</strong></span>
							<input type="date" min="<?php print(date('Y-m-d', strtotime(date('Y-m-d').' + 1 days'))) ?>" name="duedate" class="ck-form" required>	
						</label>
						
					</div>	
					<div class="form-group">
					    <label for="attachment" class="ck-label">
					    	<span><strong class="mr-2">File Upload:</strong>(Optional)</span>
					    	<input type="file" name="attachment"  class="ck-form " id="attachment">
					    </label>
					    
					 </div>
					 <div class="form-group" >
			  				<label for="textmessage" class="ck-label">
			  					<span  style="line-height: 1.9"><strong>Comments</strong>(Optional)</span>
								<textarea class="ck-form"  name="text" id="textmessage" style="width: 60%" rows="2" placeholder="Text Message . . . . ."></textarea>
			  				</label>
			  				
			  			</div>
					 		
					<button type="submit" name="finish" class="btn btn-outline-success ck-btn mr-5 ">Finish</button>
					<button type="submit"  class="btn btn-outline-danger ck-btn ">Cancel</button>
				</form>	
				
						


			  </div>
			</div>
				<div id="myModal" class="modal">
				
					<div class="modal-content">
						<div class="modal-header">
							<h5>Team Members</h5>
							<span class="close" id="close1">&times</span>
						</div>
						<div class="modal-body">
							<table class="table">
								<thead>
									<tr>
										<td scope="col">#</td>
										<td scope="col"></td>
										<td scope="col">Name</td>
										<td scope="col">Title</td>
										<td scope="col">Tasks</td>
										<td scope="col">Select</tr>
								</thead>
								<tbody>
									<?php 
 									$n = 0;
			  						foreach ($members as $member) :?>
			  							<?php if($member['member_id'] !=$_SESSION['member_id']) :?>
									<tr>
										<td scope="row"><?php echo ++$n; ?></td>
										<td>
											<span>
												<img src="templates/pics/<?php echo $member['profile_pic']; ?>" class="ck-profile img-thumbnail rounded-circle p-0" alt="">
											</span>
										</td>
										<td><h6><?php echo $member['fname'].' '.$member['lname']; ?></h6></td>
										<td><?php echo $member['job']; ?></td>

										<td>
										<?php if($assignedTasks != false): ?>
											<?php 
											$mytasks = 0;
											foreach($assignedTasks as $assigned) :?>
												<?php if($assigned['member_id'] == $member['member_id']) :?>
													<?php $mytasks++; ?>
												<?php endif; ?>
											<?php endforeach; 
												echo $mytasks;?>
										<?php else:?>
											<?php echo 0; ?>
										<?php endif; ?>
										</td>
										<td>
											<div class="form-group">
											<input type="checkbox" id="isMemberSelected-<?php echo $member['member_id']; ?>" onclick="memberSelected(<?php echo $member['member_id']; ?>)">
											</div>
										</td>
									</tr>
								<?php endif; ?>
									<?php endforeach; ?>

								</tbody>
								
							</table>
								
							</div>	
							<div class="viewspace" id="viewspace">
								
							</div>
						<div class="modal-footer">
							<button type="button" id="finish" class="btn btn-outline-primary ck-btn">Submit</button>
						</div>
					</div>
				
				</div>  
		</div>

		<script>
			function taskAlert(){
				var memberid  = $("#member").text();
				 $.ajax({
				 	url: "fetch.php",
				 	method: "POST",
				 	data:{memberid : memberid},
				 	success:function (data) {
				 		// /* body... */
				 		$(".tasktab ul").html(data);
				 	}
				 })

	 		}

			taskAlert();

			
			$('#taskform').submit(function(e) {
				/* Act on the event */
				e.preventDefault();
				var selectedMembers = $('#membSelect values').map(function(){
               								return $.trim($(this).text());
            							}).get();
				if(selectedMembers != ''){
					var task = <?php echo $taskID ?> ;
					var formData = new FormData(this);
					formData.append('task',task);
					formData.append('members', selectedMembers);
					if (selectedMembers.length > 1) {
					$('#error-tab').html('Please Assign one person');
					$('#error-tab').fadeIn(1000);
					setTimeout(function(){
									$("#error-tab").fadeOut(1000);
									}, 6000);

					}else{	
						$.ajax({
							url:"taskAssign.php",
							type: "POST",
							data:formData,
							contentType: false,
							cache: false,//to unable request page to be cached
							processData: false,//To send DOMDocument or non processed datafile if it is set to false
							success: function (response) {
								taskAlert();
								window.location.href = 'tasks.php';
							}

						});

					}
				}else{
					$('#error-tab').html('Please Assign one person');
					$('#error-tab').fadeIn(1000);
					setTimeout(function(){
									$("#error-tab").fadeOut(1000);
									}, 6000);

				}
				
			});
			

				function memberSelected(member){
					if (document.getElementById('isMemberSelected-'+ member).checked) {
						$.post('selected.php', {memberId: member}, function(data) {
						/*optional stuff to do after success */
						document.getElementById('viewspace').innerHTML += '<members class="Selected" id="pic-'+ member +'" ><img src="templates/pics/'+ data + '"class="selected img-thumbnail rounded-circle p-0" alt=""><values class="mem">'+member+'</values></members>';

						});
					}else {
						$('members').remove('#pic-' + member);
					}
				}
				$('#finish').click(function(event) {
						var copy = $('#viewspace').html();
						$('#membSelect').html(copy);

						$("#myModal").fadeOut('6000');
						$(".modal-content").slideUp('5000');


						
				});

		</script>

<?php include 'includes/footer.php'; ?>