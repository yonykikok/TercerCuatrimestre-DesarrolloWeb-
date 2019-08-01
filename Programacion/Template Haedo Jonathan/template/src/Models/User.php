<?php
namespace Models;
use Illuminate\Database\Eloquent\Model;
use Helpers\AppConfig as Config;
use Helpers\ImagesHelper as Images;
use Illuminate\Database\Capsule\Manager as Capsule;
class User extends Model
{
  protected $table = "usuarios";
  public $timestamps = false;
  public static function LastInsertId()
  {
      return User::select("id")->orderBy("id", "desc")->first()->id;
  }
  public static function FindByUsername($username)
  {
     return User::where("username", $username)->first();
  }
  public static function FindByUsernameAndPassword($username, $password)
  {
     return User::where("username", $username)->where("password", $password)->first();
  }
}