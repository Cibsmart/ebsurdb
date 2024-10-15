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
	$year = $_POST['year'];
	$month = strtoupper($_POST['month']);
	$dep = getdeptname($fac_id, $dep_id);
	$fac = getfacultyname($fac_id);

	$act = "Viewed Detailed Final Departmental Summary for $dep - $month - $year Batch";
	logg($cid,$act);
	$s = "SELECT user_id FROM db_users WHERE staff_id = '$cid'";
	$r = mysql_query($s);
	$rs = mysql_fetch_array($r);
	$log_id = $rs['user_id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>:: Detailed Final Departmental Summary - RDB (<?php echo $log_id ?>) EBSU ::</title>
<style>
	td{
		font-size:12px;
		font-family:arial;
	}
</style>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<?php 	
	$reglist = array();
	
	$sql_reg = "SELECT DISTINCT std_result_reg_no FROM std_results_final
				WHERE std_result_year = '$year' 
				AND std_result_month = '$month'
				AND std_result_dept = '$dep'
				ORDER BY std_result_reg_no";
	$result = mysql_query($sql_reg) or die(mysql_error());
	$num_of_reg = mysql_num_rows($result);
	for($z = 0; $z < $num_of_reg; $z++){
		$r_reg = mysql_fetch_array($result);
		$regg = trim($r_reg["std_result_reg_no"]);
		$reglist[$z] = $regg;
	}
	//var_dump($reglist);
	if (isset($reglist)){
		$std_all = count($reglist);
	}
	else{
		$std_all = 0;
	}
	//echo $std_all;
?>
<body>
<a href="#" onclick="javascript:window.print()"><font size="1">
PRINT</font></a>
<font size="1">
<a href="#" onclick="javascript:window.close()"><font color="#800000">CLOSE</font></a></font>
<br>
<span align="center">
    <table width = '520' border = '0' cellspacing = '0' align = 'center'>
    <td><img src="../images/ich logo.jpg" width = 80 height = 90/></td><td align="center">
         <span style="font-family:'Arial Black', Gadget, sans-serif; font:bolder; font-size:12px;">EBONYI STATE UNIVERSITY<br>
        <span style="font-family:'Arial Black', Gadget, sans-serif; font:bolder; font-size:12px; ">
         <?php echo "FACULTY OF " . $fac ?> <br /> </span>
        <span style="font-family:'Arial Black', Gadget, sans-serif; font:bolder; font-size:14px; ">         
		 <?php echo "DEPARTMENT OF " . $dep?> </span>
		<?php echo "<div style='text-align:center; font-size:12px; font-weight:bold; font-family:arial black'>". $month." ".  $year . " BATCH FINAL RESULT SUMMARY </div>"; ?>
    </td><td>
    </td>
    </table>
</span>

<table border="1" align="center" width="1300" cellspacing="0" cellpadding="2">
	<tr align="center" bgcolor="#999999">
		<td width="40"><b>SN</b></td>
		<td width="350"><b>NAMES OF STUDENT</b></td>
		<td  width="120"><b>REG. NO.</b></td>
		<td  width="40"><b>SEX</b></td> 
		<td  width="70"><b>MARITAL <br /> STATUS</b></td>
		<td  width="120"><b>STATE OF ORIGIN</b></td>
		<td  width="100"><b>DATE OF BIRTH</b></td>
		<td  width="50"><b>CGPA</b></td>
		<td  width="50"><b>CGPA</b></td>
		<td  width="50"><b>CGPA</b></td>
		<td  width="50"><b>CGPA</b></td>
       
		<td  width="50"><b>FCGPA</b></td>
        <td  width="90"><b>NO. OF SESSIONS</b></td>
        <td  width="90"><b>YEAR OF GRADUATION</b></td>
	</tr>
<?php
	$cnt2 = 0; $nFirstClass = 0; $nSecondClassU = 0; $nSecondClassL = 0; $nThirdClass = 0; $nPass = 0; $nFail = 0;
	for ($zz = 0; $zz < $std_all; $zz++){
		$cib = 0; $cnt = 0;
		$reg_no = $reglist[$zz]; $fcgpa = 0;
		$sql_name = "SELECT std_firstname, std_middlename, std_lastname 
					FROM std_info 
					WHERE std_reg_no = '$reg_no'";
		$act_name = mysql_query($sql_name);
		$num_name = mysql_num_rows($act_name);
		$r_name = mysql_fetch_array($act_name);
		
		$Namee = $r_name["std_firstname"] . " " .$r_name["std_middlename"] ." ".$r_name["std_lastname"];
		mysql_free_result($act_name);
		
		$sql_sess = "SELECT DISTINCT std_result_session 
					  FROM std_results_final 
					  WHERE std_result_reg_no = '$reg_no' 
					  ORDER BY std_result_session";
		$act_sess = mysql_query($sql_sess) or die(mysql_query());
		$num_sess = mysql_num_rows($act_sess);
		if ($num_sess != 0){
			$cnt_sess = 0; $cgps = 0;
			//$cal_gp = array(array());
			
			for ($cnt_sess; $cnt_sess < $num_sess; $cnt_sess++)
			{
				$row_sess = mysql_fetch_array($act_sess);
				$sess = trim($row_sess["std_result_session"]);
						summarizingfinaldepartmental($reg_no, $sess);
						$fcgpa = round($cgpa,3);
						$fcgps[$cnt++] = $fcgpa;
			}
			$fsum = array_sum($fcgps);
			$fcgps = range(0,0);
			
			$fcgpa = round($fsum / $num_sess, 3);
		}
		//echo $fcgpa;
		if ($cib != 0 ){
			$fcgpa = round($fcgpa , 2);
			$fgplist[$reg_no]= $fcgpa;
			
			if ($fcgpa >= 4.50) {$fcgpa1[$reg_no] = $fcgpa;}
			elseif ($fcgpa >= 3.50) {$fcgpa21[$reg_no] = $fcgpa;}
			elseif ($fcgpa >= 2.40) {$fcgpa22[$reg_no] = $fcgpa;}
			elseif ($fcgpa >= 1.50) {$fcgpa3[$reg_no] = $fcgpa;}
			elseif ($fcgpa >= 1.00) {$fcgpa4[$reg_no] = $fcgpa;}
			else {$fcgpa5[$reg_no] = $fcgpa;}
			
			$nlist[$reg_no] = $Namee;
			$num[$reg_no] = $cib;
			$nums[$reg_no] = $num_sess;
			$no = substr($reg_no,5,4);
			if($no >= 2011){
				if ($fcgpa >= 4.50 && $fcgpa <= 5.00){$nFirstClass++;}
				elseif ($fcgpa >= 3.50 && $fcgpa < 4.50){$nSecondClassU++;}
				elseif ($fcgpa >= 2.40 && $fcgpa < 3.50){$nSecondClassL++;}
				elseif ($fcgpa >= 1.50 && $fcgpa < 2.40){$nThirdClass++;}
				else {$nFail++;}
			}
			if($no < 2011){
				if ($fcgpa >= 4.50 && $fcgpa <= 5.00){$nFirstClass++;}
				elseif ($fcgpa >= 3.50 && $fcgpa < 4.50){$nSecondClassU++;}
				elseif ($fcgpa >= 2.40 && $fcgpa < 3.50){$nSecondClassL++;}
				elseif ($fcgpa >= 1.50 && $fcgpa < 2.40){$nThirdClass++;}
				elseif ($fcgpa >= 1.00 && $fcgpa < 1.50){$nPass++;}
				else {$nFail++;}
			}
		} 
	}
		
	
	if (isset($fgplist))
	{
			
			if(isset($fcgpa1)){
				arsort($fcgpa1);
			echo "<tr style='border:none'>
					<td style='border:none' colspan='5'>
						<span style='font-weight:bolder; font-size:14px'> FIRST CLASS HONOURS </span>
					</td>
					<td align = 'center' style='border:none'><span style='font-weight:bolder; font-size:14px'>$nFirstClass</style></td>
				</tr>"; $sn =1;
				foreach($fcgpa1 as $key => $val){
					$namee = $nlist[$key]; $no = $nums[$key];
					$yog = getyearofgraduation($key);
					echo "<tr><td align = 'center'>". $sn++ ."</td><td>". $namee . "</td><td align = 'center'>". $key ."</td><td align = 'center'>";
					printf("%.2f",$val);
					echo "</td><td align = 'center'>". $no ."</td><td align = 'center'>". $yog ."</td></tr>";
				}	
			}
			
			if(isset($fcgpa21)){
				arsort($fcgpa21);
			echo "<tr style='border:none'>
					<td style='border:none' colspan='5'>
						<span style='font-weight:bolder; font-size:14px'> SECOND CLASS HONOURS (UPPER DIVISION) </span>
					</td>
					<td align = 'center' style='border:none'><span style='font-weight:bolder; font-size:14px'>$nSecondClassU</style></td>
				</tr>"; $sn =1;
				foreach($fcgpa21 as $key => $val){
					$namee = $nlist[$key]; $no = $nums[$key];
					$yog = getyearofgraduation($key);
					echo "<tr><td align = 'center'>". $sn++ ."</td><td>". $namee . "</td><td align = 'center'>". $key ."</td><td align = 'center'>";
					printf("%.2f",$val);
					echo "</td><td align = 'center'>". $no ."</td><td align = 'center'>". $yog ."</td></tr>";
				}	
			}
			
			if(isset($fcgpa22)){
				arsort($fcgpa22);
			echo "<tr style='border:none'>
					<td style='border:none' colspan='5'>
						<span style='font-weight:bolder; font-size:14px'> SECOND CLASS HONOURS (LOWER DIVISION) </span>
					</td>
					<td align = 'center' style='border:none'><span style='font-weight:bolder; font-size:14px'>$nSecondClassL</style></td>
				</tr>"; $sn =1;
				foreach($fcgpa22 as $key => $val){
					$namee = $nlist[$key]; $no = $nums[$key];
					$yog = getyearofgraduation($key);
					echo "<tr><td align = 'center'>". $sn++ ."</td><td>". $namee . "</td><td align = 'center'>". $key ."</td><td align = 'center'>";
					printf("%.2f",$val);
					echo "</td><td align = 'center'>". $no ."</td><td align = 'center'>". $yog ."</td></tr>";
				}	
			}
			
			if(isset($fcgpa3)){
				arsort($fcgpa3);
			echo "<tr style='border:none'>
					<td style='border:none' colspan='5'>
						<span style='font-weight:bolder; font-size:14px'> THIRD CLASS HONOURS </span>
					</td>
					<td align = 'center' style='border:none'><span style='font-weight:bolder; font-size:14px'>$nThirdClass</style></td>
				</tr>"; $sn =1;
				foreach($fcgpa3 as $key => $val){
					$namee = $nlist[$key]; $no = $nums[$key];
					$yog = getyearofgraduation($key);
					echo "<tr><td align = 'center'>". $sn++ ."</td><td>". $namee . "</td><td align = 'center'>". $key ."</td><td align = 'center'>";
					printf("%.2f",$val);
					echo "</td><td align = 'center'>". $no ."</td><td align = 'center'>". $yog ."</td></tr>";
				}	
			}
			
			if(isset($fcgpa4)){
				arsort($fcgpa4);
			echo "<tr style='border:none'>
					<td style='border:none' colspan='5'>
						<span style='font-weight:bolder; font-size:14px'> PASS </span>
					</td>
					<td align = 'center' style='border:none'><span style='font-weight:bolder; font-size:14px'>$nPass</style></td>
				</tr>"; $sn =1;
				foreach($fcgpa4 as $key => $val){
					$namee = $nlist[$key]; $no = $nums[$key];
					$yog = getyearofgraduation($key);
					echo "<tr><td align = 'center'>". $sn++ ."</td><td>". $namee . "</td><td align = 'center'>". $key ."</td><td align = 'center'>";
					printf("%.2f",$val);
					echo "</td><td align = 'center'>". $no ."</td><td align = 'center'>". $yog ."</td></tr>";
				}	
			}
			
			if(isset($fcgpa5)){
				arsort($fcgpa5);
			echo "<tr style='border:none'>
					<td style='border:none' colspan='5'>
						<span style='font-weight:bolder; font-size:14px'> FAIL </span>
					</td>
					<td align = 'center' style='border:none'><span style='font-weight:bolder; font-size:14px'>$nFail</style></td>
				</tr>"; $sn =1;
				foreach($fcgpa5 as $key => $val){
					$namee = $nlist[$key]; $no = $nums[$key];
					$yog = getyearofgraduation($key);
					echo "<tr><td align = 'center'>". $sn++ ."</td><td>". $namee . "</td><td align = 'center'>". $key ."</td><td align = 'center'>";
					printf("%.2f",$val);
					echo "</td><td align = 'center'>". $no ."</td><td align = 'center'>". $yog ."</td></tr>";
				}	
			}
			
	}
	
	else{echo "<div style='font-size:20px; margin:10px; font-weight:bold; padding:6px; background:#FDE0CE; color:#FD5E5E; text-align:center;'>No Student Found!</div>";}
?>
</table>
<p>&nbsp;</p>
<table border = 0 align="center" width="350" cellpadding="0" cellspacing="50">
	<tr>
		<td width="140">_______________________</td>
		<td>_______________________</td>
		<td>_______________________</td>
	</tr>	
</table>
</body>
</html>