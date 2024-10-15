// JavaScript Document
function showing(){
$("#div1").hide(7000);
$("#div2").hide(7000);
}

function process(){
	var stafid = $("#staff_id").val();
	var fname = $("#first_name").val();
	var mname = $("#middle_name").val();
	var lname = $("#last_name").val();
	var uname = $("#username").val();
	var pword1 = $("#password1").val();
	var pword2 = $("#password2").val();
		
	if(stafid == ""){
		alert("Please Enter Users ID");
		return;
	}
	if(fname == ""){
		alert("Please Enter User First Names");
		return;
	}
	if(mname == ""){
		alert("Please Enter User Other Names");
		return;
	}
	if(uname == ""){
		alert("Please Enter Username");
		return;
	}
	if(pword1 !== pword2){
		alert("Password Does Not Matche");
		return;
	}
	$("#form1").submit();
}