<?php
	include("../dbconn.php");
	if (isset($_GET['a'])){
		$faculty_id = $_GET['a'];
		filldept($faculty_id);
	}
	
	//function to fill changeofdept combo	
	function fillfaculty(){	
		$sql = "SELECT * FROM faculty_list ORDER BY faculty_name";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		
		for ($i=1; $i<=$num; $i++){
			$datas = mysql_fetch_array($result);
			$facultyid = $datas['faculty_id'];
			$facultyname = $datas['faculty_name'];
			echo "<option value = $facultyid > $facultyname </option>";
		}
	}
	
	//function to fill dept combo	
	function filldept($faculty_id){	
		$sql = "SELECT * FROM dept_list WHERE dept_faculty_id = '$faculty_id' ORDER BY dept_name";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		echo "<option value =''></option>";
		
		for ($i=1; $i<=$num; $i++){
			$datas = mysql_fetch_array($result);
			$deptid = $datas['dept_id'];
			$deptname = $datas['dept_name'];
			echo "<option value = $deptid > $deptname </option>";
		}
	}
	
	//Function to Get Faculty Name
	function getfacultyname($fac_id){	
		$sql = "SELECT * FROM faculty_list WHERE faculty_id = '$fac_id'";
		$result = mysql_query($sql);
		$datas = mysql_fetch_array($result);
		$facultyname = $datas['faculty_name'];
		return $facultyname;
	}
	
	//Function to Get Deptname
	function getdeptname($faculty_id, $dept_id){	
		$sql = "SELECT * FROM dept_list WHERE dept_faculty_id = '$faculty_id' AND dept_id = '$dept_id'";
		$result = mysql_query($sql);
		$datas = mysql_fetch_array($result);
		$deptname = $datas['dept_name'];
		return $deptname;
	}

//function to perform semester summary	
function summarizingsemester($reg_no, $sess, $sem){
		global $sn; global $cgpa; global $cib; $no = substr($reg_no,5,4);
		$sum2 = 0; $sum1 = 0;
		$cgpa = 0;
		$sql_res = "SELECT std_result_inc, std_result_exam, std_result_c_unit, std_result_code, std_result_title 
					FROM std_results 
					WHERE std_result_reg_no = '$reg_no' 
					AND std_result_session = '$sess' 
					AND std_result_semester = '$sem'
					ORDER BY std_result_code";
		$act_res = mysql_query($sql_res);
		$num_res = mysql_num_rows($act_res);
		$cib += $num_res;
		$j = 0;
		for ($j; $j < $num_res; $j++)
		{
			$row_res = mysql_fetch_array($act_res);
			$inc = $row_res["std_result_inc"];
			$exa = $row_res["std_result_exam"];
			$cod = $row_res["std_result_code"];
			$tit = $row_res["std_result_title"];
			$crl = $row_res["std_result_c_unit"];
			$tot = $inc + $exa;
			
			if($no >= 2011){
				if($tot >= 70 && $tot <= 100){
					$gra = "A";
					$gp = 5;
				}
				elseif ($tot >= 60 && $tot < 70){
					$gra = "B";
					$gp = 4;
				}
				elseif ($tot >=50 && $tot < 60){
					$gra = "C";
					$gp = 3;
				}
				elseif ($tot >=45  && $tot < 50){
					$gra = "D"; 
					$gp = 2;
				}
				else{
					$gra = "F"; $gp = 0;
				}
			}
			
			if($no < 2011){
				if($tot >= 70 && $tot <= 100){
					$gra = "A";
					$gp = 5;
				}
				elseif ($tot >= 60 && $tot < 70){
					$gra = "B";
					$gp = 4;
				}
				elseif ($tot >=50 && $tot < 60){
					$gra = "C";
					$gp = 3;
				}
				elseif ($tot >=45  && $tot < 50){
					$gra = "D"; 
					$gp = 2;
				}
				elseif ($tot >=40 && $tot < 45){
					$gra = "E";
					$gp = 1;
				}
				else{
					$gra = "F"; $gp = 0;
				}
			}
				$gp = $gp * $crl;
				$sum2 = $gp + $sum2; 
				$sum1 = $crl + $sum1;
				$cgpa =	$sum2 / $sum1;
				$cgpa = round($cgpa, 3);
		}
	}
	
