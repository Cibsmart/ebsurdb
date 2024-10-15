// JavaScript Document

function loadcourses(){
	var xmlhttp;
	var c = document.registercourse;
	var reg = c.reg_no.value;
	var ses = c.session.options[c.session.selectedIndex].value;
	var lev = c.level.options[c.level.selectedIndex].value;
	var sem = c.semester.options[c.semester.selectedIndex].value;
	var ses = c.session.options[c.session.selectedIndex].value
	
	if (reg == "" && ses != "" && lev != "" && sem != "" ){
		document.getElementById("course").innerHTML="";
		alert("Please Enter a Registration Number");
		return;
	}
	
	if (reg == "" || ses == "" || lev == "" || sem == "" ){
		return;
	}
	var cib = reg + "-" + ses + "-" + lev + "-" + sem;
	xmlhttp = getXMLHTTP();
	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById("course").innerHTML=xmlhttp.responseText;
	  }
	}
	xmlhttp.open("GET","ajaxcourse.php?a="+cib,true);
	xmlhttp.send();
}


function registercourses(str, str2){
	var xmlhttp;
	var reg = $("#reg_no").val();
	var ses = $("#session").val();
	var lev = $("#level").val();
	var sem = $("#semester").val();
	var cib = reg + "-" + ses + "-" + lev + "-" + sem  + "-" + str + "-" + str2;

	if (reg == "" && ses != "" && lev != "" && sem != "" ){
		alert("Please Enter a Registration Number");
		return;
	}
	document.getElementById("totals").innerHTML = "";
	if (reg == "" || ses == "" || lev == "" || sem == "" ){
		return;
	}
	xmlhttp = getXMLHTTP();
	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
		  if(xmlhttp.responseText == "error"){
			  alert("Maximum Credit Load Reached");
		  }
		  else{
			document.getElementById("totals").innerHTML=xmlhttp.responseText;
		  }
	  }
	}
	xmlhttp.open("GET","ajaxcourse.php?b="+cib,true);
	xmlhttp.send();
}


function getXMLHTTP(){
	var xmlhttp=null;
	try {
		xmlhttp=new XMLHttpRequest();
	}
		catch(e){
			try {
				xmlhttp=new ActiveXobject("Microsoft.XMLHTTP");
			}
				catch(e){
					try {
						xmlhttp=new ActiveXObject("msxml2.XMLHTTP");
					}
						catch(e1){
							xmlhttp=false;
						}
				}
		}
		return xmlhttp;
}
