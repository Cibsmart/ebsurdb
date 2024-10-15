<?php 
session_start();
	if(isset($_SESSION['uid']) && $_SESSION['ulev'] ==  0){
		$cid = $_SESSION['uid'];
	}
	else{	
			$act = "Forbidden - Not a Valid User";
			header("location:../login.php?a=".$act);
	}
	
include("func.php"); 
include('../utilities/logging.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Updated</title>
<style>
	td{
		font-size:12px;
		font-family:arial;
	}
</style>
<p align="left"><a href="#" onclick="javascript:window.print()"><font size="1">
PRINT</font></a>
<font size="1">
<a href="#" onclick="javascript:window.close()"><font color="#800000">CLOSE</font></a></font>
<br></p>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<?php 	
	$reglist = array();
	$fac_id = $_POST['faculty'];
	$dep_id = $_POST['dept'];
	$set = $_POST['set'];
	$dep = getdeptname($fac_id, $dep_id);
	$ssl = "SELECT std_reg_no FROM std_info WHERE std_dept = '$dep' ORDER BY std_reg_no";
	

	
	$res = mysql_query($ssl) or die(mysql_error());
	$num_reg = mysql_num_rows($res); $rlist = 0;
	
	for($j=0; $j<$num_reg; $j++){
		$r_reg = mysql_fetch_array($res);
		$regg = trim($r_reg['std_reg_no']);
		$regs = substr(trim($regg),5,4);
		if ($regs == $set)
			{
				$reglist[$rlist++] = $regg;
			}
	}
	

	
	if (isset($reglist)){
		$std_all = count($reglist);
	}
	else{
		$std_all = 0;
	}
	
?>
<body>
<p align="center">
    <table width = '520' border = '0' cellspacing = '0' align = 'center'>
    <td><img src="../images/ich logo.jpg" width = 100 height = 110/></td><td align="center">
        <span style="font-family:'Arial Black', Gadget, sans-serif; font:bolder; font-size:15px; ">
         <?php //echo "DEPARTMENT OF " . $dep ?>
         </span><br>
         <span style="font-family:'Arial Black', Gadget, sans-serif; font:bold; font-size:14px;">EBONYI STATE UNIVERSITY<br>
        P.M.B 053 ABAKALIKI EBONYI STATE</span>
		<?php //echo "<div style='text-align:center; font-size:12px; font-weight:bold; font-family:arial black'>". $sess." ".  $level . " LEVEL RESULT SUMMARY </div>"; ?>
    </td><td>
    </td>
    </table>
</p>
<?php
	$update = date("r"); $cnt = 0;

	
	
	for($z=0;$z < $std_all; $z++){
		$reg_no = $reglist[$z]; $status = "ACTIVE"; $level = 100;
		
	
		
		
		$sql_sess = "SELECT DISTINCT std_result_session FROM std_results WHERE std_result_reg_no = '$reg_no' ORDER BY std_result_session";
		$act_sess = mysql_query($sql_sess);
		$num_sess = mysql_num_rows($act_sess);
		

		
		if ($num_sess !== 0){			
			for ($cnt_sess=0; $cnt_sess < $num_sess; $cnt_sess++)	{
				$row_sess = mysql_fetch_array($act_sess);
				$sess = trim($row_sess["std_result_session"]);
				//$cid = $num_sess - ($cnt_sess + 1);
				//if(($cid == 0) && ($num_sess >= 4)){
				//	$status = "GRADUATED";
				//}
				if($cnt_sess == 0){
					$level = 100;
				}
				elseif($cnt_sess == 1){
					$level = 200;
				}
				elseif($cnt_sess == 2){
					$level = 300;
				}
				elseif($cnt_sess == 3){
					$level = 400;
				}
				else{
					$level = 500;
				}
				$sql_lev = "INSERT INTO std_status (status_regno, status_session, status_level, status_faculty, status_dept, status_status, status_remark) VALUES('$reg_no','$sess','$level','$fac_id','$dep_id','$status','$update')";
				$result = mysql_query($sql_lev);// or die(mysql_error());
			}
		}$cnt++;
	}
	

	
?>
<?php if($result):?>
	<div align="center" style="background:#6F6; padding:5px; font-size:20px; font-weight:bolder; font-family:'Arial Rounded MT Bold', Arial"><?php echo $cnt ?> Status in <?php echo $dep ?> Sucessfully Updated (<?php echo $set ?> Set)</div>
<?php $act = "Updated $cnt Student's Level for $dep - $set Set";
	logg($cid,$act);
?>
<?php else:?>
	<div align="center" style="background:#6F6; padding:5px; font-size:20px; font-weight:bolder; font-family:'Arial Rounded MT Bold', Arial"><?php echo $dep ?> &nbsp;Status Not Updated</div>
<?php endif ?>

</body>
</html>