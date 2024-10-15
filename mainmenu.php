
<?php 
	include("include/header.inc");	
	//include("dbconn.php"); 
	include("functions.php");

	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	//$login = login($username, $password);
	if (($username != 'admin') or ($password !=  'r')){
		header('location:login.html');
	}
?>

<?php
	include("include/footer.inc");
?>