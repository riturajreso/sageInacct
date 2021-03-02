<?php
	include_once('../modal/dbFunction.php');
	$funObj = new dbFunction();  
	
	$fun_type = $_REQUEST['function'];
	if($fun_type == 'registration')
	{
		$fName = $_REQUEST['fname'];
		$lname = $_REQUEST['lname'];
		$dob = $_REQUEST['dob'];
		$phno = $_REQUEST['phno'];
		
		echo $funObj->studentRegistration($fName, $lname, $dob, $phno);
	}
    
?> 