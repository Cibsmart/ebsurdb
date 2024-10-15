<?php 
	session_start();
	if((isset($_SESSION['uid']) && $_SESSION['ulev'] == 0) || (isset($_SESSION['uid']) && $_SESSION['ulev'] == 3)){
		$cid = $_SESSION['uid'];
	}
	else{
			$msg = "Forbidden - Not a Valid User";
			header("location:../login.php?a=".$msg);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::New Student Info::</title>
<style>
	div.cib {
		margin:auto;
		width:400px;
		border:medium;
		background-image: url(../images/login_bg.jpg);
		background-repeat: no-repeat;
		padding: 4px;
		height: 150px;
		font-family: Verdana, Geneva, sans-serif;
		font-size: 12px;
		font-weight: bold;
		color: #000;
	}
</style>

</head>

<body>
	<p id="cka" style="font-family:'Arial Black', Gadget, sans-serif; color:#F00;" align="center">&nbsp;</p>
	<div class="cib">
    	<p >&nbsp;</p>
    	<form action="processviewstudent.php" method="post" name="newstudent" target="new">
        	<div align="center">Registration Number: <input type="text" name="reg_no" autofocus="autofocus" autocomplete="on"/><br /><p align="center" style="color:#C00; font-family:Arial, Helvetica, sans-serif; font-size:12px;">example: EBSU/2009/51486 
			<br /><br /><input type="submit" name="buton" value="View Student Profile" /></p></div>
            
        </form>
    </div>
</body>
</html>
