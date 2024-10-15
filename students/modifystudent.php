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
	if ((isset($_POST['reg_no'])) && ($_POST['reg_no'] != "")){
		$reg_no = addslashes(strtoupper(trim($_POST['reg_no'])));
		$correct = correct_reg_no($reg_no);
		$pix_reg_no = str_replace("/",".",$reg_no);
		$pix_reg_no .= ".jpg";
		$pix_src = "passports/" . $pix_reg_no;
	}
	else{
		$cib = "Enter Registration Number Please";
		header("location:modifyregno.php?msg=".$cib);
	}
	
	if(!$correct){
		$cib = "Wrong Registration Number Format";
		header("location:modifyregno.php?msg=".$cib);
	}
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modify Student's Info</title>
<script type="text/javascript" src="../jscript/jquery.js" ></script>
<script type="text/javascript" src="../jscript/ajaxupload.3.5.js" ></script>
<link rel="stylesheet" type="text/css" href="../css/pixupload.css" />
<script src="stdjs.js" type="text/javascript"></script>
<link type="text/css" href="stdcss.css" rel="stylesheet" />
</head>
<?php
		
		$sql = "SELECT * FROM std_info WHERE std_reg_no = '$reg_no' ";
		$result = mysql_query($sql)  or die(mysql_error() . mysql_errno());
		$datas = mysql_fetch_array($result)  or die(mysql_error() . mysql_errno());
		
		$title = ucwords(strtolower($datas['std_title']));
		$fname = ucwords(strtolower($datas['std_firstname']));
		$mname = ucwords(strtolower($datas['std_middlename']));
		$lname = ucwords(strtolower($datas['std_lastname']));
		$sex =  ucwords(strtolower($datas['std_sex']));
		$phone = $datas['std_phone_no'];
		$email = stripslashes($datas['std_email']);
		$birthdate = $datas['std_birth_date'];
		$birthplace = ucwords(strtolower($datas['std_birth_place']));
		$country = ucwords(strtolower($datas['std_nationality']));
		$state = ucwords(strtolower($datas['std_origin_state']));
		$lga = ucwords(strtolower($datas['std_origin_lga']));
		$town = ucwords(strtolower($datas['std_origin_town']));
		$maritalstatus = ucwords(strtolower($datas['std_marital_status']));
		$religion = ucwords(strtolower($datas['std_religion']));
		$caddress = ucwords(strtolower(trim($datas['std_contact_address'])));
		$paddress = ucwords(strtolower(trim($datas['std_permanent_address'])));
		$entryyear = $datas['std_entry_year'];
		$award = $datas['std_award_view'];
		$faculty = ucwords(strtolower($datas['std_faculty']));
		$dept = ucwords(strtolower($datas['std_dept']));
		$option = ucwords(strtolower($datas['std_option']));
		$studymode = ucwords(strtolower($datas['std_study_mode']));
		$duration = ucwords(strtolower($datas['std_study_duration']));
		$entrymode = $datas['std_entry_mode'];
		$formerdept = ucwords(strtolower($datas['std_former_dept']));
		$previousuni = ucwords(strtolower($datas['std_previous_university']));
		$programtype = ucwords(strtolower($datas['std_program_type']));
		$heighestqual = $datas['std_heighest_qualification'];
		$hqualinst = ucwords(strtolower($datas['std_heighest_qualification_inst']));
		$hqualdate = ucwords(strtolower($datas['std_heighest_qualification_date']));
		$firstdegree_course = ucwords(strtolower($datas['std_first_degree_course']));
		$nokname = ucwords(strtolower($datas['std_next_kin_name']));
		$nokaddress = ucwords(strtolower($datas['std_next_kin_address']));
		$nokrel =ucwords(strtolower( $datas['std_next_kin_relationship']));
		$nokphone = $datas['std_next_phone_no'];
		$sponname = ucwords(strtolower($datas['std_sponsor_name']));
		$sponaddress = ucwords(strtolower($datas['std_sponsor_address']));
		$sponphone = $datas['std_sponsor_phone'];
		$extraact = ucwords(strtolower($datas['std_extra_activities']));
		$healthstatus = ucwords(strtolower($datas['std_health_status']));
		$disable = ucwords(strtolower($datas['std_disability_type']));
		$medication = ucwords(strtolower($datas['std_medication_type']));
		$qual = explode("-",$hqualdate);
		$qualmonth = $qual[0];
		$qualyear = $qual[1];

