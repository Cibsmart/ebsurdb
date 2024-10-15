<?php
	include("../dbconn.php");
	
		function fillyear(){
		echo "<option value=''></option>";
		for ($i=date("Y"); $i >= 1950; $i--){
			echo "<option value='$i'>$i</option>";
		}
	}
	
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
	
	if (isset($_GET['a'])){
		$faculty_id = $_GET['a'];
		filldept($faculty_id);
	}
	
	//function to fill dept combo	
	function filldept($faculty_id){	
		$sql = "SELECT * FROM dept_list WHERE dept_faculty_id = '$faculty_id'";
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
	function getfacultyname($facultyid){	
		$sql = "SELECT * FROM faculty_list WHERE faculty_id = '$facultyid' ";
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
	function getrank($desg){
		if($desg == "PROFESSOR"){
			$rank = 1;
		}
		elseif($desg == "ASSOCIATE PROFESSOR"){
			$rank = 2;
		}
		elseif($desg == "SENIOR LECTURER"){
			$rank = 3;
		}
		elseif($desg == "LECTURER I"){
			$rank = 4;
		}
		elseif($desg == "LECTURER II"){
			$rank = 5;
		}
		elseif($desg == "ASSITANT LECTURER"){
			$rank = 6;
		}
		elseif($desg == "GRADUATE ASSITANT"){
			$rank = 7;
		}
		elseif($desg == "CHIEF TECHNOLOGIST"){
			$rank = 8;
		}
		elseif($desg == "SENIOR LABORATORY TECHNOLOGIST"){
			$rank = 9;
		}
		elseif($desg == "TECHNOLOGIST I"){
			$rank = 10;
		}
		elseif($desg == "TECHNOLOGIST II"){
			$rank = 11;
		}
		elseif($desg == "HEIGHER EXECUTIVE OFFICER"){
			$rank = 12;
		}
		elseif($desg == "EXECUTIVE OFFICER"){
			$rank = 13;
		}
		elseif($desg == "ASSISTANT EXECUTIVE OFFICER"){
			$rank = 14;
		}
		elseif($desg == "AUDIT ASSISTANT"){
			$rank = 15;
		}
		elseif($desg == "SENIOR CLERICAL OFFICER"){
			$rank = 16;
		}
		elseif($desg == "CLERICAL OFFICER"){
			$rank = 17;
		}
		elseif($desg == "MESSENGER/CLEANER I"){
			$rank = 18;
		}
		elseif($desg == "MESSENGER/CLEANER II"){
			$rank = 19;
		}
		else{
			$rank = 20;	
		}
		return $rank;
	}
?>