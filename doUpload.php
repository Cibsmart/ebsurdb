
<?php 	
session_start();
set_time_limit(0);

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
	$today = date("Y-m-d",$tymes);
	$times = date("H:i:s",$tymes);
	$update = date("Y-m-d H:i:s",$tymes);
	$startt =  "Start Time: " . $today ." ". $times . "<br />";
	
	
	
$handle = fopen("c:\\users\\HP\\desktop\\rdbs\\New Result.csv", "r");

$handle2 = @fopen("c:\\users\\HP\\desktop\\rdbs\\Duplicate Result $today.csv", "a");
	if(!$handle2){
		echo "Please Close Duplicate Result $today.csv to Continue";
		exit;
	}
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        //$num = count($data);
        //echo "<p> $num fields in line $row: <br /></p>\n";
        //$row++;
		/*echo "<tr>";
        for ($c=0; $c < $num; $c++) {
			echo $data[$c] . "<br />";
		}*/
		//echo "</tr>";
			
			$sn = addslashes($data[0]); 
			$Namee = addslashes($data[1]); 
			$Reg = addslashes($data[2]);
			$Inc = addslashes($data[3]); 
			$Exam = addslashes($data[4]); 
			$Cr = addslashes($data[5]);
			$Semester = addslashes($data[6]); 
			$Session = addslashes($data[7]); 
			$Codee = addslashes($data[8]); 	
			$Title = addslashes($data[9]);
			$Dept = addslashes($data[10]);  
			$examiner = addslashes($data[11]);
			$examinerdept = addslashes($data[12]); 
			$datee = addslashes($data[13]);
			//$update = addslashes($data[14]);
			
		$query = "INSERT INTO std_results VALUES('$sn', '$Namee','$Reg', '$Inc', '$Exam', '$Cr', '$Semester', '$Session', '$Codee', '$Title', '$Dept','$examiner', '$examinerdept', '$datee', '$update')";
		$result = mysql_query($query);
		if($result){
			$me++;
		}
		else{
			$data[14] = mysql_error();
			$you++;
			fputcsv($handle2,$data);
		}
    }
	fclose($handle2);
    fclose($handle);
	$all = $me + $you;
	$stopp = "Stop Time: ".date("Y-m-d H:i:s",$tymes);
	$act = "Uploaded $me Records into Results DB_Table";
	logg($cid, $act);

echo "<div style='text-decoration:underline;color:red;'>Result Upload Information</div>Total Number of Results = $all <br /> Number of Results Uploaded = $me <br /> Number of Duplicated Results = $you<br /> $startt $stopp" ;
?>