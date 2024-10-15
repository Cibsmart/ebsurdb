<?php
	session_start();
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
		$session = $_POST['session'];
		if($rdb){
			$act = "Viewed $reg_no - $session Sessional Results";
			logg($cid,$act);
			$s = "SELECT user_id FROM db_users WHERE staff_id = '$cid'";
			$r = mysql_query($s);
			$rs = mysql_fetch_array($r) or die(mysql_error());
			$log_id = $rs['user_id'];
		}else{ $log_id = "?" ;}

		$pix_reg_no = "../../students/passports/" . str_replace("/", ".",$reg_no) . ".jpg";
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../../css/cid.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: <?php if($log_id != "?"): ?> - RDB (<?php echo $log_id ?>) EBSU <?php endif; ?> - <?php echo $reg_no . " - " . $session ?> SESSIONAL RESULT ::</title>
<style>
	.aa{
		font-weight:bold;
		text-align:right;
		font-size:12px;
		font-family:Arial, Gadget, sans-serif;
		text-align:right;
	}

	.ba{
		font-weight:bold;
		font-size:13px;
		font-family:Arial, Gadget, sans-serif;
	}
	.bb{
		font-weight:bold;
		font-size:10px;
	}
	.bbc{
		font-weight:bolder;
		font-size:12px;
	}
	.bad{
		font-weight:bold;
		font-size:15px;
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
         <span style="font-family:'Arial Black', Gadget, sans-serif; font-weight:bold; font-size:14px;">P.M.B 053 ABAKALIKI EBONYI STATE<br>
        RESULT DATABASE OFFICE<br>
        <u>STUDENTS' SESSIONAL RESULT</u></span>
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
	$query = "SELECT std_firstname, std_middlename, std_lastname, std_dept, std_entry_year, std_faculty FROM std_info WHERE std_reg_no = '$reg_no'" //SQL Statement to Generates std name
;	$result = mysql_query($query) // Execution of SQL Statement to Generates std name

;	$datas = mysql_fetch_array($result);  // Getting std name from querry
	
	$std_name =  stripslashes($datas['std_firstname']) . " " . stripslashes($datas['std_middlename']) . " " . stripslashes($datas['std_lastname']);
	

;	echo "<tr><td class='ba' align='right' > NAME: </td><td class='bad'>". $std_name. "</b></td>";	//Diplaying Student Information
	echo "<tr><td class='ba' align='right'> REGISTRATION NUMBER: </td><td class='bad'>". $reg_no . "</b></td>";
	echo "<tr><td class='ba' align='right'> FACULTY: </td><td class='ba'>". $datas["std_faculty"]. "</b></td>";
	echo "<tr><td class='ba' align='right'> DEPARTMENT: </td><td class='ba'>". $datas["std_dept"]. "</b></td>";
	echo "</tr>";
	$sn = 1; $gpa = 0; $num_rows = 0; $session_sum1 = 0; $session_sum2 = 0; 
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
	$sql2 = "SELECT DISTINCT std_result_semester FROM std_results WHERE std_result_reg_no = '$reg_no' AND std_result_session = '$session' ORDER BY std_result_semester";
	$result2 = mysql_query($sql2) or die(mysql_error());
	$num_rows = mysql_num_rows($result2);
	
		
		if($num_rows >= 1){
			for ($i = 1; $i <= $num_rows; $i++){
				$datas = mysql_fetch_array($result2);
				$semester = $datas['std_result_semester'];
				std_res($session, $semester, $reg_no, "sessional");
			}
			$cgpa = round(($session_sum2/$session_sum1),3);
		}
		else{
			echo "<p align='center' style='font-size:20px; color:red; font-weight:bold'>No Result Entry Found</p>";
		}
?>
</Table>

<?php
  if(isset($cgpa)){
	  echo "<p align='center' style='font-size:18px; font-weight:bolder'>Sessional CGPA = $cgpa</p>";
  }
}
 $no = substr($reg_no,5,4)
?>
<?php if($no < 2011):?>
<div>&nbsp;</div>
<table  align="center" border="0" width="500">
<tr>
<td>
<table align="center" border="1" >
	<tr>
    	<td align="center" colspan="3"><span class="bbc">Grade Key</span></td>
    </tr>
    <tr>
    	<td align="center" width="70"><span class="bb">Score (%)</span></td>
        <td align="center" width="70"><span class="bb">Grade</span></td>
        <td align="center" width="70"><span class="bb">Grade Point</span></td>
    </tr>
    <tr>
    	<td align="center"><span class="bb">70 - 100</span></td>
        <td align="center"><span class="bb">A</span></td>
        <td align="center"><span class="bb">5</span></td>
    </tr>
    <tr>
    	<td align="center"><span class="bb">60 - 69</span></td>
        <td align="center"><span class="bb">B</span></td>
        <td align="center"><span class="bb">4</span></td>
    </tr>
     <tr>
    	<td align="center"><span class="bb">50 - 59</span></td>
        <td align="center"><span class="bb">C</span></td>
        <td align="center"><span class="bb">3</span></td>
    </tr>
    <tr>
    	<td align="center"><span class="bb">45 - 49</span></td>
        <td align="center"><span class="bb">D</span></td>
        <td align="center"><span class="bb">2</span></td>
    </tr>
    <tr>
    	<td align="center"><span class="bb">40 - 44</span></td>
        <td align="center"><span class="bb">E</span></td>
        <td align="center"><span class="bb">1</span></td>
    </tr>
    <tr>
    	<td align="center"><span class="bb">00 - 39</span></td>
        <td align="center"><span class="bb">F</span></td>
        <td align="center"><span class="bb">0</span></td>
    </tr>
