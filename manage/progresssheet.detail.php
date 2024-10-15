<?php 
	session_start();
	
	if((isset($_SESSION['uid']) && $_SESSION['ulev'] == 0) || (isset($_SESSION['uid']) && $_SESSION['ulev'] == 1)  || (isset($_SESSION['uid']) && $_SESSION['ulev'] == 2) ){
		$cid = $_SESSION['uid'];
	}
	else{
		if(isset($_GET['z'])){}
		else{
			$act = "Forbidden - Not a Valid User";
			header("location:../login.php?a=".$act);
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::Check Semester Results::</title>
<style>
	div.cib {
		margin:auto;
		width:400px;
		border:medium;
		background-image: url(../images/login_bg.jpg);
		background-repeat: no-repeat;
		padding: 4px;
		height: 200px;
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
    	<form action="actions/doprogresssheet.detail.php" method="post" name="newstudent" target="_blank"><br />
        <table align="center">
        	<tr>
            	<td align="right">Registration Number:</td>
                <td><input type="text" name="reg_no" autofocus="autofocus" autocomplete="on"/>
                	<input type="hidden" name="z" value="0" />
                </td>
            </tr>
            
         </table>
        	<div align="center"> <br /><p align="center" style="color:#C00; font-family:Arial, Helvetica, sans-serif; font-size:12px;">example Reg No: EBSU/2009/XXXXX 
			<br /><br /><input type="submit" name="buton" value="Progress Sheet" /></p></div>
            
        </form>
       
    </div>
</body>
</html>
