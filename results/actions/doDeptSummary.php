<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<title>Dept Summary</title>
<html xmlns="http://www.w3.org/1999/xhtml">
<p align="left"><a href="#" onclick="javascript:window.print()"><font size="1">
PRINT</font></a>
<font size="1">
<a href="#" onclick="javascript:window.close()"><font color="#800000">CLOSE</font></a></font>
<br></p>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php 	include "c.php"; // Includes the file that connects to the DB
	include "f.php";
	
	if (filled_out($HTTP_POST_VARS) && ($Set != 0))  {
		$query = "Select Dept from dept order by Dept";
		$act = mysql_query($query);
		$num_dept = mysql_num_rows($act);	
			 for ($i = 1; $i <= $num_dept; $i++)
				{	$r = mysql_fetch_array($act);
					$rr = $r["Dept"];
					$mydept[$i] = $rr;
				}
		$dep = trim($Dep);
		$dep = $mydept[$dep]; 


	$set = trim($Set);

	$sql_reg = "Select Reg from biodata where Dept = '$dep' order by Reg";
	$act_reg = mysql_query($sql_reg);
	$num_reg = mysql_num_rows($act_reg); $rlist = 0;

	for ($z = 0; $z < $num_reg; $z++)
		{
			$r_reg = mysql_fetch_array($act_reg);
			$regg = trim($r_reg["Reg"]);
			$regs = substr(trim($regg),5,4);
			if ($regs == $set)
				{
					$reglist[$rlist++] = $regg;
				}
		}
	if (isset($reglist))
	{
		$std_all = count($reglist);
	}
	else
	{
		$std_all = 0;
	}
echo "<center><h3> RESULT SUMMARY LIST FOR ". $dep . " DEPARTMENT (". $set . " SET) </h3></center>";

?>
</head>

<body>

<table border="1" align="center" width="600" cellspacing="0">
	<tr align="center" bgcolor="#999999">
		<td><b>SN</td>
		<td><b>NAMES OF STUDENT</td>
		<td><b>REG. NO.</td>
		<td><b>CGPA</td>
	</tr>
<?php
	$cnt2 = 0; $nFirstClass = 0; $nSecondClassU = 0; $nSecondClassL = 0; $nThirdClass = 0; $nPass = 0; $nFail = 0;
	for ($zz = 0; $zz < $std_all; $zz++)
	{
		$cib = 0; $fsum = 0; $cnt = 0;
		$Regee = $reglist[$zz]; $fcgpa = 0;
		$sql_name = "Select Namee from biodata where Reg = '$Regee'";
		$act_name = mysql_query($sql_name);
		$num_name = mysql_num_rows($act_name);
		$r_name = mysql_fetch_array($act_name);
		$Namee = $r_name["Namee"];

		$sql_sess = "Select distinct Session from dd2 where Reg = '$Regee' order by Session";
		$act_sess = mysql_query($sql_sess);
		$num_sess = mysql_num_rows($act_sess);
		if ($num_sess !== 0)
		{
			$cnt_sess = 0; $cgps = 0;
			$cal_gp = array(array());
			
			for ($cnt_sess; $cnt_sess < $num_sess; $cnt_sess++)
			{
				$row_sess = mysql_fetch_array($act_sess);
				$sess = trim($row_sess["Session"]);
						std_res2($sess, $Regee);
						$fcgpa = round($cgpa,3);
						$fcgps[$cnt++] = $fcgpa;
			}
		
			$fsum = array_sum($fcgps);
			$fcgps = range(0,0);
			
			$fcgpa = round($fsum / $num_sess, 3);
		}	$fcgpa = (string)$fcgpa;
			if ($fcgpa >= 4.5){$nFirstClass++;}
				else if ($fcgpa >= 3.5){$nSecondClassU++;}
				else if ($fcgpa >= 2.5){$nSecondClassL++;}
				else if ($fcgpa >= 1.5){$nThirdClass++;}
				else if ($fcgpa >= 1.0){$nPass++;}
				else {$nFail++;}
			$fgplist[$Regee]= $fcgpa;
			$nlist[$Regee] = $Namee;
			$num[$Regee] = $cib;
	}
	
	$sn = 1;
	if (isset($fgplist))
	{
		arsort($fgplist);
		foreach ($fgplist as $key => $val)
		{	
			$namee = $nlist[$key]; $no = $num[$key];
			$val = (string)$val;
			$ss = strlen($val);
			if ($ss < 5){
				while ($ss < 5){
					if ($ss == 1){
						$val = $val . ".";
						$ss++;}
					else{
						$val = $val . "0";
						$ss++;}
				}
			}
			echo "<tr><td align = 'center'>". $sn++ ."</td><td>". $namee . "</td><td align = 'center'>". $key ."</a></td><td align = 'center'>". $val ."</td><td align = 'center'>". $no ."</td></tr>";
		}
	}
	else
	{
		echo "<h3><font color='#FF0000'>No Student Found!</h3></font>";
	}
?>
</table>
<p></p><p align="center">

<font size = 4><b>Summary</font></b>

<table border = 1 align="center" width="300" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			First Class:
		</td>
		<td align="center"> 4.50 - 5.00
		</td>
		<td align="center">
		<?php echo $nFirstClass ?>
		</td>
	</tr>
	<tr>
		<td>
			Second Class Upper:
		</td>
		<td align="center"> 3.50 - 4.49
		</td>
		<td align="center">
		<?php echo $nSecondClassU ?>
		</td>
	</tr>
	<tr>
		<td>
			Second Class Lower:
		</td>
		<td align="center"> 2.50 - 3.49
		</td>
		<td align="center">
		<?php echo $nSecondClassL ?>
		</td>
	</tr>	
	<tr>
		<td>
			Third Class:
		</td>
		<td align="center"> 1.50 - 2.49
		</td>
		<td align="center">
		<?php echo $nThirdClass ?>
		</td>
	</tr>
	<tr>
		<td>
			Pass:
		</td>
		<td align="center"> 1.00 - 1.49
		</td>
		<td align="center">
		<?php echo $nPass ?>
		</td>
	</tr>
	<tr>
		<td>
			Fail:
		</td>
		<td align="center"> 0.00 - 0.99
		</td>
		<td align="center">
		<?php echo $nFail ?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			Total:
		</td>
		<td align="center">
		<?php if (isset($fgplist)) {echo count($fgplist);} }
else {
		echo "<p align='center'><font size='+1' face='Arial, Helvetica, sans-serif' color = #FF0000 >Please Go Back and Fill Out Form Correctly and Properly</font></p>";
		}
		?>
		</td>
	</tr>

</table>
</body>
</html>
<?php function filled_out($form_vars)
	{
		foreach($form_vars as $key => $value)
		{
			if ((!isset($key)) || ($value == 0)) {return false;}
			else { return true;}
		}
	}
?>