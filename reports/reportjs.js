// JavaScript Document

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
	var ses = $("#session").val();
	var sem = $("#semester").val();
	var lev = $("#level").val();
	
	if(fac == 9){
		alert("Please Select a Faculty");
		return;
	}
	if(dep == ""){
		alert("Please Select a Department");
		return;
	}
	if(ses == ""){
		alert("Please Select a Session");
		return;
	}
	if(sem == ""){
		alert("Please Select a Semester");
		return;
	}
	if(lev == ""){
		alert("Please Select a Level");
		return;
	}
	
	$("#form1").submit()
}

function processsumm(){
	//var fac = document.form1.faculty.options[document.form1.faculty.selectedIndex].value
	//var dep = document.form1.dept.options[document.form1.dept.selectedIndex].value
	var ses = $("#session").val();
	//var sem = $("#semester").val();
	//var lev = $("#level").val();
	
	/*if(fac == 9){
		alert("Please Select a Faculty");
		return;
	}
	if(dep == ""){
		alert("Please Select a Department");
		return;
	}*/
	if(ses == ""){
		alert("Please Select a Session");
		return;
	}
	/*
	if(sem == ""){
		alert("Please Select a Semester");
		return;
	}
	if(lev == ""){
		alert("Please Select a Level");
		return;
	}*/
	
	$("#form1").submit()
}


function processStdList(){
	var fac = document.form1.faculty.options[document.form1.faculty.selectedIndex].value
	var dep = document.form1.dept.options[document.form1.dept.selectedIndex].value
	var year = $("#year").val();
	
	if(fac == 9){
		alert("Please Select a Faculty");
		return;
	}
	if(dep == ""){
		alert("Please Select a Department");
		return;
	}
	if(year == ""){
		alert("Please Select Session");
		return;
	}
	
	$("#form1").submit()
}