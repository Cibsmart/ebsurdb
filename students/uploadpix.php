<?php
$uploaddir = './passports/';
$cib = basename($_FILES['uploadfile']['name']);
$uploadfile = $uploaddir . $cib;


if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfile)) {
	$reg_no = $_REQUEST['cc'];
	$pix_reg_no  = str_replace("/",".",$reg_no);
	rename($uploaddir . $cib, $uploaddir . $pix_reg_no);
    echo "success";
} else {
    echo "error";
}



//$newdir = $uploaddir . $reg_no;

//echo "<img src = '$newdir' alt = 'Passport' height = '192' width = '144' />";

?>