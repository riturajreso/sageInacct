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
    else if($fun_type == 'editStudentList')
    {
    	$stu_id = $_REQUEST['stu_id'];
    	if(isset($stu_id) && $stu_id!= null && $stu_id!= undefined)
    	{
    		echo $funObj->editStudentList($stu_id);	
    	}
    		
    }
    else if($fun_type == 'editCourse')
    {
    	$c_id = $_REQUEST['c_id'];
    	if(isset($c_id) && $c_id!= null && $c_id!= undefined)
    	{
    		echo $funObj->editCourse($c_id);	
    	}
    }
    else if($fun_type == 'updateStudent')
    {
    	$err = false;
		$error_array_name = [];
		$id = $_REQUEST['id'];
    	if(isset($id) && $id!= null && $id!= undefined)
    	{
    		$stu_id  =  $id;
    	}
    	else
    	{
    		$error_array_name['efnameErr'] = "Error! Please try again.";
		    $err = true;
    	}
		if (empty($_REQUEST['efname'])){  
		    $error_array_name['efnameErr'] = "Error! You didn't enter the First Name.";
		    $err = true;   
		}
		else
		{  
		    $efname = test_input($_REQUEST['efname']);
		    if (!preg_match ("/^[a-zA-z]*$/", $efname)){
		    	$error_array_name['fnameErr'] = "Only alphabets and whitespace are allowed.";
		    	$err = true;  
		    }    
		}

		if (empty($_REQUEST['elname'])){  
		    $error_array_name['elnameErr'] = "Error! You didn't enter the Last Name.";   
		    $err = true;
		}
		else
		{  
		    $elname = test_input($_REQUEST['elname']);
		    if (!preg_match ("/^[a-zA-z]*$/", $elname)){
		    	$error_array_name['lnameErr'] = "Only alphabets and whitespace are allowed.";
		    	$err = true;  
		    }  
		}
		if($err == true){
			echo json_encode(array('portal'=>(array('err'=>1 ,'error_array_name'=>$error_array_name))));
		}
		else
		{
			echo $funObj->updateStudentDetails($stu_id,$efname, $elname);	
		}
    }
    else if($fun_type == 'updateCourse')
    {
    	$err = false;
		$error_array_name = [];
		$id = $_REQUEST['id'];
    	if(isset($id) && $id!= null && $id!= undefined)
    	{
    		$cid  =  $id;
    	}
    	else
    	{
    		$error_array_name['eCnameErr'] = "Error! Please try again.";
		    $err = true;
    	}
		if (empty($_REQUEST['eCname'])){  
		    $error_array_name['eCnameErr'] = "Error! You didn't enter the Course Name.";
		    $err = true;   
		}
		else
		{  
		    $eCname = test_input($_REQUEST['eCname']);
		    if (!preg_match ("/^[a-zA-z]*$/", $eCname)){
		    	$error_array_name['eCnameErr'] = "Only alphabets and whitespace are allowed.";
		    	$err = true;  
		    }    
		}
		if($err == true){
			echo json_encode(array('portal'=>(array('err'=>1 ,'error_array_name'=>$error_array_name))));
		}
		else
		{
			echo $funObj->updateCourseDetails($cid,$eCname);	
		}	
    }
    else if($fun_type == 'delStudent')
    {
    	$err = false;
		$error_array_name = [];
		$id = $_REQUEST['id'];
    	if(isset($id) && $id!= null && $id!= undefined)
    	{
    		$cid  =  $id;
    	}
    	else
    	{
    		$error_array_name['error_log'] = "Error! Please try again.";
		    $err = true;
    	}
    	if($err == true){
			echo json_encode(array('portal'=>(array('err'=>1 ,'error_array_name'=>$error_array_name))));
		}
		else
		{
			echo $funObj->delStudent($cid);	
		}
    }
    else if($fun_type == 'delCourse')
    {
    	$err = false;
		$error_array_name = [];
		$id = $_REQUEST['id'];
    	if(isset($id) && $id!= null && $id!= undefined)
    	{
    		$cid  =  $id;
    	}
    	else
    	{
    		$error_array_name['error_log'] = "Error! Please try again.";
		    $err = true;
    	}
    	if($err == true){
			echo json_encode(array('portal'=>(array('err'=>1 ,'error_array_name'=>$error_array_name))));
		}
		else
		{
			echo $funObj->delCourse($cid);	
		}
    }
?> 
