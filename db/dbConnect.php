<?php 
include_once('../config/config.php');
 class dbConnect { 
    function __construct() {  

    } 
    public function getConnect()
    {
      try 
      {
        $conn = new PDO(DATABASE.":host=".DB_HOST.";dbname=".DB_DATABASE, DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }

      return $conn;
    }  
} 


?> 