?>
<body>
<span id="cka" style="display:none " title="<?php echo $pix_reg_no ?>"></span>
<div style="margin:auto;  width:700px; border:solid; border-color:#063">
<form action="processmodifystudent.php" method="post" id="stdform" name="stdform">
  <table width="650" border="0" align="center" height="0"  >
    <tr>
      <td colspan="4" align="center"><h1>Bio Data</h1></td>
    </tr>

  </table>

  <table width="650" border="0" align="center" cellpadding="0" cellspacing="2" class="cib">
    <tr>
      <td width="200"><span class="style15"  >Title:</span></td>
      <td><input name="title" type="text" id="title" value="<?php echo $title ?>" size = "30" />
      	Mr, Miss, Mrs etc
      </td>
      <td width="300" rowspan=11>
      <table border="0">
      	<tr><td ><div id="fillpassport" style="width:150px; height:195px; border:solid; border-width:1px">
        <div id="files">
              <li class="success"><img src="<?php echo $pix_src ?>" alt="" height="190" width="144"  />
              </li>
        </div>Passport size 144 x 192px
        </div>
        <div id="me" class="styleall" style=" cursor:pointer;"><span style=" cursor:pointer; font-family:Verdana, Geneva, sans-serif; font-size:10px;"><span style=" cursor:pointer;">Upload Profile Photo</span></span></div><span id="mestatus" ></span>
        </td></tr>
        	<td>
                    
			</td>
        </tr>
      </table>
      </td>
    </tr>
    <tr>
      
      <td><span class="style15">Firstname:</span> &nbsp;(surname)</td>
      <td><input type="text" name="firstname" size = "50" id="firstname" value="<?php echo $fname ?>"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Middle Name: </span></td>
      <td><input type="text" name="middlename" size = "50" id="middlename" value="<?php echo $mname ?>"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Last Name </span></td>
      <td><input type="text" name="lastname" size = "50" id="lastname" value="<?php echo $lname ?>"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Sex</span></td>
      <td><input type="text" name="sex" size = "30" id="sex" value="<?php echo $sex ?>"/>
      	Male or Female
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Phone: </span></td>
      <td><input type="text" name="phone" size = "50" maxlength="11" id="phone" value="<?php echo $phone ?>"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">E-Mail: </span></td>
      <td><input type="text" name="email" size = "50" id="email" value="<?php echo $email ?>" /></td>
      <td>&nbsp;</td>
    </tr>

    <tr>
      
      <td><span class="style15">Date of Birth </span></td>
      <td><input type="text" name="dobyear" size = "8" id="dobyear" value="<?php echo substr($birthdate,0,4); ?>"/>&nbsp;&nbsp;
        <input type="text" name="dobmonth" size = "5" id="dobmonth" value="<?php echo substr($birthdate,5,2); ?>"/>&nbsp;&nbsp;
        <input type="text" name="dobday" size = "5" id="dobday" value="<?php echo substr($birthdate,8,2); ?>"/>yyyy-mm-dd
      </td>
      <td>
      	
      </td>
    </tr>
    <tr>
      
      <td><span class="style15">Place of Birth </span></td>
      <td><input type="text" name="placeofbirth" size = "50" id="placeofbirth" value="<?php echo $birthplace ?>"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Nationality</span></td>
      <td><input type="text" name="nationality" size = "50" id="nationality" value="<?php echo $country ?>"/>
   		
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">State of Origin </span></td>
      <td><input type="text" name="state" size = "50" id="state" value="<?php echo $state ?>"/>
      	   	
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">LGA of Origin </span></td>
      <td><input type="text" name="lga" size = "50" id="lga" value="<?php echo $lga ?>"/>
      		
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Town of Origin </span></td>
      <td><input type="text" name="town" size = "50" id="town" value="<?php echo $town ?>"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Marital Status </span></td>
      <td><input type="text" name="marital" size = "30" id="marital" value="<?php echo $maritalstatus ?>"/>
      		Single, Married etc
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Religion:</span></td>
      <td><input type="text" name="religion" size = "30" id="religion" value="<?php echo $religion ?>"/>
      		Christianity, Islam etc
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Permanent Address: </span></td>
      <td><textarea name="permanentaddress" id="permanentaddress" style="width:325px" ><?php echo $paddress ?></textarea></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Contact Address: </span></td>
      <td><textarea name="contactaddress" id="contactaddress" style="width:325px"> <?php echo $caddress ?></textarea></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table width="650" border="0" align="center" height="0">
    <tr>
      <td colspan="4" align="center"><h1>Next of Kin</h1></td>
    </tr>

