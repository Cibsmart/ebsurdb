<?php $Regee = $_POST['Regee']?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../../cid.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title> <?php echo $Regee ?> </title>

<p align="center">
<table width = "490" border = 0 cellspacing = 0 align = "center">
<td><img src = ../../images/logo.jpg width = 100 height = 120/></td><td><CENTER><font size="5"><b>EBONYI STATE UNIVERSITY<br>

</font>
<font size="3">P.M.B 053 ABAKALIKI EBONYI STATE<br>
<U><font size="3">STUDENTS' SEMESTER RESULT</FONT></U>
</td>
</table>
</p>


<?php 	include "c.php";// Includes the file that connects to the DB 
	include "f.php"?>
<Table width="400" border="2" cellspacing="1" align="center">
<?php

if ($Regee == ""){
	echo "<p align = 'center'><font face='Arial, Helvetica, sans-serif' size='+1' color='#FF0000'><b>Please Go Back and Enter Registration Please<b></font></p>";
}
else{
	$ebsu =	substr($Regee,0,4); $slash1 = substr($Regee, 4,1); $slash2 = substr($Regee, 9,1); $year = substr($Regee, 5,4); $no = substr($Regee, 10,5);
	$ebsu = strtoupper($ebsu);
	if (($ebsu == "EBSU") && ($slash1 == "/") && ($slash2 == "/") ){
	$Regee = strtoupper(trim($Regee));
	$query = "Select Namee from biodata where Reg = '$Regee'" //SQL Statement to Generates std name
;	$query2 = "Select Reg from biodata where Reg = '$Regee'" //SQL Statement to Generates std Reg No
;	$query3 = "Select Dept from biodata where Reg = '$Regee'" //SQL Statement to General std Department

;	$act = mysql_query($query) // Execution of SQL Statement to Generates std name
;	$act2 = mysql_query($query2) // Execution of SQL Statement to Generates std Reg No
;	$act3 = mysql_query($query3) // Execution of SQL Statement to General std Department

;	$rw = mysql_fetch_array($act)  // Getting std name from querry
;	$rw2 = mysql_fetch_array($act2) // Getting std Reg No from querry
;	$rw3 = mysql_fetch_array($act3) // Getting std Dept from querry

;	echo "<tr><td><b> Name: </td><td>". $rw["Namee"]. "</b></td>";	//Diplaying Student Information
	echo "<tr><td><b> Reg No: </td><td>". $Regee . "</b></td>";
	echo "<tr><td><b> Dept: </td><td>". $rw3["Dept"]. "</b></td></tr>";
	$sn = 1; $cgpa = 0; $fcgpa = 0; $cgpas = 0;
?>
</Table>
<br>
</head>
<body>

<Table align="center" width="900" border="2" cellspacing="1" bordercolor="#333333" >
	<tr bgcolor="#EEEEEE">
	<td><b>SN</td>
	<td><b>Course Code</td>
	<td><b>Course Title</td>
	<td><b>Cr L</td>
	<td><b>Total</td>
	<td><b>Grade</td>
	<td><b>GP</td>
	<td><b>GPA</td>
	</tr>
<?php
	$sql_sess = "Select distinct Session from dd2 where Reg = '$Regee' order by Session";
	$act_sess = mysql_query($sql_sess);
	$num_sess = mysql_num_rows($act_sess);
	$cnt_sess = 0; $cgps = 0; $cnt2 = 0; 
	$cal_gp = array(array());
	for ($cnt_sess; $cnt_sess < $num_sess; $cnt_sess++)
	{
		$sumgp = 0; $sumcrl = 0;
		$row_sess = mysql_fetch_array($act_sess);
		$sess = trim($row_sess["Session"]);
		$sql_sem = "Select distinct Semester from dd2 where Session = '$sess' and Reg = '$Regee' order by Semester";
		$act_sem = mysql_query($sql_sem);
		$num_sem = mysql_num_rows($act_sem);
		$real_num_sem = $num_sem % 2;
		if ($real_num_sem > 0)
		{$num_sem += 1;}
		$cnt_sem = 0; $cnt = 0; 
		for ($cnt_sem; $cnt_sem < $num_sem; $cnt_sem++)
		{
			$st = 0; $nd = 0;
			$row_sem = mysql_fetch_array($act_sem);
			$sem = trim($row_sem["Semester"]);
			if ($sem == "")
			{
				$cal_gp[$sess][$cnt] = 0;
				$cnt++;
			}
			else
			{
				std_res($sess, $sem, $Regee);
				$cal_gp[$sess][$cnt] = $cgpa;
				if ($sem == "FIRST"){$st = 1;}
				if ($sem == "SECOND"){$nd = 1;}
				$cnt++;
			}
			$sumgp += $sum2;
			$sumcrl += $sum1;

		}

		$cgpss = round($sumgp/$sumcrl,3);
		$cgpss = (string)$cgpss;
		$ss = strlen($cgpss);
		if ($ss < 5){
			while ($ss < 5){
				if ($ss == 1){
					$cgpss = $cgpss . ".";
					$ss++;}
				else{
					$cgpss = $cgpss . "0";
					$ss++;}
			}
		}
		$fgp[$cnt2] = $cgpss;
		echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
		echo "<td align = 'center'>&nbsp;</td><td>&nbsp;</td>";
		echo "<td>&nbsp;</td><td align = 'center'>&nbsp;";
		echo "<td align = 'center'>";
		$cnt2++;

	}

		
?>
</Table>
<?php

}
}
?>
</body>
</html>
