<?php
	include("../dbconn.php");
	
	if (isset($_GET['q'])){
		$monthname = $_GET['q'];
		fillmonthdays($monthname);
	}
	
	if (isset($_GET['p'])){
		$countryid = $_GET['p'];
		fillstate($countryid);
	}
	
	if (isset($_GET['r'])){
		$stateid = $_GET['r'];
		filllga($stateid);
	}

	if (isset($_GET['s'])){
		$facultyid = $_GET['s'];
		filldept($facultyid);
	}
	
	if (isset($_GET['t'])){
		$faculty_name = $_GET['t'];
		addnewfaculty($faculty_name);
	}
	

	function addnewfaculty($faculty_name){	
		//$sql = "SELECT * FROM country_list";
		//$result = mysql_query($sql);
		//$num = mysql_num_rows($result);
		
		/*for ($i=1; $i<=$num; $i++){
			$datas = mysql_fetch_array($result);
			$countryid = $datas['country_id'];
			$countryname = $datas['country_name'];	
		}*/
		echo "<option value = $faculty_name> $faculty_name </option>";
	}
	
	//function to fill in monthdays
	function fillmonthdays($monthname){
		
		for ($i = 1; $i <= 31; $i++){
			$monthdays31[] = $i;
		}
		for ($i = 1; $i <= 30; $i++){
			$monthdays30[] = $i;
		}
		for ($i = 1; $i <= 29; $i++){
			$monthdays29[] = $i;
		}
		
		switch ($monthname){
			case "apr":
			case "jun":
			case "sep":
			case "nov":
				foreach ($monthdays30 as $value){
					echo "<option value='$value'>$value</option>";
				}
				break;
			case "feb":
				foreach ($monthdays29 as $value){
					echo "<option value='$value'>$value</option>";
				}
				break;
			default:
				foreach ($monthdays31 as $value){
					echo "<option value='$value'>$value</option>";
				}
		}

	}
	
	// function to fill country combo box
	function fillcountry(){	
		$sql = "SELECT * FROM country_list";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		
		for ($i=1; $i<=$num; $i++){
			$datas = mysql_fetch_array($result);
			$countryid = $datas['country_id'];
			$countryname = $datas['country_name'];
			echo "<option value = $countryid > $countryname </option>";
		}
	}
	
	
	// function to fill state combo box upon selecting country
	function fillstate($countryid){	
		echo $countryid;
		$sql = "SELECT * FROM state_list WHERE state_country_id = '$countryid' ";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		echo "<option value = '' > &nbsp; </option>";
		for ($i=1; $i<=$num; $i++){
			$datas = mysql_fetch_array($result);
			$stateid = $datas['state_id'];
			$statename = $datas['state_name'];
			echo "<option value = $stateid > $statename </option>";
		}
	}	
	

	// function to fill lga combo box upon selecting state
	function filllga($stateid){	
		echo $stateid;
		$sql = "SELECT * FROM lga_list WHERE lga_state_id = '$stateid' ";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		echo "<option value = '' > &nbsp; </option>";
		for ($i=1; $i<=$num; $i++){
			$datas = mysql_fetch_array($result);
			$lgaid = $datas['lga_id'];
			$lganame = $datas['lga_name'];
			echo "<option value = $lgaid > $lganame </option>";
		}
	}	
	

	//function to fill change of dept combo	
	function fillchangedept(){	
		$sql = "SELECT * FROM dept_list";
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
		$sql = "SELECT * FROM faculty_list";
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
	function filldept($facultyid){	
		$sql = "SELECT * FROM dept_list WHERE dept_faculty_id = '$facultyid' ";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		echo "<option value = ''>&nbsp;</option>";
		for ($i=1; $i<=$num; $i++){
			$datas = mysql_fetch_array($result);
			$deptid = $datas['dept_id'];
			$deptname = $datas['dept_name'];
			echo "<option value = $deptid > $deptname </option>";
		}
	}
	
	//function to check if new student's reg no is already in the database
	function check_reg_no($reg_no){	
		$ok = correct_reg_no($reg_no);
		if ($ok){
			$sql = "SELECT * FROM std_info WHERE std_reg_no = '$reg_no' ";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);
			
			if ($num == 0){
				return true;
			}
			else{
				$cib =  "This Registration Number - $reg_no Already Exists";
				header("location:newregno.php?msg=".$cib);
				return;
			}
		}
		else{
			$cib =  "Wrong Registration Number Format";
			header("location:newregno.php?msg=".$cib);
			return;
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

//function to check if new student's reg no is already in the database
	function check_reg_no2($reg_no){	
		$ok = correct_reg_no($reg_no);
		if ($ok){
			$sql = "SELECT * FROM std_info WHERE std_reg_no = '$reg_no' ";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);
			
			if ($num == 0){
				return false;
			}
			else{
				$cib =  "This Registration Number - $reg_no Does Not Exists";
				header("location:deletestudent.php?msg=".$cib);
				return;
			}
		}
		else{
			$cib =  "Wrong Registration Number Format";
			header("location:deletestudent.php?msg=".$cib);
			return;
		}
	}
?>