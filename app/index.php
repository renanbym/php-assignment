<?php

$router = new \Core\Router\Router(new \Core\Router\Request);

$router->get('/', function() {
    var_dump('GET /');
});


$router->get('/profile', function($request) {
    var_dump('GET /profile');
});


$router->post('/data', function($request) {
  return json_encode($request->getBody());
});


$router->put('/data', function($request) {
  return json_encode($request->getBody());
});