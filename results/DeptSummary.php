<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Result Departmental Summary</title>
<link rel="stylesheet" href="../cib.css" type="text/css" />
<script language="JavaScript" type="text/javascript">
//--------------- LOCALIZEABLE GLOBALS ---------------
var cid=new Date();
var monthname=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
//Ensure correct for language. English is "January 1, 2004"
var TODAY = monthname[cid.getMonth()] + " " + cid.getDate() + ", " + cid.getFullYear();
//---------------   END LOCALIZEABLE   ---------------
</script>
<style type="text/css">
<!--
.style1 {color: #336600}
-->
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0" id= "Heads">
  <tr>&nbsp;</tr>
  <tr bgcolor="#FFFFFF">
    <td  valign="top" width="100%" colspan="7" rowspan="2" align = "center"><img src = ../images/logo.jpg width = 40 height = 45/><br /><b><font size = 3 face="Geneva, Arial, Helvetica, sans-serif">EBONYI STATE UNIVERSITY RESULT DATABASE</font></b></td>
  </tr>
  <tr>
    <td colspan="7" bgcolor="#5C743D"><img src="file:///C|/wamp/www/mm_spacer.gif" alt="" width="1" height="2" border="0" /></td>
  </tr>

  <tr>
    <td colspan="7" bgcolor="#99CC66" background="file:///C|/wamp/www/mm_dashed_line.gif"><img src="file:///C|/wamp/www/mm_dashed_line.gif" alt="line decor" width="4" height="3" border="0" /></td>
  </tr>

  <tr bgcolor="#99CC66">
  	<td colspan="7" id="dateformat" height="20" bgcolor="#9900FF">&nbsp;&nbsp;<script language="JavaScript" type="text/javascript">
      document.write(TODAY);	</script>	</td>
  </tr>
  <tr>
	<table border="0" cellspacing="0" cellpadding="0" width="100%" id="navigation">
        <tr bgcolor="#FFFFCC">
          <td width="5%">&nbsp;</td>
		  <td width="18%"><a href="../../rdb.html" class="navText">Home</a></td>
          <td width="18%"><a href="javascript:;" class="navText">Students</a></td>
          <td width="18%"><a href="../results.html" class="navText">Results</a></td>
          <td width="18%"><a href="../reports.html" class="navText">Reports</a></td>
          <td width="18%"><a href="../setup.html" class="navText">Setup</a></td>
		  <td width="5%">&nbsp;</td>
        </tr>
      </table>  
  </tr>
</table>
</head>
<?php 	include "actions/f.php";// Includes the file that connects to the DB 
	$query = "Select Dept from dept order by Dept";
	$act = mysql_query($query);
	$num_dept = mysql_num_rows($act);	
?>

<body>
<p  align="center"><b><font size = "+2" face="Arial, Helvetica, sans-serif">Departmental Summary</font></b></p>
<p align="center"> <img src="../images/rule.gif" width = "80%"  height="10"/></p>

<form action="actions/doDeptSummary.php" method="post" name="form1" id="form1" target="_blank">
  <table width="50%" border="0" align="center">
    <tr>
      
      <td>Department:</td>
      <td><label>
        <select name="Dep">
		<option value = 0>Select Department</option>
<?php		 for ($i = 1; $i <= $num_dept; $i++)
			{	$r = mysql_fetch_array($act);
				$rr = $r["Dept"];
?>
				<option value = <?php echo $i ?> > <? echo $rr ?> </option>
<?php			}
?>					 
		</select>
      </label></td>
      
    </tr>
	<tr>&nbsp;</tr>
    <tr>
      
      <td>Set:</td>
      <td><label>

        <select name = "Set">
		<option value = 0>Select Student's Set</option>
		<option value = 1999 > 1999 </option>
		<option value = 2000 > 2000 </option>
		<option value = 2001 > 2001 </option>
		<option value = 2002 > 2002 </option>
		<option value = 2003 > 2002 </option>
		<option value = 2004 > 2003 </option>
		<option value = 2005 > 2005 </option>
		<option value = 2006 > 2006 </option>
		<option value = 2007 > 2007 </option>
		<option value = 2008 > 2008 </option>
		<option value = 2009 > 2009 </option>
		<option value = 2010 > 2010 </option>
		<option value = 2011 > 2011 </option>
		<option value = 2012 > 2012 </option>
		<option value = 2013 > 2013 </option>
		<option value = 2014 > 2014 </option>

      </label> </td>
      
    </tr> 
    <tr> 
      
      
      <td colspan = "2" align = "center" ><label>
        <input type = "submit" name = "Submit" value = "Submit" />
      </label> </td>
      
    </tr>
  </table>
</form>
<p align="center"> <img src="../images/rule.gif" width = "80%"  height="10"/></p>
</body>
</html>