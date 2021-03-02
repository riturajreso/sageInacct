<?php
include_once ('../config/config.php');
class dbConnect
{
    private static $_instance;

    function __construct()
    {
        try
        {
            $this->conn = new PDO(DATABASE . ":host=" . DB_HOST . ";dbname=" . DB_DATABASE, DB_USER, DB_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (!self::$_instance)
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __clone()
    {
    }

    public function getConnect()
    {
        return $this->conn;
    }
}

?>
