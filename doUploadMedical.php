
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
	$today = date("Y-m-d",$tymes);
	$times = date("H:i:s",$tymes);
	$startt =  "Start Time: " . $today ." ". $times . "<br />";
//$handle = fopen("c:\\users\\CoordinatorRDB\\desktop\\rdbs\\New Medical Result.csv", "r");
//$handle2 = @fopen("c:\\users\\CoordinatorRDB\\desktop\\rdbs\\Duplicate Medical Result $today.csv", "a");


$handle = fopen("c:\\users\\uloma\\desktop\\rdbs\\New Medical Result.csv", "r");
$handle2 = @fopen("c:\\users\\uloma\\desktop\\rdbs\\Duplicate Medical Result $today.csv", "a");

	if(!$handle2){
		echo "Please Close Duplicate Result $today.csv to Continue";
		exit;
	}
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        //echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
		/*echo "<tr>";
        for ($c=0; $c < $num; $c++) {
			echo $data[$c] . "<br />";
		}*/
		//echo "</tr>";
			$update = date("Y-m-d H:i:s");
			$sn = addslashes($data[0]); 
			$Namee = addslashes(strtoupper($data[1])); 
			$Reg = addslashes($data[2]);
			$Score = addslashes($data[3]); 
			$Remark = addslashes(strtoupper($data[4]));
			$Course = addslashes(strtoupper($data[5])); 
			$Level = addslashes(strtoupper($data[6])); 	
			$datee = addslashes($data[7]);
			$Resit = addslashes(strtoupper($data[8]));
			
		$query = "INSERT INTO std_results_medical VALUES('$sn', '$Namee','$Reg', '$Score', '$Remark', '$Course', '$Level', '$datee', '$Resit','$update')";
		$result = mysql_query($query);
		if($result){
			$me++;
		}
		else{
			$you++;
			$data[9] = mysql_error();
			fputcsv($handle2,$data);
		}
    }
	fclose($handle2);
    fclose($handle);
	$all = $me + $you;
	$stopp = "Stop Time: ".date("Y-m-d H:i:s",$tymes);
	$act = "Uploaded $me Records into Medical Results DB_Table";
	logg($cid, $act);

echo "<div style='text-decoration:underline;color:red;'>Result Upload Information</div>Total Number of Results = $all <br /> Number of Results Uploaded = $me <br /> Number of Duplicated Results = $you<br /> $startt $stopp" ;
?>