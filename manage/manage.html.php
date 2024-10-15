<?php

    session_start();
	if(isset($_SESSION['uid'])){
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
<title>::Manage Results::</title>
<link rel="stylesheet" href="../css/mainmenu.css" type="text/javascript"/>
</head>

<body>
<div id="mainframe" align="center">
<span  align="center" style="font-family:'Arial Black', Gadget, sans-serif; font-size:24px; color:#090">Results</span><br />

<table border = "0"  align="center" width="400">
	<tr>&nbsp;</tr>
	
	<tr>
		<td align="right">
		<form action="progresssheet.detail.php" method="post" name = "progresssheet.detail" target="dispframe">
			<input type="submit" value= "     " id = "summary"/>
		</form>
		</td>
		<td align="left"><span id="cibsmart">Progress Sheet with update info</span></td>
		
	</tr>
	
	<tr>
		<td align="right" width="100">
		<form action = "manage.php" method = "post" name = "manage" target="dispframe">
			<input type="submit" value="     " id="trans"  height="20px"/>
		</form>
		</td>
		<td align="left"><span id="cibsmart">Manage Results </span></td>
		
	</tr>
	
		<tr>
		<td align="right" width="100">
		<form action = "outstandingresult.php" method = "post" name = "manage" target="dispframe">
			<input type="submit" value="     " id="trans"  height="20px"/>
		</form>
		</td>
		<td align="left"><span id="cibsmart">Outstanding Results</span></td>
		
	</tr>
	
	
	<tr>&nbsp;</tr>
    </tr>
	<tr><td><hr /></td><td><hr /></td></tr>
    <?php if($lev == 0): ?>
    <tr>
		<td align="right">
		<form action="viewmanaged.php" method="post" name="viewmanaged" target="dispframe">
			<input type="submit" value="     " id="summary" />
		</form>
		</td>
		<td align="left"><span id="cibsmart">View Managed Results</span></td>
    </tr>
    <tr>&nbsp;</tr>
	<tr>
		<td align="right">
		<form action="../reports/upupdata.php" method="post" name="update" target="dispframe">
			<input type="submit" value="     " id="summary" />
		</form>
		</td>
		<td align="left"><span id="cibsmart">Update Student Information</span></td>
    </tr>
	<?php endif; ?>
</table>

</div>
</body>

</html>
