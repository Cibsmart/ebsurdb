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

	$fac_id = $_POST['faculty'];
	$dep_id = $_POST['dept'];
	$session = $_POST['year'];
	
	$faculty = getfacultyname($fac_id);
	$dept = getdeptname($fac_id, $dep_id);
	$no = substr($session,0,4);
	$sq = "SELECT DISTINCT sess_list_level FROM sess_course_list WHERE sess_list_dept = '$dep_id' AND sess_list_session = '$session'";
	$re = mysql_query($sq) or die(mysql_error());
	$num_re = mysql_num_rows($re);
	$seme[] = "FIRST";
	$seme[] = "SECOND";
	
	$act = "Viewed Course List for $dept $session";
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
<title>:: List of Courses - RDB (<?php echo $log_id ?>) EBSU ::</title>
</head>


<body>
<p align="left"><a href="#" onclick="javascript:window.print()"><font size="1">
PRINT</font></a>
<font size="1">
<a href="#" onclick="javascript:window.close()"><font color="#800000">CLOSE</font></a></font>
<br></p>
<p align="center">
    <table width = '520' border = '0' cellspacing = '0' align = 'center'>
    <td><img src="../images/ich logo.jpg" width = 100 height = 110/></td><td align="center">
        <span style="font-family:'Arial Black', Gadget, sans-serif; font:bold; font-size:15px;">EBONYI STATE UNIVERSITY, ABAKALIKI<br /></span>
        <span style="font-family:'Arial Black', Gadget, sans-serif; font:bolder; font-size:14px; ">
         	<?php echo "FACULTY OF " . $faculty?>
        </span><br />
        <span style="font-family:'Arial Black', Gadget, sans-serif; font:bolder; font-size:14px; ">
         	<?php echo "DEPARTMENT OF " . $dept?>
        </span><br />
         
		<?php echo "<div style='text-align:center; font-size:12px; font-weight:bold; font-family:arial black'> LIST OF COURSES FOR ". $session." SESSION </div>"; ?>
    </td><td>
    </td>
    </table>
</p>

<?php
if($num_re != 0){
for($j=0; $j < $num_re; $j++){
	$datas = mysql_fetch_array($re);
	$level = $datas['sess_list_level'];
	for($k=0; $k < 2; $k++){
		$semester = $seme[$k];
		$year = getyear($level);
	$sql = "SELECT * FROM sess_course_list WHERE sess_list_dept = '$dep_id' AND sess_list_session = '$session' AND sess_list_level = '$level' AND sess_list_semester = '$semester' ORDER BY sess_list_specification, sess_list_code";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	echo "<div align='center' style='font-weight:bold;padding-top:10px;font-size:18px'>$level LEVEL ($year) $semester SEMESTER</div>";
	if($num != 0): ?>
    <table border="1" align="center" width="750" style="font-size:13px;font-family:'Arial Rounded MT Bold', Arial">
    	<tr style="font-weight:bolder">
        	<td align="center" width="40">SN</td>
            <td width="100">CODE</td>
            <td>COURSE TITLE</td>
            <td width="60" align='center'>UNITS</td>
            <td width="140">SPECIFICATION</td>
        </tr>
<?php
		$sn = 1; $tot_cl = 0;
		for($i=0;$i < $num; $i++){
			
			$data = mysql_fetch_array($result);
			$code = $data['sess_list_code'];
			$title = $data['sess_list_title'];
			$cunit = $data['sess_list_c_unit'];
			$spec = $data['sess_list_specification'];
			$tot_cl += $cunit;
			echo "<tr style='font-size:12px'>
				 	<td align='center'>". $sn++ ."</td>
					<td>$code</td>
					<td>$title</td>
					<td align='center'>$cunit</td>
					<td>$spec COURSE</td>
				 </tr>";
		}
		echo "<tr style='font-size:12px'>
				 	<td align='center'></td>
					<td></td>
					<td>TOTAL</td>
					<td align='center'>$tot_cl</td>
					<td></td>
				 </tr>";
?>
	</table>
<?php else:?>
	 	<div align="center" style="font-size:24px;font-weight:bolder;font-family:'Arial Rounded MT Bold', Arial; background:#F99; color:#FFF">No COURSE LIST FOUND FOR <?php echo $semester ."SEMESTER ". $session?> SESSION</div>
<?php endif; 
	}
	
}
} ?>
<?php if($num_re == 0):?>
<div align="center" style="font-size:24px;font-weight:bolder;font-family:'Arial Rounded MT Bold', Arial; background:#F99; color:#FFF">NO COURSE LIST FOUND FOR <?php echo $session ?></div>	
<?php endif;
?>
</body>
</html>
<?php
	function getyear($level){
		switch($level){
			case 100:	
				$anyi = "ONE";
				break;
			case 200:	
				$anyi = "TWO";
				break;
			case 300:	
				$anyi = "THREE";
				break;
			case 400:	
				$anyi = "FOUR";
				break;
			case 500:	
				$anyi = "FIVE";
				break;
			case 600:	
				$anyi = "SIX";
				break;
		}
		return "YEAR ".$anyi;
	}
?>