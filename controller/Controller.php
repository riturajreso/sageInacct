<?php
	include_once('../modal/Modal.php');
	$funObj = new Modal();  
	$fun_type = $_REQUEST['function'];

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	if($fun_type == 'StudentRegistration')
	{
		$err = false;
		$error_array_name = [];
		if (empty($_REQUEST['fname'])){  
		    $error_array_name['fnameErr'] = "Error! You didn't enter the First Name.";
		    $err = true;   
		}
		else
		{  
		    $fName = test_input($_REQUEST['fname']);
		    if (!preg_match ("/^[a-zA-z]*$/", $fName)){
		    	$error_array_name['fnameErr'] = "Only alphabets and whitespace are allowed.";
		    	$err = true;  
		    }    
		}

		if (empty($_REQUEST['lname'])){  
		    $error_array_name['lnameErr'] = "Error! You didn't enter the Last Name.";   
		    $err = true;
		}
		else
		{  
		    $lname = test_input($_REQUEST['lname']);
		    if (!preg_match ("/^[a-zA-z]*$/", $lname)){
		    	$error_array_name['lnameErr'] = "Only alphabets and whitespace are allowed.";
		    	$err = true;  
		    }  
		}

		if (empty($_REQUEST['dob'])){  
		    $error_array_name['dob'] = "Error! You didn't enter the DOB.";
		    $err = true;   
		}
		else
		{  
		    $dob = test_input($_REQUEST['dob']);  
		}

		if (empty($_REQUEST['phno'])){  
		    $error_array_name['dobErr'] = "Error! You didn't enter the Phone No.";
		    $err = true;   
		}
		else
		{  
		    $phno = test_input($_REQUEST['phno']);
		    if (!preg_match ("/^[0-9]*$/", $phno)){
		    	$error_array_name['phnoErr'] = "Only numeric value is allowed.";
		    	$err = true;    
		    }
			$length = strlen ($phno);  
			if ( $length < 10 && $length > 10) {  
			    $error_array_name['phnoErr'] = "Mobile must have 10 digits.";
			    $err = true;
			}        
		}
		if($err == true){
			echo json_encode(array('portal'=>(array('err'=>1 ,'error_array_name'=>$error_array_name))));
		}
		else
		{
			$result =  json_decode($funObj->isStudentExist($phno),true);
			if($result['portal']['exists_count']==0)
			{
				echo $funObj->studentRegistration($fName, $lname, $dob, $phno);		
			}
			else
			{
				echo json_encode(array('portal' => array('err' => 1, 'inserted' => 0,'msg'=>'Already Exist')));
			}	
		}					
	}
	else if($fun_type == 'CourseRegistration')
	{
		$err = false;
		$error_array_name = [];
		if (empty($_REQUEST['cname'])){  
		    $error_array_name['cnameErr'] = "Error! You didn't enter the Course Name.";
		    $err = true;   
		}
		else
		{  
		    $cname = test_input($_REQUEST['cname']);
		    if (!preg_match ("/^[a-zA-z]*$/", $cname)){
		    	$error_array_name['cnameErr'] = "Only alphabets and whitespace are allowed.";
		    	$err = true;  
		    }    
		}
		if (empty($_REQUEST['cDetail'])){  
		    $error_array_name['cDetailErr'] = "Error! You didn't enter the DOB.";
		    $err = true;   
		}
		else
		{  
		    $cDetail = test_input($_REQUEST['cDetail']);  
		}
		if($err == true){
			echo json_encode(array('portal'=>(array('err'=>2 ,'msg'=>'Error','error_array_name'=>$error_array_name))));
		}
		else
		{
			$result =  json_decode($funObj->iscourseExist($cname),true);
			if($result['portal']['exists_count']==0)
			{
				echo $funObj->courseRegistration($cname, $cDetail);		
			}
			else
			{
				echo json_encode(array('portal' => array('err' => 1, 'inserted' => 0,'msg'=>'Already Exist')));
			}	
		}
	}
    else if($fun_type == 'getStudentList')
    {
    	echo $funObj->getStudentList();	
    }
    else if($fun_type == 'getCourseList')
    {
    	echo $funObj->getCourseList();	
    }

?> 
