<?php 
session_start();
if(isset($_SESSION['uid']) && $_SESSION['ulev'] == 0){
		$cid = $_SESSION['uid'];
	}
	else{
		$msg = "Forbidden - Not a Valid User";
		header("location:login.php?a=".$msg);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nominal Roll Upload...</title>
<script type="text/javascript" src="jscript/jquery.js"></script>
<script type="text/javascript" src="jscript/uploadjs.js"></script>
<style type="text/css">
<!--
body,td,th {
	font-family: Georgia,"Times New Roman",Times,serif;;
	font-size: 12px;
	color: #333;
}
body {
	margin-left: 0px;
	margin-top: 30px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.maindiv{ width:640px; margin:0 auto; padding:20px; background:#0fd;}
.innerbg{ padding:6px; background:#FFF;}
.result{ border:solid 1px #CCC; margin:10px 2px; padding:4px 2px;}
-->
</style>
</head>

<body>


<div style="text-align:center;">
<div style="display:none;"><img src="ajax-loader.gif"  /></div>
  <h1 style="color:#000;">EBSU Result Database</a></h1>
  <h2 style="color:#000;">Nominal Roll Upload</h2>
</div>
<div class="maindiv">
<div class="innerbg">
<table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td colspan="4" align="left" valign="middle" bgcolor="#000080"><div style="margin:0px 10px; font-weight:bold; color:#FFF; font-size:13px;" align="center">Copy and Paste Nominal Roll to be Uploaded into New Nominal.csv on your desktop</div></td>
    </tr>
  <tr>
  	
    <td colspan=4 align="center" valign="middle">
    <div style="margin:20px">
    <form>
	<input type="button" value="Click to Start Uploading Nominal Roll" onclick="uploadnominal()" />
    </form>
  	</div>
    </td>
  </tr>
  <tr>
    <td width="10%" align="left" valign="middle"></td>
    <td width="2%" align="left" valign="middle"></td>
    <td colspan="2" align="left" valign="middle"></td>
  </tr>
  <tr>
    <td colspan="4" align="left" valign="middle">
    <div id="flash" align="center"></div>
    <div id="ajaxresult" align="center" style="font-weight:bolder; font-size:20px;color:green; font-family:'Arial Rounded MT Bold', Arial"></div>
    </td>
    </tr>
</table>
</div>
</div>

</body>
</html>