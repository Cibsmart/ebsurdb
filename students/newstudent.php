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
		check_reg_no($reg_no);
	}
	else{
		$cib = "Enter Registration Number Please";
		header("location:newregno.php?msg=".$cib);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Student's Form</title>
<script type="text/javascript" src="../jscript/jquery.js" ></script>
<script type="text/javascript" src="../jscript/ajaxupload.3.5.js" ></script>
<link rel="stylesheet" type="text/css" href="../css/pixupload.css" />
<script src="stdjs.js" type="text/javascript"></script>
<link type="text/css" href="stdcss.css" rel="stylesheet" />
</head>

<body>
<?php
$pix_reg_no  = str_replace("/",".",$reg_no);
$pix_reg_no = $pix_reg_no . ".jpg";
?>
<span id="cka" style="display:none " title="<?php echo $pix_reg_no ?>"></span>
<div style="margin:auto;  width:700px; border:solid; border-color:#063">
<form action="processnewstudent.php" method="post" target="_blank" id="stdform" name="stdform">
  <table width="650" border="0" align="center" height="0"  >
    <tr>
      <td colspan="4" align="center"><h1>Bio Data</h1></td>
    </tr>

  </table>

  <table width="650" border="0" align="center" cellpadding="0" cellspacing="2" class="cib">
    <tr>
      <td width="200"><span class="style15"  >Title:</span></td>
      <td><label>
        <select  class="cbo"  id="title" name="title" />
	        <option value="" selected="selected">
        	<option value="Mr">Mr
            <option value="Miss">Miss
            <option value="Mrs">Mrs
            <option value="Dr">Dr
            <option value="Dr(Mrs)">Dr(Mrs)
            <option value="Prof">Prof
        	<option value="Prof(Mrs)">Prof(Mrs)
        </select>
      </label></td>
      <td width="300" rowspan=11>
      <table border="0">
      	<tr><td ><div id="fillpassport" style="width:150px; height:195px; border:solid; border-width:1px">
        <div id="files">
              <li class="success">
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
      <td><input type="text" name="firstname" size = "50"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Middle Name: </span></td>
      <td><input type="text" name="middlename" size = "50"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Last Name </span></td>
      <td><input type="text" name="lastname" size = "50"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Sex</span></td>
      <td>
      	<select  class="cbo" id="sex" name="sex"/>
        	<option value="" selected="selected">
        	<option value="Male">Male
        <option value="Female">Female
      	</select>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Phone: </span></td>
      <td><input type="text" name="phone" size = "50" maxlength="11"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">E-Mail: </span></td>
      <td><input type="text" name="email" size = "50" /></td>
      <td>&nbsp;</td>
    </tr>

    <tr>
      
      <td><span class="style15">Date of Birth </span></td>
      <td>
			<select id="dateyear" name="dateyear" style="width:100px" />
            	<option selected="selected" value="" >
            	<script> 
				var cid = new Date();
				var year = cid.getFullYear();

				var elem = "" // start assembling next part of page and form
					for (var i = year; i >= 1950; i--) {
						elem += "<option value = " + i + ">" + i + "</option>";
					}
						elem += "</select>" // close SELECT item tag
						document.write(elem) // write element to the page
				</script>
            </select>
            <select id="datemonth" name="datemonth" onchange="filldays(this.value)" style="width:135px"/>
            	<option selected="selected" value="" ></option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
            <select id="dateday" name="dateday" style="width:90px"/>
            	<option selected="selected" value="" ></option>
	                        	
            </select>
      </td>
      <td>
      	
      </td>
    </tr>
    <tr>
      
      <td><span class="style15">Place of Birth </span></td>
      <td><input type="text" name="placeofbirth" size = "50"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Nationality</span></td>
      <td>
   		<select  class="cbo"  id="nationality" name="nationality" onchange="fillstate(this.value)"/>	
        	<option selected="selected" value="" ></option>
        	<?php fillcountry() ?>
        </select>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">State of Origin </span></td>
      <td>
      	   	<select  class="cbo"  id="stateoforigin" name="stateoforigin" onchange="filllga(this.value)"/>
	            <option selected="selected" value="" ></option>
	       	</select>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">LGA of Origin </span></td>
      <td>
      		<select class="cbo" id="lgaoforigin" name="lgaoforigin"/>
            	<option selected="selected" value="" ></option>
	        </select>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Town of Origin </span></td>
      <td><input type="text" name="townoforigin" size = "50"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Marital Status </span></td>
      <td>
      		<select  class="cbo"  id="maritalstatus" name="maritalstatus"/>
            	<option value="" selected="selected"></option>
                <option value="single">Single</option>
                <option value="married">Married</option>
                <option value="divorced">Divorced</option>
                <option value="widowed">Widowed</option>
                <option value="widower">Widower</option>
                
	        </select>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Religion:</span></td>
      <td>
      		<select  class="cbo"  id="religion" name="religion"/>
            	<option value="" selected="selected"></option>
                <option value="christianity">Christianity</option>
                <option value="islam">Islam</option>

                <option value="traditional">Traditional</option>
                <option value="others">Others</option>
	        </select>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Permanent Address: </span></td>
      <td><textarea name="permanentaddress" id="permanentaddress" style="width:325px"></textarea></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Contact Address: </span></td>
      <td><textarea name="contactaddress" id="contactaddress" style="width:325px"></textarea></td>
      <td>&nbsp;</td>
    </tr>
  </table>
<p align="center" style="padding:0px; margin:5px;"> <img src="../../images/rule.gif" width = "650"  height="5"/></p>
  <table width="650" border="0" align="center" height="0">
    <tr>
      <td colspan="4" align="center"><h1>Next of Kin</h1></td>
    </tr>

  </table>
  <table width="650" border="0" align="center" cellpadding="0" cellspacing="2"  class="cib">
    <tr>
      
      <td width="200"><span class="style15">Name:</span></td>
      <td><input type="text" name="nokname" size = "50"/></td>
      <td width = "300">&nbsp;</td>
    </tr>
    
    <tr>
      
      <td><span class="style15">Relationship:</span></td>
      <td>
      		<select class="cbo" id="nokrelationship" name="nokrelationship"/>
            	<option value="" selected="selected"></option>
                <option value="father">Father</option>
                <option value="mother">Mother</option>
                <option value="brother">Brother</option>
                <option value="sister">Sister</option>
                <option value="uncle">Uncle</option>
                <option value="aunt">Aunt</option>
                <option value="cousin">Cousin</option>
                <option value="nephew">Nephew</option>
                <option value="others">Others...</option>
	        </select>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Phone No:</span></td>
      <td><input type="text" name="nokphoneno" size = "50" maxlength="11"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Address:</span></td>
      <td><textarea name="nokaddress" id="nokaddress" style="width:325px"></textarea>
      </td>
      <td>&nbsp;</td>
    </tr>
  </table>
<p align="center"> <img src="../../images/rule.gif" width = "650"  height="5"/></p>
  <table width="650" border="0" align="center" height="0">
    <tr>
      <td colspan="4" align="center"><h1>Sponsor</h1></td>
    </tr>

  </table>
  <table width="650" border="0" align="center" cellpadding="0" cellspacing="2"  class="cib">
    <tr>
      
      <td width="200"><span class="style15">Name:</span></td>
      <td><input type="text" name="sponname" size = "50"/></td>
      <td width = "300">&nbsp;</td>
    </tr>

    <tr>
      
      <td><span class="style15">Relationship:</span></td>
      <td>
      		<select class="cbo" id="sponrelationship" name="sponrelationship"/>
            	<option value="" selected="selected" ></option>
                <option value="parent">Parent</option>
                <option value="guardian">Guardian</option>
                <option value="others">Self</option>
	        </select>
      </td>
      <td>&nbsp;</td>
    </tr>

    <tr>
      
      <td><span class="style15">Phone No:</span></td>
      <td><input type="text" name="sponphoneno" size = "50" maxlength="11"/></td>
      <td>&nbsp;</td>
    </tr>
        <tr>
      
      <td><span class="style15">Address:</span></td>
      <td><textarea name="sponaddress" id="sponaddress" style="width:325px"></textarea></td>
      <td>&nbsp;</td>
    </tr>

  </table>
<p align="center"> <img src="../../images/rule.gif" width = "650"  height="5"/></p>
  <table width="650" border="0" align="center" height="0">
    <tr>
      <td colspan="4" align="center"><h1>Entry</h1></td>
    </tr>

  </table>
  <table width="650" border="0" align="center" cellpadding="0" cellspacing="2"  class="cib">
    <tr>
      
      <td width="200"><span class="style15">Year of Entry: </span></td>
      <td>
      		<select class="cbo" id="yearofentry" name="yearofentry"/>
            	<option value="" selected="selected">&nbsp;</option>
            	<script> 
				var cib = new Date();
				var year = cib.getFullYear();

				var elem = "" // start assembling next part of page and form
					for (var i = year; i >= 1999; i--) {
						var j = i + 1;
						elem += "<option value = " + i + "/" + j +">" + i + "/" + j + "</option>";
					}
						elem += "</select>" // close SELECT item tag
						document.write(elem) // write element to the page
				</script>	        </select>
      </td>
      <td width = "300">&nbsp;</td>
    </tr>
    <tr>
    <tr>
      
      <td width="200"><span class="style15">Mode of Entry: </span></td>
      <td>
      		<select class="cbo" id="modeofentry" name="modeofentry"/>
            	<option value="" selected="selected" ></option>
                <option value="ume">UME</option>
                <option value="pre-degree">Pre-Degree</option>
                <option value="direct-entry">Direct Entry</option>
                <option value="transfer">Transfer</option>
                <option value="concessional">Concessional</option>
                <option value="mature">Mature</option>
	        </select>
      </td>
      <td width = "300">&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Previous University: </span></td>
      <td><input type="text" id="previousuniversity" name="previousuniversity" size = "50" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Program Type </span></td>
      <td>
      		<select class="cbo" id="programtype" name="programtype"/>
            	<option value="" selected="selected" ></option>
                <option value="first-degree">First Degree</option>
                <option value="postgraduate-diploma">Postgradaute Diploma</option>
                <option value="masters">Masters</option>
                <option value="ph.d">Ph.D</option>
	        </select>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Highest Qualification: </span></td>
      <td>
      		<select class="cbo" id="highestqualification" name="highestqualification"/>
            	<option value="" selected="selected" ></option>
                <option value="ssce">SSCE</option>
                <option value="wasc(O-Level)">WASC/GCE O-Level</option>
                <option value="tc-ii">TC II/ACE</option>
                <option value="hsc(A-Level)">HSC/GCE A-Level</option>
                <option value="nd">ND</option>
                <option value="hnd">HND</option>
                <option value="degree">Bachelor's Degree</option>
                <option value="pgd">PGD</option>
                <option value="masters">Masters</option>
                <option value="phd">Ph.D</option>
	        </select>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Institution of Highest Qualification: </span></td>
      <td><textarea id="highestqualification" name="highestqualificaitoninst" style="width:325px"></textarea>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Date of Highest Qualification: </span></td>
      <td>
      		<select id="highestqualificationmonth" name="highestqualificationmonth" style="width:185px"/>
            	<option selected="selected" value="" ></option>
                <option value="january">January</option>
                <option value="february">February</option>
                <option value="march">March</option>
                <option value="april">April</option>
                <option value="may">May</option>
                <option value="june">June</option>
                <option value="july">July</option>
                <option value="august">August</option>
                <option value="september">September</option>
                <option value="october">October</option>
                <option value="november">November</option>
                <option value="december">December</option>
            </select>
            <select id="highestqualificationyear" name="highestqualificationyear" style="width:140px" />
            	<option selected="selected" value="" >
            	<script> 
				var cid = new Date();
				var year = cid.getFullYear();

				var elem = "" // start assembling next part of page and form
					for (var i = year; i >= 1950; i--) {
						elem += "<option value = " + i + ">" + i + "</option>";
					}
						elem += "</select>" // close SELECT item tag
						document.write(elem) // write element to the page
						
				</script>
            </select>

      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Course of First Degree </span></td>
      <td><input type="text" name="firstdegreecourse" size = "50"/></td>
      <td>&nbsp;</td>
    </tr>
  </table>
<p align="center"> <img src="../../images/rule.gif" width = "650"  height="5"/></p>
  <table width="650" border="0" align="center" height="0" >
    <tr>
      <td colspan="4" align="center"><h1>Academics</h1></td>
    </tr>

  </table>
  <table width="650" border="0" align="center" cellpadding="0" cellspacing="2"  class="cib">
    <tr>
      
      <td width="200"><span class="style15">Award in View: </span></td>
      <td>
      		<select class="cbo" id="awardinview" name="awardinview" />
            	<option selected="selected" value="" ></option>
                <option value="B.Sc">B.Sc.</option>
                <option value="PGD">PGD</option>
                <option value="M.Sc">M.Sc.</option>
                <option value="Ph.d">Ph.D.</option>
            </select>
      </td>
      <td width = "300">&nbsp;</td>
    </tr>
    
    <tr>
      
      <td><span class="style15">Faculty:</span></td>
      <td>
      		<select class="cbo" id="faculty" name="faculty" onchange="filldept(this.value)" />
          		<option value="">&nbsp;</option>
          		<?php fillfaculty() ?>	
            </select>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Department:</span></td>
      <td>
      		<select class="cbo" id="department" name="department" />
          		<option selected="selected" value="" ></option>
            </select>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Option:</span></td>
      <td><input type="text" name="option" id="option" size = "50" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Mode of Study:</span></td>
      <td>
      		<select class="cbo" id="modeofstudy" name="modeofstudy" />
          		<option selected="selected" value="" ></option>
                <option value="full-time">FULL TIME</option>
                <option value="weekend">WEEKEND</option>
                <option value="part-time">PART TIME</option>
                <option value="evening">EVENING</option>
                <option value="sandwich">SANDWICH</option>
                <option value="occational">OCCASIONAL</option>
                <option value="exchange">EXCHANGE</option>
                <option value="correspondence">CORRESPONDENCE</option>
            </select>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Normal Duration of Study:</span></td>
           <td>
      		<select class="cbo" id="durationofstudy" name="durationofstudy" />
          		<option selected="selected" value="" ></option>
                <option value="1-Year">&nbsp;1 YEAR</option>
                <option value="2-Years">&nbsp;2 YEARS</option>
                <option value="3-Years">&nbsp;3 YEARS</option>
                <option value="4-Years">&nbsp;4 YEARS</option>
                <option value="5-Years">&nbsp;5 YEARS</option>
            </select>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Change of Dept </span></td>
      <td>
      		<select class="cbo" id="changeofdept" name="changeofdept" />
            	<option value="">&nbsp;</option>
          		<?php fillchangedept() ?>
            </select>
      </td>
      <td>&nbsp;</td>
    </tr>
  </table>
<p align="center"> <img src="../../images/rule.gif" width = "650"  height="5"/></p>
  <table width="650" border="0" align="center" height="0">
    <tr>
      <td colspan="4" align="center"><h1>Health</h1></td>
    </tr>

  </table>
  <table width="650" border="0" align="center" cellpadding="0" cellspacing="2"  class="cib">
    <tr>
      
      <td><span class="style15">Extra Curricula Activities: </span></td>
      <td><input type="text" name="extraactivities" size = "50"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td width="200"><span class="style15">Heath Status </span></td>
      <td>
      		<select class="cbo" id="healthstatus" name="healthstatus"/>
            	<option value="" selected="selected" ></option>
                <option value="normal">Normal</option>
                <option value="disabled">Disabled</option>
	        </select>
      </td>
      <td width = "300">&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Disability Type: </span>(if disabled)</td>
      <td><input type="text" name="disability" size = "50"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      
      <td><span class="style15">Medication Type:</span>(if applicable)</td>
      <td><input type="text" name="medicationtype" size = "50"/></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table width="650" border="0" align="center" height="0">
    <tr align="center">
      <td colspan="4" align="center"><h1><input type="submit" name="buton" value="Register"/>&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="hidden" value="<?php echo $reg_no ?>" name="reg_no" id="reg_no" />
      </h1></td>
    </tr>

  </table>
</form>
</div>
</body>
</html>