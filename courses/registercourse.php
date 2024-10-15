<?php 
	session_start();

	if((isset($_SESSION['uid']) && $_SESSION['ulev'] == 0) || (isset($_SESSION['uid']) && $_SESSION['ulev'] == 3)){
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


<?php //include("ajaxcourse.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register Courses</title>
<script src="../jscript/jquery.js" language="javascript"></script>
<script language="javascript" src="course.js" ></script>
<style>
	.a{
		text-align:right;
		font-size:16px;
		font-weight:bold;
	}
</style>
</head>

<body>
<form action="" method="post" id="registercourse" name="registercourse" >

	<table width="400" border="0" align="center" background="../images/back3.jpg" cellpadding="2" cellspacing="4">
	  <tr>
	    <td class="a">Registration Number:</td>
	    <td><input type="text" size="20" id="reg_no" name="reg_no" onblur="loadcourses()" /></td>
      </tr>
	  <tr>
	    <td class="a">Session: </td>
	    <td><select id="session" name="session"  onchange="loadcourses()">
	      <option value="" selected="selected"></option>
	      <option value="2012/2013">2012/2013</option>
	      <option value="2011/2012">2011/2012</option>
	      <option value="2010/2011">2010/2011</option>
	      <option value="2009/2010">2009/2010</option>
        </select></td>
      </tr>
	  <tr>
	    <td class="a">Semester:</td>
	    <td><select id="semester" name="semester" onchange="loadcourses()">
	      <option value="" selected="selected"></option>
	      <option value="first">First</option>
	      <option value="second">Second</option>
        </select></td>
      </tr>
	  <tr>
	    <td class="a">Level:</td>
	    <td><select id="level" name="level" onchange="loadcourses()">
	      <option value="" selected="selected"></option>
	      <option value="100">100</option>
	      <option value="200">200</option>
	      <option value="300">300</option>
	      <option value="400">400</option>
	      <option value="500">500</option>
        </select></td>
      </tr>
  </table>
  <br />
        <div id="course" name = "course" align="center">
        </div>
</form>
</body>
</html>