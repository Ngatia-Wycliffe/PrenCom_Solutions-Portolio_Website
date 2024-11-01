<?php require('core/init.php'); ?>
<?php 
	$user = new User;
	$project = new Project;
	$template = new Template('templates/newproject.php');

	$template->teamAdmin = $user->getAccount($_SESSION['member_id']);
	$template->members = $user->getMembers($_SESSION['team_id']);
	$template->projects = $project->checkProjects($_SESSION['member_id']);
	if (isset($_POST['finish'])) {
		$title = $_POST['project'];
		$project->addProject($title, $_SESSION['member_id']);
	}
	echo $template;

 ?>