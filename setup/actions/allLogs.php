<?php 
session_start();
	if(isset($_SESSION['uid']) && $_SESSION['ulev'] ==  0){
		$cid = $_SESSION['uid'];
	}
	else{	
			$act = "Forbidden - Not a Valid User";
			header("location:../login.php?a=".$act);
	}
	include('../../dbconn.php');
	include('../../utilities/logging.php');
	$act = "Viewed All Logs";
	logg($cid,$act)	;
	$s = "SELECT user_id FROM db_users WHERE staff_id = '$cid'";
	$r = mysql_query($s);
	$rs = mysql_fetch_array($r) or die(mysql_error());
	$log_id = $rs['user_id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: All Logs - RDB(<?php echo $log_id ?>)EBSU</title>
<style>
	.a{
		font-family:"Arial Rounded MT Bold", Arial;
		font-weight:bold;
	}
	.b{
		background:#ccc;
		font-family:"Arial Rounded MT Bold", Arial;
		font-size:12px;
	}
	.c{
		font-family:"Arial Rounded MT Bold", Arial;
		font-size:12px;
	}
	.d{
		font-family:"Arial Rounded MT Bold", Arial;
		font-size:14px; font-weight:bold;
	}
</style>
</head>

<body>
<table border="0" align="center" width="800" cellpadding="0" cellspacing="0">
<tr>
	<td class="a" width="50">S/N</td>
    <td class="a">User</td>
    <td class="a">Activity</td>
    <td class="a" width="100">Time</td>
</tr>
<?php
	$sn = 1; $h = true; $dats = "";
	$sql = "SELECT * FROM db_log ORDER BY log_log DESC";
	$result = mysql_query($sql) ;
	while ($row = mysql_fetch_array($result)){
		$uid = $row['log_user_id'];
		$act = strtoupper($row['log_activity']);
		$dat = $row['log_date'];
		$tym = $row['log_time'];
		$tyms = $row['log_log'];
		$name = getUser($uid);
		if ($dat != $dats){
			echo "<tr class = 'd'><td colspan = 4>$dat</td</tr>";
			$dats = $dat;
		}
		if ($h){
			echo "<tr>";
			echo "<td class = 'b'>" . $sn++ . "</td>";
			echo "<td class = 'b'>$name</td>";
			echo "<td class = 'b'>$act</td>";
			echo "<td class = 'b'>$tym</td>";
			echo "</tr>"; $h = false;
		}else{
			echo "<tr>";
			echo "<td class = 'c'>" . $sn++ . "</td>";
			echo "<td class = 'c'>$name</td>";
			echo "<td class = 'c'>$act</td>";
			echo "<td class = 'c'>$tym</td>";
			echo "</tr>"; $h = true;
		}
		
	}
	
	function getUser($id){
		$sql = "SELECT * FROM db_users WHERE staff_id = $id";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$fname = $row['user_firstname'];
		$mname = $row['user_middlename'];
		$lname = $row['user_lastname'];
		$name = strtoupper($fname . ", " . $mname . " ". $lname);
		return $name;
	}
?>
</table>
</body>
</html>