<?php
	session_start();
	if(isset($_SESSION['uid']) && $_SESSION['ulev'] == 0){
		$cid = $_SESSION['uid'];
		$lev = $_SESSION['ulev'];
		$rdb = true;
	}
	else{
		if(isset($_POST['r'])){$rdb = false;}
		else{
			$msg = "Forbidden - Not a Valid User";
			header("location:../../login.php?a=".$msg);
		}
	}
	include("../../dbconn.php");
	$id = $_POST['id'];
	$til = $_POST['til'];
	$odat = $_POST['odat'];
	$staf = $_POST['staf'];
	$stafnam = getStaff($staf);
	$tdat = $_POST['tdat'];
	$ttim = $_POST['ttim'];
	$acttil = $_POST['acttil'];
	$act = explode("^",$_POST['act']);
	$rem = $_POST['rem'];
	$reg = $_POST['reg'];
	
	$query = "SELECT * FROM std_results_update WHERE std_results_mail_id = '$id'";
	$result = mysql_query($query) or die("Error with get Update " . mysql_error());
	$d = mysql_fetch_array($result);
	
	$header[0] = "SN"; $header[1] = "NAME"; $header[2] = "REG. NO."; $header[3] = "INC"; $header[4] = "EXAM";
	$header[5] = "UNIT"; $header[6] = "SEMESTER"; $header[7] = "SESSION"; $header[8] = "CODE"; $header[9] = "TITLE";
	$header[10] = "DEPARTMENT";
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>:: Managed Results Details ::</title>
<style>
	.trows{
		font-size:13px;
		font-family:Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", monospace
	}
	.black{
		background-color:#EBF3F4;
	}
	.th{
		font-weight:bolder;	
	}
</style>
</head>

<body>
<span style=" font-family:'Courier New', Courier, monospace">
<a href="javascript:;" onClick="javascript:window.close()">Close</a>
<a href="javascript:;" onClick="javascript:window.print()">Print</a>
</span>
<div align="center"><h3> <?php echo $acttil ?> DETAIL </h3> </div>
<div align="center">
	<table class="trows" cellspacing="0" cellpadding="4" border="1" width="600">
    	<tr class="black">
        	<td class="th" width="200">MAIL ID</td>
            <td width="400"><?php echo $id; ?></td>
        </tr>
        <tr class="white">
        	<td class="th">MAIL TITLE</td>
            <td><?php echo $til; ?></td>
        </tr>
        <tr class="black">
        	<td class="th">CONCERNED STUDENT</td>
            <td><?php echo $reg; ?></td>
        </tr>
        <tr class="white">
        	<td class="th">DATE ORIGINATED</td>
            <td><?php echo $odat; ?></td>
        </tr>
        <tr class="black">
        	<td class="th">STAFF WHO TREATED MAIL</td>
            <td><?php echo $stafnam; ?></td>
        </tr>
        <tr class="white">
        	<td class="th">DATE TREATED</td>
            <td><?php echo $tdat . " " . $ttim; ?></td>
        </tr>
        <tr class="black">
        	<td class="th">STAFF REMARK</td>
            <td><?php echo $rem; ?></td>
        </tr>
        <tr class="white">
            <td class="th">ACTION PERFORMED BY STAFF</td>
            <td>
				<?php echo "<b>" . $acttil . "</b>"; ?> 
				<br />
                <table border="1" class="trows" cellpadding="2" cellspacing="0">
                	<tr>
                    	<td></td>
                        <?php if($acttil == "MODIFIED RESULT"): ?>
                        	<td>OLD VALUES</td>
                            <td>NEW VALUES</td>
                        <?php else: ?>
                        	<td>VALUES</td>
                        <?php endif ?>
                    </tr>
                	<?php
						for($i = 0; $i <= 10; $i++){
							if($acttil == "MODIFIED RESULT"){
								if($act[$i] != $d[$i]){
									echo "<tr style='background-color:#DFDADA'> 
									<td>$header[$i]</td> 
									<td>$d[$i]</td> 
									<td>$act[$i]</td> 
									</tr>";
								}
								else{
									echo "<tr> 
									<td>$header[$i]</td> 
									<td>$d[$i]</td> 
									<td>$act[$i]</td> 
									</tr>";
								}
							}
							else{
								echo "<tr> <td>$header[$i]</td> <td>$act[$i]</td> </tr>";
							}
						}
					?>
                </table>
            </td>
        </tr>
    </table>
</div>
   <!-- <p align="center">
		<form action="../regview.php" method="post" name = "adjTranscrip" >
			<input type="submit" value= "Back" id = "summary"/>
		</form>
   	</p>-->
</body>
</html>

<?php
	function getStaff($id){
		$query = "SELECT * FROM db_users WHERE staff_id = '$id'";
		$result = mysql_query($query) or die("Error in Get Staff" . mysql_error());
		$data = mysql_fetch_array($result);
		$name = $data['user_firstname'] . " " . $data['user_middlename'];
		return $name;
	}
?>