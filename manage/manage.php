<?php 
	session_start();
	if((isset($_SESSION['uid']) && $_SESSION['ulev'] == 0) || (isset($_SESSION['uid']) && $_SESSION['ulev'] == 1)  || (isset($_SESSION['uid']) && $_SESSION['ulev'] == 2) ){
		$cid = $_SESSION['uid'];
	}
	else{
		if(isset($_GET['r'])){}
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
<script type="text/javascript" src="../jscript/jquery.js" ></script>
<script type="text/javascript" src="manageJS.js"></script>
<title>::Manage Students' Results::</title>
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
    	<form action="actions/domanageresults.php" method="post" name="newstudent" target="_blank"><br />
        <table align="center">
        	<tr>
            	<td align="right">Registration Number:</td>
                <td><input type="text" name="reg_no" id ="reg_no" autofocus="autofocus" autocomplete="on" onchange="loadsession(this.value), loadsemester(), loadcode(), loadcourse()" onkeyup="loadsession(this.value), loadsemester(), loadcode()"/></td>
            </tr>

             <tr>
            	<td align="right">Session:</td>
                <td>
                
                	<select name="session" id="session" onchange="loadsemester(), loadcode(), loadcourse()">
                    	<option value=" " selected="selected"> </option>
                    </select>
                    </td>
            </tr>
            
            <tr>
            	<td align="right">Semester:</td>
                <td>
                
                	<select name="semester" id="semester" onchange="loadcode(), loadcourse()">
                    	<option value=" " selected="selected"> </option>
                    </select>
                </td>
            </tr>
            <tr>
            	<td align="right">Course Code:</td>
                <td>
                
                	<select name="code" id="code" onchange="loadcourse()">
                    	<option value=" " selected="selected"> </option>
                    </select>
                </td>
            </tr>
         </table>
        </form>
    </div>
    <p align="center">
		<form action="manage.html.php" method="post" name = "adjTranscrip" >
			<input type="submit" value= "Back" id = "summary"/>
		</form>
   	</p>
    <div id="result">
    
    </div>
</body>
</html>
