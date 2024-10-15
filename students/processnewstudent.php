<?php
	include("../dbconn.php");
	include("functions.php");
	include('../utilities/logging.php');
		
	if (isset($_POST['buton'])){
		$reg_no = addslashes(strtoupper($_POST['reg_no']));
		$title = addslashes(strtoupper($_POST['title']));
		$firstname  = addslashes(strtoupper($_POST['firstname']));
		$middlename  = addslashes(strtoupper($_POST['middlename']));
		$lastname = addslashes(strtoupper($_POST['lastname']));
		$sex = addslashes(strtoupper($_POST['sex']));
		$phone = addslashes($_POST['phone']);
		$email = addslashes($_POST['email']);
		$dateyear = $_POST['dateyear'];
		$datemonth = $_POST['datemonth'];
		$dateday = $_POST['dateday'];
		$placeofbirth = addslashes(strtoupper($_POST['placeofbirth']));
		$nationality = addslashes(strtoupper($_POST['nationality']));
		$stateoforigin = addslashes(strtoupper($_POST['stateoforigin']));
		$lgaoforigin = addslashes(strtoupper($_POST['lgaoforigin']));
		$townoforigin = addslashes(strtoupper($_POST['townoforigin']));
		$maritalstatus = addslashes(strtoupper($_POST['maritalstatus']));
		$religion = addslashes(strtoupper($_POST['religion']));
		$permanentaddress = addslashes(strtoupper(trim($_POST['permanentaddress'])));
		$contactaddress = addslashes(strtoupper(trim($_POST['contactaddress'])));
		$nokname = addslashes(strtoupper($_POST['nokname']));
		$nokrelationship = addslashes(strtoupper($_POST['nokrelationship']));
		$nokphoneno = addslashes($_POST['nokphoneno']);
		$nokaddress = addslashes(strtoupper(trim($_POST['nokaddress'])));
		$sponname = addslashes(strtoupper($_POST['sponname']));
		$sponrelationship = addslashes(strtoupper($_POST['sponrelationship']));
		$sponphoneno = addslashes($_POST['sponphoneno']);
		$sponaddress = addslashes(strtoupper(trim($_POST['sponaddress'])));
		$yearofentry = addslashes($_POST['yearofentry']);
		$modeofentry = addslashes(strtoupper($_POST['modeofentry']));
		$previousuniversity = addslashes(strtoupper($_POST['previousuniversity']));
		$programtype = addslashes(strtoupper($_POST['programtype']));
		$highestqualification = addslashes(strtoupper(trim($_POST['highestqualification'])));
		$highestqualificaitoninst = addslashes(strtoupper(trim($_POST['highestqualificaitoninst'])));
		$highestqualificationmonth = addslashes(strtoupper($_POST['highestqualificationmonth']));
		$highestqualificationyear = addslashes($_POST['highestqualificationyear']);
		$firstdegreecourse = addslashes(strtoupper($_POST['firstdegreecourse']));
		$awardinview = addslashes(strtoupper($_POST['awardinview']));
		$faculty_id = addslashes(strtoupper($_POST['faculty']));
		$department_id = addslashes(strtoupper($_POST['department']));
		$option = addslashes(strtoupper($_POST['option']));
		$modeofstudy = addslashes(strtoupper($_POST['modeofstudy']));
		$durationofstudy = addslashes(strtoupper($_POST['durationofstudy']));
		$changeofdept = addslashes(strtoupper($_POST['changeofdept']));
		$extraactivities = addslashes(strtoupper($_POST['extraactivities']));
		$healthstatus = addslashes(strtoupper($_POST['healthstatus']));
		$disability = addslashes(strtoupper($_POST['disability']));
		$medicationtype = addslashes(strtoupper($_POST['medicationtype']));

		$date_of_birth = $dateyear . "-" . $datemonth . "-" .$dateday;
		$country = nationality($nationality);
		$state = state($stateoforigin, $nationality);
		$lga = lga($lgaoforigin, $stateoforigin, $nationality);
		$fac = faculty($faculty_id);
		$dept = dept($department, $faculty_id);
		$highestqualificationdate = $highestqualificationmonth . "-" . $highestqualificationyear;
		$today =  "cib" . date('l jS F Y h:i:s A');
		$updateinfo = $today;
		$changeofdept = dept2($changeofdept);
		
		/*echo "Reg No = $reg_no<br />";
		echo "Title = $title<br />";
		echo "firstname  = $firstname<br />";
		echo "middlename  = $middlename<br />";
		echo "lastname = $lastname<br />";
		echo "sex = $sex<br />";
		echo "phone = $phone<br />";
		echo "email = $email<br />";
		echo "date of birth = $date_of_birth<br />";
		echo "placeofbirth = $placeofbirth<br />";
		echo "nationality = $country<br />";
		echo "stateoforigin = $state<br />";
		echo "lgaoforigin = $lga<br />";
		echo "townoforigin = $townoforigin<br />";
		echo "maritalstatus = $maritalstatus<br />";
		echo "religion = $religion<br />";
		echo "permanentaddress = $permanentaddress<br />";
		echo "contactaddress = $contactaddress<br />";
		echo "nokname = $nokname<br />";
		echo "nokrelationship = $nokrelationship<br />";
		echo "nokphoneno = $nokphoneno<br />";
		echo "nokaddress = $nokaddress<br />";
		echo "sponname = $sponname<br />";
		echo "sponrelationship = $sponrelationship<br />";
		echo "sponphoneno = $sponphoneno<br />";
		echo "sponaddress = $sponaddress<br />";
		echo "yearofentry = $yearofentry<br />";
		echo "modeofentry = $modeofentry<br />";
		echo "previousuniversity = $previousuniversity<br />";
		echo "programtype = $programtype<br />";
		echo "highestqualification = $highestqualification<br />";
		echo "highestqualificaitoninst = $highestqualificaitoninst<br />";
		echo "highestqualificationdate = $highestqualificationdate<br />";
		echo "firstdegreecourse = $firstdegreecourse<br />";
		echo "awardinview = $awardinview<br />";
		echo "faculty = $faculty<br />";
		echo "department = $dept<br />";
		echo "modeofstudy = $modeofstudy<br />";
		echo "durationofstudy = $durationofstudy<br />";
		echo "changeofdept = $changeofdept<br />";
		echo "extraactivities = $extraactivities<br />";
		echo "healthstatus = $healthstatus<br />";
		echo "disability = $disability<br />";
		echo "medicationtype = $medicationtype<br />";*/

	}
	else{
		header("location:newstudent.php");
	}

	$sql = "INSERT INTO std_info (std_reg_no, std_title, std_firstname, std_middlename, std_lastname, std_sex, std_phone_no, std_email, std_birth_date, std_birth_place, std_nationality, std_origin_state, std_origin_lga, std_origin_town, std_marital_status, std_religion, std_contact_address, std_permanent_address, std_entry_year, std_award_view, std_faculty, std_dept, std_option, std_study_mode, std_study_duration, std_entry_mode, std_former_dept, std_previous_university, std_program_type, std_heighest_qualification, std_heighest_qualification_inst, std_heighest_qualification_date, std_first_degree_course, std_next_kin_name, std_next_kin_address, std_next_kin_relationship, std_next_phone_no, std_sponsor_name, std_sponsor_address, std_sponsor_phone, std_extra_activities, std_health_status, std_disability_type, std_medication_type, std_update_info)	VALUES('$reg_no', '$title', '$firstname', '$middlename', '$lastname', '$sex', '$phone', '$email', '$date_of_birth', '$placeofbirth','$country', '$state', '$lga', '$townoforigin', '$maritalstatus', '$religion', '$contactaddress', '$permanentaddress', '$yearofentry', '$awardinview', '$fac', '$dept', '$option', '$modeofstudy', '$durationofstudy', '$modeofentry', '$changeofdept', '$previousuniversity', '$programtype', '$highestqualification', '$highestqualificaitoninst', '$highestqualificationdate', '$firstdegreecourse', '$nokname', '$nokaddress', '$nokrelationship', '$nokphoneno', '$sponname', '$sponaddress', '$sponphoneno', '$extraactivities', '$healthstatus', '$disability', '$medicationtype', '$updateinfo')";
	
	$result = mysql_query($sql);
	
	$h = $reg_no;
	$act = "Registered A New Student - $h";
	logg($cid,$act);
	
	echo "Record Uploaded Successfully";
?>