<style>
	.trows{
		font-size:13px;
		font-family:Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", monospace
	}
</style>

<?php
	include("../dbconn.php");
	if (isset($_GET['a'])){
		$reg_no = $_GET['a'];
		$reg_no = strtoupper($reg_no);
		fillsess($reg_no);
	}
	else if (isset($_GET['b'])){
		$sent = explode("^", $_GET['b']);
		$reg_no = $sent[0];
		$sess = $sent[1];
		$reg_no = strtoupper($reg_no);
		fillsem($reg_no, $sess);
	}
	else if (isset($_GET['c'])){
		$sent = explode("^", $_GET['c']);
		$reg_no = $sent[0];
		$sess = $sent[1];
		$sem = $sent[2];
		$reg_no = strtoupper($reg_no);
		fillcode($reg_no, $sess, $sem);
	}
	else if (isset($_GET['d'])){
		$sent = explode("^", $_GET['d']);
		$reg_no = $sent[0];
		$sess = $sent[1];
		$sem = $sent[2];
		$code = $sent[3];
		$reg_no = strtoupper($reg_no);
		fillcourse($reg_no, $sess, $sem, $code);
	}
	else if (isset($_GET['e'])){
		$reg_no = $_GET['e'];
		$reg_no = strtoupper($reg_no);
		fillmail($reg_no);
	}
	
	
	
	
	function fillsess($reg){	
		$sql = "SELECT DISTINCT std_result_session 
				FROM std_results 
				WHERE std_result_reg_no = '$reg' 
				ORDER BY std_result_session DESC";
				
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		echo "<option value = '' ></option>";
		while ($datas = mysql_fetch_array($result)){
			$sess = $datas['std_result_session'];
			echo "<option value = $sess > $sess </option>";
		}
	}
	
	function fillsem($reg, $sess){	
		$sql = "SELECT DISTINCT std_result_semester 
				FROM std_results 
				WHERE std_result_reg_no = '$reg' 
				AND std_result_session = '$sess' 
				ORDER BY std_result_semester ASC";
				
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		echo "<option value = '' ></option>";
		while ($datas = mysql_fetch_array($result)){
			$sem = $datas['std_result_semester'];
			echo "<option value = $sem > $sem </option>";
		}
	}
	
	function fillcode($reg, $sess, $sem){
			
		$sql = "SELECT DISTINCT std_result_code 
				FROM std_results 
				WHERE 
					std_result_reg_no = '$reg' AND 
					std_result_session = '$sess' AND 
					std_result_semester = '$sem' 
				ORDER BY std_result_code DESC";
	
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		echo "<option value = '' ></option>";
		while ($datas = mysql_fetch_array($result)){

			$code = $datas['std_result_code'];
			echo "<option value = '$code' > $code </option>";
		}
	}
	
	
	function fillcourse($reg, $sess, $sem, $code){
			
		$sql = "SELECT * 
				FROM std_results 
				WHERE 
					std_result_reg_no = '$reg' AND 
					std_result_session = '$sess' AND 
					std_result_semester = '$sem' AND
					std_result_code = '$code' 
				ORDER BY std_result_code ASC";
	
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		
		echo "<table border='1' cellspacing='0' cellpadding='4' align='center' class='trows' width='1050'> 
				<tr>
					<td width='20'>SN</td>
					<td width='150'>NAME</td>
					<td width='100'>REG. NO.</td>
					<td width='30'>INC</td>
					<td width='40'>EXAM</td>
					<td width='50'>LOAD</td>
					<td width='50'>SEMESTER</td>
					<td width='50'>SESSION</td>
					<td width='100'>CODE</td>
					<td width='250'>TITLE</td>
					<td width='160'>DEPARTMENT</td>
					<td width='50'>
						<form action='actions/domanageresults.php' target='_self' method='post'>
							<input type='submit' name='new' id='new' value='Add New'/>
						</form>
					</td>
				</tr>";
		while ($datas = mysql_fetch_array($result)){

			$sn = $datas['std_result_sn'];
			$nam = $datas['std_result_name'];
			$reg = $datas['std_result_reg_no'];
			$inc = $datas['std_result_inc'];
			$exm = $datas['std_result_exam'];
			$lod = $datas['std_result_c_unit'];
			$sem = $datas['std_result_semester'];
			$ses = $datas['std_result_session'];
			$cod = $datas['std_result_code'];
			$til = $datas['std_result_title'];
			$dep = $datas['std_result_dept'];
			$exa = $datas['std_result_examiner'];
			$edp = $datas['std_result_examiner_dept'];
			$dat = $datas['std_result_exam_date'];
			echo "<tr>
					<td>$sn</td>
					<td>$nam</td>
					<td>$reg</td>
					<td>$inc</td>
					<td>$exm</td>
					<td>$lod</td>
					<td>$sem</td>
					<td>$ses</td>
					<td>$cod</td>
					<td>$til</td>
					<td>$dep</td>
					<td>
						<form action='actions/domanageresults.php' target='_self' method='post'>
                        	<input type='hidden' id='sn' name='sn' value='$sn' />
                            <input type='hidden' id='nam' name='nam' value='$nam' />
                            <input type='hidden' id='reg' name='reg' value='$reg' />
                            <input type='hidden' id='inc' name='inc' value='$inc' />
                            <input type='hidden' id='exm' name='exm' value='$exm' />
                            <input type='hidden' id='lod' name='lod' value='$lod' />
                            <input type='hidden' id='sem' name='sem' value='$sem' />
                            <input type='hidden' id='ses' name='ses' value='$ses' />
                            <input type='hidden' id='cod' name='cod' value='$cod' />
                            <input type='hidden' id='til' name='til' value='$til' />
                            <input type='hidden' id='dep' name='dep' value='$dep' />
							<input type='hidden' id='exa' name='exa' value='$exa' />
							<input type='hidden' id='edp' name='edp' value='$edp' />
							<input type='hidden' id='dat' name='dat' value='$dat' />
						
							<input type='submit' name='modify' id='modify' value='Modify' /> <br />
							<input type='submit' name='delete' id='delete' value='Delete'/>
						</form>
					</td>
				</tr>";
		}
		echo "</table>";
	}
	
	
	
	function fillmail($reg){
			
		$sql = "SELECT * 
				FROM db_mail 
				WHERE 
					mail_owner = '$reg' 
				ORDER BY mail_id";
	
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		
		echo "<table border='1' cellspacing='0' cellpadding='4' align='center' class='trows' width='650'> 
				<tr style='font-weight:bolder'>
					<td width='20'>MAIL ID</td>
					<td width='300'>MAIL TITLE</td>
					<td width='80'>DATE ORIGINATED</td>
					<td width='100'>TREATED BY</td>
					<td width='100'>DATE & TIME TREATED</td>
					<td width='50'></td>
				</tr>";
		while ($datas = mysql_fetch_array($result)){

			$id = $datas['mail_id'];
			$til = $datas['mail_title'];
			$odat = $datas['mail_date'];
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
						<form action='actions/doregview.php' target='_blank' method='post'>
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
	}
	
	
	function getStaff($id){
		$query = "SELECT * FROM db_users WHERE staff_id = '$id'";
		$result = mysql_query($query) or die("Error in Get Staff" . mysql_error());
		$data = mysql_fetch_array($result);
		$name = $data['user_firstname'] . " " . $data['user_middlename'];
		return $name;
	}
?>