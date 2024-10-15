<?php

	function logg($id, $act){
		$times = time()+ (60 * 60);
		$tym = date("H:i:s",$times);
		$dat = date("Y-m-d",$times);
		$act = strtoupper(addslashes(trim($act)));
		$sql = "INSERT INTO db_log (log_user_id, log_activity, log_time, log_date, log_log) 
		VALUES ('$id','$act','$tym','$dat','$times')";
		$result = mysql_query($sql);
	}
?>