</table>
  <table width="650" border="0" align="center" cellpadding="0" cellspacing="2"  class="cib">
    <tr>
      
      <td width="200"><span class="style15">Name:</span></td>
      <td><input type="text" name="nokname" size = "50" id="nokname" value="<?php echo $nokname ?>"/></td>
      <td width = "300">&nbsp;</td>
    </tr>
    
    <tr>
      
      <td><span class="style15">Relationship:</span></td>
      <td><input type="text" name="nokrelation" size = "50" id="nokrelation" value="<?php echo $nokrel ?>"/>
      		
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Phone No:</span></td>
      <td><input type="text" name="nokphone" size = "50" maxlength="11" id="nokphone" value="<?php echo $nokphone ?>"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Address:</span></td>
      <td><textarea name="nokaddress" id="nokaddress" style="width:325px"> <?php echo $nokaddress ?></textarea>
      </td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table width="650" border="0" align="center" height="0">
    <tr>
      <td colspan="4" align="center"><h1>Sponsor</h1></td>
    </tr>

</table>
  <table width="650" border="0" align="center" cellpadding="0" cellspacing="2"  class="cib">
    <tr>
      
      <td width="200"><span class="style15">Name:</span></td>
      <td><input type="text" name="sponname" size = "50" id="sponname" value="<?php echo $sponname ?>"/></td>
      <td width = "300">&nbsp;</td>
    </tr>

    <tr>
      
      <td><span class="style15">Phone No:</span></td>
      <td><input type="text" name="sponphone" size = "50" maxlength="11" id="sponphone" value="<?php echo $sponphone?>"/></td>
      <td>&nbsp;</td>
    </tr>
        <tr>
      
      <td><span class="style15">Address:</span></td>
      <td><textarea name="sponaddress" id="sponaddress" style="width:325px"> <?php echo $sponaddress ?></textarea></td>
      <td>&nbsp;</td>
    </tr>

  </table>
  <table width="650" border="0" align="center" height="0">
    <tr>
      <td colspan="4" align="center"><h1>Entry</h1></td>
    </tr>

