<?php 
	$id = $_SESSION['uid'];
	$lev = $_SESSION['ulev'];
	$sql = "SELECT * FROM db_users WHERE staff_id = '$id'";
	$res = mysql_query($sql);
	$r = mysql_fetch_array($res);
	$fn = $r['user_firstname'];
	$mn = $r['user_middlename'];
	$ln = $r['user_lastname'];
	$name =  $fn . ", " . $mn . " " . $ln;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>::EBSU - Student Info Manager Sys::</title>
<link rel="stylesheet" href="./css/cib.css" type="text/css" />
<script language="JavaScript" type="text/javascript">
//--------------- LOCALIZEABLE GLOBALS ---------------
var cid=new Date();
var monthname=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
var TODAY = monthname[cid.getMonth()] + " " + cid.getDate() + ", " + cid.getFullYear();
//---------------   END LOCALIZEABLE   ---------------
</script>
<style type="text/css">
<!-- 
.style1 {color: #336600}
-->
</style>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" id= "Heads">
  <tr>&nbsp;</tr>
  <tr bgcolor="#99CC66">
  	<td colspan="7" id="dateformat" height="20" bgcolor="#330066">&nbsp;&nbsp;<script language="JavaScript" type="text/javascript">
      document.write(TODAY);	</script>	</td>
  </tr>

<div class="top_banner">
<div class="top_logo"><img src="images/ich logo.jpg" width="80" height="100"/><img src="images/logo.jpg" width="550" height="100" /></div>
</div>
<div><img src="images/top_nav_bg2.jpg" width="100%" height="8" /></div>
</table>
		<div id="nav">
        	<div style="font-size:20px; font-family:'Arial Rounded MT Bold', Arial; font-weight:bolder; color:#006" >
				<?php echo "Welcome " . $name; ?>
                <span style="font-size:14px"><a href="login.php?b">LOGOUT</a></span>
            </div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%" id="navigation" >
				<tr>
					<td width="150"><span><font size = 4px><b>Main Menu</b></font></span></td>
				<td rowspan = 12 >
					<iframe width="100%" scrolling="auto" name="dispframe" frameborder="0" src="home.html" style="background:url(../images/logo_back.jpg) no-repeat; overflow:auto; word-wrap:break-word; vertical-align:top; height:500px" seamless="seamless">
					</iframe>
				</td>
				</tr>
				<tr>
					<td ><a href="home.html" class="navText" target="dispframe">Home</a></td>
				</tr>
				<tr>
					<td ><a href="students/students.html" class="navText" target="dispframe">Student</a></td>
				</tr>
				<tr>
					<td ><a href="courses/courses.html" class="navText" target="dispframe">Courses</a></td>
				</tr>
				<tr>
					<td ><a href="results/results.html" class="navText" target="dispframe">Results</a></td>
				</tr>
				<!-- <tr>
					<td ><a href="staff/staff.html" class="navText" target="dispframe">Staff</a></td>
				</tr> -->
				<tr>
					<td ><a href="reports/reports.html" class="navText" target="dispframe">Reports</a></td>
				</tr>
                <?php if($lev == 0): ?>
				<tr>
					<td ><a href="setup/setup.html" class="navText" target="dispframe">Setup</a></td>
				</tr>
                <?php endif; ?>
                
				<tr>
					<td ><a href="manage/manage.html.php" class="navText" target="dispframe">Results Manager</a></td>
				</tr>
                
				<tr>
					<td ><a href="examsmanager/manage.html.php" class="navText" target="dispframe">Exams Manager</a></td>
				</tr>
				<tr>
					<td ><a href="bulkreconcile/outstandingresult.php" class="navText" target="dispframe">Bulk Reconciliation</a></td>
				</tr>
			</table>
</div>
