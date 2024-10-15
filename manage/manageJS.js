// JavaScript Document
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

function loadsession(regs){
	var xmlhttp;
	var reg = regs;
	var n = reg.length;
	
	//if (reg == "" || n < 15 || n > 16){
//		alert("Please Enter Correct Registration Number");
//	}
	xmlhttp = getxmlhttp();
	xmlhttp.onreadystatechange = function(){
	  if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
		  if(xmlhttp.responseText == "error"){
			alert("No Sessional Results for this Registration Number");  
		  }
		  else{
			document.getElementById("session").innerHTML = xmlhttp.responseText;
		  }
	  }
	}
	xmlhttp.open("GET","sessMan.php?a="+reg,true);
	xmlhttp.send();
}



function loadsemester(){
	var xmlhttp;
	var reg = $("#reg_no").val();
	var sess = $("#session").val();
	var n = reg.length;
	var send = reg + "^" + sess;
	
	xmlhttp = getxmlhttp();
	//document.write(reg);
	xmlhttp.onreadystatechange = function(){
	  if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
		  if(xmlhttp.responseText == "error"){
			//alert("No Sessional Results for this Registration Number");  
		  }
		  else{
			document.getElementById("semester").innerHTML = xmlhttp.responseText;
		  }
	  }
	}
	xmlhttp.open("GET","sessMan.php?b="+send,true);
	xmlhttp.send();
}

function loadcode(){
	var xmlhttp;
	var reg = $("#reg_no").val();
	var sess = $("#session").val();
	var sem = $("#semester").val()
	var send = reg + "^" + sess + "^" + sem;
	
	xmlhttp = getxmlhttp();

	xmlhttp.onreadystatechange = function(){
	  if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
		  if(xmlhttp.responseText == "error"){
			alert("No Results for this Registration Number");  
		  }
		  else{
			document.getElementById("code").innerHTML = xmlhttp.responseText;
		  }
	  }
	}
	xmlhttp.open("GET","sessMan.php?c="+send,true);
	xmlhttp.send();
}




function loadcourse(){
	var xmlhttp;
	var reg = $("#reg_no").val();
	var sess = $("#session").val();
	var sem = $("#semester").val()
	var cod = $("#code").val()
	var send = reg + "^" + sess + "^" + sem + "^" + cod;
	document.getElementById("result").innerHTML = "";
	//document.write(send);
	xmlhttp = getxmlhttp();

	xmlhttp.onreadystatechange = function(){
	  if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
		  if(xmlhttp.responseText == "error"){
			alert("No Results for this Registration Number");  
		  }
		  else{
			document.getElementById("result").innerHTML = xmlhttp.responseText;
		  }
	  }
	}
	xmlhttp.open("GET","sessMan.php?d="+send,true);
	xmlhttp.send();
}




function loadmail(){
	var xmlhttp;
	var reg = $("#reg_no").val();
	
	document.getElementById("result").innerHTML = "";
	xmlhttp = getxmlhttp();

	xmlhttp.onreadystatechange = function(){
	  if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
		  if(xmlhttp.responseText == "error"){
			alert("No Results for this Registration Number");  
		  }
		  else{
			document.getElementById("result").innerHTML = xmlhttp.responseText;
		  }
	  }
	}
	xmlhttp.open("GET","sessMan.php?e="+reg,true);
	xmlhttp.send();
}

