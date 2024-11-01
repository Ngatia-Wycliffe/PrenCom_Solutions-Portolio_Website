<?php require('core/init.php'); ?>
<?php 
	$task = new Task;
	$taskid = $_POST['taskid'];
	if (is_uploaded_file($_FILES['myfile']['tmp_name'])) {
		if ($task->uploadFile1()) {
			$file = $_FILES['myfile']['name']; 
			if ($task->uploadfileDetails($file, $taskid, $_SESSION['member_id'])) {
			echo "File Uploaded";
			}else{
			echo "Something went wrong during uploading";
			}
		}else{
			echo "Something went wrong";
		}
	}
 ?>	
