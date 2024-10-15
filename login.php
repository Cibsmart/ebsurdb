<?php session_start();
include ('functions.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>::EBSU - Student Info Manager Sys::</title>
<link href="css/cib.css" rel="stylesheet" type="text/css" />
</head>

<body><div class="top_banner">
<div class="top_logo"><img src="images/ich logo.jpg" width="80" height="100"/><img src="images/logo.jpg" width="550" height="100" /></div>
</div>
<div><img src="images/top_nav_bg2.jpg" width="100%" height="8" /></div>
<?php
if(isset($_GET['b'])): ?>
<?php $cid = user_logout(); if ($cid): ?>
<div style='padding:6px; background:#DCFDC8; color:#030; font-weight:bolder; border:solid 1px #A0EB70; text-align:center; font-size:16px;' id='div2' name='div2'>Logged Out Successfully</div>
<?php endif; endif ?>
<div class="login_section">

<div   class="login_box">
  <form id="form1" name="form1" method="post" action="index.php" >
    <table width="95%" border="0" align="center" cellpadding="3" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Username:</td>
        <td><input name="username" type="text" id="username" size="30" autocomplete="on" autofocus="autofocus" /></td>
      </tr>
      <tr><td>&nbsp;</td></tr>
      <tr>
        <td>Password:</td>
        <td><input name="password" type="password" id="password" size="30" autocomplete="on"/></td>
      </tr>
      <tr><td>&nbsp;</td></tr>
      <tr>
      	<td>&nbsp;</td>
        <td><input name="button1" type="submit" value="Log-In"/></td>
      </tr>
      <tr>
        <td colspan="2"><?php

if(isset($_GET['a'])): ?>

<div style='padding:6px; background:#FDE0CE; color:#FD5E5E; font-weight:bolder; border:solid 1px #FE9592; text-align:center; font-size:12px;' id='div2' name='div2'><?php echo $_GET['a'] ?></div>
<?php endif ?>
</td>
      </tr>
    </table>
  </form>
</div>
</div>
<div><img src="images/top_nav_bg2.jpg" width="100%" height="8" /></div><div style="margin:10px;">
<img src="images/cka_logo.jpg" width="200" height="40" alt="Creative Kingdom" /> </div></body>
</html>
