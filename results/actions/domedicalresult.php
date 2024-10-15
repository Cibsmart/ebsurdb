<?php 		session_start();

	if(isset($_SESSION['uid'])){
		$cid = $_SESSION['uid'];
	}
	else{
		if(isset($_GET['z'])){}
		else{
			$msg = "Forbidden - Not a Valid User";
			header("location:../../login.php?a=".$msg);
		}
	}
	include "f.php";
	include('../../utilities/logging.php');
	
	
		$reg_no = trim(strtoupper($_POST['reg_no']));
		$act = "Viewed $reg_no - Medical Transcript";
		logg($cid,$act);
		$s = "SELECT user_id FROM db_users WHERE staff_id = '$cid'";
		$r = mysql_query($s);
		$rs = mysql_fetch_array($r);
		$log_id = $rs['user_id'];
		$pix_reg_no = "../../students/passports/" . str_replace("/", ".",$reg_no) . ".jpg";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../../css/cid.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: RDB (<?php echo $log_id ?>) EBSU - <?php echo $reg_no ?> - MBBS Results  ::</title>
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
	.ng{
		font-weight:bolder;
		text-align:left;
		font-size:11px;
		font-family:"Arial Rounded MT Bold", Arial;	
	}
	.comfort{
		text-align:left;
		font-size:12px;
		font-family:"Arial Rounded MT Bold", Arial;	
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
        <u>MEDICAL STUDENTS' RESULT</u></span>
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
	$query = "SELECT std_firstname, std_middlename, std_lastname, std_dept, std_entry_year, std_faculty FROM std_info WHERE std_reg_no = '$reg_no'" //SQL Statement to Generates std name
;	$result = mysql_query($query) // Execution of SQL Statement to Generates std name

;	$datas = mysql_fetch_array($result);  // Getting std name from querry
	
	$std_name =  stripslashes($datas['std_firstname']) . " " . stripslashes($datas['std_middlename']) . " " . stripslashes($datas['std_lastname']);
	

;	echo "<tr><td class='aa'> NAME: </td><td class='ba'>". $std_name. "</td>";	//Diplaying Student Information
	echo "<tr><td class='aa'> REGISTRATION NUMBER: </td><td class='ba'>". $reg_no . "</td>";
	echo "<tr><td class='aa'> FACULTY: </td><td class='ba'>"//. $datas["std_faculty"]. 
			."BASIC MEDICAL SCIENCES</td></tr>";
	echo "<tr><td class='aa'> DEPARTMENT: </td><td class='ba'>"//. $datas["std_dept"]. 
			."MEDICINE AND SURGERY</td></tr>";
	$sn = 1; $gpa = 0; $num_rows = 0; 
	$sql_l = "SELECT DISTINCT std_result_level FROM std_results_medical WHERE std_result_reg_no = '$reg_no'";
	$result_l = mysql_query($sql_l) or die(mysql_error());
	$num_rows_l = mysql_num_rows($result_l);
?>
</table>
</div>

<table align="center" width="550" border="3" cellspacing="1" bordercolor="#333333" style="background:url(../../images/logo_faded.jpg); background-repeat:no-repeat; background-position:center; background-size:contain" >
    <tr bgcolor="#EEEEEE">
	<td class="ng">SN</td>
	<td class="ng">SUBJECT/COURSE</td>
	<td class="ng">SCORE</td>
	<td class="ng">REMARK</td>
	</tr>
<?php
	if($num_rows_l != 0){
		//for ($i = 1; $i<=$num_rows_sess; $i++){
			//$datas_sess = mysql_fetch_array($result_sess);
			//$session = $datas_sess['std_result_session'];
			std_res_medical($reg_no);
		//}
	}
	else{
				echo "<p align='center' style='font-size:20px; color:red; font-weight:bold'>No Result Entry Found</p>";
	}
	
?>
</Table>

<?php
}
?>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div style="font-size:20px; font-weight:bold" align="center">
      Certified by:
    </div>
<div>&nbsp;</div>
</body>
</html>
