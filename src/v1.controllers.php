<?php

$api = $app['controllers_factory'];
$version = 'v1';

$api->get('/tasks', $version.'.task.controller:getTasks');

$api->post('/tasks', $version.'.task.controller:createTask');

$api->get('/tasks/{id}', $version.'.task.controller:getTask');

$api->put('/tasks/{id}', $version.'.task.controller:updateTask');

$api->delete('/tasks/{id}', $version.'.task.controller:deleteTask');

$api->mount('/api/V1', $api);