</table>
  <table width="650" border="0" align="center" cellpadding="0" cellspacing="2"  class="cib">
    <tr>
      
      <td width="200"><span class="style15">Year of Entry: </span></td>
      <td><input type="text" name="entryyear" size = "30" id="entryyear" value="<?php echo $entryyear ?>"/> 2009/2010 etc
      		
      </td>
      <td width = "300">&nbsp;</td>
    </tr>
    <tr>
    <tr>
      
      <td width="200"><span class="style15">Mode of Entry: </span></td>
      <td><input type="text" name="entrymode" size = "30" id="entrymode" value="<?php echo $entrymode ?>"/> UME, Pre-Degree, etc
      		
      </td>
      <td width = "300">&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Previous University: </span></td>
      <td><input type="text" id="previousuni" name="previousuni" size = "50" value="<?php echo $previousuni ?>"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Program Type </span></td>
      <td><input type="text" name="progtype" size = "30" id="progtype"  value="<?php echo $programtype ?>"/>First-Degree, Masters etc
      		
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Highest Qualification: </span></td>
      <td><input type="text" name="hqual" size = "30" id="hqual" value="<?php echo $heighestqual ?>"/>SSCE, OND, HND etc
      		
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Institution of Highest Qualification: </span></td>
      <td><textarea id="highestqualification" name="hqualinst" style="width:325px"> <?php echo $hqualinst ?></textarea>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Date of Highest Qualification: </span></td>
      <td><input type="text" name="hqualmonth" size = "15" id="hqualmonth" value="<?php echo $qualmonth ?>"/>
      <input type="text" name="hqualyear" size = "10" id="hqualyear" value="<?php echo $qualyear ?>"/>
		month - year
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Course of First Degree </span></td>
      <td><input type="text" name="firstdegreecourse" size = "50" id="firstdegreecourse" value="<?php echo $firstdegree_course ?>" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table width="650" border="0" align="center" height="0" >
    <tr>
      <td colspan="4" align="center"><h1>Academics</h1></td>
    </tr>

</table>
  <table width="650" border="0" align="center" cellpadding="0" cellspacing="2"  class="cib">
    <tr>
      
      <td width="200"><span class="style15">Award in View: </span></td>
      <td><input type="text" name="awardview" size = "30" id="awardview" value="<?php echo $award ?>"/>
      		B.Sc, M.Sc.
      </td>
      <td width = "300">&nbsp;</td>
    </tr>
    
    <tr>
      
      <td><span class="style15">Faculty:</span></td>
      <td><input type="text" name="faculty" size = "50" id="faculty" value="<?php echo $faculty ?>" />
      		
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Department:</span></td>
      <td><input type="text" name="dept" size = "50" id="dept"  value="<?php echo $dept ?>" />
      		
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Option:</span></td>
      <td><input type="text" name="option" size = "50" value="<?php echo $option ?>"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Mode of Study:</span></td>
      <td><input type="text" name="studymode" size = "30" id="studymode" value="<?php echo $studymode ?>"/>
      		Full-time, Part-time etc
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Normal Duration of Study:</span></td>
           <td><input type="text" name="duration" size = "30" id="duration" value="<?php echo $duration ?>"/>
      			3-years, 4-years etc.
        </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Change of Dept </span></td>
      <td><input type="text" name="deptchange" size = "50" id="deptchange" value="<?php echo $formerdept ?>"/>
      </td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table width="650" border="0" align="center" height="0">
    <tr>
      <td colspan="4" align="center"><h1>Health</h1></td>
    </tr>

</table>
  <table width="650" border="0" align="center" cellpadding="0" cellspacing="2"  class="cib">
    <tr>
      
      <td><span class="style15">Extra Curricula Activities: </span></td>
      <td><input type="text" name="extraactivities" size = "50" id="extraactivities" value="<?php echo $extraact ?>"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td width="200"><span class="style15">Health Status </span></td>
      <td><input type="text" name="hstatus" size = "30" id="hstatus" value="<?php echo $healthstatus ?>"/>
      		Normal or Disabled
      </td>
      <td width = "300">&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Disability Type: </span>(if disabled)</td>
      <td><input type="text" name="disability" size = "50" id="disability" value="<?php echo $disable ?>"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Medication Type:</span>(if applicable)</td>
      <td><input type="text" name="medicationtype" size = "50" id="medicationtype"  value="<?php echo $medication ?>"/></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table width="650" border="0" align="center" height="0">
    <tr align="center">
      <td colspan="4" align="center"><h1><input type="submit" name="buton" value="Modify"/>&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="hidden" value="<?php echo $reg_no ?>" name="reg_no" id="reg_no" />
      </h1></td>
    </tr>

  </table>
</form>
</div>
</body>
</html>