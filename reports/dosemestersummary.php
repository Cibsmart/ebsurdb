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
	$sess = $_POST['session'];
	$sems = strtoupper($_POST['semester']);
	$level = $_POST['level'];
	$dep = getdeptname($fac_id, $dep_id);
	
	$act = "Viewed Semester Summary for $dep - $sess - $sems Semester - $level Level";
	logg($cid,$act);
	$s = "SELECT user_id FROM db_users WHERE staff_id = '$cid'";
	$r = mysql_query($s);
	$rs = mysql_fetch_array($r);
	$log_id = $rs['user_id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>::Departmental Semester Summary - RDB (<?php echo $log_id ?>) EBSU ::</title>
<style>
	td{
		font-size:12px;
		font-family:arial;
	}
</style>
<p align="left"><a href="#" onclick="javascript:window.print()"><font size="1">
PRINT</font></a>
<font size="1">
<a href="#" onclick="javascript:window.close()"><font color="#800000">CLOSE</font></a></font>
<br></p>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<?php 	
	$reglist = array();

	$sql_reg = "SELECT status_regno 
				FROM std_status 
				WHERE status_session  = '$sess' 
				AND status_dept = '$dep_id' 
				AND status_level = '$level' 
				ORDER BY status_regno";
	$result = mysql_query($sql_reg) or die(mysql_error());
	$num_of_reg = mysql_num_rows($result);

	for($z = 0; $z < $num_of_reg; $z++){
		$r_reg = mysql_fetch_array($result);
		$regg = trim($r_reg["status_regno"]);
		$reglist[$z] = $regg;
	}
	
	if (isset($reglist)){
		$std_all = count($reglist);
	}
	else{
		$std_all = 0;
	}
?>
<body>
<p align="center">
    <table width = '520' border = '0' cellspacing = '0' align = 'center'>
    <td><img src="../images/ich logo.jpg" width = 100 height = 110/></td><td align="center">
        <span style="font-family:'Arial Black', Gadget, sans-serif; font:bolder; font-size:15px; ">
         <?php echo "DEPARTMENT OF " . $dep?>
         </span><br>
         <span style="font-family:'Arial Black', Gadget, sans-serif; font:bold; font-size:14px;">EBONYI STATE UNIVERSITY<br>
        P.M.B 053 ABAKALIKI EBONYI STATE</span>
		<?php echo "<div style='text-align:center; font-size:12px; font-weight:bold; font-family:arial black'>". $level . " LEVEL ". $sems ." SEMESTER ". $sess. " RESULT SUMMARY </div>"; ?>
    </td><td>
    </td>
    </table>
</p>

<table border="1" align="center" width="650" cellspacing="0" cellpadding="2">
	<tr align="center" bgcolor="#999999">
		<td width="40"><b>SN</b></td>
		<td width="350"><b>NAMES OF STUDENT</b></td>
		<td  width="120"><b>REG. NO.</b></td>
		<td  width="50"><b>CGPA</b></td>
        <td  width="90"><b>No. of Results</b></td>
	</tr>
<?php
	$cnt2 = 0; $nFirstClass = 0; $nSecondClassU = 0; $nSecondClassL = 0; $nThirdClass = 0; $nPass = 0; $nFail = 0;
	for ($zz = 0; $zz < $std_all; $zz++){
		$cib = 0;
		$reg_no = $reglist[$zz]; $fcgpa = 0;
		$sql_name = "SELECT std_firstname, std_middlename, std_lastname 
					FROM std_info 
					WHERE std_reg_no = '$reg_no'";
		$act_name = mysql_query($sql_name);
		$num_name = mysql_num_rows($act_name);
		$r_name = mysql_fetch_array($act_name);
		$Namee = $r_name["std_firstname"] . " " .$r_name["std_middlename"] ." ".$r_name["std_lastname"];

					summarizingsemester($reg_no, $sess, $sems);
					$fcgpa = round($cgpa,3);
		if ($cib != 0 ){
			$fcgpa = round($fcgpa , 3);
			$fgplist[$reg_no]= $fcgpa;
			$nlist[$reg_no] = $Namee;
			$num[$reg_no] = $cib;
			$no = substr($reg_no,5,4);
			if($no >= 2011){
				if ($fcgpa >= 4.50 && $fcgpa <= 5.00){$nFirstClass++;}
				elseif ($fcgpa >= 3.50 && $fcgpa < 4.50){$nSecondClassU++;}
				elseif ($fcgpa >= 2.50 && $fcgpa < 3.50){$nSecondClassL++;}
				elseif ($fcgpa >= 1.50 && $fcgpa < 2.50){$nThirdClass++;}
				else {$nFail++;}
			}
			if($no < 2011){
				if ($fcgpa >= 4.50 && $fcgpa <= 5.00){$nFirstClass++;}
				elseif ($fcgpa >= 3.50 && $fcgpa < 4.50){$nSecondClassU++;}
				elseif ($fcgpa >= 2.50 && $fcgpa < 3.50){$nSecondClassL++;}
				elseif ($fcgpa >= 1.50 && $fcgpa < 2.50){$nThirdClass++;}
				elseif ($fcgpa >= 1.00 && $fcgpa < 1.50){$nPass++;}
				else {$nFail++;}
			}
		} 
	}
		
	
	$sn = 1;
	if (isset($fgplist))
	{
		arsort($fgplist);
		foreach ($fgplist as $key => $val)
		{	
			$namee = $nlist[$key]; $no = $num[$key];
			echo "<tr><td align = 'center'>". $sn++ ."</td><td>". $namee . "</td><td align = 'center'>". $key ."</a></td><td align = 'center'>". $val ."</td><td align = 'center'>". $no ."</td></tr>";
		}
	}
	else
	{
		echo "<div style='font-size:20px; margin:10px; font-weight:bold; padding:6px; background:#FDE0CE; color:#FD5E5E; text-align:center;'>No Student Found!</div>";
	}
?>
</table>
<p></p>
<div style="font-size:20px; font-weight:bold;" align="center">Summary</div>
<table border = 1 align="center" width="250" cellpadding="0" cellspacing="0">
	<tr>
		<td width="140">First Class:</td>
		<td align="center" width="80"> 4.50 - 5.00</td>
		<td align="center" width="50"><?php echo $nFirstClass ?></td>
	</tr>
	<tr>
		<td>Second Class Upper:</td>
        <td align="center"> 3.50 - 4.49	</td>
		<td align="center">	<?php echo $nSecondClassU ?></td>
	</tr>
	<tr>
		<td>Second Class Lower:	</td>
		<td align="center"> 2.50 - 3.49</td>
		<td align="center">	<?php echo $nSecondClassL ?></td>
	</tr>	
	<tr>
		<td>Third Class:</td>
		<td align="center"> 1.50 - 2.49	</td>
		<td align="center">	<?php echo $nThirdClass ?>	</td>
	</tr>
	<tr>
		<td>Pass:</td>
		<td align="center"> 1.00 - 1.49	</td>
		<td align="center">	<?php echo $nPass ?></td>
	</tr>
	<tr>
		<td>Fail:</td>
		<td align="center"> 0.00 - 0.99</td>
		<td align="center">	<?php echo $nFail ?></td>
	</tr>
	<tr>
		<td colspan="2">Total:</td>
		<td align="center">	<?php if (isset($fgplist)) {echo count($fgplist);}	?></td>
	</tr>

</table>
</body>
</html>