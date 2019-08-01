<?php

namespace Middleware;

class RoleMiddleware extends TokenValidatorMiddleware
{
  public static function IsAdminOrHigher($request, $response, $next)
  {
    $data = parent::GetTokenData($request);

    if(is_null($data))
      return $response->withJson("no tiene los permisos necesarios para acceder aqui, isadminorhigher", 403);

    if(strtolower($data->role != "admin") && strtolower($data->role != "socio"))
    {
      return $response->withJson("no tiene los permisos necesarios para acceder aqui, isadminorhigher", 403);
    }

    return $next($request, $response);
  }

  public static function IsAdmin($request, $response, $next)
  {
     $data = parent::GetTokenData($request);

     if(is_null($data))
        return $response->withJson("no tiene los permisos necesarios para acceder aqui, isAdmin", 403);

      if(strtolower($data->role) != "admin")
      {
        return $response->withJson("no tiene los permisos necesarios para acceder aqui, isAdmin", 403);
      }
    return $next($request, $response);
  }

}
