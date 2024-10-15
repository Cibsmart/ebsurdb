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
		$act = "Viewed $reg_no - Official Transcript";
		logg($cid,$act);
		$s = "SELECT user_id FROM db_user WHERE staff_id = '$cid'";
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
<title>:: RDB (<?php echo $log_id ?>) EBSU - <?php echo $reg_no ?> - TRANSCRIPT OF ACADEMIC RECORDS ::</title>
<style>
	.aa{
		text-align:right;
		font-size:11px;
		font-family:Arial, Gadget, sans-serif;
	}
	
	.cont{
		font-weight:bolder;
		font-size:13px;
		font-family:Arial, Gadget, sans-serif;
	}
	
	td {
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#000000;
	}
</style>
</head>
<body>
<span style=" font-family:'Courier New', Courier, monospace">
<a href="javascript:;" onClick="javascript:window.close()">Close</a>
<a href="javascript:;" onClick="javascript:window.print()">Print</a>
</span>

    <table width = "900" border = 0 cellspacing = 0 align = "center">
    <td width="100"><img src="../../images/ich logo.jpg" width = 100 height = 120/></td>
    <td align="center" width="700">
        <p><span style="font-family:'Arial Black', Gadget, sans-serif; font-weight:bolder; font-size:16px;"> EBONYI STATE UNIVERSITY, ABAKALIKI</span><br>
          <span style="font-family:'Arial Black', Gadget, sans-serif; font-weight:bold; font-size:14px;">OFFICE OF THE REGISTRAR<br>
          RESULT DATABASE OFFICE</span><span style="font-family:'Arial Black', Gadget, sans-serif; font-weight:bold; font-size:14px;"><br /><br  />
          <u>TRANSCRIPT OF ACADEMIC RECORDS</u></span></p>
    </td>
    <td width="100"><img src="<?php echo $pix_reg_no ?>" width = 100 height = 120 alt="Passport" /></td>
