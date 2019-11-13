<?php

namespace App\Controllers;


class Connection{

    private static $con;

    public function __construct(){
      
    }

    public static function getConn(){

        if (!isset(self::$con)) {
            self::$con = new \PDO('mysql:host=eu-cdbr-west-02.cleardb.net;dbname=heroku_0d83fce646e0f00', 'b16b028e316d09', '5bc8e0ac',array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")) or die("Cannot Create PDO!");
            self::$con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$con->setAttribute(\PDO::ATTR_ORACLE_NULLS, \PDO::NULL_EMPTY_STRING);
        }
 
        return self::$con;
    }

}