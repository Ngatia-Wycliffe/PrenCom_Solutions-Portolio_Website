<?php require('core/init.php'); ?>
<?php 
	$user = new User;
	$tasks = new Task;
	$schedule = new Schedule;
	$template = new Template('templates/scheduled.php');
	if (isset($_SESSION['member_id'])) {
		$template->teamAdmin = $user->getAccount($_SESSION['member_id']);
		$state = 1;
		$tommorow = new Datetime();
		$tommorow->modify('+1 day');
		$afterTommorow = new Datetime();
		$afterTommorow->modify('+2 days'); 
		$weekEnd = new Datetime();
		$weekEnd->modify('this week +6 days');
		$nextweekEnd = new Datetime();
		$nextweekEnd->modify('this week +12 days');
		$template->tasks = $tasks->getMyTasks($_SESSION['member_id']);
		$template->members = $user->getMembers($_SESSION['team_id']);
		$template->todaysTasks = $schedule->getTodaystasks(date("Y-m-d"), $_SESSION['member_id']);
		if ($tommorow <= $weekEnd) {
			$template->tommorowsTasks = $schedule->getTommorowstasks($tommorow->format("Y-m-d"), $_SESSION['member_id']);
		}else{
			$template->tommorowsTasks = '';
		}
		if($afterTommorow < $weekEnd){
			$template->thisWeeks = $schedule->getRestoftheWeek($afterTommorow->format("Y-m-d"), $weekEnd->format("Y-m-d"), $_SESSION['member_id']);
			$template->nextWeeks = $schedule->getNextWeek($weekEnd->format("Y-m-d"), $nextweekEnd->format("Y-m-d"), $_SESSION['member_id']); 
		}else{
			$template->nextWeeks = $schedule->getNextWeek($afterTommorow->format("Y-m-d"), $nextweekEnd->format("Y-m-d"), $_SESSION['member_id']); 
			$template->thisWeeks = '';
		}
		$template->afterNextweek = $schedule->getafterNextWeek($nextweekEnd->format("Y-m-d"), $_SESSION['member_id']); 
		
		echo $template;

	}else{
 		header('Location:Login.php');
 	}
	
    
 ?>