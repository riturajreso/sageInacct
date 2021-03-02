<?php
error_reporting(E_ERROR | E_PARSE);
ini_set("display_errors", 1);
include_once('../db/dbConnect.php');
class dbFunction {  
   
    public function studentRegistration($fname, $lname, $dob, $ph)
    {  
        $db = new dbConnect();
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
            return json_encode(array('media_portal' => array('err' => 0, 'inserted' => 1,'msg'=>'','user_id'=>$id)));
        }
        catch(PDOException $ex){
            $db->rollback();
            return json_encode(array('media_portal' => array('err' => 1, 'inserted' => 0,'msg'=>$ex,'user_id'=>'')));
        }    
    }       
}  
?> 