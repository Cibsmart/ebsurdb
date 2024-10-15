<?php include("ajaxes.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sessional Course List</title>
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
<div style="margin:auto; border:solid 1px; width:1100px; " align="center">
<form action="" method="post" id="course" name="course">
<table border="1">
            <tr>
                <td class="cc" width="150">Faculty:</td>
                <td class="cd" width="400">
                <select id="faculty" name="faculty" onchange="filldept(this.value), courseslist()" >
                    <?php fillfaculty(); ?>
                </select>
                </td>
            </tr>
            <tr>
                <td class="cc">	Department:</td>
                <td class="cd"><select id="departments" name="departments" onchange="courseslist(), courseslist2()" onblur="courseslist(),courseslist2()">
                    <option value="" selected="selected"></option>
                </select>
                </td>
        	</tr>
        	<tr>
                <td class="cc">Session:</td>
                <td class="cd">
                <select id="session" name="session" onchange="courseslist(),courseslist2()">
                <option value="" selected="selected"></option>
                <option value="2012/2013">2012/2013</option>
                <option value="2011/2012">2011/2012</option>
                <option value="2010/2011">2010/2011</option>
                <option value="2009/2010">2009/2010</option>
                <option value="2008/2009">2008/2009</option>
                <option value="2007/2008">2007/2008</option>
                <option value="2006/2007">2006/2007</option>
                <option value="2005/2006">2005/2006</option>
                <option value="2004/2005">2004/2005</option>
                <option value="2003/2004">2003/2004</option>
                <option value="2002/2004">2002/2003</option>
                <option value="2001/2002">2001/2002</option>
                <option value="1999/2000">1999/2000</option>
                <option value="1998/1999">1998/1999</option>
	            </select>
    	        </td>
        	</tr>
            <tr>
                <td class="cc">Semester:</td>
                <td class="cd">
                <select id="semester" name="semester" onchange="courseslist(),courseslist2()">
                <option value="" selected="selected"></option>
                <option value="first">First</option>
                <option value="second">Second</option>
	            </select>
    	        </td>
        	</tr>
            <tr>
                <td class="cc">Level:</td>
                <td class="cd">    
                <select id="level" name="level" onchange="courseslist(),courseslist2()">
                <option value="" selected="selected"></option>
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="300">300</option>
                <option value="400">400</option>
                <option value="500">500</option>
                </select>
                </td>
        	</tr>
        
        	
        </table><br />
<table border="1" width="" height="" cellspacing="5">
    	

    
    <tr>    
        <td style="font-size:14px;font-weight:bold" width="500" align="center">
        	AVAILABLE COURSES
        </td>
        <td>&nbsp;</td>
        <td style="font-size:14px;font-weight:bold" width="500" align="center">
            SELECTED COURSES
        </td>
    </tr>
    <tr>    
        <td style="font-size:10px;" width="500">
        	<select size="13" id="courses" name="courses" style="width:500px;font-size:12px">
	        </select>
        </td>
        <td align="center" width="50">
        	<input type="button" value=">>" onclick="selectedcourses()" /><br /><br />
        	<input type="button" value="<<" onclick="unselectedcourses()" />
        </td>
        <td style="font-size:10px;" width="500">
            <select size="13" id="courses2" name="courses2" style="width:500px;font-size:12px">
            </select>
        </td>
    </tr>
</table>
</form>
</div>
</body>
</html>



