// JavaScript Document
//AJAX Function to add Faculty
function facultyadd(){
	var xmlhttp;
	var cib = document.faculty.faculty_name.value;
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
		document.getElementById("faculties").innerHTML=xmlhttp.responseText;
		document.getElementById("faculty_name").text="";
		document.getElementById("faculty_name").innerHTML="";
		}
	  }
	xmlhttp.open("GET","ajaxes.php?a="+cib,true);
	xmlhttp.send();
}
//AJAX function to edit faculty

function facultyedit(){
	var xmlhttp;
	var c = document.faculty.faculties;
	var cib = c.options[c.selectedIndex].value;
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
		//document.getElementById("faculties").innerHTML=xmlhttp.responseText;
		document.getElementById("faculty_name").innerHTML = xmlhttp.responseText;
		
		}
	  }
	xmlhttp.open("GET","ajaxes.php?b="+cib,true);
	xmlhttp.send();
}


//AJAX function to remove faculty
function facultyremove(){
	var xmlhttp;
	var c = document.faculty.faculties;
	var cib = c.options[c.selectedIndex].value;
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
		document.getElementById("faculties").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","ajaxes.php?b="+cib,true);
	xmlhttp.send();
}


//AJAX function to add dept
function deptadd(){
	var xmlhttp;
	var ify = document.department;
	var dep = ify.dept_name.value;
	var fac = ify.faculties.options[ify.faculties.selectedIndex].value;
	var cib = fac + "-" + dep;
	
	if(dep == ""){
		alert("No New Department Name Entered");
		return;
	}
	if (fac == ""){
		alert("Please Select a Faculty");
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
		document.getElementById("departments").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","ajaxes.php?c="+cib,true);
	xmlhttp.send();
}
	
//AJAX function to remove dept
function deptremove(){
	var xmlhttp;
	var c = document.department.departments;
	var d = c.options[c.selectedIndex].value;
	var e = document.department.faculties.options[document.department.faculties.selectedIndex].value;
	var cib = e + "-" + d;
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
		document.getElementById("departments").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","ajaxes.php?e="+cib,true);
	xmlhttp.send();
}
function filldept(cib){
	var ckahttp;
	if (cib.length == 0){ 
	  document.getElementById("departments").innerHTML="";
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
			document.getElementById("departments").innerHTML=ckahttp.responseText;
		}
	}
	ckahttp.open("GET","ajaxes.php?f="+cib,true);
	ckahttp.send();
}

function courseslist(){
	var xmlhttp; var d = document;
	var c = document.course;
	var fac = c.faculty.options[c.faculty.selectedIndex].value;
	var dep = c.departments.options[c.departments.selectedIndex].value;
	var lev = c.level.options[c.level.selectedIndex].value;
	var sem = c.semester.options[c.semester.selectedIndex].value;

	var cib = fac + "-" + dep + "-" + lev + "-" + sem;
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
		document.getElementById("courses").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","ajaxes.php?g="+cib,true);
	xmlhttp.send();
}

function addcourses(){
	var xmlhttp;
	var c = document.course;
	var fac = c.faculty.options[c.faculty.selectedIndex].value;
	var dep = c.departments.options[c.departments.selectedIndex].value;
	var lev = c.level.options[c.level.selectedIndex].value;
	var sem = c.semester.options[c.semester.selectedIndex].value;
	var cod = c.code.value;
	var tit = c.title.value;
	var lod = c.cload.options[c.cload.selectedIndex].value;
	var spe = c.spec.options[c.spec.selectedIndex].value;
	if (fac == "" || dep == "" || lev == "" || sem == "" || cod == "" || tit == "" || lod == "" || spe == ""){
		alert();
		return;
	}
	var cib = fac + "-" + dep + "-" + lev + "-" + sem+ "-" + cod + "-" + tit + "-" + lod + "-" + spe;
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
		document.getElementById("courses").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","ajaxes.php?h="+cib,true);
	xmlhttp.send();
}

function removecourses(){
	var xmlhttp;
	var c = document.course;
	var id = c.courses.options[c.courses.selectedIndex].value;
	var fac = c.faculty.options[c.faculty.selectedIndex].value;
	var dep = c.departments.options[c.departments.selectedIndex].value;
	var lev = c.level.options[c.level.selectedIndex].value;
	var sem = c.semester.options[c.semester.selectedIndex].value;

	if (id == ""){
		return;
	}
	var cib = id + "-" + fac + "-" + dep + "-" + lev + "-" + sem;
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
		document.getElementById("courses").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","ajaxes.php?i="+cib,true);
	xmlhttp.send();
}

function totalload(){
	var xmlhttp; var d = document;
	var c = document.course;
	var fac = c.faculty.options[c.faculty.selectedIndex].value;
	var dep = c.departments.options[c.departments.selectedIndex].value;
	var lev = c.level.options[c.level.selectedIndex].value;
	var sem = c.semester.options[c.semester.selectedIndex].value;

	var cib = fac + "-" + dep + "-" + lev + "-" + sem;
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
		document.getElementById("total").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","ajaxes.php?j="+cib,true);
	xmlhttp.send();
}

function courseslist2(){
	var xmlhttp; var d = document;
	var c = document.course;
	var fac = c.faculty.options[c.faculty.selectedIndex].value;
	var dep = c.departments.options[c.departments.selectedIndex].value;
	var lev = c.level.options[c.level.selectedIndex].value;
	var sem = c.semester.options[c.semester.selectedIndex].value;
	var ses = c.session.options[c.session.selectedIndex].value;

	var cib = fac + "-" + dep + "-" + lev + "-" + sem + "-" + ses;
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
		document.getElementById("courses2").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","ajaxes.php?k="+cib,true);
	xmlhttp.send();
}

function selectedcourses(){
	var xmlhttp; var d = document;
	var c = document.course;
	var fac = c.faculty.options[c.faculty.selectedIndex].value;
	var dep = c.departments.options[c.departments.selectedIndex].value;
	var lev = c.level.options[c.level.selectedIndex].value;
	var sem = c.semester.options[c.semester.selectedIndex].value;
	var ses = c.session.options[c.session.selectedIndex].value;
	var cod = c.courses.options[c.courses.selectedIndex].value;

	var cib = fac + "-" + dep + "-" + lev + "-" + sem + "-" + ses + "-" + cod;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}
	else{// code for IE6, IE5
	  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById("courses2").innerHTML=xmlhttp.responseText;
	  }
	}
	xmlhttp.open("GET","ajaxes.php?l="+cib,true);
	xmlhttp.send();
}

function unselectedcourses(){
	var xmlhttp;
	var c = document.course;
	var fac = c.faculty.options[c.faculty.selectedIndex].value;
	var dep = c.departments.options[c.departments.selectedIndex].value;
	var lev = c.level.options[c.level.selectedIndex].value;
	var sem = c.semester.options[c.semester.selectedIndex].value;
	var ses = c.session.options[c.session.selectedIndex].value;
	var cod = c.courses2.options[c.courses2.selectedIndex].value;

	if(cod == ""){
		alert("Select a Course to Remove");
		return
	}

	var cib = fac + "-" + dep + "-" + lev + "-" + sem + "-" + ses + "-" + cod;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}
	else{// code for IE6, IE5
	  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById("courses2").innerHTML=xmlhttp.responseText;
	  }
	}
	xmlhttp.open("GET","ajaxes.php?m="+cib,true);
	xmlhttp.send();
}