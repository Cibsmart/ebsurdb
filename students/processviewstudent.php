<?php
	session_start();
	if(isset($_SESSION['uid'])){
		$cid = $_SESSION['uid'];
	}
	else{
			$msg = "Forbidden - Not a Valid User";
			header("location:../login.php?a=".$msg);
	}
	
	include ("ajaxes.php");
	include('../utilities/logging.php');
	
	$h = $_POST['reg_no'];
	$act = "Viewed $h - Nominal Rolls";
	logg($cid,$act);
	$s = "SELECT user_id FROM db_users WHERE staff_id = '$cid'";
	$r = mysql_query($s);
	$rs = mysql_fetch_array($r) or die(mysql_error());
	$log_id = $rs['user_id'];

		if ((isset($_POST['reg_no'])) && ($_POST['reg_no'] != "")){
			$reg_no = addslashes(strtoupper(trim($_POST['reg_no'])));
			$sees =  correct_reg_no($reg_no);
			$pix_reg_no = str_replace("/",".",$reg_no);
			$pix_reg_no .= ".jpg";
			$pix_src = "passports/" . $pix_reg_no;
		}
		else{
			$msg = "Enter Registration Number Please";
			header("location:viewstudent.php?cib=$msg");
		}
		
		if(!$sees) {
			$msg = "Incorrect Registration Number";
			header("location:viewstudent.php?cib=$msg");
		}
			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style>
	td {
	font:12px Arial, Helvetica, sans-serif;
	color:#000000;
	}
	
	#heads{
		text-align:right;
		border-bottom:solid 1px;
		border-right:solid 1px;
	}
	
	#bodys{
		border-bottom:solid 1px;
		text-align:left;
	}

	#hds{
		font-size:12px;
		font-weight:bold;
		border-bottom:solid 1px;
		border-top:solid 1px;
		text-align:left;
	}
	#hds1{
		font-size:12px;
		font-weight:bold;
		border-bottom:solid 1px;
		border-right:solid 1px;
		border-top:solid 1px;
		text-align:right;
	}
</style>
<title>:: <?php echo $reg_no ?> - Nominal Roll - RDB(<?php echo $log_id; ?>)EBSU ::</title>

</head>
<body>
<p align="center">
    <table width = '590' border = '0' cellspacing = '0' align = 'center'>
    <td><img src="../images/ich logo.jpg" width = 100 height = 110/></td>
    <td align="center">
  <span style="font-family:'Arial Black', Gadget, sans-serif; font:bolder; font-size:14px;"> RESULTS DATABASE</span><br>
         <span style="font-family:'Arial Black', Gadget, sans-serif; font:bold; font-size:12px;">EBONYI STATE UNIVERSITY<br>
        P.M.B 053 ABAKALIKI EBONYI STATE<br>
        Students' Information</span>
    </td><td>
    <img src='<?php echo $pix_src ?>' width='100' height='110' alt="Passport"/>
    </td>
    </table>
