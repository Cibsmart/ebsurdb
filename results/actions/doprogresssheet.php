<?php 		session_start();

	if(isset($_SESSION['uid'])){
		$cid = $_SESSION['uid'];
		$rdb = true;
	}
	else{
		if(isset($_POST['z'])){$rdb = false;}
		else{
			$msg = "Forbidden - Not a Valid User";
			header("location:../../login.php?a=".$msg);
		}
	}
	include "f.php";
	include('../../utilities/logging.php');
	
		$reg_no = trim(strtoupper($_POST['reg_no']));
		if($rdb){
			$act = "Viewed $reg_no - Progress Sheet";
			logg($cid,$act);
			$s = "SELECT user_id FROM db_users WHERE staff_id = '$cid'";
			$r = mysql_query($s);
			$rs = mysql_fetch_array($r);
			$log_id = $rs['user_id'];
		}else{ $log_id = "?" ;}
			
		$pix_reg_no = "../../students/passports/" . str_replace("/", ".",$reg_no) . ".jpg";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../../css/cid.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: <?php if($log_id != "?"): ?> - RDB (<?php echo $log_id ?>) EBSU <?php endif; ?><?php echo $reg_no ?> - PROGRESS SHEET ::</title>
<style>
	.aa{
		font-weight:bold;
		text-align:right;
		font-size:13px;
		font-family:Arial, Gadget, sans-serif;
	}
	.ba{
		font-weight:bold;
		font-size:13px;
		font-family:Arial, Gadget, sans-serif;
	}
</style>
</head>
<body>
<span style=" font-family:'Courier New', Courier, monospace">
<a href="javascript:;" onClick="javascript:window.close()">Close</a>
<a href="javascript:;" onClick="javascript:window.print()">Print</a>
</span>

    <table width = "590" border = 0 cellspacing = 0 align = "center">
    <td><img src="../../images/ich logo.jpg" width = 100 height = 120/></td><td align="center">
        <span style="font-family:'Arial Black', Gadget, sans-serif; font-weight:bolder; font-size:16px;"> EBONYI STATE UNIVERSITY</span><br>
         <span style="font-family:'Arial Black', Gadget, sans-serif; font-weight:bold; font-size:14px;">P.M.B 053 ABAKALIKI EBONYI STATE<br>
		 RESULT DATABASE OFFICE<br>
        <u>STUDENTS' PROGRESS SHEET</u></span>
    </td>
    <td><img src="<?php echo $pix_reg_no ?>" width = 100 height = 120 alt="Passport" /></td>
    </table>

<div style="padding:10px">
<Table width="500" border="4" cellspacing="1" cellpadding="1" align="center">
<?php
$sees = correct_reg_no($reg_no);
if ($reg_no == "" || !$sees){
	echo "<p align = 'center' style='font-size:18px; font-weight:bolder; color:red'>Please Go Back and Enter Correct Registration Please</p>";
}
else{
	$query = "SELECT std_firstname, std_middlename, std_lastname, std_dept, std_entry_year FROM std_info WHERE std_reg_no = '$reg_no'" //SQL Statement to Generates std name
;	$result = mysql_query($query) // Execution of SQL Statement to Generates std name

;	$datas = mysql_fetch_array($result);  // Getting std name from querry
	
	$std_name =  stripslashes($datas['std_firstname']) . " " . stripslashes($datas['std_middlename']) . " " . stripslashes($datas['std_lastname']);
	

;	echo "<tr><td class='aa'> NAME: </td><td class='ba'>". $std_name. "</td>";	//Diplaying Student Information
	echo "<tr><td class='aa'> REGISTRATION NUMBER: </td><td class='ba'>". $reg_no . "</td>";
	echo "<tr><td class='aa'> DEPARTMENT: </td><td class='ba'>". $datas["std_dept"]. "</td></tr>";
	$sn = 1; $gpa = 0; $num_rows = 0; 
	$sql_sess = "SELECT DISTINCT std_result_session FROM std_results WHERE std_result_reg_no = '$reg_no' ORDER BY std_result_session";
	$result_sess = mysql_query($sql_sess) or die(mysql_error());
	$num_rows_sess = mysql_num_rows($result_sess);
?>
</table>
</div>

<table align="center" width="800" border="3" cellspacing="1" bordercolor="#333333" style="background:url(../../images/logo_faded.jpg); background-repeat:no-repeat; background-position:center; background-size:contain" >
    <tr bgcolor="#EEEEEE">
	<td>SN</td>
	<td>COURSE CODE</td>
	<td>COURSE TITLE</td>
	<td>LOAD</td>
	<td>TOTAL</td>
	<td>GRADE</td>
	<td>GP</td>
	<td>GPA & CGPA</td>
	</tr>
<?php
	$fcgpa = array(); $fcgpas = 0;
	if($num_rows_sess != 0){
		for ($i = 1; $i<=$num_rows_sess; $i++){
			$datas_sess = mysql_fetch_array($result_sess);$session_sum1 = 0; $session_sum2 = 0;
			
			$session = $datas_sess['std_result_session'];
			$sql_sem = "SELECT DISTINCT std_result_semester FROM std_results WHERE std_result_reg_no = '$reg_no' AND std_result_session = '$session' ORDER BY std_result_semester";
			$result_sem = mysql_query($sql_sem) or die(mysql_error());
			$num_rows_sem = mysql_num_rows($result_sem);
			if($num_rows_sem != 0){
				for ($j = 1; $j <= $num_rows_sem; $j++){
					$datas_sem = mysql_fetch_array($result_sem);
					$semester = $datas_sem['std_result_semester'];
					std_res($session, $semester, $reg_no, "sessional");
				}
				$cgpa = round(($session_sum2/$session_sum1),3);
				$fcgpa[] = $cgpa;
				$num_of_sessions = count($fcgpa);
				$sum_of_cgpa = array_sum($fcgpa);
				$fcgpas = round(($sum_of_cgpa/$num_of_sessions),2);
				//$class_of_degree = class_of_degree($fcgpas);
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
				echo "<td align = 'center'></td><td>&nbsp;</td>";
				echo "<td>&nbsp;</td><td align = 'center'>";
				echo "<td align = 'center' width='90' style='font-size:12px; font-weight:bolder'> CGPA = ". $cgpa ;
			}
		}
	}
	else{
				echo "<p align='center' style='font-size:20px; color:red; font-weight:bold'>No Result Entry Found</p>";
	}
	
?>
</Table>

<?php
	if($num_rows_sess != 0){
		echo "<p align='center' style='font-size:18px; font-weight:bolder'>Current Final CGPA Standing = $fcgpas - " . class_of_degree($fcgpas, $reg_no) . "</p>";
	}
}

?>

</body>
</html>
