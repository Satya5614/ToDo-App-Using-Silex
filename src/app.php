<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use App\V1\Providers\ControllersServiceProvider;
use App\V1\Providers\ServicesServiceProvider;

$app = new Application();
$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider());
$app['twig'] = $app->share($app->extend('twig', function ($twig, $app) {
    return $twig;
}));

$app->register(new ControllersServiceProvider(), array(
));
$app->register(new ServicesServiceProvider(), array(
));

$db_options = array(
    'driver' => 'pdo_mysql',
    'dbname' => 'todo',
    'host' => 'satya5614-silextodoapp-1642865',
    'user' => 'satya5614',
    'password' => '',
    'charset' => 'utf8'
);

$app->register(new DoctrineServiceProvider(), array(
    'db.options' => $db_options
));
// to ServiceProvider
$app['repository.tasks'] = $app->share(function ($app) {
    return new App\Repositories\TaskRepository($app['db']);
});

$app['repository.groups'] = $app->share(function ($app) {
    return new App\Repositories\GroupRepository($app['db']);
});

return $app;
