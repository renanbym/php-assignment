<?php


class TurbinesControllerTest extends \PHPUnit\Framework\TestCase
{

    public function testControllerImport(){

        $controllers = new \App\Controllers\Turbines();
        
        $itens = $controllers->import();
        $this->assertIsArray($itens);
    }
  
    public function testControllerList(){

        $controllers = new \App\Controllers\Turbines();
        $itens = $controllers->list();
        
        $this->assertIsArray($itens);
    }

}
