<?php

namespace Controllers;

use Models\Empleado;
use Helpers\JWTAuth;
use Helpers\AppConfig as Config;
use Helpers\FilesHelper as Files;
use Helpers\ImagesHelper as Images;
use Illuminate\Database\Capsule\Manager as Capsule;

class EmpleadosController //implements IController
{
  public static function GetAll($request, $response, $args)
  {
    return json_encode(Empleado::all());
  }

  public static function GetOne($request, $response, $args)
  {
    $id = $request->getAttributes()["id"];
    $empleado = Empleado::find($id);
    if($empleado)
    {
      $responseObj = ["message" => "empleado encontrado", "empleado" => $empleado];
      return $response->withJson(json_encode($responseObj), 200);
    }
    else
    {
      $responseObj = ["message" => "empleado no encontrada"];
      return $response->withJson(json_encode($responseObj), 401);
    }
  }

  public static function Create($request, $response, $args)
  {
    //si viaja en form es parsed body y es array
    //si viaja como raw json: json_decode($request->getBody()); y es objeto
    $data = $request->getParsedBody(); 

    $empleado = new Empleado;
    $empleado->id = Empleado::LastInsertId()+1;
    $empleado->nombre = $data["nombre"];
    $empleado->apellido = $data["apellido"];
    $empleado->dni = $data["dni"];
    $empleado->image = Empleado::SaveImage($request, $empleado->id);
    $empleado->save();

    $responseObj = ["message" => "empleado creado", "empleado" => $empleado];
    return $response->withJson(json_encode($responseObj), 200);
  }

  public static function Update($request, $response, $args)
  {
    /* 
    //ID POR PARAMETRO EN /update/{id} para sacar
    //el id de ahi y poder hacer update de foto
      if(!isset($body["id"]))
    {
      return $response->withJson("debe especificar id", 400);
    }
    */

    $body = $request->getParsedBody();

    $empleado = Empleado::find($args["id"]);
    if(!$empleado)
    {
      return $response->withJson("empleado inexistente", 200);
    }
    $empleado->nombre = $body["nombre"];
    $empleado->apellido = $body["apellido"];
    $empleado->dni = $body["dni"];
    $empleado->image = Empleado::SaveImage($request, $empleado->id);
    $empleado->save();

    return $response->withJson("empleado actualizado", 200);
  }

  public static function Delete($request, $response, $args)
  {
    $body = $request->getParsedBody();
    if(!isset($body["id"]))
    {
      return $response->withJson("debe especificar id", 400);
    }
    $empleado = Empleado::find($body["id"]);
    if(!$empleado)
    {
      return $response->withJson("empleado inexistente", 200);
    }
    $empleado->delete();
    return $response->withJson("empleado eliminado");
  }
}
