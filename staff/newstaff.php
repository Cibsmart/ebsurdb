<?php include("func.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Staff Record</title>
<script type="text/javascript" src="../jscript/jquery.js"></script>
<script type="text/javascript" src="staffjs.js"></script>
<style>
	.aaa{
		text-align:right;
		font-size:14px;
		font-family:Arial, Helvetica, sans-serif;
		font-weight:bold;
	}
	.bbb{
		
	}
</style>
</head>

<body>
<div style="padding:6px; font-weight:bolder; text-align:center; font-size:24px">STAFF RECORD</div>
<?php

if(isset($_GET['msg'])){
	if ($_GET['msg'] == 'success'): ?>
		<div style='background:#DCFDC8; border:solid 1px #A0EB70; color:#030; text-align:center; font-weight:bold; padding:4px;' id='div1' name='div1'>Record Uploaded Successfully	</div>;
        
	<?php else: ?>
<div style='padding:6px; background:#FDE0CE; color:#FD5E5E; font-weight:bold; border:solid 1px #FE9592; text-align:center;' id='div2' name='div2'>Duplicate Entry - Error Uploading Record</div>;
	<?php endif ?>
<script> showing(); </script>
<?php }
?>
<div align="center" style="width:600px; border:solid 1px;  margin:auto">
<form action="processnewstaff.php" method="post" id="form1" name="form1">
  <table width="600" border="0" cellpadding="2" cellspacing="5" align="center" >
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">Staff ID:</td>
      <td class="bbb"><input type="text" name="staff_id" id="staff_id" size="20"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">First Name:</td>
      <td class="bbb"><input type="text" name="first_name" id="first_name" size="50"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">Middle Name:</td>
      <td class="bbb"><input type="text" name="middle_name" id="middle_name" size="50"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">Last Name:</td>
      <td class="bbb"><input type="text" name="last_name" id="last_name"size="50" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">Designation:</td>
      <td class="bbb">
      <select name="designation" id="designation">
      	<option value=""></option>
      	<option value="professor">Professor</option>
        <option value="associate professor">Associate Professor</option>
        <option value="senior lecturer">Senior Lecturer</option>
        <option value="lecturer i">Lecturer I</option>
        <option value="lecturer ii">Lecturer II</option>
        <option value="assitant lecturer">Assistant Lecturer</option>
        <option value="graduate assistant">Graduate Assistant</option>
         <option value="chief technologist">Chief Technologist</option>
         <option value="senior laboratory technologist">Senior Laboratory Technology</option>
        <option value="technologist i">Technologist I</option>
        <option value="technologist ii">Technologist II</option>
       
        <option value="heigher executive officer">Heigher Executive Officer</option>
        <option value="executive officer">Executive Officer</option>
        <option value="assistant executive officer">Assistant Executive Officer</option>
        <option value="audit assistant">Audit Assistant</option>
        <option value="senior clerical officer">Senior Clerical Officer</option>
        <option value="clerical officer">Clerical Officer</option>
        <option value="messenger/cleaner i">Messenger/Cleaner I</option>
        <option value="messenger/cleaner ii">Messenger/Cleaner II</option>
      </select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">Qualifications:</td>
      <td class="bbb" style="font-size:12px; color:#aa0000">(Qualification and Year from highest to lowest)</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">1.</td>
      <td class="bbb">
      <select name="qualification1" id="qualification1">
      	<option value="">&nbsp;</option>
      	<option value="Ph.D.">Ph.D.</option>
        <option value="M.Sc.">M.Sc.</option>
        <option value="M.Eng.">M.Eng.</option>
        <option value="B.Sc.">B.Sc.</option>
        <option value="B.Eng.">B.Eng.</option>
        <option value="PGD">PGD</option>
        <option value="PGDE">PGDE</option>
        <option value="HND">HND</option>
        <option value="OND">OND</option>
        <option value="SSCE">SSCE</option>
        <option value="JSSCE">JSSCE</option>
        <option value="FLSC">FLSC</option>
      </select>
        <select name="qualificationdate1" id="qualificationdate1">
        	<?php fillyear(); ?>        	
      </select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">2.</td>
      <td class="bbb">
      <select name="qualification2" id="qualification2">
      	<option value="">&nbsp;</option>
      	<option value="Ph.D.">Ph.D.</option>
        <option value="M.Sc.">M.Sc.</option>
        <option value="M.Eng.">M.Eng.</option>
        <option value="B.Sc.">B.Sc.</option>
        <option value="B.Eng.">B.Eng.</option>
        <option value="PGD">PGD</option>
        <option value="PGDE">PGDE</option>
        <option value="HND">HND</option>
        <option value="OND">OND</option>
        <option value="SSCE">SSCE</option>
        <option value="JSSCE">JSSCE</option>
        <option value="FLSC">FLSC</option>
      </select>
        <select name="qualificationdate2" id="qualificationdate2">
        	<?php fillyear(); ?>
        </select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">3.</td>
      <td class="bbb">
      <select name="qualification3" id="qualification3">
      	<option value="">&nbsp;</option>
      	<option value="Ph.D.">Ph.D.</option>
        <option value="M.Sc.">M.Sc.</option>
        <option value="M.Eng.">M.Eng.</option>
        <option value="B.Sc.">B.Sc.</option>
        <option value="B.Eng.">B.Eng.</option>
        <option value="PGD">PGD</option>
        <option value="PGDE">PGDE</option>
        <option value="HND">HND</option>
        <option value="OND">OND</option>
        <option value="SSCE">SSCE</option>
        <option value="JSSCE">JSSCE</option>
        <option value="FLSC">FLSC</option>
      </select>
        <select name="qualificationdate3" id="qualificationdate3">
        	<?php fillyear(); ?>
        </select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">4.</td>
      <td class="bbb">
      <select name="qualification4" id="qualification4">
      	<option value="">&nbsp;</option>
      	<option value="Ph.D.">Ph.D.</option>
        <option value="M.Sc.">M.Sc.</option>
        <option value="M.Eng.">M.Eng.</option>
        <option value="B.Sc.">B.Sc.</option>
        <option value="B.Eng.">B.Eng.</option>
        <option value="PGD">PGD</option>
        <option value="PGDE">PGDE</option>
        <option value="HND">HND</option>
        <option value="OND">OND</option>
        <option value="SSCE">SSCE</option>
        <option value="JSSCE">JSSCE</option>
        <option value="FLSC">FLSC</option>
      </select>
        <select name="qualificationdate4" id="qualificationdate4">
        	<?php fillyear(); ?>
        </select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">Duties:</td>
      <td class="bbb"><textarea name="duties" id="duties" cols="45" rows="2"></textarea></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">Faculty:</td>
      <td class="bbb">
      <select name="faculty" id="faculty" onchange="filldept(this.value)">
      	<?php fillfaculty(); ?>
      </select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="aaa">Department:</td>
      <td class="bbb">
      <select name="dept" id="dept">
      <option value="">&nbsp;</option>
      </select>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="center">
      <input type="button" name="buton" id="buton" value="Submit" onclick="process()" />
      </td>
    </tr>
  </table>
</form>
</div>
</body>
</html>