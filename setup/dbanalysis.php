<?php 
session_start();
if(isset($_SESSION['uid']) && $_SESSION['ulev'] == 0){
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
<title>::Results::</title>
<link rel="stylesheet" href="../css/mainmenu.css" type="text/javascript" />

</head>

<body>
<div id="mainframe"  align="center">
<span  align="center" style="font-family:'Arial Black', Gadget, sans-serif; font-size:24px; color:#090">Setup</span><br />

<table border = "0"  align="center" width="400">
	<tr>
		<td align="right" width="100">
		<form action = "../uploadResults.php" method = "post" name = "stdresult" target="dispframe">
			<input type="submit" value="     " id="trans"  height="20px"/>
		</form>
		</td>
		<td align="left">Analyze Database</td>
		
	</tr>
	<tr>
		<td align="right">
		<form action="statisticalsummary.php" method="post" >
			<input type="submit" value="     " id="carry" />
		</form>
		</td>
		<td align="left">DB Results Summary</td>
		
	</tr>
	<tr>
		<td align="right">
		<form action="#" method="post" name = "adjTranscrip" onclick="">
			<input type="submit" value= "     " id = "summary"/>
		</form>
		</td>
		<td align="left">&nbsp;</td>
		
	</tr>
	<tr>
		<td align="right">
		<form action="#" method="post" name = "adjTranscrip" onclick="">
			<input type="submit" value= "     " id = "summary"/>
		</form>
		</td>
		<td align="left">&nbsp;</td>
		
	</tr>
    <tr>
		<td align="right">
		<form action="#" method="post" name = "adjTranscrip" onclick="">
			<input type="submit" value= "     " id = "summary"/>
		</form>
		</td>
		<td align="left">&nbsp;</td>
		
	</tr>

</table>

</div>
<p align="center">
		<form action="setup.html" method="post" name = "adjTranscrip" onclick="">
			<input type="submit" value= "Back" id = "summary"/>
		</form></p>
</body>

</html>
