<?php
	include("../dbconn.php");
	
	if (isset($_GET['a'])){
		$sexss = explode("-",$_GET['a']);
		$reg_no = $sexss[0];
		$sess = $sexss[1];
		$level = $sexss[2];
		$semes =  $sexss[3];
		courses($reg_no, $sess, $level, $semes);
	}
	
	if (isset($_GET['b'])){
		$sexss = explode("-",$_GET['b']);
		$reg_no = $sexss[0];
		$sess = $sexss[1];
		$level = $sexss[2];
		$semes =  $sexss[3];
		$cod_id =  $sexss[4];
		$chk =  $sexss[5];

		if($chk){
			registercourse($reg_no, $sess, $level, $semes, $cod_id);
		}
		else{
			unregistercourse($reg_no, $sess, $level, $semes, $cod_id);
		}
		
	}
	
	
	//function to generate list of courses
	function courses($reg_no, $sess, $level, $semes){
		$reg_no = strtoupper($reg_no);
		$sql = "SELECT std_faculty, std_dept FROM std_info WHERE std_reg_no = '$reg_no'";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		
		if ($num == 1){
			$datas = mysql_fetch_array($result);
			$faculty = $datas['std_faculty'];
			$dept = $datas['std_dept'];
			$facultyid = getfacultyid($faculty);
			$deptid = getdeptid($facultyid, $dept);
			echo getcourses($facultyid, $deptid, $level, $semes, $sess, $reg_no);
		}
		else{
			echo "<span style='color:red; font-size:24px; font-weight:bolder'>Fill Student Information First</span>";
		}
	}
	

	function getfacultyid($facultyname){
		$sql = "SELECT faculty_id FROM faculty_list WHERE faculty_name = '$facultyname'";
		$result = mysql_query($sql);
		$datas = mysql_fetch_array($result);
		$facultyid = $datas['faculty_id'];
		return $facultyid;
	}
	
	
	function getdeptid($facultyid, $dept){
		$sql = "SELECT dept_id FROM dept_list WHERE dept_faculty_id = '$facultyid' AND dept_name = '$dept'";
		$result = mysql_query($sql);
		$datas = mysql_fetch_array($result);
		$deptid = $datas['dept_id'];
		return $deptid;
	}

	function getcourses($fac_id, $dep_id, $lev, $sem, $ses, $reg_no){
		$sn = 1; $totalload=0; $course_list = array(); $registered = 0;
		echo "<table border='1' style='font-size:12px; font-family:arial' width='600' cellpadding='1' cellspacing='1'>
				<tr>
					<td width='20' style='font-size:12px; font-family:arial; font-weight:bold' >S/N</td>
					<td width='50' style='font-size:12px; font-family:arial; font-weight:bold'></td>
					<td width='100' style='font-size:12px; font-family:arial; font-weight:bold'>COURSE CODE</td>
					<td style='font-size:12px; font-family:arial; font-weight:bold'>COURSE TITLE</td>
					<td width='80' style='font-size:12px; font-family:arial; font-weight:bold'>CREDIT UNIT</td>
				</tr>";

		//Checking Already Register Courses		
		$sql1 = "SELECT * FROM course_register WHERE register_reg_no = '$reg_no' AND register_session = '$ses' AND register_semester = '$sem'";
		$result1 = mysql_query($sql1) or die(mysql_query());
		$num1 = mysql_num_rows($result1);
		if ($num1 > 0){
			for ($j=0;$j<$num1;$j++){
				$datas1 = mysql_fetch_array($result1);
				$course_id1 = $datas1['register_sess_id'];
				$code1 = $datas1['register_code'];
				$title1 = $datas1['register_title'];
				$unit1 = $datas1['register_c_unit'];
				$totalload += $unit1;
				$registered += $unit1;
				$course_list[$course_id1] = $course_id1;
				echo "<tr>
						<td align='center'>" . $sn++ . "</td>
						<td align='center'>
							<input type='checkbox' value='$course_id1' id='$course_id1' 
								name='$course_id1' checked='checked' disabled='disabled'/></td>
						<td>$code1</td>
						<td>$title1</td>
						<td align='center'>$unit1</td>
					</tr>";
			}
		}
			
		//Checking Available Courses		
		$sql = "SELECT * FROM sess_course_list 
				WHERE sess_list_faculty = '$fac_id' 
				AND sess_list_dept = '$dep_id' 
				AND sess_list_level = '$lev' 
				AND sess_list_semester = '$sem' 
				AND sess_list_session = '$ses' 
				ORDER BY sess_list_code ";
		$result = mysql_query($sql) or die(mysql_query());
		$num = mysql_num_rows($result);
		
		if ($num > 0){
			
			for ($i=0;$i<$num;$i++){
				$datas = mysql_fetch_array($result);
				$course_id = $datas['sess_list_id'];
				if (!array_key_exists($course_id,$course_list)){
					$code = $datas['sess_list_code'];
					$title = $datas['sess_list_title'];
					$unit = $datas['sess_list_c_unit'];
					$totalload += $unit;
					echo "<tr>
							<td align='center'>" . $sn++ . "</td>
							<td align='center'><input type='checkbox' value='$course_id' id='$course_id' name='$course_id' onclick='registercourses(this.value, this.checked)'/></td>
							<td>$code</td>
							<td>$title</td>
							<td align='center'>$unit</td>
						</tr>";
				}
			}
			
		}
		else{
			echo "<span style='color:red; font-size:24px; font-weight:bolder'>
					Courses Has Not be Alloted for this Session
				  </span>";
		}
			echo "<td></td>
				<td align='right'></td><td></td>
				<td>
				<span style='font-weight:bolder; font-size:14px;'>*Total Credit Load = </span>
				<span id='totals' name='totals' style='font-weight:bolder; font-size:14px;'>$registered</span></td>
				<td align='center'>
				<input type='text' size='3' id='total' name='total' value='$totalload' style='text-align:center; font-weight:bold; font-size:14px'>
				</td>";
			echo "</table>
				<span style='font-weight:bolder; font-size:10px;color:red'>
					*Please Note your maximum CREDIT LOAD is 24 units
				</span>";
		
	}
