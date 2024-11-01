<?php require('core/init.php'); ?>
<?php 
	$user = new User;

	$template = new Template('templates/registration.php');

	if (isset($_POST['register'])) {
		$data = array();
		$data['fname'] = $_POST['fname'];
		$data['lname'] = $_POST['lname'];
		$data['job'] = $_POST['job'];
		$data['email'] = $_POST['email'];
		$data['password'] = $_POST['pwd'];
		
    if ($user->uploadProfilePic()) {
    	$data['pic'] = $_FILES["pic"]["name"];
    }
    if($user->isInvited($data['email'])){
		    if ($user->addToTeam($data)) {
		   		redirect('Login.php','Successfully Registered','success');
		   		}else{
		   		redirect('registration.php','Something went wrong with your Registration','error');
		   		}
    }else{

    	redirect('Login.php','Registration Failed!! You have to recieve an Invitation Link to Join a team account','error' );
    	exit();
    }
   
}
	echo $template;
	
?>   
