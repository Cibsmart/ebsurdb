
<?php
include "../../dbconn.php"; // Includes the file that connects to the DB

function std_res($session, $semester, $reg_no, $result_type = ""){
		global $sn; $sum1 = 0; $sum2 =0; global $session_sum1; global $session_sum2; $gpa =0; $no = substr($reg_no,5,4);

		$sql = "SELECT * FROM std_results WHERE std_result_reg_no = '$reg_no' AND std_result_session = '$session' AND std_result_semester = '$semester' ORDER BY std_result_code";
		$result = mysql_query($sql) or die(mysql_error());
		$num_results =  mysql_num_rows($result);
		if ($num_results != 0){
			/*echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td><span style='font-size:14px; font-weight:bolder'>".$session. " " .$semester. " ". "SEMESTER" ."</span></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";*/
			echo "<tr><td colspan = 8><span style='font-size:14px; font-weight:bolder'>".$session. " " .$semester. " ". "SEMESTER" ."</span></td></tr>";
			for ($cnt_results = 0; $cnt_results < $num_results; $cnt_results++){
				$result_row = mysql_fetch_array($result);
				$inc_course = $result_row['std_result_inc'];
				$exam_score = $result_row['std_result_exam'];
				$course_code = $result_row['std_result_code'];
				$course_title = $result_row['std_result_title'];
				$credit_unit = $result_row['std_result_c_unit'];
				$std_result_update_info = $result_row['std_result_update_info'];
				$std_result_name = $result_row['std_result_name'];
				
				//emma
				
				//echo $result_row['std_result_exam'] . "-";
				
				if ($exam_score <> "ABS") {
					$total_score = $inc_course + $exam_score;
				}
				else {
					$total_score = $inc_course . "+ ABS";
					//$credit_unit = 0;
				}
				///
				

				
				if($no >= 2011){
					if($total_score >= 70 && $total_score <= 100){
						$l_grade = "A";$grade_point = 5;
					}
					elseif($total_score >=60 && $total_score < 70){
						$l_grade = "B"; $grade_point = 4;
					}
					elseif($total_score >=50 && $total_score < 60){
						$l_grade = "C"; $grade_point = 3;
					}
					elseif($total_score >=45 && $total_score < 50){
						$l_grade = "D"; $grade_point = 2;
					}
					else{
						$l_grade = "F"; $grade_point = 0;
					}
				}
				if($no < 2011){
					if($total_score >= 70 && $total_score <= 100){
						$l_grade = "A";$grade_point = 5;
					}
					elseif($total_score >=60 && $total_score < 70){
						$l_grade = "B"; $grade_point = 4;
					}
					elseif($total_score >=50 && $total_score < 60){
						$l_grade = "C"; $grade_point = 3;
					}
					elseif($total_score >=45 && $total_score < 50){
						$l_grade = "D"; $grade_point = 2;
					}
					elseif($total_score >=40 && $total_score < 45){
						$l_grade = "E"; $grade_point = 1;
					}
					else{
						$l_grade = "F"; $grade_point = 0;
					}
				}
				$grade_point = $grade_point * $credit_unit;
				$sum2 = $grade_point + $sum2; 
				$sum1 = $credit_unit + $sum1;
				if ($sum1 != 0){
					$gpa =	$sum2 / $sum1;
				}
				else{
					$gpa = 0;
				}
				$gpa = round($gpa, 3);
				if ($result_type == "sessional"){
					$session_sum1 += $credit_unit;
					$session_sum2 += $grade_point;
				}
				if ($l_grade == "F")
				{
					echo "<tr> <td>" . $sn . "</td> <td>" ;
					echo $std_result_name . "</td> <td>" . $course_code;
					echo "</td> <td align = 'left'>" ;
					echo $course_title . "</td> <td align = 'center'>" ;
					echo $credit_unit . "</td> <td align = 'center'> " ;
					echo $total_score . "</td> <td  align = 'center'> <font color='#FF0000'>" ;
					
					echo $l_grade . "</td> <td  align = 'center'>" ;
					echo "" . "</td> <td  align = 'left'>" ;
					//echo $std_result_update_info ."</td> <td>&nbsp;</td></tr>" ;
					
					echo $std_result_update_info ."</td> </tr>" ;	
				}
				else
				{
					echo "<tr> <td>" . $sn . "</td> <td>" ;
					echo $std_result_name . "</td> <td>" . $course_code;
					echo "</td> <td align = 'left'>" ;
					echo $course_title . "</td> <td align = 'center'>" ;
					echo $credit_unit . "</td> <td align = 'center'> " ;
					echo $total_score . "</td> <td  align = 'center'>" ;
					
					echo $l_grade . "</td> <td  align = 'center'>" ;
					echo "" . "</td> <td  align = 'left'>" ;
					//echo $std_result_update_info ."</td> <td>&nbsp;</td></tr>" ;
					
					echo $std_result_update_info ."</td> </tr>" ;
				}
				$sn += 1;
			}
	
				//echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
				//echo "<td align = 'center'>". $sum1."</td><td>&nbsp;</td>";
				//echo "<td>&nbsp;</td><td align = 'center'>". $sum2;
				//echo "<td align = 'center' width='70'> GPA = ". $gpa ;
		}
		else{
			echo "<p align='center' style='font-size:20px; color:red; font-weight:bold'>No Result Entry Found</p>"	;
		}
}

