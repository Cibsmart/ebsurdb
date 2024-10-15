<?php
	
	//function to get country name
	function nationality($a){
		$sql = "SELECT * FROM country_list WHERE country_id = '$a'";
		$result = mysql_query($sql);
		$datas = mysql_fetch_array($result);
		$country = $datas['country_name'];
		return $country;
	}
	
	
	//function to get state name
	function state($a, $b){
		$sql = "SELECT * FROM state_list WHERE state_id = '$a' and state_country_id = '$b'";
		$result = mysql_query($sql);
		$datas = mysql_fetch_array($result);
		$state = $datas['state_name'];
		return $state;
	}
	
	//function to get lga name
	function lga($a, $b, $c){
		$sql = "SELECT * FROM lga_list WHERE lga_id = '$a' and lga_state_id = '$b' and lga_country_id = '$c'";
		$result = mysql_query($sql);
		$datas = mysql_fetch_array($result);
		$lga = $datas['lga_name'];
		return $lga;
	}
	
	
	//function to get faculty name
	function faculty($a){
		$sql = "SELECT * FROM faculty_list WHERE faculty_id = '$a'";
		$result = mysql_query($sql);
		$datas = mysql_fetch_array($result);
		$faculty = $datas['faculty_name'];
		return $faculty;
	}
	
	
	//function to get dept name
	function dept($a, $b){
		$sql = "SELECT * FROM dept_list WHERE dept_id = '$a' AND dept_faculty_id = '$b' ";
		$result = mysql_query($sql);
		$datas = mysql_fetch_array($result);
		$dept = $datas['dept_name'];
		return $dept;
	}
	
	function dept2($a){
		$sql = "SELECT * FROM dept_list WHERE dept_id = '$a' ";
		$result = mysql_query($sql);
		$datas = mysql_fetch_array($result);
		$dept = $datas['dept_name'];
		return $dept;
	}
?>