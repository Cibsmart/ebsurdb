<?php
	include("../../dbconn.php");
	
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
?>