function std_res_comp($session, $semester, $reg_no, $result_type = ""){
		$sums1 = 0; $sums2 =0; global $session_sums1; global $session_sums2; $gpa =0; $no = substr($reg_no,5,4);

		$sql = "SELECT * FROM std_results WHERE std_result_reg_no = '$reg_no' AND std_result_session = '$session' AND std_result_semester = '$semester' ORDER BY std_result_code";
		$result = mysql_query($sql) or die(mysql_error());
		$num_results =  mysql_num_rows($result);
		if ($num_results != 0){
			for ($cnt_results = 0; $cnt_results < $num_results; $cnt_results++){
				$result_row = mysql_fetch_array($result);
				$inc_course = $result_row['std_result_inc'];
				$exam_score = $result_row['std_result_exam'];
				$course_code = $result_row['std_result_code'];
				$course_title = $result_row['std_result_title'];
				$credit_unit = $result_row['std_result_c_unit'];
				$total_score = $inc_course + $exam_score;
				
				if($no >= 2011){
					if($total_score >= 70 && $total_score <= 100){
						$l_grade = "A";$grade_point = 5;
					}
					elseif($total_score >=60 && $total_score < 70){
						$l_grade = "B"; $grade_point = 4;
					}
					elseif($total_score >=50 && $total_score < 60){
						$l_grade = "C"; $grade_point = 3;
					}
					elseif($total_score >=45 && $total_score < 50){
						$l_grade = "D"; $grade_point = 2;
					}
					else{
						$l_grade = "F"; $grade_point = 0;
					}
				}
				if($no < 2011){
					if($total_score >= 70 && $total_score <= 100){
						$l_grade = "A";$grade_point = 5;
					}
					elseif($total_score >=60 && $total_score < 70){
						$l_grade = "B"; $grade_point = 4;
					}
					elseif($total_score >=50 && $total_score < 60){
						$l_grade = "C"; $grade_point = 3;
					}
					elseif($total_score >=45 && $total_score < 50){
						$l_grade = "D"; $grade_point = 2;
					}
					elseif($total_score >=40 && $total_score < 45){
						$l_grade = "E"; $grade_point = 1;
					}
					else{
						$l_grade = "F"; $grade_point = 0;
					}
				}
				$grade_point = $grade_point * $credit_unit;
				$sums2 = $grade_point + $sums2; 
				$sums1 = $credit_unit + $sums1;
				if ($sums1 != 0){
					$gpa =	$sums2 / $sums1;
				}
				else{
					$gpa = 0;
				}
				$gpa = round($gpa, 3);
				if ($result_type == "sessional"){
					$session_sums1 += $credit_unit;
					$session_sums2 += $grade_point;
				}
			}
		}
	
}

function std_ress($session, $semester, $reg_no, $result_type = ""){
		$sn = 1; $sum1 = 0; $sum2 =0; global $session_sum1; global $session_sum2; $gpa =0; 
		$no = substr($reg_no,5,4);

		$sql = "SELECT * FROM std_results WHERE std_result_reg_no = '$reg_no' AND std_result_session = '$session' AND std_result_semester = '$semester' ORDER BY std_result_code";
		$result = mysql_query($sql) or die(mysql_error());
		$num_results =  mysql_num_rows($result);
		if ($num_results != 0){
			/*echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td><span style='font-size:14px; font-weight:bolder'>".$session. " " .$semester. " ". "SEMESTER" ."</span></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";*/
			//echo "<tr><td colspan = 8><span style='font-size:14px; font-weight:bolder'>".$session. " " .$semester. " ". "SEMESTER" ."</span></td></tr>";
			for ($cnt_results = 0; $cnt_results < $num_results; $cnt_results++){
				$result_row = mysql_fetch_array($result);
				$inc_course = $result_row['std_result_inc'];
				$exam_score = $result_row['std_result_exam'];
				$course_code = $result_row['std_result_code'];
				$course_title = $result_row['std_result_title'];
				$credit_unit = $result_row['std_result_c_unit'];
				$total_score = $inc_course + $exam_score;
				
				if($no >= 2011){
					if($total_score >= 70 && $total_score <= 100){
						$l_grade = "A";$grade_point = 5;
					}
					elseif($total_score >=60 && $total_score < 70){
						$l_grade = "B"; $grade_point = 4;
					}
					elseif($total_score >=50 && $total_score < 60){
						$l_grade = "C"; $grade_point = 3;
					}
					elseif($total_score >=45 && $total_score < 50){
						$l_grade = "D"; $grade_point = 2;
					}
					else{
						$l_grade = "F"; $grade_point = 0;
					}
				}
				if($no < 2011){
					if($total_score >= 70 && $total_score <= 100){
						$l_grade = "A";$grade_point = 5;
					}
					elseif($total_score >=60 && $total_score < 70){
						$l_grade = "B"; $grade_point = 4;
					}
					elseif($total_score >=50 && $total_score < 60){
						$l_grade = "C"; $grade_point = 3;
					}
					elseif($total_score >=45 && $total_score < 50){
						$l_grade = "D"; $grade_point = 2;
					}
					elseif($total_score >=40 && $total_score < 45){
						$l_grade = "E"; $grade_point = 1;
					}
					else{
						$l_grade = "F"; $grade_point = 0;
					}
				}
				$grade_point = $grade_point * $credit_unit;
				$sum2 = $grade_point + $sum2; 
				$sum1 = $credit_unit + $sum1;
				if ($sum1 != 0){
					$gpa =	$sum2 / $sum1;
				}
				else{
					$gpa = 0;
				}
				$gpa = round($gpa, 3);
				if ($result_type == "sessional"){
					$session_sum1 += $credit_unit;
					$session_sum2 += $grade_point;
				}
				if ($l_grade == "F")
				{
					echo "<tr> <td>" . $sn . "</td> <td>" ;
					echo $course_code . "</td> <td>" . $course_title;
					echo "</td> <td>" ;
					echo $credit_unit . "</td> <td>" ;
					echo $total_score . "</td> <td> <font color='#FF0000'>" ;
					echo $l_grade . "</td> <td>" ;
					echo $grade_point ."</td> </tr>" ;				
				}
				else
				{
					echo "<tr> <td>" . $sn . "</td> <td>" ;
					echo $course_code . "</td> <td>" . $course_title ;
					echo "</td> <td>" ;
					echo $credit_unit . "</td> <td>" ;
					echo $total_score . "</td> <td>" ;
					echo $l_grade . "</td> <td>" ;
					echo $grade_point ."</td> </tr>" ;
				}
				$sn += 1;
			}
	
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
				echo "<td align = 'center'></td><td>&nbsp;</td>";
				echo "<td>&nbsp;</td>";
				//echo "<td align = 'left' > GPA: ";
				//printf("%1.2f",$gpa) ;
				echo "</td>";
		}
}

	
function std_res_final($session, $semester, $reg_no, $result_type = ""){
		global $sn; $sum1 = 0; $sum2 =0; global $session_sum1; global $session_sum2; $gpa =0; $no = substr($reg_no,5,4);

		$sql = "SELECT * FROM std_results_final WHERE std_result_reg_no = '$reg_no' AND std_result_session = '$session' AND std_result_semester = '$semester' ORDER BY std_result_code";
		$result = mysql_query($sql) or die(mysql_error());
		$num_results =  mysql_num_rows($result);
		if ($num_results != 0){
			/*echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td><span style='font-size:14px; font-weight:bolder'>".$session. " " .$semester. " ". "SEMESTER" ."</span></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";*/
			echo "<tr><td colspan = 8><span style='font-size:14px; font-weight:bolder'>".$session. " " .$semester. " ". "SEMESTER" ."</span></td></tr>";
			for ($cnt_results = 0; $cnt_results < $num_results; $cnt_results++){
				$result_row = mysql_fetch_array($result);
				$inc_course = $result_row['std_result_inc'];
				$exam_score = $result_row['std_result_exam'];
				$course_code = $result_row['std_result_code'];
				$course_title = $result_row['std_result_title'];
				$credit_unit = $result_row['std_result_c_unit'];
				$total_score = $inc_course + $exam_score;
				
				if($no >= 2011){
					if($total_score >= 70 && $total_score <= 100){
						$l_grade = "A";$grade_point = 5;
					}
					elseif($total_score >=60 && $total_score < 70){
						$l_grade = "B"; $grade_point = 4;
					}
					elseif($total_score >=50 && $total_score < 60){
						$l_grade = "C"; $grade_point = 3;
					}
					elseif($total_score >=45 && $total_score < 50){
						$l_grade = "D"; $grade_point = 2;
					}
					else{
						$l_grade = "F"; $grade_point = 0;
					}
				}
				if($no < 2011){
					if($total_score >= 70 && $total_score <= 100){
						$l_grade = "A";$grade_point = 5;
					}
					elseif($total_score >=60 && $total_score < 70){
						$l_grade = "B"; $grade_point = 4;
					}
					elseif($total_score >=50 && $total_score < 60){
						$l_grade = "C"; $grade_point = 3;
					}
					elseif($total_score >=45 && $total_score < 50){
						$l_grade = "D"; $grade_point = 2;
					}
					elseif($total_score >=40 && $total_score < 45){
						$l_grade = "E"; $grade_point = 1;
					}
					else{
						$l_grade = "F"; $grade_point = 0;
					}
				}
				$grade_point = $grade_point * $credit_unit;
				$sum2 = $grade_point + $sum2; 
				$sum1 = $credit_unit + $sum1;
				if ($sum1 != 0){
					$gpa =	$sum2 / $sum1;
				}
				else{
					$gpa = 0;
				}
				$gpa = round($gpa, 3);
				if ($result_type == "sessional"){
					$session_sum1 += $credit_unit;
					$session_sum2 += $grade_point;
				}
				if ($l_grade == "F")
				{
					echo "<tr> <td>" . $sn . "</td> <td>" ;
					echo $course_code . "</td> <td>" . $course_title;
					echo "</td> <td align = 'center'>" ;
					echo $credit_unit . "</td> <td align = 'center'>" ;
					echo $total_score . "</td> <td align = 'center'> <font color='#FF0000'>" ;
					echo $l_grade . "</td> <td  align = 'center'>" ;
					echo $grade_point ."</td> <td>&nbsp;</td></tr>" ;				
				}
				else
				{
					echo "<tr> <td>" . $sn . "</td> <td>" ;
					echo $course_code . "</td> <td>" . $course_title ;
					echo "</td> <td align = 'center'>" ;
					echo $credit_unit . "</td> <td align = 'center'>" ;
					echo $total_score . "</td> <td align = 'center'>" ;
					echo $l_grade . "</td> <td  align = 'center'>" ;
					echo $grade_point ."</td> <td>&nbsp;</td></tr>" ;
				}
				$sn += 1;
			}
	
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
				echo "<td align = 'center'>". $sum1."</td><td>&nbsp;</td>";
				echo "<td>&nbsp;</td><td align = 'center'>". $sum2;
				echo "<td align = 'center' width='70'> GPA = ". $gpa ;
		}
		else{
			echo "<p align='center' style='font-size:20px; color:red; font-weight:bold'>No Result Entry Found</p>"	;
		}
	}


