<?php

/**
 * @author Davide Pugliese
 * @uses   PDO
 *
 * This is a little engine to run queries the smart way.
 *
 */

namespace App\Db;

class DbObj
{
    public  $the_table = null;
    public  $the_attrs = null;
    public  $projection = null;
    public  $the_values;
    public  $dbConnection;

    public function __construct (DbMgmt $connection) {
        $this->dbConnection = $connection;
    }

    public function addObj($the_table, $the_attrs, $the_values)
    {
//        echo "INTO THE GENERIC FUNCTION";
//        var_dump($the_table);
//        var_dump($the_attrs);
//        var_dump($the_values);
        $sql     = "INSERT INTO $the_table ( $the_attrs )  VALUES ( $the_values );";
//        var_dump($sql);

        $pdo_obj = $this->dbConnection->newConn(); //get the pdo object
        $stmt    = $pdo_obj->prepare($sql);

        var_dump($sql);

        $stmt->execute();
//        echo "Data inserted!";

    }

    public  function rmObj($the_table, $the_attrs, $the_values)
    {
        $sql     = "DELETE FROM $the_table WHERE ($the_attrs) =  ( $the_values );";
        $stmt    = $this->dbConnection->prepare($sql);
        $stmt->execute();
        echo "Data deleted!";
    }

    public  function getObj($projection, $the_table, $condition)
    {
        $sql = "SELECT {$projection} FROM {$the_table} {$condition}";

        $stmt    = $this->dbConnection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }
}