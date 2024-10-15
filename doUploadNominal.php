<?php 	
session_start();
if(isset($_SESSION['uid']) && $_SESSION['ulev'] == 0){
		$cid = $_SESSION['uid'];
	}
	else{
		header("location:login.php");
	}
include "dbconn.php";// Includes the file that connects to the DB 
include ('utilities/logging.php'); 
$me = 0;	
$row = 1; $you = 0;
	$tymes = time() + (60 * 60);
	$today = date("Y-m-d",$tymes);
	$times = date("H:i:s",$tymes);
	$startt =  "Start Time: " . $today ." ". $times . "<br />";
 $handle = @fopen("c:\\users\\USER\\desktop\\rdbs\\New Nominal Roll.csv", "r");
$handle2 = @fopen("c:\\users\\USER\\desktop\\rdbs\\Duplicate Nominal $today.csv", "a");
	if(!$handle2){
		echo "Please Close Duplicate Nominal $today.csv to Continue";
		exit;
	}
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        //echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
		/*echo "<tr>";
        for ($c=0; $c < $num; $c++) {
			echo $data[$c] . "<br />";
		}*/
		//echo "</tr>";
		
		$reg_no = addslashes(strtoupper($data[0]));
		$title = addslashes(strtoupper($data[1]));
		$firstname  = addslashes(strtoupper($data[2]));
		$middlename  = addslashes(strtoupper($data[3]));
		$lastname = addslashes(strtoupper($data[4]));
		$fname = addslashes(strtoupper($data[5]));
		$sex = addslashes(strtoupper($data[6]));
		$phone = addslashes($data[7]);
		$email = addslashes($data[8]);
		$date_of_birth = $data[9];
		$placeofbirth = addslashes(strtoupper($data[10]));
		$country = addslashes(strtoupper($data[11]));
		$state = addslashes(strtoupper($data[12]));
		$lga = addslashes(strtoupper($data[13]));
		$townoforigin = addslashes(strtoupper($data[14]));
		$maritalstatus = addslashes(strtoupper($data[15]));
		$religion = addslashes(strtoupper($data[16]));
		$permanentaddress = addslashes(strtoupper($data[18]));
		$contactaddress = addslashes(strtoupper($data[17]));
		$yearofentry = addslashes($data[19]);
		$awardinview = addslashes(strtoupper($data[20]));
		$faculty = addslashes(strtoupper($data[21]));
		$dept = addslashes(strtoupper($data[22]));
		$option = addslashes(strtoupper($data[23]));
		$modeofstudy = addslashes(strtoupper($data[24]));
		$durationofstudy = addslashes(strtoupper($data[25]));
		$modeofentry = addslashes(strtoupper($data[26]));
		$changeofdept = addslashes(strtoupper($data[27]));
		$previousuniversity = addslashes(strtoupper($data[28]));
		$programtype = addslashes(strtoupper($data[29]));
		$highestqualification = addslashes(strtoupper($data[30]));
		$highestqualificaitoninst = addslashes(strtoupper($data[31]));
		$highestqualificationdate = $data[32];
		$firstdegreecourse = addslashes(strtoupper($data[33]));
		$nokname = addslashes(strtoupper($data[34]));
		$nokaddress = addslashes(strtoupper($data[35]));
		$nokrelationship = addslashes($data[36]);
		$nokphoneno = addslashes($data[37]);
		$sponname = addslashes(strtoupper($data[38]));
		$sponaddress = addslashes(strtoupper($data[39]));
		$sponphoneno = addslashes($data[40]);
		$extraactivities = addslashes(strtoupper($data[41]));
		$healthstatus = addslashes(strtoupper($data[42]));
		$disability = addslashes(strtoupper($data[43]));
		$medicationtype = addslashes(strtoupper($data[44]));
		
		$jambno = addslashes(strtoupper($data[46]));
		$updateinfo = date('r');
			
		$sql = "INSERT INTO std_info (std_reg_no, std_title, std_firstname, std_middlename, std_lastname, std_name, std_sex, std_phone_no, std_email, std_birth_date, std_birth_place, std_nationality, std_origin_state, std_origin_lga, std_origin_town, std_marital_status, std_religion, std_contact_address, std_permanent_address, std_entry_year, std_award_view, std_faculty, std_dept, std_option, std_study_mode, std_study_duration, std_entry_mode, std_former_dept, std_previous_university, std_program_type, std_heighest_qualification, std_heighest_qualification_inst, std_heighest_qualification_date, std_first_degree_course, std_next_kin_name, std_next_kin_address, std_next_kin_relationship, std_next_phone_no, std_sponsor_name, std_sponsor_address, std_sponsor_phone, std_extra_activities, std_health_status, std_disability_type, std_medication_type, std_update_info, std_jambno)	VALUES('$reg_no', '$title', '$firstname', '$middlename', '$lastname', '$fname', '$sex', '$phone', '$email', '$date_of_birth', '$placeofbirth','$country', '$state', '$lga', '$townoforigin', '$maritalstatus', '$religion', '$contactaddress', '$permanentaddress', '$yearofentry', '$awardinview', '$faculty', '$dept', '', '$modeofstudy', '$durationofstudy', '$modeofentry', '$changeofdept', '$previousuniversity', '$programtype', '$highestqualification', '$highestqualificaitoninst', '$highestqualificationdate', '$firstdegreecourse', '$nokname', '$nokaddress', '$nokrelationship', '$nokphoneno', '$sponname', '$sponaddress', '$sponphoneno', '$extraactivities', '$healthstatus', '$disability', '$medicationtype', '$updateinfo', '$jambno')";
	
	
		
		$result = mysql_query($sql);
		

		
		if($result){
			$me++;
		}
		else{
			$you++;
			fputcsv($handle2,$data);
		}
    }
	fclose($handle2);
    fclose($handle);
	$all = $me + $you;
	$stopp = "Stop Time: ".date("Y-m-d H:i:s",$tymes);
	$act = "Uploaded $me Records into Students Nominal Roll DB_Table";
	logg($cid, $act);

	echo "<div style='text-decoration:underline;color:red;'>Nominal Roll Upload Information</div>
	Total Number of Records = $all <br /> Number of Records Uploaded = $me <br /> Number of Duplicated Records = $you<br /> $startt $stopp" ;
?>