function std_res_official($session, $semester, $reg_no, $result_type = ""){
		$sn = 1; $sum1 = 0; $sum2 =0; 
		global $session_sum1, $fcgpa, $me; 
		global $session_sum2, $year, $num_rows_sess; 
		$gpa =0; $no = substr($reg_no,5,4);
		$years = array(1=>"ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX", "SEVEN", "EIGHT", "NINE", "TEN");
		$sql = "SELECT * FROM std_results WHERE std_result_reg_no = '$reg_no' AND std_result_session = '$session' AND std_result_semester = '$semester' ORDER BY std_result_code";
		$result = mysql_query($sql) or die(mysql_error());
		$num_results =  mysql_num_rows($result);
		if ($num_results != 0){
			/*echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td><span style='font-size:14px; font-weight:bolder'>".$session. " " .$semester. " ". "SEMESTER" ."</span></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";*/
			for ($cnt_results = 0; $cnt_results < $num_results; $cnt_results++){
				$result_row = mysql_fetch_array($result);
				$inc_course = $result_row['std_result_inc'];
				$exam_score = $result_row['std_result_exam'];
				$course_code = $result_row['std_result_code'];
				$course_title = $result_row['std_result_title'];
				$credit_unit = $result_row['std_result_c_unit'];
				$total_score = $inc_course + $exam_score;
				
				if($no >= 2011){
					if($total_score >= 70 && $total_score <= 100){
						$l_grade = "A";$grade_point = 5;
					}
					elseif($total_score >=60 && $total_score < 70){
						$l_grade = "B"; $grade_point = 4;
					}
					elseif($total_score >=50 && $total_score < 60){
						$l_grade = "C"; $grade_point = 3;
					}
					elseif($total_score >=45 && $total_score < 50){
						$l_grade = "D"; $grade_point = 2;
					}
					else{
						$l_grade = "F"; $grade_point = 0;
					}
				}
				if($no < 2011){
					if($total_score >= 70 && $total_score <= 100){
						$l_grade = "A";$grade_point = 5;
					}
					elseif($total_score >=60 && $total_score < 70){
						$l_grade = "B"; $grade_point = 4;
					}
					elseif($total_score >=50 && $total_score < 60){
						$l_grade = "C"; $grade_point = 3;
					}
					elseif($total_score >=45 && $total_score < 50){
						$l_grade = "D"; $grade_point = 2;
					}
					elseif($total_score >=40 && $total_score < 45){
						$l_grade = "E"; $grade_point = 1;
					}
					else{
						$l_grade = "F"; $grade_point = 0;
					}
				}
				$grade_point = $grade_point * $credit_unit;
				$sum2 = $grade_point + $sum2; 
				$sum1 = $credit_unit + $sum1;
				if ($sum1 != 0){
					$gpa =	$sum2 / $sum1;
				}
				else{
					$gpa = 0;
				}
				$gpa = round($gpa, 3);
				if ($result_type == "sessional"){
					$session_sum1 += $credit_unit;
					$session_sum2 += $grade_point;
				}
				if ($l_grade == "F")
				{
					echo "<tr> <td>";
					if($sn == 1){ echo $years[$year]; };
					echo "</td><td>";
					echo "<tr> <td>" . $sn . "</td><td>";
					if($sn == 1){ echo $semester; };
					echo "</td><td>";
					echo $course_code . "</td> <td>" . $course_title;
					echo "</td> <td align = 'center'>" ;
					echo $credit_unit . "</td> <td align = 'center'>" ;
					echo $total_score . "</td> <td align = 'center'> <font color='#FF0000'>" ;
					echo $l_grade . "</td> <td  align = 'center'>" ;
					echo $grade_point ."</td> <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>" ;				
				}
				else
				{
					echo "<tr> <td>";
					if($sn == 1){ echo $years[$year]; };
					echo "</td><td>";
					if($sn == 1){ echo $semester; };
					echo "</td><td>";
					echo $course_code . "</td> <td>" . $course_title ;
					echo "</td> <td align = 'center'>" ;
					echo $credit_unit . "</td> <td align = 'center'>" ;
					echo $total_score . "</td> <td align = 'center'>" ;
					echo $l_grade . "</td> <td  align = 'center'>" ;
					echo $grade_point ."</td> <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>" ;
				}
				$sn += 1;
			}
	
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
				echo "<td align = 'center'>====</td><td>&nbsp;</td><td>&nbsp;</td><td align = 'center'>====";
				echo "<td align = 'center'></td><td align = 'center'></td><td align = 'center'></td></tr>";
				
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
				echo "<td align = 'center'><b>". $sum1."</b></td><td>&nbsp;</td>";
				echo "<td>&nbsp;</td><td align = 'center'><b>". $sum2;
				echo "</b><td align = 'center'><b>". $gpa ."</b></td>";
				$cgpa = round(($session_sum2/$session_sum1),3);
				echo "<td align = 'center'><b>";
				//if ($semester == "SECOND"){ echo $cgpa; }
				if ($semester == "SECOND"){ ; }
				else{echo "-----";}
				echo "</td></b>";
				
				echo "<td align = 'center'><b>";
				$fcgpa[] = $cgpa;
				if ($year == $num_rows_sess && $semester == 'SECOND'){ 
				 
				  $num_of_sessions = count($fcgpa);
				  $sum_of_cgpa = array_sum($fcgpa);
				  $fcgpas = round(($sum_of_cgpa/$num_of_sessions),2);
				 //echo $fcgpas; 
				 $me = true;
				}else{echo "-----";}
				echo "</b></td></tr>";
				
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
				echo "<td align = 'center'></td><td>&nbsp;</td><td>&nbsp;</td><td align = 'center'>";
				echo "<td align = 'center'></td><td align = 'center'></td><td align = 'center'></td></tr>";
				
		}
		else{
			echo "<p align='center' style='font-size:20px; color:red; font-weight:bold'>No Result Entry Found</p>"	;
		}
}


