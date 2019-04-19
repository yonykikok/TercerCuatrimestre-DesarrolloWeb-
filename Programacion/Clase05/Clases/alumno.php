<?php
include "Persona.php";
include "./Funciones/AccesoDatos.php";
class Alumno extends Persona
{
    public $legajo;
    public $imagen;
/*
    function __construct($params)
    {       
        if(array_key_exists("legajo",(array)$params))
        {
            $this->legajo=$params['legajo'];
        }
        if(array_key_exists("imagen",(array)$params))
        {
            $this->imagen=$params['imagen'];
        }        
        parent::__construct($params);
    }*/
    //BASE DE DATOS
    public static function TraerTodoLosAlumnos()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id,Nombre as nombre, Apellido as apellido,Edad as edad,Legajo as legajo, Imagen as imagen from alumnos");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "alumno");		
    }
    /*1-crear almuno
    2-crearJson postman
    3- hacer un metodo que decodifique el json y cargue los atributos al alumno.*/

    /**
     * funcion que actua como constructor se le pasa un array con los parametros
     * si los campos estan en el objeto los carga.
     * @param $params es el array con los parametros del alumno
     */
    function miConstructor($params){
        if(array_key_exists("legajo",(array)$params))
        {
            $this->legajo=$params['legajo'];
        }
        if(array_key_exists("nombre",(array)$params))
        {
            $this->nombre=$params['nombre'];
        }

        if(array_key_exists("apellido",(array)$params))
        {
            $this->apellido=$params['apellido'];
        }
        if(array_key_exists("edad",(array)$params))
        {
            $this->edad=$params['edad'];
        }
        if(array_key_exists("imagen",(array)$params))
        {
            $this->imagen=$params['imagen'];
        }
    }

	 public function InsertarAlumno()
	 {

				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); //(`Nombre`, `Apellido`, `Edad`, `Legajo`, `id`, `Imagen`)
                if(is_null($this->imagen))
                {
                    $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into alumnos (Nombre,Apellido,Edad,Legajo)values(:nombre,:apellido,:edad,:legajo)");
                    $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
                    $consulta->bindValue(':apellido',$this->apellido, PDO::PARAM_STR);
                    $consulta->bindValue(':edad', $this->edad, PDO::PARAM_INT);
                    $consulta->bindValue(':legajo', $this->legajo, PDO::PARAM_INT); 
                }
                else
                {
                    $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into alumnos (Nombre,Apellido,Edad,Legajo,Imagen)values(:nombre,:apellido,:edad,:legajo,:imagen)");
                    $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
                    $consulta->bindValue(':apellido',$this->apellido, PDO::PARAM_STR);
                    $consulta->bindValue(':edad', $this->edad, PDO::PARAM_INT);
                    $consulta->bindValue(':legajo', $this->legajo, PDO::PARAM_INT);                  
                    $consulta->bindValue(':imagen', $this->imagen, PDO::PARAM_STR);
                }
                
				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
     }
     
    public function ModificarAlumno($alumnoActual)
    {
           $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();            
               if(is_null($alumnoActual->imagen))
                {                     
                   $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE `alumnos`
                   SET `nombre`=:nombre,
                   `apellido`=:apellido,
                   `legajo`=:legajo,
                   `edad`=:edad 
                   WHERE id=:id");
                    $consulta->bindValue(':nombre',$alumnoActual->nombre, PDO::PARAM_STR);
                    $consulta->bindValue(':apellido',$alumnoActual->apellido, PDO::PARAM_STR);
                    $consulta->bindValue(':edad', $alumnoActual->edad, PDO::PARAM_INT);
                    $consulta->bindValue(':legajo', $alumnoActual->legajo, PDO::PARAM_INT);     
                   $consulta->bindValue(':id', $this->id, PDO::PARAM_INT); 
                  
                }
               else
               {
                $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE `alumnos` 
                SET `nombre`=:nombre,
                `apellido`=:apellido,
                `legajo`=:legajo,
                `edad`=:edad ,
                `imagen`=:imagen
                WHERE id=:id");
                $consulta->bindValue(':nombre',$alumnoActual->nombre, PDO::PARAM_STR);
                $consulta->bindValue(':apellido',$alumnoActual->apellido, PDO::PARAM_STR);
                $consulta->bindValue(':edad', $alumnoActual->edad, PDO::PARAM_INT);
                $consulta->bindValue(':legajo', $alumnoActual->legajo, PDO::PARAM_INT);                 
                $consulta->bindValue(':imagen',$alumnoActual->imagen, PDO::PARAM_STR);
                $consulta->bindValue(':id', $this->id, PDO::PARAM_INT); 
               }
              
           return $consulta->execute();
    }

    public static function MostrarAlumno($alumno)
    {
            echo "<br/>Nombre: ".$alumno->nombre."<br/>";
            echo "Apellido: ".$alumno->apellido."<br/>";
            echo "Edad: ".$alumno->edad."<br/>";
            echo "Legajo: ".$alumno->legajo."<br/>";
            echo "Imagen: ".$alumno->imagen."<br/>";
    }

    public function BorrarAlumno()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete 
				from alumnos 				
				WHERE id=:id");	
				$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();

     }
     public static function TraerAlumno($id) 
     {
             $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
             $consulta =$objetoAccesoDato->RetornarConsulta("select id, nombre as nombre, apellido as apellido,edad as edad,imagen as imagen,legajo as legajo from alumnos where id = $id");
             $consulta->execute();
             $alumnoBuscado= $consulta->fetchObject('Alumno');
             return $alumnoBuscado;	
     }
     /**
      *Busca en la base de datos un alumno por un criterio pasado en el arrayLeido del Json, compara dicho campo contra el $auxAlumno y devuelve la cantidad de coincidencias 
      *@param $arrayAlumnoLeido es el array leido del php://input como array
      *@param $auxAlumno es el alumno a comparar el campo
      *@param $contador es un contador que nos servira para saber cuantas coincidencias hay en la busqueda
      *@param $criterio es porque campo vamos a buscar.
      *@return $contador devuelve el contador de coincidencias.
      */ 
     public function BuscarAlumnoPorCriterio($arrayAlumnoLeido,$criterio,$auxAlumno,$contador)
     {

        if($criterio=="id")//buscamos por id
        {            
            if($auxAlumno->id==$arrayAlumnoLeido['id'])
            {  
                $alumnoBuscado=$auxAlumno->TraerAlumno($auxAlumno->id);
                Alumno::MostrarAlumno($alumnoBuscado);    
                $contador++;
            }      
        }
        else if($criterio=="legajo")//buscamos por legajo
        {
            if($auxAlumno->legajo==$arrayAlumnoLeido['legajo'])
            {  
                $alumnoBuscado=$auxAlumno->TraerAlumno($auxAlumno->id);
                Alumno::MostrarAlumno($alumnoBuscado);    
                $contador++;
            }      
        }
        else if($criterio=="edad")//buscamos por edad
        {
            if($auxAlumno->edad==$arrayAlumnoLeido['edad'])
            {  
                $alumnoBuscado=$auxAlumno->TraerAlumno($auxAlumno->id);
                Alumno::MostrarAlumno($alumnoBuscado);    
                $contador++;
            }      
        }
        else if($criterio=="nombre")//buscamos por nombre
        {
            if($auxAlumno->nombre==$arrayAlumnoLeido['nombre'])
            {  
                $alumnoBuscado=$auxAlumno->TraerAlumno($auxAlumno->id);
                Alumno::MostrarAlumno($alumnoBuscado);    
                $contador++;
            }      
        }
        else if($criterio=="apellido")//buscamos por apellido
        {
            if($auxAlumno->apellido==$arrayAlumnoLeido['apellido'])
            {  
                $alumnoBuscado=$auxAlumno->TraerAlumno($auxAlumno->id);
                Alumno::MostrarAlumno($alumnoBuscado);    
                $contador++;
            }      
        }
        else if($criterio=="nombres")////buscamos por apellido y nombre
        {
            if($auxAlumno->apellido==$arrayAlumnoLeido['apellido'] && $auxAlumno->nombre==$arrayAlumnoLeido['nombre'])
            {  
                $alumnoBuscado=$auxAlumno->TraerAlumno($auxAlumno->id);
                Alumno::MostrarAlumno($alumnoBuscado);    
                $contador++;
            }      
        }
        
        return $contador;
        
     }
}
?>