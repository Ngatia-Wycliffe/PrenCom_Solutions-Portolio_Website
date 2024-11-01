<?php include 'includes/header.php'; ?>
			<div style="position: relative;">
				<div class="response-box " id="response-box">Task Detail Updated</div>
			</div>
			
			<div class="overlay" id="uploadOverlay">
			  <div class="popup" id="uploadAction">
			    <form id="uploadFiles" method="post">
			    	<div class="text-right">
				    <span class="close ml-4" id="closestatus">&times</span>
				    </div>
			    	<div class="form-group">
					    <label for="myfile" class="ck-label">
					    	<span><strong class="mr-2">File Upload:</strong></span>
					    	<input type="file" name="myfile"  class="ck-form" id="myfile" required>
					    </label>
					    
					 </div>
					 <div class="text-right">
					 	<button type="submit" name="submit" class="btn btn-success">Upload</button>
					 </div>
					 
			    </form>
			  </div>
			</div>

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

			<div class="ck-view mt-3 newview">
			<div class="view-header d-flex justify-content-between pl-0 ml-0 pt-0 pb-0 pr-2">
					<nav class="nav">
						<h5 id="redirect">
							<a href="tasks.php" class="mr-3 ml-4" style="color: #17a2b8;">
				  			<i class="material-icons md-36 icon-align-bottom">navigate_before</i>Back</a>
				  		</h5>
				  		<h5 id="button-back" class="mem" onclick="goBack()">
							<a href="#" class="mr-3 ml-4" style="color: #17a2b8;">
				  			<i class="material-icons md-36 icon-align-bottom">navigate_before</i>Back</a>
				  		</h5>
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
			  		<div class="detail" id="detail">
			  		<?php foreach($Task as $taskdetail): ?>
			  			<span>
			  				
			  			</span><h3 style=""><label for="" class="" style="color: #17a2b8; font-size: 0.9em;min-width: 150px">Title:</label><?php echo $taskdetail['title']; ?></h3><!-- <span class="update">Saved Successfully</span> -->
			  			<hr style="background: grey">
			  			<detail class="mb-2"><label for="">Assigned To:</label>
			  				<span id="membSelect" style="">
			  					<?php foreach($taskMembers as $taskMember): ?>

			  					<member class="Selected" id="pic-<?php echo $taskMember[0]['member_id'] ; ?>"><img src="templates/pics/<?php echo $taskMember[0]['profile_pic'];?>" class="selected img-thumbnail rounded-circle p-0" alt=""><values class="mem"><?php echo $taskMember[0]['member_id']; ?></member>

								<?php endforeach; ?>
			  				</span>
			  				<!-- <button  type="button" class="" id="assign" onclick="preCheck()">Edit</button>
			  				<button  type="button" class="btn-sm btn-success ck-btn-sm mem ml-2" id="Reassign" onclick="reAssign()">Save</button>
			  				<button  type="button" class="btn-sm btn-danger ck-btn-sm mem ml-2" id="cancelChange" onclick = "cancelChange()" >Cancel</button> -->
			  			</detail>
			  			<br>

			  			<detail class="mb-2" ><label for="">Due Date</label><input id="due" type="text"  min="<?php print(date('Y-m-d', strtotime(date('Y-m-d').' + 1 days'))) ?>" name="duedate" class="ck-form" value="<?php echo $taskdetail['due_date']; ?>" style="margin-top: 20px" disabled><button id="edit-<?php echo 1; ?>" type="button" id="edit" class="btn btn-outline-info ck-btn" onclick="edit(1)">Edit</button>
			  				<button  type="button" id="save-<?php echo 1; ?>" class="btn btn-outline-success ck-btn mem" onclick="alterDetail(1)">Save</button>
			  			</detail>
			  			<br>

			  			<!-- <detail class="mb-2"><label for="">Comments</label><input id="comments" type="text" value="<?php echo $taskdetail['comment']; ?>" disabled>
			  				<button id="edit-<?php echo 2; ?>" class="btn btn-outline-info ck-btn" onclick="edit(2)">Edit</button>
			  				<button  type="button" id="save-<?php echo 2; ?>" class="btn btn-outline-success ck-btn mem" onclick="alterDetail(2)">Save</button>
			  			</detail> -->
			  			<br>
			  			<detail class="mb-2"><label for="">Subtasks</label>
						<?php if(empty($subtasks)): ?>
			  				<button id="subtasks" class="btn btn-default">Create Subtasks</button>
			  			<?php else: ?>
			  				<div class="myaccordion">
			  					<h6>View Subtasks <button id="showSubtasks" class="btn-sm btn-default ck-btn-sm"><i class="material-icons icon-align">expand_more</i></button></h6>
			  					<ul id="subtask-list">
			  					<?php foreach($subtasks as $subtask) :?>
			  						<li id="subtask-<?php echo $subtask['subtask_id'];?>">
			  							<?php echo $subtask['subtask_name']; ?>
			  						</li>
			  					<?php endforeach; ?>
			  					<button id="subtasks" class="btn-sm ck-btn-sm btn-default">Add Subtask</button>	
			  					</ul>
			  				</div>
			  			<?php endif; ?>
			  			</detail>
			  			<br><br>
			  			<detail class="mb-2"><label for="">Associated Files</label><button id="viewFiles" class="btn btn-default">View Files</button>
			  			</detail>
			  			<br>