//function to check for outstanding courses
function outstanding_res($session, $semester, $reg_no){
		$no = substr($reg_no,5,4);
		global $sn; global $fail_code; global $pass_code; global $anyi;
		$sql = "SELECT * FROM std_results WHERE std_result_reg_no = '$reg_no' AND std_result_session = '$session' AND std_result_semester = '$semester' ORDER BY std_result_code";
		$result = mysql_query($sql) or die(mysql_error());
		$num_results =  mysql_num_rows($result);
		if ($num_results != 0){
			for ($cnt_results = 0; $cnt_results < $num_results; $cnt_results++){
				$total_score = 0;
				$result_row = mysql_fetch_array($result);
				$inc_course = $result_row['std_result_inc'];
				$exam_score = $result_row['std_result_exam'];
				$course_code = trim($result_row['std_result_code']);
				//$course_title = $result_row['std_result_title'];
				//$credit_unit = $result_row['std_result_c_unit'];
				$total_score = $inc_course + $exam_score;
				
					if ($no >= 2011){
						if($total_score >= 45 && $total_score <= 100)
						{$grade = 1;}
						else
						{$grade = 0;}
					}
					else{
						if($total_score >= 40 && $total_score <= 100)
						{ $grade = 1;}
						else
						{$grade = 0;}
					}
					
					if ($grade == 0){
						
						$sql_c = "SELECT code2 FROM code_change_log WHERE code1 = '$course_code'";
						$res_c = mysql_query($sql_c);
						$num_c = mysql_num_rows($res_c);
						if ($num_c != 0){
						  $data = mysql_fetch_array($res_c);
						  $course_code2 = $data['code2'];
						  
						  if ($no >= 2011){
						  	$sql_c2 = "SELECT * FROM std_results WHERE std_result_code LIKE '$course_code2%' AND (std_result_inc + std_result_exam) >= 40 AND std_result_reg_no = '$reg_no'";
							$res_c2 = mysql_query($sql_c2);
							$num_c2 = mysql_num_rows($res_c2);
							if($num_c2 == 0){
							  if (array_key_exists($course_code,$fail_code)){
								  $fail_code[$course_code] = $session.$semester;
							  }
							  else{
								  $fail_code[$course_code] = $session.$semester;
								  $anyi = 200;
							  }
							}
						  }
						  else{
							$sql_c2 = "SELECT * FROM std_results WHERE std_result_code LIKE '$course_code2%' AND (std_result_inc + std_result_exam) >= 45 AND std_result_reg_no = '$reg_no'";
							$res_c2 = mysql_query($sql_c2);
							$num_c2 = mysql_num_rows($res_c2);
							if($num_c2 == 0){							  
							  if (array_key_exists($course_code,$fail_code)){
								  $fail_code[$course_code] = $session.$semester;
							  }
							  else{
								  $fail_code[$course_code] = $session.$semester;
								  $anyi = 200;
							  }
							}
						  } 
						}
						else{
						  if (array_key_exists($course_code,$fail_code)){
							  $fail_code[$course_code] = $session.$semester;
						  }
						  else{
							  $fail_code[$course_code] = $session.$semester;
							  $anyi = 200;
						  }	
						}
					}
					if ($grade == 1){
						$pass_code[$course_code] = $session.$semester;
					}
			}
	
		}
		else{
			echo "<p align='center' style='font-size:20px; color:red; font-weight:bold'>No Result Entry Found</p>"	;
		}
}