</table>
<?php
$sees = correct_reg_no($reg_no);$no = substr($reg_no,5,4);
if ($reg_no == "" || !$sees){
	echo "<p align = 'center' style='font-size:18px; font-weight:bolder; color:red'>Please Go Back and Enter Correct Registration Please</p>";
}
else{
	$query = "SELECT std_firstname, std_middlename, std_lastname, std_dept, std_entry_year, std_faculty, std_birth_date, std_sex, std_nationality FROM std_info WHERE std_reg_no = '$reg_no'" //SQL Statement to Generates std name
;	$result = mysql_query($query) // Execution of SQL Statement to Generates std name

;	$datas = mysql_fetch_array($result);  // Getting std name from querry
	
	$std_name =  stripslashes($datas['std_firstname']) . " " . stripslashes($datas['std_middlename']) . " " . stripslashes($datas['std_lastname']);
	$faculty = stripslashes($datas['std_faculty']);
	$dept = stripslashes($datas['std_dept']);
	$fname = stripslashes($datas['std_firstname']);
	$mname = stripslashes($datas['std_middlename']);
	$lname = stripslashes($datas['std_lastname']);
	$dob = stripslashes($datas['std_birth_date']);
	$sex = stripslashes($datas['std_sex']);
	$nationality = stripslashes($datas['std_nationality']);
	$onames = $mname . " " . $lname;
	$admyear = substr($datas["std_entry_year"],0,4);
	$sql_fac = "SELECT faculty_abbr FROM faculty_list WHERE faculty_name = '$faculty'";
	$res_fac = mysql_query($sql_fac);
	$data_fac = mysql_fetch_array($res_fac);
	$faculty_abbr = $data_fac['faculty_abbr'];
?>
<table border="1" width="900" align="center">
	<tr>
      <td><span class="aa">SURNAME: </span><span class="cont"><?php echo $fname ?><br  /><br  /></span><span class="aa">OTHER NAMES: </span><span class="cont"><?php echo $onames ?></span></td>
      <td align="center"  width="180"><span class="aa">REGISTRATION NO: <br  /><br  /></span><span class="cont"><?php echo $reg_no ?></span></td>
      <td align="center"  width="100"><span class="aa">SEX: <br  /><br  /> </span><span class="cont"><?php echo $sex ?></span></td>
      <td align="center" width="150"><span class="aa">DATE OF BIRTH: <br  /><br  /></span><span class="cont"><?php echo $dob ?></span></td>
      <td align="center"  width="150"><span class="aa">DATE OF ADMISSION: <br  /><br  /></span><span class="cont"><?php echo $admyear ?></span></td>
    </tr>
    <tr>
      <td><span class="aa">NATIONALITY: </span><span class="cont"><?php echo $nationality ?><br  />&nbsp;</span></td>
      <td  align="center"><span class="aa">FACULTY: </span><span class="cont"><?php echo $faculty_abbr ?><br  />&nbsp;</span></td>
      <td colspan="3"  align="center"><span class="aa">DEPARTMENT: </span><span class="cont"><?php echo $dept ?></span></td>
    
    </tr>
</table>

<div style="padding:10px">
<table width="500" border="4" cellspacing="1" cellpadding="1" align="center">
<?php

	$gpa = 0; $num_rows = 0; $year = 1;
	//$sql_sess = "SELECT DISTINCT std_result_session FROM std_results_final WHERE std_result_reg_no = '$reg_no' ORDER BY std_result_session";
	$sql_sess = "SELECT DISTINCT std_result_session FROM std_results WHERE std_result_reg_no = '$reg_no' ORDER BY std_result_session";
	$result_sess = mysql_query($sql_sess) or die(mysql_error());
	$num_rows_sess = mysql_num_rows($result_sess);
?>
</table>
</div>


<?php
	$fcgpa = array(); $fcgpas = 0; $me = false;
	if($num_rows_sess != 0){
		for ($i = 1; $i<=$num_rows_sess; $i++){
			$datas_sess = mysql_fetch_array($result_sess);$session_sum1 = 0; $session_sum2 = 0;
			$session = $datas_sess['std_result_session'];
			//$sql_sem = "SELECT DISTINCT std_result_semester FROM std_results_final WHERE std_result_reg_no = '$reg_no' AND std_result_session = '$session' ORDER BY std_result_semester";
			$sql_sem = "SELECT DISTINCT std_result_semester FROM std_results WHERE std_result_reg_no = '$reg_no' AND std_result_session = '$session' ORDER BY std_result_semester";
			$result_sem = mysql_query($sql_sem) or die(mysql_error());
			$num_rows_sem = mysql_num_rows($result_sem);
			if($num_rows_sem != 0){
				for ($j = 1; $j <= $num_rows_sem; $j++){
?>
<table align="center" width="900" border="3" cellspacing="1" bordercolor="#333333" style="background:url(../../images/logo_faded.jpg); background-repeat:no-repeat; background-position:center; background-size:contain" >
    <tr bgcolor="#EEEEEE">
	<td width="40">YEAR</td>
    <td width="70">SEMESTER</td>
	<td width="100">COURSE CODE</td>
	<td>COURSE TITLE</td>
	<td width="50" align="center">CREDIT HOUR</td>
	<td width="50" align="center">TOTAL SCORE</td>
	<td width="50" align="center">LETTER GRADE</td>
	<td width="50" align="center">GRADE POINT</td>
	<td width="40" align="center">GPA</td>
    <td width="40" align="center">CGPA</td>
    <td width="40" align="center">FCGPA</td>
	</tr>
<?php
					$datas_sem = mysql_fetch_array($result_sem);
					$semester = $datas_sem['std_result_semester'];
					//std_res_final($session, $semester, $reg_no, "sessional");
					std_res_official($session, $semester, $reg_no, "sessional");
?>
</table><br  />
<?php
				}
				$year++ ;
				//$class_of_degree = class_of_degree($fcgpas);
				/*echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
				echo "<td align = 'center'></td><td>&nbsp;</td>";
				echo "<td>&nbsp;</td><td align = 'center'>";
				echo "<td align = 'center' width='90' style='font-size:12px; font-weight:bolder'> CGPA = ". $cgpa ;*/
			}
?>

<table border="0" width="900" align="center">
	<tr>
    <td>
<?php if ($no >= 2011):?>
    	<table align="center" border="1" >
          <tr>
              <td align="center" width="70"><span class="bb" style="font-weight:bold">Score (%)</span></td>
              <td align="center" width="70"><span class="bb" style="font-weight:bold">Interpretation</span></td>
              <td align="center" width="70"><span class="bb" style="font-weight:bold">Letter Grade</span></td>
              <td align="center" width="70"><span class="bb" style="font-weight:bold">Grade Point</span></td>
          </tr>
          <tr>
              <td align="center"><span class="bb">70 - 100</span></td>
              <td><span class="bb">Excellent</span></td>
              <td align="center"><span class="bb">A</span></td>
              <td align="center"><span class="bb">5</span></td>
          </tr>
          <tr>
              <td align="center"><span class="bb">60 - 69</span></td>
              <td><span class="bb">Very Good</span></td>
              <td align="center"><span class="bb">B</span></td>
              <td align="center"><span class="bb">4</span></td>
          </tr>
           <tr>
              <td align="center"><span class="bb">50 - 59</span></td>
              <td><span class="bb">Good</span></td>
              <td align="center"><span class="bb">C</span></td>
              <td align="center"><span class="bb">3</span></td>
          </tr>
          <tr>
              <td align="center"><span class="bb">45 - 49</span></td>
              <td><span class="bb">Fair</span></td>
              <td align="center"><span class="bb">D</span></td>
              <td align="center"><span class="bb">2</span></td>
          </tr>
          <tr>
              <td align="center"><span class="bb">00 - 44</span></td>
              <td><span class="bb">Fail</span></td>
              <td align="center"><span class="bb">F</span></td>
              <td align="center"><span class="bb">0</span></td>
          </tr>
        </table>
<?php else: ?>
		<table align="center" border="1" >
          <tr>
              <td align="center" width="70"><span class="bb" style="font-weight:bold">Score (%)</span></td>
              <td align="center" width="70"><span class="bb" style="font-weight:bold">Interpretation</span></td>
              <td align="center" width="70"><span class="bb" style="font-weight:bold">Letter Grade</span></td>
              <td align="center" width="70"><span class="bb" style="font-weight:bold">Grade Point</span></td>
          </tr>
          <tr>
              <td align="center"><span class="bb">70 - 100</span></td>
              <td><span class="bb">Excellent</span></td>
              <td align="center"><span class="bb">A</span></td>
              <td align="center"><span class="bb">5</span></td>
          </tr>
          <tr>
              <td align="center"><span class="bb">60 - 69</span></td>
               <td><span class="bb">Very Good</span></td>
              <td align="center"><span class="bb">B</span></td>
              <td align="center"><span class="bb">4</span></td>
          </tr>
           <tr>
              <td align="center"><span class="bb">50 - 59</span></td>
              <td><span class="bb">Good</span></td>
              <td align="center"><span class="bb">C</span></td>
              <td align="center"><span class="bb">3</span></td>
          </tr>
          <tr>
              <td align="center"><span class="bb">45 - 49</span></td>
              <td><span class="bb">Fair</span></td>
              <td align="center"><span class="bb">D</span></td>
              <td align="center"><span class="bb">2</span></td>
          </tr>
          <tr>
              <td align="center"><span class="bb">40 - 44</span></td>
              <td><span class="bb">Pass</span></td>
              <td align="center"><span class="bb">E</span></td>
              <td align="center"><span class="bb">1</span></td>
          </tr>
          <tr>
              <td align="center"><span class="bb">00 - 44</span></td>
              <td><span class="bb">Fail</span></td>
              <td align="center"><span class="bb">F</span></td>
              <td align="center"><span class="bb">0</span></td>
          </tr>
        </table>
<?php endif; ?>
    </td>
    
    <td width="200" >
    	<table border="1" height="100%" width="100%">
        	<tr><td style="font-size:14px; font-weight:bolder"><?php 
			echo $me;
						if(!$me){ echo "&nbsp;<br /><br />";}
						else {echo "FCGPA = $fcgpas";} ?></td></tr>
            <tr><td><br /><br /><br /><br /><br /><br /><br /><br /></td></tr>
        </table>
    </td>
    
    <td>
    	<table border="1" width="400">
        	<tr>
            	<td>
                	<b>DEGREE AWARDED</b>: 
					<?php 
						if(!$me){echo "xxxxxxxxxxxxxxxxxxx";}
						else{
						  
						}
					?>
                </td>
            </tr>
            <tr>
            	<td>
                	<b>CLASS</b>: xxxxxxxxxxxxxxxxxxxxxxxxxxxx
                </td>
            </tr>
            <tr>
            	<td>
                <b>DATE OF GRADUATION</b>: xxxxxxxxxxxxxxxxxxx
             	</td>
            </tr>
            <tr>
            	<td><b>CERTIFIED BY</b>:
            	<br  /><br  /><br  /><br />
                <div align="center"><b> A.I. EGBELEGU </b>
                	<br />FOR: REGISTRAR
                </div>
            </td></tr>
        </table>
    </td>
    </tr>
</table>

<br  />
<?php
		}
	}
	else{
				echo "<p align='center' style='font-size:20px; color:red; font-weight:bold'>No Result Entry Found</p>";
	}
}
?>
</body>
</html>
