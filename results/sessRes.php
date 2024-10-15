<?php
	include("../dbconn.php");
	if (isset($_GET['a'])){
		$reg_no = $_GET['a'];
		$reg_no = strtoupper($reg_no);
		fillsess($reg_no);
	}
	function fillsess($reg){	
		$sql = "SELECT DISTINCT std_result_session FROM std_results WHERE std_result_reg_no = '$reg' ORDER BY std_result_session DESC";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		//echo "<select >";
		while ($datas = mysql_fetch_array($result)){
			$sess = $datas['std_result_session'];
			echo "<option value = $sess > $sess </option>";
		}
		//echo "</select>";
	}
?>