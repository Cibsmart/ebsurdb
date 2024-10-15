<?php include("func.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::Check Staff List::</title>
<script type="text/javascript" src="../jscript/jquery.js" ></script>
<script type="text/javascript" src="staffjs.js"></script>
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
<div style="font-size:20px; font-family:Arial, Helvetica, sans-serif; font-weight:bolder; text-align:center; margin:auto; padding:20px">VIEW STAFF LIST</div>
<div align="center" style="margin:auto; padding:20px; background:url(../images/back2.jpg); background-repeat:no-repeat; background-position:center; width:550px">
<form id="form1" name="form1" method="post" action="dostafflist.php" target="_blank">
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
            	<option></option>
	    	</select>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="buton" id="buton" value="Staff List" /></td>
    </tr>
  </table>
  
</form>
</div>
</body>
</html>