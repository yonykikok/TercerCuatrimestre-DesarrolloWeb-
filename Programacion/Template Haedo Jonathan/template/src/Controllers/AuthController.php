<?php

namespace Controllers;
use Helpers\JWTAuth;
use Models\User;

class AuthController
{
  public static function LogIn($request, $response, $args)
  {

    $data = json_decode($request->getBody());

    if(!isset($data->username) || !isset($data->password))
      return $response->withJson("ingrese username/password", 400);

    $user = User::FindByUsername($data->username);

    //0 = no user, transform it to one so it matches cond
    if(!is_null($user))
    {
      if(!password_verify($data->password, $user->password))
      {
        return $response->withJson("invalid username/password");
      }
    }

    $obj = [
      "id" => $user->id,
      "username" => $user->username,
      "role" => $user->role
    ];
    return  JWTAuth::CreateToken($obj);
  }

  public static function Register($request, $response, $args)
  {
    $data = json_decode($request->getBody());

    if(!isset($data->username) || !isset($data->password))
      return $response->withJson("ingrese username/password", 400);

    $user = new User;
    $user->username = $data->username;

    $user->password = password_hash($data->password, PASSWORD_DEFAULT);
    $user->role = $data->role;

    $user->save();
    return self::LogIn($request, $response, $args);
  }

  public static function ChangePassword()
  {
  }
}
