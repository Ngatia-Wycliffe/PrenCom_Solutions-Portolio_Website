<?php require('core/init.php'); ?>
<?php 

	$user = new User();
	$memberId = $_POST['memberId'];
	$member = $user->Identify($memberId);

 	echo $member;
 ?>