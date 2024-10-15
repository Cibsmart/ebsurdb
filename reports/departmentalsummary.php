<?php
session_start();
	
	if((isset($_SESSION['uid']) && $_SESSION['ulev'] == 0) || (isset($_SESSION['uid']) && $_SESSION['ulev'] == 3)){
		$cid = $_SESSION['uid'];
	}
	else{	
			$act = "Forbidden - Not a Valid User";
			header("location:../login.php?a=".$act);
	}
include("func.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Departmental Summary</title>
<script type="text/javascript" src="../jscript/jquery.js" ></script>
<script type="text/javascript" src="reportjs.js"></script>
<style>
	.aa{
		text-align:right;
		font-size:15px;
		font-weight:bold;
	}
	.ab{
		text-align:left;
	}
</style>
</head>

<body>
<div style="font-size:20px; font-family:Arial, Helvetica, sans-serif; font-weight:bolder; text-align:center; margin:auto; padding:20px">DEPARTMENTAL SUMMARY</div>
<div align="center" style="margin:auto; padding:20px; background:url(../images/back2.jpg); background-repeat:no-repeat; background-position:center; width:550px">
<form id="form1" name="form1" method="post" action="dodepartmentalsummary.php" target="_blank">
  <table width="550" border="0" cellpadding="2" cellspacing="5">
    <tr>
      <td class="aa" width="100">Faculty:</td>
      <td class="ab">
      	<select name="faculty" id="faculty" onchange="filldept(this.value)" >
			<?php 
				fillfaculty();
			?>
	    </select>
      </td>
    </tr>
    <tr>
      <td class="aa">Department:</td>
      <td class="ab">
     		<select name="dept" id="dept">
            	
	    	</select>
      </td>
    </tr>
    <tr>
      <td class="aa">Session:</td>
      <td class="ab">
      	<select name="session" id="session">
	      <option></option>
		    <option value="2015/2016">2015/2016</option>
            <option value="2014/2015">2014/2015</option>
            <option value="2013/2014">2013/2014</option>
            <option value="2012/2013">2012/2013</option>
            <option value="2011/2012">2011/2012</option>
            <option value="2010/2011">2010/2011</option>
            <option value="2009/2010">2009/2010</option>
            <option value="2008/2009">2008/2009</option>
            <option value="2007/2008">2007/2008</option>
            <option value="2006/2007">2006/2007</option>
            <option value="2005/2006">2005/2006</option>
            <option value="2004/2005">2004/2005</option>
            <option value="2003/2004">2003/2004</option>
            <option value="2002/2004">2002/2003</option>
            <option value="2001/2002">2001/2002</option>
            <option value="1999/2000">1999/2000</option>
            <option value="1998/1999">1998/1999</option>
        </select></td>
    </tr>
    <tr>
      <td class="aa">Level:</td>
      <td class="ab">
      <select name="level" id="level">
	    <option></option>
        <option value="100">100</option>
        <option value="200">200</option>
        <option value="300">300</option>
        <option value="400">400</option>
        <option value="500">500</option>
      </select></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="button" name="buton" id="buton" value="Summary" onclick="process()" /></td>
      </tr>
  </table>
  
</form>
</div>
</body>
</html>