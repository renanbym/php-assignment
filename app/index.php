<?php

$router = new \Core\Router\Router(new \Core\Router\Request, new \Core\Router\Response);

$router->get('/turbines', function($request, $response) {

    try{

      $turbine = new \App\Models\Turbines();
   
      $itens = $turbine->list();

      $response->withJson(array('data' => $itens), 200);
      
    } catch (Exeption $e){
      $response->withJson($e, 501);
    }

});


$router->post('/turbines', function($request, $response) {

    try{
      $response->withJson($request->getBody(), 200);
    } catch (Exeption $e){
      $response->withJson($e, 501);
    }

});

$router->put('/turbines', function($request, $response) {

  try{
    $response->withJson($request->getBody(), 200);
  } catch (Exeption $e){
    $response->withJson($e, 501);
  }

});

$router->delete('/turbines', function($request, $response) {

  try{
    $response->withJson($request->getBody(), 200);
  } catch (Exeption $e){
    $response->withJson($e, 501);
  }

});


$router->post('/turbines/import', function($request, $response) {

  try{

    $turbine = new \App\Models\Turbines();
    $turbine->import();

 
    $itens = $turbine->list();

    $response->withJson( $itens , 200);
  } catch (Exeption $e){
    // $e->getMessage()
    $response->withJson($e, 501);
  }

});


