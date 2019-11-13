<?php

$router = new \Core\Router\Router(new \Core\Router\Request, new \Core\Router\Response);

$router->get('/turbines', function ($request, $response) {

    $turbine = new \App\Controllers\Turbines();
    $itens = $turbine->list($request->getBody());
    $response->withJson(array('data' => $itens), 200);

});

$router->post('/turbines', function ($request, $response) {

    $data = $request->getBody();

    if (isset($data) && !isset($data['name'])) {
        throw new \Exception('Field `name` is required');
    }

    if (isset($data) && !isset($data['type'])) {
        throw new \Exception('Field `type` is required');
    }

    if (isset($data) && !isset($data['lat'])) {
        throw new \Exception('Field `lat` is required', 3);
    }

    if (isset($data) && !isset($data['lon'])) {
        throw new \Exception('Field `lon` is required', 3);
    }

    $model = new \App\Models\Turbines();
    $model->setName($data['name']);
    $model->setType($data['type']);
    $model->setLat($data['lat']);
    $model->setLon($data['lon']);

    $turbine = new \App\Controllers\Turbines();
    $turbine->create($model);

    $response->withJson(array('data' => $data, 'message' => 'Successfully registered', 'code' => 200), 200);

});

$router->put('/turbines', function ($request, $response) {

    $data = $request->getBody();

    if (isset($data) && !isset($data['id'])) {
        throw new \Exception('Field `id` is required');
    }

    if (isset($data) && !isset($data['name'])) {
        throw new \Exception('Field `name` is required');
    }

    if (isset($data) && !isset($data['type'])) {
        throw new \Exception('Field `type` is required');
    }

    if (isset($data) && !isset($data['lat'])) {
        throw new \Exception('Field `lat` is required');
    }

    if (isset($data) && !isset($data['lon'])) {
        throw new \Exception('Field `lon` is required');
    }
    
    $model = new \App\Models\Turbines();
    $model->setId($data['id']);
    $model->setName($data['name']);
    $model->setType($data['type']);
    $model->setLat($data['lat']);
    $model->setLon($data['lon']);

    $turbine = new \App\Controllers\Turbines();
    $turbine->update($model);

    $response->withJson(array('data' => $data, 'message' => 'Successfully edited', 'code' => 200), 200);

});

$router->delete('/turbines', function ($request, $response) {

    $data = $request->getBody();

    if (isset($data) && !isset($data['id'])) {
        throw new \Exception('Field `id` is required');
    }

    $model = new \App\Models\Turbines();
    $model->setId($data['id']);

    $turbine = new \App\Controllers\Turbines();
    $turbine->delete($model);

    $response->withJson(array('data' => $data, 'message' => 'Successfully deleted', 'code' => 200), 200);

});

$router->post('/turbines/import', function ($request, $response) {
    $turbine = new \App\Controllers\Turbines();
    $turbine->import();

    $itens = $turbine->list();
    $response->withJson(array('data' => $itens, 'message' => 'Successfully imported', 'code' => 200), 200);
});