//function to check for unattempted courses
function unattempted_course($reg_no){
		global $sn; global $code_list; $code_nattempted = array();
		$reg_no = trim($reg_no); $no = substr($reg_no,5,4);

		$sql_cos = "SELECT * FROM std_status WHERE status_regno = '$reg_no' ORDER BY status_session";
		$result_cos = mysql_query($sql_cos) or die(mysql_error());
		$num_cos =  mysql_num_rows($result_cos);
		if($num_cos != 0){
		  for($i=0; $i<$num_cos; $i++){
			$data = mysql_fetch_array($result_cos);
			$session = $data['status_session'];
			$level = $data['status_level'];
			$faculty = $data['status_faculty'];
			$dept = $data['status_dept'];
			
			$sql = "SELECT * FROM sess_course_list WHERE sess_list_session = '$session' AND sess_list_level = $level AND sess_list_faculty = '$faculty' AND sess_list_dept = '$dept' AND sess_list_semester = 'FIRST' ORDER BY sess_list_session, sess_list_code";
			
			$result = mysql_query($sql) or die(mysql_error());
			$num_courses =  mysql_num_rows($result);
			if ($num_courses != 0){
			  for ($cnt_results = 0; $cnt_results < $num_courses; $cnt_results++){
				  
				$result_row = mysql_fetch_array($result);
				$course_id = $result_row['sess_list_id'];
				$course_code1 = trim($result_row['sess_list_code']);
				
				$sql_f = "SELECT code2 FROM code_change_log WHERE code1 = '$course_code1'";
				$res_f = mysql_query($sql_f);
				$num_f = mysql_num_rows($res_f);
				if ($num_f != 0){
				  $data = mysql_fetch_array($res_f);
				  $course_code11 = $data['code2'];
				  
				  $sql_res = "SELECT std_result_code FROM std_results WHERE std_result_reg_no = '$reg_no' AND std_result_code LIKE '$course_code1%' AND std_result_semester = 'FIRST'";
				  $result_res = mysql_query($sql_res) or die(mysql_error());
				  $num_res = mysql_num_rows($result_res);
				  
				  $sql_res1 = "SELECT std_result_code FROM std_results WHERE std_result_reg_no = '$reg_no' AND std_result_code LIKE '$course_code11%' AND std_result_semester = 'FIRST'";
				  $result_res1 = mysql_query($sql_res1) or die(mysql_error());
				  $num_res1 = mysql_num_rows($result_res1);
				  
				  if($num_res == 0 && $num_res1 == 0){ 
					$code_nattempted[$course_id] = $course_id;
				  }
					
				}
				else{
				$sql_res = "SELECT std_result_code FROM std_results WHERE std_result_reg_no = '$reg_no' AND std_result_code = '$course_code1' AND std_result_semester = 'FIRST'";
				$result_res = mysql_query($sql_res) or die(mysql_error());
				$num_res = mysql_num_rows($result_res);
					if($num_res == 0){ 
					  $code_nattempted[$course_id] = $course_id;
					}
				}
			  }
			}
			
			
			
			$sql2 = "SELECT * FROM sess_course_list WHERE sess_list_session = '$session' AND sess_list_level = $level AND sess_list_faculty = '$faculty' AND sess_list_dept = '$dept' AND sess_list_semester = 'SECOND' ORDER BY sess_list_session, sess_list_code";
			
			$result2 = mysql_query($sql2) or die(mysql_error());
			$num_courses2 =  mysql_num_rows($result2);
			if ($num_courses2 != 0){
			  for ($cnt_results2 = 0; $cnt_results2 < $num_courses2; $cnt_results2++){
				  
				$result_row2 = mysql_fetch_array($result2);
				$course_id2 = $result_row2['sess_list_id'];
				$course_code2 = trim($result_row2['sess_list_code']);
				
				$sql_s = "SELECT code2 FROM code_change_log WHERE code1 = '$course_code2'";
				$res_s = mysql_query($sql_s);
				$num_s = mysql_num_rows($res_s);
				if ($num_s != 0){
				  $datas = mysql_fetch_array($res_s);
				  $course_code21 = $datas['code2'];
				  
				  
				  $sql_res2 = "SELECT std_result_code FROM std_results WHERE std_result_reg_no = '$reg_no' AND std_result_code LIKE '$course_code2%' AND std_result_semester = 'SECOND'";
				  $result_res2 = mysql_query($sql_res2) or die(mysql_error());
				  $num_res2 = mysql_num_rows($result_res2);
				  
				  $sql_res21 = "SELECT std_result_code FROM std_results WHERE std_result_reg_no = '$reg_no' AND std_result_code LIKE '$course_code21%' AND std_result_semester = 'SECOND'";
				  
				  $result_res21 = mysql_query($sql_res21) or die(mysql_error());
				  $num_res21 = mysql_num_rows($result_res21);
				  
				  
				  if($num_res2 == 0 && $num_res21 == 0){
					$code_nattempted[$course_id2] = $course_id2;
				  }
				}
				else{
				$sql_res2 = "SELECT std_result_code FROM std_results WHERE std_result_reg_no = '$reg_no' AND std_result_code = '$course_code2' AND std_result_semester = 'SECOND'";
				$result_res2 = mysql_query($sql_res2) or die(mysql_error());
				$num_res2 = mysql_num_rows($result_res2);
					if($num_res2 == 0){
					  $code_nattempted[$course_id2] = $course_id2;
					}
				}
				
			  }
			}
		  }
		}
		return($code_nattempted);
}

	
function print_outstanding($reg_no, $session, $semester, $code){
			global $sn2, $cid; $no = substr($reg_no,5,4);
		$sql = "SELECT * FROM std_results WHERE std_result_reg_no = '$reg_no' AND std_result_session = '$session' AND std_result_semester = '$semester' AND std_result_code = '$code' ";
		$result = mysql_query($sql) or die(mysql_error());
		$num_results =  mysql_num_rows($result);
?>
		
<?php
		if ($num_results != 0){
			
			for ($cnt_results = 0; $cnt_results < $num_results; $cnt_results++){
				$cid = true;
				$result_row = mysql_fetch_array($result);
				$inc_course = $result_row['std_result_inc'];
				$exam_score = $result_row['std_result_exam'];
				$course_code = trim($result_row['std_result_code']);
				$course_title = $result_row['std_result_title'];
				$credit_unit = $result_row['std_result_c_unit'];
				$total_score = $inc_course + $exam_score;
				
				if($no >= 2011){
					if($total_score >= 70)
					{ $l_grade = "A";}
					elseif ($total_score >=60 && $total_score < 70)
					{$l_grade = "B";}
					elseif ($total_score >=50 && $total_score < 60)
					{$l_grade = "C";}
					elseif ($total_score >=45 && $total_score < 50)
					{$l_grade = "D";}
					else
					{$l_grade = "F";}
				}
				if($no < 2011){
					if($total_score >= 70)
					{ $l_grade = "A";}
					elseif ($total_score >=60 && $total_score < 70)
					{$l_grade = "B";}
					elseif ($total_score >=50 && $total_score < 60)
					{$l_grade = "C";}
					elseif ($total_score >=45 && $total_score < 50)
					{$l_grade = "D";}
					elseif ($total_score >=40 && $total_score < 45)
					{$l_grade = "E";}
					else
					{$l_grade = "F";}
				}
					
				echo "<tr> <td align = 'center'>" . $sn2 . "</td> <td>" ;
				echo $course_code . "</td> <td>" . $course_title;
				echo "</td> <td align = 'center'>" ;
				echo $credit_unit . "</td> <td align = 'center'>" ;
				echo $total_score . "</td> <td align = 'center'> <font color='#FF0000'>" ;
				echo $l_grade . "</td></tr> " ;
				$sn2 += 1;
			}
	
				/*echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
				echo "<td align = 'center'></td><td>&nbsp;</td>";
				echo "<td>&nbsp;</td></tr>";*/
		}
}
	
	//function to check for correct reg no format
	function correct_reg_no($reg_no){
		$ebsu =	substr($reg_no,0,4); $slash1 = substr($reg_no, 4,1); $slash2 = substr($reg_no, 9,1); $year = substr($reg_no, 5,4); 
				$no = substr($reg_no,10);
				$yearlen = strlen($year);
				$nolen =  strlen($no);
				if (($nolen == 5) || ($nolen == 6)){
					$nocor =  true;	
				}
				else{
					$nocor = false;
				}
		if (($ebsu == "EBSU") && ($slash1 == "/") && ($slash2 == "/") && ($yearlen == 4) &&($nocor)){
			return true;
		}
		else{
			return false;
		}
	
	}
	
	//function to get class of degree
