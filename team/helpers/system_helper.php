<?php 

//Redirect to page
function redirect($page = FALSE, $message = NULL, $message_type = NULL){
	if (is_string ($page)) {
		$location = $page;
	}else{
		$location = $_SERVER['SCRIPT_NAME'];
	}
	//Check for message
	if ($message != NULL) {
		$_SESSION['message'] = $message;
	}
	//Check for file type
	if ($message_type != NULL) {
		$_SESSION['message_type'] = $message_type;
	}
	//Redirect
	header('Location:'.$location);
	exit;
}

function displayMessage(){
	if (!empty($_SESSION['message'])) {
		$message = $_SESSION['message'];
	
	if (!empty($_SESSION['message_type'])) {
		$message_type = $_SESSION['message_type'];
		if ($message_type == 'error') {
			echo '<div class = "alert alert-danger" id = "notice">'.$message.'</div>';
		} else {
			echo '<div class = "alert alert-success" id = "notice">'.$message.'</div>';
		}
		
	}
	unset($_SESSION['message']);
	unset($_SESSION['message_type']);
}
else{
	echo "";
}
}

//Check if User Is Logged In
function isLoggedIn(){
	if (isset($_SESSION['isLoggedIn'])) {
		return true;
	} else {
		return false;
	}
	}

// Get Logged in User Info
	function getUser(){
		$userArray = array();
		$userArray['member_id'] = $_SESSION['member_id'];
		$userArray['name'] = $_SESSION['name'];
		$userArray['team'] = $_SESSION['team_id'];

		return $userArray;
	}



 ?>

