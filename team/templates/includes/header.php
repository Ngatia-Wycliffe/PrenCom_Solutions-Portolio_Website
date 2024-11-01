 <?php if(isLoggedIn()) : ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Project Control-Manage from One Platform</title>
	<link rel="stylesheet" href="templates/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="templates/icons.css">
	<link rel="stylesheet" href="templates/css/mystyler.css">
	<link rel="stylesheet" href="templates/css/extra.css">
	<link rel="stylesheet" href="templates/css/dashboard.css">
	<script src="templates/bootstrap/js/jquery.min.js" type="text/javascript"></script>
	

	<script src="templates/javascripts/moment.js"></script>
	<script src="templates/javascripts/ajax-controller.js"></script>
	<script src="templates/javascripts/Bridge.js"></script>




	
</head>
<body>
 <div class="container-fluid">
 	<span id="member" class="mem"><?php echo $_SESSION['member_id']; ?></span>
 	<span class="reveal" id="expandbtn">Chat With<i class="material-icons md-36 icon-align-bottom">expand_less</i></span>
 	<div class="side-tray " id="tray">
		
		<ul> 
			<span class="close-n" id="returnbtn" class="mr-1" style="float: right;">&times</span>
			<h5 class="">Chat With</h5><hr style="margin-bottom: 3px">

			<?php foreach($members as $member): ?>
			<?php if($_SESSION['member_id'] == $member['member_id']){ continue;} ?>
			<li class="ck-item" onclick="startConversation(<?php echo $member['member_id'] ?>)">
				<span><img src="templates/pics/<?php echo $member['profile_pic']; ?>" class="photo img-thumbnail rounded-circle ml-2 mr-4 p-0" alt=""></span><span><?php echo $member['fname'].' '.$member['lname']; ?></span>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
	
	<div class="row ck-workspace" >
		<div class=" col col-sm-2 ck-sidebar" id="ck-sidebar"<?php if(!$teamAdmin): ?> <?php endif; ?>>
			<div class="ck-logo  pt-2 pl-3 pb-2">
				<h4><i><front>Project</front>&nbsp;<line>Control</line></i></h4>
			</div>
			<div class="ck-menu  pt-2 pl-4 ">
				<?php if($teamAdmin): ?>
				<div class="ck-list">
					<h5><a href="dashboard.php">Home</a></h5>
				</div>
				<div class="ck-list">
					<ul class="pl-4">
						<!-- <li><a href="newproject.php">New Project</a></li> -->
						<li><a href="addtask.php" class="">New Task</a></li>
						<li><a href="addmember.php" class="">New Member</a></li>
					</ul>
				</div>
				<?php endif; ?>
				<div class="ck-list">
					<h5><a href="index.php">Team</a></h5>
					<ul class="pl-4">
						<li><a href="index.php">Team Members</a></li>
						<li><a href="teamchats.php">Team Chats</a></li>

					</ul>
				</div>
				<?php if($teamAdmin): ?>
				<div class="ck-list">
					<h5><a href="tasks.php" class="">Tasks</a></h5>
					<ul class="pl-4">
						<li><a href="tasks.php" class="">Assigned</a></li>
						<li><a href="unassignedTasks.php" class="">Unassigned</a></li>
						<li><a href="completed.php" class="">Completed</a></li>
					</ul>
				</div>
				<?php else: ?>
				<div class="ck-list">
					<h5><a href="mytasks.php">Tasks</a></h5>
					<ul class="pl-4">
						<li><a href="mytasks.php">All MyTasks</a></li>
						<li><a href="scheduled.php">Scheduled Tasks</a></li>
						<li><a href="#" class="">Unscheduled Tasks</a></li>
					</ul>
				</div>

				<?php endif; ?>
				<div class="ck-notify1">
					<h6><a href="messages.php">Messages</a><span class="badge badge-danger ml-2"></span></h6>
					
				</div>
				
			</div>
		</div>
		<div class="col-10 ck-content" <?php if(!$teamAdmin): ?>  <?php endif; ?>>
			<div class="ck-header  d-flex justify-content-between" style="clear: both">
				<div class="ck-nav" >
					<nav class="nav mynav" >
						<a class="nav-link ck-active"href="#"><?php echo $_SESSION['team_name']; ?> Team Account</a>
					</nav>

				</div>
				<div class="today">
					Today <span><?php print(date('jS M')) ;?></span> <span id="clock"></span>
				</div>
				<div class="ck-account">
					<span onclick="taskAlert()" class="user mr-2"><?php echo $_SESSION['name'] ;?><small class="text-muted ml-2"><?php echo $_SESSION['job']; ?></small>
					</span>

					<span class="ck-dropdown">
						<a class="" href="#"><img id="myimg" src="templates/pics/<?php echo $_SESSION['mypic']; ?>" class="ck-profile img-thumbnail rounded-circle ml-2 mr-4 p-0" onclick="showMenu()" alt=""></a>
						<div id="myDropdown" class="mydropdown">
							<a href="#"><form class="" role="form" method="post" action="logout.php"><button type="submit" name="logOut" class="btn" style="background:white;cursor: pointer;">Log Out</button></form></a>
						</div><br>
					</span>
					
				</div>
			</div>

<!-- JavaScript Scripts -->

		<script type="text/javascript" charset="utf-8" async defer>
			function showTime(){
				var date = new Date();
				var h = date.getHours();
				var m = date.getMinutes();
				var s = date.getSeconds();
				var session  = "AM";
				 if (h == 0) {
				 	h = 12;
				 }
				 if (h > 12){
				 	h = h - 12;
				 	session = "PM"
				 }
				 h = (h < 10) ? "0" + h : h;
				 m = (m < 10) ? "0" + m : m;
				 s = (s < 10) ? "0" + s : s;
				 $("#clock").text(h + ": "+ m + ": "+ s + " "+ session);
				setTimeout(showTime, 1000);
			}

			showTime();

			function startConversation(friend){
				window.location.href = 'privatechat.php?id='+friend;
			}

			function showMenu () {
				// // body... 
				$("#myDropdown").toggleClass('dropdownEffect');
				$("#myDropdown").toggleClass('show');
			}
			
			$('html').click(function(event) {
				/* Act on the event */
				// if (!$('#myDropdown').is(':hidden')) {
					if(!event.target.matches('#myimg')){
						if(!$('#myDropdown').is(':hidden')){
							$("#myDropdown").removeClass('show');
							$('#myDropdown').removeClass('dropdownEffect');
						}
					}
				// }
			});

			$("#expandbtn").click(function(event) {
				/* Act on the event */
				$(".side-tray").toggleClass("sideTray");
				$("#expandbtn").fadeOut('2000');
				});
			$("#returnbtn").click(function(event) {
				/* Act on the event */
				$(".side-tray").toggleClass("sideTray");
				$("#expandbtn").fadeIn(3000);
				});
			$(window).load(function() {
				var mypanel = document.getElementById('ck-panel');
				mypanel.addClass('revealPanel');
				});
	  	</script>

		<script type="text/javascript" charset="utf-8" async defer>

			$(document).ready(function() {

				$("#assign").click(function() {
					/* Act on the event */
					$("#myModal").fadeIn('slow');
					$(".modal-content").slideDown('5000');
				});
				$("#close1").click(function() {
					/* Act on the event */
					$("#myModal").fadeOut('6000');
					$(".modal-content").slideUp('5000');
				});
					
			})
	</script>
		<?php endif; ?>

