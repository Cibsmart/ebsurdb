<?php 		
session_start();

if(isset($_SESSION['uid'])){
		$cid = $_SESSION['uid'];
	}
	else{
		$msg = "Forbidden - Not a Valid User";
		header("location:../../login.php?a=".$msg);
	}
	include "f.php";
	include('../../utilities/logging.php');
	
	
	
$file = 'Reconcilaition_Oustanding_Courses.csv';
$memo_detail_array = '';
	//Open the file.
$fileHandle = fopen("2012.SET.csv", "r");
//Loop through the CSV rows.

while (($row = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
    //Print out my column data.
    $reg_no  =  $row[0];
    
	//	$reg_no = trim(strtoupper($_POST['reg_no']));
		$act = "Viewed $reg_no - Outstanding Results/Courses";
		logg($cid,$act);
		$s = "SELECT user_id FROM db_users WHERE staff_id = '$cid'";
		$r = mysql_query($s);
		$rs = mysql_fetch_array($r) or die(mysql_error());
		$log_id = $rs['user_id'];
		


$sees = correct_reg_no($reg_no);
if ($reg_no == "" || !$sees){
	//emma echo "<p align = 'center' style='font-size:18px; font-weight:bolder; color:red'>Please Go Back and Enter Correct Registration Please</p>";
}
else{
	$query = "SELECT std_firstname, std_middlename, std_lastname, std_dept, std_entry_year FROM std_info WHERE std_reg_no = '$reg_no'" //SQL Statement to Generates std name
;	$result = mysql_query($query) // Execution of SQL Statement to Generates std name

;	$datas = mysql_fetch_array($result);  // Getting std name from querry
	
	$std_name =  stripslashes($datas['std_firstname']) . " " . stripslashes($datas['std_middlename']) . " " . stripslashes($datas['std_lastname']);
	

;	

	$std_name1 = $std_name;
	$reg_no1 = $reg_no;
//	$std.dept1 = $datas["std_dept"];

	
	$sn = 1; $num_rows = 0; $fail_code = array();  $fail_sess = array(); $pass_code = array();  $code_list = array(); $sums = false; $cid = false;
	$sql_sess = "SELECT DISTINCT std_result_session FROM std_results WHERE std_result_reg_no = '$reg_no' ORDER BY std_result_session";
	$result_sess = mysql_query($sql_sess) or die(mysql_error());
	$num_rows_sess = mysql_num_rows($result_sess);

	if($num_rows_sess != 0){
		for ($i = 1; $i<=$num_rows_sess; $i++){
			$datas_sess = mysql_fetch_array($result_sess);
			
			$session = $datas_sess['std_result_session'];
			$sql_sem = "SELECT DISTINCT std_result_semester FROM std_results WHERE std_result_reg_no = '$reg_no' AND std_result_session = '$session' ORDER BY std_result_semester";
			$result_sem = mysql_query($sql_sem) or die(mysql_error());
			$num_rows_sem = mysql_num_rows($result_sem);
			if($num_rows_sem != 0){
				for ($j = 1; $j <= $num_rows_sem; $j++){
					$datas_sem = mysql_fetch_array($result_sem);
					$semester = $datas_sem['std_result_semester'];
					outstanding_res($session, $semester, $reg_no);
				}
				
			}
		}
	}
	else{
			//emma	echo "<p align='center' style='font-size:20px; color:red; font-weight:bold'>No Result Entry Found</p>";
	}
}
asort($fail_code);asort($pass_code);

$cibsmart = array_diff_key($fail_code, $pass_code);
if(count($cibsmart) != 0){
	$sums = true;
}
		

?>
<?php if($sums): ?>

<?php endif ?>
<?php	$sn2=1;  ?>
<?php if($sums):?>
       
            
        <?php endif; $sums = false; ?>
<?php
		$don = ""; $cib = "";
		asort($cibsmart);
		foreach($cibsmart as $ifeanyi => $happiness){
			$fail_sess = substr($happiness,0,9);
			$fail_sem =  substr($happiness,9);
		
			if ($don != $fail_sess || $cib != $fail_sem){
				$don = $fail_sess;
				$cib = $fail_sem;
			
				//$failed.session = $fail_sess;
				//$failed.semester = $fail_sem;
			
			}
			print_outstanding($reg_no,$fail_sess, $fail_sem, $ifeanyi);
		
		
		
		}
	
	

	
	
	$cib = unattempted_course($reg_no);
	$ccc = count($cib);
	//var_dump($cib);
	
	
	
	
?>
</table>


<?php if($ccc != 0):?>

<?php
	$sn3=1; $levs = ""; $sems = "";
	foreach($cib as $id){
		$sql_cos = "SELECT * FROM sess_course_list WHERE sess_list_id = '$id'";
		$res_cos = mysql_query($sql_cos);
		$data = mysql_fetch_array($res_cos);
		$cod = $data['sess_list_code'];
		$tit = $data['sess_list_title'];
		$lod = $data['sess_list_c_unit'];
		$lev = $data['sess_list_level'];
		$sem = $data['sess_list_semester'];
		$spec = $data['sess_list_specification'];
		
		
		if(($sem != $sems) || ($lev != $levs)){
			$sems = $sem; $levs = $lev;
		 
		}
		
				
	$memo_detail =  $sn3  . ',' . 'UNATTEMPTED COURSE'  . ',' . $std_name  . ',' . $reg_no . ',' . $datas["std_dept"] . ',' . $lev . ',' . ucfirst(strtolower($sem)) . ',' . $sn3 . ',' . $cod . ',' . $tit . ',' . $lod . ',' . '' . ',' . $spec . "\n" ;
	$memo_detail_array = $memo_detail_array . $memo_detail;	
	file_put_contents($file, $memo_detail, FILE_APPEND | LOCK_EX);
	}

	
?>
   </table>
<?php endif; ?>

<?php 	if(($ccc == 0) && !($cid)): ?>
<?php
	$memo_detail =  ''  . ',' . 'NO OUSTANDING COURSES'  . ',' . $std_name  . ',' . $reg_no . ',' . $datas["std_dept"]  . "\n" ;
	$memo_detail_array = $memo_detail_array . $memo_detail;	
	file_put_contents($file, $memo_detail, FILE_APPEND | LOCK_EX);
	
	
?>

<?php endif; ?>


</body>
</html>

<?php
}
?>