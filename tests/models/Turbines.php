<?php


class TurbinesTest extends \PHPUnit\Framework\TestCase
{

    public function testIfDataBeAssign(){

        $model = new \App\Models\Turbines();
        $model->setName('name');
        $model->setType('type');
        $model->setLat('lat');
        $model->setLon('lon');

        $this->assertEquals('name', $model->getName());
        $this->assertEquals('type', $model->getType());
        $this->assertEquals('lat', $model->getLat());
        $this->assertEquals('lon', $model->getLon());
    }

}
