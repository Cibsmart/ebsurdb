<?php
	include("../dbconn.php");
	
	if (isset($_GET['a'])){
		$faculty_name = $_GET['a'];
		addnewfaculty($faculty_name);
	}
	
	if (isset($_GET['b'])){
		$faculty_id = $_GET['b'];
		removefaculty($faculty_id);
	}
	
	if (isset($_GET['c'])){
		$str = $_GET['c'];
		$sets = explode("-",$str);
		$faculty_id = $sets[0];
		$dept_name = $sets[1];
		addnewdept($faculty_id, $dept_name);
	}
	
	if (isset($_GET['e'])){
		$setss = explode("-",$_GET['e']);
		$dept_id = $setss[1];
		$fac_id = $setss[0];
		removedept($fac_id, $dept_id);
	}
	
	if (isset($_GET['f'])){
		$faculty_id = $_GET['f'];
		filldept($faculty_id);
	}
	
	if (isset($_GET['g'])){
		$sex = explode("-",$_GET['g']);
		$fac_id = $sex[0];
		$dep_id = $sex[1];
		$level =  $sex[2];
		$semester = $sex[3];
		fillcourses($fac_id, $dep_id, $level, $semester);
	}
	
	if (isset($_GET['h'])){
		$sexs = explode("-",$_GET['h']);
		$facs_id = $sexs[0];
		$deps_id = $sexs[1];
		$levels =  $sexs[2];
		$semesters = $sexs[3];
		$codes = $sexs[4];
		$titles = $sexs[5];
		$lods =  $sexs[6];
		$specs = $sexs[7];
		addcourses($facs_id, $deps_id, $levels, $semesters, $codes, $titles, $lods, $specs);
	}
	
	if (isset($_GET['i'])){
		$sexss = explode("-",$_GET['i']);
		$course_id = $sexss[0];
		$facs_id = $sexss[1];
		$deps_id = $sexss[2];
		$levels =  $sexss[3];
		$semesters = $sexss[4];
		
		removecourse($course_id, $facs_id, $deps_id, $levels, $semesters);
	}
	if (isset($_GET['j'])){
		$sex = explode("-",$_GET['j']);
		$fac_id = $sex[0];
		$dep_id = $sex[1];
		$level =  $sex[2];
		$semester = $sex[3];
		totalload($fac_id, $dep_id, $level, $semester);
	}
	
	if (isset($_GET['k'])){
		$sex = explode("-",$_GET['k']);
		$fac_id = $sex[0];
		$dep_id = $sex[1];
		$level =  $sex[2];
		$semester = $sex[3];
		$session = $sex[4];
		fillcourses2($fac_id, $dep_id, $level, $semester, $session);
	}
	
	if (isset($_GET['l'])){
		$sex = explode("-",$_GET['l']);
		$fac_id = $sex[0];
		$dep_id = $sex[1];
		$level =  $sex[2];
		$semester = $sex[3];
		$session = $sex[4];
		$code = $sex[5];
		addselectedcourses($fac_id, $dep_id, $level, $semester, $session, $code);
	}

	if (isset($_GET['m'])){
		$sex = explode("-",$_GET['m']);
		$fac_id = $sex[0];
		$dep_id = $sex[1];
		$level =  $sex[2];
		$semester = $sex[3];
		$session = $sex[4];
		$code_id = $sex[5];
		removeselectedcourses($fac_id, $dep_id, $level, $semester, $session, $code_id);
	}
	
	
	//function to add new faculty
	function addnewfaculty($faculty_name){	
		$faculty_name = strtoupper($faculty_name);
		$sql1 = "INSERT INTO faculty_list (faculty_id, faculty_name) VALUES ('','$faculty_name')";
		mysql_query($sql1);
			
		echo fillfaculty();
	}
	
	//function to remove existing faculty
	function removefaculty($faculty_id){	
		$faculty_id = strtoupper($faculty_id);
		$sql1 = "DELETE FROM faculty_list WHERE faculty_id = '$faculty_id'";
		mysql_query($sql1);
		
		echo fillfaculty();
	}
	
	//function to remove existing courses
	function removecourse($course_id, $facs_id, $deps_id, $levels, $semesters){	
		$sql1 = "DELETE FROM gen_course_list WHERE gen_list_id = '$course_id'";
		mysql_query($sql1);
		
		echo fillcourses($facs_id, $deps_id, $levels, $semesters);
	}
	
	//function to add new faculty
	function addnewdept($faculty_id, $dept_name){	
		$dept_name = strtoupper($dept_name);
		$sql1 = "INSERT INTO dept_list (dept_id, dept_faculty_id, dept_name) VALUES ('','$faculty_id','$dept_name')";
		mysql_query($sql1);
		
		echo filldept($faculty_id);
	}
	
	//function to remove existing dept
	function removedept($fac_id, $dept_id){
		$sql1 = "DELETE FROM dept_list WHERE dept_id = '$dept_id' AND dept_faculty_id = '$fac_id' ";
		mysql_query($sql1);
		
		echo filldept($fac_id);
	}
	
	//function to fill change of dept combo	
	function fillchangedept(){	
		$sql = "SELECT * FROM dept_list ORDER BY dept_name";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		
		for ($i=1; $i<=$num; $i++){
			$datas = mysql_fetch_array($result);
			$deptid = $datas['dept_id'];
			$deptname = $datas['dept_name'];
			echo "<option value = $deptid > $deptname </option>";
		}
	}


	//function to fill changeofdept combo	
	function fillfaculty(){	
		$sql = "SELECT * FROM faculty_list where status = '1' ORDER BY faculty_name";
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
		
		for ($i=1; $i<=$num; $i++){
			$datas = mysql_fetch_array($result);
			$deptid = $datas['dept_id'];
			$deptname = $datas['dept_name'];
			echo "<option value = $deptid > $deptname </option>";
		}
	}

		
	//function to check for correct reg no format
	function correct_reg_no($reg_no){
		$ebsu =	substr($reg_no,0,4); $slash1 = substr($reg_no, 4,1); $slash2 = substr($reg_no, 9,1); $year = substr($reg_no, 5,4); 
				$no = substr($reg_no,10);
				$yearlen = strlen($year);
				$nolen =  strlen($no);
				if (($nolen == 5) || ($nolen == 6)){
					$nocor =  true;	
				}
				else{
					$nocor = false;
				}
		if (($ebsu == "EBSU") && ($slash1 == "/") && ($slash2 == "/") && ($yearlen == 4) &&($nocor)){
			return true;
		}
		else{
			return false;
		}
	
	}


	//function to fill list of courses	
	function fillcourses($fac, $dep, $lev, $sem){
		$sn = 1;
		$sql = "SELECT * FROM gen_course_list WHERE gen_list_faculty = '$fac' AND gen_list_dept = '$dep' AND gen_list_level = '$lev' AND gen_list_semester = '$sem' ORDER BY gen_list_code ";
		$result = mysql_query($sql) or die(mysql_error());
		$num = mysql_num_rows($result);
		
		for ($i=1; $i<=$num; $i++){
			$datas = mysql_fetch_array($result);
			$id = $datas['gen_list_id'];
			$code = $datas['gen_list_code'];
			$title = $datas['gen_list_title'];
			$cunit = $datas['gen_list_cunit'];
			$spec = $datas['gen_list_specification'];
			$course = $sn++.". " .$code . " - " . $title . " - " . $cunit . " - " . "($spec)";
			echo "<option value = $id > $course </option>";
		}
	}
	
	//function to fill list of courses	2
	function fillcourses2($fac, $dep, $lev, $sem, $session){
		$sn = 1;
		$sql = "SELECT * FROM sess_course_list WHERE sess_list_faculty = '$fac' AND sess_list_dept = '$dep' AND sess_list_level = '$lev' AND sess_list_semester = '$sem' AND sess_list_session = '$session' ORDER BY sess_list_code ";
		$result = mysql_query($sql) or die(mysql_error());
		$num = mysql_num_rows($result);
		
		for ($i=1; $i<=$num; $i++){
			$datas = mysql_fetch_array($result);
			$id = $datas['sess_list_id'];
			$code = $datas['sess_list_code'];
			$title = $datas['sess_list_title'];
			$cunit = $datas['sess_list_c_unit'];
			$spec = $datas['sess_list_specification'];
			$course = $sn++.". " .$code . " - " . $title . " - " . $cunit . " - " . "($spec)";
			echo "<option value = $id > $course </option>";
		}
	}
	
	//function to add new course
	function addcourses($facs_id, $deps_id, $levels, $semesters, $codes, $titles, $lods, $specs){	
		$semesters = strtoupper($semesters);
		$codes = strtoupper($codes);
		$titles = strtoupper($titles);
		$specs = strtoupper($specs);
		
		$sql1 = "INSERT INTO gen_course_list (gen_list_id, gen_list_level, gen_list_specification, gen_list_cunit, gen_list_semester, gen_list_code, gen_list_title, gen_list_faculty, gen_list_dept) 
		VALUES ('','$levels','$specs','$lods','$semesters','$codes','$titles','$facs_id','$deps_id')";
		mysql_query($sql1);
		
		echo fillcourses($facs_id, $deps_id, $levels, $semesters);
	}
	
	
	//function to computer total load	
	function totalload($fac_id, $dep_id, $level, $semester){
		$load = 0;
		$sql = "SELECT gen_list_cunit FROM gen_course_list WHERE gen_list_faculty = '$fac_id' AND gen_list_dept = '$dep_id' AND gen_list_level = '$level' AND gen_list_semester = '$semester' ORDER";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		
		for ($i=1; $i<=$num; $i++){
			$datas = mysql_fetch_array($result);
			$cunit = (int)($datas['gen_list_cunit']);
			$load =+ $cunit;
		}
		echo $load;
	}
	
	
	//function to add new course
	function addselectedcourses($fac_id, $dep_id, $level, $semesters, $session, $codes){	
		$semesters = strtoupper($semesters);
		$codes = strtoupper($codes);
		$sql = "SELECT * FROM gen_course_list WHERE gen_list_id = '$codes' ";
		$result = mysql_query($sql);
		$datas = mysql_fetch_array($result);
		$code = $datas['gen_list_code'];
		$title = $datas['gen_list_title'];
		$specs = $datas['gen_list_specification'];
		$lods = $datas['gen_list_cunit'];
		
		$sql1 = "INSERT INTO sess_course_list (sess_list_id, sess_list_level, sess_list_study_mode, sess_list_specification, sess_list_c_unit, sess_list_session, sess_list_semester, sess_list_code, sess_list_title, sess_list_faculty, sess_list_dept) 
		VALUES ('','$level','','$specs','$lods','$session','$semesters','$code','$title','$fac_id','$dep_id')";
		mysql_query($sql1);
		
		echo fillcourses2($fac_id, $dep_id, $level, $semesters, $session);
	}
	
	function removeselectedcourses($fac_id, $dep_id, $level, $semester, $session, $code_id){	
		$sql1 = "DELETE FROM sess_course_list WHERE sess_list_id = '$code_id'";
		mysql_query($sql1);
		
		fillcourses2($fac_id, $dep_id, $level, $semester, $session);
	}
?>