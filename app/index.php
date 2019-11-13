<?php

$router = new \Core\Router\Router(new \Core\Router\Request, new \Core\Router\Response);

$router->get('/turbines', function ($request, $response) {

    try {

        $turbine = new \App\Controllers\Turbines();
        $itens = $turbine->list($request->getBody());
        $response->withJson(array('data' => $itens), 200);

    } catch (Exeption $e) {
        $response->withJson(array('data' => [], 'message' => $e->getMessage()), 501);
    }

});

$router->post('/turbines', function ($request, $response) {

    try {
        $data = $request->getBody();

        if (isset($data) && !$data['name']) {
            throw new Exception('Field `name` is required');
        }

        if (isset($data) && !$data['type']) {
            throw new Exception('Field `type` is required');
        }

        if (isset($data) && !$data['lat']) {
            throw new Exception('Field `lat` is required');
        }

        if (isset($data) && !$data['lot']) {
            throw new Exception('Field `lot` is required');
        }

        $model = new \App\Models\Turbines();
        $model->setName($data['name']);
        $model->setType($data['type']);
        $model->setLat($data['lat']);
        $model->setLon($data['lot']);

        $turbine = new \App\Controllers\Turbines();
        $turbine->create($model);

        $response->withJson(array('data' => $data, 'message' => 'Successfully registered'), 200);

    } catch (Exeption $e) {
        $response->withJson($e, 501);
    }

});

$router->put('/turbines', function ($request, $response) {

    try {

        $data = $request->getBody();

        if (isset($data) && !$data['id']) {
            throw new Exception('Field `id` is required');
        }

        if (isset($data) && !$data['name']) {
            throw new Exception('Field `name` is required');
        }

        if (isset($data) && !$data['type']) {
            throw new Exception('Field `type` is required');
        }

        if (isset($data) && !$data['lat']) {
            throw new Exception('Field `lat` is required');
        }

        if (isset($data) && !$data['lot']) {
            throw new Exception('Field `lot` is required');
        }

        $model = new \App\Models\Turbines();
        $model->setId($data['id']);
        $model->setName($data['name']);
        $model->setType($data['type']);
        $model->setLat($data['lat']);
        $model->setLon($data['lot']);

        $turbine = new \App\Controllers\Turbines();
        $turbine->update($model);

        $response->withJson(array('data' => $data, 'message' => 'Successfully edited'), 200);

    } catch (Exeption $e) {
        $response->withJson($e, 501);
    }

});

$router->delete('/turbines', function ($request, $response) {

    try {

        $data = $request->getBody();

        if (isset($data) && !$data['id']) {
            throw new Exception('Field `id` is required');
        }

        $model = new \App\Models\Turbines();
        $model->setId($data['id']);

        $turbine = new \App\Controllers\Turbines();
        $turbine->delete($model);

        $response->withJson(array('data' => $data, 'message' => 'Successfully deleted'), 200);

    } catch (Exeption $e) {
        $response->withJson($e, 501);
    }

});

$router->post('/turbines/import', function ($request, $response) {

    try {
        $turbine = new \App\Controllers\Turbines();
        $turbine->import();

        $itens = $turbine->list();
        $response->withJson(array('data' => $itens, 'message' => 'Successfully imported'), 200);

    } catch (Exeption $e) {
        $response->withJson(array('data' => [], 'message' => $e->getMessage()), 501);
    }

});
