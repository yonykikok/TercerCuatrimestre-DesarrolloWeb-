<?php

namespace Models;

use Helpers\AppConfig as Config;
use Helpers\ImagesHelper as Images;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as Capsule;

class Empleado extends Model
{
  protected $table = "empleados";
  public $timestamps = false;

  public static function LastInsertId()
  {
    $e =  Empleado::select("id")->orderBy("id", "desc")->first();
    is_null($e) ? 0 : $e->id;
  }

  public static function SaveImage($request, $id)
  {
      return Images::SaveImageFromRequest(
          $request,
          Config::$imagesDirectories["empleados"],
          Config::$imagesDirectories["empleadosBkp"],
          $id
      );
  }
}
