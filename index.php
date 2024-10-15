<?php
	session_start();
	ob_start();

	include("dbconn.php"); 
	include('utilities/logging.php');
	include("functions.php");
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$login = login($username, $password);
		
	
	include("include/head.php");	
	

	
	include("include/footer.inc");
?>
