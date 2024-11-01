 <?php include 'includes/header.php'; ?>
			<div class="ck-view mt-3 pb-2" >
			<div class="view-header d-flex justify-content-between pl-3 pt-0 pb-0 pr-2">
				<nav class="nav">
					<h5>
						<a href="messages.php" class="mr-3 ml-4" style="color: #17a2b8;">
			  			<i class="material-icons md-36 icon-align-bottom">navigate_before</i>Messages Inbox</a>
			  		</h5>
				</nav>
				<div class="extra-header">
					<?php foreach($chatfriend as $friendinfo): ?>
			  		
			  			<h5>Chat Profile:<img src="templates/pics/<?php echo $friendinfo['profile_pic']; ?>" class="ck-profile img-thumbnail rounded-circle ml-4 mr-4 p-0" alt=""><?php echo $friendinfo['fname'].' '.$friendinfo['lname'].' '; ?><value><?php echo $friendinfo['job']; ?></value></h5><hr>
			  		<?php endforeach; ?>
				</div>
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
			  <div class="row ck-panel mynew pl-3 pr-3">
			  
			  	<div class="chatbox-ck mt-0">
			  		<div class="chatlogs-ck private-ck" id="chatlog">
			  		
						<?php foreach($chats as $chat): ?>
							<?php if($chat['sender_id'] != $_SESSION['member_id']):?>
					  			<div class="chat-ck friend">
					  				<div class="photo-ck"><img src="templates/pics/<?php echo $chat['sender_pic']; ?>" alt=""></div>
					  				<div class="message-ck"><p><?php echo $chat['message']; ?></p></div>
					  			</div>
					  		<?php else: ?>
					  			<div class="chat-ck self">
					  				<div class="photo-ck"><img src="templates/pics/<?php echo $chat['sender_pic']; ?>" alt=""></div>
					  				<div class="message-ck"><p><?php echo $chat['message']; ?></p></div>
					  			</div>
			  				<?php endif; ?>
			  			<?php endforeach; ?>
			  		</div>
				 <div class="chat-form-ck">
						<textarea id="textmsg"></textarea>
						<button class="btn btn-outline-info ml-2 ck-btn" id="send">Send</button>
				</div>
			  	</div>
				

			  </div>
			</div>
		</div>






		<script>
			var lastchat = <?php echo $lastchat; ?>;
			var senderPic = '<?php echo $_SESSION['mypic'] ;?>';
			var user = <?php echo $_SESSION['member_id']; ?>;
			
			$("#send").click(function(event) {
			
				var message = $("#textmsg").val();
				var chatroom = 1;
				var currentchat = <?php echo $currentchat; ?>;
				var formData = new FormData();
				formData.append('message', message);
				formData.append('chatroom', chatroom);
				formData.append('chatmate', currentchat);
				if (message != '') {
					$.ajax({
					url:"sendChat.php",
					type: "POST",
					data:formData,
					contentType: false,
					cache: false,//to unable request page to be cached
					processData: false,//To send DOMDocument or non processed datafile if it is set to false
					success: function (response) {
					 	if (response) {
					 		document.getElementById('chatlog').innerHTML += '<div class="chat-ck self"><div class="photo-ck"><img src="templates/pics/'+ senderPic +'" alt=""></div><div class="message-ck"><p>'+ message +'</p></div></div>';
					 		$("#message").value = '';

					 		var chatbox = document.getElementById("chatlog");
							chatbox.scrollTop = chatbox.scrollHeight;

					 	}else{

					 	}
					}
					});
				}else {
					
				}
				
				});

			var chatbox = document.getElementById("chatlog");
			chatbox.scrollTop = chatbox.scrollHeight;

			function load_newchats(){
				var newlast = 0;
				var chatroom = 1; 
				var currentchat = <?php echo $currentchat; ?>;
				formData = new FormData();
				formData.append('lastchat', lastchat);
				formData.append('chatroom', chatroom);
				formData.append('me', user);
				formData.append('chatmate', currentchat);
				$.ajax({
					url:"getChats.php",
					type: "POST",
					data:formData,
					contentType: false,
					cache: false,//to unable request page to be cached
					processData: false,//To send DOMDocument or non processed datafile if it is set to false
					success: function (response) {
					 	var jsonData = JSON.parse(response);
					 	var jsonlength = jsonData.results.length;
					 	for(var i = 0; i < jsonlength; i++){
					 		var result = jsonData.results[i];
					 		if(result.member != user){
					 			document.getElementById('chatlog').innerHTML += '<div class="chat-ck friend"><div class="photo-ck"><img src="templates/pics/'+ result.senderPic+ '" alt=""></div><div class="message-ck"><p>'+ result.chat +'</p></div></div>';
					 			lastchat = result.chat_id;
					 		}
					 		
					 	}
					 	var chatbox = document.getElementById("chatlog");
						chatbox.scrollTop = chatbox.scrollHeight;

					}
					});
				
			}
			setInterval(function function_name () {
				load_newchats();
			}, 2000);
			
		</script>
<?php include 'includes/footer.php'; ?>