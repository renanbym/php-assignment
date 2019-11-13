<?php

namespace App\Models;

class Turbines
{

    private $id;
    private $name;
    private $type;
    private $lat;
    private $lon;

    public function __construct()
    {
    }

    public function setId(Int $id)
    {
        if(!$id) throw new Exception('Field `id` is required');
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }


    public function setName(String $name)
    {
        if(!$name) throw new Exception('Field `name` is required');
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }



    public function setType(String $type)
    {
        if(!$type) throw new Exception('Field `type` is required');
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }



    public function setLat(String $lat)
    {
        if(!$lat) throw new Exception('Field `lat` is required');
        $this->lat = $lat;
    }

    public function getLat()
    {
        return $this->lat;
    }



    public function setLon(String $lon)
    {
        if(!$lon) throw new Exception('Field `lon` is required');
        $this->lon = $lon;
    }

    public function getLon()
    {
        return $this->lon;
    }


}
