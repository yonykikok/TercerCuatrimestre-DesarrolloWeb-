<?php
require_once 'usuario.php';
require_once 'IApiUsable.php';

class usuarioApi extends usuario implements IApiUsable
{
 	public function TraerUno($request, $response, $args) {
     	$id=$args['id'];
    	$elUsuario=usuario::TraerUnUsuario($id);
     	$newResponse = $response->withJson($elUsuario, 200);  
    	return $newResponse;
    }
     public function TraerTodos($request, $response, $args) {
      	$todosLosUsuarios=usuario::TraerTodoLosUsuarios();
     	$newResponse = $response->withJson($todosLosUsuarios, 200);  
    	return $newResponse;
    }
      public function CargarUno($request, $response, $args) {
     	 $ArrayDeParametros = $request->getParsedBody();
        $usuario= $ArrayDeParametros['usuario'];
        $password= $ArrayDeParametros['password'];
        
        $miUsuario = new usuario();
        $miUsuario->password=$password;
        $miUsuario->usuario=$usuario;
        $miUsuario->InsertarElUsuarioParametros();

				$archivos = $request->getUploadedFiles();
				if(isset($archivos['foto']))
				{
					
        $destino="./fotos/";
        //var_dump($archivos);
        //var_dump($archivos['foto']);

        $nombreAnterior=$archivos['foto']->getClientFilename();
        $extension= explode(".", $nombreAnterior)  ;
        //var_dump($nombreAnterior);
        $extension=array_reverse($extension);

				$archivos['foto']->moveTo($destino.$usuario.".".$extension[0]);
				
			}
			else{
				echo "<br>se cargo sin foto";
			}
        $response->getBody()->write("se guardo el usuario");

        return $response;
    }
      public function BorrarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();
     	$id=$ArrayDeParametros['id'];
     	$usuario= new usuario();
     	$usuario->id=$id;
     	$cantidadDeBorrados=$usuario->BorrarUsuario();

     	$objDelaRespuesta= new stdclass();
	    $objDelaRespuesta->cantidad=$cantidadDeBorrados;
	    if($cantidadDeBorrados>0)
	    	{
	    		 $objDelaRespuesta->resultado="algo borro!!!";
	    	}
	    	else
	    	{
	    		$objDelaRespuesta->resultado="no Borro nada!!!";
	    	}
	    $newResponse = $response->withJson($objDelaRespuesta, 200);  
      	return $newResponse;
    }
     
     public function ModificarUno($request, $response, $args) {
     	//$response->getBody()->write("<h1>Modificar  uno</h1>");
		 $ArrayDeParametros = $request->getParsedBody();
			
	    //var_dump($ArrayDeParametros);    	
	    $miUsuario = new usuario();
	    $miUsuario->id=$ArrayDeParametros['id'];
	    $miUsuario->password=$ArrayDeParametros['password'];
		$miUsuario->usuario=$ArrayDeParametros['usuario'];	
		
	   	$resultado =$miUsuario->ModificarUsuarioParametros();
	   	$objDelaRespuesta= new stdclass();
		//var_dump($resultado);
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);		
	}
	public function Login($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();

	   $miUsuario = new usuario();
	   $miUsuario->password=$ArrayDeParametros['password'];
	   $miUsuario->usuario=$ArrayDeParametros['usuario'];	
	   
	   $resultado =$miUsuario->TraerUnUsuarioPorLogin($ArrayDeParametros['usuario'],$ArrayDeParametros['password']);
		  $objDelaRespuesta= new stdclass();
	   $objDelaRespuesta->resultado=$resultado;
	   return $response->withJson($objDelaRespuesta, 200);		
   }


}