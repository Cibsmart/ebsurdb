<?php 
session_start();
	if(isset($_SESSION['uid']) && $_SESSION['ulev'] == 0){
		$cid = $_SESSION['uid'];
	}
	else{
		$msg = "Forbidden - Not a Valid User";
		header("location:../login.php?a=".$msg);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Staff Record</title>
<script type="text/javascript" src="../jscript/jquery.js"></script>
<script type="text/javascript" src="UtilitiesJS.js"></script>
<style>
	.aaa{
		text-align:right;
		font-size:14px;
		font-family:Arial, Helvetica, sans-serif;
		font-weight:bold;
	}
	.bbb{
		
	}
</style>
</head>

<body>
<div style="padding:6px; font-weight:bolder; text-align:center; font-size:24px">USERS</div>
<?php

if(isset($_GET['msg'])){
	if ($_GET['msg'] == 'success'): ?>
		<div style='background:#DCFDC8; border:solid 1px #A0EB70; color:#030; text-align:center; font-weight:bold; padding:4px;' id='div1' name='div1'>User Registered Successfully	</div>;
        
	<?php else: ?>
<div style='padding:6px; background:#FDE0CE; color:#FD5E5E; font-weight:bold; border:solid 1px #FE9592; text-align:center;' id='div2' name='div2'>Error Registering User</div>;
	<?php endif ?>
<script> showing(); </script>
<?php }
?>
<div align="center" style="width:600px; border:solid 1px;  margin:auto">
<form action="doNewUser.php" method="post" id="form1" name="form1">
  <table width="600" border="0" cellpadding="2" cellspacing="5" align="center" >
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">Staff ID:</td>
      <td class="bbb"><input type="text" name="staff_id" id="staff_id" size="20" maxlength="4"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">First Name:</td>
      <td class="bbb"><input type="text" name="first_name" id="first_name" size="40" maxlength="20"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">Middle Name:</td>
      <td class="bbb"><input type="text" name="middle_name" id="middle_name" size="40" maxlength="20"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">Last Name:</td>
      <td class="bbb"><input type="text" name="last_name" id="last_name"size="40" maxlength="20"/></td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">Username:</td>
      <td class="bbb"><input type="text" name="username" id="username" size="40" maxlength="20"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">Password:</td>
      <td class="bbb"><input type="password" name="password1" id="password1" size="40" maxlength="20"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">Re-Type Password:</td>
      <td class="bbb"><input type="password" name="password2" id="password2" size="40" maxlength="20"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">User Level:</td>
      <td class="bbb">
      <select name="user_level" id="user_level">
      	<option value=""></option>
      	<option value="0">Admin</option>
        <option value="1">User Level 1</option>
        <option value="2">User Level 2</option>
		<option value="4">Exams Unit</option>
      </select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="center">
      <input type="button" name="buton" id="buton" value="Register" onclick="process()"/>
      </td>
    </tr>
  </table>
</form>
</div>
</body>
</html>