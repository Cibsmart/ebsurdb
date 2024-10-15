<?php
	include("func.php");
	$fac_id = $_POST['faculty'];
	$dep_id = $_POST['dept'];
	
	$id = $_POST['staff_id'];
	$fname = trim(strtoupper($_POST['first_name']));
	$mname = trim(strtoupper($_POST['middle_name']));
	$lname = trim(strtoupper($_POST['last_name']));
	$designation = trim(strtoupper($_POST['designation']));
	//$faculty = getfacultyname($fac_id);
	//$department = getdeptname($fac_id, $dep_id);
	$duties = trim(strtoupper($_POST['duties']));
	$grade = getrank($designation);
	
	$qual1 = $_POST['qualification1'];
	$qual2 = $_POST['qualification2'];
	$qual3 = $_POST['qualification3'];
	$qual4 = $_POST['qualification4'];
	
	$qualdate1 = $_POST['qualificationdate1'];
	$qualdate2 = $_POST['qualificationdate2'];
	$qualdate3 = $_POST['qualificationdate3'];
	$qualdate4 = $_POST['qualificationdate4'];
	
	/*$qualinst1 = $_POST['qualificationinst1'];
	$qualinst2 = $_POST['qualificationinst2'];
	$qualinst3 = $_POST['qualificationinst3'];
	$qualinst4 = $_POST['qualificationinst4'];*/
	
	  /*echo $id . "<br />";
	  echo $fname . "<br />";
	  echo $mname . "<br />";
	  echo $lname . "<br />";
	  echo $designation . "<br />";
	  echo $qualdate1 . $qual1 . "<br />";
	  echo $qualdate2 . $qual2 . "<br />";
	  echo $qualdate3 . $qual3 . "<br />";
	  echo $qualdate4 . $qual4 . "<br />";
	  echo $duties . "<br />";
	  echo $faculty . "<br />";
	  echo $department . "<br />";*/
	
	$sql = "INSERT INTO staff_list
			(staff_id, staff_firstname, staff_middlename, staff_lastname, staff_designation, staff_qualification1, staff_qual_date1,staff_qualification2, staff_qual_date2, staff_qualification3, staff_qual_date3, staff_qualification4, staff_qual_date4, staff_duties, staff_grade, staff_step, staff_cadre, staff_specialization, staff_status, staff_faculty, staff_dept, staff_std_faculty, staff_std_dept) 
			VALUES('$id','$fname','$mname','$lname','$designation','$qual1', '$qualdate1','$qual2','$qualdate2','$qual3','$qualdate3','$qual4','$qualdate4','$duties','$grade','','','','','$fac_id','$dep_id','$fac_id','$dep_id')";
	$result = mysql_query($sql) or die(mysql_error());
	if($result){
		$msg = "success";
		header("location:newstaff.php?msg=".$msg);
	}
	else{
		$msg = "error";
		header("location:newstaff.php?msg=".$msg);
	}
	
?>