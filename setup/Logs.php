<?php 
session_start();
	if(isset($_SESSION['uid']) && $_SESSION['ulev'] ==  0){
		$cid = $_SESSION['uid'];
	}
	else{	
			$act = "Forbidden - Not a Valid User";
			header("location:../login.php?a=".$act);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: User Logs ::</title>
<link rel="stylesheet" href="../css/mainmenu.css" type="text/javascript" />

</head>

<body>
<div id="mainframe"  align="center">
<span  align="center" style="font-family:'Arial Black', Gadget, sans-serif; font-size:24px; color:#090">Logs</span><br />

<table border = "0"  align="center" width="400">
	<tr>
		<td align="right" width="100">
		<form action = "actions/allLogs.php" method = "post" name = "stdresult" target="_blank">
			<input type="submit" value="     " id="trans"  height="20px"/>
		</form>
		</td>
		<td align="left"><span id="cibsmart">All Logs</span></td>
		
	</tr>
	<tr>
		<td align="right">
		<form action="../uploadFinalResults.php" method="post" >
			<input type="submit" value="     " id="carry" />
		</form>
		</td>
		<td align="left">Monthly Logs</td>
		
	</tr>
	<tr>
		<td align="right">
		<form action="../uploadMedicalResults.php" method="post" name = "adjTranscrip" onclick="">
			<input type="submit" value= "     " id = "summary"/>
		</form>
		</td>
		<td align="left"><span id="cibsmart">Weekly Logs</span></td>
		
	</tr>
	<tr>
		<td align="right">
		<form action="../uploadNominal.php" method="post" name = "adjTranscrip" onclick="">
			<input type="submit" value= "     " id = "summary"/>
		</form>
		</td>
		<td align="left"><span id="cibsmart">Daily Logs</span></td>
		
	</tr>
    <tr>
		<td align="right">
		<form action="../uploadSessList.php" method="post" name = "adjTranscrip" onclick="">
			<input type="submit" value= "     " id = "summary"/>
		</form>
		</td>
		<td align="left"><span id="cibsmart">Individual Logs</span></td>
		
	</tr>
    <tr>
		<td align="right">
		<form action="../uploadSessList.php" method="post" name = "adjTranscrip" onclick="">
			<input type="submit" value= "     " id = "summary"/>
		</form>
		</td>
		<td align="left"><span id="cibsmart">Individual Daily Logs</span></td>
		
	</tr>

</table>

</div>
<p align="center">
		<form action="setup.html" method="post" name = "adjTranscrip" onclick="">
			<input type="submit" value= "Back" id = "summary"/>
		</form></p>
</body>

</html>
