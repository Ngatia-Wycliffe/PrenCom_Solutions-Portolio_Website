<?php include 'includes/header.php'; ?>
			<div style="position: relative;">
				<div class="response-box " id="response-box">Task Detail Updated</div>
			</div>

			<div class="overlay" id="submitOverlay">
			  <div class="popup" id="submitAction">
			    <p>Confirm submission of Task Example #5</p>
			    <div class="text-right">
			      <button class="btn btn-cancel mr-3" id="noCancel">Cancel</button>
			      <button class="btn btn-primary" id="yesSubmit">Confirm</button>
			    </div>
			  </div>
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
							<label for="taskname"><strong>Subtask Name:</strong></label>
							<input name="taskname" type="text" class="form-control" id="taskname" required>
							<button type="submit" name="submit" class="btn btn-success">Add</button>
						</div>
					 
					 <div class="create-list">
						<ul id="createList1">
						<h5>Subtasks created</h5>
						<hr>
						</ul>
					</div>
					 
			    </form>
			  </div>
			</div>

			<div class="overlay" id="listOverlay">
			  <div class="popup" id="listAction" style="border-radius: 2px">
			    <form id="activityform" method="post">
			    	<div class="d-flex justify-content-between">
			    		<div id="subtask-header"><h5></h5><value class="mem"></value></div>
			    		<div>
					    <span class="close" id="closelist">&times</span>
					    </div>
			    	</div>
			    	
						<div class="form-group">
							<label for="activityname"><strong>My To do List:</strong></label>
							<input name="activityname" type="text" class="form-control" id="activityname" required>
							<button type="submit" name="submit" class="btn btn-success mt-2">Add</button>
						</div>
					 
					 <div class="create-list">
					 	<h5>To Do List Items created</h5>
						<hr>
						<ul id="createList2">
					
						</ul>
					</div>
					 
			    </form>
			  </div>
			</div>

			<div class="ck-view mt-3 newview">
			<div class="view-header d-flex justify-content-between pl-0 ml-0 pt-0 pb-0 pr-2">
					<nav class="nav">
						<h5 id="redirect">
							<a href="scheduled.php" class="mr-3 ml-4" style="color: #17a2b8;">
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
			  		<div class="myworkspace" id="myworkspace">
			  		<?php foreach($Task as $taskinfo): ?>	
						<div class="d-flex justify-content-between">
							<div style="text-align: center"><h4><?php echo $taskinfo['title'] ?></h4></div>
							<!-- <div>
								<button class="btn-sm btn-info ck-btn-sm mr-5" id="startPause" onclick="startPause()">Start</button>
								<button class="btn-sm btn-info ck-btn-sm" onclick="reset()">Reset</button>
								<p class="stopwatch" id="stopwatch">00 : 00 : 00</p>
							</div> -->
							
							<div><button onclick="submitTask(<?php echo $taskID ?>, '<?php echo $taskinfo['title'] ?>')" style="cursor: pointer" class="btn-sm btn-success ck-btn-sm">Submit Task</button></div>
						</div>
						<div class="timer mr-5" id="timer" style="text-align: center">
							<label for="">Task Due in </label>
							<span>
								<p>00<small>days</small> : 00<small>hrs</small> : 00<small>mins</small> : 00<small>sec</small></p>
							</span>	
						</div>
						<hr>
						
						
					<?php if(!empty($teamMates)): ?>
						<label for="">Collaborating with </label>
					<?php foreach($teamMates as $teamMate): ?>
						<?php if($teamMate['member_id'] != $_SESSION['member_id']): ?>
						<span><img src="templates/pics/<?php echo $teamMate['profile_pic'];?>" class="collabo img-thumbnail rounded-circle p-0" alt=""></span>
						<?php endif; ?>
					<?php endforeach; ?>
			  		<?php endif;?><br><br>
			  			
			  				<label for="" style="width: 200px">Schedule regularly</label>
			  				<select id="myselect">
			  			<?php if($scheduleby == 1): ?>
						    <option value="1" selected>Daily</option>
						    <option value="2">Weekly</option>
						<?php else: ?>
						    <option value="1">Daily</option>
						    <option value="2"  selected>Weekly</option>
						<?php endif; ?>
						</select><br><br>
			  			<label class="" for="" style="width: 200px">Scheduled For:</label>
			  			<span id="nowSchedule">
			  				<?php 
			  					echo date('l (jS M)', strtotime($scheduled_date));
			  				 ?>
			  			</span>
			  			<label for="" class="ml-3" style="width: 180px">Scheduled Next For:</label>
			  			<span id="nextSchedule">
			  				<?php 
			  					echo date('l (jS M)', strtotime($scheduled_date. ' +'.$scheduleby.' days'));
			  				 ?>
			  			</span>
			  			
			  			<br> <br>
			  			<label for="" style="width: 200px">CheckList</label>
						<?php if(empty($subtasks)): ?>
			  				<none>No checklist available</none>
			  			<?php else: ?>
			  				<div class="myaccordion">
			  					<h6>View CheckList <button id="showSubtasks" class="btn-sm btn-default ck-btn-sm"><i class="material-icons icon-align">expand_more</i></button></h6>
			  					<ul id="subtask-list">
			  					<?php foreach($subtasks as $subtask) :?>
			  						<li class="mb-2"id="subtask-<?php echo $subtask['subtask_id'];?>">
			  							<?php echo $subtask['subtask_name']; ?>
			  							<span><button id="showActivities-<?php echo $subtask['subtask_id']; ?>" class="btn-sm btn-default ck-btn-sm ml-2 mr-2"><i class="material-icons md-18 icon-align" onclick="showActivities(<?php echo $subtask['subtask_id']; ?>)">expand_more</i></button></span>
			  							<?php if ($subtask['completed'] == 'checked'):?>
				  							<status id="completed-<?php echo $subtask['subtask_id'] ?>" style="color: #28a745;box-shadow: 5px 5px 5px gray;padding:5px 5px">Completed</status>
				  							<button id="mark-<?php echo $subtask['subtask_id'] ?>" class="btn-sm btn-success ck-btn-sm ck-btn mem" onclick="completeSubtask(<?php echo $subtask['subtask_id'] ?>)">Mark as Completed</button>
				  							<button id="undo-<?php echo $subtask['subtask_id'] ?>" class="btn-sm btn-danger ck-btn-sm ml-3" onclick="uncompleteSubtask(<?php echo $subtask['subtask_id'] ?>)">Undo</button>
			  							<?php else: ?>
			  								<status class="mem" id="completed-<?php echo $subtask['subtask_id'] ?>" style="color: #28a745;box-shadow: 2px 2px 2px gray;padding:5px 5px">Completed</status>
				  							<button id="mark-<?php echo $subtask['subtask_id'] ?>" class="btn-sm btn-success ck-btn-sm ck-btn" onclick="completeSubtask(<?php echo $subtask['subtask_id'] ?>)">Mark as Completed</button>
				  							<button id="undo-<?php echo $subtask['subtask_id'] ?>" class="btn-sm btn-danger ck-btn-sm ml-3 mem" onclick="uncompleteSubtask(<?php echo $subtask['subtask_id'] ?>)">Undo</button>
			  							<?php endif; ?>
			  							<div class="mini-list" >
			  								<ul id="activity-list-<?php echo $subtask['subtask_id']; ?>">
			  									<value><h6>My To do list</h5></value>
											<?php
											 foreach($todolist as $activity):?>
											<?php if($activity['subtask_id'] == $subtask['subtask_id']): ?>
												<li class ="<?php echo $activity['completed'] ?>" id="activity-<?php echo $activity['activity_id'] ?>" onclick="markCompleted(<?php echo $activity['activity_id'] ?>, <?php echo $subtask['subtask_id'] ?> )">
													<?php echo $activity['activity_name']; ?>
												</li>
											<?php endif; ?>
				  							<?php endforeach; ?>
				  							<span class="mylauncher ml-2"><a href="#" style="color: blue; font-size: 0.9em" onclick="launchList(<?php echo $subtask['subtask_id'] ?>,'<?php echo $subtask['subtask_name']; ?>')" >create To do List</a></span>
				  							</ul>
												
			  							</div>
										
										
			  							
			  						</li>
			  					<?php endforeach; ?>	
			  					</ul>
			  				</div>
			  			<?php endif; ?><br><br>
			  			<label for="" style="width: 200px">Associated Files</label><button id="viewFiles" class="btn btn-default">View Files</button>
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
			  				<th style="color: #17a2b8;">Uploaded By</th>
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
			  					<td style="color:gray"><?php echo $file['fname'].' '.$file['lname']; ?></td>
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

		
				
				</div> 
			










		<!-- Pages JavaScripts -->
		<script type="text/javascript">
			var task = <?php echo $taskID; ?>;
			var unformattedDate = new Date("<?php foreach($Task as $taskdetail){ $time = strtotime($taskdetail['due_date']);$due_date= date('Y-m-d', $time);echo $due_date;} ?>");
			var time = 0;
			var running = 0;
			var created = 0;

			Date.prototype.addDays = function(days) {
			    var date = new Date(this.valueOf());
			    date.setDate(date.getDate() + days);
			    return date;
			}

			$('#myselect').change(function(event) {
				/* Act on the event */
				var selected = $('#myselect').val();
				switch (selected) {
								case '1':
									var startdate = moment(new Date('<?php echo $scheduled_date ?>')).utc().format();
									var new_date = moment(startdate).add(1, 'd');
									new_date = moment(new_date).format('dddd (Do MMM)');
									$('#nextSchedule').text(new_date);
									var formData = new FormData();
									formData.append('interval', 1);
									formData.append('task', task);
									$.ajax({
										url:"regulateSchedule.php",
											type: "POST",
											data:formData,
											contentType: false,
											cache: false,//to unable request page to be cached
											processData: false,//To send DOMDocument or non processed datafile if it is set to false
											success: function (response) {
												
												}
									});
									break;
								case '2':
									var startdate = moment(new Date('<?php echo $scheduled_date ?>')).utc().format();
									var new_date = moment(startdate).add(7, 'd');
									new_date = moment(new_date).format('dddd (Do MMM)');
									$('#nextSchedule').text(new_date);
									var formData = new FormData();
									formData.append('interval', 7);
									formData.append('task', task);
									$.ajax({
										url:"regulateSchedule.php",
											type: "POST",
											data:formData,
											contentType: false,
											cache: false,//to unable request page to be cached
											processData: false,//To send DOMDocument or non processed datafile if it is set to false
											success: function (response) {
												
												}
									});

									break;
								default:
									// statements_def
									break;


							}			
						});

			function countdownTimer(){
				var now = new Date();
				var currentTime = now.getTime();
				var deadline = unformattedDate.getTime();
				var remTime = deadline - currentTime;

				var s = Math.floor(remTime / 1000);
				var m = Math.floor(s / 60);
				var h = Math.floor(m / 60);
				var d = Math.floor(h / 24);

				h %= 24;
				m %= 60;
				s %= 60;

				h = (h < 0) ? -h : h;
				m = (m < 0) ? -m : m;
				s = (s < 0) ? -s : s;

				h = (h < 10) ? "0" + h : h;
				m = (m < 10) ? "0" + m : m;
				s = (s < 10) ? "0" + s : s;


				$('#timer span').html('<p>'+d+'<small>days</small> : '+h+'<small>hrs</small> : '+m+'<small>mins</small> : '+s+'<small>sec</small></p>');
				setTimeout(countdownTimer, 1000);

			}

			countdownTimer();

			function submitTask (taskid, title) {
					$('#submitOverlay').fadeIn();
					$('#submitAction p').text('Confirm submission of '+title);
					$('#submitAction').animate({top: '30%'}, 1000);
			}
			$('#yesSubmit').click(function() {
					var formData = new FormData();
					formData.append('taskId', task);
					$.ajax({
						url:"submitTask.php",
							type: "POST",
							data:formData,
							contentType: false,
							cache: false,//to unable request page to be cached
							processData: false,//To send DOMDocument or non processed datafile if it is set to false
							success: function (response) {
								$("#response-box").html(response);
								$("#response-box").addClass('ascend1');
								$("#response-box").show();
								setTimeout(function(){
											$("#response-box").fadeOut(1000);
											window.location.href = 'mytasks.php';
											}, 1500);
								}
								});
			});

			$('#noCancel').click(function() {
					$('#submitAction').animate({top: '-100%'}, 1000);
					$('#submitOverlay').fadeOut();
			});

			$('.mylauncher a').click(function(event) {
				/* Act on the event */
				event.preventDefault();
			});
			function startPause(){
				if (running == 0) {
					running = 1;
					increment();
					$('#startPause').html('Pause');
				}else{
					running = 0;
					$('#startPause').html('Resume');
				}
			}

			function reset () {
				running = 0;
				time = 0;
				$('#startPause').html('Start');
				$('#stopwatch').html('00:00:00');
			}

			function increment () {
				if (running == 1) {
					setTimeout(function () {
					time ++;
					var hours = Math.floor(time/10/60/60);
					var mins = Math.floor(time/10/60);
					var secs = Math.floor(time/10);
					var tenths = time % 10;
					hours = (hours < 10)?"0"+hours:hours;
					mins = (mins < 10)?"0"+mins:mins;
					secs = (secs < 10)?"0"+secs:secs;
					document.getElementById('stopwatch').innerHTML = hours+" : "+mins+" : "+secs;
					// $('#stopwatch').html(hours+" : "+mins+" : "+secs);
					increment();

				}, 100);
				}
				
			}

			function launchList (subtaskid, subtask) {
					$('#subtask-header h5').text(subtask);
					$('#subtask-header value').text(subtaskid);
					$('#listOverlay').fadeIn();
					$('#listAction').animate({top: '5%'}, 1000);
			}

			$('#showSubtasks').click(function(event) {
				/* Act on the event */
				$('#subtask-list').slideToggle();
				var accordion = $('#showSubtasks i').text();
				if (accordion == 'expand_more') {
					$('#showSubtasks i').text('expand_less');	
				}else{
					$('#showSubtasks i').text('expand_more');
				}
			});

			function showActivities(subtask) {
				/* Act on the event */
				$('#activity-list-'+subtask).slideToggle();
				var accordion = $('#showActivities-'+subtask+' i').text();
				if (accordion == 'expand_more') {
					$('#showActivities-'+subtask+' i').text('expand_less');	
				}else{
					$('#showActivities-'+subtask+' i').text('expand_more');
				}
			}


			$("#viewFiles").click(function(event) {
			/* Act on the event */
					$('#myworkspace').removeClass('viewSlideappear-fromLeft');
					$('#myworkspace').addClass('viewSlide-disappear-toLeft');
					setTimeout(function (argument) {
					$('#myworkspace').hide();
					$('#redirect').hide();
					$('#button-back').show();
					$('#fileManager').addClass('viewSlideappear-fromRight');
					$('#fileManager').removeClass('viewSlide-disappear-toRight');
					$('#fileManager').show();
				},700);
					
			});

				function goBack() {
					$('#fileManager').removeClass('viewSlideappear-fromRight');
					$('#fileManager').addClass('viewSlide-disappear-toRight');
					setTimeout(function (argument) {
						$('#fileManager').hide();
						$('#button-back').hide();
						$('#redirect').show();
						$('#myworkspace').addClass('viewSlideappear-fromLeft');
						$('#myworkspace').removeClass('viewSlide-disappear-toLeft');
						$('#myworkspace').show();
					},700);
				}

				function uploadFile() {
					$('#uploadOverlay').fadeIn();
					$('#uploadAction').animate({top: '30%'}, 1000);
				}

				$('#closestatus').click(function(event) {
					$('#uploadAction').animate({top: '-100%'}, 1000);
					$('#uploadOverlay').fadeOut();
				});

				$('#closelist').click(function(event) {
					$('#listAction').animate({top: '-100%'}, 1000);
					$('#listOverlay').fadeOut();
				});

				function markCompleted(activity, subtask){
					var formData = new FormData();
					var processType = 2;
					var checked = $('#activity-'+activity).attr('class');
					formData.append('status', checked);
					formData.append('activityid', activity);
					formData.append('process', processType);
					formData.append('task', task);
					formData.append('subtask', subtask);
					$.ajax({
						url:"taskCompleted.php",
							type: "POST",
							data:formData,
							contentType: false,
							cache: false,//to unable request page to be cached
							processData: false,//To send DOMDocument or non processed datafile if it is set to false
							success: function (response) {
								if (checked == 'unchecked') {
									$('#activity-'+activity).attr('class','checked');
								}else{
									$('#activity-'+activity).attr('class', 'unchecked');
								}
								}
					});
					
				}

				function completeSubtask(subtask){
					var formData = new FormData;
					var processType = 1;
					var completed = 'checked';
					formData.append('subtaskid', subtask);
					formData.append('process', processType);
					formData.append('completed', completed);
					formData.append('task', task);
					$.ajax({
						url:"taskCompleted.php",
							type: "POST",
							data:formData,
							contentType: false,
							cache: false,//to unable request page to be cached
							processData: false,//To send DOMDocument or non processed datafile if it is set to false
							success: function (response) {
								$('#mark-'+subtask).hide();
								$('#undo-'+subtask).show();
								$('#completed-'+subtask).show();
								$('#subtask-'+subtask+' ul li').attr('class', completed);
							}
					});

				}

				function uncompleteSubtask(subtask){
					var formData = new FormData;
					var processType = 1;
					var completed = 'unchecked';
					formData.append('subtaskid', subtask);
					formData.append('process', processType);
					formData.append('completed', completed);
					formData.append('task', task);
					$.ajax({
						url:"taskCompleted.php",
							type: "POST",
							data:formData,
							contentType: false,
							cache: false,//to unable request page to be cached
							processData: false,//To send DOMDocument or non processed datafile if it is set to false
							success: function (response) {
								
								$('#mark-'+subtask).show();
								$('#undo-'+subtask).hide();
								$('#completed-'+subtask).hide();
								$('#subtask-'+subtask+' ul li').attr('class', completed);
								}
					});
				}

				$('#uploadFiles').submit(function(e) {
					/* Act on the event */
					e.preventDefault();
					var formData = new FormData(this);
					formData.append('taskid',task);
					$.ajax({
							url:"uploadFile.php",
							type: "POST",
							data:formData,
							contentType: false,
							cache: false,//to unable request page to be cached
							processData: false,//To send DOMDocument or non processed datafile if it is set to false
							success: function (response) {
								alert(response);
									// $('#uploadAction').animate({top: '-100%'}, 1000);
									// $('#uploadOverlay').fadeOut();
									// $("#response-box").addClass('ascend1');
									// $("#response-box").text(response);
									// $("#response-box").show();
									// setTimeout(function(){
									// 	$("#response-box").fadeOut(1000);
									// 	}, 1500);
									// setTimeout(function(){
									// 	window.location.href = ''
									// 	}, 500);

								}

							});
					});

				

				$('#activityform').submit(function(e) {
					/* Act on the event */
					e.preventDefault();
					var formData = new FormData(this);
					var subtask = parseInt($('#subtask-header value').text());
					var parent = task;
					formData.append('taskid',subtask);
					formData.append('parent',parent);
					$.ajax({
							url:"newActivity.php",
							type: "POST",
							data:formData,
							contentType: false,
							cache: false,//to unable request page to be cached
							processData: false,//To send DOMDocument or non processed datafile if it is set to false
							success: function (data) {
								$('#create-'+created).removeClass('slideToappear');
								created++;
								var taskname = $('#activityname').val();
								$('#subtaskform')[0].reset();
								$("#response-box").html(data);
								$("#response-box").addClass('ascend');
								$("#response-box").show();
								var ID = $('#response-box value').html();
								var createdID = parseInt(ID);
								document.getElementById('createList2').innerHTML += '<li id=create-'+ created +'>'+ taskname +'<button type="button" onclick="deleteCreated('+ created +','+ createdID +')" class="btn-sm btn-danger ck-btn-sm">Delete</button></li>';
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
							
								}
							});
					});

				function deleteCreated(taskcreated, createdid){
					var formData = new FormData();
					var processType = 2;
					formData.append('taskId', createdid);
					formData.append('process', processType);
						$.ajax({
							url:"taskDelete.php",
							type: "POST",
							data:formData,
							contentType: false,
							cache: false,//to unable request page to be cached
							processData: false,//To send DOMDocument or non processed datafile if it is set to false
							success: function (data) {
									/* body... */
								if (data) {
									$('#create-' + taskcreated).toggleClass('deleteEffect');
									setTimeout(function(){
										$('#create-' + taskcreated).hide();		
														}, 500);

									}else {
										
									}
								}
								

							});
						};


		</script>
<?php include 'includes/footer.php'; ?>