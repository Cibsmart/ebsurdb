<?php include("func.php"); 
	$fac_id = $_POST['faculty'];
	$dep_id = $_POST['dept'];
	$faculty = getfacultyname($fac_id);
	$dept = getdeptname($fac_id, $dep_id);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::(<?php echo $dept ?>) List of Staff ::</title>
<style>
	td{
		font-size:13px;
		font-family:Arial, Helvetica, sans-serif;
		font-weight:700;
	}
</style>
</head>


<body>
<div align="center" style="padding:10px; font:20px 'Times New Roman', Times, serif; font-weight:bolder">
	<?php echo $dept ?> STAFF LIST
</div>
<table border="1" align="center" width="900">
	
<?php
	$sn =1; $qual = "";
	$sql = "SELECT * FROM staff_list WHERE staff_std_faculty = '$fac_id' AND staff_std_dept = '$dep_id' ORDER BY staff_grade";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	if($num != 0){
?>
	<tr>
    	<td width="30">SN</td>
        <td width="50">STAFF ID</td>
        <td width="100">NAME</td>
        <td width="70">DESIGNATION</td>
        <td width="40">QUALIFICATION</td>
        <td width="150">DUTIES</td>
        <td width="150">FACULTY/DEPARTMENT</td>
    </tr>
<?php	
		for($i=0; $i < $num; $i++){
		  $data =  mysql_fetch_array($result);
		  $id = $data['staff_id'];
		  $fname = $data['staff_firstname'];
		  $mname = substr($data['staff_middlename'],0,1);
		  $lname = substr($data['staff_lastname'],0,1); 
		  $desg = ucwords(strtolower($data['staff_designation'])); 
		  $qual1 = $data['staff_qualification1'] . " (" . $data['staff_qual_date1'] .")";
		  $qual2 = $data['staff_qualification2'] . " (" . $data['staff_qual_date2'] . ")";
		  $qual3 = $data['staff_qualification3']  . " (" . $data['staff_qual_date3'] . ")";
		  $qual4 = $data['staff_qualification4']  . " (" . $data['staff_qual_date4'] . ")";
		  $name = ucwords(strtolower($mname .". " .$lname. ". ". $fname));
			if($data['staff_qualification1'] != ""){
				$qual .= $qual1 . ", ";
			}
			if($data['staff_qualification2'] != ""){
				$qual .= $qual2 . ", ";
			}
			if($data['staff_qualification3'] != ""){
				$qual .= $qual3 . ", ";
			}
			if($data['staff_qualification4'] != ""){
				$qual .= $qual4 . ", ";
			}
		  $position = $data['staff_position'];
		  $duties =  ucwords(strtolower($data['staff_duties']));
		  if ($position != ""){
			  $desg .= "/".$position;
		  }
		  //$id = $data['staff_grade'];
		  //$id = $data['staff_step'];
		  //$id = $data['staff_cadre']; 
		  //$id = $data['staff_specialization'];
		  //$id = $data['staff_status'];
		  $faculty = $data['staff_faculty'];
		  $dept = $data['staff_dept'];
		  $facdep = ucwords(strtolower(getfacultyname($faculty)." / ".getdeptname($faculty,$dept)));
		  echo "<tr>
		  		<td align='center'>".$sn++.".</td>
				<td>$id</td>
				<td>$name</td>
				<td>$desg</td>
				<td>$qual</td>
				<td>$duties</td>
				<td>$facdep</td>
				</tr>";
		}
	}
	else{
		echo "<div align='center' style='color:red; font-weight:bolder; padding:10px; font-size:24px; font-family:Times New Roman, Times, serif; font-weight:bolder;  '>
					NO STAFF RECORD FOUND
				</div>";
	}
?>
</table>
</body>
</html>