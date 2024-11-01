<?php
//Start Session
session_start();

//Include Configuration
require_once('config/config.php');
require_once('helpers/system_helper.php');

//Auto_Load Classes
 spl_autoload_register(
 	function($class_name){
 	 require_once('libraries/'.$class_name.'.php');	
 	}

 	);
 ?>

