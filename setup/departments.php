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

    <div style="background:url(../images/back3.jpg); background-repeat:no-repeat; background-position:top-center; margin:auto; width:500px; height:250px;" align="center">
	<br />
    <form action="" method="post" name="department" id="department">
    	<table align="center" width="450" border="0">
        	<tr>
                <td style="text-align:right; border-bottom:solid 1px;">Faculty:</td>
	            <td style="border-bottom:solid 1px;">
             
                <select id="faculties" name="faculties"  style="width:300px" onchange="filldept(this.value)">
                	<option value="" selected="selected"></option>
                    <?php 
						fillfaculty();
					?>
                    
                </select>
                </td>
            </tr>
            <tr>
            	<td style="text-align:right; width:120px">New Department:</td>
                <td>
                <input type="text" id="dept_name" name="dept_name" autofocus="autofocus" size="35"/>
                <input type="button" value="Add" name="add" id="add" onclick="deptadd()" />
                </td>
            </tr>
            <tr>
                <td style="text-align:right; border-top:solid 1px;">Department List:</td>
	            <td style="border-top:solid 1px;">
                <br />
                <select id="departments" name="departments" size="5" >
                </select><br />
                <input type="button" value="Remove Department" name="remove" id="remove" onclick="deptremove()"/>
                </td>
            </tr>
        </table>
        </form>
    </div>
</body>
</html>