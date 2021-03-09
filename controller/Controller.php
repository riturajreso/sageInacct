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
		$cDetail = test_input($_REQUEST['cDetail']);
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
    	$page = $_REQUEST['page'];
    	$sort = $_REQUEST['sort'];
    	$sort_type = $_REQUEST['sort_type'];
    	if(isset($page) && $page!= null)
    	{	
    		echo $funObj->getStudentList($page,$sort,$sort_type);	
    	}	
    }
    else if($fun_type == 'getCourseList')
    {
    	$page = $_REQUEST['page'];
    	$sort = $_REQUEST['csort'];
    	$sort_type = $_REQUEST['csort_type'];
    	if(isset($page) && $page!= null)
    	{
    		echo $funObj->getCourseList($page,$sort,$sort_type);
    	}	
    }
    else if($fun_type == 'editStudentList')
    {
    	$stu_id = $_REQUEST['stu_id'];
    	if(isset($stu_id) && $stu_id!= null)
    	{
    		echo $funObj->editStudentList($stu_id);	
    	}
    		
    }
    else if($fun_type == 'editCourse')
    {
    	$c_id = $_REQUEST['c_id'];
    	if(isset($c_id) && $c_id!= null)
    	{
    		echo $funObj->editCourse($c_id);	
    	}
    }
    else if($fun_type == 'updateStudent')
    {
    	$err = false;
		$error_array_name = [];
		$id = $_REQUEST['id'];
    	if(isset($id) && $id!= null)
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
    	if(isset($id) && $id!= null)
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
    	if(isset($id) && $id!= null)
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
    	if(isset($id) && $id!= null)
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
    else if($fun_type == 'getAllDetails')
    {
    	$sort = $_REQUEST['sort'];
    	$sort_type = $_REQUEST['sort_type'];
    	$finalArray = [];
    	$studentList = $funObj->getStudentList(1,$sort,$sort_type);
    	$studentList = json_decode($studentList,true);
    	if($studentList['portal']['err'] == 0)
    	{
    		$finalArray['student'] = $studentList['portal']['result'];
    	}
    	$sort = $_REQUEST['csort'];
    	$sort_type = $_REQUEST['csort_type'];
    	$courseList = $funObj->getCourseList(1,$sort,$sort_type);	
    	$courseList = json_decode($courseList,true);
    	if($courseList['portal']['err'] == 0)
    	{
    		$finalArray['course'] = $courseList['portal']['result'];
    	}
    	echo json_encode($finalArray);
    }
    else if($fun_type == 'saveMapping')
    {
    	$err = false;
		$error_array_name = [];
		$sel_stu = $_REQUEST['sel_stu'];
		$sel_cor = $_REQUEST['sel_cor'];
    	if(isset($sel_stu) && $sel_stu!= null)
    	{
    		$sel_stu_id  =  $sel_stu;
    	}
    	else
    	{
    		$error_array_name['stu_subErr'] = "Error! Please try again.";
		    $err = true;
    	}
    	if(isset($sel_cor) && $sel_cor!= null)
    	{
    		$sel_cor_id  =  $sel_cor;
    	}
    	else
    	{
    		$error_array_name['cour_subErr'] = "Error! Please try again.";
		    $err = true;
    	}
    	if($err == true){
			echo json_encode(array('portal'=>(array('err'=>1 ,'error_array_name'=>$error_array_name))));
		}
		else
		{
			echo $funObj->saveMapping($sel_stu_id,$sel_cor_id);	
		}
    }
    else if($fun_type == 'getReport')
    {
    	$sStudentName = $_REQUEST['sStudentName'];
		$sCourseName = $_REQUEST['sCourseName'];
    	echo $funObj->getReport($sStudentName,$sCourseName);	
    }
?> 