function class_of_degree($tuke, $reg_no){
	$no = substr($reg_no,5,4);
	if($no >= 2011){
		if ($tuke >= 4.50 && $tuke <=  5.00){
			$fclass = "FIRST CLASS HONOURS";
		}
		elseif ($tuke >= 3.50 && $tuke  < 4.50){
			$fclass = "SECOND CLASS HONOURS (UPPER DIVISION)";
		}
		elseif ($tuke >= 2.40 && $tuke  < 3.50){
			$fclass = "SECOND CLASS HONOURS (LOWER DIVISION)";
		}
		elseif ($tuke >= 1.50 && $tuke  < 2.40){
			$fclass = "THIRD CLASS HONOURS";
		}
		else{
			$fclass = "FAIL";
		}	
		return $fclass;
	}
	
	if($no < 2011){
		if ($tuke >= 4.50 && $tuke <=  5.00){
			$fclass = "FIRST CLASS HONOURS";
		}
		elseif ($tuke >= 3.50 && $tuke < 4.50){
			$fclass = "SECOND CLASS HONOURS (UPPER DIVISION)";
		}
		elseif ($tuke >= 2.40 && $tuke  < 3.50){
			$fclass = "SECOND CLASS HONOURS (LOWER DIVISION)";
		}
		elseif ($tuke >= 1.50 && $tuke  < 2.40){
			$fclass = "THIRD CLASS HONOURS";
		}
		elseif ($tuke >= 1.00 && $tuke  < 1.50){
			$fclass = "PASS";
		}
		else{
			$fclass = "FAIL";
		}	
		return $fclass;
	}
}
?>






<?php


