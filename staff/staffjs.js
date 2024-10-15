// JavaScript Document
function showing(){
$("#div1").hide(7000);
$("#div2").hide(7000);
}
function filldept(str){
	var xmlhttp = getxmlhttp();
	
	document.getElementById("dept").innerHTML = "";
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			document.getElementById("dept").innerHTML = xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("GET","func.php?a="+str,true);
	xmlhttp.send(null);
}

function getxmlhttp(){
	var xmlhttp=null;
	try {
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)
		{
			try {
					xmlhttp=new ActiveXobject("Microsoft.XMLHTTP");
				}
				catch(e)
				{
					try {
							xmlhttp=new ActiveXObject("msxml2.XMLHTTP");
						}
						catch(e1)
						{
							xmlhttp=false;
						}
				}
		}
		return xmlhttp;
		
}
function process(){
	var fac = document.form1.faculty.options[document.form1.faculty.selectedIndex].value
	var dep = document.form1.dept.options[document.form1.dept.selectedIndex].value
	var fname = $("#first_name").val();
	var mname = $("#middle_name").val();
	var lname = $("#last_name").val();
		
	if(fname == ""){
		alert("Please Enter Staff First Names");
		return;
	}
	if(mname == ""){
		alert("Please Enter Staff Other Names");
		return;
	}
	if(fac == 9){
		alert("Please Select a Faculty");
		return;
	}
	if(dep == ""){
		alert("Please Select a Department");
		return;
	}
		
	$("#form1").submit();
}

