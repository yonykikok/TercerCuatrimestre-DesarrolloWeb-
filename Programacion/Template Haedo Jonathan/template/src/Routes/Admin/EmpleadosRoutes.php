<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use \Slim\App;
use Controllers\EmpleadosController;
use Middleware\RoleMiddleware;
use Middleware\AuthMiddleware;

return function(App $app)
{
  $app->group('/admin/empleados', function()
  {
    $this->get('/', EmpleadosController::class . ':GetAll');
    $this->post('/create', EmpleadosController::class . ':Create');
    $this->post('/update/{id}', EmpleadosController::class . ':Update');
    $this->delete('/delete', EmpleadosController::class . ':Delete');
  })->add(AuthMiddleware::class.':IsLoggedIn')
    ->add(RoleMiddleware::class.':IsAdmin');
};
