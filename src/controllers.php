<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Controllers\Todo;

//Request::setTrustedProxies(array('127.0.0.1'));

$todo = $app['controllers_factory'];

$todo->match('/todo', 'App\Controllers\TaskController::indexAction')
->method('GET|POST');

$todo->get('/update/{id}', 'App\Controllers\TaskController::updateAction');

$todo->get('/delete/{id}', 'App\Controllers\TaskController::deleteAction');

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html',
        'errors/'.substr($code, 0, 2).'x.html',
        'errors/'.substr($code, 0, 1).'xx.html',
        'errors/default.html',
    );
    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});

$app->mount('/', $todo);