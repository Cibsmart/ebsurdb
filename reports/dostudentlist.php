<?php 
session_start();
	
	if(isset($_SESSION['uid'])){
		$cid = $_SESSION['uid'];
	}
	else{
			$msg = "Forbidden - Not a Valid User";
			header("location:../../login.php?a=".$msg);
	}
	
include("func.php"); 
include('../utilities/logging.php');
	$dept_id = $_POST['dept'];
	$session = $_POST['year'];
	$fac_id = $_POST['faculty'];

	$faculty = getfacultyname($fac_id);
	$dept = getdeptname($fac_id, $dept_id);
	$act = "Viewed Student List for $dept";
	logg($cid,$act);
	$s = "SELECT user_id FROM db_users WHERE staff_id = '$cid'";
	$r = mysql_query($s);
	$rs = mysql_fetch_array($r);
	$log_id = $rs['user_id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: List of Students - RDB (<?php echo $log_id ?>) EBSU ::</title>
</head>
<?php
	$no = substr($session,0,4);
	$sql = "SELECT * FROM std_info WHERE std_dept = '$dept' AND std_reg_no LIKE '%/$no/%' ORDER BY std_reg_no";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	
?>
<body>
<p align="left"><a href="#" onclick="javascript:window.print()"><font size="1">
PRINT</font></a>
<font size="1">
<a href="#" onclick="javascript:window.close()"><font color="#800000">CLOSE</font></a></font>
<br></p>
<p align="center">
    <table width = '520' border = '0' cellspacing = '0' align = 'center'>
    <td><img src="../images/ich logo.jpg" width = 100 height = 110/></td><td align="center">
        <span style="font-family:'Arial Black', Gadget, sans-serif; font:bolder; font-size:15px; ">
         <?php echo "DEPARTMENT OF " . $dept?>
         </span><br>
         <span style="font-family:'Arial Black', Gadget, sans-serif; font:bold; font-size:14px;">EBONYI STATE UNIVERSITY<br>
        P.M.B 053 ABAKALIKI EBONYI STATE</span>
		<?php echo "<div style='text-align:center; font-size:12px; font-weight:bold; font-family:arial black'> LIST OF STUDENT ADMITTED IN ". $session." SESSION </div>"; ?>
    </td><td>
    </td>
    </table>
</p>

<?php
	if($num != 0): ?>
    <table border="1" align="center" width="500" style="font-size:13px;font-family:'Arial Rounded MT Bold', Arial">
    	<tr style="font-weight:bolder">
        	<td align="center" width="50">SN</td>
            <td>NAME OF STUDENTS</td>
            <td align='center' width="150">REG. NUMBER</td>
        </tr>
<?php
	$sn = 1;
		for($i=0;$i < $num; $i++){
			$data = mysql_fetch_array($result);
			$fname = $data['std_firstname'];
			$mname = $data['std_middlename'];
			$lname = $data['std_lastname'];
			$reg_no = $data['std_reg_no'];
			$name = $fname . " " . $mname . " " . $lname;
			echo "<tr style='font-size:12px'>
				 	<td align='center'>". $sn++ ."</td>
					<td> $name</td>
					<td align='center'>$reg_no</td>
				 </tr>";
		}
?>
	</table>
<?php else:?>
	 	<div align="center" style="font-size:24px;font-weight:bolder;font-family:'Arial Rounded MT Bold', Arial; background:#F99; color:#FFF">No Student Found</div>
<?php endif; ?>
</body>
</html>