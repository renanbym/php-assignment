<?php

namespace App\Models;

class Turbines{

    public function __construct(){
    }

    public function import(){
        $items = [];
        $file = fopen('turbines.csv', 'r');


        while (($line = fgetcsv($file)) !== FALSE) {
            $items[] = $line;
            $query = \App\Models\Connection::getConn()->prepare('INSERT INTO turbines (`name`, `type`, `lat`, `lon`) VALUES (?, ?, ?, ?)');
       
            $query->bindParam(1, $line[0]);
            $query->bindParam(2, $line[1]);
            $query->bindParam(3, $line[2]);
            $query->bindParam(4, $line[3]);

            return $query->execute();
        }
        fclose($file);

        return $items;
    }

    public function create( $values ){

        $query = \App\Models\Connection::getConn()->prepare('INSERT INTO turbines (`name`, `type`, `lat`, `lon`) VALUES (?, ?, ?, ?)');

        foreach( $values as $key => $value ){
            $query->bindParam($key + 1, $value);
        }

        return $query->execute();

    }

    public function list(){
        $query = \App\Models\Connection::getConn()->query('SELECT * FROM turbines');
        return $query->fetchAll(\PDO::FETCH_CLASS);
    }

    public function update( $id, $values ){

        $query = \App\Models\Connection::getConn()->prepare('UPDATE turbines SET name=:name, type=:type, lat=:lat, lon=:lon WHERE id = :id');

        $query->bindParam(':id', $id);

        foreach( $values as $key => $value ){
            $query->bindParam($key, $value);
        }

        return $query->execute();

    }

    public function delete( $id ){
        $query = \App\Models\Connection::getConn()->prepare('DELETE FROM turbines WHERE id = :id');
        $query->bindParam(':id', $id);

        return $query->execute();
    }

}