//function to perform session summary
function summarizingsessional($reg_no, $sess){
		global $sn; global $cgpa; global $cib; $no = substr($reg_no,5,4);
		$sum2 = 0; $sum1 = 0;
		$cgpa = 0;
		$sql_res = "SELECT std_result_inc, std_result_exam, std_result_c_unit, std_result_code, std_result_title 
					FROM std_results 
					WHERE std_result_reg_no = '$reg_no' 
					AND std_result_session = '$sess' 
					ORDER BY std_result_code";
		$act_res = mysql_query($sql_res);
		$num_res = mysql_num_rows($act_res);
		$cib += $num_res;
		$j = 0;
		for ($j; $j < $num_res; $j++)
		{
			$row_res = mysql_fetch_array($act_res);
			$inc = $row_res["std_result_inc"];
			$exa = $row_res["std_result_exam"];
			$cod = $row_res["std_result_code"];
			$tit = $row_res["std_result_title"];
			$crl = $row_res["std_result_c_unit"];
			$tot = $inc + $exa;
			
			if($no >= 2011){
				if($tot >= 70 && $tot <= 100){
					$gra = "A";
					$gp = 5;
				}
				elseif ($tot >= 60 && $tot < 70){
					$gra = "B";
					$gp = 4;
				}
				elseif ($tot >=50 && $tot < 60){
					$gra = "C";
					$gp = 3;
				}
				elseif ($tot >=45  && $tot < 50){
					$gra = "D"; 
					$gp = 2;
				}
				else{
					$gra = "F"; $gp = 0;
				}
			}
			
			if($no < 2011){
				if($tot >= 70 && $tot <= 100){
					$gra = "A";
					$gp = 5;
				}
				elseif ($tot >= 60 && $tot < 70){
					$gra = "B";
					$gp = 4;
				}
				elseif ($tot >=50 && $tot < 60){
					$gra = "C";
					$gp = 3;
				}
				elseif ($tot >=45  && $tot < 50){
					$gra = "D"; 
					$gp = 2;
				}
				elseif ($tot >=40 && $tot < 45){
					$gra = "E";
					$gp = 1;
				}
				else{
					$gra = "F"; $gp = 0;
				}
			}
				$gp = $gp * $crl;
				$sum2 = $gp + $sum2; 
				$sum1 = $crl + $sum1;
				$cgpa =	$sum2 / $sum1;
				$cgpa = round($cgpa, 3);
		}
	}

function summarizingdepartmental($reg_no, $sess){
		global $sn; global $cgpa; global $cib; $no = substr($reg_no,5,4);
		$sum2 = 0; $sum1 = 0;
		$cgpa = 0;
		//echo $reg_no .  $sess."<br>";
		$sql = "SELECT std_result_inc, std_result_exam, std_result_c_unit, std_result_code, std_result_title 
					FROM std_results 
					WHERE std_result_reg_no = '$reg_no'
					AND std_result_session = '$sess' 
					ORDER BY std_result_code";
		//$sql = "SELECT * FROM std_results WHERE std_result_reg_no = 'EBSU/2009/51486' and std_result_session = '2006/2007'";
		$res = mysql_query($sql) or die(mysql_error());
		$num_res = mysql_num_rows($res);
		//echo $num_res."<br>";
		$cib += $num_res;
		$j = 0;
		for ($j; $j < $num_res; $j++){
			$row_res = mysql_fetch_array($res);
			$inc = $row_res["std_result_inc"];
			$exa = $row_res["std_result_exam"];
			$cod = $row_res["std_result_code"];
			$tit = $row_res["std_result_title"];
			$crl = $row_res["std_result_c_unit"];
			$tot = $inc + $exa;
			
			if($no >= 2011){
				if($tot >= 70 && $tot <= 100){
					$gra = "A";
					$gp = 5;
				}
				elseif ($tot >= 60 && $tot < 70){
					$gra = "B";
					$gp = 4;
				}
				elseif ($tot >=50 && $tot < 60){
					$gra = "C";
					$gp = 3;
				}
				elseif ($tot >=45  && $tot < 50){
					$gra = "D"; 
					$gp = 2;
				}
				else{
					$gra = "F"; $gp = 0;
				}
			}
			
			if($no < 2011){
				if($tot >= 70 && $tot <= 100){
					$gra = "A";
					$gp = 5;
				}
				elseif ($tot >= 60 && $tot < 70){
					$gra = "B";
					$gp = 4;
				}
				elseif ($tot >=50 && $tot < 60){
					$gra = "C";
					$gp = 3;
				}
				elseif ($tot >=45  && $tot < 50){
					$gra = "D"; 
					$gp = 2;
				}
				elseif ($tot >=40 && $tot < 45){
					$gra = "E";
					$gp = 1;
				}
				else{
					$gra = "F"; $gp = 0;
				}
			}
			
				$gp = $gp * $crl;
				$sum2 = $gp + $sum2; 
				$sum1 = $crl + $sum1;
				if($sum1 != 0){
				$cgpa =	$sum2 / $sum1;
				}
				$cgpa = round($cgpa, 3);
		}
}
	function ClassOfDegree($x){
		if ($x >= 4.50) {$degree = '1ST CLASS';}
		elseif ($x >= 3.50) {$degree = '2ND CLASS UPPER';}
		elseif ($x >= 2.40) {$degree = '2ND CLASS LOWER';}
		elseif ($x >= 1.50) {$degree = '3RD CLASS';}
		elseif ($x >= 1.00) {$degree = 'PASS';}
		else {$degree = 'FAIL';}
		return $degree;
	}

