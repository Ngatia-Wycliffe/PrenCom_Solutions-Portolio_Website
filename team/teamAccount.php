<?php require('core/init.php'); ?>
<?php 
	$user = new User;

	$template = new Template('templates/teamAccount.php');

	if (isset($_POST['register'])) {
		$data = array();
		$data['fname'] = $_POST['fname'];
		$data['lname'] = $_POST['lname'];
		$data['job'] = $_POST['job'];
		$data['email'] = $_POST['email'];
		$data['password'] = $_POST['pwd'];
		$data['team'] = $_POST['team'];
		
    if ($user->uploadProfilePic()) {
    	$data['pic'] = $_FILES["pic"]["name"];
    }
   if ($user->register($data)) {
   		redirect('Login.php','Successfully Registered','success');
   }else{
   		redirect('teamAccount.php','Something went wrong with your Registration','error');
   }
}
	echo $template;
	
?>   
