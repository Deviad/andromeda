<?php


namespace App\Db;

class DbMgmt extends \PDO
{
    const SERVERNAME = 'localhost';
    const PORT = "3306";
    const USERNAME = 'root';
    const PASSWORD = '';
    const DBNAME = 'andromeda';
    const CHARSET = 'utf8';


    public $conn;

   // private static $instance = false;

    public function __construct () {
        $this->newConn();


    }

    public  function newConn()
    {


            try {
                parent::__construct('mysql:host=' . self::SERVERNAME . ";port=" . self::PORT . ";dbname=" . self::DBNAME . ";charset=" . self::CHARSET, self::USERNAME, self::PASSWORD);
                $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                //  echo "Connection established <br>";


            } catch (\PDOException $e) {
                echo   $e->getMessage();
            }




            return $this->conn;

    }
}