</table>
</td>
<td  width="50">
</td>
<td>
<table align="center" border="1">
	<tr>
    	<td align="center" colspan="2"><span class="bbc">Class Key</span></td>
    </tr>
    <tr>
    	<td align="center" width="70"><span class="bb">CGPA</span></td>
        <td align="left" width="120"><span class="bb">Class</span></td>
    </tr>
    <tr>
    	<td align="center"><span class="bb">4.50 - 5.00</span></td>
        <td align="left"><span class="bb">First Class</span></td>
    </tr>
    <tr>
    	<td align="center"><span class="bb">3.50 - 4.49</span></td>
        <td align="left"><span class="bb">Second Class Upper</span></td>
    </tr>
    <tr>
    	<td align="center"><span class="bb">2.50 - 3.49</span></td>
        <td align="left"><span class="bb">Second Class Lower</span></td>
    </tr>
    <tr>
    	<td align="center"><span class="bb">1.50 - 2.49</span></td>
        <td align="left"><span class="bb">Third Class</span></td>
    </tr>
    <tr>
    	<td align="center"><span class="bb">1.00 - 1.49</span></td>
        <td align="left"><span class="bb">Pass</span></td>
    </tr>
    <tr>
    	<td align="center"><span class="bb">Below 1.00</span></td>
        <td align="left"><span class="bb">Fail</span></td>
    </tr>
    
</table>
</td>
</tr>
</table>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div style="font-size:20px; font-weight:bold" align="center">
      Certified by:
    </div>
<div>&nbsp;</div>
<?php endif ?>

<?php if($no >= 2011):?>
<div>&nbsp;</div>
<table  align="center" border="0" width="500">
<tr>
<td>
<table align="center" border="1" >
	<tr>
    	<td align="center" colspan="3"><span class="bbc">Grade Key</span></td>
    </tr>
    <tr>
    	<td align="center" width="70"><span class="bb">Score (%)</span></td>
        <td align="center" width="70"><span class="bb">Grade</span></td>
        <td align="center" width="70"><span class="bb">Grade Point</span></td>
    </tr>
    <tr>
    	<td align="center"><span class="bb">70 - 100</span></td>
        <td align="center"><span class="bb">A</span></td>
        <td align="center"><span class="bb">5</span></td>
    </tr>
    <tr>
    	<td align="center"><span class="bb">60 - 69</span></td>
        <td align="center"><span class="bb">B</span></td>
        <td align="center"><span class="bb">4</span></td>
    </tr>
     <tr>
    	<td align="center"><span class="bb">50 - 59</span></td>
        <td align="center"><span class="bb">C</span></td>
        <td align="center"><span class="bb">3</span></td>
    </tr>
    <tr>
    	<td align="center"><span class="bb">45 - 49</span></td>
        <td align="center"><span class="bb">D</span></td>
        <td align="center"><span class="bb">2</span></td>
    </tr>
    <tr>
    	<td align="center"><span class="bb">00 - 44</span></td>
        <td align="center"><span class="bb">F</span></td>
        <td align="center"><span class="bb">0</span></td>
    </tr>
</table>
</td>
<td  width="50">
</td>
<td>
<table align="center" border="1">
	<tr>
    	<td align="center" colspan="2"><span class="bbc">Class Key</span></td>
    </tr>
    <tr>
    	<td align="center" width="70"><span class="bb">CGPA</span></td>
        <td align="left" width="120"><span class="bb">Class</span></td>
    </tr>
    <tr>
    	<td align="center"><span class="bb">4.50 - 5.00</span></td>
        <td align="left"><span class="bb">First Class</span></td>
    </tr>
    <tr>
    	<td align="center"><span class="bb">3.50 - 4.49</span></td>
        <td align="left"><span class="bb">Second Class Upper</span></td>
    </tr>
    <tr>
    	<td align="center"><span class="bb">2.50 - 3.49</span></td>
        <td align="left"><span class="bb">Second Class Lower</span></td>
    </tr>
    <tr>
    	<td align="center"><span class="bb">1.50 - 2.49</span></td>
        <td align="left"><span class="bb">Third Class</span></td>
    </tr>
    <tr>
    	<td align="center"><span class="bb">Below 1.50</span></td>
        <td align="left"><span class="bb">Fail</span></td>
    </tr>
    
</table>
</td>
</tr>
</table>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div>&nbsp;</div>
<div style="font-size:20px; font-weight:bold" align="center">
      Certified by:
    </div>
<div>&nbsp;</div>
<?php endif ?>

</body>
</html>
