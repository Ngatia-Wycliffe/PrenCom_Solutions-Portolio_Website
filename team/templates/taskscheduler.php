<?php require('core/init.php'); ?>
 <?php if(isLoggedIn()) : ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Front-End Design Phase</title>
	<link rel="stylesheet" href="templates/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="templates/mystyler.css">
	<script src="templates/bootstrap/js/jquery.min.js" type="text/javascript"></script>
	<script src="templates/ajax-controller.js"></script>
	<script src="templates/myscript.js"></script>
</head>
<body>
 <div class="container-fluid">
 	<!-- <span class="reveal" id="expandbtn">Chat With <<</span> -->
 	<div class="side-tray " id="tray">
		
		<ul> 
	<span class="close-n" id="returnbtn" class="mr-1" style="float: right;">&times</span>
			<h5 class="">My Team</h5>

			<?php foreach($members as $member): ?>
			<li>
				<span><img src="templates/pics/<?php echo $member['profile_pic']; ?>" class="photo img-thumbnail rounded-circle ml-2 mr-4 p-0" alt=""></span><span><?php echo $member['fname'].' '.$member['lname']; ?></span>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
	
	<div class="row ck-workspace" >
		<div class=" col col-sm-2 ck-sidebar" id="ck-sidebar"<?php if(!$teamAdmin): ?> style="background: #6e628c;"<?php endif; ?>>
			<div class="ck-logo  pt-2 pl-3 pb-2">
				<h4><i><front>Work</front><line>Scheduler</line></i></h4>
			</div>
			<div class="ck-menu  pt-2 pl-4 ">
				<?php if($teamAdmin): ?>
				<div class="ck-list">
					<ul class="pl-4">
						<!-- <li><a href="newproject.php">New Project</a></li> -->
						<li><a href="#" class="">New Task</a></li>
						<li><a href="addmember.php" class="">New Member</a></li>
					</ul>
				</div>
				<?php endif; ?>
				<div class="ck-list">
					<h5><a href="index.php">Team</a></h5>
					<!-- <ul class="pl-4">
						<li><a href="index.php">Team Members</a></li>
						<li><a href="teamchats.php">Team Chats</a></li>

					</ul> -->
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
					<h5><a href="#">Tasks</a></h5>
					<ul class="pl-4">
						<li><a href="#">My Tasks</a></li>
						<li><a href="#">Active Tasks</a></li>
					</ul>
				</div>

				<?php endif; ?>
				<div class="ck-notify">
					<h6><a href="#">Messages</a><span class="badge badge-danger ml-2"></span></h6>
					
				</div>
				<div class="ck-notify">
					<h6><a id="myBtn" href="#">Notifications</a><span class="badge badge-danger ml-2"></span></h6>
					
				</div>
			</div>
		</div>
		<div class="col-10 ck-content" <?php if(!$teamAdmin): ?> style="background: #c7b9e8;" <?php endif; ?>>
			<div class="ck-header  d-flex justify-content-between">
				<div class="ck-nav">
					<nav class="nav mynav">
						<a class="nav-link ck-active" href="#">Dashboard> My Team</a>
					</nav>
				</div>
				<div class="ck-account">
					<span><form class="mr-4 mt-4" role="form" method="post" action="logout.php" style=" float:left;"><button type="submit" name="logOut" class="btn" style="cursor: pointer;">Log Out</button></form> </span>
					<span class="user mr-2"><?php echo $_SESSION['name'] ;?><small class="text-muted ml-2"><?php echo $_SESSION['job']; ?></small></span>
					<span><img src="templates/pics/<?php echo $_SESSION['mypic']; ?>" class="ck-profile img-thumbnail rounded-circle ml-2 mr-4 p-0" alt=""></span>
					
				</div>
			</div>















<!-- JavaScript Scripts -->
		<script type="text/javascript" charset="utf-8" async defer>

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
				$(".close").click(function() {
					/* Act on the event */
					$("#myModal").fadeOut('6000');
					$(".modal-content").slideUp('5000');
				});
					
			})
	</script>
		<?php endif; ?>

</div>
 </div>

	</script>
	<script src="templates/bootstrap/js/bootstrap.js" type="text/javascript"></script>
	<script src="templates/bootstrap/js/popper.js" type="text/javascript"></script>
	<script src="templates/bootstrap/js/tooltip.js" type="text/javascript"></script>
	<script src="templates/myscript.js" type="text/javascript"></script>
	
</body>
</html>