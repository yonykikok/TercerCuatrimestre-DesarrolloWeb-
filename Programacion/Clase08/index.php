<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require './composer/vendor/autoload.php';
require './clases/AccesoDatos.php';
require './clases/usuarioApi.php';


$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;


$app = new \Slim\App(["settings" => $config]);

$verificarCredenciales= function($request,$response,$next){
  if($request->isGet())
  {
    $response->getBody()->write('<p>NO necesita credenciales para los get</p>');
    $response=$next($request,$response);
  }
  else
  {
    $response->getBody()->write('<p>Verificando Credenciales</p>');
    $arrayParametros=$request->getParsedBody();
    $usuario=$arrayParametros['usuario'];
    $password=$arrayParametros['password'];
    if($usuario=="yonykikok" && $password=="40132526")
    {
      $response->getBody()->write('<h3>Bienvenido: '.$usuario.'</h3>');
     var_dump($arrayParametros);
      $response=$next($request,$response);
      
    }
    else
    {
      $response->getBody()->write("<h3>No estas habilitado en este sector</h3>");
    }
  }
  $response->getBody()->write('<p>vuelvo al verificador de credenciales</p>');
  return $response;
};

$app->group('/usuario', function () {
 
  $this->get('/', \usuarioApi::class . ':traerTodos');
 
  $this->get('/{id}', \usuarioApi::class . ':traerUno');

  $this->post('/', \usuarioApi::class . ':CargarUno');

  $this->delete('/', \usuarioApi::class . ':BorrarUno');

  $this->put('/', \usuarioApi::class . ':ModificarUno');
     
})->add($verificarCredenciales);

$app->group('/login',function(){

  $this->post('/', \usuarioApi::class . ':Login');
});//->add($verificarCredenciales);
  
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