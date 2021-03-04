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

    public function getStudentList() 
    {
        $db = dbConnect::getInstance();
        $connect = $db->getConnect();
        $pageCount = PAGINATION_COUNT;
        try 
        {
            $statement = $connect->prepare('SELECT stu_id,stu_name,stu_Lname, stu_phn, stu_dob FROM registration WHERE isActive = 1 LIMIT ? ');

            $statement->bindValue(1, $pageCount, PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);


            $smt = $connect->prepare('SELECT stu_id,stu_name,stu_Lname, stu_phn, stu_dob FROM registration WHERE isActive = 1');
            $smt->execute();
            $result = $smt->fetchAll(PDO::FETCH_ASSOC);

            $total_records = count($result);  
            $total_pages = ceil($total_records / $pageCount); 

            return json_encode(array('portal' => array('err' => 0, 'get' => 1,'msg'=>'success','result'=>$result,'total_page'=>$total_pages )));
        }
        catch(PDOException $ex){
            return json_encode(array('portal' => array('err' => 1, 'get' => 0,'msg'=>$ex,'result'=>'')));
        }
    }

    public function getCourseList() 
    {
        $db = dbConnect::getInstance();
        $connect = $db->getConnect();
        try 
        {
            $statement = $connect->prepare('SELECT cid,cname,cdetails FROM course WHERE isActive = 1');
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return json_encode(array('portal' => array('err' => 0, 'get' => 1,'msg'=>'success','result'=>$result)));
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
            $statement = $connect->prepare('UPDATE course SET isActive=:flag WHERE cid = (:cid)');
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
            $statement = $connect->prepare('UPDATE registration SET isActive=:flag WHERE stu_id = (:stu_id)');
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

    public function getReport()
    {
        $db = dbConnect::getInstance();
        $connect = $db->getConnect();
        try 
        {
            $statement = $connect->prepare('SELECT CONCAT(stu_name," ",stu_Lname) as Name, cname FROM course_registration LEFT JOIN course on course.cid = course_registration.cousre_id LEFT JOIN registration on registration.stu_id = course_registration.stud_id');
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
