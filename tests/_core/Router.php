<?php


class RouterTest extends \PHPUnit\Framework\TestCase
{

    public function testRouterGET(){

        $router = new \Core\Router\Router(new \Core\Router\Request, new \Core\Router\Response);

        $router->get('/turbines', function ($request, $response) {});


        $this->assertIsArray($router->get['/turbines']);

    }
  

}