//function to check for outstanding courses
function outstanding_res_final($session, $semester, $reg_no){
		$no = substr($reg_no,5,4);
		global $sn; global $fail_code; global $pass_code; global $anyi;
		$sql = "SELECT * FROM std_results_final WHERE std_result_reg_no = '$reg_no' AND std_result_session = '$session' AND std_result_semester = '$semester' ORDER BY std_result_code";
		$result = mysql_query($sql) or die(mysql_error());
		$num_results =  mysql_num_rows($result);
		if ($num_results != 0){
			for ($cnt_results = 0; $cnt_results < $num_results; $cnt_results++){
				$total_score = 0;
				$result_row = mysql_fetch_array($result);
				$inc_course = $result_row['std_result_inc'];
				$exam_score = $result_row['std_result_exam'];
				$course_code = trim($result_row['std_result_code']);
				//$course_title = $result_row['std_result_title'];
				//$credit_unit = $result_row['std_result_c_unit'];
				$total_score = $inc_course + $exam_score;
				
					if ($no >= 2011){
						if($total_score >= 45 && $total_score <= 100)
						{$grade = 1;}
						else
						{$grade = 0;}
					}
					else{
						if($total_score >= 40 && $total_score <= 100)
						{ $grade = 1;}
						else
						{$grade = 0;}
					}
					
					if ($grade == 0){
						
						$sql_c = "SELECT code2 FROM code_change_log WHERE code1 = '$course_code'";
						$res_c = mysql_query($sql_c);
						$num_c = mysql_num_rows($res_c);
						if ($num_c != 0){
						  $data = mysql_fetch_array($res_c);
						  $course_code2 = $data['code2'];
						  
						  if ($no >= 2011){
						  	$sql_c2 = "SELECT * FROM std_results_final WHERE std_result_code LIKE '$course_code2%' AND (std_result_inc + std_result_exam) >= 40 AND std_result_reg_no = '$reg_no'";
							$res_c2 = mysql_query($sql_c2);
							$num_c2 = mysql_num_rows($res_c2);
							if($num_c2 == 0){
							  if (array_key_exists($course_code,$fail_code)){
								  $fail_code[$course_code] = $session.$semester;
							  }
							  else{
								  $fail_code[$course_code] = $session.$semester;
								  $anyi = 200;
							  }
							}
						  }
						  else{
							$sql_c2 = "SELECT * FROM std_results_final WHERE std_result_code LIKE '$course_code2%' AND (std_result_inc + std_result_exam) >= 45 AND std_result_reg_no = '$reg_no'";
							$res_c2 = mysql_query($sql_c2);
							$num_c2 = mysql_num_rows($res_c2);
							if($num_c2 == 0){							  
							  if (array_key_exists($course_code,$fail_code)){
								  $fail_code[$course_code] = $session.$semester;
							  }
							  else{
								  $fail_code[$course_code] = $session.$semester;
								  $anyi = 200;
							  }
							}
						  } 
						}
						else{
						  if (array_key_exists($course_code,$fail_code)){
							  $fail_code[$course_code] = $session.$semester;
						  }
						  else{
							  $fail_code[$course_code] = $session.$semester;
							  $anyi = 200;
						  }	
						}
					}
					if ($grade == 1){
						$pass_code[$course_code] = $session.$semester;
					}
			}
	
		}
		else{
			echo "<p align='center' style='font-size:20px; color:red; font-weight:bold'>No Result Entry Found</p>"	;
		}
}


//function to check for unattempted courses
function unattempted_course_final($reg_no){
		global $sn; global $code_list; $code_nattempted = array();
		$reg_no = trim($reg_no); $no = substr($reg_no,5,4);

		$sql_cos = "SELECT * FROM std_status WHERE status_regno = '$reg_no' ORDER BY status_session";
		$result_cos = mysql_query($sql_cos) or die(mysql_error());
		$num_cos =  mysql_num_rows($result_cos);
		if($num_cos != 0){
		  for($i=0; $i<$num_cos; $i++){
			$data = mysql_fetch_array($result_cos);
			$session = $data['status_session'];
			$level = $data['status_level'];
			$faculty = $data['status_faculty'];
			$dept = $data['status_dept'];
			
			$sql = "SELECT * FROM sess_course_list WHERE sess_list_session = '$session' AND sess_list_level = $level AND sess_list_faculty = '$faculty' AND sess_list_dept = '$dept' AND sess_list_semester = 'FIRST' ORDER BY sess_list_session, sess_list_code";
			
			$result = mysql_query($sql) or die(mysql_error());
			$num_courses =  mysql_num_rows($result);
			if ($num_courses != 0){
			  for ($cnt_results = 0; $cnt_results < $num_courses; $cnt_results++){
				  
				$result_row = mysql_fetch_array($result);
				$course_id = $result_row['sess_list_id'];
				$course_code1 = trim($result_row['sess_list_code']);
				
				$sql_f = "SELECT code2 FROM code_change_log WHERE code1 = '$course_code1'";
				$res_f = mysql_query($sql_f);
				$num_f = mysql_num_rows($res_f);
				if ($num_f != 0){
				  $data = mysql_fetch_array($res_f);
				  $course_code11 = $data['code2'];
				  
				  $sql_res = "SELECT std_result_code FROM std_results_final WHERE std_result_reg_no = '$reg_no' AND std_result_code LIKE '$course_code1%' AND std_result_semester = 'FIRST'";
				  $result_res = mysql_query($sql_res) or die(mysql_error());
				  $num_res = mysql_num_rows($result_res);
				  
				  $sql_res1 = "SELECT std_result_code FROM std_results_final WHERE std_result_reg_no = '$reg_no' AND std_result_code LIKE '$course_code11%' AND std_result_semester = 'FIRST'";
				  $result_res1 = mysql_query($sql_res1) or die(mysql_error());
				  $num_res1 = mysql_num_rows($result_res1);
				  
				  if($num_res == 0 && $num_res1 == 0){
					$code_nattempted[$course_id] = $course_id;
				  }
					
				}
				else{
				$sql_res = "SELECT std_result_code FROM std_results_final WHERE std_result_reg_no = '$reg_no' AND std_result_code = '$course_code1' AND std_result_semester = 'FIRST'";
				$result_res = mysql_query($sql_res) or die(mysql_error());
				$num_res = mysql_num_rows($result_res);
					if($num_res == 0){
					  $code_nattempted[$course_id] = $course_id;
					}
				}
			  }
			}
			
			
			
			$sql2 = "SELECT * FROM sess_course_list WHERE sess_list_session = '$session' AND sess_list_level = $level AND sess_list_faculty = '$faculty' AND sess_list_dept = '$dept' AND sess_list_semester = 'SECOND' ORDER BY sess_list_session, sess_list_code";
			
			$result2 = mysql_query($sql2) or die(mysql_error());
			$num_courses2 =  mysql_num_rows($result2);
			if ($num_courses2 != 0){
			  for ($cnt_results2 = 0; $cnt_results2 < $num_courses2; $cnt_results2++){
				  
				$result_row2 = mysql_fetch_array($result2);
				$course_id2 = $result_row2['sess_list_id'];
				$course_code2 = trim($result_row2['sess_list_code']);
				
				$sql_s = "SELECT code2 FROM code_change_log WHERE code1 = '$course_code2'";
				$res_s = mysql_query($sql_s);
				$num_s = mysql_num_rows($res_s);
				if ($num_s != 0){
				  $datas = mysql_fetch_array($res_s);
				  $course_code21 = $datas['code2'];
				  
				  
				  $sql_res2 = "SELECT std_result_code FROM std_results_final WHERE std_result_reg_no = '$reg_no' AND std_result_code LIKE '$course_code2%' AND std_result_semester = 'SECOND'";
				  $result_res2 = mysql_query($sql_res2) or die(mysql_error());
				  $num_res2 = mysql_num_rows($result_res2);
				  
				  $sql_res21 = "SELECT std_result_code FROM std_results_final WHERE std_result_reg_no = '$reg_no' AND std_result_code LIKE '$course_code21%' AND std_result_semester = 'SECOND'";
				  
				  $result_res21 = mysql_query($sql_res21) or die(mysql_error());
				  $num_res21 = mysql_num_rows($result_res21);
				  
				  
				  if($num_res2 == 0 && $num_res21 == 0){
					$code_nattempted[$course_id2] = $course_id2;
				  }
				}
				else{
				$sql_res2 = "SELECT std_result_code FROM std_results_final WHERE std_result_reg_no = '$reg_no' AND std_result_code = '$course_code2' AND std_result_semester = 'SECOND'";
				$result_res2 = mysql_query($sql_res2) or die(mysql_error());
				$num_res2 = mysql_num_rows($result_res2);
					if($num_res2 == 0){
					  $code_nattempted[$course_id2] = $course_id2;
					}
				}
				
			  }
			}
		  }
		}
		return($code_nattempted);
}

	
function print_outstanding_final($reg_no, $session, $semester, $code){
			global $sn2, $cid; $no = substr($reg_no,5,4);
		$sql = "SELECT * FROM std_results_final WHERE std_result_reg_no = '$reg_no' AND std_result_session = '$session' AND std_result_semester = '$semester' AND std_result_code = '$code' ";
		$result = mysql_query($sql) or die(mysql_error());
		$num_results =  mysql_num_rows($result);
?>
		
<?php
		if ($num_results != 0){
			
			for ($cnt_results = 0; $cnt_results < $num_results; $cnt_results++){
				$cid = true;
				$result_row = mysql_fetch_array($result);
				$inc_course = $result_row['std_result_inc'];
				$exam_score = $result_row['std_result_exam'];
				$course_code = trim($result_row['std_result_code']);
				$course_title = $result_row['std_result_title'];
				$credit_unit = $result_row['std_result_c_unit'];
				$total_score = $inc_course + $exam_score;
				
				if($no >= 2011){
					if($total_score >= 70)
					{ $l_grade = "A";}
					elseif ($total_score >=60 && $total_score < 70)
					{$l_grade = "B";}
					elseif ($total_score >=50 && $total_score < 60)
					{$l_grade = "C";}
					elseif ($total_score >=45 && $total_score < 50)
					{$l_grade = "D";}
					else
					{$l_grade = "F";}
				}
				if($no < 2011){
					if($total_score >= 70)
					{ $l_grade = "A";}
					elseif ($total_score >=60 && $total_score < 70)
					{$l_grade = "B";}
					elseif ($total_score >=50 && $total_score < 60)
					{$l_grade = "C";}
					elseif ($total_score >=45 && $total_score < 50)
					{$l_grade = "D";}
					elseif ($total_score >=40 && $total_score < 45)
					{$l_grade = "E";}
					else
					{$l_grade = "F";}
				}
					
				echo "<tr> <td align = 'center'>" . $sn2 . "</td> <td>" ;
				echo $course_code . "</td> <td>" . $course_title;
				echo "</td> <td align = 'center'>" ;
				echo $credit_unit . "</td> <td align = 'center'>" ;
				echo $total_score . "</td> <td align = 'center'> <font color='#FF0000'>" ;
				echo $l_grade . "</td></tr> " ;
				$sn2 += 1;
			}
	
				/*echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
				echo "<td align = 'center'></td><td>&nbsp;</td>";
				echo "<td>&nbsp;</td></tr>";*/
		}
}


