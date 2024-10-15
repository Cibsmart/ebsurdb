<?php
	
	//Logout
	function user_logout(){
		include('dbconn.php');
		include('utilities/logging.php');
		if (isset($_SESSION['uid'])){
		$id = $_SESSION['uid'];
		$sl =  "UPDATE db_users SET user_status = 'PASSIVE' WHERE staff_id = '$id' && user_status <> 'PASSIVE'";
		$rs = mysql_query($sl) or die(mysql_error());

		$_SESSION = array();
		if(isset($_COOKIE[session_name()])){
			setcookie('session_name','',time()-86400,'/');
		}
		ob_end_flush();
		session_destroy();
		logg($id, "Logged-Out");
		$cib = true;
		return $cib;
		}
	}
	
	function user_logout2($cid){
		include('dbconn.php');
		$sl =  "UPDATE db_users SET user_status = 'PASSIVE' WHERE staff_id = '$cid'  && user_status <> 'PASSIVE'";
		$rs = mysql_query($sl) or die(mysql_error());
		logg($cid, "Logged-Out");
		
	}
	
	//Get Session
	function get_session(){
		return $_SESSION['login'];
	}
	//Log-in	
	function login($username, $password){
		$sq =  "SELECT staff_id AS cib FROM db_users WHERE user_username = '$username'";
		$res = mysql_query($sq);
		$row = mysql_fetch_array($res);
		$staff_id = $row['cib'];
		$password = c($staff_id,$password);		
		$sql =  "SELECT * FROM db_users WHERE user_username = '$username' AND user_password = '$password'";	
		$result = mysql_query($sql);
		
		$sql1 =  "SELECT * FROM db_users WHERE user_status =  'PASSIVE' AND staff_id = '$staff_id'";	
		$result1 = mysql_query($sql1);
		$no_row1 = mysql_num_rows($result1);		
		
		$row_data = mysql_fetch_array($result);
		$no_row = mysql_num_rows($result);
		if ($no_row == 1){
			if ($no_row == 1 && $no_row1 != 1){
				user_logout2($staff_id);
			}
			if($no_row1 != 1){
				$msg = "This User is Logged-In Already - Try Again";
				header('location:login.php?a='.$msg);
			return false;
			}
			
			session_regenerate_id();
			$id = $row_data['staff_id'];
			$_SESSION['uid'] = $id;
			$_SESSION['ulev'] = $row_data['user_userlevel'];
			$sl =  "UPDATE db_users SET user_status = 'ACTIVE' WHERE staff_id = '$id'";
		$rs = mysql_query($sl) or die(mysql_error());
			logg($id, "Logged-In");
			return true;
		}
		else{
			$msg = "Wrong Password! Please Try Again";
			header('location:login.php?a='.$msg);
			return false;
		}
	}
	
	function c($a, $b){
		$cd = $a . $b . $a;
		$cd = md5($cd);
		return $cd;	
	}
?>