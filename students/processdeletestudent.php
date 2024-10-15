<?php
	include ("ajaxes.php");
	include('../utilities/logging.php');

	if ((isset($_POST['reg_no'])) && ($_POST['reg_no'] != "")){
		$reg_no = strtoupper(trim($_POST['reg_no']));
		$correct = check_reg_no2($reg_no);
		$pix_reg_no = str_replace("/",".",$reg_no);
		$pix_reg_no .= ".jpg";
		$pix_src = "passports/" . $pix_reg_no;
	}
	else{
		$cib = "Enter Registration Number Please";
		header("location:deletestudent.php?msg=".$cib);
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::Deleted Student - RDB(<?php echo $log_id; ?>)EBSU ::::</title>
</head>

<body>
<?php
	$sql = "SELECT * FROM course_register WHERE register_reg_no = '$reg_no'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($sql);
	
	if($num == 0){
		$sqls = "DELETE FROM std_info WHERE std_reg_no = '$reg_no'";
		$res = mysql_query($sqls);
		if ($res){
			$cib = $reg_no . "Records' Successfully Removed";
			$h = $_POST['reg_no'];
			$act = "Delected $h Record";
			logg($cid,$act);
			header("location:deletestudent.php?don=".$cib);
			
		}
	}
?>

</body>
</html>