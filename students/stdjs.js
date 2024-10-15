// JavaScript Document
function filldays(str){
	var xmlhttp;
	if (str.length == 0)
	  { 
	  document.getElementById("dateday").innerHTML="";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("dateday").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","ajaxes.php?q="+str,true);
	xmlhttp.send();
}

//function to dynamically generate state list
function fillstate(cib){
	var ckahttp;
	if (cib.length == 0){ 
	  document.getElementById("stateoforigin").innerHTML="";
	  return;
	}
	if (window.XMLHttpRequest){
		// code for IE7+, Firefox, Chrome, Opera, Safari
	  	ckahttp=new XMLHttpRequest();
	}
	else{
		// code for IE6, IE5
	  	ckahttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	ckahttp.onreadystatechange=function(){
	  	if (ckahttp.readyState==4 && ckahttp.status==200){
			document.getElementById("stateoforigin").innerHTML=ckahttp.responseText;
			document.getElementById("lgaoforigin").innerHTML="";
		}
	}
	ckahttp.open("GET","ajaxes.php?p="+cib,true);
	ckahttp.send();
}


//function to dynamically generate lga list
function filllga(ifeco){
	var ckahttp;
	if (ifeco.length == 0)
	  { 
	  document.getElementById("lgaoforigin").innerHTML="";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  ckahttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  ckahttp = new ActiveXObject("Microsoft.XMLHTTP");
	  }
	ckahttp.onreadystatechange=function(){
	  if (ckahttp.readyState==4 && ckahttp.status==200)
		{
		document.getElementById("lgaoforigin").innerHTML=ckahttp.responseText;
		}
	}
	ckahttp.open("GET","ajaxes.php?r="+ifeco,true);
	ckahttp.send();
}


//function to dynamically generate dept list
function filldept(cib){
	var ckahttp;
	if (cib.length == 0){ 
	  document.getElementById("department").innerHTML="";
	  return;
	}
	if (window.XMLHttpRequest){
		// code for IE7+, Firefox, Chrome, Opera, Safari
	  	ckahttp=new XMLHttpRequest();
	}
	else{
		// code for IE6, IE5
	  	ckahttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	ckahttp.onreadystatechange=function(){
	  	if (ckahttp.readyState==4 && ckahttp.status==200){
			document.getElementById("department").innerHTML=ckahttp.responseText;
		}
	}
	ckahttp.open("GET","ajaxes.php?s="+cib,true);
	ckahttp.send();
}


//JQuery functions that calls the ajaxupload function for the dynamic image upload
$(function(){
		var btnUpload=$('#me');
		var mestatus=$('#mestatus');
		var cib = $('#cka').attr('title') ;
		var files=$('#files');
		new AjaxUpload(btnUpload, {
			action: 'uploadpix.php?cc='+cib,
			name: 'uploadfile',
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					mestatus.text('Only JPG, PNG or GIF files are allowed');
					return false;
				}
				mestatus.html('<img src="../images/ajax-loader.gif" height="16" width="16">');
			},
			onComplete: function(file, response){
				//On completion clear the status
				mestatus.text('Photo Uploaded Sucessfully!');
				//On completion clear the status
				files.html('');
				//Add uploaded file to list
				if(response==="success"){
					$('<li></li>').appendTo('#files').html('<img src="./passports/'+ cib +'" alt="" height="190" width="144" /><br />').addClass('success');
				} else{
					$('<li></li>').appendTo('#files').text(file).addClass('error');
				}
			}
		});
		
	});