<?php


namespace Db;

class DbMgmt
{
    const SERVERNAME = 'localhost';
    const PORT = "3306";
    const USERNAME = 'root';
    const PASSWORD = '';
    const DBNAME = 'universumphp';
    const CHARSET = 'utf8';
    public static $conn;

    public static function newConn()
    {
        try {
            self::$conn = new \PDO('mysql:host=' . self::SERVERNAME . ";port=" . self::PORT . ";charset=" . self::CHARSET, self::USERNAME, self::PASSWORD);
            self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $sql = 'USE ' . self::DBNAME;
            self::$conn->exec($sql);
            //  echo "Connection established <br>";

            return self::$conn;
        } catch (\PDOException $e) {
            echo $sql . '<br>' . $e->getMessage();
        }
    }
}