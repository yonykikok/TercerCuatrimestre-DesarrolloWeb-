<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Helpers\AppConfig;

require __DIR__.'/vendor/autoload.php';

$config = ['settings' => ['displayErrorDetails' => true]];

$app = new \Slim\App($config);

$capsule = new Capsule;
$capsule->addConnection(AppConfig::$illuminateDb);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$authRoutes = require __DIR__.'/src/Routes/AuthRoutes.php';
$authRoutes($app);

$empleadosRoutes = require __DIR__.'/src/Routes/Admin/EmpleadosRoutes.php';
$empleadosRoutes($app);

$app->run();
