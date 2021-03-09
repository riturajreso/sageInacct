<?php
error_reporting(E_ERROR | E_PARSE);
ini_set("display_errors", 1);
include_once('../db/dbConnect.php');
class Modal {  
   
    public function isStudentExist($ph)
    {  
        $db = dbConnect::getInstance();
        $connect = $db->getConnect();
        try 
        {
            $statement = $connect->prepare('SELECT stu_id FROM registration WHERE stu_phn LIKE(:ph)');
            $data = [
                'ph' => $ph
            ];
            $statement->execute($data);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return json_encode(array('portal' => array('err' => 0, 'inserted' => 0,'msg'=>'success','exists_count'=>count($result))));
        }
        catch(PDOException $ex){
            return json_encode(array('portal' => array('err' => 1, 'inserted' => 0,'msg'=>$ex,'exists_count'=>'')));
        }    
    }

    public function studentRegistration($fname, $lname, $dob, $ph)
    {  
        $db = dbConnect::getInstance();
        $connect = $db->getConnect();
        try 
        {
            $connect->beginTransaction();
            $statement = $connect->prepare('INSERT INTO registration (stu_name,stu_Lname, stu_phn, stu_dob)
                VALUES (:fname, :lname, :phn, :dob)');
            $data = [
                'fname' => $fname,
                'lname' => $lname,
                'phn' => $ph,
                'dob' => $dob,
            ];
            $statement->execute($data);
            $id = $connect->lastInsertId();
            $connect->commit();
            return json_encode(array('portal' => array('err' => 0, 'inserted' => 1,'msg'=>'success','user_id'=>$id)));
        }
        catch(PDOException $ex){
            $db->rollback();
            return json_encode(array('portal' => array('err' => 1, 'inserted' => 0,'msg'=>$ex,'user_id'=>'')));
        }    
    }

    public function iscourseExist($cname)
    {  
        $db = dbConnect::getInstance();
        $connect = $db->getConnect();
        try 
        {
            $statement = $connect->prepare('SELECT cid FROM course WHERE cname LIKE(:cname)');
            $data = [
                'cname' => $cname
            ];
            $statement->execute($data);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return json_encode(array('portal' => array('err' => 0, 'inserted' => 0,'msg'=>'success','exists_count'=>count($result))));
        }
        catch(PDOException $ex){
            return json_encode(array('portal' => array('err' => 1, 'inserted' => 0,'msg'=>$ex,'exists_count'=>'')));
        }    
    }

    public function courseRegistration($cname, $cDetails)
    {  
        $db = dbConnect::getInstance();
        $connect = $db->getConnect();
        try 
        {
            $connect->beginTransaction();
            $statement = $connect->prepare('INSERT INTO course (cname,cdetails)
                VALUES (:cname, :cdetails)');
            $data = [
                'cname' => $cname,
                'cdetails' => $cDetails,
            ];
            $statement->execute($data);
            $id = $connect->lastInsertId();
            $connect->commit();
            return json_encode(array('portal' => array('err' => 0, 'inserted' => 1,'msg'=>'success','course_id'=>$id)));
        }
        catch(PDOException $ex){
            $db->rollback();
            return json_encode(array('portal' => array('err' => 1, 'inserted' => 0,'msg'=>$ex,'course_id'=>'')));
        }    
    }

    public function getStudentList($page,$sort,$sort_type) 
    {
        $db = dbConnect::getInstance();
        $connect = $db->getConnect();
        try 
        {   $page = $page;
            $limit = 10;
            $starting_limit = ($page-1)*$limit;
            if($sort_type == "" || $sort == ""){
                $sort_condition = " ORDER BY stu_id DESC ";
            }
            else if($sort == "firstName"){
                $sort_condition = " ORDER BY stu_name ".$sort_type;
            }
            else if($sort == "lastName"){
                $sort_condition = " ORDER BY stu_Lname ".$sort_type;
            }
            
            $statement = $connect->prepare('SELECT stu_id,stu_name,stu_Lname, stu_phn, stu_dob FROM registration WHERE isActive = 1 '.$sort_condition.' LIMIT ?,?');
            $statement->execute([$starting_limit, $limit]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            $smt = $connect->prepare('SELECT stu_id,stu_name,stu_Lname, stu_phn, stu_dob FROM registration WHERE isActive = 1');
            $smt->execute();
            $result2 = $smt->fetchAll(PDO::FETCH_ASSOC);

            $total_records = count($result2);  
            $total_pages = ceil($total_records / $limit); 

            return json_encode(array('portal' => array('err' => 0, 'get' => 1,'msg'=>'success','result'=>$result,'total_page'=>$total_pages)));
        }
        catch(PDOException $ex){
            return json_encode(array('portal' => array('err' => 1, 'get' => 0,'msg'=>$ex,'result'=>'')));
        }
    }

    public function getCourseList($page,$sort,$sort_type) 
    {
        $db = dbConnect::getInstance();
        $connect = $db->getConnect();
        try 
        {
            $page = $page;
            $limit = 10;
            $starting_limit = ($page-1)*$limit;
            if($sort_type == "" || $sort == ""){
                $sort_condition = " ORDER BY cid DESC ";
            }
            else if($sort == "couseName"){
                $sort_condition = " ORDER BY cname ".$sort_type;
            }
           
            $statement = $connect->prepare('SELECT cid,cname,cdetails FROM course WHERE isActive = 1 '.$sort_condition.' LIMIT ?,?' );
            $statement->execute([$starting_limit, $limit]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            $smt = $connect->prepare('SELECT cid,cname,cdetails FROM course WHERE isActive = 1');
            $smt->execute();
            $result2 = $smt->fetchAll(PDO::FETCH_ASSOC);

            $total_records = count($result2);  
            $total_pages = ceil($total_records / $limit); 

            return json_encode(array('portal' => array('err' => 0, 'get' => 1,'msg'=>'success','result'=>$result,'total_page'=>$total_pages)));
        }
        catch(PDOException $ex){
            return json_encode(array('portal' => array('err' => 1, 'get' => 0,'msg'=>$ex,'result'=>'')));
        }
    } 

    public function editStudentList($stu_id)
    {  
        $db = dbConnect::getInstance();
        $connect = $db->getConnect();
        try 
        {
            $statement = $connect->prepare('SELECT stu_name,stu_Lname FROM registration WHERE stu_id LIKE(:stu_id)');
            $data = [
                'stu_id' => $stu_id
            ];
            $statement->execute($data);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return json_encode(array('portal' => array('err' => 0, 'get' => 0,'msg'=>'success','result'=>$result)));
        }
        catch(PDOException $ex){
            return json_encode(array('portal' => array('err' => 1, 'get' => 0,'msg'=>$ex,'result'=>'')));
        }    
    } 

    public function editCourse($c_id)
    {  
        $db = dbConnect::getInstance();
        $connect = $db->getConnect();
        try 
        {
            $statement = $connect->prepare('SELECT cname FROM course WHERE cid LIKE(:c_id)');
            $data = [
                'c_id' => $c_id
            ];

            $statement->execute($data);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return json_encode(array('portal' => array('err' => 0, 'get' => 1,'msg'=>'success','result'=>$result)));
        }
        catch(PDOException $ex){
            return json_encode(array('portal' => array('err' => 1, 'get' => 0,'msg'=>$ex,'result'=>'')));
        }    
    } 

    public function updateCourseDetails($cid,$eCname)
    {  
        $db = dbConnect::getInstance();
        $connect = $db->getConnect();
        try 
        {
            $statement = $connect->prepare('UPDATE course SET cname=(:eCname) WHERE cid = (:cid)');
            $data = [
                'eCname' => $eCname,
                'cid'=>$cid
            ];
            $statement->execute($data);
            
            return json_encode(array('portal' => array('err' => 0, 'update' => 1,'msg'=>'success')));
        }
        catch(PDOException $ex){
            return json_encode(array('portal' => array('err' => 1, 'update' => 0,'msg'=>$ex)));
        }    
    }

    public function updateStudentDetails($stu_id,$efname,$elname)
    {  
        $db = dbConnect::getInstance();
        $connect = $db->getConnect();
        try 
        {
            $statement = $connect->prepare('UPDATE registration SET stu_name=:efname,stu_Lname=:elname WHERE stu_id = (:stu_id)');
            $data = [
                'efname' => $efname,
                'elname'=>$elname,
                'stu_id' => $stu_id
            ];
            
            $statement->execute($data);
            
            return json_encode(array('portal' => array('err' => 0, 'update' => 1,'msg'=>'success')));
        }
        catch(PDOException $ex){
            return json_encode(array('portal' => array('err' => 1, 'update' => 0,'msg'=>$ex)));
        }    
    }

    public function delCourse($cid)
    {  
        $db = dbConnect::getInstance();
        $connect = $db->getConnect();
        try 
        {
            $statement = $connect->prepare('DELETE FROM `course` WHERE cid = (:cid)');
            $data = [
                'flag'=> 0,
                'cid'=>$cid
            ];
            $statement->execute($data);
            
            return json_encode(array('portal' => array('err' => 0, 'update' => 1,'msg'=>'success')));
        }
        catch(PDOException $ex){
            return json_encode(array('portal' => array('err' => 1, 'update' => 0,'msg'=>$ex)));
        }    
    }

    public function delStudent($stu_id)
    {  
        $db = dbConnect::getInstance();
        $connect = $db->getConnect();
        try 
        {
            $statement = $connect->prepare('DELETE FROM `registration` WHERE stu_id = (:stu_id)');
            $data = [
                'flag'=> 0,
                'stu_id' => $stu_id
            ];
            
            $statement->execute($data);
            
            return json_encode(array('portal' => array('err' => 0, 'update' => 1,'msg'=>'success')));
        }
        catch(PDOException $ex){
            return json_encode(array('portal' => array('err' => 1, 'update' => 0,'msg'=>$ex)));
        }    
    }

    public function saveMapping($sel_stu_id,$sel_cor_id)
    {
        $db = dbConnect::getInstance();
        $connect = $db->getConnect();
        try 
        {
            $connect->beginTransaction();
            $statement = $connect->prepare('INSERT INTO course_registration (stud_id,cousre_id)
                VALUES (:sel_stu_id, :sel_cor_id)');
            $data = [
                'sel_stu_id' => $sel_stu_id,
                'sel_cor_id' => $sel_cor_id,
            ];
            $statement->execute($data);
            $id = $connect->lastInsertId();
            $connect->commit();
            return json_encode(array('portal' => array('err' => 0, 'inserted' => 1,'msg'=>'success','mapping_id'=>$id)));
        }
        catch(PDOException $ex){
            $db->rollback();
            return json_encode(array('portal' => array('err' => 1, 'inserted' => 0,'msg'=>$ex,'mapping_id'=>'')));
        }    
    }

    public function getReport($sStudentName,$sCourseName)
    {
        $db = dbConnect::getInstance();
        $connect = $db->getConnect();
        try 
        {
            if(!empty($sStudentName))
            {
                $cond = " WHERE stu_name LIKE '%$sStudentName%' OR stu_Lname LIKE '%$sStudentName%'";
            }
            else if(!empty($sCourseName))
            {
                $cond = " WHERE cname LIKE '%$sCourseName%'";
            }
            else if(!empty($sCourseName) && !empty($sStudentName))
            {
                $cond = " WHERE cname LIKE '%$sCourseName%' AND (stu_name LIKE '%$sStudentName%' OR stu_Lname LIKE '%$sStudentName%')";
            }

            $statement = $connect->prepare('SELECT CONCAT(stu_name," ",stu_Lname) as Name, cname FROM course_registration JOIN course on course.cid = course_registration.cousre_id JOIN registration on registration.stu_id = course_registration.stud_id AND registration.isActive = 1'.$cond);

            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return json_encode(array('portal' => array('err' => 0, 'inserted' => 0,'msg'=>'success','result'=>$result)));
        }
        catch(PDOException $ex){
            return json_encode(array('portal' => array('err' => 1, 'inserted' => 0,'msg'=>$ex,'result'=>'')));
        }
    }    
}  
?> 
