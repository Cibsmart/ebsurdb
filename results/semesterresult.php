<?php 
	session_start();
	if((isset($_SESSION['uid']) && $_SESSION['ulev'] == 0) || (isset($_SESSION['uid']) && $_SESSION['ulev'] == 3)){
		$cid = $_SESSION['uid'];
	}
	else{
		if(isset($_GET['z'])){
			$cid = 0000;
		}
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
    	<form action="actions/dosemesterresult.php" method="post" name="newstudent" target="_blank"><br />
        <table align="center">
        	<tr>
            	<td align="right">Registration Number:</td>
                <td><input type="text" name="reg_no" autofocus="autofocus" autocomplete="on"/></td>
            </tr>
            <tr>
            	<td align="right">Session:</td>
                <td>
                	<select name="session" id="session">
                    	<option value="" selected="selected"></option>
                    	<option value="1999/2000">1999/2000</option>
                        <option value="2000/2001">2000/2001</option>
                        <option value="2001/2002">2001/2002</option>
                        <option value="2002/2003">2002/2003</option>
                        <option value="2003/2004">2003/2004</option>
                        <option value="2004/2005">2004/2005</option>
                        <option value="2005/2006">2005/2006</option>
                        <option value="2006/2007">2006/2007</option>
                        <option value="2007/2008">2007/2008</option>
                        <option value="2008/2009">2008/2009</option>
                        <option value="2009/2010">2009/2010</option>
                        <option value="2010/2011">2010/2011</option>
                        <option value="2011/2012">2011/2012</option>
                    </select>
                </td>
            </tr>
            <tr>
            	<td align="right">Semester:</td>
                <td>
                	<select name="semester" id="semester">
	                    <option value="" selected="selected"></option>
                    	<option value="first">First</option>
                        <option value="second">Second</option>
                	</select>
                </td>
            </tr>
        </table>
        	<div align="center"> <br /><p align="center" style="color:#C00; font-family:Arial, Helvetica, sans-serif; font-size:12px;">example Reg No: EBSU/2009/51486 
			<br /><br /><input type="submit" name="bttn_new_student" value="Check Semester Result" /></p></div>
            
        </form>
       
    </div>
</body>
</html>
