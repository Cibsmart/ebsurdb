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
	
	if (reg == "" || n < 15 || n > 16){
		alert("Please Enter Correct Registration Number");
		return;
	}
	xmlhttp = getxmlhttp();
	//document.write(reg);
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
	xmlhttp.open("GET","sessRes.php?a="+reg,true);
	xmlhttp.send();
}