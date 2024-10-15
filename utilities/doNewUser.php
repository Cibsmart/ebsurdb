<?php
	session_start();
	if(isset($_SESSION['uid'])){
		$cid = $_SESSION['uid'];
	}
	else{
		header("location:../login.php");
	}
	include('../dbconn.php');
	include('logging.php');
	$id = addslashes(trim($_POST['staff_id']));
	$fname = addslashes(strtoupper(trim($_POST['first_name'])));
	$mname = addslashes(strtoupper(trim($_POST['middle_name'])));
	$lname = addslashes(strtoupper(trim($_POST['last_name'])));
	$uname = addslashes(strtoupper(trim($_POST['username'])));
	$pword1 = addslashes(trim($_POST['password1']));
	$pword2 = addslashes(trim($_POST['password2']));
	$ulevel = addslashes(trim($_POST['user_level']));
	$pword = c($id,$pword1);

	$sql = "INSERT INTO db_users
			(user_id, staff_id, user_firstname, user_middlename, user_lastname, user_username, user_password, user_userlevel, user_status)
			VALUES('','$id','$fname','$mname','$lname','$uname', '$pword', '$ulevel','PASSIVE')";

	$result = mysql_query($sql);
	if($result){
		$msg = "success";
		$act = "Registered New User: id=$id - user=$uname - ulevel=$ulevel";
		logg($cid,$act);
		header("location:NewUser.php?msg=".$msg);
	}
	else{
		$msg = "error";
		header("location:NewUser.php?msg=".$msg);
	}
	
	function c($a, $b){
		$cd = $a . $b . $a;
		$cd = md5($cd);
		return $cd;	
	}
?>