function std_res_medical($reg_no){
		global $sn; $no = substr($reg_no,5,4);
		$sql = "SELECT * FROM std_results_medical WHERE std_result_reg_no = '$reg_no' AND std_result_resit = '' ORDER BY std_result_course";
		$result = mysql_query($sql) or die(mysql_error());
		$num_results =  mysql_num_rows($result);
		
		$sql_r = "SELECT * FROM std_results_medical WHERE std_result_reg_no = '$reg_no' AND std_result_resit != '' ORDER BY std_result_course";
		$result_r = mysql_query($sql_r) or die(mysql_error());
		$num_results_r =  mysql_num_rows($result_r);
		
		$result_row = mysql_fetch_array($result);
		$level = $result_row['std_result_level'];
		if ($num_results != 0){
			/*echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td><span style='font-size:14px; font-weight:bolder'>".$session. " " .$semester. " ". "SEMESTER" ."</span></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";*/
			echo "<tr><td colspan = 8 class = 'ng'><span style='font-size:14px; font-weight:bolder'>" . $level . "</span></td></tr>";
			for ($cnt_results = 0; $cnt_results < $num_results; $cnt_results++){
				$score = $result_row['std_result_score'];
				$course = $result_row['std_result_course'];
				$remark = $result_row['std_result_remark'];
				echo "<tr><td class=comfort>" . $sn++ . "</td><td class=comfort> $course </td><td class=comfort> $score  </td><td class=comfort> $remark </td></tr>";
				$result_row = mysql_fetch_array($result);
			}
			if ($num_results_r != 0){
			echo "<tr><td colspan = 8><span style='font-size:14px; font-weight:bolder'>". $level ." - RESIT/REPEAT</span></td></tr>";
			for ($cnt_results_r = 0; $cnt_results_r < $num_results_r; $cnt_results_r++){
				$result_row_r = mysql_fetch_array($result_r);
				$score_r = $result_row_r['std_result_score'];
				$course_r = $result_row_r['std_result_course'];
				$remark_r = $result_row_r['std_result_remark'];
				echo "<tr><td>" . $sn++ . "</td><td> $course_r </td><td> $score_r  </td><td> $remark_r </td></tr>";
				
			}
			
		}
		}
		else{
			echo "<p align='center' style='font-size:20px; color:red; font-weight:bold'>No Result Entry Found</p>"	;
		}
}