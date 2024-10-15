<?php 
	session_start();
	if(isset($_SESSION['uid']) && $_SESSION['ulev'] == 0){
		$cid = $_SESSION['uid'];
	}
	else{
		if(isset($_GET['r'])){}
		else{
			$act = "Forbidden - Not a Valid User";
			header("location:../login.php?a=".$act);
		}
	}
	date_default_timezone_set('Africa/Lagos');
	$tymes = time() + (60 * 60);
	$dates = date("Y-m-d",$tymes);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../jscript/jquery.js" ></script>
<script type="text/javascript" src="manageJS.js"></script>
<title>::Manage Students' Results::</title>
<style>
	div.cib {
		margin:auto;
		width:400px;
		border:medium;
		background-image: url(../images/login_bg.jpg);
		background-repeat: no-repeat;
		padding: 4px;
		height: 200px;
		font-family: Verdana, Geneva, sans-serif;
		font-size: 12px;
		font-weight: bold;
		color: #000;
	}
</style>

</head>

<body>
	<p id="cka" style="font-family:'Arial Black', Gadget, sans-serif; color:#F00;" align="center">&nbsp;</p>
	<div class="cib">
    	<form action="actions/dodateview.php" method="post" name="newstudent" target="_blank"><br />
        <table align="center">
        	<tr>
            	<td align="right">Start Date</td>
                <td>
					<input type="date" name="start" id="start" max="<?php echo $dates; ?>"  />
                </td>
            </tr>
            
            <tr>
            	<td align="right">Stop Date</td>
                <td>
                	<input type="date" name="stop" id="stop" max="<?php echo $dates; ?>" />
                </td>
            </tr>
            <tr>&nbsp;</tr>
            <tr>
                <td colspan="2" align="center">
                	<input type="submit" name="view" id="button" value="View" />
                </td>
            </tr>
         </table>
        </form>
    </div>
    
    <p align="center">
		<form action="viewmanaged.php" method="post" name = "adjTranscrip" >
			<input type="submit" value= "Back" id = "summary"/>
		</form>
   	</p>
</body>
</html>