function summarizingfinaldepartmental($reg_no, $sess){
		global $sn; global $cgpa; global $cib; $no = substr($reg_no,5,4);
		$sum2 = 0; $sum1 = 0;
		$cgpa = 0;
		//echo $reg_no .  $sess."<br>";
		$sql = "SELECT std_result_inc, std_result_exam, std_result_c_unit, std_result_code, std_result_title 
					FROM std_results_final
					WHERE std_result_reg_no = '$reg_no'
					AND std_result_session = '$sess' 
					ORDER BY std_result_code";
		//$sql = "SELECT * FROM std_results WHERE std_result_reg_no = 'EBSU/2009/51486' and std_result_session = '2006/2007'";
		$res = mysql_query($sql) or die(mysql_error());
		$num_res = mysql_num_rows($res);
		//echo $num_res."<br>";
		$cib += $num_res;
		$j = 0;
		for ($j; $j < $num_res; $j++){
			$row_res = mysql_fetch_array($res);
			$inc = $row_res["std_result_inc"];
			$exa = $row_res["std_result_exam"];
			$cod = $row_res["std_result_code"];
			$tit = $row_res["std_result_title"];
			$crl = $row_res["std_result_c_unit"];
			$tot = $inc + $exa;
			
			if($no >= 2011){
				if($tot >= 70 && $tot <= 100){
					$gra = "A";
					$gp = 5;
				}
				elseif ($tot >= 60 && $tot < 70){
					$gra = "B";
					$gp = 4;
				}
				elseif ($tot >=50 && $tot < 60){
					$gra = "C";
					$gp = 3;
				}
				elseif ($tot >=45  && $tot < 50){
					$gra = "D"; 
					$gp = 2;
				}
				else{
					$gra = "F"; $gp = 0;
				}
			}
			
			if($no < 2011){
				if($tot >= 70 && $tot <= 100){
					$gra = "A";
					$gp = 5;
				}
				elseif ($tot >= 60 && $tot < 70){
					$gra = "B";
					$gp = 4;
				}
				elseif ($tot >=50 && $tot < 60){
					$gra = "C";
					$gp = 3;
				}
				elseif ($tot >=45  && $tot < 50){
					$gra = "D"; 
					$gp = 2;
				}
				elseif ($tot >=40 && $tot < 45){
					$gra = "E";
					$gp = 1;
				}
				else{
					$gra = "F"; $gp = 0;
				}
			}
			
				$gp = $gp * $crl;
				$sum2 = $gp + $sum2; 
				$sum1 = $crl + $sum1;
				if($sum1 != 0){
				$cgpa =	$sum2 / $sum1;
				}
				$cgpa = round($cgpa, 3);
		}
}

function getyearofgraduation($reg){
	$sql = "SELECT DISTINCT std_result_session FROM std_results WHERE std_result_reg_no = '$reg' ORDER BY std_result_session DESC";
	$res = mysql_query($sql) or die(mysql_error());	
	$r = mysql_fetch_array($res);
	return $r['std_result_session'];
}
?>