</p>
<?php
	
	
	if (isset($_POST['buton'])){
		
		$sql = "SELECT * FROM std_info WHERE std_reg_no = '$reg_no' ";
		$result = mysql_query($sql)  or die(mysql_error() . mysql_errno());
		$datas = mysql_fetch_array($result)  or die(mysql_error() . mysql_errno());
		
		$names = "  ".$datas['std_title'] . " " .  $datas['std_firstname'] . " " .  $datas['std_middlename'] . " " .  $datas['std_lastname'];
		$sex =  ucwords(strtolower($datas['std_sex']));
		$phone_no = $datas['std_phone_no'];
		$email = stripslashes($datas['std_email']);
		$birth_date = $datas['std_birth_date'];
		$birth_place = ucwords(strtolower($datas['std_birth_place']));
		$country = ucwords(strtolower($datas['std_nationality']));
		$state = ucwords(strtolower($datas['std_origin_state']));
		$lga = ucwords(strtolower($datas['std_origin_lga']));
		$town = ucwords(strtolower($datas['std_origin_town']));
		$marital_status = ucwords(strtolower($datas['std_marital_status']));
		$religion = ucwords(strtolower($datas['std_religion']));
		$c_address = ucwords(strtolower($datas['std_contact_address']));
		$p_address = ucwords(strtolower($datas['std_permanent_address']));
		$entry_year = $datas['std_entry_year'];
		$award = $datas['std_award_view'];
		$faculty = ucwords(strtolower($datas['std_faculty']));
		$dept = ucwords(strtolower($datas['std_dept']));
		$study_mode = ucwords(strtolower($datas['std_study_mode']));
		$duration = ucwords(strtolower($datas['std_study_duration']));
		$entry_mode = $datas['std_entry_mode'];
		$former_dept = ucwords(strtolower($datas['std_former_dept']));
		$previous_uni = ucwords(strtolower($datas['std_previous_university']));
		$program_type = ucwords(strtolower($datas['std_program_type']));
		$heighest_qual = $datas['std_heighest_qualification'];
		$heighest_qual_inst = ucwords(strtolower($datas['std_heighest_qualification_inst']));
		$heighest_qual_date = ucwords(strtolower($datas['std_heighest_qualification_date']));
		$first_degree_course = ucwords(strtolower($datas['std_first_degree_course']));
		$nok_name = $datas['std_next_kin_name'];
		$nok_address = $datas['std_next_kin_address'];
		$nok_rel = $datas['std_next_kin_relationship'];
		$nok_phone = $datas['std_next_phone_no'];
		$spon_name = $datas['std_sponsor_name'];
		$spon_address = $datas['std_sponsor_address'];
		$spon_phone = $datas['std_sponsor_phone'];
		$extra_act = ucwords(strtolower($datas['std_extra_activities']));
		$health_status = ucwords(strtolower($datas['std_health_status']));
		$disable = ucwords(strtolower($datas['std_disability_type']));
		$medication = ucwords(strtolower($datas['std_medication_type']));
		
		$nok = ucwords(strtolower("$nok_name<br> $nok_phone<br> $nok_rel<br> $nok_address"));
		$sponsor = ucwords(strtolower("$spon_name<br> $spon_phone <br> $spon_address"));
?>

	<div align="center">
    	<table border="0" cellpadding="0" cellspacing="0">
        	<tr>
        	<td id="hds1" width="150">Name: &nbsp; &nbsp;</td>
            <td id="hds" width="300">&nbsp; &nbsp;<?php echo $names; ?></td>
            
        </tr>
        <tr>
        	<td id="hds1">Registration Number: &nbsp; &nbsp;</td>
            <td id="hds">&nbsp; &nbsp;<?php echo $reg_no ?></td>
        </tr>
        <tr>
        </table>
    </div><br />
	<div style="margin:auto;" align="center">
	<table border="0" align="center">

        <tr>
        	<td id="heads"  width="200">Sex:</td>
            <td id="bodys"  width="300"><?php echo $sex ?></td>
        </tr>

        <tr>
        	<td id="heads">Department:</td>
            <td id="bodys"><?php echo $dept ?></td>
        </tr>
       <tr>
        	<td id="heads">Faculty:</td>
            <td id="bodys"><?php echo $faculty ?></td>
        </tr>
         	<td id="heads">Phone Number:</td>
            <td id="bodys"><?php echo $phone_no ?></td>
        </tr>
        <tr>
        	<td id="heads">E-mail:</td>
            <td id="bodys"><?php echo $email ?></td>
        </tr>
        <tr>
        	<td id="heads">Date of Birth:</td>
            <td id="bodys"><?php echo $birth_date ?></td>
        </tr>
        <tr>
        	<td id="heads">Place of Birth:</td>
            <td id="bodys"><?php echo $birth_place ?></td>
        </tr>
        <tr>
        	<td id="heads">Nationality:</td>
            <td id="bodys"><?php echo $country ?></td>
        </tr>
        <tr>
        	<td id="heads">State of Origin:</td>
            <td id="bodys"><?php echo $state ?></td>
        </tr>
        <tr>
        	<td id="heads">Local Government Area:</td>
            <td id="bodys"><?php echo $lga ?></td>
        </tr>
        <tr>
        	<td id="heads">Town of Origin:</td>
            <td id="bodys"><?php echo $town ?></td>
        </tr>
        <tr>
        	<td id="heads">Marital Status:</td>
            <td id="bodys"><?php echo $marital_status ?></td>
        </tr>
        <tr>
        	<td id="heads">Religion:</td>
            <td id="bodys"><?php echo $religion ?></td>
        </tr>
        
        <tr>
        	<td id="heads">Contact Address:</td>
            <td id="bodys"><?php echo $c_address ?></td>
        </tr>
        <tr>
        	<td id="heads">Parmanent Address:</td>
            <td id="bodys"><?php echo $p_address ?></td>
        </tr>
       <tr>
        	<td id="heads">Year of Entry:</td>
            <td id="bodys"><?php echo $entry_year ?></td>
        </tr>
        <tr>
        	<td id="heads">Award in View:</td>
            <td id="bodys"><?php echo $award ?></td>
        </tr>
        <tr>
        	<td id="heads">Mode of Entry:</td>
            <td id="bodys"><?php echo $entry_mode ?></td>
        </tr>
        <tr>
        	<td id="heads">Duration of Study:</td>
            <td id="bodys"><?php echo $duration ?></td>
        </tr>
        <?php if ($former_dept != ""):?>
        <tr>
        	<td id="heads">Change of Department:</td>
            <td id="bodys"><?php echo $former_dept ?></td>
        </tr>
        <?php endif ?>
        <?php if ($previous_uni != ""):?>
        <tr>
        	<td id="heads">Previous University:</td>
            <td id="bodys"><?php echo $previous_uni ?></td>
        </tr>
        <?php endif ?>
        <tr>
        	<td id="heads">Program Type:</td>
            <td id="bodys"><?php echo $program_type ?></td>
        </tr>
        <tr>
        	<td id="heads">Heighest Qualification:</td>
            <td id="bodys"><?php echo $heighest_qual ?></td>
        </tr>
        <tr>
        	<td id="heads">Institution of Heighest Qualification:</td>
            <td id="bodys"><?php echo $heighest_qual_inst ?></td>
        </tr>
        <tr>
        	<td id="heads">Date of Heighest Qualification:</td>
            <td id="bodys"><?php echo $heighest_qual_date ?></td>
        </tr>
        <tr>
        	<td id="heads">Next of Kin:</td>
            <td id="bodys"><?php echo $nok ?></td>
        </tr>
        <tr>
        	<td id="heads">Sponsor</td>
            <td id="bodys"><?php echo $sponsor ?></td>
        </tr>
        <tr>
        	<td id="heads">Extra Curricular Activities:</td>
            <td id="bodys"><?php echo $extra_act ?></td>
        </tr>
        <tr>
        	<td id="heads">Health Status:</td>
            <td id="bodys"><?php echo $health_status ?></td>
        </tr>
        <?php if ($disable != ""):?>
        	<td id="heads">Disability Type:</td>
            <td id="bodys"><?php echo $disable ?></td>
        </tr>
        <?php endif ?>
        <?php if ($medication != ""):?>
        <tr>
        	<td id="heads">Medication Type:</td>
            <td id="bodys"><?php echo $medication ?></td>
        </tr>
        <?php endif ?>
    </table>
    </div>
<?php
	}
	else{
		header("location:viewstudent.php");
	}
	
	
?>
</body>
</html>