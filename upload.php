<?php

//$handle ='';
//$handle2 = '';

	
session_start();
if(isset($_SESSION['uid']) && $_SESSION['ulev'] == 0){
		$cid = $_SESSION['uid'];
	}
	else{
		header("location:login.php");
	}
include "dbconn.php";// Includes the file that connects to the DB 
include ('utilities/logging.php'); 


$s = "SELECT user_id, user_username FROM db_users WHERE staff_id = '$cid'";
			$r = mysql_query($s);
			$rs = mysql_fetch_array($r);
			$log_id = $rs['user_id'];
			$user_username = $rs['user_username'];
			
			
			
$me = 0;	
$row = 1; $you = 0;
	$tymes = time() + (60 * 60);
	$today = date("Y-m-d",$tymes);
	$times = date("H:i:s",$tymes);
	$update = date("Y-m-d H:i:s",$tymes);
	$startt =  "Start Time: " . $today ." ". $times . "<br />";


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 95000000) {
                                                            
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {


if ($imageFileType == "csv") {
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
       //emma removed echo "File is not an image.";
        $uploadOk = 0;
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	     echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	} else {
	  echo "Sorry, there was an error uploading your file.";
	}
    }
}
 } else {
	echo "Sorry,the file is not a csv file";
} 



//$handle = fopen("c:\\users\\Administrator\\Desktop\\rdbs\\New Final Result.csv", "r");
//$handle2 = @fopen("c:\\wamp\\www\\ebsurdb2\\uploads\\Duplicate Final Result $today.csv", "a");

$handle = fopen($target_file,"r");
$handle2 = @fopen("c:\\wamp\\www\\ebsurdb2\\uploads\\Duplicate Final Result  $today.csv", "a");
//$handle2 = @fopen( "Duplicate" . $today  . $target_file ,"a");
//emma



	if(!$handle2){
		echo $handle2;
		//echo "Please Close Duplicate Result $today.csv to Continue";
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
$year = addslashes($data[14]);

$month = addslashes($data[15]);

$session_origin = addslashes($data[17]);
$database_co = addslashes($data[18]);
$exams_co = addslashes($data[19]);

$old_regno = addslashes($data[20]);
$transfered = addslashes($data[21]);


$database_co1 = $database_co . '-' . $user_username;

			
		$query = "INSERT INTO std_results_final () VALUES('$sn', '$Namee','$Reg', '$Inc', '$Exam', '$Cr', '$Semester', '$Session', '$Codee', '$Title', '$Dept','$examiner', '$examinerdept', '$datee', '$year','$month','$update','$session_origin','$database_co1','$exams_co','$old_regno','$transfered')";
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
	$act = "Uploaded $me Records into Final Results DB_Table";
	logg($cid, $act);

echo "<div style='text-decoration:underline;color:red;'>Result Upload Information</div>Total Number of Results = $all <br /> Number of Results Uploaded = $me <br /> Number of Duplicated Results = $you<br /> $startt $stopp" ;



}
?> 

<html>
<head> </head>
<body>

    <p align="center">
		<form action="uploadfinalresults.php" method="post" name = "adjTranscripx" >
			<input type="submit" value= "Back" id = "summary"/>
		</form>
   	</p>
	
</body>
</html>