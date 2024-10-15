// JavaScript Document
function uploadresults(){
	
		$("#flash").show();
		$("#flash").fadeIn(400).html('<img src="images/ajax-loader.gif" align="absmiddle"> <div style="font-size:18px; font-weight:bold; color:green;">Uploading Results.....</div>');
	var req = getXMLHTTP();
	document.getElementById("ajaxresult").innerHTML="";
	if(req==null)
	{
	alert("browser error");
	}
	if(req)
	{
		req.onreadystatechange=function() {
		if(req.readyState == 4 && req.status==200) {
			$("#flash").hide();
			document.getElementById("ajaxresult").innerHTML=req.responseText;
		}
		}
		req.open("GET","doUpload.php?a=true",true);
		req.send();
	}
}

function uploadmedicalresults(){
	
		$("#flash").show();
		$("#flash").fadeIn(400).html('<img src="images/ajax-loader.gif" align="absmiddle"> <div style="font-size:18px; font-weight:bold; color:green;">Uploading Results.....</div>');
	var req = getXMLHTTP();
	document.getElementById("ajaxresult").innerHTML="";
	if(req==null)
	{
	alert("browser error");
	}
	if(req)
	{
		req.onreadystatechange=function() {
		if(req.readyState == 4 && req.status==200) {
			$("#flash").hide();
			document.getElementById("ajaxresult").innerHTML=req.responseText;
		}
		}
		req.open("GET","doUploadMedical.php?a=true",true);
		req.send();
	}
}

function uploadfinalresults(){
	
		$("#flash").show();
		$("#flash").fadeIn(400).html('<img src="images/ajax-loader.gif" align="absmiddle"> <div style="font-size:18px; font-weight:bold; color:green;">Uploading Results.....</div>');
	var req = getXMLHTTP();
	document.getElementById("ajaxresult").innerHTML="";
	if(req==null)
	{
	alert("browser error");
	}
	if(req)
	{
		req.onreadystatechange=function() {
		if(req.readyState == 4 && req.status==200) {
			$("#flash").hide();
			document.getElementById("ajaxresult").innerHTML=req.responseText;
		}
		}
		req.open("GET","doUploadFinal.php?a=true",true);
		req.send();
	}
}


function uploadnominal(){
	
		$("#flash").show();
		$("#flash").fadeIn(400).html('<img src="images/ajax-loader.gif" align="absmiddle"> <div style="font-size:18px; font-weight:bold; color:green;">Uploading Nominal Roll.....</div>');
	var req = getXMLHTTP();
	document.getElementById("ajaxresult").innerHTML="";
	if(req==null)
	{
	alert("browser error");
	}
	if(req)
	{
		req.onreadystatechange=function() {
		if(req.readyState == 4 && req.status==200) {
			$("#flash").hide();
			document.getElementById("ajaxresult").innerHTML=req.responseText;
		}
		}
		req.open("GET","doUploadNominal.php?b=true",true);
		req.send();
	}
}

function uploadsesslist(){
	
		$("#flash").show();
		$("#flash").fadeIn(400).html('<img src="images/ajax-loader.gif" align="absmiddle"> <div style="font-size:18px; font-weight:bold; color:green;">Uploading Sessional Course List.....</div>');
	var req = getXMLHTTP();
	document.getElementById("ajaxresult").innerHTML="";
	if(req==null)
	{
	alert("browser error");
	}
	if(req)
	{
		req.onreadystatechange=function() {
		if(req.readyState == 4 && req.status==200) {
			$("#flash").hide();
			document.getElementById("ajaxresult").innerHTML=req.responseText;
		}
		}
		req.open("GET","doUploadSessList.php?a=true",true);
		req.send();
	}
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

