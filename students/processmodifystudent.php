<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
	include("../dbconn.php");
	include('../utilities/logging.php');

	$reg_no = addslashes(strtoupper($_POST['reg_no']));
	$title = addslashes(strtoupper($_POST['title']));
	$firstname  = addslashes(strtoupper($_POST['firstname']));
	$middlename  = addslashes(strtoupper($_POST['middlename']));
	$lastname = addslashes(strtoupper($_POST['lastname']));
	$sex = addslashes(strtoupper($_POST['sex']));
	$phone = addslashes($_POST['phone']);
	$email = addslashes($_POST['email']);
	$dateyear = $_POST['dobyear'];
	$datemonth = $_POST['dobmonth'];
	$dateday = $_POST['dobday'];
	$placeofbirth = addslashes(strtoupper($_POST['placeofbirth']));
	$nationality = addslashes(strtoupper($_POST['nationality']));
	$stateoforigin = addslashes(strtoupper($_POST['state']));
	$lgaoforigin = addslashes(strtoupper($_POST['lga']));
	$townoforigin = addslashes(strtoupper($_POST['town']));
	$maritalstatus = addslashes(strtoupper($_POST['marital']));
	$religion = addslashes(strtoupper($_POST['religion']));
	$permanentaddress = addslashes(strtoupper(trim($_POST['permanentaddress'])));
	$contactaddress = addslashes(strtoupper(trim($_POST['contactaddress'])));
	$nokname = addslashes(strtoupper($_POST['nokname']));
	$nokrelationship = addslashes(strtoupper($_POST['nokrelation']));
	$nokphoneno = addslashes($_POST['nokphone']);
	$nokaddress = addslashes(strtoupper(trim($_POST['nokaddress'])));
	$sponname = addslashes(strtoupper($_POST['sponname']));
	$sponphoneno = addslashes($_POST['sponphone']);
	$sponaddress = addslashes(strtoupper(trim($_POST['sponaddress'])));
	$yearofentry = addslashes($_POST['entryyear']);
	$modeofentry = addslashes(strtoupper($_POST['entrymode']));
	$previousuniversity = addslashes(strtoupper($_POST['previousuni']));
	$programtype = addslashes(strtoupper($_POST['progtype']));
	$highestqualification = addslashes(strtoupper($_POST['hqual']));
	$highestqualificaitoninst = addslashes(strtoupper(trim($_POST['hqualinst'])));
	$highestqualificationmonth = addslashes(strtoupper($_POST['hqualmonth']));
	$highestqualificationyear = addslashes($_POST['hqualyear']);
	$firstdegreecourse = addslashes(strtoupper($_POST['firstdegreecourse']));
	$awardinview = addslashes(strtoupper($_POST['awardview']));
	$faculty = addslashes(strtoupper($_POST['faculty']));
	$dept = addslashes(strtoupper($_POST['dept']));
	$option = addslashes(strtoupper($_POST['option']));
	$modeofstudy = addslashes(strtoupper($_POST['studymode']));
	$durationofstudy = addslashes(strtoupper($_POST['duration']));
	$changeofdept = addslashes(strtoupper($_POST['deptchange']));
	$extraactivities = addslashes(strtoupper($_POST['extraactivities']));
	$healthstatus = addslashes(strtoupper($_POST['hstatus']));
	$disability = addslashes(strtoupper($_POST['disability']));
	$medicationtype = addslashes(strtoupper($_POST['medicationtype']));

	$date_of_birth = $dateyear . "-" . $datemonth . "-" .$dateday;
	$country = $nationality;
	$state = $stateoforigin;
	$lga = $lgaoforigin;
	//$faculty = faculty($faculty);
	//$dept = dept($department, $faculty);
	if($highestqualificationyear != "" && $highestqualificationmonth != ""){
		$highestqualificationdate = $highestqualificationyear . "-" . $highestqualificationmonth;
	}
	else{
		$highestqualificationdate =  $highestqualificationmonth. $highestqualificationyear;
	}
	$today =  "cib" . date('l jS F Y h:i:s A');
	$updateinfo = $today;
	//$changeofdept = depts($changeofdept);
		
	$sql = "UPDATE std_info SET std_title = '$title', std_firstname = '$firstname', std_middlename = '$middlename', std_lastname = '$lastname', std_sex = '$sex', std_phone_no = '$phone', std_email = '$email', std_birth_date = '$date_of_birth', std_birth_place = '$placeofbirth', std_nationality = '$country', std_origin_state = '$state', std_origin_lga = '$lga', std_origin_town = '$townoforigin', std_marital_status = '$maritalstatus', std_religion = '$religion', std_contact_address = '$contactaddress', std_permanent_address = '$permanentaddress', std_entry_year = '$yearofentry', std_award_view = '$awardinview', std_faculty = '$faculty', std_dept = '$dept', std_option = '$option', std_study_mode = '$modeofstudy', std_study_duration = '$durationofstudy', std_entry_mode = '$modeofentry', std_former_dept = '$changeofdept', std_previous_university = '$previousuniversity', std_program_type = '$programtype', std_heighest_qualification = '$highestqualification', std_heighest_qualification_inst = '$highestqualificaitoninst', std_heighest_qualification_date = '$highestqualificationdate', std_first_degree_course = '$firstdegreecourse', std_next_kin_name = '$nokname', std_next_kin_address = '$nokaddress', std_next_kin_relationship = '$nokrelationship', std_next_phone_no = '$nokphoneno', std_sponsor_name = '$sponname', std_sponsor_address = '$sponaddress', std_sponsor_phone = '$sponphoneno', std_extra_activities = '$extraactivities', std_health_status = '$healthstatus', std_disability_type = '$disability', std_medication_type = '$medicationtype', std_update_info = '$updateinfo' WHERE std_reg_no = '$reg_no' ";
	
	$result = mysql_query($sql) or die(mysql_error() . mysql_errno());
	if($result){
		$msg = $reg_no . " Records' Modified Successfully";
		header("location:modifyregno.php?don=".$msg);
		$h = $reg_no;
		$act = "Modified $h - Record";
		logg($cid,$act);
	}
	
?>
</body>
</html>