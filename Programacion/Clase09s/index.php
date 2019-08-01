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
     
})->add(\MWparaAutenticar::class . ':VerificarUsuario');

$app->group('/login',function(){

  $this->post('/', \usuarioApi::class . ':Login');
})->add(\MWparaAutenticar::class . ':VerificarUsuario');
  
$app->add(function($request,$response,$next)
{
  $response->getBody()->write('<p>Primera Capa de IDA</p>'); 
  $response= $next($request,$response);
  $response->getBody()->write('<p>Primera Capa de VUELTA</p>');
  return $response;
});

$app->add(function($request,$response,$next){
  $response->getBody()->write('<p>Segunda Capa de IDA</p>');
  $response=$next($request,$response);
  $response->getBody()->write('<p>Segunda Capa de Vuelta</p>');
  return $response;
});
$app->run();