<?php
	session_start();
	include('../../dbconn.php');
	if(isset($_SESSION['uid'])){
		$cid = $_SESSION['uid'];
		$s = "SELECT user_id FROM db_users WHERE staff_id = '$cid'";
		$r = mysql_query($s);
		$rs = mysql_fetch_array($r) or die(mysql_error());
		$log_id = $rs['user_id'];
	}
	else{
		  $msg = "Forbidden - Not a Valid User";
		  header("location:../../login.php?a=".$msg);
		}
	$update = false;
	
	$mailtitle = mysql_real_escape_string(strtoupper(trim($_POST['title'])));
	$maildate = $_POST['date'];
	$mailremark = mysql_real_escape_string(strtoupper(trim($_POST['remark'])));
	
	date_default_timezone_set('Africa/Lagos');
	$tymes = time() + (60 * 60);
	$updatedate = date("Y-m-d",$tymes);
	$updatetime = date("H:i:s",$tymes);
	$updatedatetime = date("Y-m-d H:i:s",$tymes);
	
	//echo str_replace("world","Peter","Hello world!");
	//$result = $data1 . ' ' . $data2;
	
	$updatedatetime22 = str_replace('-','',$updatedate);
	echo $updatedatetime22; 
	$cocatUpdateDetail = $updatedatetime22 . '_' . $mailtitle . '_' . $maildate . '_' . $mailremark  . '_' . $log_id;
	
		
  if(isset($_POST['modify']) || isset($_POST['delete'])){
	  //Old Values
	  $oldvalues[0] = $sn1 =  $_POST['sn1'];
	  $oldvalues[1] = $nam1 =  $_POST['nam1'];
	  $oldvalues[2] = $reg1 =  $_POST['reg1'];
	  $oldvalues[3] = $inc1 =  $_POST['inc1'];
	  $oldvalues[4] = $exm1 =  $_POST['exm1'];
	  $oldvalues[5] = $lod1 =  $_POST['lod1'];
	  $oldvalues[6] = $sem1 =  $_POST['sem1'];
	  $oldvalues[7] = $ses1 =  $_POST['ses1'];
	  $oldvalues[8] = $cod1 =  $_POST['cod1'];
	  $oldvalues[9] = $til1 =  $_POST['til1'];
	  $oldvalues[10] = $dep1 =  $_POST['dep1'];
	  $exa =  $_POST['exa'];
	  $edp =  $_POST['edp'];
	  $dat =  $_POST['dat'];
  }
  
  if(isset($_POST['modify']) || isset($_POST['add'])){
	  //New Values
	  $newvalues[0] = $sn =  trim($_POST['sn']);
	  $newvalues[1] = $nam =  mysql_real_escape_string(strtoupper(trim($_POST['nam'])));
	  $newvalues[2] = $reg =  strtoupper(trim($_POST['reg']));
	  $newvalues[3] = $inc =  trim($_POST['inc']);
	  $newvalues[4] = $exm =  trim($_POST['exm']);
	  $newvalues[5] = $lod =  trim($_POST['lod']);
	  $newvalues[6] = $sem =  strtoupper(trim($_POST['sem']));
	  $newvalues[7] = $ses =  trim($_POST['ses']);
	  $newvalues[8] = $cod =  mysql_real_escape_string(strtoupper(trim($_POST['cod'])));
	  $newvalues[9] = $til =  mysql_real_escape_string(strtoupper(trim($_POST['til'])));
	  $newvalues[10] = $dep =  mysql_real_escape_string(strtoupper(trim($_POST['dep'])));
	  $exa =  mysql_real_escape_string(strtoupper(trim($_POST['exa'])));
	  $edp =  mysql_real_escape_string(strtoupper(trim($_POST['edp'])));
	  $dat =  mysql_real_escape_string(strtoupper(trim($_POST['dat'])));
  }
  
  if(isset($_POST['modify'])){
	  for($i = 0; $i <= 10; $i++){
		  if($oldvalues[$i] != $newvalues[$i]) $update = true;
	  }
  }
  
  //CODE TO HANDLE RESULT MODIFICATION
  if(!$update && isset($_POST['modify'])){
	  	$outtitle = "SUCCESSFUL: NO VALUE CHANGED";
		$outmsg1 = "<tr><td>OLD</td><td>$sn1</td><td>$nam1</td><td>$reg1</td><td>$inc1</td><td>$exm1</td><td>$lod1</td><td>$sem1</td><td>$ses1</td><td>$cod1</td><td>$til1</td><td>$dep1</td></tr>";
		$outmsg2 = "<tr><td>NEW</td><td>$sn</td><td>$nam</td><td>$reg</td><td>$inc</td><td>$exm</td><td>$lod</td><td>$sem</td><td>$ses</td><td>$cod</td><td>$til</td><td>$dep</td></tr>";
  }
  if($update){
	
	$mailaction = "$sn^$nam^$reg^$inc^$exm^$lod^$sem^$ses^$cod^$til^$dep";
	
	
	$mailquery = "INSERT INTO db_mail 
				VALUES ('', '$mailtitle', '$maildate', 
				'$reg', '$cid','$updatedate', '$updatetime','MODIFIED RESULT','$mailaction', '$mailremark')";
  	mysql_query($mailquery) or die ('Error in Mail Query ' . mysql_error());
	$mailid = mysql_insert_id();
	
	$delquery = "DELETE FROM std_results 
				  WHERE
					  std_result_sn = '$sn1' AND
					  std_result_name = '$nam1' AND
					  std_result_reg_no = '$reg1' AND
					  std_result_inc = '$inc1' AND
					  std_result_exam = '$exm1' AND
					  std_result_c_unit = '$lod1' AND
					  std_result_semester = '$sem1' AND
					  std_result_session = '$ses1' AND
					  std_result_code = '$cod1' AND
					  std_result_title = '$til1' ";
					  //AND
					  //std_result_examiner = '$exa' AND
					  //std_result_examiner_dept = '$edp' AND
					  //std_result_exam_date = '$dat'";
	mysql_query($delquery) or die ('Error in Delete ' . mysql_error());
	  
	 
	
	 
	$newquery = "INSERT INTO std_results 
				  VALUES ('$sn', '$nam', '$reg', 
				  '$inc', '$exm', '$lod', '$sem', '$ses', 
				  '$cod', '$til', '$dep', 
				  '$exa', '$edp', '$dat', '$cocatUpdateDetail')";
	mysql_query($newquery) or die ('Error in New Query ' . mysql_error());
	
	$oldquery = "INSERT INTO std_results_update 
				  VALUES ('$sn1', '$nam1', '$reg1', 
				  '$inc1', '$exm1', '$lod1', '$sem1', '$ses1', 
				  '$cod1', '$til1', '$dep1', 
				  '$exa', '$edp', '$dat', '$mailid', '$updatedatetime')";
	mysql_query($oldquery) or die ('Error in Old Query ' . mysql_error());
	
	$outtitle = "RESULT MODIFIED SUCCESSFULLY";
	$outmsg1 = "<tr><td>OLD</td><td>$sn1</td><td>$nam1</td><td>$reg1</td><td>$inc1</td><td>$exm1</td><td>$lod1</td><td>$sem1</td><td>$ses1</td><td>$cod1</td><td>$til1</td><td>$dep1</td></tr>";
	
	$outmsg2 = "<tr><td>NEW</td><td>$sn</td><td>$nam</td><td>$reg</td><td>$inc</td><td>$exm</td><td>$lod</td><td>$sem</td><td>$ses</td><td>$cod</td><td>$til</td><td>$dep</td></tr>";
  }
  
  //CODE TO HANDLE ADDING OF NEW RESULT
  else if(isset($_POST['add'])){
	  
	$mailaction = "$sn^$nam^$reg^$inc^$exm^$lod^$sem^$ses^$cod^$til^$dep";
	$mailquery = "INSERT INTO db_mail 
				VALUES ('', '$mailtitle', '$maildate', 
				'$reg', '$cid', '$updatedate', '$updatetime','INSERTED RESULT','$mailaction', '$mailremark')";
  	mysql_query($mailquery) or die ('Error in Mail Query ' . mysql_error());
	
	$resquery = "INSERT INTO std_results 
				VALUES ('$sn', '$nam', '$reg', 
				'$inc', '$exm', '$lod', '$sem', '$ses', 
				'$cod', '$til', '$dep', 
				'$exa', '$edp', '$dat', '$cocatUpdateDetail')";
	mysql_query($resquery) or die ('Error in Result Query ' . mysql_error());
	
	$outtitle = "RESULT ADDED SUCCESSFULLY";
	$outmsg1 = "<tr><td></td><td>$sn</td><td>$nam</td><td>$reg</td><td>$inc</td><td>$exm</td><td>$lod</td><td>$sem</td><td>$ses</td><td>$cod</td><td>$til</td><td>$dep</td></tr>";
  }
  
  
  //CODE TO HANDLE DELETING OF EXISTING RESULT
  else if(isset($_POST['delete'])){
	  $mailaction = "$sn1^$nam1^$reg1^$inc1^$exm1^$lod1^$sem1^$ses1^$cod1^$til1^$dep1";
	  $mailquery = "INSERT INTO db_mail 
				  VALUES ('', '$mailtitle', '$maildate', 
				  '$reg1', '$cid','$updatedate', '$updatetime','DELETED RESULT','$mailaction', '$mailremark')";
	  mysql_query($mailquery) or die ('Error in Mail ' . mysql_error());
	  $mailid = mysql_insert_id();
	  
	  $intquery = "INSERT INTO std_results_update 
				  VALUES ('$sn1', '$nam1', '$reg1', 
				  '$inc1', '$exm1', '$lod1', '$sem1', '$ses1', 
				  '$cod1', '$til1', '$dep1', 
				  '$exa', '$edp', '$dat','$mailid', '$updatedatetime')";
	  mysql_query($intquery) or die ('Error in Insert ' . mysql_error());
	  
	  $delquery = "DELETE FROM std_results 
				  WHERE
					  std_result_sn = '$sn1' AND
					  std_result_name = '$nam1' AND
					  std_result_reg_no = '$reg1' AND
					  std_result_inc = '$inc1' AND
					  std_result_exam = '$exm1' AND
					  std_result_c_unit = '$lod1' AND
					  std_result_semester = '$sem1' AND
					  std_result_session = '$ses1' AND
					  std_result_code = '$cod1' AND
					  std_result_title = '$til1'";// AND
					  //std_result_examiner = '$exa' AND
					  //std_result_examiner_dept = '$edp' AND
					  //std_result_exam_date = '$dat'";
	  mysql_query($delquery) or die ('Error in Delete ' . mysql_error());
	  
	  $outtitle = "RESULT DELETED SUCCESSFULLY";
	$outmsg1 = "<tr><td></td><td>$sn1</td><td>$nam1</td><td>$reg1</td><td>$inc1</td><td>$exm1</td><td>$lod1</td><td>$sem1</td><td>$ses1</td><td>$cod1</td><td>$til1</td><td>$dep1</td></tr>";
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Process Manage Result ::</title>

<style>
	.trows{
		font-size:13px;
		font-family:Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", monospace
	}
</style>

</head>
<body>
	<h3><?php echo $outtitle ?> </h3>
    <div>
    	<table class="trows" border="1" cellspacing="0" cellpadding="4">
        	<tr>
            	<td></td><td>SN</td><td>NAME</td><td>REG. NO.</td><td>INC</td><td>EXAM</td><td>CREDIT</td><td>SEMESTER</td><td>SESSION</td><td>COURSE CODE</td><td>COURSE TITLE</td><td>DEPARTMENT</td>
            </tr>
            <?php 
				echo $outmsg1;
				if(isset($outmsg2)) echo $outmsg2;
			?>
        </table>
    </div>
    
    <p align="center">
		<form action="../manage.php" method="post" name = "adjTranscrip" >
			<input type="submit" value= "Back" id = "summary"/>
		</form>
   	</p>
</body>
</html>