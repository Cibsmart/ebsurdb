<?php include("ajaxes.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>General Course List</title>
<script src="setup.js" type="text/javascript"></script>
<style>
	body{
		margin:20px;
	}
	.cc{
		text-align:right;
		font-size:14px;
		font-weight:bold;
	}
	.cd{
		text-align:left;
	}
</style>
</head>

<body>
<div style="margin:auto; border:solid 1px; width:1050px; " align="center">
<form action="" method="post" id="course" name="course">
<table border="0" width="" height="" cellspacing="5">
	<tr>
    	<td class="cc" width="150">Faculty:</td>
        <td class="cd" width="400">
        <select id="faculty" name="faculty" onchange="filldept(this.value), courseslist()" >
        	<?php fillfaculty(); ?>
        </select>
        </td>
        <td rowspan="8" style="font-size:10px; border-left:solid 1px" width="500"><select size="13" id="courses" name="courses" style="width:500px; border:none">
    </select>
    </td>
    </tr>
    <tr>
    	<td class="cc">	Department:</td>
        <td class="cd"><select id="departments" name="departments" onchange="courseslist()" onblur="courseslist()">
        	<option value="" selected="selected"></option>
        </select>
        </td>
    </tr>
    <tr>
    	<td class="cc">Level:</td>
        <td class="cd">    
        <select id="level" name="level" onchange="courseslist()">
    	<option value="" selected="selected"></option>
        <option value="100">100</option>
        <option value="200">200</option>
        <option value="300">300</option>
        <option value="400">400</option>
        <option value="500">500</option>
    	</select>
		</td>
    </tr>
    <tr>
    	<td class="cc">Semester:</td>
        <td class="cd">
        <select id="semester" name="semester" onchange="courseslist()">
    	<option value="" selected="selected"></option>
        <option value="first">First</option>
        <option value="second">Second</option>
    </select>
    </td>
    </tr>
    <tr>
    	<td class="cc">Credit Unit:</td>
        <td class="cd"><select id="cload" name="cload">
    	<option value="" selected="selected"></option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="6">6</option>
        <option value="18">18</option>
    </select></td>
    </tr>
    <tr>
    	<td class="cc">Course Specification:</td>
        <td class="cd"><select id="spec" name="spec">
    	<option value="" selected="selected"></option>
        <option value="general">General Course</option>
        <option value="core">Core Course</option>
        <option value="ancillary">Ancillary Course</option>
        <option value="elective">Elective Course</option>
    </select>
    </td>
    </tr>
    <tr>
    	<td class="cc">Course Code:</td>
        <td class="cd"><input type="text" size="15" id="code" name="code"/></td>
    </tr>	
    <tr>
    	<td class="cc">Course Title:</td>
        <td class="cd"><input type="text" size="50" id="title" name="title"/></td>
    </tr>	
    <tr>
    	<td class="cc"></td>
        <td class="cd"><input type="button" value="Add Course" onclick="addcourses()" /></td>
        <td><input type="button" value="Remove Course" onclick="removecourses()" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" size="3" id="total" name="total"  />
        </td>
        
    </tr>	
    
    
    
</table>
</form>
</div>
</body>
</html>