<!-- 
			  			<detail class="mb-2"><label for="">Others</label><input id="others" type="text" value="Sample Data 1" disabled><button id="edit-<?php echo 3; ?>" class="btn btn-outline-info ck-btn" onclick="edit(3)">Edit</button>
			  				<button  type="button" id="save-<?php echo 3; ?>" class="btn btn-outline-success ck-btn mem" onclick="alterDetail(3)">Save</button>
			  			</detail> -->
			  			<br>
			  		<?php endforeach; ?>
			  		</div>

			  		<div class="file-manager mem" id="fileManager">
			  			<?php foreach($Task as $taskdetail) :?>
			  			<div class="d-flex justify-content-between"><div><h4>Files For <?php echo $taskdetail['title'] ?></h4></div><div id="upload-file" onclick="uploadFile()"><h6>Upload New File</h6></div></div>
			  			<?php endforeach ;?>
			  		<?php if(!empty($files)) :?>
			  		<table class="table">
			  			<thead>
			  				<th style="color: #17a2b8;">#</th>
			  				<th style="color: #17a2b8;">File Name</th>
			  				<th style="color: #17a2b8;">Uploaded</th>
			  				<th style="color: #17a2b8;">Action</th>
			  			</thead>
			  			<tbody>
			  			<?php
			  			$n = 0; 
			  			foreach($files as $file): ?>
			  				<tr id="file-<?php echo $file['file_id'] ?>">
			  					<td><?php echo ++$n; ?></td>
			  					<td><?php echo $file['file_name']; ?></td>
			  					<td><?php echo $file['uploaded']; ?></td>
			  					<td>
			  						<a href="templates/files/<?php echo $file['file_name']; ?>"><button class="btn-sm btn-success ck-btn-sm">Download/View</button></a>
			  						<button class="btn-sm btn-danger ck-btn-sm" onclick="deleteFile(<?php echo $file['file_id'] ?>)">Delete</button>
			  					</td>
			  				</tr>
			  			<?php endforeach; ?>
			  			</tbody>
			  		</table>
			  		<?php else: ?>
			  			<div class="ck-tab">
							<h1>No Files</h1>
						</div>
					<?php endif; ?>
			  </div>
			  </div>

			</div>
		</div>

		<div id="myModal" class="modal">
				
					<div class="modal-content">
						<div class="modal-header">
							<h5>Team Members</h5>
							<span class="close" onclick="clearViewspace()">&times</span>
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
									<tr>
										<td scope="row"><?php echo ++$n; ?></td>
										<td>
											<span>
												<img src="templates/pics/<?php echo $member['profile_pic']; ?>" class="ck-profile img-thumbnail rounded-circle p-0" alt="">
											</span>
										</td>
										<td><h6><?php echo $member['fname'].' '.$member['lname']; ?></h6></td>
										<td><?php echo $member['job']; ?></td>
										<td>0</td>
										<td>
											<div class="form-group">
											<input type="checkbox" id="isMemberSelected-<?php echo $member['member_id']; ?>" onclick="memberSelected(<?php echo $member['member_id']; ?>)" identify="<?php echo $member['member_id']; ?>"><identify class="mem"></identify></input>
											</div>
										</td>
									</tr>
									<?php endforeach; ?>

								</tbody>
								
							</table>
								
							</div>	
							<div class="viewspace" id="viewspace">
								
							</div>
							<div class="viewspace1" id="viewspace1">
								
							</div>
						<div class="modal-footer">
							<button type="button" id="finish" class="btn btn-outline-primary ck-btn" onclick="selected()">Submit</button>
						</div>
					</div>
				
				</div> 
			










		<!-- Pages JavaScripts -->
		<script type="text/javascript">
			var task = <?php echo $taskID; ?>;
			var unformattedDate =<?php foreach($Task as $taskdetail){ echo $taskdetail['due_date'];} ?>
		</script>
		<script src="templates/javascripts/TaskDetails.js"></script>
<?php include 'includes/footer.php'; ?>