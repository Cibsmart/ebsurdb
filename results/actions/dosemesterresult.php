<?php 	session_start();
	
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
		$session = $_POST['session'];
		$semester = strtoupper($_POST['semester']);
		
		$act = "Viewed $reg_no - $session - $semester Semester Results";
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
<title>:: RDB (<?php echo $log_id ?>) EBSU - <?php echo $reg_no . " - " . $session. " ". $semester ?> SEMESTER  ::</title>
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
<p align="center">
    <table width = "590" border = 0 cellspacing = 0 align = "center">
    <td><img src="../../images/ich logo.jpg" width = 100 height = 120/></td><td align="center">
        <span style="font-family:'Arial Rounded MT Bold', 'Arial Black'; font-weight:bolder; font-size:16px; "> EBONYI STATE UNIVERSITY</span><br>
         <span style="font-family:'Arial Rounded MT Bold', 'Arial Black'; font-weight:bold; font-size:14px;">P.M.B 053 ABAKALIKI EBONYI STATE<br>
        RESULT DATABASE OFFICE<br>
        <u>STUDENTS' SEMESTER RESULT</u></span>
    </td>
    <td><img src="<?php echo $pix_reg_no ?>" width = 100 height = 120 alt="Passport" /></td>
    </table>
</p>

<div style="padding:10px">
<Table width="500" border="4" cellspacing="1" cellpadding="1" align="center">
<?php
	$sees = correct_reg_no($reg_no);
if ($reg_no == "" || !$sees){
	echo "<p align = 'center'>Please Go Back and Enter Registration Please</p>";
}

else{
	$ebsu =	substr($reg_no,0,4); $slash1 = substr($reg_no, 4,1); $slash2 = substr($reg_no, 9,1); $year = substr($reg_no, 5,4); $no = substr($reg_no, 10,5);
	$ebsu = strtoupper($ebsu);
	if (($ebsu == "EBSU") && ($slash1 == "/") && ($slash2 == "/") ){
	$reg_no = strtoupper(trim($reg_no));
	$query = "SELECT std_firstname, std_middlename, std_lastname, std_dept, std_entry_year FROM std_info WHERE std_reg_no = '$reg_no'" //SQL Statement to Generates std name
;	$result = mysql_query($query) // Execution of SQL Statement to Generates std name

;	$datas = mysql_fetch_array($result);  // Getting std name from querry
	
	$std_name =  stripslashes($datas['std_firstname']) . " " . stripslashes($datas['std_middlename']) . " " . stripslashes($datas['std_lastname']);
	

;	echo "<tr><td> NAME: </td><td>". $std_name. "</b></td>";	//Diplaying Student Information
	echo "<tr><td> REGISTRATION NUMBER: </td><td>". $reg_no . "</b></td>";
	echo "<tr><td> DEPARTMENT: </td><td>". $datas["std_dept"]. "</b></td></tr>";
	$sn = 1; $gpa = 0; $sum1 = 0; $sum2 = 0;
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
	<td>GPA</td>
	</tr>
<?php
		
				std_res($session, $semester, $reg_no, "semester");
		


		
?>
</Table>
<?php

}
}
?>
</body>
</html>
