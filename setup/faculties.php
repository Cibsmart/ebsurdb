<?php 
		include("ajaxes.php");
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
	td{
		font-size:12px;
		font-family:Georgia, "Times New Roman", Times, serif;
		font-weight:bold
	}
</style>
<script src="setup.js" type="text/javascript"></script>
</head>

<body>

    <div style="background:url(../images/back3.jpg); background-repeat:no-repeat; background-position:top-center; margin:auto; width:500px; height:250px" align="center">
	<p>&nbsp;</p>
    <form method="post" name="faculty" id="faculty">
    	<table align="center" width="450" border="0">
        	<tr>
            	<td style="text-align:right; width:100px">Faculty Name:</td>
                <td>
                <input type="text" id="faculty_name" name="faculty_name" autofocus="autofocus" size="40"/>
                <input type="button" value="Add" name="add" id="add" onclick="facultyadd()"/>
                </td>
            </tr>
            <tr>
                <td style="text-align:right; border-top:solid 1px;">Faculties List:</td>
	            <td style="border-top:solid 1px;">
                <br />
                <select id="faculties" name="faculties" size="5" style="width:300px">
                    <?php 
						fillfaculty();
					?>
                    
                </select><br />
                <input type="button" value="Edit Faculty" name="remove" id="remove" onclick="facultyedit()"/>
                </td>
            </tr>
        </table>
        </form>
    </div>
</body>
</html>