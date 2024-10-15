<?php

    session_start();
	if(isset($_SESSION['uid']) && $_SESSION['ulev'] == 0){
		$cid = $_SESSION['uid'];
		$lev = $_SESSION['ulev'];
		$rdb = true;
	}
	else{
		if(isset($_POST['r'])){$rdb = false;}
		else{
			$msg = "Forbidden - Not a Valid User";
			header("location:../../login.php?a=".$msg);
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: View Managed Results::</title>
<link rel="stylesheet" href="../css/mainmenu.css" type="text/javascript"/>
</head>

<body>
<div id="mainframe" align="center">
<span  align="center" style="font-family:'Arial Black', Gadget, sans-serif; font-size:24px; color:#090">Results</span><br />

<table border = "0"  align="center" width="400">
	<tr>&nbsp;</tr>
	<tr>
		<td align="right" width="100">
		<form action = "regview.php" method = "post" name = "regview" target="dispframe">
			<input type="submit" value="     " id="trans"  height="20px"/>
		</form>
		</td>
		<td align="left"><span id="cibsmart">View By Reg. No.</span></td>
		
	</tr>
	
	<!--<tr>&nbsp;</tr>
    </tr>
    
    <tr>
		<td align="right">
		<form action="staffview.php" method="post" name="staffview" target="dispframe">
			<input type="submit" value="     " id="summary" />
		</form>
		</td>
		<td align="left"><span id="cibsmart">View By Staff</span></td>
    </tr>-->
    <tr>&nbsp;</tr>
	<tr>
		<td align="right">
		<form action="dateview.php" method="post" name="dateview" target="dispframe">
			<input type="submit" value="     " id="summary" />
		</form>
		</td>
		<td align="left"><span id="cibsmart">View By Date </span></td>
    </tr>
	
</table>
</div>

	<p align="center">
		<form action="manage.html.php" method="post" name = "adjTranscrip" >
			<input type="submit" value= "Back" id = "summary"/>
		</form>
   	</p>
</body>

</html>
