<?php

namespace App\Controllers;


class DAO{

    private $con;

    public function __construct(){
        $con = new PDO("mysql://b16b028e316d09:5bc8e0ac@eu-cdbr-west-02.cleardb.net/heroku_0d83fce646e0f00?reconnect=true", "b16b028e316d09", "5bc8e0ac"); 
    }

    public function query( $sql,Array $values ){
        $query = $this->con->query($sql);

        if( $values && count($values) ){
            while($value = $values){
                $query->bindParam(1, $value);
            }
        }

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function execute( $sql, Array $values ){
        $query = $this->con->prepare($sql);

        while($value = $values){
            $query->bindParam(1, $value);
        }
        $query->execute();
    }


}