<?php include('../dbconn.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DB Info</title>
</head>

<body>
<?php
	$result = mysql_list_tables("ebsurdb");
	$num = mysql_num_rows($result);
	for ($i = 0; $i < $num; $i++){
		$tbl = mysql_tablename($result, $i);
		echo $tbl . "<br>" ;
	}
	
	for ($i = 0; $i < $num; $i++){
		$tbl = mysql_tablename($result, 13);
		echo $tbl;
		$sql = "SELECT COUNT(*) as h FROM $tbl ";
		$res = mysql_query($sql);
		$usa = mysql_fetch_array($res);
		$num = $usa['h'];
		echo $num . "<br>" ;
	}
	
?>
</body>
</html>