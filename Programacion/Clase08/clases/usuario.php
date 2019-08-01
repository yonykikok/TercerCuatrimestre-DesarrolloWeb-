<?php
class usuario
{
	public $id;
 	public $usuario;
  	public $password;



  	public function BorrarUsuario()
	 {
	 		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from usuarios 				
				WHERE id=:id");	
				$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
	 }

	public static function BorrarUsuarioPorUsuario($usuario)
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from usuarios 				
				WHERE usuario=:usuario");	
				$consulta->bindValue(':usuario',$usuario, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();
	 }
	public function ModificarUsuario()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update usuarios 
				set usuario='$this->usuario',
				password='$this->password'
				WHERE id='$this->id'");
			return $consulta->execute();

	 }
	
  
	 public function InsertarElUsuario()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (usuario,password)values('$this->usuario','$this->password')");
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
				

	 }

	  public function ModificarUsuarioParametros()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 	
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update usuarios 
				set usuario=:usuario,
				password=:password
				WHERE id=:id");
			$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
			$consulta->bindValue(':password',$this->password, PDO::PARAM_INT);
			$consulta->bindValue(':usuario', $this->usuario, PDO::PARAM_STR);
			return $consulta->execute();
	 }

	 public function InsertarElUsuarioParametros()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (usuario,password)values(:usuario,:password)");
				$consulta->bindValue(':usuario',$this->usuario, PDO::PARAM_INT);
				$consulta->bindValue(':password', $this->password, PDO::PARAM_STR);
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }
	 public function GuardarUsuario()
	 {

	 	if($this->id>0)
	 		{
	 			$this->ModificarUsuarioParametros();
	 		}else {
	 			$this->InsertarElUsuarioParametros();
	 		}

	 }


  	public static function TraerTodoLosUsuarios()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id,usuario as usuario, password as password from usuarios");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");		
	}

	public static function TraerUnUsuario($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id, usuario as usuario, password as password from usuarios where id = $id");
			$consulta->execute();
			$usuarioBuscado= $consulta->fetchObject('usuario');
			return $usuarioBuscado;				

			
	}

	public static function TraerUnUsuarioPorUsuario($id,$usuario) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  usuario as usuario, password as password from usuarios  WHERE id=? AND usuario=?");
			$consulta->execute(array($id, $usuario));
			$usuarioBuscado= $consulta->fetchObject('usuario');
      		return $usuarioBuscado;				

			
	}

	public static function TraerUnUsuarioPorUsuarioParamNombre($id,$usuario) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  usuario as usuario, password as password from usuarios  WHERE id=:id AND usuario=:usuario");
			$consulta->bindValue(':id', $id, PDO::PARAM_INT);
			$consulta->bindValue(':usuario', $usuario, PDO::PARAM_STR);
			$consulta->execute();
			$usuarioBuscado= $consulta->fetchObject('usuario');
      		return $usuarioBuscado;				

			
	}
	
	public static function TraerUnUsuarioPorUsuarioParamNombreArray($id,$usuario) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  usuario as usuario, password as password from usuarios  WHERE id=:id AND usuario=:usuario");
			$consulta->execute(array(':id'=> $id,':usuario'=> $usuario));
			$consulta->execute();
			$usuarioBuscado= $consulta->fetchObject('usuario');
      		return $usuarioBuscado;	
	}
	
	public function mostrarDatos()
	{
	  	return "Metodo mostar:".$this->usuario."  ".$this->password;
	}

	public static function TraerUnUsuarioPorLogin($auxUsuario,$password) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id as id, usuario as usuario, password as password from usuarios where usuario = '$auxUsuario' and password= '$password'");
			$consulta->execute();
			$usuarioBuscado= $consulta->fetchObject('usuario');
			return $usuarioBuscado;		
	}

}