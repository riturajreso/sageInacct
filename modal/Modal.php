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
        try 
        {
            $statement = $connect->prepare('SELECT stu_id,stu_name,stu_Lname, stu_phn, stu_dob FROM registration');
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return json_encode(array('portal' => array('err' => 0, 'get' => 1,'msg'=>'success','result'=>$result)));
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
            $statement = $connect->prepare('SELECT cid,cname,cdetails FROM course');
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            return json_encode(array('portal' => array('err' => 0, 'get' => 1,'msg'=>'success','result'=>$result)));
        }
        catch(PDOException $ex){
            return json_encode(array('portal' => array('err' => 1, 'get' => 0,'msg'=>$ex,'result'=>'')));
        }
    }       
}  
?> 
