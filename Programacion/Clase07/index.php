<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require './composer/vendor/autoload.php';
require './clases/AccesoDatos.php';
require './clases/usuarioApi.php';


$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;


$app = new \Slim\App(["settings" => $config]);

$app->group('/usuario', function () {
 
  $this->get('/', \usuarioApi::class . ':traerTodos');
 
  $this->get('/{id}', \usuarioApi::class . ':traerUno');

  $this->post('/', \usuarioApi::class . ':CargarUno');

  $this->delete('/', \usuarioApi::class . ':BorrarUno');

  $this->put('/', \usuarioApi::class . ':ModificarUno');
     
});

$app->group('/login',function(){

  $this->post('/', \usuarioApi::class . ':Login');
});

$app->run();