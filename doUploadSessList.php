
<?php 
session_start();
if(isset($_SESSION['uid']) && $_SESSION['ulev'] == 0){
		$cid = $_SESSION['uid'];
	}
	else{
		header("location:login.php");
	}
include "dbconn.php";// Includes the file that connects to the DB
include ('utilities/logging.php'); 
$me = 0;	
$row = 1; $you = 0;
	$tymes = time() + (60 * 60);
	$today = date("Y-m-d", $tymes);
	$times = date("H:i:s", $tymes);
	$startt =  "Start Time: " . $today ." ". $times . "<br />";
$handle = fopen("c:\\users\\CoordinatorRDB\\desktop\\rdbs\\Sessional Course List.csv", "r");
$handle2 = @fopen("c:\\users\\CoordinatorRDB\\desktop\\rdbs\\Duplicate Sessional List $today.csv", "a");
	if(!$handle2){
		echo "Please Close Duplicate Sessional List $today.csv to Continue";
		exit;
	}
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        //echo "<p> $num fields in line $row: <br /></p>\n";
        //$row++;
		/*echo "<tr>";
        for ($c=0; $c < $num; $c++) {
			echo $data[$c] . "<br />";
		}*/
		//echo "</tr>";
			//$update = date("Y-m-d H:i:s");
			$level = addslashes($data[0]); 
			$mode = addslashes($data[1]); 
			$spec = addslashes($data[2]);
			$load = addslashes($data[3]); 
			$sess = addslashes($data[4]); 
			$sem = addslashes($data[5]);
			$cod = addslashes($data[6]); 
			$title = addslashes($data[7]); 
			$fac = addslashes($data[8]); 	
			$dept = addslashes($data[9]);
			$opt = addslashes($data[10]);
			
		$query = "INSERT INTO sess_course_list VALUES('', '$level','$mode', '$spec', '$load', '$sess', '$sem', '$cod', '$title', '$fac', '$dept', '$opt')";
		$result = mysql_query($query);
		if($result){
			$me++;
		}
		else{
			$you++;
			$data[10] = mysql_error();
			fputcsv($handle2,$data);
		}
    }
	fclose($handle2);
    fclose($handle);
	$all = $me + $you;
	$stopp = "Stop Time: ".date("Y-m-d H:i:s", $tymes);
	$act = "Uploaded $me Records into Sessional Course List DB_Table";
	logg($cid, $act);
echo "<div style='text-decoration:underline;color:red;'>Sessional Course List Upload Information</div>Total Number of Courses = $all <br /> Number of Courses Uploaded = $me <br /> Number of Duplicated Courses = $you<br /> $startt $stopp" ;
?>