/////////////////////////////////////////////////////////////////////////////////	
	//function to register courses
	function registercourse($reg_no, $sess, $level, $semes, $codeid){
		$semes = strtoupper($semes);
		$reg_no = strtoupper($reg_no);
		$cload = totalcredit($reg_no, $sess, $semes);

		$sql = "SELECT * FROM sess_course_list WHERE sess_list_id = '$codeid'";
		$result = mysql_query($sql) or die(mysql_query());
		$num = mysql_num_rows($result);

		$datas = mysql_fetch_array($result);
		$courseid = $datas['sess_list_id'];
		$spec = $datas['sess_list_specification'];
		$load = $datas['sess_list_c_unit'];
		$code = $datas['sess_list_code'];
		$title = $datas['sess_list_title'];
		$dept = $datas['sess_list_dept'];
		$datee = date("Y-m-d H:i:s");
		$cload += $load;
		if($cload <= 24){			
			$sql1 = "INSERT INTO course_register 
					(register_sess_id, register_reg_no, register_level, register_classification, register_c_unit, register_session, 
					 register_semester, register_code, register_title, register_std_dept, register_date) 
					VALUES('$courseid','$reg_no', '$level', '$spec', '$load', '$sess', '$semes', '$code', '$title', '$dept', '$datee')";
			mysql_query($sql1) or die(mysql_query());
			echo totalcredit($reg_no, $sess, $semes);
		}
		else{
			echo "error";
		}
		
	}

	function totalcredit($reg_no, $sess, $semes){
		$totalload = 0;
		$sql = "SELECT * FROM course_register WHERE register_reg_no = '$reg_no' AND register_session = '$sess' AND register_semester = '$semes'";
		$result = mysql_query($sql) or die(mysql_query());
		$num = mysql_num_rows($result);
		for ($i=0; $i<$num; $i++){
			$datas = mysql_fetch_array($result);
			$cunit = $datas['register_c_unit'];
			$totalload += $cunit;
		}
		return $totalload;
	}
////////////////////////////////////////////////////////////////////////	

	//function to register courses
	function unregistercourse($reg_no, $sess, $level, $semes, $codeid){
		/*$semes = strtoupper($semes);
		$reg_no = strtoupper($reg_no);
		$sql = "SELECT * FROM sess_course_list WHERE sess_list_id = '$codeid'";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);

		$datas = mysql_fetch_array($result);
		$spec = $datas['sess_list_specification'];
		$load = $datas['sess_list_c_unit'];
		$code = $datas['sess_list_code'];
		$title = $datas['sess_list_title'];
		$dept = $datas['sess_list_dept'];
		$datee = date("Y-m-d H:i:s");
		
		$sql1 = "INSERT INTO course_register (register_reg_no, register_level, register_classification, register_c_unit, register_session, register_semester, register_code, register_title, register_std_dept, register_date) VALUES('$reg_no', '$level', '$spec', '$load', '$sess', '$semes', '$code', '$title', '$dept', '$datee')";
		mysql_query($sql1) or die(mysql_error());
		
		echo $code;*/
	}

////////////////////////////////////////////////////////////////////////	
?>