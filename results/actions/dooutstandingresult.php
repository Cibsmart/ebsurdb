<?php 		session_start();

	if(isset($_SESSION['uid'])){
		$cid = $_SESSION['uid'];
	}
	else{
		$msg = "Forbidden - Not a Valid User";
		header("location:../../login.php?a=".$msg);
	}
	include "f.php";
	include('../../utilities/logging.php');
	
		$reg_no = trim(strtoupper($_POST['reg_no']));
		$act = "Viewed $reg_no - Outstanding Results/Courses";
		logg($cid,$act);
		$s = "SELECT user_id FROM db_users WHERE staff_id = '$cid'";
		$r = mysql_query($s);
		$rs = mysql_fetch_array($r) or die(mysql_error());
		$log_id = $rs['user_id'];
		
		$pix_reg_no = "../../students/passports/" . str_replace("/", ".",$reg_no) . ".jpg";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../../css/cid.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>::  RDB (<?php echo $log_id ?>) EBSU - <?php echo $reg_no ?> - LIST OF OUTSTANDING COURSES ::</title>

</head>
<body>
<span style=" font-family:'Courier New', Courier, monospace">
<a href="javascript:;" onClick="javascript:window.close()">Close</a>
<a href="javascript:;" onClick="javascript:window.print()">Print</a>
</span>

    <table width = "590" border = 0 cellspacing = 0 align = "center">
    <td><img src="../../images/ich logo.jpg" width = 100 height = 120/></td><td align="center">
        <span style="font-family:'Arial Rounded MT Bold', 'Arial Black'; font-weight:bolder; font-size:16px;">EBONYI STATE UNIVERSITY</span><br>
         <span style="font-family:'Arial Rounded MT Bold', 'Arial Black'; font-weight:bold; font-size:14px;">P.M.B 053 ABAKALIKI EBONYI STATE<br>
        RESULT DATABASE OFFICE<br>
        <u>STUDENTS' OUTSTANDING COURSES</u></span>
    </td>
    <td><img src="<?php echo $pix_reg_no ?>" width = 100 height = 120 alt="Passport" /></td>
    </table>

<Table width="400" border="4" cellspacing="1" cellpadding="1" align="center">
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
	

;	echo "<tr><td> NAME: </td><td>". $std_name. "</b></td>";	//Diplaying Student Information
	echo "<tr><td> REGISTRATION NUMBER: </td><td>". $reg_no . "</b></td>";
	echo "<tr><td> DEPARTMENT: </td><td>". $datas["std_dept"]. "</b></td></tr>";
	$sn = 1; $num_rows = 0; $fail_code = array();  $fail_sess = array(); $pass_code = array();  $code_list = array(); $sums = false; $cid = false;
	echo $fail_code . '-' . $fail_sess. '-' . $pass_code . '-' . $code_list . '-' . $sums . '-' . $cid
?>
</table>

<?php
	
	$sql_sess = "SELECT DISTINCT std_result_session FROM std_results WHERE std_result_reg_no = '$reg_no' ORDER BY std_result_session";
	$result_sess = mysql_query($sql_sess) or die(mysql_error());
	$num_rows_sess = mysql_num_rows($result_sess);

	if($num_rows_sess != 0){
		for ($i = 1; $i<=$num_rows_sess; $i++){
			$datas_sess = mysql_fetch_array($result_sess);
			
			$session = $datas_sess['std_result_session'];
			$sql_sem = "SELECT DISTINCT std_result_semester FROM std_results WHERE std_result_reg_no = '$reg_no' AND std_result_session = '$session' ORDER BY std_result_semester";
			$result_sem = mysql_query($sql_sem) or die(mysql_error());
			$num_rows_sem = mysql_num_rows($result_sem);
			if($num_rows_sem != 0){
				for ($j = 1; $j <= $num_rows_sem; $j++){
					$datas_sem = mysql_fetch_array($result_sem);
					$semester = $datas_sem['std_result_semester'];
					outstanding_res($session, $semester, $reg_no);
				}
				
			}
		}
	}
	else{
				echo "<p align='center' style='font-size:20px; color:red; font-weight:bold'>No Result Entry Found</p>";
	}
}
asort($fail_code);asort($pass_code);

