<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = "Contact Button on Website: ".$_POST['subject'];
	$body = $_POST['message'];

	$to = "info@prencomsolutions.com";
	$from = $name." <".$email.">";

	$result = mail($to,$subject,$body,$from);

	if ($result) {
		echo "			
			<div class=\"alert alert-success alert-dismissable text-center\">
	            <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
	            <p>Your Message was sent Successfully.<strong> We will reply within the shortest period possible.</strong> Thankyou for contacting us.</p>
	        </div>
		";
	}else{
		echo "
			<div class=\"alert alert-danger alert-dismissable text-center\">
	            <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
	            <p>An error occured while sending your Message.<strong> Refresh the page and try again.</strong> We apologise for the inconvinience.</p>
	        </div>
		";
	}
}
?>