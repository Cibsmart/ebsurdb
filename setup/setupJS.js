// JavaScript Document


function processsum(){
	
	var ses = $("#session").val();
	
	if(ses == ""){
		alert("Please Select a Session");
		return;
	}
	
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