$cibsmart = array_diff_key($fail_code, $pass_code);
if(count($cibsmart) != 0){
	$sums = true;
}
		

?>
<?php if($sums): ?>
<table align='center' width='700' border='3' cellspacing='1' bordercolor='#333333' style='background:url(../../images/logo_faded.jpg); background-repeat:no-repeat; background-position:center; background-size:contain' >
<?php endif ?>
<?php	$sn2=1;  ?>
<?php if($sums):?>
        <div align='center' style="font-family:'Arial Rounded MT Bold', Arial; font-size:18px; font-weight:bolder; padding:10px">Failed Courses</div>
		
			<tr bgcolor='#EEEEEE'>
			<td width='30' align='center'>SN</td>
			<td width='100'>COURSE CODE</td>
			<td>COURSE TITLE</td>
			<td width='50'>LOAD</td>
			<td width='50'>TOTAL</td>
			<td width='50'>GRADE</td>
			</tr>
            
        <?php endif; $sums = false; ?>
<?php
		$don = ""; $cib = "";
		asort($cibsmart);
		foreach($cibsmart as $ifeanyi => $happiness){
		$fail_sess = substr($happiness,0,9);
		$fail_sem =  substr($happiness,9);
		
		if ($don != $fail_sess || $cib != $fail_sem){
			$don = $fail_sess;
			$cib = $fail_sem;
			echo "<tr><td colspan = 6><span style='font-size:14px; font-weight:bolder;'>".ucfirst(strtolower($fail_sess)). " " .ucfirst(strtolower($fail_sem)). " ". "Semester" ."</span></td></tr>";
		}
		print_outstanding($reg_no,$fail_sess, $fail_sem, $ifeanyi);
		
	}
	
	$cib = unattempted_course($reg_no);
	$ccc = count($cib);
	//var_dump($cib);
?>
</table>

<?php
	
?>
<?php if($ccc != 0):?>
<div align="center" style="font-family:'Arial Rounded MT Bold', Arial; font-size:18px; font-weight:bolder; padding:10px">Unattempted Courses</div>
<table align="center" width="600" border="3" cellspacing="1" bordercolor="#333333" style="background:url(../../images/logo_faded.jpg); background-repeat:no-repeat; background-position:center; background-size:contain" >
    <tr bgcolor="#EEEEEE">
	<td width="30">SN</td>
	<td width="100">COURSE CODE</td>
	<td>COURSE TITLE</td>
	<td width="50" align="center">LOAD</td>
    <td>SPECIFICATION</td>
	</tr>
<?php
	$sn3=1; $levs = ""; $sems = "";
	foreach($cib as $id){
		$sql_cos = "SELECT * FROM sess_course_list WHERE sess_list_id = '$id'";
		$res_cos = mysql_query($sql_cos);
		$data = mysql_fetch_array($res_cos);
		$cod = $data['sess_list_code'];
		$tit = $data['sess_list_title'];
		$lod = $data['sess_list_c_unit'];
		$lev = $data['sess_list_level'];
		$sem = $data['sess_list_semester'];
		$spec = $data['sess_list_specification'];
		
		
		if(($sem != $sems) || ($lev != $levs)){
			$sems = $sem; $levs = $lev;
		  echo "<tr>
			  <td colspan=5><span style='font-size:14px; font-weight:bolder'>$lev Level " . ucfirst(strtolower($sem)) . " Semester</span></td>
			  </tr>";
		}
		echo "<tr>
				<td align='center'>" . $sn3++ . "</td>
				<td>$cod</td>
				<td>$tit</td>
				<td align='center'>$lod</td>
				<td>$spec</td>
				</tr>";
	}
?>
   </table>
<?php endif; ?>

<?php 	if(($ccc == 0) && !($cid)): ?>
<div align="center" style="font-family:'Arial Rounded MT Bold', Arial; font-size:24px; font-weight:bolder; padding:10px; color:green">No Outstanding Courses</div>
<?php endif; ?>
</body>
</html>
