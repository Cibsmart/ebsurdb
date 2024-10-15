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
	$sta = $_POST['start'];
	$sto = $_POST['stop'];
	
	$start = implode("/", array_reverse(explode("-",$sta)));
	$stop = implode("/", array_reverse(explode("-",$sto)));
	
	
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
<div align="center"><h3> LIST OF MAIL TREATED FROM <?php echo $start ?> TO <?php echo $stop ?> </h3> </div>
<div align="center">
<?php $sql = "SELECT * FROM db_mail WHERE mail_treat_date >= '$sta' AND mail_treat_date <= '$sto' ORDER BY mail_id";
	
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		
		echo "<table border='1' cellspacing='0' cellpadding='4' align='center' class='trows' width='900'> 
				<tr style='font-weight:bolder'>
					<td width='50'>MAIL ID</td>
					<td width='300'>MAIL TITLE</td>
					<td width='100'>DATE ORIGINATED</td>
					<td width='200'>TREATED BY</td>
					<td width='200'>DATE & TIME TREATED</td>
					<td width='50'></td>
				</tr>";
		while ($datas = mysql_fetch_array($result)){

			$id = $datas['mail_id'];
			$til = $datas['mail_title'];
			$odat = $datas['mail_date'];
			$reg = $datas['mail_owner'];
			$staf = $datas['mail_staff'];
			$stafnam = getStaff($staf);
			$tdat = $datas['mail_treat_date'];
			$ttim = $datas['mail_treat_time'];
			$acttil = $datas['mail_action_title'];
			$act = $datas['mail_action'];
			$rem = $datas['mail_remark'];
			echo "<tr>
					<td>$id</td>
					<td>$til</td>
					<td>$odat</td>
					<td>$stafnam</td>
					<td>$tdat $ttim</td>
					<td>
						<form action='doregview.php' target='_blank' method='post'>
                        	<input type='hidden' id='id' name='id' value='$id' />
                            <input type='hidden' id='til' name='til' value='$til' />
                            <input type='hidden' id='odat' name='odat' value='$odat' />
                            <input type='hidden' id='reg' name='reg' value='$reg' />
                            <input type='hidden' id='staf' name='staf' value='$staf' />
                            <input type='hidden' id='tdat' name='tdat' value='$tdat' />
							<input type='hidden' id='ttim' name='ttim' value='$ttim' />
							<input type='hidden' id='act' name='acttil' value='$acttil' />
                            <input type='hidden' id='act' name='act' value='$act' />
                            <input type='hidden' id='rem' name='rem' value='$rem' />
						
							<input type='submit' name='details' id='details' value='Details' />
						</form>
					</td>
				</tr>";
		}
		echo "</table>";
?>
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