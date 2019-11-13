<?php

namespace App\Controllers;

class Turbines
{

    public function __construct()
    {
    }

    /**
     *
     * @return array - values of import csv
     */
    public function import(): array
    {
        $items = [];
        $file = fopen('turbines.csv', 'r');

        while (($line = fgetcsv($file)) !== false) {
            $items[] = $line;

            $model = new \App\Models\Turbines();
            $model->setName($line[0]);
            $model->setType($line[1]);
            $model->setLat($line[2]);
            $model->setLon($line[3]);

            $this->create($model);
        }
        fclose($file);

        return $items;
    }

    /**
     *
     * @param array $values [id, name, type, lat, lon]
     * @return array Turbines
     */
    function list(array $values = []): ?array
    {

        /**
         *  $array_allowed - array to check if the values sended are valid
         */
        $array_allowed = ['id', 'name', 'type', 'lat', 'lon'];

        $sql = "SELECT * FROM turbines WHERE 1 ";

        if (isset($values) && count($values)) {
            foreach ($values as $key => $value) {
                if (!in_array($key, $array_allowed)) {
                    throw new \Exception("The field `{$key}` is not valid");
                }
                $sql .= " AND {$key} = :{$key} ";
            }
        }

        $query = \App\Controllers\Connection::getConn()->prepare($sql);
        if (isset($values) && count($values)) {
            foreach ($values as $key => $value) {
                $query->bindParam(":{$key}", $value);
            }
        }

        $query->execute();
        
        return $query->fetchAll(\PDO::FETCH_CLASS);

    }

    public function create(\App\Models\Turbines $turbine)
    {

        if (!$turbine->getName() || !$turbine->getType() || !$turbine->getLat() || !$turbine->getLon()) {
            throw new \Exception('All fields are required');
        }
        $query = \App\Controllers\Connection::getConn()->prepare('INSERT INTO turbines (`name`, `type`, `lat`, `lon`) VALUES (:name, :type, :lat, :lon)');

        $name = $turbine->getName();
        $type = $turbine->getType();
        $lat = $turbine->getLat();
        $lon = $turbine->getLon();

        $query->bindParam(':name', $name);
        $query->bindParam(':type', $type);
        $query->bindParam(':lat', $lat);
        $query->bindParam(':lon', $lon);

        return $query->execute();
    }

    public function update(\App\Models\Turbines $turbine)
    {

        if (!$turbine->getId() || !$turbine->getName() || !$turbine->getType() || !$turbine->getLat() || !$turbine->getLon()) {
            throw new \Exception('All fields are required');
        }

        /**
         * Check if id exists
         */
        $ck = $this->list(array('id' => $turbine->getId()));
        if (count($ck) <= 0) {
            throw new \Exception('No item found');
        }

        $query = \App\Controllers\Connection::getConn()->prepare('UPDATE turbines SET name=:name, type=:type, lat=:lat, lon=:lon WHERE id = :id');

        $id = $turbine->getId();
        $name = $turbine->getName();
        $type = $turbine->getType();
        $lat = $turbine->getLat();
        $lon = $turbine->getLon();

        $query->bindParam(':id', $id);
        $query->bindParam(':name', $name);
        $query->bindParam(':type', $type);
        $query->bindParam(':lat', $lat);
        $query->bindParam(':lon', $lon);

        return $query->execute();
    }

    public function delete(\App\Models\Turbines $turbine)
    {

        if (!$turbine->getId()) {
            throw new \Exception('All fields are required');
        }

        $id = $turbine->getId();

        /**
         * Check if id exists
         */
        $ck = $this->list(array('id' => $id));
        if (count($ck) <= 0) {
            throw new \Exception('No item found');
        }

        $query = \App\Controllers\Connection::getConn()->prepare('DELETE FROM turbines WHERE id = :id');
        $query->bindParam(':id', $id);

        return $query->execute();
    }

}
